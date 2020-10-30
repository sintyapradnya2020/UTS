<?php
    require('../koneksi.php');

    function tampil($query) {
        global $conn;

        $result = mysqli_query($conn, $query);

        $rows = [];

        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    function tambah($data) {
        global $conn;

        $nama = htmlspecialchars($data["nama_konsumen"]);
        $berat = $data["berat"];
        $kategori = htmlspecialchars($data["kategori"]);
        $harga = $data["harga"];
        $total = $berat * $harga;
		$foto = addslashes(file_get_contents($_FILES['gambartxt']['tmp_name']));

        $query = "INSERT INTO transaksi(masuk, keluar, nama_konsumen, berat, kategori, status, harga_satuan, harga_total) VALUES (NOW(), NOW() + INTERVAL 3 DAY, '$nama', $berat, '$kategori', 'Belum diambil', $harga, $total)";
		$query_img = "INSERT INTO `foto` (`id`, `foto`) VALUES ((SELECT max(id) FROM `transaksi`),'$foto')";
        if (mysqli_query($conn, $query)) {
			mysqli_query($conn, $query_img);
		}
		
		return mysqli_affected_rows($conn);
    }

    function ubah($data) {
        global $conn;

        $id = $data["id"];
        $nama = htmlspecialchars($data["nama_konsumen"]);
        $berat = $data["berat"];
        $kategori = htmlspecialchars($data["kategori"]);
        $harga = $data["harga"];
        $total = $berat * $harga;
		$foto = addslashes(file_get_contents($_FILES['gambartxt']['tmp_name']));

        $query = "UPDATE transaksi SET nama_konsumen = '$nama', berat = $berat, kategori = '$kategori', harga_satuan = $harga, harga_total = $total WHERE id = $id";
		$query_img = "UPDATE foto SET foto='$foto' WHERE id=$id";
		if (mysqli_query($conn, $query)) {
			mysqli_query($conn, $query_img);
		}
        return mysqli_affected_rows($conn);
    }

    function hapus($id) {
        global $conn;
        
        mysqli_query($conn, "DELETE FROM transaksi WHERE id = $id");
		mysqli_query($conn, "DELETE FROM foto WHERE id = $id");

        return mysqli_affected_rows($conn);
    }
?>