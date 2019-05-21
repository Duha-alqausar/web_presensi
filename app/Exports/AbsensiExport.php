<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class AbsensiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

    	$data = DB::table('absensi')
    ->join('users', 'absensi.id_pegawai', '=', 'users.id')->select('name','tanggal_absen','jam_masuk','jam_keluar','keterangan')->orderBy('tanggal_absen','desc')
    ->get();
        return $data;

    }
}
