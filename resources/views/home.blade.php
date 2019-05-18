@extends('layouts.app')
@section('title','Sistem Presensi')
@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <div class="row">
                
<div class="col-md-10">
            Dashboard
</div>

<div class="col-md-1">
    
            <div class="btn btn-light"> <span id="jam"><?php print date('H'); ?></span>
            </span> :
            <span id="menit"><?php print date('i'); ?></span> : 
            <span id="detik"><?php print date('s'); ?></span></div> 
            </div>
</div>



        </div>
        <div class="card-body">
            

          <form action="{{route('absen')}}" method='POST' >
        @csrf
        <input type="hidden"  name="nip" value="{{Auth::user()->nip}}" />

        <div class="row justify-content-center">

            <button type="submit" class="btn btn-light" name="keterangan" value="hadir">Hadir</button>

        </form>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#izinModal">
            Izin
        </button>

        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#sakitModal">
            Sakit
        </button></div></div></div></div></div>

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
              <h4 class="card-title"> Table Presensi</h4>
            </div>
            <div class="input-group col-md-3">

              <form action="/admin/cari" method="GET">
                <div class="input-group">
                  <input type="text" value="" name="cari" class="form-control" placeholder="Cari...">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <i class="nc-icon nc-zoom-split"></i>
                    </div>
                  </form>
                </div>
              </div></div></div>


<div class="card-body">
   <div class="table-responsive-lg">
    <table class="table">
        <thead class="text-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Keterangan</th>
                    <th>Option</th>
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




<!-- Modal IZIN-->
<div class="modal fade" id="izinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">IZIN FORM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">

     <form action="{{route('izin')}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus readonly="">

            </div>
        </div>

        <div class="form-group row">
            <label for="keterangan" class="col-md-4 col-form-label text-md-right">{{ __('Keterangan') }}</label>

            <div class="col-md-6">
                <input id="keterangan" type="text" class="form-control" name="keterangan" value="Izin" required autocomplete="keterangan" autofocus readonly="">


            </div>
        </div>


        <div class="form-group row">
            <label for="perihal" class="col-md-4 col-form-label text-md-right">{{ __('perihal') }}</label>

            <div class="col-md-6">
                <textarea class="form-control" id="perihal" name="perihal" autocomplete="perihal" required></textarea>


            </div>
        </div>


        <div class="form-group row">
            <label for="tanggal" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal') }}</label>

            <div class="col-md-6">
                <input id="tanggal" type="text" class="form-control" name="tanggal" value="{{date ('Y-m-d')}}" required autocomplete="tanggal" autofocus readonly="">

            </div>
        </div>

        <div class="form-group row">
            <label for="jam" class="col-md-4 col-form-label text-md-right">{{ __('Jam') }}</label>

            <div class="col-md-6">
                <input id="jam" type="text" class="form-control" name="jam" value="{{date ('H:i:s')}}" required autocomplete="jam" autofocus readonly="">

            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
</div>
</div>
</div>








<!-- Modal IZIN-->
<div class="modal fade" id="sakitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SAKIT FORM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">

     <form action="{{route('sakit')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus readonly="">

            </div>
        </div>

        <div class="form-group row">
            <label for="keterangan" class="col-md-4 col-form-label text-md-right">{{ __('Keterangan') }}</label>

            <div class="col-md-6">
                <input id="keterangan" type="text" class="form-control" name="keterangan" value="Sakit" required autocomplete="keterangan" autofocus readonly="">


            </div>
        </div>


        <div class="form-group row">
            <label for="perihal" class="col-md-4 col-form-label text-md-right">{{ __('Perihal') }}</label>

            <div class="col-md-6">
                <textarea class="form-control" id="perihal" name="perihal" autocomplete="perihal" required></textarea>


            </div>
        </div>

        <div class="form-group row">
            <label for="Bukti" class="col-md-4 col-form-label text-md-right">{{ __('Bukti') }}</label>

            <div class="col-md-6 ml-3">
                <input id="file" type="file" class="form-control" name="file" required >
                <label class="custom-file-label"></label>

            </div>
        </div>


        <div class="form-group row">
            <label for="tanggal" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal') }}</label>

            <div class="col-md-6">
                <input id="tanggal" type="text" class="form-control" name="tanggal" value="{{date ('Y-m-d')}}" required autocomplete="tanggal" autofocus readonly="">

            </div>
        </div>

        <div class="form-group row">
            <label for="jam" class="col-md-4 col-form-label text-md-right">{{ __('Jam') }}</label>

            <div class="col-md-6">
                <input id="jam" type="text" class="form-control" name="jam" value="{{date ('H:i:s')}}" required autocomplete="jam" autofocus readonly="">

            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
</div>
</div>
</div>
@endsection
