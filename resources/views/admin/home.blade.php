@extends('admin.app')
@section('content')
@section('title','Sistem Presensi')
<div class="content">
    <div class="row">
        <div class="container-fluid">
        
        </div>    
    </div>




    

    <script type="text/javascript">

        <?php date_default_timezone_set('Asia/Jakarta'); ?>

        var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
        var clientTime = new Date();
        var Diff = serverTime.getTime() - clientTime.getTime();

        function displayServerTime(){
            var clientTime = new Date();
            var time = new Date(clientTime.getTime() + Diff);
            var sh = time.getHours().toString();
            var sm = time.getMinutes().toString();
            var ss = time.getSeconds().toString();
            document.getElementById("jam").innerHTML = (sh.length==1?"0"+sh:sh);

            document.getElementById("menit").innerHTML = (sm.length==1?"0"+sm:sm);

            document.getElementById("detik").innerHTML = (ss.length==1?"0"+ss:ss);
        }
    </script>
</head>
<body onload="setInterval('displayServerTime()', 1000);">




 <div class="card">
    <div class="card-header">
     <div class="row">
        <div class="form-group col-md-9 right">
          <h4 class="card-title"> Data Presensi</h4>
      </div>
      <div class="input-group col-md-3">

          <form action="/admin/cari_a" method="GET">
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
     <div class="table-responsive-lg">
        <table class="table">
            <thead class="text-primary">
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Keterangan</th>
                 <th colspan="2" class="text-center">Aksi</th>                        </tr>
            </thead>
            <?php 
            $no = 1;
            ?>
            @foreach($absensi as $p)
            <tbody>
                <tr>

                    <th scope="row">{{  $no++ }}</th>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->tanggal_absen }}</td>
                    <td>{{ $p->jam_masuk }}</td>
                    <td>{{ $p->jam_keluar }}</td>
                    <td>{{ $p->keterangan }}</td>

                    <td class="mx-1 px-1"><a href="/admin/edit_p/{{ $p->id_absensi }}" class="btn btn-warning
                        ">Edit</a></td>

                        <td class="mx-1 px-0"><a href="/admin/hapus_p/{{ $p->id_absensi }}" class="btn btn-danger
                            " onclick="return confirm('Anda yakin mau menghapus item ini ?')">Hapus</a>
                        </td>

                    </td>

                </tr>
            </tbody>
            @endforeach
        </table>
        <b>Hal : {{ $absensi->currentPage() }} dari {{$absensi->lastPage()}}</b>
            <div class="float-right">{{ $absensi->links() }}</div>
    </div>
</div>
</div>
</div>
</div>
@endsection
