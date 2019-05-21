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
        $users = DB::table('users')->paginate(6);

        $permohonan = DB::table('permohonan')
        ->where('status','Proses')
        ->count();
        
        if ($permohonan > 0) {
            session()->put('status', "ada permohonan baru");
            return view('admin.index',['users'=> $users]);
        }

        return view('admin.index',['users'=> $users]);


    }

    public function dashboard()
    {
        date_default_timezone_set("Asia/Jakarta");
        $date = date ('Y-m-d');
        $users = DB::table('users')->count();
        $presensi = DB::table('absensi')->where('tanggal_absen',$date)->count();
        $permohonan = DB::table('permohonan')->count();
        return view('admin.dashboard',['users'=>$users],['absensi'=>$presensi]);


    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;
            // mengambil data dari table users sesuai pencarian data
        $users = DB::table('users')
        ->where('name','like',"%".$cari."%")
        ->orwhere('email','like',"%".$cari."%")
        ->orwhere('nip','like',"%".$cari."%")
        ->orwhere('admin','like',"%".$cari."%")
        ->paginate();

            // mengirim data users ke view index
        return view('admin.index',['users' => $users]);

    }

    public function cari_p(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;
            // mengambil data dari table users sesuai pencarian data
        $users = DB::table('permohonan')
        ->where('nama','like',"%".$cari."%")
        ->orwhere('tanggal','like',"%".$cari."%")
        ->orwhere('waktu','like',"%".$cari."%")
        ->orwhere('keterangan','like',"%".$cari."%")
        ->orwhere('status','like',"%".$cari."%")
        ->paginate();

            // mengirim data permohonan ke view index
        return view('admin.permohonan',['permohonan' => $users]);

    }


    public function cari_a(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;
            // mengambil data dari table users sesuai pencarian data
        $absensi = DB::table('absensi')
        ->join('users', 'absensi.id_pegawai', '=', 'users.id')
        ->where('name','like',"%".$cari."%")
        ->orwhere('tanggal_absen','like',"%".$cari."%")
        ->orwhere('jam_masuk','like',"%".$cari."%")
        ->orwhere('jam_keluar','like',"%".$cari."%")
        ->orwhere('keterangan','like',"%".$cari."%")
        ->paginate();

            // mengirim data permohonan ke view index
        return view('admin.home',['absensi' => $absensi]);

    }


    public function permohonan()
    {
        $permohonan = DB::table('permohonan')
        ->orderBy('tanggal','desc')
        ->orderBy('waktu','desc')
        ->paginate(6);


        return view('admin.permohonan',['permohonan'=> $permohonan]);

    }



    public function konfirmasi($id)
    {
     DB::table('permohonan')->where('id',$id)->update([
        'status' => "Confirm"]);
     $nama1 = DB::table('permohonan')->where('id',$id)->get();
     $nama = json_decode(json_encode($nama1) , true)[0];

     $absensi = DB::table('users')
     ->where('name',$nama['nama'])
     ->get();
     $absensi1= json_decode(json_encode($absensi) , true)[0]['id'];


     $date = date ('Y-m-d');
     $q = DB::table('absensi')->where('id_pegawai', $absensi1)
     ->Where('tanggal_absen', $date)->count();

     if ($q > 0) {
         return redirect('/admin/permohonan')->with('status2', "Dia sudah absen,Permohonan berhasil Di konfirmasi");
     }else{
        $q = DB::table('absensi')->insert([
            'id_pegawai' => $absensi1,
            'tanggal_absen' => $nama['tanggal'],
            'keterangan' => $nama['keterangan']
        ]);
    // alihkan halaman ke halaman pegawai
        return redirect('/admin/permohonan')->with('status1', "Permohonan berhasil Di konfirmasi");
    }

    
}

public function batal($id)
{

    DB::table('permohonan')->where('id',$id)->update([
        'status' => "Reject"]);
    // alihkan halaman ke halaman pegawai
    return redirect('/admin/permohonan')->with('status1', "Permohonan berhasil Di Tolak");
}


public function home()
{
    $absensi = DB::table('absensi')
    ->join('users', 'absensi.id_pegawai', '=', 'users.id')->orderBy('tanggal_absen','desc')
    ->paginate(6);

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

public function hapus_p($id)
{
    // menghapus data pegawai berdasarkan id yang dipilih

    DB::table('absensi')->where('id_absensi',$id)->delete();

    // alihkan halaman ke halaman pegawai
    return redirect('/admin/home');
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

    public function edit_p($id)
    {
        $absensi = DB::table('absensi')->where('id_absensi',$id)->get();
    // passing data absensi yang didapat ke view edit.blade.php
        return view('admin/edit_p',['absensi' => $absensi]);
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

    public function update_p(Request $request)
    {
        DB::table('absensi')->where('id_absensi',$request->id_absensi)->update([

            'tanggal_absen' => $request->tanggal_absen,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'keterangan' => $request->keterangan,
        ]);
    // alihkan halaman ke halaman pegawai
        return redirect('/admin/home');
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
            'nip' => '0',
            'name' => $request['name'],
            'email' => $request['email'],
            'admin' => $request['level'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('/admin');
    }




}
