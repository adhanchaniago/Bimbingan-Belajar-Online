<?php
class Mo_carierModel extends CI_Model{
	public function getPembayaranAll(){
		$sql = "SELECT * FROM tb_jenispembayaran";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getFilterSuplier($q){
		$sql = "SELECT * FROM tb_supplier where NAMASUPPLIER like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getFilterCustomer($q){
		$sql = "SELECT * FROM tb_customer where NAMACUSTOMER like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getFilterBarang($q){
		$sql = "SELECT * FROM tb_barang where NAMABARANG like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getFilterKursusHarga($q){
		$sql = "SELECT * from tb_bidangstudi where namaBidangStudi like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getFilterHarga($q){
		$sql = "SELECT tb_bidangstudi.*, app_kursus.*, tb_bidangstudi.hargapersesi FROM app_kursus, tb_bidangstudi WHERE app_kursus.tb_bidangStudi_id_bidangStudi = tb_bidangstudi.id_bidangStudi and idapp_kursus='".$q."' ORDER BY idapp_kursus DESC LIMIT 1";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getDataPembelian($data){
		$queryall = $this->db->get('tb_pembelian');
		$sql = "SELECT tb_pembelian.*, tb_supplier.NAMASUPPLIER,tb_jenispembayaran.JENISPEMBAYARAN FROM tb_pembelian inner join tb_supplier on tb_pembelian.IDSUPPLIER=tb_supplier.IDSUPPLIER inner join tb_jenispembayaran on tb_jenispembayaran.IDJENISPEMBAYARAN=tb_pembelian.IDJENISPEMBAYARAN WHERE STATUS_PEMBELIAN='Diajukan' limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
		$data = $query->result();
		$total = $queryall->num_rows();
		$dataRecord = array(
			"RecordsTotal" => $total,
			"RecordsFiltered" => $total,
			"Data" => $data,
		);
		return $dataRecord;
	}
	public function getDataPenjualan($data){
		$queryall = $this->db->get('tb_penjualan');
		$sql = "SELECT tb_penjualan.*, tb_customer.NAMACUSTOMER FROM tb_penjualan inner join tb_customer on tb_penjualan.IDCUSTOMER=tb_customer.IDCUSTOMER WHERE STATUS_PENJUALAN='Diajukan' limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
		$data = $query->result();
		$total = $queryall->num_rows();
		$dataRecord = array(
			"RecordsTotal" => $total,
			"RecordsFiltered" => $total,
			"Data" => $data,
		);
		return $dataRecord;
	}
	public function getDataLogistik($data){
		$queryall = $this->db->get('tb_stok');
		$sql = "SELECT tb_stok.*, tb_barang.NAMABARANG FROM tb_stok inner join tb_barang on tb_stok.KODEBARANG=tb_barang.KODEBARANG limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
		$data = $query->result();
		$total = $queryall->num_rows();
		$dataRecord = array(
			"RecordsTotal" => $total,
			"RecordsFiltered" => $total,
			"Data" => $data,
		);
		return $dataRecord;
	}
	public function insertPembelian($data){
		$query = $this->db->insert('tb_pembelian', $data); 
		return $query;
	}
		public function insertPenjualan($data){
			$query = $this->db->insert('tb_penjualan', $data); 
			return $query;
		}
	public function insertDetailPembelian($data){
		$query = $this->db->insert('tb_detailpembelian', $data); 
		return $query;
	}
		public function insertDetailPenjualan($data){
			$query = $this->db->insert('tb_detailpenjualan', $data); 
			return $query;
		}
		public function insertCarier($data){
			$query = $this->db->insert('tb_pengguna', $data); 
			return $query;
		}
		public function insertDetailCarier($data){
			$query = $this->db->insert('detailCarier', $data); 
			return $query;
		}
	public function insertStok($data){
		$query = $this->db->insert('tb_stok', $data); 
		return $query;
	}
	public function updateStok($data){
		$this->db->where('KODEBARANG',$data['KODEBARANG']); 
		$query=$this->db->update('tb_stok',$data); 
		return $query;
	}
	public function getFilterStok($q){
		$sql = "SELECT * FROM tb_stok where KODEBARANG='" .$q. "'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getPembelian($KODEPEMBELIAN){
		$sql = "SELECT tb_pembelian.*, tb_supplier.NAMASUPPLIER FROM tb_pembelian inner join tb_supplier on tb_supplier.IDSUPPLIER=tb_pembelian.IDSUPPLIER WHERE KODEPEMBELIAN='$KODEPEMBELIAN' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getPenjualan($KODEPENJUALAN){
		$sql = "SELECT tb_penjualan.*, tb_customer.NAMACUSTOMER FROM tb_penjualan inner join tb_customer on tb_customer.IDCUSTOMER=tb_penjualan.IDCUSTOMER WHERE KODEPENJUALAN='$KODEPENJUALAN' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getDetilPembelian($KODEPEMBELIAN){
		$sql = "SELECT * FROM tb_detailpembelian inner join tb_barang on tb_barang.KODEBARANG=tb_detailpembelian.KODEBARANG WHERE KODEPEMBELIAN='$KODEPEMBELIAN' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getDetilPenjualan($KODEPENJUALAN){
		$sql = "SELECT * FROM tb_detailpenjualan inner join tb_barang on tb_barang.KODEBARANG=tb_detailpenjualan.KODEBARANG WHERE KODEPENJUALAN='$KODEPENJUALAN' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function updatePembelian($data){
		$this->db->where('KODEPEMBELIAN',$data['KODEPEMBELIAN']); 
		$query=$this->db->update('tb_pembelian',$data); 
		return $query;
	}

	public function showbyIdSiswa($id){
		$sql = "SELECT * from tb_pengguna WHERE tb_role_roleId='3' and  penggunaId='$id' ";
		$data = $this->db->query($sql)->row_array();
		return $data;
	}
	public function showbyidBidStudi($bidangStudi){
		$sql = "SELECT * from tb_bidangstudi WHERE namaBidangStudi='$bidangStudi' ";
		$data = $this->db->query($sql)->row_array();
		return $data;
	}


	public function getDataKursus($data){
		$queryall = $this->db->get('app_kursus');
		$sql = "SELECT app_kursus.* FROM app_kursus WHERE idapp_kursus=idapp_kursus limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
		$data = $query->result();
		$total = $queryall->num_rows();
		$dataRecord = array(
			"RecordsTotal" => $total,
			"RecordsFiltered" => $total,
			"Data" => $data,
		);
		return $dataRecord;
	}

}
?>