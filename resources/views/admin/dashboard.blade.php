 @extends('admin.app')
 @section('content')
 @section('title','Sistem Presensi')
 <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
 <div class="content">
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-badge text-warning"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Users</p>
                <p class="card-title">{{$users}}
                  <p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <hr>
              <a href="/admin">
                <div class="stats">
                  <i class="fa fa-refresh"></i> Update Now
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-body ">
              <div class="row">
                <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-calendar-60 text-success"></i>
                  </div>
                </div>
                <div class="col-7 col-md-8">
                  <div class="numbers">
                    <p class="card-category">Presensi</p>
                    <p class="card-title">{{$absensi}}
                      <p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer ">
                  <hr>
                  <div class="stats">
                    <i class="fa fa-calendar-o"></i> Today
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-body ">
                  <div class="row">
                    <div class="col-5 col-md-4">
                      <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-email-85 text-danger"></i>
                      </div>
                    </div>
                    <div class="col-7 col-md-8">
                      <div class="numbers">
                        <p class="card-category">Permohonan</p>
                        <p class="card-title">
                          {{$permohonan = DB::table('permohonan')->where('tanggal',date('Y-m-d'))->count()}}
                          <p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer ">
                      <hr>
                      <div class="stats">
                        <i class="fa fa-calendar-o"></i>Today
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card ">
                    <div class="card-header ">
                      <h5 class="card-title">User Attendance</h5>
                      <p class="card-category">Today Attendance</p>
                    </div>
                    <div class="card-body ">
                      <div style="width: 800px;margin: 0px auto;">
                        <canvas id="myChart"></canvas>
                      </div>



                    </div>
                    <div class="card-footer ">
                      <hr>
                      <div class="stats">
                        <i class="fa fa-history"></i> Updated 3 minutes ago
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <script>
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: ["Hadir", "Sakit", "Izin", "Tanpa Keterangan"],
                    datasets: [{
                      label: '',
                      data: [
                      <?php 
                      $hadir = DB::table('absensi')
                      ->join('users', 'absensi.id_pegawai', '=', 'users.id')->where('keterangan','Hadir')
                      ->where('tanggal_absen',date('Y-m-d'))->count();
                      echo $hadir;
                      ?>, 
                      <?php 
                      $sakit = DB::table('absensi')
                      ->join('users', 'absensi.id_pegawai', '=', 'users.id')->where('keterangan','Sakit')
                      ->where('tanggal_absen',date('Y-m-d'))->count();
                      echo $sakit;
                      ?>,
                      <?php 
                      $izin = DB::table('absensi')
                      ->join('users', 'absensi.id_pegawai', '=', 'users.id')->where('keterangan','Izin')
                      ->where('tanggal_absen',date('Y-m-d'))->count();
                      echo $izin;
                      ?>,
                      <?php 
                      $jumlah = $users - $absensi;
                      echo $jumlah;
                      ?>



                      ],
                      backgroundColor: [
                      "#6bd098",
                      "#f17e5d",
                      "#fcc468",
                      "#cccccc"
                      ],
                      borderColor: [
                      "#6bd098",
                      "#f17e5d",
                      "#fcc468",
                      "#cccccc"
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    scales: {
                      yAxes: [{
                        ticks: {
                          beginAtZero:true
                        }
                      }]
                    }
                  }
                });
              </script>

              @endsection