<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Surat;
use App\User;
use App\Teruskan;
use Auth;
use DataTables;
use PDF;
use Carbon\Carbon;

class ArsipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('arsip.index');
    }

    public function cetak_pdf($id)
    {
    	$data = Surat::findOrFail($id);
        $dispo = Teruskan::where('surat_id', $data->id)->get();

    	$pdf = PDF::loadview('arsip.cetak',['data'=>$data, 'dispo'=>$dispo])->setPaper('a4');
    	return $pdf->stream();
    }

    public function backup(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01';
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59';

        $data = Surat::whereBetween('created_at', [$start_date, $end_date])->get();
        $awal = Carbon::parse($request->start_date)->format('d-m-Y');
        $akhir = Carbon::parse($request->end_date)->format('d-m-Y');
        if($data->count())
        {
            $pdf = PDF::loadview('arsip.backup', compact('data',  'awal', 'akhir'))->setPaper('a4');
            return $pdf->stream();
        }
        else
        {
            return redirect()->route('arsip')->with(['failed' => 'Tidak ada Data !!']);
        }
    }

    public function cetak(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01';
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59';

        $data = Surat::whereBetween('created_at', [$start_date, $end_date])->get();
        $biasa = Surat::whereBetween('created_at', [$start_date, $end_date])->where('jenis', '0')->count();
        $penting = Surat::whereBetween('created_at', [$start_date, $end_date])->where('jenis', '1')->count();
        $rahasia = Surat::whereBetween('created_at', [$start_date, $end_date])->where('jenis', '2')->count();
        $awal = Carbon::parse($request->start_date)->format('d-m-Y');
        $akhir = Carbon::parse($request->end_date)->format('d-m-Y');

        if($data->count())
        {
            $pdf = PDF::loadview('arsip.laporan', compact('data', 'biasa', 'penting', 'rahasia', 'awal', 'akhir'))->setPaper('a4');
    	    return $pdf->stream();
        }
        else
        {
            return redirect()->route('arsip')->with(['failed' => 'Tidak ada Data !!']);
        }

    }

    public function datatable()
    {
        // Admin && Aspidsus
        if(Auth::user()->level == 0 || Auth::user()->level == 1 || Auth::user()->level == 2)
        {
            $surat = Surat::where('no_agenda', '!=', 'null')->get();

            return Datatables::of($surat)
            ->addColumn('jeniss', function($surat) {
                if($surat->jenis == 0)
                {
                    return '<p class="text-green">Biasa</p>';
                }
                elseif($surat->jenis == 1)
                {
                    return '<p class="text-yellow">Penting</p>';
                }
                else {
                    return '<p class="text-red">Rahasia</p>';
                }
            })
            ->addColumn('tgl', function($surat) {
                return $surat->created_at->format('d/m/Y');
            })
                ->addColumn('action', function($surat) {
                    return view('datatable.action_single', [
                        'edit_url' => route('surat.show', $surat->id),
                    ]);

                })
                ->addIndexColumn()->rawColumns(['jeniss','action'])->make(true);
        }
        elseif(Auth::user()->level == 3 || Auth::user()->level == 4 || Auth::user()->level == 5)
        {
            $surat = Teruskan::where([['user_id', Auth::user()->id],['read', '1']])->get();

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
                        'edit_url' => route('surat.show', $surat->surat_id),
                    ]);

                })
                ->addIndexColumn()->rawColumns(['jenis','action'])->make(true);
        }
    }
}
