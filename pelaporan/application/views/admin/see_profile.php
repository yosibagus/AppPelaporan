<?php
$a = $this->session->userdata('id');
$where = array('id_adm' => $a );
$b = $this->M_perpus->edit_data($where, 'tb_admin');
?>
<div class="col-md-6">
	<div class="card" style="box-shadow: 0 0 20px rgba(0,0,0,.5);">
		<div class="card-header">Profile</div>
		<div class="card-body">
			<form action="<?= base_url(); ?>admin/update_profile_act" method="post">
				<div class="form-group">
					<label>Nama</label>
					<input type="hidden" name="id_adm" value="<?= $b->row('id_adm'); ?>">
					<input type="text" name="nm_adm" class="form-control" required autocomplete="off" style="height: 40px; border-radius: 5px;" value="<?= $b->row('nm_adm'); ?>">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email_adm" class="form-control" required autocomplete="off" style="height: 40px; border-radius: 5px;" value="<?= $b->row('email_adm'); ?>">
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username_adm" class="form-control" required autocomplete="off" style="height: 40px; border-radius: 5px;" value="<?= $b->row('username_adm'); ?>">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="text" name="password_adm" class="form-control" required autocomplete="off" style="height: 40px; border-radius: 5px;" value="<?= $b->row('password_adm'); ?>">
				</div>
			
		</div>
		<div class="card-footer">
			<input type="submit" class="btn btn-primary" value="Simpan" style="float: right;">
		</div>
		</form>
	</div>
</div>