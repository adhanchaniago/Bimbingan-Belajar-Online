<?php
class LogistikTransModel extends CI_Model{
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

	public function getFilterTentor($q){
		$sql = "SELECT tb_pengguna.penggunaId as idTentor, tb_pengguna.namaDepan as Tentor, tb_pengguna.namaBelakang, tb_role.nama as role, tb_pengguna.guruMapel, tb_pengguna.tb_kategori_kategoriId, tb_pengguna.`status`
		FROM tb_pengguna INNER JOIN tb_role on tb_pengguna.tb_role_roleId=tb_role.roleId
		where tb_pengguna.`status`='aktif' and tb_role.nama='guru' and tb_pengguna.namaDepan like '%" .$q. "%' LIMIT 10";
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

	/* filter data kodeDetailKursus  */
	public function getFilterKodeDetailKursus($q){
		$sql = "SELECT dk.kodeDetailKursus,dk.kodeKursus,
		dk.idBidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi FROM tb_bidangstudi where tb_bidangstudi.id_bidangStudi=dk.idBidangStudi) as BidangStudi,
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dk.idTentor) as Tentor,
		ak.idSiswa, tp.namaDepan as Siswa, tp.namaBelakang as namaBelakangSiswa
		FROM detailkursus as dk
		INNER JOIN app_kursus as ak on ak.idapp_kursus=dk.kodeKursus
		INNER JOIN tb_pengguna as tp on ak.idSiswa=tp.penggunaId
		where tp.namaDepan like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getFilterBarangHarga($q){
		$sql = "SELECT * FROM tb_barang inner join hargabarang on tb_barang.KODEBARANG=hargabarang.KODEBARANG where NAMABARANG like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getFilterHarga($q){
		$sql = "SELECT * FROM hargabarang where KODEBARANG='" .$q. "' ORDER BY TGLINPUTHARGA DESC LIMIT 1";
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
	/* from table detailKursus */
	public function getDataDetailKursus($data){
		$queryall = $this->db->get('tb_pembelian');
		$sql = "SELECT dk.kodeDetailKursus, dk.kodeKursus,
		dk.idBidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi FROM tb_bidangstudi where tb_bidangstudi.id_bidangStudi=dk.idBidangStudi) as BidangStudi,
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dk.idTentor) as Tentor,
		ak.idSiswa,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=ak.idSiswa) as Siswa,
		dk.jumlahSesi,
		dk.statusKursus
		FROM detailkursus AS dk INNER JOIN app_kursus as ak on ak.idapp_kursus=dk.kodeKursus
		limit ".$data["start"].",".$data['length'];
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


	/*  detail Jadwal from kursus */
	public function getDataJadwalKursus($data){
		$queryall = $this->db->get('detailjadwal');

		$sql = " SELECT dj.idUnix,
		dj.kodeDetailKursus_detailKursus,
		dj.kodeKursus, dj.idBidangStudi_bidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi FROM tb_bidangstudi where tb_bidangstudi.id_bidangStudi=dj.idBidangStudi_bidangStudi) as BidangStudi,
		dj.idTentor_detailKursus,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dj.idTentor_detailKursus) as Tentor,
		dj.idSiswa_appKursus,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dj.idSiswa_appKursus) as Siswa,
		dj.hari, dj.jam, dj.tglinsert
		FROM detailjadwal AS dj limit ".$data["start"].",".$data['length'];
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

	/* insert detailJadwal  */
	public function insertDetailJadwal($data){
		$query = $this->db->insert('detailJadwal', $data); return $query;
	}

	public function insertDetailPenjualan($data){
		$query = $this->db->insert('tb_detailpenjualan', $data); 
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
	public function updateDetailKursus($data){
		$this->db->where('kodeKursus',$data['kodeKursus']);
		$this->db->where('idBidangStudi',$data['idBidangStudi']); 
		$query=$this->db->update('detailkursus',$data);
		return $query;
	}
	public function getFilterStok($q){
		$sql = "SELECT * FROM tb_stok where KODEBARANG='" .$q. "'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	/*----------------------*/
	public function getPembelian($KODEPEMBELIAN){
		$sql = "SELECT tb_pembelian.*, tb_supplier.NAMASUPPLIER FROM tb_pembelian inner join tb_supplier on tb_supplier.IDSUPPLIER=tb_pembelian.IDSUPPLIER WHERE KODEPEMBELIAN='$KODEPEMBELIAN' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getDetailKursus($KodeDetailKursus){
		$sql = "
		SELECT dk.kodeDetailKursus, dk.kodeKursus,
		dk.idBidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi FROM tb_bidangstudi where tb_bidangstudi.id_bidangStudi=dk.idBidangStudi) as BidangStudi,
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dk.idTentor) as Tentor,
		ak.idSiswa,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=ak.idSiswa) as Siswa,
		dk.statusKursus FROM detailkursus AS dk
		INNER JOIN app_kursus as ak on ak.idapp_kursus=dk.kodeKursus
		where dk.kodeDetailKursus='$KodeDetailKursus' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	
	/*----------jika di kursus = Detail Jadwal --------------*/
	public function getDetilPembelian($KODEPEMBELIAN){
		$sql = "SELECT * FROM tb_detailpembelian inner join tb_barang on tb_barang.KODEBARANG=tb_detailpembelian.KODEBARANG WHERE KODEPEMBELIAN='$KODEPEMBELIAN' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getDetailJadwalKursus($KodeDetailKursus){
		$sql = "SELECT dj.idUnix, dj.kodeDetailKursus_detailKursus, dj.hari, dj.jam FROM detailjadwal AS dj INNER JOIN detailkursus as dk on dj.kodeDetailKursus_detailKursus=dk.kodeDetailKursus where dj.kodeDetailKursus_detailKursus='$KodeDetailKursus' ";
		$query = $this->db->query($sql);
		return $query->result();
	}




	public function getPenjualan($KODEPENJUALAN){
		$sql = "SELECT tb_penjualan.*, tb_customer.NAMACUSTOMER FROM tb_penjualan inner join tb_customer on tb_customer.IDCUSTOMER=tb_penjualan.IDCUSTOMER WHERE KODEPENJUALAN='$KODEPENJUALAN' ";
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
	// public function getKategori($KODEKATEGORI){
	// 	$sql = "SELECT * FROM tb_kategori WHERE KODEKATEGORI='$KODEKATEGORI' ";
	// 	$query = $this->db->query($sql);
	// 	return $query->result();
	// }
	// public function insertKategori($data){
	// 	$query = $this->db->insert('tb_kategori', $data); 
	// 	return $query;
	// }
	// public function updateKategori($data){
	// 	$this->db->where('KODEKATEGORI',$data['KODEKATEGORI']); 
	// 	$query=$this->db->update('tb_kategori',$data); 
	// 	return $query;
	// }
	// public function deleteKategori($data){
	// 	$query=$this->db->delete('tb_kategori',$data); 
	// 	return $query;
	// }
}
?>