<div class="card" style="border-radius: 20px; box-shadow: 0 0 20px rgba(0,0,0,.5);">
	<div class="card-header">
		<div class="row">
			<div class="col-md-5">
				<span style="line-height: 35px;"><b>Laporan</b></span>
			</div>
			<div class="col-md-7">
				<a href="" class="btn btn-primary" data-toggle="modal" data-target=".modal-cetak-laporan" style="width: 100%;"><i class="fa fa-print"></i> Cetak Laporan</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
		  <table class="table table-striped table-bordered" id="myTable">
		  	<thead>
		  		<tr align="center">
		  			<th>No</th>
		  			<th>Kategori</th>
		  			<th>Tanggal</th>
		  			<th>Lokasi</th>
		  			<th>Status</th>
		  			<th>Aksi</th>
		  		</tr>
		  	</thead>
		  	<tbody>
		  		<?php $no = 1; ?>
		  		<?php foreach ($laporan as $b): ?>
		  			<tr align="center">
		  				<th><?= $no++; ?></th>
		  				<td><?= $b->nm_kat; ?></td>
		  				<td><?= date("d-m-Y", strtotime($b->tgl_lap)); ?></td>
		  				<td><?= $b->lokasi_lap; ?></td>
		  				<td><?= $b->status_lap; ?></td>
		  				<td>
		  					<a href="" class="badge badge-primary" data-toggle="modal" data-target=".modal-det-lap<?= $b->kd_lap; ?>"><i class="fa fa-search" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Detail"></i></a>
		  					<a href="" class="badge badge-primary" data-toggle="modal" data-target=".modal-edit-lap<?= $b->kd_lap; ?>"><i class="fa fa-edit" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Edit"></i></a>
		  					<a href="<?php echo base_url().'admin/hapus_lap/'.$b->kd_lap; ?>" class="badge badge-danger" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Hapus" onclick="return confirm('Yakin hapus data?');"><i class="fa fa-trash"></i></a>
		  				</td>
		  			</tr>
		  		<?php endforeach ?>
		  	</tbody>
		  </table>
		</div>
	</div>
</div>



			</div>
          </div>
        </div>
      </section>
    </main>

<!-- Modal Tambah -->
    <div class="modal fade modal-tambah-laporan" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <div class="modal-title" id="exampleModalLongTitle"><i class="fas fa-book-open"> </i> <b>Tambah Laporan</b></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url().'admin/tambah_lap_act' ?>" method="post" enctype="multipart/form-data">
	            <div class="row">
	            	<div class="col-md-6">
	            		<div class="form-group">
			              <label>Kategori</label>
			              <select name="kd_kat" autofocus required class="form-control">
			              	<?php foreach ($kategori as $k) { ?>
			                    <option value="<?php echo $k->kd_kat; ?>"><?php echo $k->nm_kat; ?></option>
			                  <?php } ?>
			              </select>
			            </div>
			            <div class="form-group">
			            	<label>Foto</label>
			            	<input type="file" name="foto_lap" required class="form-control">
			            </div>
			            <div class="form-group">
			            	<label>Lokasi</label>
			            	<input type="text" name="lokasi_lap" required autocomplete="off" class="form-control">
			            </div>
			            <div class="form-group">
			            	<label>Keterangan</label>
			            	<input type="text" name="ket_lap" required autocomplete="off" class="form-control">
			            </div>
	            	</div>
	            	<div class="col-md-6">
			            <div class="form-group">
			            	<label>KTP</label>
			            	<input type="text" name="ktp_lap" required autocomplete="off" class="form-control">
			            </div>
			            <div class="form-group">
			            	<label>Nama Pelapor</label>
			            	<input type="text" name="nm_lap" required autocomplete="off" class="form-control">
			            </div>
			            <div class="form-group">
			            	<label>Notelp</label>
			            	<input type="text" name="notelp_lap" required autocomplete="off" class="form-control">
			            </div>
			            <div class="form-group">
			            	<label>Status</label>
			            	<select name="status_lap" class="form-control" required>
			            		<option value="">-- Pilih --</option>
			            		<option value="Diterima">Diterima</option>
			            		<option value="Ditolak">Ditolak</option>
			            		<option value="Dalam Proses">Dalam Proses</option>
			            		<option value="Selesai">Selesai</option>
			            	</select>
			            </div>
	            	</div>
	            </div>
	            <div class="modal-footer"> 
	              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
	              <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
	            </div>
	          </div>
          </form>
        </div>
      </div>
    </div>
<!-- Modal Tambah -->


