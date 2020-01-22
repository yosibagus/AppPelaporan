<?php 

include 'koneksi.php';

if ($conn) {
	$ktp = $_POST['noktp'];
	$password = $_POST['password'];

	$response = array();
	$chek = mysqli_query($conn, "SELECT * FROM tb_user where ktp_lap = '$ktp' and password = '$password'");
	$chekNums = mysqli_num_rows($chek);
	$ambilrow = mysqli_fetch_array($chek);

	if ($chekNums > 0) {
		$response["error"] = false;
		$response["message"] = "Berhasil Login";
		$response["nm_lap"] = $ambilrow['nm_lap'];
		$response["ktp_lap"] = $ambilrow['ktp_lap'];
		$response["status_akun"] = $ambilrow['status_akun'];
		$response["nomertelp"] = $ambilrow['notelp_lap'];
		echo json_encode($response);
	}
	else {
		$response["error"] = true;
		$response["message"] = "username or password invalid";
		echo json_encode($response);
	}

}

