@extends('admin.app')
@section('content')
<div class="content">
    <div class="row">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Register') }}</div>

                        <div class="card-body">
                            @foreach($users as $u)
                            <form method="POST" action="{{route('update')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{($u->id)}}">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="nama" value="{{ ($u->name) }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{($u->email) }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="nip" class="col-md-4 col-form-label text-md-right">{{ __('Kode Unik') }}</label>

                                    <div class="col-md-6">
                                        <input id="nip" type="nip" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ ($u->nip) }}" required autocomplete="nip">

                                        @error('nip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Hak Akses') }}</label>

                                    <div class="col-md-6">
                                        <select name="level"  class="form-control @error('level') is-invalid @enderror" type="level" value="{{ old('level') }}" required autocomplete="level">
                                            <option value="{{ ($u->admin) }}" disabled selected=""></option>
                                            <option value="0">
                                                User
                                            </option>
                                            <option value="1">
                                                Admin
                                            </option>
                                        </select>

                                        @error('level')
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
