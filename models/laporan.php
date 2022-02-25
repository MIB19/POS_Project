<?php
class laporan{
	function show_operasional($conn){
		$sql	= "
			SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				transaksi.biaya_service, 
				transaksi.biaya_ppn, 
				transaksi.no_meja, 
				transaksi.id_member, 
				transaksi.id_user as kasir,
				muser.ckode, 
				transaksi.nama, 
				transaksi.status 
			FROM
				`transaksi_detail`
			LEFT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`transaksi`
			on
				transaksi.id = transaksi_detail.id_trans
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = transaksi_detail.id_user
			where 
				transaksi_detail.deleted = '0' && transaksi.deleted = '0' && transaksi.status = '99'
			UNION
			SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				transaksi.biaya_service, 
				transaksi.biaya_ppn, 
				transaksi.no_meja, 
				transaksi.id_member,
				transaksi.id_user as kasir,
				muser.ckode, 
				transaksi.nama, 
				transaksi.status 
			FROM
				`transaksi_detail`
			RIGHT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`transaksi`
			on
				transaksi.id = transaksi_detail.id_trans
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = transaksi_detail.id_user
			where 
				transaksi_detail.deleted = '0' && transaksi.deleted = '0' && transaksi.status = '99'
			Order by id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_addon'			=> $rec['id_addon'],
						'id_trans'			=> $rec['id_trans'],
						'nama_brg_add_on'	=> $rec['nama_brg_add_on'],
						'harga_brg_add_on'	=> $rec['harga_brg_add_on'],
						'total_brg_add_on'	=> $rec['total_brg_add_on'],
						'id_utm'			=> $rec['id_utm'],
						'id_child'			=> $rec['id_child'],
						'id_item'			=> $rec['id_item'],
						'total'				=> $rec['total'],
						'discount_type'		=> $rec['discount_type'],
						'nominal'			=> $rec['nominal'],
						'catatan'			=> $rec['catatan'],
						'date_add'			=> $rec['date_add'],
						'nm_brg'			=> $rec['nm_brg'],
						'hrg'				=> $rec['harga'],
						'no_meja'			=> $rec['no_meja'],
						'id_member'			=> $rec['id_member'],
						'ckode'				=> $rec['ckode'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'kasir'				=> $rec['kasir'],
						'dis'				=> $this->disc($conn,$rec['id_member']),
						'nama'				=> $rec['nama'],
						'status'			=> $rec['status']
					);
				}
			}
		}
		
		return $record;
	}
	function show_void($conn){
		$sql	= "
			SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_tr_void as id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				tr_void.biaya_service, 
				tr_void.biaya_ppn, 
				tr_void.no_meja, 
				tr_void.id_member, 
				tr_void.id_user as kasir,
				muser.ckode, 
				tr_void.nama, 
				tr_void.status 
			FROM
				`transaksi_detail`
			LEFT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`tr_void`
			on
				tr_void.id = transaksi_detail.id_tr_void
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = tr_void.id_user
			where 
				transaksi_detail.deleted = '0' && tr_void.deleted = '0' && tr_void.status = '0'
			UNION
			SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_tr_void as id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				tr_void.biaya_service, 
				tr_void.biaya_ppn, 
				tr_void.no_meja, 
				tr_void.id_member,
				tr_void.id_user as kasir,
				muser.ckode, 
				tr_void.nama, 
				tr_void.status 
			FROM
				`transaksi_detail`
			RIGHT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`tr_void`
			on
				tr_void.id = transaksi_detail.id_tr_void
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = tr_void.id_user
			where 
				transaksi_detail.deleted = '0' && tr_void.deleted = '0' && tr_void.status = '0'
			Order by id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_addon'			=> $rec['id_addon'],
						'id_trans'			=> $rec['id_trans'],
						'nama_brg_add_on'	=> $rec['nama_brg_add_on'],
						'harga_brg_add_on'	=> $rec['harga_brg_add_on'],
						'total_brg_add_on'	=> $rec['total_brg_add_on'],
						'id_utm'			=> $rec['id_utm'],
						'id_child'			=> $rec['id_child'],
						'id_item'			=> $rec['id_item'],
						'total'				=> $rec['total'],
						'discount_type'		=> $rec['discount_type'],
						'nominal'			=> $rec['nominal'],
						'catatan'			=> $rec['catatan'],
						'date_add'			=> $rec['date_add'],
						'nm_brg'			=> $rec['nm_brg'],
						'hrg'				=> $rec['harga'],
						'no_meja'			=> $rec['no_meja'],
						'id_member'			=> $rec['id_member'],
						'ckode'				=> $rec['ckode'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'kasir'				=> $rec['kasir'],
						'dis'				=> $this->disc($conn,$rec['id_member']),
						'nama'				=> $rec['nama'],
						'status'			=> $rec['status']
					);
				}
			}
		}
		
		return $record;
	}
	
	function show_filter_void($conn,$d1,$d2){
		$sql	= "
			SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_tr_void as id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				tr_void.biaya_service, 
				tr_void.biaya_ppn, 
				tr_void.no_meja, 
				tr_void.id_member, 
				tr_void.id_user as kasir,
				muser.ckode, 
				tr_void.nama, 
				tr_void.status 
			FROM
				`transaksi_detail`
			LEFT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`tr_void`
			on
				tr_void.id = transaksi_detail.id_tr_void
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = tr_void.id_user
			where 
				transaksi_detail.deleted = '0' && tr_void.deleted = '0' && tr_void.status = '0' && tr_void.date_add >= '$d1' && tr_void.date_add <= '$d2'
			UNION
			SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_tr_void as id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				tr_void.biaya_service, 
				tr_void.biaya_ppn, 
				tr_void.no_meja, 
				tr_void.id_member,
				tr_void.id_user as kasir,
				muser.ckode, 
				tr_void.nama, 
				tr_void.status 
			FROM
				`transaksi_detail`
			RIGHT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`tr_void`
			on
				tr_void.id = transaksi_detail.id_tr_void
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = tr_void.id_user
			where 
				transaksi_detail.deleted = '0' && tr_void.deleted = '0' && tr_void.status = '0' && tr_void.date_add >= '$d1' && tr_void.date_add <= '$d2'
			Order by id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_addon'			=> $rec['id_addon'],
						'id_trans'			=> $rec['id_trans'],
						'nama_brg_add_on'	=> $rec['nama_brg_add_on'],
						'harga_brg_add_on'	=> $rec['harga_brg_add_on'],
						'total_brg_add_on'	=> $rec['total_brg_add_on'],
						'id_utm'			=> $rec['id_utm'],
						'id_child'			=> $rec['id_child'],
						'id_item'			=> $rec['id_item'],
						'total'				=> $rec['total'],
						'discount_type'		=> $rec['discount_type'],
						'nominal'			=> $rec['nominal'],
						'catatan'			=> $rec['catatan'],
						'date_add'			=> $rec['date_add'],
						'nm_brg'			=> $rec['nm_brg'],
						'hrg'				=> $rec['harga'],
						'no_meja'			=> $rec['no_meja'],
						'id_member'			=> $rec['id_member'],
						'ckode'				=> $rec['ckode'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'kasir'				=> $rec['kasir'],
						'dis'				=> $this->disc($conn,$rec['id_member']),
						'nama'				=> $rec['nama'],
						'status'			=> $rec['status']
					);
				}
			}
		}
		return $record;
	}
	
	
	function show($conn){
		$sql	= "
			SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				transaksi.biaya_service, 
				transaksi.biaya_ppn, 
				transaksi.no_meja, 
				transaksi.id_member, 
				transaksi.id_user as kasir,
				muser.ckode, 
				transaksi.nama, 
				transaksi.status 
			FROM
				`transaksi_detail`
			LEFT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`transaksi`
			on
				transaksi.id = transaksi_detail.id_trans
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = transaksi_detail.id_user
			where 
				transaksi_detail.deleted = '0' && transaksi.deleted = '0' && transaksi.status = '1'
			UNION
			SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				transaksi.biaya_service, 
				transaksi.biaya_ppn, 
				transaksi.no_meja, 
				transaksi.id_member,
				transaksi.id_user as kasir,
				muser.ckode, 
				transaksi.nama, 
				transaksi.status 
			FROM
				`transaksi_detail`
			RIGHT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`transaksi`
			on
				transaksi.id = transaksi_detail.id_trans
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = transaksi_detail.id_user
			where 
				transaksi_detail.deleted = '0' && transaksi.deleted = '0' && transaksi.status = '1'
			Order by id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_addon'			=> $rec['id_addon'],
						'id_trans'			=> $rec['id_trans'],
						'nama_brg_add_on'	=> $rec['nama_brg_add_on'],
						'harga_brg_add_on'	=> $rec['harga_brg_add_on'],
						'total_brg_add_on'	=> $rec['total_brg_add_on'],
						'id_utm'			=> $rec['id_utm'],
						'id_child'			=> $rec['id_child'],
						'id_item'			=> $rec['id_item'],
						'total'				=> $rec['total'],
						'discount_type'		=> $rec['discount_type'],
						'nominal'			=> $rec['nominal'],
						'catatan'			=> $rec['catatan'],
						'date_add'			=> $rec['date_add'],
						'nm_brg'			=> $rec['nm_brg'],
						'hrg'				=> $rec['harga'],
						'no_meja'			=> $rec['no_meja'],
						'id_member'			=> $rec['id_member'],
						'ckode'				=> $rec['ckode'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'kasir'				=> $rec['kasir'],
						'dis'				=> $this->disc($conn,$rec['id_member']),
						'nama'				=> $rec['nama'],
						'status'			=> $rec['status']
					);
				}
			}
		}
		
		return $record;
	}
	
	function show_filter($conn,$d1,$d2){
		$sql	= "
			SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				transaksi.biaya_service, 
				transaksi.biaya_ppn, 
				transaksi.no_meja, 
				transaksi.id_member, 
				muser.ckode, 
				transaksi.nama, 
				transaksi.id_user as kasir, 
				transaksi.status 
			FROM
				`transaksi_detail`
			LEFT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`transaksi`
			on
				transaksi.id = transaksi_detail.id_trans
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = transaksi_detail.id_user
			where 
				transaksi_detail.deleted = '0' && transaksi.deleted = '0' && transaksi.status = '1' && transaksi.date_add >= '$d1' && transaksi.date_add <= '$d2'
			UNION
			SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				transaksi.biaya_service, 
				transaksi.biaya_ppn, 
				transaksi.no_meja, 
				transaksi.id_member, 
				muser.ckode, 
				transaksi.nama, 
				transaksi.id_user as kasir, 
				transaksi.status 
			FROM
				`transaksi_detail`
			RIGHT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`transaksi`
			on
				transaksi.id = transaksi_detail.id_trans
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = transaksi_detail.id_user
			where 
				transaksi_detail.deleted = '0' && transaksi.deleted = '0' && transaksi.status = '1' && transaksi.date_add >= '$d1' && transaksi.date_add <= '$d2'
			Order by id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_addon'			=> $rec['id_addon'],
						'id_trans'			=> $rec['id_trans'],
						'nama_brg_add_on'	=> $rec['nama_brg_add_on'],
						'harga_brg_add_on'	=> $rec['harga_brg_add_on'],
						'total_brg_add_on'	=> $rec['total_brg_add_on'],
						'id_utm'			=> $rec['id_utm'],
						'id_child'			=> $rec['id_child'],
						'id_item'			=> $rec['id_item'],
						'total'				=> $rec['total'],
						'discount_type'		=> $rec['discount_type'],
						'nominal'			=> $rec['nominal'],
						'catatan'			=> $rec['catatan'],
						'date_add'			=> $rec['date_add'],
						'nm_brg'			=> $rec['nm_brg'],
						'hrg'				=> $rec['harga'],
						'no_meja'			=> $rec['no_meja'],
						'id_member'			=> $rec['id_member'],
						'ckode'				=> $rec['ckode'],
						'kasir'				=> $rec['kasir'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'dis'				=> $this->disc($conn,$rec['id_member']),
						'nama'				=> $rec['nama'],
						'status'			=> $rec['status']
					);
				}
			}
		}
		
		return $record;
	}
	function disc($conn,$id){
		$sql	= "
		SELECT
			user.id_user_category, 
			user_category.discount
		FROM
			`user`
		inner join
			`user_category`
		on
			user_category.id_category = user.id_user_category
		where 
			user.deleted = '0' && user_category.deleted = '0' && user.id_user = '$id'
		";

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		return $rec['discount'];
	}
	
	
	function show_filter_rekap_operasional($conn,$d1,$d2){
		$sql	= "
		SELECT
			transaksi.id,
			transaksi.id_user,
			transaksi.date_add,
			transaksi.no_meja,
			transaksi.nominal,
			transaksi.biaya_service,
			transaksi.biaya_ppn,
			transaksi.ongkos_kirim,
			transaksi.voucher,
			transaksi.sub_ttl,
			transaksi_pembayaran.id_jenis,
			transaksi_pembayaran.keterangan,
			transaksi_pembayaran.edc,
			transaksi_pembayaran.bank,
			transaksi_pembayaran.nominal as duids
		FROM
			`transaksi`
		right join
			transaksi_pembayaran
		on
			transaksi_pembayaran.id_trans = transaksi.id
		where 
			transaksi.deleted = '0' && transaksi.status = '99' && transaksi.date_add >= '$d1' && transaksi.date_add <= '$d2'
		order by transaksi.id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_user'			=> $rec['id_user'],
						'date_add'			=> $rec['date_add'],
						'no_meja'			=> $rec['no_meja'],
						'nominal'			=> $rec['nominal'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'sub_ttl'			=> $rec['sub_ttl'],
						'ongkos_kirim'		=> $rec['ongkos_kirim'],
						'voucher'			=> $rec['voucher'],
						'id_jenis'			=> $rec['id_jenis'],
						'keterangan'		=> $rec['keterangan'],
						'edc'				=> $rec['edc'],
						'bank'				=> $rec['bank'],
						'duids'				=> $rec['duids']
					);
				}
			}
		}
		
		return $record;
	}
	
	function show_filter_rekap_penjualan_1($conn,$d1,$d2){
		$sql	= "
		SELECT
			transaksi.id,
			transaksi.id_user,
			transaksi.date_add,
			transaksi.no_meja,
			transaksi.nominal,
			transaksi.biaya_service,
			transaksi.biaya_ppn,
			transaksi.ongkos_kirim,
			transaksi.discount_type,
			transaksi.voucher,
			transaksi.sub_ttl,
			transaksi_pembayaran.id_jenis,
			transaksi_pembayaran.keterangan,
			transaksi_pembayaran.edc,
			transaksi_pembayaran.bank,
			transaksi_pembayaran.nominal as duids
		FROM
			`transaksi`
		right join
			transaksi_pembayaran
		on
			transaksi_pembayaran.id_trans = transaksi.id
		where 
			transaksi.deleted = '0' && transaksi.status = '1' && transaksi.date_add >= '$d1' && transaksi.date_add <= '$d2'
		order by transaksi.date_add desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_user'			=> $rec['id_user'],
						'date_add'			=> $rec['date_add'],
						'no_meja'			=> $rec['no_meja'],
						'nominal'			=> $rec['nominal'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'discount_type'		=> $rec['discount_type'],
						'sub_ttl'			=> $rec['sub_ttl'],
						'ongkos_kirim'		=> $rec['ongkos_kirim'],
						'voucher'			=> $this->metode($conn,$rec['id'],8),
						'tunai'				=> $this->metode($conn,$rec['id'],2),
						'debit'				=> $this->metode($conn,$rec['id'],3),
						'ket1'				=> $this->metode1($conn,$rec['id'],3),
						'bank1'				=> $this->metode2($conn,$rec['id'],3),
						'kk'				=> $this->metode($conn,$rec['id'],4),
						'ket2'				=> $this->metode1($conn,$rec['id'],4),
						'bank2'				=> $this->metode2($conn,$rec['id'],4),
						'ovo'				=> $this->metode($conn,$rec['id'],5),
						'gopay'				=> $this->metode($conn,$rec['id'],6),
						'transfer'			=> $this->metode($conn,$rec['id'],7),
						'ket3'				=> $this->metode1($conn,$rec['id'],7),
						'bank3'				=> $this->metode2($conn,$rec['id'],7),
						'deposit'			=> $this->metode($conn,$rec['id'],1),
						'disc_all'			=> $this->disc_all($conn,$rec['id'],1)
					);
				}
			}
		}
		
		return $record;
	}
	
	function show_filter_rekap_penjualan_2($conn,$d1,$d2){
		$sql	= "
		SELECT
			transaksi.id,
			transaksi.id_user,
			transaksi.date_add,
			transaksi.no_meja,
			transaksi.nominal,
			transaksi.biaya_service,
			transaksi.biaya_ppn,
			transaksi.ongkos_kirim,
			transaksi.discount_type,
			transaksi.voucher,
			transaksi.sub_ttl,
			transaksi_pembayaran.id_jenis,
			transaksi_pembayaran.keterangan,
			transaksi_pembayaran.edc,
			transaksi_pembayaran.bank,
			transaksi_pembayaran.nominal as duids
		FROM
			`transaksi`
		right join
			transaksi_pembayaran
		on
			transaksi_pembayaran.id_trans = transaksi.id
		where 
			transaksi.deleted = '0' && transaksi.shift = '2' && transaksi.status = '1' && transaksi.date_add >= '$d1' && transaksi.date_add <= '$d2'
		order by transaksi.date_add desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_user'			=> $rec['id_user'],
						'date_add'			=> $rec['date_add'],
						'no_meja'			=> $rec['no_meja'],
						'nominal'			=> $rec['nominal'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'discount_type'		=> $rec['discount_type'],
						'sub_ttl'			=> $rec['sub_ttl'],
						'ongkos_kirim'		=> $rec['ongkos_kirim'],
						'voucher'			=> $this->metode($conn,$rec['id'],8),
						'tunai'				=> $this->metode($conn,$rec['id'],2),
						'debit'				=> $this->metode($conn,$rec['id'],3),
						'ket1'				=> $this->metode1($conn,$rec['id'],3),
						'bank1'				=> $this->metode2($conn,$rec['id'],3),
						'kk'				=> $this->metode($conn,$rec['id'],4),
						'ket2'				=> $this->metode1($conn,$rec['id'],4),
						'bank2'				=> $this->metode2($conn,$rec['id'],4),
						'ovo'				=> $this->metode($conn,$rec['id'],5),
						'gopay'				=> $this->metode($conn,$rec['id'],6),
						'transfer'			=> $this->metode($conn,$rec['id'],7),
						'ket3'				=> $this->metode1($conn,$rec['id'],7),
						'bank3'				=> $this->metode2($conn,$rec['id'],7),
						'deposit'			=> $this->metode($conn,$rec['id'],1),
						'disc_all'			=> $this->disc_all($conn,$rec['id'],1)
					);
				}
			}
		}
		
		return $record;
	}
	function show_filter_rekap_penjualan1($conn,$d1,$d2,$d){
		$sql	= "
		SELECT
			transaksi.id,
			transaksi.id_user,
			transaksi.date_add,
			transaksi.no_meja,
			transaksi.nominal,
			transaksi.biaya_service,
			transaksi.biaya_ppn,
			transaksi.ongkos_kirim,
			transaksi.discount_type,
			transaksi.voucher,
			transaksi.sub_ttl,
			transaksi_pembayaran.id_jenis,
			transaksi_pembayaran.keterangan,
			transaksi_pembayaran.edc,
			transaksi_pembayaran.bank,
			transaksi_pembayaran.nominal as duids
		FROM
			`transaksi`
		right join
			transaksi_pembayaran
		on
			transaksi_pembayaran.id_trans = transaksi.id
		where 
			transaksi.shift = '$d' && transaksi.deleted = '0' && transaksi.status = '1' && transaksi.date_add >= '$d1' && transaksi.date_add <= '$d2'
		order by transaksi.date_add desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_user'			=> $rec['id_user'],
						'date_add'			=> $rec['date_add'],
						'no_meja'			=> $rec['no_meja'],
						'nominal'			=> $rec['nominal'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'discount_type'		=> $rec['discount_type'],
						'sub_ttl'			=> $rec['sub_ttl'],
						'ongkos_kirim'		=> $rec['ongkos_kirim'],
						'voucher'			=> $this->metode($conn,$rec['id'],8),
						'tunai'				=> $this->metode($conn,$rec['id'],2),
						'debit'				=> $this->metode($conn,$rec['id'],3),
						'ket1'				=> $this->metode1($conn,$rec['id'],3),
						'bank1'				=> $this->metode2($conn,$rec['id'],3),
						'kk'				=> $this->metode($conn,$rec['id'],4),
						'ket2'				=> $this->metode1($conn,$rec['id'],4),
						'bank2'				=> $this->metode2($conn,$rec['id'],4),
						'ovo'				=> $this->metode($conn,$rec['id'],5),
						'gopay'				=> $this->metode($conn,$rec['id'],6),
						'transfer'			=> $this->metode($conn,$rec['id'],7),
						'ket3'				=> $this->metode1($conn,$rec['id'],7),
						'bank3'				=> $this->metode2($conn,$rec['id'],7),
						'deposit'			=> $this->metode($conn,$rec['id'],1),
						'disc_all'			=> $this->disc_all($conn,$rec['id'],1)
					);
				}
			}
		}
		
		return $record;
	}
	
	function show_filter_rekap_penjualan($conn,$d1,$d2){
		$sql	= "
		SELECT
			transaksi.id,
			transaksi.id_user,
			transaksi.date_add,
			transaksi.no_meja,
			transaksi.nominal,
			transaksi.biaya_service,
			transaksi.biaya_ppn,
			transaksi.ongkos_kirim,
			transaksi.discount_type,
			transaksi.voucher,
			transaksi.sub_ttl,
			transaksi_pembayaran.id_jenis,
			transaksi_pembayaran.keterangan,
			transaksi_pembayaran.edc,
			transaksi_pembayaran.bank,
			transaksi_pembayaran.nominal as duids
		FROM
			`transaksi`
		right join
			transaksi_pembayaran
		on
			transaksi_pembayaran.id_trans = transaksi.id
		where 
			transaksi.deleted = '0' && transaksi.status = '1' && transaksi.date_add >= '$d1' && transaksi.date_add <= '$d2'
		order by transaksi.date_add desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_user'			=> $rec['id_user'],
						'date_add'			=> $rec['date_add'],
						'no_meja'			=> $rec['no_meja'],
						'nominal'			=> $rec['nominal'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'discount_type'		=> $rec['discount_type'],
						'sub_ttl'			=> $rec['sub_ttl'],
						'ongkos_kirim'		=> $rec['ongkos_kirim'],
						'voucher'			=> $this->metode($conn,$rec['id'],8),
						'tunai'				=> $this->metode($conn,$rec['id'],2),
						'debit'				=> $this->metode($conn,$rec['id'],3),
						'ket1'				=> $this->metode1($conn,$rec['id'],3),
						'bank1'				=> $this->metode2($conn,$rec['id'],3),
						'kk'				=> $this->metode($conn,$rec['id'],4),
						'ket2'				=> $this->metode1($conn,$rec['id'],4),
						'bank2'				=> $this->metode2($conn,$rec['id'],4),
						'ovo'				=> $this->metode($conn,$rec['id'],5),
						'gopay'				=> $this->metode($conn,$rec['id'],6),
						'transfer'			=> $this->metode($conn,$rec['id'],7),
						'ket3'				=> $this->metode1($conn,$rec['id'],7),
						'bank3'				=> $this->metode2($conn,$rec['id'],7),
						'deposit'			=> $this->metode($conn,$rec['id'],1),
						'disc_all'			=> $this->disc_all($conn,$rec['id'],1)
					);
				}
			}
		}
		
		return $record;
	}
	function show_rekap_operasional($conn){
		$sql	= "
		SELECT
			transaksi.id,
			transaksi.id_user,
			transaksi.date_add,
			transaksi.no_meja,
			transaksi.nominal,
			transaksi.biaya_service,
			transaksi.biaya_ppn,
			transaksi.ongkos_kirim,
			transaksi.voucher,
			transaksi.sub_ttl,
			transaksi_pembayaran.id_jenis,
			transaksi_pembayaran.keterangan,
			transaksi_pembayaran.edc,
			transaksi_pembayaran.bank,
			transaksi_pembayaran.nominal as duids
		FROM
			`transaksi`
		right join
			transaksi_pembayaran
		on
			transaksi_pembayaran.id_trans = transaksi.id
		where 
			transaksi.deleted = '0' && transaksi.status = '99'
		order by transaksi.id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_user'			=> $rec['id_user'],
						'date_add'			=> $rec['date_add'],
						'no_meja'			=> $rec['no_meja'],
						'nominal'			=> $rec['nominal'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'sub_ttl'			=> $rec['sub_ttl'],
						'ongkos_kirim'		=> $rec['ongkos_kirim'],
						'voucher'			=> $rec['voucher'],
						'id_jenis'			=> $rec['id_jenis'],
						'keterangan'		=> $rec['keterangan'],
						'edc'				=> $rec['edc'],
						'bank'				=> $rec['bank'],
						'duids'				=> $rec['duids']
					);
				}
			}
		}
		
		return $record;
	}
	function show_rekap_penjualan($conn){
		$sql	= "
		SELECT
			transaksi.id,
			transaksi.id_user,
			transaksi.date_add,
			transaksi.no_meja,
			transaksi.nominal,
			transaksi.discount_type,
			transaksi.biaya_service,
			transaksi.biaya_ppn,
			transaksi.ongkos_kirim,
			transaksi.voucher,
			transaksi.sub_ttl
		FROM
			`transaksi`
		where 
			transaksi.deleted = '0' && transaksi.status = '1'
		order by transaksi.id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_user'			=> $rec['id_user'],
						'date_add'			=> $rec['date_add'],
						'no_meja'			=> $rec['no_meja'],
						'nominal'			=> $rec['nominal'],
						'biaya_service'		=> $rec['biaya_service'],
						'discount_type'		=> $rec['discount_type'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'sub_ttl'			=> $rec['sub_ttl'],
						'ongkos_kirim'		=> $rec['ongkos_kirim'],
						'voucher'			=> $this->metode($conn,$rec['id'],8),
						'tunai'				=> $this->metode($conn,$rec['id'],2),
						'debit'				=> $this->metode($conn,$rec['id'],3),
						'ket1'				=> $this->metode1($conn,$rec['id'],3),
						'bank1'				=> $this->metode2($conn,$rec['id'],3),
						'kk'				=> $this->metode($conn,$rec['id'],4),
						'ket2'				=> $this->metode1($conn,$rec['id'],4),
						'bank2'				=> $this->metode2($conn,$rec['id'],4),
						'ovo'				=> $this->metode($conn,$rec['id'],5),
						'gopay'				=> $this->metode($conn,$rec['id'],6),
						'transfer'			=> $this->metode($conn,$rec['id'],7),
						'ket3'				=> $this->metode1($conn,$rec['id'],7),
						'bank3'				=> $this->metode2($conn,$rec['id'],7),
						'deposit'			=> $this->metode($conn,$rec['id'],1),
						'disc_all'			=> $this->disc_all($conn,$rec['id'],1)
					);
				}
			}
		}
		
		return $record;
	}
	function disc_all($conn,$id){
		$sql	= "
		SELECT discount_type,total FROM `transaksi_detail` where id_trans = '$id' ";

		$result	= $conn->query($sql);
		$tl = 0;
		while($rec = $result->fetch_assoc()){
			$tl = $tl + ($rec['discount_type'] * $rec['total']);
		}
		
		return $tl;
	}
	function show_laporan_detail_penjualan_per_menu($conn){
		$sql	= "
		SELECT 
			transaksi_detail.id_item,
            mkat2.nama as kategory,
			SUM(transaksi_detail.total) as ts,
			mbrg.nama as nm_brg
		FROM 
			`transaksi_detail`
		inner join
			`mbrg`
		on
			mbrg.kode = transaksi_detail.id_item
		inner join
			`transaksi`
		on
			transaksi.id = transaksi_detail.id_trans
        inner join
			`mkat2`
		on
			mkat2.kode = mbrg.mkat2
		where transaksi.deleted = '0' && transaksi_detail.stat_simpan = '1'
		GROUP BY transaksi_detail.id_item
			order by ts desc";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id_item'			=> $rec['id_item'],
						'kategory'			=> $rec['kategory'],
						'ts'				=> $rec['ts'],
						'nm_brg'			=> $rec['nm_brg']
					);
				}
			}
		}
		
		return $record;
	}
	function show_filter_operasional($conn,$d1,$d2){
		$sql	= "
		SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				transaksi.biaya_service, 
				transaksi.biaya_ppn, 
				transaksi.no_meja, 
				transaksi.id_member, 
				muser.ckode, 
				transaksi.nama, 
				transaksi.id_user as kasir, 
				transaksi.status 
			FROM
				`transaksi_detail`
			LEFT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`transaksi`
			on
				transaksi.id = transaksi_detail.id_trans
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = transaksi_detail.id_user
			where 
				transaksi_detail.deleted = '0' && transaksi.deleted = '0' && transaksi.status = '99' && transaksi.date_add >= '$d1' && transaksi.date_add <= '$d2'
			UNION
			SELECT
				transaksi_detail.id,
				transaksi_detail.id_item, 
				mbrg.nama as nm_brg, 
				transaksi_addon.id as id_addon, 
				transaksi_addon.id_item as id_item_addon, 
				transaksi_addon.nama as nama_brg_add_on, 
				transaksi_addon.harga as harga_brg_add_on, 
				transaksi_addon.total as total_brg_add_on, 
				transaksi_detail.id_trans, 
				transaksi_detail.id_utm, 
				transaksi_detail.id_child, 
				transaksi_detail.total, 
				transaksi_detail.discount_type,
				transaksi_detail.nominal,
				transaksi_detail.catatan, 
				transaksi_detail.date_add, 
				transaksi_detail.harga, 
				transaksi_detail.id_user, 
				transaksi.biaya_service, 
				transaksi.biaya_ppn, 
				transaksi.no_meja, 
				transaksi.id_member, 
				muser.ckode, 
				transaksi.nama, 
				transaksi.id_user as kasir, 
				transaksi.status 
			FROM
				`transaksi_detail`
			RIGHT JOIN 
				`transaksi_addon` 
			ON 
				transaksi_addon.id_transaksi_detail = transaksi_detail.id
			inner join
				`transaksi`
			on
				transaksi.id = transaksi_detail.id_trans
			inner join
				`mbrg`
			on
				mbrg.kode = transaksi_detail.id_item
			inner join
				`muser`
			on
				muser.no = transaksi_detail.id_user
			where 
				transaksi_detail.deleted = '0' && transaksi.deleted = '0' && transaksi.status = '99' && transaksi.date_add >= '$d1' && transaksi.date_add <= '$d2'
			Order by id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id'				=> $rec['id'],
						'id_addon'			=> $rec['id_addon'],
						'id_trans'			=> $rec['id_trans'],
						'nama_brg_add_on'	=> $rec['nama_brg_add_on'],
						'harga_brg_add_on'	=> $rec['harga_brg_add_on'],
						'total_brg_add_on'	=> $rec['total_brg_add_on'],
						'id_utm'			=> $rec['id_utm'],
						'id_child'			=> $rec['id_child'],
						'id_item'			=> $rec['id_item'],
						'total'				=> $rec['total'],
						'discount_type'		=> $rec['discount_type'],
						'nominal'			=> $rec['nominal'],
						'catatan'			=> $rec['catatan'],
						'date_add'			=> $rec['date_add'],
						'nm_brg'			=> $rec['nm_brg'],
						'hrg'				=> $rec['harga'],
						'no_meja'			=> $rec['no_meja'],
						'id_member'			=> $rec['id_member'],
						'ckode'				=> $rec['ckode'],
						'kasir'				=> $rec['kasir'],
						'biaya_service'		=> $rec['biaya_service'],
						'biaya_ppn'			=> $rec['biaya_ppn'],
						'dis'				=> $this->disc($conn,$rec['id_member']),
						'nama'				=> $rec['nama'],
						'status'			=> $rec['status']
					);
				}
			}
		}
		
		return $record;
	}
	
	function show_filter_Laporan_topup_deposit($conn,$d1,$d2){
		
		$sql	= "
		SELECT 
			tr_popup.id,
			tr_popup.mprsh,
			tr_popup.mcab,
			tr_popup.kode_tr,
			tr_popup.id_trans,
			tr_popup.barcode,
			tr_popup.kasir as a,
			muser.ckode as kasir,
			tr_popup.keterangan,
			tr_popup.type_bayar,
			tr_popup.nominals,
			tr_popup.date_add
		FROM 
			`tr_popup`
		inner join
			`muser`
		on
			muser.no = tr_popup.kasir
		where
			tr_popup.deleted = '0' && tr_popup.date_add >= '$d1' && tr_popup.date_add <= '$d2'
		order by 
			tr_popup.id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id_trans'			=> $rec['id_trans'],
						'kode_tr'				=> $rec['kode_tr'],
						'barcode'				=> $rec['barcode'],
						'kasir'				=> $rec['kasir'],
						'type_bayar'				=> $rec['type_bayar'],
						'keterangan'				=> $rec['keterangan'],
						'nominals'				=> $rec['nominals'],
						'date_add'				=> $rec['date_add']
					);
				}
			}
		}
		
		return $record;
	}
	
	function show_filter_laporan_detail_penjualan_per_menu($conn,$d1,$d2){
		$sql	= "
		SELECT 
			transaksi_detail.id_item,
            mkat2.nama as kategory,
			SUM(transaksi_detail.total) as ts,
			mbrg.nama as nm_brg
		FROM 
			`transaksi_detail`
		inner join
			`mbrg`
		on
			mbrg.kode = transaksi_detail.id_item
		inner join
			`transaksi`
		on
			transaksi.id = transaksi_detail.id_trans
        inner join
			`mkat2`
		on
			mkat2.kode = mbrg.mkat2
		where transaksi.deleted = '0' && transaksi_detail.stat_simpan = '1' && transaksi.date_add >= '$d1' && transaksi.date_add <= '$d2'
		GROUP BY transaksi_detail.id_item
			order by kategory desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id_item'			=> $rec['id_item'],
						'kategory'			=> $rec['kategory'],
						'ts'				=> $rec['ts'],
						'nm_brg'			=> $rec['nm_brg']
					);
				}
			}
		}
		
		return $record;
	}
	function show_laporan_add_ons_filter($conn,$d1,$d2){
		$sql	= "
		SELECT 
			transaksi_addon.id_item, 
			transaksi_addon.nama, 
			SUM(transaksi_addon.total) as ts
		FROM 
			`transaksi_addon`
		inner join
			`transaksi_detail`
		on
			transaksi_detail.id = transaksi_addon.id_transaksi_detail
		inner join
			`transaksi`
		on
			transaksi.id = transaksi_detail.id_trans
        
		where transaksi.deleted = '0' && transaksi_detail.stat_simpan = '1' && transaksi.date_add >= '$d1' && transaksi.date_add <= '$d2'
		GROUP BY transaksi_addon.id_item
			order by ts desc";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id_item'			=> $rec['id_item'],
						'ts'				=> $rec['ts'],
						'nama'				=> $rec['nama']
					);
				}
			}
		}
		
		return $record;
	}
	function show_Laporan_topup_deposit($conn){
		$sql	= "
		SELECT 
			tr_popup.id,
			tr_popup.mprsh,
			tr_popup.mcab,
			tr_popup.kode_tr,
			tr_popup.id_trans,
			tr_popup.barcode,
			tr_popup.kasir as a,
			muser.ckode as kasir,
			tr_popup.keterangan,
			tr_popup.type_bayar,
			user.nama,
			tr_popup.nominals,
			tr_popup.date_add
		FROM 
			`tr_popup`
		inner join
			`muser`
		on
			muser.no = tr_popup.kasir
		inner join
			`user`
		on
			user.barcode = tr_popup.barcode
		where
			tr_popup.deleted = '0'
		order by 
			tr_popup.date_add desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id_trans'				=> $rec['id_trans'],
						'kode_tr'				=> $rec['kode_tr'],
						'keterangan'			=> $rec['keterangan'],
						'barcode'				=> $rec['barcode'],
						'kasir'					=> $rec['kasir'],
						'type_bayar'			=> $rec['type_bayar'],
						'nominals'				=> $rec['nominals'],
						'nama'					=> $rec['nama'],
						'date_add'				=> $rec['date_add']
					);
				}
			}
		}
		
		return $record;
	}
	function show_filter_Laporan_point_member($conn,$d1,$d2){
		$sql	= "
		SELECT 
			tr_point.id, 
			tr_point.mprsh, 
			tr_point.mcab, 
			tr_point.kode_point, 
			tr_point.id_trans, 
			tr_point.barcode, 
			tr_point.kasir as ksr,
			muser.ckode as kasir,
			tr_point.keterangan, 
			tr_point.total_point, 
			tr_point.date_add, 
			tr_point.deleted
		FROM 
			`tr_point`
		inner join 
			`muser`
		on
			muser.no = tr_point.kasir
		where
			tr_point.deleted = '0' && tr_point.date_add >= '$d1' && tr_point.date_add <= '$d2'
		order by 
			tr_point.id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id_trans'				=> $rec['id_trans'],
						'kode_point'			=> $rec['kode_point'],
						'keterangan'			=> $rec['keterangan'],
						'barcode'				=> $rec['barcode'],
						'kasir'					=> $rec['kasir'],
						'total_point'			=> $rec['total_point'],
						'date_add'				=> $rec['date_add']
					);
				}
			}
		}
		
		return $record;
	}
	
	function show_Laporan_point_member($conn){
		$sql	= "
		SELECT 
			tr_point.id, 
			tr_point.mprsh, 
			tr_point.mcab, 
			tr_point.kode_point, 
			tr_point.id_trans, 
			tr_point.barcode, 
			tr_point.kasir as ksr,
			muser.ckode as kasir,
			tr_point.keterangan, 
			tr_point.total_point, 
			tr_point.date_add, 
			tr_point.deleted
		FROM 
			`tr_point`
		inner join 
			`muser`
		on
			muser.no = tr_point.kasir
		where
			tr_point.deleted = '0'
		order by 
			tr_point.id desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id_trans'				=> $rec['id_trans'],
						'kode_point'			=> $rec['kode_point'],
						'keterangan'			=> $rec['keterangan'],
						'barcode'				=> $rec['barcode'],
						'kasir'					=> $rec['kasir'],
						'total_point'			=> $rec['total_point'],
						'date_add'				=> $rec['date_add']
					);
				}
			}
		}
		
		return $record;
	}
	
	function show_Laporan_add_ons($conn){
		$sql	= "
		SELECT 
			transaksi_addon.id_item, 
			transaksi_addon.nama, 
			SUM(transaksi_addon.total) as ts
		FROM 
			`transaksi_addon`
		inner join
			`transaksi_detail`
		on
			transaksi_detail.id = transaksi_addon.id_transaksi_detail
		inner join
			`transaksi`
		on
			transaksi.id = transaksi_detail.id_trans
        
		where transaksi.deleted = '0' && transaksi_detail.stat_simpan = '1'
		GROUP BY transaksi_addon.id_item
			order by ts desc
		";

		$result	= $conn->query($sql);
		$record	= array();
		$spy = "";
		$no = 1;
		if($result){
			if(!empty($result)){
				while($rec = $result->fetch_assoc()){
					$record[]	= array(
						'id_item'			=> $rec['id_item'],
						'ts'				=> $rec['ts'],
						'nama'				=> $rec['nama']
					);
				}
			}
		}
		
		return $record;
	}
	function metode($conn,$id,$st){
		$sql	= "
		SELECT
			transaksi_pembayaran.nominal
		FROM
			`transaksi_pembayaran`
		where 
			transaksi_pembayaran.deleted = '0' && transaksi_pembayaran.id_trans = '$id' && transaksi_pembayaran.id_jenis = '$st'
		";

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		return $rec['nominal'];
	}
	function metode1($conn,$id,$st){
		$sql	= "
		SELECT
			transaksi_pembayaran.edc
		FROM
			`transaksi_pembayaran`
		where 
			transaksi_pembayaran.deleted = '0' && transaksi_pembayaran.id_trans = '$id' && transaksi_pembayaran.id_jenis = '$st'
		";

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		return $rec['edc'];
	}
	function metode2($conn,$id,$st){
		$sql	= "
		SELECT
			transaksi_pembayaran.bank
		FROM
			`transaksi_pembayaran`
		where 
			transaksi_pembayaran.deleted = '0' && transaksi_pembayaran.id_trans = '$id' && transaksi_pembayaran.id_jenis = '$st'
		";

		$result	= $conn->query($sql);
		$rec = $result->fetch_assoc();
		return $rec['bank'];
	}
	
}
$laporan	= new laporan();
?>