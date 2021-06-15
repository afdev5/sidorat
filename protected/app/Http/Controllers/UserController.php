<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.add');
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'level' => 'required',
        ]);
        $input = $request->except('password');
        $input['password'] = bcrypt($request->password);
        User::create($input);
        return redirect()->route('users.index')->with(['success' => 'Berhasil Menambahkan Users']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::findOrFail($id);
        // $pass = Hash::
        return view('users.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $data = User::findOrFail($id);
        // $pass = Hash::
        return view('users.edit', compact('data'));
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
        $data = User::findOrFail($id);
        if(!$request->jenis)
        {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|unique:users,email,' . $id,
                'password' => 'required',
                'level' => 'required',
            ]);
            $input = $request->except('password');
            $input['password'] = bcrypt($request->password);
            $data->update($input);
            return redirect()->route('users.index')->with(['success' => 'Berhasil Update Users']);
        }
        else
        {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|unique:users,email,' . $id,
                'password' => 'required',
            ]);
            $input = $request->except('password');
            $input['password'] = bcrypt($request->password);
            $data->update($input);
            return redirect()->route('users.show',$data->id)->with(['success' => 'Berhasil Update Data']);;
            // return 'ok';
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('users.index')->with(['success' => 'Berhasil Hapus Users']);;
    }

    public function datatable()
    {
        $user = User::where('level', '!=', '0')->get();

        return Datatables::of($user)
        ->addColumn('levels', function($user) {
            if($user->level == 1)
            {
                return 'Aspidsus';
            }
            elseif($user->level == 2)
            {
                return 'Kasidik';
            }
            elseif($user->level == 3)
            { return 'Staf'; }
            elseif($user->level == 4)
            { return 'Jaksa Penelaah'; }
            else { return 'Penyidik'; }
        })
            ->addColumn('action', function($user) {
                return view('datatable.action', [
                    'edit_url' => route('users.edit', $user->id),
                    'del_url'  => route('users.destroy', $user->id),
                ]);

            })
            ->addIndexColumn()->make(true);
    }
}
