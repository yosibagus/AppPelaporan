<?php
require_once('koneksi.php');
if($_SERVER['REQUEST_METHOD']=='POST') {
  $search = $_POST['search'];
  $ktp_lap = $_POST['ktp'];
  $sql = "SELECT * FROM tb_laporan inner join tb_kategori on tb_kategori.kd_kat = tb_laporan.kd_kat inner join tb_user on tb_user.ktp_lap = tb_laporan.ktp_lap where tb_laporan.ktp_lap = '$ktp_lap' and (tb_kategori.nm_kat like '%$search%' or tb_laporan.tgl_lap like '%$search%' or status_lap like '%$search%') order by tb_laporan.tgl_lap DESC";
  $res = mysqli_query($conn,$sql);
  $result = array();
  while($row = mysqli_fetch_array($res)){
    $result['pelaporan'][] = $row;
  }
  echo json_encode($result);
  mysqli_close($conn);
} 
?>