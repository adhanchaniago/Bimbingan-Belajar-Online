<?php
class M_importExcel extends CI_Model
{
	function select()
	{
		$this->db->order_by('KODEKATEGORI', 'DESC');
		$query = $this->db->get('tb_kategori');
		return $query;
	}

	function insert($data)
	{
		$this->db->insert_batch('tb_kategori', $data);
	}
}