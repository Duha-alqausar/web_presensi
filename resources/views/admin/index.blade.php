@extends('admin.app')
@section('title','Sistem Presensi')
@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12">
     <div class="card">
      <div class="card-header">
       <div class="row">
        <div class="form-group col-md-9 right">
          <h4 class="card-title"> Table Users</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="form-group col-md-9 right">
            <a href="/admin/register" class="btn btn-success">Tambah User</a>
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
            </div></div>
            
            


            
            

            

            <table class="table table-responsive-lg">
              <thead class="text-primary">
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>NIP</th>
                  <th>Level</th>
                  <th colspan="2" class="text-center">Aksi</th>                        </tr>
                </thead>
                <tbody><?php 
                $no = 1;
                ?>
                @foreach($users as $p)
                <tr>
                  <th scope="row">{{$no++}}</th>
                  <td>{{$p->name}}</td>
                  <td>{{$p->email}}</td>
                  <td>{{$p->nip}}</td>
                  <td>@if($p->admin == 1)
                          Admin
                        @elseif($p->admin != 1)
                        User
                        @endif
                        </td>

                  <td class="mx-1 px-1">
                    <a href="/admin/edit/{{ $p->id }}" class="btn btn-sm btn-warning">Edit</a>
                  </td>
                  <td class="mx-1 px-0">
                    <a href="/admin/hapus/{{ $p->name }}" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus user ini ?')">Hapus</a>
                  </td>
                </tr>
                @endforeach
                
                
              </table>
            </tbody>
          </div>
          <b>Hal : {{ $users->currentPage() }} dari {{$users->lastPage()}}</b>
            <div class="float-right">{{ $users->links() }}</div>
        </div>
      </div>
    </div> 
  </div>

  @endsection
