<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
	

  public function __construct()
    {
        $this->load->database();
    }


    var $table = '';
   






   public function get_all()       
    {
        $this->db->select('a.*, b.name AS user')
        ->from('transaksi a')
        ->join('user b', 'a.user_id = b.id');
        return $this->db->get();
    }


     public function create($data)
    {
        $this->db->insert('transaksi', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }


    public function create_detail($data)
    {
        $this->db->insert_batch('detail_transaksi', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }


    public function get_obat($transaksi_id)
    {
        $this->db->select('b.kode_brg, b.nama_brg, a.jumlah')
        ->from('detail_transaksi a')
        ->join('tbl_barang b', 'a.kode_barang = b.kode_brg')
        ->where('transaksi_id', $transaksi_id);
        return $this->db->get();
    }


   
    public function getByKode($kode)
    {
        return $this->db->get_where('transaksi', ['kode' => $kode])->row();
    }

    public function update($data, $kode)
    {
        $this->db->update('transaksi', $data, ['kode' => $kode]);
        return $this->db->affected_rows() > 0 ? true : false;
    }
    

    
     



}

