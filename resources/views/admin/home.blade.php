@extends('admin.app')
@section('content')
@section('title','Sistem Presensi')
<div class="container-fluid">
   @if (session('status'))
   <div class="container alert text-center">
    <div class="alert alert-danger" role="alert">
        <strong> Warning! </strong></p> {{ session('status') }}
    </div>
    @endif
</div>    
</div>




<div class="container bg-form-absen absen">
    <h4 class="pt-3">Absen</h4>
    <form action="{{route('absen')}}" method='POST' >
        @csrf
        <div class="row">
            <div class="form-group col-md-10">

                <input type="password" class="form-control" name="nip" id="Kode Unik" placeholder="Masukkan Kode Unik" required oninvalid="this.setCustomValidity('Isi kolom kode unik dengan Benar')" />
            </div>
            <div class="col-sm-2 text-center">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </div>
    </form>
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
               
               


   <div class="container daftar-tabel mt-3">
            <div class="row">
                <div class="col-sm-10">
                    <h5 class="mt-2">Daftar Absen</h5>
                </div>
                <div class="col-sm-2 waktu mt-1">
                    <div class="btn btn-light disabled"> <span id="jam"><?php print date('H'); ?></span>
</span></div>
                    <div class="btn btn-light disabled"><span id="menit"><?php print date('i'); ?></span></div>
                    <div class="btn btn-light disabled"><span id="detik"><?php print date('s'); ?></span></div>
                </div>
            </div>
        </div>

    <div class="ml-1">
            <div class="container table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam Masuk</th>
                            <th scope="col">Jam Keluar</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Option</th>
                        </tr>
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
            <td><a href="/home/keluar/{{ $p->id_absensi }}" class="btn btn-danger
                @if( Auth::user()->name != $p->name )
                    disabled
                @elseif( $p->tanggal_absen != date ('Y-m-d') )
                    disabled
                @endif
                ">Keluar</a></td>

        </td>

    </tr>
    </tbody>
    @endforeach
</table>
</div>
</div>
</div>
</div>
</div>
@endsection
