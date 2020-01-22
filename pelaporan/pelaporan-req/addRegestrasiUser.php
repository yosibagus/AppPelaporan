<?php 

include 'koneksi.php';

if ($conn) {
	$ktp = $_POST['noktp'];
	$password = $_POST['password'];
	$nama = $_POST['nama'];
	$notelp = $_POST['notelp'];
	$status = "Pending";
	$image = $_POST['scan_ktp'];
	$tgl = date('d-m-y h:i:s');

	$date = date('dmy-his');
	$upload_path = '../assets/uploads/ktp/' . $date . '.jpg';

	$insert = mysqli_query($conn, "INSERT INTO tb_user values('$ktp', '$password', '$upload_path', '$nama', '$notelp', '$status', '$tgl')");
	if ($insert) {
		file_put_contents($upload_path, base64_decode($image));
		echo json_encode(array('response' => "success ..."));
	}
	else {
		echo json_encode(array('response' => "gagal ..."));
	}
}