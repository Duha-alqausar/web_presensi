<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();



        return view('admin.index',['users'=> $users]);

    }

    public function home()
    {
        $absensi = DB::table('absensi')
        ->join('users', 'absensi.id_pegawai', '=', 'users.id')
        ->get();

        // mengirim data absensi ke view index
        return view('admin.home',['absensi' => $absensi]);

    }

    public function hapus($name)
    {
    // menghapus data pegawai berdasarkan id yang dipilih
        DB::table('users')->where('name',$name)->delete();
        
    // alihkan halaman ke halaman pegawai
        return redirect('/admin');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = DB::table('users')->where('id',$id)->get();
    // passing data users yang didapat ke view edit.blade.php
    return view('admin/edit',['users' => $users]);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('users')->where('id',$request->id)->update([
            'name' => $request->nama,
            'email' => $request->email,
            'nip' => $request->nip,
            'admin' => $request->level]);
    // alihkan halaman ke halaman pegawai
    return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function register()
    {
        return view('admin/register');
    }

    public function proses(Request $request)
    {
        DB::table('users')->insert([
            'nip' => $request['nip'],
            'name' => $request['name'],
            'email' => $request['email'],
            'admin' => $request['level'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('/admin');
    }




}
