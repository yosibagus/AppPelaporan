<?php
defined('BASEPATH') or exit('No direct Script access allowed');

class M_perpus extends CI_Model {
    function edit_data($where,$table){
      return $this->db->get_where($table,$where);
    }

    function get_data($table){
      return $this->db->get($table);
    }

    public function getAllPelaporan()
    {
      return $this->db->query("SELECT * FROM tb_laporan join tb_kategori on tb_kategori.kd_kat = tb_laporan.kd_kat join tb_user on tb_user.ktp_lap = tb_laporan.ktp_lap ORDER BY tb_laporan.tgl_lap DESC");
    }

    function insert_data($data,$table){
      $this->db->insert($table,$data);
    }

    function update_data($table,$data,$where){
      $this->db->update($table,$data,$where);
    }

    function delete_data($where,$table){
      $this->db->where($where);
      $this->db->delete($table);
    }

    public function getAllUser()
    {
      return $this->db->query('SELECT * FROM tb_user order by tgl_created DESC');
    }

    public function updateStatusUser($status)
    {
      $this->db->query("UPDATE tb_user SET status_akun = 'Active' where ktp_lap='$status'");
    }

    public function updateBlockUser($id)
    {
      $this->db->query("UPDATE tb_user SET status_akun = 'Blocked' where ktp_lap='$id'");
    }
  }
?>