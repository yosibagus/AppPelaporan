<?php 

include 'koneksi.php';
$pelaporan = array();

if (isset($_GET['ktp_lap'])) {
	$ktp_lap = $_GET['ktp_lap'];

	$sql = "SELECT * FROM tb_laporan inner join tb_kategori on tb_kategori.kd_kat = tb_laporan.kd_kat inner join tb_user on tb_user.ktp_lap = tb_laporan.ktp_lap where tb_laporan.ktp_lap = '$ktp_lap' order by tb_laporan.tgl_lap desc";
	$res = mysqli_query($conn,$sql);
	$chek = mysqli_num_rows($res);

	if ($chek > 0) {

		$pelaporan["error"] = false;
		$pelaporan["message"] = "Berhasil mendapatkan data laporan";

		while($row = mysqli_fetch_object($res)){
			$pelaporan['pelaporan'][] = $row;
		}
		echo json_encode($pelaporan);

	} else {
		$pelaporan["error"] = true;
		$pelaporan["message"] = "data kosong";
		echo json_encode($pelaporan);
	}

} else {
	$pelaporan["error"] = true;
	$pelaporan["message"] = "Tidak ada data";
	echo json_encode($pelaporan);
}
