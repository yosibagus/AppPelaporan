<?php
header("Content-type:application/json");

require_once('connect.php');

if (isset($_GET['key'])) {

	$a = $_GET['key'];
	$q = mysqli_query($conn, "SELECT * from tb_laporan inner join tb_kategori on tb_kategori.kd_kat=tb_laporan.kd_kat where tb_kategori.nm_kat like '%$a%' order by kd_lap desc");
	$response = array();
	while ($d = mysqli_fetch_assoc($q)) {
		array_push($response, 
			array(
				'kd_lap' => $d['kd_lap'],
				'kd_kat' => $d['kd_kat'],
				'nm_kat' => $d['nm_kat'],
				'foto_lap' => $d['foto_lap'],
				'lokasi_lap' => $d['lokasi_lap'],
				'ket_lap' => $d['ket_lap'],
				'ktp_lap' => $d['ktp_lap'],
				'nm_lap' => $d['nm_lap'],
				'notelp_lap' => $d['notelp_lap'],
				'tgl_lap' => $d['tgl_lap']
			)
		);
	}
	
}else {

	$q = mysqli_query($conn, "SELECT * from tb_laporan inner join tb_kategori on tb_kategori.kd_kat=tb_laporan.kd_kat order by kd_lap desc");
	$response = array();
	while ($d = mysqli_fetch_assoc($q)) {
		array_push($response, 
			array(
				'kd_lap' => $d['kd_lap'],
				'kd_kat' => $d['kd_kat'],
				'nm_kat' => $d['nm_kat'],
				'foto_lap' => $d['foto_lap'],
				'lokasi_lap' => $d['lokasi_lap'],
				'ket_lap' => $d['ket_lap'],
				'ktp_lap' => $d['ktp_lap'],
				'nm_lap' => $d['nm_lap'],
				'notelp_lap' => $d['notelp_lap'],
				'tgl_lap' => $d['tgl_lap']
			)
		);
	}

}

echo json_encode($response);
?>