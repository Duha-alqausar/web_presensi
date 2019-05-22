<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        ->join('users', 'absensi.id_pegawai', '=', 'users.id')->where('name',Auth::user()->name)
        ->paginate(6);
        $idPeg = Auth::user()->id;

        $query = DB::table('absensi')->select('tanggal_absen','id_pegawai')->where('keterangan','Hadir')->where('id_pegawai',$idPeg)->orderBy('tanggal_absen','desc')->count();
        if ($query > 0) {
         $query = DB::table('absensi')->select('tanggal_absen','id_pegawai')->where('keterangan','Hadir')->Where('id_pegawai',$idPeg)->orderBy('tanggal_absen','desc')->get();
         $ket =  json_decode(json_encode($query) , true)[0]['tanggal_absen'];
         $tanggal = explode('-', $ket);

         $tanggal = mktime(0,0,0, $tanggal[1], $tanggal[2], $tanggal[0]);
         $now = time();
         if (($tanggal+259200) < $now) {
            $nama = Auth::user()->name;
            date_default_timezone_set("Asia/Jakarta");

            session()->put('status', "$nama, Anda sudah tidak datang lebih dari 3 hari, Harap Hubungi HRD..!!");
            return view('home',['absensi' => $absensi]);

        }}


        // mengirim data absensi ke view index
        return view('home',['absensi' => $absensi]);

    }

    public function izin(Request $request)
    {
        $q = DB::table('permohonan')->insert([
            'nama' => $request['name'],
            'keterangan' => $request['keterangan'],
            'perihal' => $request['perihal'],
            'tanggal' => $request['tanggal'],
            'waktu' => $request['jam'],
            'status' => 'Proses',
        ]);
        if ($q) {
            $nama = $request['name'];
            return redirect('/home')->with('sakit', "$nama, Pengajuan Izin sedang di proses");
        }
        return redirect('/home')->with('sakit', "Maaf Konfirmasi anda gagal");
    }


    public function sakit(Request $request)
    {

        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'upload_gambar';
        $file->move($tujuan_upload,$nama_file);
        

        $q = DB::table('permohonan')->insert([
            'nama' => $request['name'],
            'keterangan' => $request['keterangan'],
            'perihal' => $request['perihal'],
            'tanggal' => $request['tanggal'],
            'waktu' => $request['jam'],
            'file_gambar' => $nama_file,
            'status' => 'Proses',
        ]);
        if ($q) {
            $nama = $request['name'];
            return redirect('/home')->with('sakit', "$nama, Pengajuan Sakit sedang di proses");
        }
        return redirect('/home')->with('sakit', "Maaf Konfirmasi anda gagal");
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
    public function permohonan()
    {
        $permohonan = DB::table('permohonan')->where('nama',Auth::user()->name)
        ->orderBy('tanggal','desc')
        ->paginate(6);


        return view('permohonan',['permohonan'=> $permohonan]);

    }

    public function edit_profile()
    {
        $users = DB::table('users')->where('name',Auth::user()->name)->get();


        return view('edit_profile',['users'=> $users]);

    }
    public function profile()
    {
        $users = DB::table('users')->where('name',Auth::user()->name)->get();


        return view('profile',['users'=> $users]);

    }

    public function update(Request $request)
    {
        DB::table('users')->where('name',Auth::user()->name)->update([
            'name' => $request->nama,
            'email' => $request->email,
            'nip' => '0',
            'password' => Hash::make($request['password']),]);
    // alihkan halaman ke halaman pegawai
        return redirect('/home')->with('sukses', "Update Profile sukses");
    }

    public function absen(Request $request)
    {

        if (Auth::user()->nip == $request['nip']) {

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
                    'nama'=> Auth::user()->name,
                    'id_pegawai' => $idPeg,
                    'tanggal_absen' => $date,
                    'jam_masuk' => $jam,
                    'keterangan' => $request['keterangan']
                ]);
                session()->forget('status');
                return redirect('/home');
            }

        }


        


    }


}else{
   return redirect('/home')->with('status', "Kode Unik anda tidak cocok..!!");
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
    'nama'=> Auth::user()->name,
    'id_pegawai' => $idPeg,
    'tanggal_absen' => $date,
    'jam_masuk' => $jam,
    'keterangan' => "Hadir"
]);

echo "<script>alert('Kamu Berhasil Absen Di jam $jam')</script>";
echo "<script>location='/home';</script>";
}
}
