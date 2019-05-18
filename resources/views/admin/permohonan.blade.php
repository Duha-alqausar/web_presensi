@extends('admin.app')
@section('title','Sistem Presensi')
@section('content')
<div class="content">
  <div class="row">
    <div class="container">

          
             <div class="card">
            <div class="card-header">
               <div class="row">
            <div class="form-group col-md-9 right">
              <h4 class="card-title"> Data Permohonan</h4>
            </div>
            <div class="input-group col-md-3">

              <form action="/admin/cari_p" method="GET">
                <div class="input-group">
                  <input type="text" value="" name="cari" class="form-control" placeholder="Cari...">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <i class="nc-icon nc-zoom-split"></i>
                    </div>
                  </form>
                </div>
              </div></form></div></div>
            <div class="card-body">


              @if (session('status'))
              <div class="alert alert-warning" role="alert">
                {{ session('status') }}
              </div>
              @endif

             <div class="card-body">
   <div class="table-responsive-lg">
    <table class="table">
        <thead class="text-primary">
                  <tr>
                    <th>No.</th>
                    <th >Nama</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Perihal</th>
                    <th>Bukti</th>
                    <th colspan="2" class="text-center">Aksi</th>                        </tr>
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
                      <font color="green"><b>{{$p->status}}</b></font>
                        @elseif( $p->status == "Reject" )
                        <font color="red"><b>{{$p->status}}</b></font>
                        @endif</td>
                        <td>{{$p->keterangan}}</td>
                        <td>{{$p->perihal}}</td>
                        @if( $p->file_gambar)
                        <td><a href="{{ url('/upload_gambar/'.$p->file_gambar) }}">Lihat Bukti</a></td>
                        @else
                        <td></td>
                        @endif
                      </td>


                      <td class="mx-1 px-1">
                        <a href="/admin/konfirmasi/{{ $p->id }}" class="btn btn-sm btn-success">Konfirmasi</a></td>
                        <td class="mx-1 px-0">
                          <a href="/admin/batal/{{ $p->id }}" class="btn btn-sm btn-danger">Tolak</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                     </div>
                  </table>
          <b>Hal : {{ $permohonan->currentPage() }} dari {{$permohonan->lastPage()}}</b>
          <div class="float-right">{{ $permohonan->links() }}</div>
                </div>
              </div>
            </div>
          </div> 
        </div>
        @endsection
