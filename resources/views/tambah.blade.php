@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2>Data Pegawai</h2>
	<a href="/pegawai">Kembali</a>
	<br><br>

	<form action="/pegawai/store" method="post">
		{{csrf_field()}}
		NIP <input class="number" name="nip" required="required"></p>
		Nama <input type="text" name="nama" required="required"></p>
		Level<input type="number" name="level" required="required"></p>
		<input type="submit" name="simpan" value="Simpan Data">
	</form>
</body>
</html>
@endsection