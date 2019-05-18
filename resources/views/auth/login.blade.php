@extends('auth.app')
@section('title','Sistem Presensi')
@section('content')


<div class="content">
    <div class="row">
        <div class="container">
          <div class="row justify-content-md-center" >
            <div class="col-md-6 col-sm-6">
                <div class="login-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="card shadow-lg">

                          <div class="card-body">
                            <div class="form-group">
                               <label>E-Mail Address</label>
                               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
                           </div>
                           <div class="form-group">
                               <label>Password</label>
                               <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                           </div>
                           <button type="submit" class="btn btn-black col-12">Login</button>

                       </form>
                   </div>

               </div>
           </div>

       </div>
   </div>
   @endsection