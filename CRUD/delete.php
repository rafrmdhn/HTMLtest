<?php
    include "koneksi.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $query = "DELETE FROM datamhs WHERE npm = $id";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            echo "<script>
                alert('Data berhasil dihapus');
                document.location='index.php';
                </script>";
        }
    } else {
        echo "ID not found.";
    }
?>
