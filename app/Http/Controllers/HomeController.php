<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $absensi = DB::table('absensi')
        ->join('users', 'absensi.id_pegawai', '=', 'users.id')
        ->get();

        // mengirim data absensi ke view index
        return view('home',['absensi' => $absensi]);

    }

    public function keluar(Request $request, $id)
    {
        $absensi = DB::table('absensi')->where('id_absensi',$id)->get();

        date_default_timezone_set("Asia/Jakarta");
        $jam = date('H:i:s');

        $q = DB::table('absensi')->where('id_absensi',$id)->update([
            'jam_keluar' => $jam]);

        if ($q) {
            echo "<script>alert('Kamu Berhasil absen keluar di jam $jam, Hati-hati di jalan ya.. :)')</script>";
            echo "<script>location='/home';</script>";
        } else {
            echo "<script>alert('Gagal')</script>";
            echo "<script>location='/home';</script>";
        }           
    }

    public function absen(Request $request)
    {
        if (Auth::user()->nip = $request['nip']) {
            
             $status = DB::table('users')->where('nip', $request['nip'])->count();
     if ($status > 0) {
        $pegawai = DB::table('users')->where('nip', $request['nip'])->get();
         $idPeg = json_decode(json_encode($pegawai) , true)[0]['id'];

         $query = DB::table('absensi')->select('tanggal_absen','id_pegawai')->where('keterangan','Hadir')->Where('id_pegawai',$idPeg)->orderBy('tanggal_absen','desc')->count();

        if ($query > 0) {
             $query = DB::table('absensi')->select('tanggal_absen','id_pegawai')->where('keterangan','Hadir')->Where('id_pegawai',$idPeg)->orderBy('tanggal_absen','desc')->get();

            $ket =  json_decode(json_encode($query) , true)[0]['tanggal_absen'];
             $tanggal = explode('-', $ket);
            
         $tanggal = mktime(0,0,0, $tanggal[1], $tanggal[2], $tanggal[0]);
         $now = time();
         if (($tanggal+259200) < $now) {
            $nama = json_decode(json_encode($pegawai) , true)[0]['name'];
            date_default_timezone_set("Asia/Jakarta");
            $date = date ('Y-m-d');
            $jam = date ('H:i:s');
            $q = DB::table('absensi')->insert([
                'id_pegawai' => $idPeg,
                'tanggal_absen' => $date,
                'jam_masuk' => $jam,
                'keterangan' => "Hadir"
            ]);
            return redirect('/home')->with('status', "$nama, Anda sudah tidak datang lebih dari 3 hari, Harap Hubungi HRD..!!");
        }

        }
       
         
        

         
        }


    }else{
         return redirect('/home')->with('status', "Anda Tidak Dikenali");
    }

    date_default_timezone_set("Asia/Jakarta");
    $date = date ('Y-m-d');
    $jam = date ('H:i:s');

    $q = DB::table('absensi')->where('id_pegawai', $idPeg)
    ->Where('tanggal_absen', $date)->count();

    if ($q > 0) {
        echo "<script>alert('Anda Sudah Absen Hari Ini')</script>";
        echo "<script>location='/home';</script>";exit;
    }

    $q = DB::table('absensi')->insert([
        'id_pegawai' => $idPeg,
        'tanggal_absen' => $date,
        'jam_masuk' => $jam,
        'keterangan' => "Hadir"
    ]);

    echo "<script>alert('Kamu Berhasil Absen Di jam $jam')</script>";
    echo "<script>location='/home';</script>";
}
}
