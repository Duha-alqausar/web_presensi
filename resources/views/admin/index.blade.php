@extends('admin.app')
@section('title','Sistem Presensi')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Admin Dashboard</div>
<a href="admin/register" class="btn btn-success">Tambah User</a>
        <div class="card-body">
          

          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <table class="table table-responsive">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Kode Unik</th>
                <th scope="col">Level</th>
                <th scope="col" colspan="2" class="text-center">Aksi</th>                        </tr>
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
                <td>{{$p->admin}}</td>

                <td class="mx-1 px-1">
                  <a href="/admin/edit/{{ $p->id }}" class="btn btn-sm btn-warning">Edit</a></td>
                <td class="mx-1 px-0">
                  <a href="/admin/hapus/{{ $p->name }}" class="btn btn-sm btn-danger">Hapus</a>
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
