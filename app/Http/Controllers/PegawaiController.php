<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
 
class PegawaiController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

    	// mengambil data dari table pegawai
    	$pegawai = DB::table('pegawai')->get();
 
    	// mengirim data pegawai ke view index
    	return view('index',['pegawai' => $pegawai]);
 
    }

    public function tambah()
    {
    	return view('tambah');
    }

    public function store(Request $request)
    {
    	DB::table('pegawai')->insert([
    		'nip' => $request->nip,
    		'nama' => $request->nama,
    		'level' => $request->level]);
    	return redirect('/pegawai');
    }
    // method untuk edit data pegawai
public function edit($id)
{
	// mengambil data pegawai berdasarkan id yang dipilih
	$pegawai = DB::table('pegawai')->where('id_pegawai',$id)->get();
	// passing data pegawai yang didapat ke view edit.blade.php
	return view('edit',['pegawai' => $pegawai]);
 
}
	public function update(Request $request)
{
	// update data pegawai
	DB::table('pegawai')->where('id_pegawai',$request->id)->update([
		'nip' => $request->nip,
    		'nama' => $request->nama,
    		'level' => $request->level]);
	// alihkan halaman ke halaman pegawai
	return redirect('/pegawai');
}
	// method untuk hapus data pegawai
public function hapus($id)
{
	// menghapus data pegawai berdasarkan id yang dipilih
	DB::table('pegawai')->where('id_pegawai',$id)->delete();
		
	// alihkan halaman ke halaman pegawai
	return redirect('/pegawai');
}
}