<!-- Modal Detail  -->
	<?php foreach ($laporan as $b){ ?>
	    <div class="modal fade modal-det-lap<?= $b->kd_lap; ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	      <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	          <div class="modal-header">
	            <div class="modal-title" id="exampleModalLongTitle"><i class="fas fa-book-open"> </i><b> Detail Laporan</b></div>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	          <div class="modal-body">
	            <div class="card">
				  <div class="row no-gutters">
				    <div class="col-md-4">
				      <img src="<?= base_url(). substr($b->foto_lap, 3); ?>" class="card-img" alt="" style="height: 100%;">
				    </div>
				    <div class="col-md-8">
				      <div class="card-body">
				        <h5 class="card-title"><?= $b->nm_kat; ?></h5>
				        <p class="card-text">
				        	<table>
				        		<tr>
				        			<td>Lokasi</td>
				        			<td>:</td>
				        			<td><?= $b->lokasi_lap; ?></td>
				        		</tr>
				        		<tr>
				        			<td>Keterangan</td>
				        			<td>:</td>
				        			<td><?= $b->ket_lap; ?></td>
				        		</tr>
				        		<tr>
				        			<td>KTP</td>
				        			<td>:</td>
				        			<td><?= $b->ktp_lap; ?></td>
				        		</tr>
				        		<tr>
				        			<td>Nama Pelapor</td>
				        			<td>:</td>
				        			<td><?= $b->nm_lap; ?></td>
				        		</tr>
				        		<tr>
				        			<td>Notelp</td>
				        			<td>:</td>
				        			<td><?= $b->notelp_lap; ?></td>
				        		</tr>
				        	</table>
				        </p>
				        <p class="card-text"><small class="text-muted">Tanggal <?= date("d F Y", strtotime($b->tgl_lap)); ?></small></p>
				      </div>
				    </div>
				  </div>
				</div>
	          </div>
	        </div>
	      </div>
	    </div>
    <?php } ?>
<!-- Modal Detail -->

<!-- Modal Edit  -->
	<?php foreach ($laporan as $b){ ?>
	    <div class="modal fade modal-edit-lap<?= $b->kd_lap; ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	      <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	          <div class="modal-header">
	            <div class="modal-title" id="exampleModalLongTitle"><i class="fas fa-book-open"> </i><b> Edit Kategori</b></div>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	          <div class="modal-body">
	            <form action="<?= base_url().'admin/update_lap_act'; ?>" method="post" enctype="multipart/form-data">
	              <div class="row">
	            	<div class="col-md-6">
	            		<input type="hidden" class="form-control" name="kd_lap" value="<?= $b->kd_lap; ?>">
			            <div class="form-group">
			            	<label>Status</label>
			            	<select name="status_lap" class="form-control" required>
			            		<option value="">-- Pilih --</option>
			            		<option value="Diterima" <?php if ($b->status_lap == 'Diterima') {echo "selected";} ?>>Diterima</option>
			            		<option value="Ditolak" <?php if ($b->status_lap == 'Ditolak') {echo "selected";} ?>>Ditolak</option>
			            		<option value="Dalam Proses" <?php if ($b->status_lap == 'Dalam Proses') {echo "selected";} ?>>Dalam Proses</option>
			            		<option value="Selesai" <?php if ($b->status_lap == 'Selesai') {echo "selected";} ?>>Selesai</option>
			            	</select>
			            </div>
	            	</div>
	            </div>

	              <div class="modal-footer"> 
		              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
		              <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
		            </div>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
    <?php } ?>
<!-- Modal Edit -->


<!-- Modal Cetak  -->
	<div class="modal fade modal-cetak-laporan" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <div class="modal-title" id="exampleModalLongTitle"><i class="fas fa-book-open"> </i><b> Cetak Laporan</b></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url().'admin/cetak_laporan'; ?>" method="post" enctype="multipart/form-data">
              <div class="row">
            	<div class="col-md-6">
            		<div class="form-group">
		            	<label>Tanggal Awal</label>
		            	<input type="date" name="tgl_awal" required autocomplete="off" class="form-control">
		            </div>
            	</div>
            	<div class="col-md-6">
            		<div class="form-group">
		            	<label>Tanggal Akhir</label>
		            	<input type="date" name="tgl_akhir" required autocomplete="off" class="form-control">
		            </div>
            	</div>
            </div>

              <div class="modal-footer"> 
	              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
	              <input type="submit" value="Cetak" class="btn btn-primary btn-sm">
	            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<!-- Modal Cetak -->