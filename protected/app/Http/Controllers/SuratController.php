<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Surat;
use App\User;
use App\Teruskan;
use Auth;
use DataTables;

class SuratController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Aspidsus')->only('create','store');
        $this->middleware('Kasidik')->only('edit','update');
        $this->middleware('Staf')->only('index','datatable');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_pelaksana' => 'required',
            'masalah' => 'required',
        ]);
        $no = Surat::max('indeks');
        $indeks;
        if ($no) {
            $indeks = $no + 1;
        }
        else{
            $indeks = 1;
        }
        $input = $request->all();
        $input['indeks'] = $indeks;
        $input['user_tujuan'] = 3;
        // $input['user_tujuan'] = User::where('level', 1)->first();
        Surat::create($input);
        return redirect()->route('surat.create')->with(['success' => 'Berhasil Membuat Surat']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->level == 3 || Auth::user()->level == 4 || Auth::user()->level == 5)
        {
            $terus = Teruskan::findOrFail($id);
            $input['read'] = '1';
            $terus->update($input);
            $data = Surat::findOrFail($terus->surat_id);

            // return $terus;
        }
        else{
            $data = Surat::findOrFail($id);
        }
        $dispo = Teruskan::where('surat_id', $data->id)->get();
        return view('surat.show', compact('data', 'dispo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Surat::findOrFail($id);
        $user = User::whereIn('level', ['3','4','5'])->get();
        return view('surat.edit', compact('data', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Surat::findOrFail($id);
        $this->validate($request, [
            'jenis' => 'required',
            'user' => 'required',
        ]);
        $jenis;
        if($request->jenis == 0)
        {
            $jenis = "B";
        }
        elseif ($request->jenis == 1) {
            $jenis = "P";
        }
        else { $jenis = "R"; }
        $input = $request->except('user');
        $input['no_agenda'] = $jenis . "-" . $data->indeks . "/Dik." . $data->indeks;
        $data->update($input);

        // teruskan
        foreach($request->user as $user)
        {
            $dispo['surat_id'] = $data->id;
            $dispo['user_id'] = $user;
            Teruskan::create($dispo);
        }
        return redirect()->route('surat.index')->with(['success' => 'Berhasil Meneruskan Surat']);;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function datatable()
    {
        if(Auth::user()->level == 2)
        {
            $surat = Surat::where('no_agenda', null)->get();

            return Datatables::of($surat)
            ->addColumn('tgl', function($surat) {
                return $surat->created_at->format('d/m/Y');
            })
                ->addColumn('action', function($surat) {
                    return view('datatable.action_single', [
                        'edit_url' => route('surat.edit', $surat->id),
                    ]);

                })
                ->addIndexColumn()->make(true);
        }
        elseif(Auth::user()->level == 3 || Auth::user()->level == 4 || Auth::user()->level == 5)
        {
            $surat = Teruskan::where([['user_id', Auth::user()->id],['read', '0']])->get();

            return Datatables::of($surat)
            ->addColumn('jenis', function($surat) {
                if($surat->surat['jenis'] == 0)
                {
                    return '<p class="text-green">Biasa</p>';
                }
                elseif($surat->surat['jenis'] == 1)
                {
                    return '<p class="text-yellow">Penting</p>';
                }
                else {
                    return '<p class="text-red">Rahasia</p>';
                }
            })
            ->addColumn('agenda', function($surat) {
                return $surat->surat['no_agenda'];
            })
            ->addColumn('tgl', function($surat) {
                return $surat->surat['created_at']->format('d/m/Y');
            })
                ->addColumn('action', function($surat) {
                    return view('datatable.action_single', [
                        'edit_url' => route('surat.show', $surat->id),
                    ]);

                })
                ->addIndexColumn()->rawColumns(['jenis','action'])->make(true);
        }
    }
}
