<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Absensi;
 
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class AbsensiController extends Controller
{
    public function index()
	{
		$absensi = Absensi::all();
		return view('absensi',['absensi'=>$absensi]);
	}
 
	public function export_excel()
	{
		return Excel::download(new AbsensiExport, 'absensi.xlsx');
	}
}
