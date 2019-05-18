@extends('admin.app')
@section('content')
<div class="content">
    <div class="row">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Edit Absensi') }}</div>

                        <div class="card-body">
                            @foreach($absensi as $u)
                            <form method="POST" action="{{route('update_p')}}">
                                @csrf
                                <input type="hidden" name="id_absensi" value="{{($u->id_absensi)}}">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal') }}</label>

                                    <div class="col-md-6">
                                        <input id="tanggal_absen" type="date('Y-m-d')" class="form-control @error('tanggal_absen') is-invalid @enderror" name="tanggal_absen" value="{{ ($u->tanggal_absen) }}" required autocomplete="tanggal_absen" autofocus>

                                        @error('tanggal_absen')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jam_masuk" class="col-md-4 col-form-label text-md-right">{{ __('Jam Masuk') }}</label>

                                    <div class="col-md-6">
                                        <input id="jam_masuk" type="time" class="form-control @error('jam_masuk') is-invalid @enderror" name="jam_masuk" value="{{($u->jam_masuk) }}" required autocomplete="jam_masuk">

                                        @error('jam_masuk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="jam_keluar" class="col-md-4 col-form-label text-md-right">{{ __('Jam Keluar') }}</label>

                                    <div class="col-md-6">
                                        <input id="jam_keluar" type="time" class="form-control @error('jam_keluar') is-invalid @enderror" name="jam_keluar" value="{{ ($u->jam_keluar) }}" required autocomplete="jam_keluar">

                                        @error('jam_keluar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
