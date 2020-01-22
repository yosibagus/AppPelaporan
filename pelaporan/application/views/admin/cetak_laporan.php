<?php
$conn = mysqli_connect('localhost', 'root', '', 'pelaporan');
require($_SERVER['DOCUMENT_ROOT'].'/pelaporan/assets/pdf/fpdf.php');

$a = $tgl_awal;
$b = $tgl_akhir;
$q = mysqli_query($conn, "SELECT * from tb_laporan left join tb_kategori on tb_kategori.kd_kat=tb_laporan.kd_kat where tgl_lap between '$a' and '$b'");
$d = mysqli_fetch_array($q);

$pdf = new FPDF("P","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->SetX(1);            
$pdf->Cell(8, 0.8, 'APLIKASI PELAPORAN', 0, 0, 'C');
$pdf->SetFont('Times','',10);
$pdf->SetX(1);
$pdf->Cell(8, 2, '' , 0, 0, 'C');
$pdf->SetFont('Times','U',10);
$pdf->SetX(1);
$pdf->Cell(8, 3, "" , 0, 0, 'C');
$pdf->SetFont('Times','B',10);
$pdf->SetX(1);
$pdf->Cell(30, 0.8, 'Laporan, '.date_format(date_create($a), 'd F Y').' - '.date_format(date_create($b), 'd F Y') , 0, 0, 'C');

$pdf->SetMargins(2,1,1);
$pdf->ln(1);
$pdf->SetFont('Times','B',12);
$pdf->Cell(18,4,"L A P O R A N",0,10,'C');
$pdf->Line(17,4.5,5,4.5);
$pdf->SetMargins(1,1,1);
$pdf->SetFont('Arial','B',7);
$pdf->ln(1);
$pdf->Cell(1, -1.5, 'Kode', 1, 0, 'C');
$pdf->Cell(2, -1.5, 'Tanggal', 1, 0, 'C');
$pdf->Cell(3, -1.5, 'Kategori', 1, 0, 'C');
$pdf->Cell(2.5, -1.5, 'Lokasi', 1, 0, 'C');
$pdf->Cell(3, -1.5, 'Keterangan', 1, 0, 'C');
$pdf->Cell(2.5, -1.5, 'KTP', 1, 0, 'C');
$pdf->Cell(2.5, -1.5, 'Nama', 1, 0, 'C');
$pdf->Cell(2.5, -1.5, 'No Telp', 1, 0, 'C');

$pdf->SetFont('Arial','',7);
$pdf->ln(1);
$no=1;
$qu = mysqli_query($conn, "SELECT * from tb_laporan left join tb_kategori on tb_kategori.kd_kat=tb_laporan.kd_kat where tgl_lap between '$a' and '$b'");
while($da=mysqli_fetch_array($qu)){
	$pdf->Cell(1, -1, $da['kd_lap'], 1, 0, 'C');
	$pdf->Cell(2, -1, date_format(date_create($da['tgl_lap']), 'd/m/Y'), 1, 0, 'C');
	$pdf->Cell(3, -1, $da['nm_kat'], 1, 0, 'C');
	$pdf->Cell(2.5, -1, $da['lokasi_lap'], 1, 0, 'C');
	$pdf->Cell(3, -1, $da['ket_lap'], 1, 0, 'C');
	$pdf->Cell(2.5, -1, $da['ktp_lap'], 1, 0, 'C');
	$pdf->Cell(2.5, -1, $da['nm_lap'], 1, 0, 'C');
	$pdf->Cell(2.5, -1, $da['notelp_lap'], 1, 0, 'C');
	$no++;
	$pdf->ln(1);
}

$pdf->Output("Gudang_bulanan_tanggal_".$a."-".$b.".pdf","I");

?>