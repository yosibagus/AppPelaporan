<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller{
  function __construct(){
    parent::__construct();
    if($this->session->userdata('status') != "login"){
      redirect(base_url().'welcome');
    }
  }

  function index(){
    $this->load->view('admin/header');
    $this->load->view('admin/index');
    $this->load->view('admin/footer');
  }

  function grafik(){
    $this->load->view('admin/header');
    $this->load->view('admin/grafik');
    $this->load->view('admin/footer');
  }

  function cetak_laporan(){
    $data['tgl_awal'] = $this->input->post('tgl_awal');
    $data['tgl_akhir'] = $this->input->post('tgl_akhir');
    $this->load->view('admin/cetak_laporan', $data);
  }

  function see_profile(){
    $this->load->view('admin/header');
    $this->load->view('admin/see_profile');
    $this->load->view('admin/footer');
  }

  function update_profile_act(){
    $a = $this->input->post('id_adm');
    $b = $this->input->post('nm_adm');
    $c = $this->input->post('email_adm');
    $d = $this->input->post('username_adm');
    $e = $this->input->post('password_adm');
    $where = array('id_adm' => $a);
    $data = array(
      'nm_adm' => $b,
      'email_adm' => $c,
      'username_adm' => $d,
      'password_adm' => $e
    );
    $this->M_perpus->update_data('tb_admin',$data,$where);
    redirect(base_url().'admin/see_profile');
  }

  function kategori(){
    $data['kategori'] = $this->M_perpus->get_data('tb_kategori')->result();
    $this->load->view('admin/header');
    $this->load->view('admin/kategori', $data);
    $this->load->view('admin/footer');
  }

  function tambah_kat_act(){
    $foto = $_FILES['imgkategori']['name'];
    $namaKategori = $this->input->post('nm_kat');

    if ($foto) {
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']  = '2048';

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('imgkategori')) {
          $namefoto = $this->upload->data('file_name');
        }
        else {
          echo $this->upload->display_errors();
        }
    }

    $data = array(
      'kd_kat' => null,
      'nm_kat' => $namaKategori,
      'img_kat' => $namefoto
    );
    $this->M_perpus->insert_data($data,'tb_kategori');
    redirect(base_url().'admin/kategori');
  }

  function update_kat_act(){
    $a = $this->input->post('kd_kat');
    $b = $this->input->post('nm_kat');
    $where = array('kd_kat' => $a);
    $data = array(
      'nm_kat' => $b
    );
    $this->M_perpus->update_data('tb_kategori',$data,$where);
    redirect(base_url().'admin/kategori');
  }

  function hapus_kat($id){
    $where = array('kd_kat' => $id);
    $this->M_perpus->delete_data($where,'tb_kategori');
    redirect(base_url().'admin/kategori');
  }

  function laporan(){
    // $data['kategori'] = $this->M_perpus->get_data('tb_kategori')->result();
    // $this->db->join('tb_kategori', 'tb_laporan.kd_kat=tb_kategori.kd_kat');
    // $data['laporan'] = $this->M_perpus->get_data('tb_laporan')->result();

    $data['laporan'] = $this->M_perpus->getAllPelaporan()->result();


    $this->load->view('admin/header');
    $this->load->view('admin/laporan', $data);
    $this->load->view('admin/footer');
  }

  function tambah_lap_act(){
    $config['upload_path'] = './assets/upload/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size'] = '2048';
    $config['file_name'] = 'gambar'.time();
    $this->load->library('upload',$config);
    $this->upload->do_upload('foto_lap');
    $image = $this->upload->data();


    $a = $this->input->post('kd_kat');
    $b = $this->input->post('lokasi_lap');
    $c = $this->input->post('ket_lap');
    $d = $this->input->post('ktp_lap');
    $e = $this->input->post('nm_lap');
    $f = $this->input->post('notelp_lap');
    // $g = $this->input->post('tgl_lap');
    $h = $this->input->post('status_lap');
    $data = array(
      'kd_lap' => null,
      'kd_kat' => $a,
      'foto_lap' => $image['file_name'],
      'lokasi_lap' => $b,
      'ket_lap' => $c,
      'ktp_lap' => $d,
      'nm_lap' => $e,
      'notelp_lap' => $f,
      'tgl_lap' => '',
      'status_lap' => $h
    );
    $this->M_perpus->insert_data($data,'tb_laporan');
    redirect(base_url().'admin/laporan');
  }

  function update_lap_act(){
    $a = $this->input->post('kd_lap');
    $i = $this->input->post('status_lap');
    $where = array('kd_lap' => $a);
    $data = array(
      'status_lap' => $i
    );
    $this->M_perpus->update_data('tb_laporan',$data,$where);
    redirect(base_url().'admin/laporan');
  }

  function hapus_lap($id){
    $where = array('kd_lap' => $id);
    $this->M_perpus->delete_data($where,'tb_laporan');
    redirect(base_url().'admin/laporan');
  }

  public function listuser()
  {
    $data['user'] = $this->M_perpus->getAllUser()->result_array();
    $this->load->view('admin/header');
    $this->load->view('admin/list_user', $data);
    $this->load->view('admin/footer');
  }

  public function updateStatusUser($status)
  {
    $this->M_perpus->updateStatusUser($status);
    redirect(base_url().'admin/listuser');
  }

  public function updateBlockUser($id)
  {
    $this->M_perpus->updateBlockUser($id);
    redirect(base_url().'admin/listuser');
  }

  function logout(){
    $this->session->sess_destroy();
    redirect(base_url().'welcome');
  }
}