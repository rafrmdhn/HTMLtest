<?php 
include 'koneksi.php';
$query = "SELECT * FROM datamhs";
$sql = mysqli_query($conn, $query);
$no = 1;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pertemuan 12</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
	<!-- Judul -->
	<div class="container">
		<figure>
			<h1>Data Mahasiswa</h1>
		  	<blockquote class="blockquote">
		    	<p>Data mahasiswa yang ada di dalam database</p>
		  	</blockquote>
		  	<figcaption class="blockquote-footer">
		    	CRUD <cite title="Source Title">Create, Read, Update, Delete</cite>
		  	</figcaption>
		</figure>
		<a class="btn btn-primary" href="tambah.php">Tambah Data</a>
		<!-- table -->
		<div class="table-responsive">
		  <table class="table align-middle">
		    <thead>
		      <tr>
			    <th>No.</th>
			    <th>NPM</th>
			    <th>Nama</th>
			    <th>Jenis Kelamin</th>
			    <th>Foto</th>
			    <th>Alamat</th>
			    <th>Aksi</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php while ($result = mysqli_fetch_assoc($sql)) { ?>
		      <tr>
		      	<td><?=$no++?></td>
			    <td><?=$result['npm']?></td>
			    <td><?=$result['nama']?></td>
			    <td><?=$result['jenis_kelamin']?></td>
			    <td><img src="img/<?=$result['foto']?>" width="120" height="125"></td>
			    <td><?=$result['alamat']?></td>
			    <td>
					<a href="edit.php?id=<?=$result['npm']?>" class="btn btn-warning"> Edit </a>
					<a href="delete.php?id=<?=$result['npm']?>" onclick="return confirm('Apakah anda ingin menghapus data ini?')" class="btn btn-danger">Delete</a>				
			    </td>
		      </tr>
		    	<?php } ?>
		    </tbody>
		  </table>
		</div>
	</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>