<?php
	include 'koneksi.php';
	$vnpm = '';
	$vnama = '';
	$vjk = '';
	$vfoto = '';
	$valamat = '';

	if(isset($_GET['id'])) {
		$view = "SELECT * FROM datamhs WHERE npm = '$_GET[id]'";
		$tampil = mysqli_query($conn, $view);
		$data = mysqli_fetch_array($tampil);
		if($data) {
			$vnpm = $data['npm'];
			$vnama = $data['nama'];
			$vjk = $data['jenis_kelamin'];
			$vfoto = $data['foto'];
			$valamat = $data['alamat'];
		} else {
			echo "<script>
					alert('Data tidak ditemukan!');
					document.location='index.php';
				</script>";
			exit;
		}
	} else {
		echo "<script>
				alert('ID tidak ditemukan!');
				document.location='index.php';
			</script>";
		exit;
	}
?>
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
			            <input type="number" value="<?=@$vnpm?>" class="form-control" id="npm" name="npm">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
			            <input type="text" value="<?=@$vnama?>" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                                <option selected>Pilih jenis kelamin</option>
                                <option value="laki-laki" <?=@$vjk == 'laki-laki' ? 'selected' : ''?>>Laki-Laki</option>
							    <option value="perempuan" <?=@$vjk == 'perempuan' ? 'selected' : ''?>>Perempuan</option>
						</select>
				            </select>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
						<input type="hidden" name="foto_lama" value="<?=@$vfoto?>">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" placeholder="Input Alamat anda disini!" class="form-control" id="alamat"><?=@$valamat?></textarea>
                    </div>
                    <button class="btn btn-primary" name="submit">Simpan Data</button>
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
    if(isset($_GET['id'])) {
		$id = $_GET['id'];

		if(isset($_POST['submit'])) {
			$npm = $_POST['npm'];
			$nama = $_POST['nama'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$alamat = $_POST['alamat'];
			$foto_lama = $_POST['foto_lama'];

			// Periksa apakah ada file foto yang diupload
			if($_FILES['foto']['name']) {
				if($foto_lama != '') {
					unlink("img/" . $foto_lama);
				}

				// Upload file foto baru
				$foto = $_FILES['foto']['name'];
				$tmp = $_FILES['foto']['tmp_name'];
				move_uploaded_file($tmp, "img/" . $foto);
			} else {
				// Gunakan foto lama jika tidak ada file foto baru diupload
				$foto = $foto_lama;
			}

			$query = "UPDATE datamhs SET npm='$npm', nama='$nama', jenis_kelamin='$jenis_kelamin', alamat='$alamat', foto='$foto' WHERE npm=$id";
			$result = mysqli_query($conn, $query);

			if($result) {
				echo "<script>
						alert('Data berhasil diupdate.');
						window.location.href = 'index.php';
					</script>";
				exit;
			} else {
				echo "<script>
						alert('Data gagal diupdate.');
						window.location.href = 'index.php';
					</script>";
				exit;
			}
		}
	}
?>