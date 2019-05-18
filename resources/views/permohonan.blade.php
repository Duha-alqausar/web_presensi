@extends('layouts.app')
@section('title','Sistem Presensi')
@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Data Permohonan</div>
        <div class="card-body">
          <table class="table table-responsive-lg">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Perihal</th>
                <th>Bukti</th>
               </tr>
              </thead>
              <tbody><?php 
              $no = 1;
              ?>
              @foreach($permohonan as $p)
              <tr>
                <th scope="row">{{$no++}}</th>
                <td>{{$p->nama}}</td>
                <td>{{$p->tanggal}}</td>
                <td>{{$p->waktu}}</td>
                <td> @if( $p->status == "Confirm" )
                    <font color="green"><b>{{$p->status}}<b></font>
                @elseif( $p->status == "Reject" )
                    <font color="red"><b>{{$p->status}}<b></font>
                @endif</td>
                <td>{{$p->keterangan}}</td>
                <td>{{$p->perihal}}</td>
                  @if( $p->file_gambar)
                  <td><a href="{{ url('/upload_gambar/'.$p->file_gambar) }}">Lihat Bukti</a></td>
                  @else
                  <td></td>
                  @endif
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> 
  </div>
  @endsection
