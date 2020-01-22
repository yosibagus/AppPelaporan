<div class="card" style="border-radius: 20px; box-shadow: 0 0 20px rgba(0,0,0,.5);">
	<div class="card-header">
		<div class="row">
			<div class="col-md-9">
				<span style="line-height: 35px;"><b>Kategori Laporan</b></span>
			</div>
			<div class="col-md-3">
				<a href="<?= base_url(); ?>admin/tambah_kat" class="btn btn-primary" data-toggle="modal" data-target=".modal-tambah-kategori" style="width: 100%;"><i class="fa fa-plus"></i> Tambah</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
		  <table class="table table-striped table-borderless">
		  	<thead>
		  		<tr align="center">
		  			<th>No</th>
		  			<th>Nama Kategori</th>
		  			<th>Aksi</th>
		  		</tr>
		  	</thead>
		  	<tbody>
		  		<?php $no = 1; ?>
		  		<?php foreach ($kategori as $b): ?>
		  			<tr align="center">
		  				<th><?= $no++; ?></th>
		  				<td><?= $b->nm_kat; ?></td>
		  				<td><img src="<?= base_url(); ?>assets/uploads/<?= $b->img_kat; ?>" width="80" alt=""></td>
		  				<td>
		  					<a href="" class="btn btn-primary" data-toggle="modal" data-target=".modal-edit-kat<?= $b->kd_kat; ?>"><i class="fa fa-edit"></i></a>
		  					<a href="<?php echo base_url().'admin/hapus_kat/'.$b->kd_kat; ?>" class="btn btn-danger" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Hapus" onclick="return confirm('Yakin hapus data?');"><i class="fa fa-trash"></i></a>
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
    <div class="modal fade modal-tambah-kategori" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <div class="modal-title" id="exampleModalLongTitle"><i class="fas fa-book-open"> </i> <b>Tambah Kategori</b></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url().'admin/tambah_kat_act' ?>" method="post" enctype="multipart/form-data">
	            <div class="form-group">
	              <label>Kategori</label>
	              <input type="text" name="nm_kat" class="form-control" autocomplete="off" autofocus required>
	            </div>
	            <div class="form-group">
	              <label>Img Kategoti</label>
	              <input type="file" name="imgkategori" class="form-control" required>
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


<!-- Modal Edit  -->
	<?php foreach ($kategori as $b){ ?>
	    <div class="modal fade modal-edit-kat<?= $b->kd_kat; ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	      <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	          <div class="modal-header">
	            <div class="modal-title" id="exampleModalLongTitle"><i class="fas fa-book-open"> </i><b> Edit Kategori</b></div>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	          <div class="modal-body">
	            <form action="<?= base_url().'admin/update_kat_act'; ?>" method="post" enctype="multipart/form-data">
	              <div class="form-group">
	                <label>Kategori</label>
	                <input type="hidden" name="kd_kat" value="<?php echo $b->kd_kat; ?>">
	                <input type="text" name="nm_kat" class="form-control" value="<?php echo $b->nm_kat; ?>" required>
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