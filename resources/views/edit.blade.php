<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Edit Pegawai</h3>
	
	<a href="/pegawai"> Kembali</a>
	
	<br/>
	<br/>
	
	@foreach($pegawai as $p)
	<form action="/pegawai/update" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $p->id_pegawai }}"> <br/>
		Nip <input type="number" required="required" name="nip" value="{{ $p->nip }}"> <br/>
		Nama <input type="text" required="required" name="nama" value="{{ $p->nama }}"> <br/>
		Level <input type="number" required="required" name="level" value="{{ $p->level }}"> <br/>
		<input type="submit" value="Simpan Data">
	</form>
	@endforeach
</body>
</html>