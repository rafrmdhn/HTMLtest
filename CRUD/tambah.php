<!DOCTYPE html>
<html>
<head>
	<title>Pertemuan 12</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Tambah Data Mahasiswa
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="npm" class="form-label">NPM</label>
			            <input type="number" class="form-control" id="npm" name="npm">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
			            <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                                <option selected>Pilih jenis kelamin</option>
                                <option value="laki-laki">Laki-Laki</option>
                                <option value="perempuan">Perempuan</option>
				            </select>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat"></textarea>
                    </div>
                    <Button class="btn btn-primary" name="submit">Tambah Data</Button>
                    <a class="btn btn-danger" href="index.php">Kembali</a>
                </form>
            </div>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
	include 'koneksi.php';
		if (isset($_POST['submit'])) {
				$npm = $_POST['npm'];
				$nama = $_POST['nama'];
				$jenis_kelamin = $_POST['jenis_kelamin'];
				$alamat = $_POST['alamat'];
				$foto    = $_FILES['foto']['name'];
				$file_tmp = $_FILES['foto']['tmp_name'];	    
				move_uploaded_file ($file_tmp, "img/".$foto);
				$query = "INSERT INTO datamhs(npm,nama,jenis_kelamin,foto,alamat) Values($npm,'$nama','$jenis_kelamin','$foto','$alamat')";
				if (mysqli_query($conn,$query)) {
					header('Location:index.php');
				}
			}
?>