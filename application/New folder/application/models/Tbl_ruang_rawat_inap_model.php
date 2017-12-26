<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_ruang_rawat_inap_model extends CI_Model
{

    public $table = 'tbl_ruang_rawat_inap';
    public $id = 'kode_ruang_rawat_inap';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('kode_ruang_rawat_inap,nama_gedung,nama_ruangan,kelas,tarif');
        $this->datatables->from('tbl_ruang_rawat_inap');
        //add this line for join
        $this->datatables->join('tbl_gedung_rawat_inap', 'tbl_ruang_rawat_inap.kode_gedung_rawat_inap = tbl_gedung_rawat_inap.kode_gedung_rawat_inap');
        $this->datatables->add_column('action',anchor(site_url('ruangranap/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('ruangranap/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_ruang_rawat_inap');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kode_ruang_rawat_inap', $q);
	$this->db->or_like('kode_gedung_rawat_inap', $q);
	$this->db->or_like('nama_ruangan', $q);
	$this->db->or_like('kelas', $q);
	$this->db->or_like('tarif', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kode_ruang_rawat_inap', $q);
	$this->db->or_like('kode_gedung_rawat_inap', $q);
	$this->db->or_like('nama_ruangan', $q);
	$this->db->or_like('kelas', $q);
	$this->db->or_like('tarif', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Tbl_ruang_rawat_inap_model.php */
/* Location: ./application/models/Tbl_ruang_rawat_inap_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-30 19:44:55 */
/* http://harviacode.com */