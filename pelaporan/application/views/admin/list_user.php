<div class="card" style="border-radius: 20px; box-shadow: 0 0 20px rgba(0,0,0,.5);">
	<div class="card-header">
		<div class="row">
			<div class="col-md-9">
				<span style="line-height: 35px;"><b>Data User</b></span>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="myTable">
				<thead>
					<tr align="center">
						<th>#</th>
						<th>No KTP</th>
						<th>Nama</th>
						<th>Scan KTP</th>
						<th>No Telp</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach ($user as $get): ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $get['ktp_lap']; ?></td>
							<td><?= $get['nm_lap']; ?></td>
							<td><img src="<?= base_url(). substr($get['scan_ktp'], 3); ?>" alt="" width="100"></td>
							<td><?= $get['notelp_lap']; ?></td>
							<td><?= $get['status_akun']; ?></td>
							<td>
								<?php if ($get['status_akun'] == "Pending" || $get['status_akun'] == "Blocked"): ?>
									<a href="<?= base_url(); ?>Admin/updateStatusUser/<?= $get['ktp_lap']; ?>" class="badge badge-success">Activasi</a>
								<?php else : ?>
									<a href="<?= base_url(); ?>Admin/updateBlockUser/<?= $get['ktp_lap']; ?>" class="badge badge-danger">Blocked</a>
								<?php endif ?>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
