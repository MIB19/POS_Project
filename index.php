<?php
error_reporting(0);
session_start();

require "config/config.php";
require "config/database.php";
require "models/mkategori.php";
require "models/mbarang.php";
require "models/mcust.php";
require "models/tbarangpaket.php";
require "models/msoprinter.php";
require "models/transaksi.php";
require "models/muser.php";
require "models/user_category.php";
require "models/user.php";
require "models/transaksi_pembayaran.php";
require "models/laporan.php";
require "models/login.php";
require "models/bank.php";
require "models/shift.php";

$menu = "";
if(isset($_REQUEST['menu'])){
	$menu = $_REQUEST['menu'];
}
$menu	= isset($_REQUEST['fsa'])?$_REQUEST['fsa']:'';

if(empty($_SESSION['pst_klbr'])){
	switch($menu){
		case "pilih_shift":
			$page_adj	= "perorderan";
			$page_atr	= "";
			
			$data['show_ok']			= $transaksi->show_tbll($conn);
			
			extract($data);
			require "views/index_shift.php";

			// $result		= $transaksi->save($conn,$id);
		break;
		case "laporan":
			$page_adj	= "report";
			$page_atr	= "";
			require "views/index.php";
		break;
		case "print_bill_preview":
			$id			= $_REQUEST['param1'];
			require "print/bill_preview.php";

			// $result		= $transaksi->save($conn,$id);
		break;
		case "print_prints":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];
			$id2		= $_REQUEST['param3'];
			$id3		= $_REQUEST['param4'];
			require "print/prints.php";

			// $result		= $transaksi->save($conn,$id);
		break;
		case "exit":
			$a = 'TASKKILL /IM chrome.exe /F';
			system($a);
		break;
		case "Laporan_void":
			$page_adj	= "Laporan_void";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_void($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_void_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);

			$page_adj	= "Laporan_void";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_void($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_detail_penjualan":
			$page_adj	= "laporan_detail_penjualan";
			$page_atr	= "";
			
			$va1 	= date("Y-m-d")." 00:00:00";
			$va2 	= date("Y-m-d")." 23:59:59";
			$v1 = strtotime($va1);
			$v2 = strtotime($va2);
			
			$data['show_laporan']			= $laporan->show_filter($conn,$v1,$v2);
			
			// $data['show_laporan']			= $laporan->show($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "print_page":
		
			$a = $_REQUEST['param1'];	
			if($a == '1'){
				$data['show_laporan']			= $laporan->show($conn);
				extract($data);
				require "views/laporan_detail_penjualan_print.php";
			}else if($a == '2'){
				$b = $_REQUEST['param2']." 00:00:00";
				$c = $_REQUEST['param3']." 23:59:59";
				$d = $_REQUEST['param4'];

				$d1 = strtotime($b);
				$d2 = strtotime($c);
				
				$data['show_laporan1']			= $laporan->show_filter_rekap_penjualan1($conn,$d1,$d2,$d );
				extract($data);
				require "views/laporan_rekap_penjualan_print.php";
			}else if($a == '3'){
				$va1 	= date("Y-m-d")." 00:00:00";
				$va2 	= date("Y-m-d")." 23:59:59";
				$v1 = strtotime($va1);
				$v2 = strtotime($va2);
				$data['show_laporan']			= $laporan->show_filter_laporan_detail_penjualan_per_menu($conn,$v1,$v2);
				extract($data);
				// $data['show_laporan']			= $laporan->show_laporan_detail_penjualan_per_menu($conn);
				// extract($data);
				
				require "views/Laporan_detail_penjualan_per_menu_print.php";
			}else if($a == '4'){
				$va1 	= date("Y-m-d")." 00:00:00";
				$va2 	= date("Y-m-d")." 23:59:59";
				$v1 = strtotime($va1);
				$v2 = strtotime($va2);
				$data['show_laporan']			= $laporan->show_laporan_add_ons_filter($conn,$v1,$v2);
				extract($data);
				
				require "views/Laporan_add_ons_print.php";
			}else if($a == '5'){
				$data['show_laporan']			= $laporan->show_void($conn);
				extract($data);
				
				require "views/Laporan_void_print.php";
			}else if($a == '6'){
				$data['show_laporan']			= $laporan->show_Laporan_topup_deposit($conn);
				extract($data);
				
				require "views/Laporan_topup_deposit_print.php";
			}else if($a == '7'){
				$data['show_laporan']			= $laporan->show_Laporan_point_member($conn);
				extract($data);
				
				require "views/Laporan_point_member_print.php";
			}
		break;
		case "Laporan_detail_operasional":
			$page_adj	= "Laporan_detail_operasional";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_operasional($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_detail_operasional_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);

			$page_adj	= "Laporan_detail_operasional";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_operasional($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_detail_penjualan_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);

			$page_adj	= "laporan_detail_penjualan";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_rekap_operasional_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);

			$page_adj	= "Laporan_rekap_operasional";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_rekap_operasional($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_rekap_penjualan_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);

			$page_adj	= "Laporan_rekap_penjualan";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_rekap_penjualan($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_rekap_operasional":
			$page_adj	= "Laporan_rekap_operasional";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_rekap_operasional($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_rekap_penjualan":
			$page_adj	= "Laporan_rekap_penjualan";
			$page_atr	= "";
			
			$va1 	= date("Y-m-d")." 00:00:00";
			$va2 	= date("Y-m-d")." 23:59:59";
			//echo $date1;
			$v1 = strtotime($va1);
			$v2 = strtotime($va2);
			
			
			$data['show_laporan']			= $laporan->show_filter_rekap_penjualan($conn,$v1,$v2);
			
			// $data['show_laporan']			= $laporan->show_rekap_penjualan($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_detail_penjualan_per_menu":
			$page_adj	= "Laporan_detail_penjualan_per_menu";
			$page_atr	= "";
			
			$va1 	= date("Y-m-d")." 00:00:00";
			$va2 	= date("Y-m-d")." 23:59:59";
			$v1 = strtotime($va1);
			$v2 = strtotime($va2);
			
			$data['show_laporan']			= $laporan->show_filter_laporan_detail_penjualan_per_menu($conn,$v1,$v2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_point_member":
			$page_adj	= "Laporan_point_member";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_Laporan_point_member($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_filter_point_member":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);
			
			$page_adj	= "Laporan_point_member";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_Laporan_point_member($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_topup_deposit":
			$page_adj	= "Laporan_topup_deposit";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_Laporan_topup_deposit($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_topup_deposit_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);
			
			$page_adj	= "Laporan_topup_deposit";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_Laporan_topup_deposit($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_add_ons":
			
			$page_adj	= "Laporan_add_ons";
			$page_atr	= "";
			$va1 	= date("Y-m-d")." 00:00:00";
			$va2 	= date("Y-m-d")." 23:59:59";
			$v1 = strtotime($va1);
			$v2 = strtotime($va2);
			
			$data['show_laporan']			= $laporan->show_laporan_add_ons_filter($conn,$v1,$v2);
			extract($data);
			
			require "views/index.php";
		break;
	
		case "laporan_detail_penjualan_per_menu_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);
			
			$page_adj	= "Laporan_detail_penjualan_per_menu";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_laporan_detail_penjualan_per_menu($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_add_ons_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);
			
			$page_adj	= "Laporan_add_ons";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_laporan_add_ons_filter($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "login":
			$urls 		= $_POST['urls'];
			$pieces 	= explode("/", $urls);
			// echo $urls;
			$username 	= $_POST['username'];
			$password 	= $_POST['password'];
			$result		= $login->loginss($conn,$username,$password,$urls);
			$ses = explode("/", $_SESSION['pst_klbr']);
			if($pieces[1] == 'master.html'){
				if($ses[2] == '0'){
					header("location:$config->base_url"."master.html");
				}else{
					header("location:$config->base_url");
				}
			}else{
				header("location:$config->base_url".$urls);
			}
		break;
		case "index":
			$page_adj	= "perorderan";
			$page_atr	= "";
			$page_psh	= "1";
			
			$data['show_ok']			= $transaksi->show_tbll($conn);
			
			extract($data);
			require "views/index_login.php";
		break;
		case "perorderan":
			$data['show_ok']			= $transaksi->show_tbll($conn);
			
			extract($data);
			require "views/perorderans.php";
		break;
		case "deposite_member":
			$page_adj	= "perorderan";
			$page_atr	= "";
			$data['show_ok']			= $transaksi->show_tbll($conn);
			
			extract($data);
			require "views/index_login.php";
		break;
		default:
			$page_adj	= "perorderan";
			$page_atr	= "";
			$data['show_ok']			= $transaksi->show_tbll($conn);
			
			extract($data);
			require "views/index.php";
			
			
			
			// $page_adj	= "perorderan";
			// $page_atr	= "";
			// $data['show_ok']			= $transaksi->show_tbll($conn);
			
			// extract($data);
			// require "views/index_login.php";
		break;
	}
}else{
	$ses = explode("/", $_SESSION['pst_klbr']);
	switch($menu){
		case "shift1":
			$id11111 = $ses['1'];
			$vr = '1';
			$result		= $shift->insert($conn,$id11111,$vr);
		
		break;
		case "shift01":
			$id11111 = $ses['1'];
			$vr = '1';
			$result		= $shift->update($conn,$id11111,$vr);
		
		break;
		case "shift2":
			$id11111 = $ses['1'];
			$vr = '2';
			$result		= $shift->insert($conn,$id11111,$vr);
		
		break;
		case "shift02":
			$id11111 = $ses['1'];
			$vr = '2';
			$result		= $shift->update($conn,$id11111,$vr);
		
		break;
		case "print_page":
		
			$a = $_REQUEST['param1'];	
			if($a == '1'){
				$data['show_laporan']			= $laporan->show($conn);
				extract($data);
				require "views/laporan_detail_penjualan_print.php";
			}else if($a == '2'){
				$b = $_REQUEST['param2']." 00:00:00";
				$c = $_REQUEST['param3']." 23:59:59";
				$d = $_REQUEST['param4'];

				$d1 = strtotime($b);
				$d2 = strtotime($c);
				
				$data['show_laporan1']			= $laporan->show_filter_rekap_penjualan1($conn,$d1,$d2,$d );
				extract($data);
				require "views/laporan_rekap_penjualan_print.php";
			}else if($a == '3'){
				$va1 	= date("Y-m-d")." 00:00:00";
				$va2 	= date("Y-m-d")." 23:59:59";
				$v1 = strtotime($va1);
				$v2 = strtotime($va2);
				$data['show_laporan']			= $laporan->show_filter_laporan_detail_penjualan_per_menu($conn,$v1,$v2);
				extract($data);
				
				require "views/Laporan_detail_penjualan_per_menu_print.php";
			}else if($a == '4'){
				$va1 	= date("Y-m-d")." 00:00:00";
				$va2 	= date("Y-m-d")." 23:59:59";
				$v1 = strtotime($va1);
				$v2 = strtotime($va2);
				$data['show_laporan']			= $laporan->show_laporan_add_ons_filter($conn,$v1,$v2);
				extract($data);
				
				require "views/Laporan_add_ons_print.php";
			}else if($a == '5'){
				$data['show_laporan']			= $laporan->show_void($conn);
				extract($data);
				
				require "views/Laporan_void_print.php";
			}else if($a == '6'){
				$data['show_laporan']			= $laporan->show_Laporan_topup_deposit($conn);
				extract($data);
				
				require "views/Laporan_topup_deposit_print.php";
			}else if($a == '7'){
				$data['show_laporan']			= $laporan->show_Laporan_point_member($conn);
				extract($data);
				
				require "views/Laporan_point_member_print.php";
			}
		break;
		case "exit":
			$a = 'TASKKILL /IM chrome.exe /F';
			system($a);
		break;
		case "logout":
			$_SESSION['pst_klbr']=null;
			header("location:$config->base_url");
		break;
		case "Laporan_void":
			$page_adj	= "Laporan_void";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_void($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_void_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);

			$page_adj	= "Laporan_void";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_void($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "print_bill":
			$id			= $_REQUEST['param1'];
			require "print/bill.php";

			// $result		= $transaksi->save($conn,$id);
		break;
		case "bayar_sekarang":
			$id11111 = $ses['0'];
			$result		= $transaksi_pembayaran->insert($conn,$id11111);
		break;
		case "deposite_member":
			// $_SESSION['pst_klbr']=null;
			$page_adj	= "deposit_member";
			$page_atr	= "";
			require "views/index.php";
		break;
		case "simpan_popups";
			$id11111 = $ses['0'];
			$ed1 = $_REQUEST['param1'];
			$ed2 = $_REQUEST['param2'];
			$ed3 = $_REQUEST['param3'];
			$ed4 = $_REQUEST['param4'];
			
			$result		= $user->insert_popups($conn,$id11111,$ed1,$ed2,$ed3,$ed4);
			?>	<script>window.location = '<?php echo $config->base_url();?>';</script><?php
			// header("location:$config->base_url"."kategory.html");
		break;
		case "tambah_item":
			$page_adj	= "tambah_item";
			$page_atr	= "";
			
			$data['show_kategori']	= $mkategori->show($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "tambah_user_pegawai":
			$page_adj	= "tambah_user_pegawai";
			$page_atr	= "";
			
			$data['show_kategori']	= $mkategori->show($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "tambah_item_paket":
			$page_adj	= "tambah_item_paket";
			$page_atr	= "";
			
			$data['show_kategori']	= $mbarang->show_paket($conn);
			$data['show']	= $mbarang->show($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "simpan_item";
			$id11111 = $ses['0'];
			// echo $id11111;
			$result		= $mbarang->insert($conn,$id11111);
			// header("location:$config->base_url"."kategory.html");
		break;
		case "simpan_user_pegawai";
			$id11111 = $ses['0'];
			// echo $id11111;
			$result		= $muser->simpan($conn);
			// header("location:$config->base_url"."kategory.html");
		break;
		case "hapus_user_pegawai":
			$id			= $_REQUEST['param1'];
			$result		= $muser->hapus($conn,$id);
		break;
		case "user_pegawais":
			// $page_adj	= "user_pegawaian";
			// $page_atr	= "";
			$data['show_user']	= $muser->show($conn);
			
			extract($data);
			require "views/user_pegawaian.php";
		break;
		case "select_user_pegawai";
		// echo "a";
			$id			= $_REQUEST['param1'];
			$data		= $muser->select($conn,$id);
			extract($data);
			
			require "views/select_user_pegawai.php";
		break;
		case "update_user_pegawai":
			$result		= $muser->update($conn);
		break;
		
		case "simpan_item_paket";
			$id11111 = $ses['0'];
			$result		= $mbarang->insert_item_paket($conn,$id11111);
		break;
		case "tambah_kategory":
			$page_adj	= "tambah_kategory";
			$page_atr	= "";
			require "views/index.php";
		break;
		case "simpan_kategory";
			$id11111 = $ses['0'];
			// echo $id11111;
			$result		= $mkategori->insert($conn,$id11111);
			// header("location:$config->base_url"."kategory.html");
		break;
		case "cari_barcode":
			$id11111 = $_REQUEST['param1'];
			$id11112 = $_REQUEST['param2'];
			if($id11112 == '1'){
				$json = file_get_contents('https://www.kollabora.id/kollabora_caffe/cek_deposites/'.$id11111.'.html');
			}else{	
				$json	= $user->show_dpst($conn,$id11111);
			}
			
			$data = json_decode($json);
			// echo $json;
			require "views/deposit_member.php";
		break;
		// case "depo_member":
			// $page_adj	= "deposit_member";
			// $page_atr	= "";
			// require "views/index.php";
		// break;
		case "kasir":
			$page_adj	= "perkasiran";
			$page_atr	= "";
			require "views/index.php";
		break;
		case "kategory":
			$page_adj	= "perkategoryan";
			$page_atr	= "";
			$data['show_kategori']	= $mkategori->show($conn);
			extract($data);

			require "views/index.php";
		break;
		case "user_category":
			$page_adj	= "user_categoryan";
			$page_atr	= "";
			$data['show_user_category']	= $user_category->show($conn);
			extract($data);

			require "views/index.php";
		break;
		case "tambah_user_category":
			$page_adj	= "tambah_user_category";
			$page_atr	= "";

			require "views/index.php";
		break;
		case "insert_user_category";
			$result		= $user_category->insert($conn);
		break;
		case "select_user_category";
			$id			= $_REQUEST['param1'];
			$data		= $user_category->select($conn,$id);
			extract($data);
			
			require "views/select_user_category.php";
		break;
		case "select_kategory";
			$id			= $_REQUEST['param1'];
			$data		= $user_category->select_kategory($conn,$id);
			extract($data);
			
			require "views/select_kategory.php";
		break;
		case "select_item";
			$id			= $_REQUEST['param1'];
			
			$data		= $mbarang->select($conn,$id);
			$data['show_kategori']	= $mkategori->show($conn);
			extract($data);
			
			require "views/select_item.php";
		break;
		
		case "select_kategory";
			$id			= $_REQUEST['param1'];
			$data		= $user_category->select_kategory($conn,$id);
			extract($data);
			
			require "views/select_kategory.php";
		break;
		case "update_kategory":
			$result		= $user_category->update_kategory($conn);
		break;
		case "hapus_category":
			$id			= $_REQUEST['param1'];
			$result		= $user_category->hapus_kategory($conn,$id);
		break;
		case "categorys";
			$page_adj	= "perkategoryan";
			$page_atr	= "";
			$data['show_kategori']	= $mkategori->show($conn);
			extract($data);

			require "views/perkategoryan.php";
		break;
		case "update_user_category":
			$result		= $user_category->update($conn);
		break;
		case "hapus_user_category":
			$id			= $_REQUEST['param1'];
			$result		= $user_category->hapus($conn,$id);
		break;
		case "user_categorys";
			$data['show_user_category']	= $user_category->show($conn);
			extract($data);
			require "views/user_categoryan.php";
		break;
		
		
		case "item_paket":
			$page_adj	= "item_paket";
			$page_atr	= "";
			$data['show_item_paket']	= $mbarang->show_item_paket($conn);
			
			extract($data);
			require "views/index.php";
		break;
		case "item":
			$page_adj	= "periteman";
			$page_atr	= "";
			$data['show_item']	= $mbarang->show($conn);
			
			extract($data);
			require "views/index.php";
		break;
		case "update_item":
			$id11111 	= $ses['0'];
			$result		= $mbarang->update($conn,$id11111);
		break;
		case "hapus_item":
			$id			= $_REQUEST['param1'];
			$result		= $mbarang->hapus($conn,$id);
		break;
		case "items":
			$page_adj	= "item_paket";
			$page_atr	= "";
			$data['show_item_paket']	= $mbarang->show_item_paket($conn);
			
			extract($data);
			require "views/item_paket.php";
		break;
		case "hapus_item_paket":
			$id			= $_REQUEST['param1'];
			$result		= $mbarang->hapus_item_paket($conn,$id);
		break;
		case "item_pakets":
			$data['show_item']	= $mbarang->show($conn);
			
			extract($data);
			require "views/periteman.php";
		break;
		case "member":
			$page_adj	= "permemberan";
			$page_atr	= "";
			$data['show_user']	= $user->show($conn);
			
			extract($data);
			require "views/index.php";
		break;
		case "select_member":
		
			$id			= $_REQUEST['param1'];
			$data		= $user->select($conn,$id);
			$data['show_user_category']	= $user_category->show($conn);
			extract($data);
			require "views/select_member.php";
		break;
		case "update_member":
			$result		= $user->update($conn);
		break;
		
		case "menu_paket":
			$page_adj	= "permenu_paketan";
			$page_atr	= "";
			$data['show_barang_paket']	= $tbarangpaket->show($conn);
			
			extract($data);
			require "views/index.php";
		break;
		case "printer":
			$page_adj	= "perprinteran";
			$page_atr	= "";
			$data['show_printer']	= $msoprinter->show($conn);
			
			extract($data);
			require "views/index.php";
		break;
		case "user_pegawai":
			$page_adj	= "user_pegawaian";
			$page_atr	= "";
			$data['show_user']	= $muser->show($conn);
			
			extract($data);
			require "views/index.php";
		break;
		case "order":
			$page_adj	= "perorderan";
			$page_atr	= "";
			require "views/index.php";
		break;
		case "denah":
			$page_adj	= "perdenahan";
			$page_atr	= "";
			require "views/index.php";
		break;
		
		
		case "master":
			$page_adj	= "permasteran";
			$page_atr	= "";
			
			require "views/index.php";
		break;
		case "laporan":
			$page_adj	= "report";
			$page_atr	= "";
			require "views/index.php";
		break;
		case "pengaturan":
			$page_adj	= "setting";
			$page_atr	= "";
			require "views/index.php";
		break;
		case "index":
			// $_SESSION['pst_klbr']=null;
			$pilihan_meja = $_REQUEST['param1'];
			if($pilihan_meja == 'shift1'){
				header("location:$config->base_url"."shift1.html");
				exit;
			}
			if($pilihan_meja == 'shift01'){
				header("location:$config->base_url"."shift01.html");
				exit;
			}
			if($pilihan_meja == 'shift2'){
				header("location:$config->base_url"."shift2.html");
				exit;
			}
			if($pilihan_meja == 'shift02'){
				header("location:$config->base_url"."shift02.html");
				exit;
			}
			if($pilihan_meja == 'master'){
				$_SESSION['pst_klbr']=null;
				header("location:$config->base_url"."index/master.html");
				exit;
			}
			if($pilihan_meja == null){
				$pilihan_meja = 99;
				header("location:$config->base_url");
				exit;
			}
			$set		= $transaksi->show_ngarep($conn,$pilihan_meja);
			$spy		= $transaksi->show($conn,$pilihan_meja);
			if($set >= "2"){
				header("location:$config->base_url"."list_transaksi/".$pilihan_meja.".html");
				exit;
			}
			
			$data['show_item']				= $transaksi->show_transaksi($conn,$pilihan_meja);
			$data['show_barang']			= $mbarang->show($conn);
			
			$trs							= $spy;
			$data['show_ok']				= $transaksi->show_tbll($conn);
			$data['show_edc']				= $bank->show_edc($conn);
			$data['show_bank']				= $bank->show_bank($conn);
			
			extract($data);
			
			$page_adj	= "peroderan_menu";
			$page_atr	= "";
			require "views/index.php";
		break;
		case "index_order":
			// $pilihan_meja = $_REQUEST['param1'];
			// $id = $_REQUEST['param2'];
			// $spy		= $id;
			// $set		= $transaksi->show_ngarep($conn,$pilihan_meja);
			// $data['show_item']				= $transaksi->show_transaksis($conn,$pilihan_meja,$id);
			// $data['show_barang']			= $mbarang->show($conn);
			
			// extract($data);
			
			// $page_adj	= "peroderan_menu_list";
			// $page_atr	= "";
			// $page_atrs	= "peroderan_menus";
			// require "views/peroderan_menu_list.php";
		break;
		
		case "index_orders":
			$pilihan_meja = $_REQUEST['param1'];
			$id = $_REQUEST['param2'];
			$spy		= $id;
			$set		= $transaksi->show_ngarep($conn,$pilihan_meja);
			$data['show_items']				= $transaksi->show_total($conn,$pilihan_meja);
			$data['show_item']				= $transaksi->show_transaksis($conn,$pilihan_meja,$id);
			$data['show_barang']			= $mbarang->show($conn);
			
			extract($data);
			
			$page_adj	= "peroderan_menu_list";
			$page_atr	= "";
			$page_atrs	= "peroderan_menus";
			require "views/peroderan_menu_list.php";
		break;
		case "list_transaksi":
			$pilihan_meja = $_REQUEST['param1'];
			
			if($pilihan_meja == null){
				$pilihan_meja = 99;
				header("location:$config->base_url");
				exit;
			}
			$data['show_items']		= $transaksi->show_total($conn,$pilihan_meja);
			$data['show_item']		= $transaksi->show_transaksi($conn,$pilihan_meja);
			$data['show_barang']			= $mbarang->show($conn);
			$data['show_ok']				= $transaksi->show_tbll($conn);
			$data['show_edc']				= $bank->show_edc($conn);
			$data['show_bank']				= $bank->show_bank($conn);
			extract($data);
			
			$page_adj	= "peroderan_menu_br";
			$page_atr	= "";
			$page_atrs	= "";
			require "views/index.php";
		break;
		case "list_transksi":
			$pilihan_meja = $_REQUEST['param1'];
			
			if($pilihan_meja == null){
				$pilihan_meja = 99;
				header("location:$config->base_url");
				exit;
			}
			$data['show_items']		= $transaksi->show_total($conn,$pilihan_meja);
			$data['show_item']		= $transaksi->show_transaksi($conn,$pilihan_meja);
			$data['show_barang']			= $mbarang->show($conn);
			$data['show_ok']				= $transaksi->show_tbll($conn);
			$data['show_edc']				= $bank->show_edc($conn);
			$data['show_bank']				= $bank->show_bank($conn);
			extract($data);
			
			$page_adj	= "peroderan_menu_sl";
			$page_atr	= "";
			$page_atrs	= "";
			require "views/index.php";
		break;
		case "list_transaksis":
			$pilihan_meja = $_REQUEST['param1'];
			
			if($pilihan_meja == null){
				$pilihan_meja = 99;
				header("location:$config->base_url");
				exit;
			}
			$data['show_items']		= $transaksi->show_total($conn,$pilihan_meja);
			$data['show_item']		= $transaksi->show_transaksi($conn,$pilihan_meja);
			$data['show_barang']	= $mbarang->show($conn);
			$data['show_ok']		= $transaksi->show_tbll($conn);
			
			$data['show_edc']				= $bank->show_edc($conn);
			$data['show_bank']				= $bank->show_bank($conn);
			extract($data);
			
			$page_atr	= "";
			$page_atrs	= "";
			require "views/peroderan_menu_br.php";
		break;
		
		case "simpan_nama":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->simpan_nama($conn,$id,$id1);

		break;
		case "ganti_voucherrr":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->ganti_voucherrr($conn,$id,$id1);
		break;
		case "ganti_diskont":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->ganti_diskont($conn,$id,$id1);
		break;
		case "ganti_diskonts":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->ganti_diskonts($conn,$id,$id1);
		break;
		case "ganti_ongkir":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->ganti_ongkir($conn,$id,$id1);
		break;
		case "add_onss":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$pilihan_meja = $_REQUEST['param3'];

			$data['show_add_ons']			= $transaksi->show_add_on($conn,$id,$id1);
			$data['show_add_onsss']			= $transaksi->show_add_onsssss($conn,$id,$id1);
			$data['show_barang']			= $mbarang->showssss($conn,$id);
			extract($data);
			require "views/add_onss.php";
		break;
		case "tambah_order_addons":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->tambah_addons($conn,$id,$id1);
		break;
		case "ganti_keterangan":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->ganti_keterangan($conn,$id,$id1);
		break;
		case "tambah_order":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$id2 = $ses['0'];
			$result		= $transaksi->insert($conn,$id,$id1,$id2);

		break;
		case "kurangi_order":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->kurangi($conn,$id,$id1);

		break;
		case "kurangi_order_addons":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->kurangi_order_addons($conn,$id,$id1);

		break;
		case "tambahi_order":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->tambahi($conn,$id,$id1);

		break;
		case "tambahi_order_addons":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->tambahi_order_addons($conn,$id,$id1);

		break;
		case "tambahi_order_rubah":
			$id = $_REQUEST['param1'];
			$id1 = $_REQUEST['param2'];
			$result		= $transaksi->tttttt($conn,$id,$id1);

		break;
		case "biaya_biaya":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];
			$id2		= $_REQUEST['param3'];
			$result		= $transaksi->biaya_biaya($conn,$id,$id1,$id2);
		break;
		case "simpan_order":
			$id			= $_REQUEST['param1'];

			$result		= $transaksi->save($conn,$id);
		break;
		case "simpan_orders":
			$id			= $_REQUEST['param1'];
			$result		= $transaksi->save($conn,$id);
			exit;
		break;
		
		case "print_bill_preview":
			$id			= $_REQUEST['param1'];
			require "print/bill_preview.php";

			// $result		= $transaksi->save($conn,$id);
		break;
		case "print_checker":
			$id			= $_REQUEST['param1'];
			// $id			= 996;
			require "print/checker.php";
			// $result		= $transaksi->save($conn,$id);
		break;
		case "print_checker1":
			$id			= $_REQUEST['param1'];
			// $id			= 996;
			require "print/checker1.php";
			// $result		= $transaksi->save($conn,$id);
		break;
		case "print_pastry":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];
			require "print/pastry.php";

			// $result		= $transaksi->save($conn,$id);
		break;
		case "print_dapur":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];

			require "print/dapur.php";

			// $result		= $transaksi->save($conn,$id);
		break;
		case "print_prints":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];
			$id2		= $_REQUEST['param3'];
			$id3		= $_REQUEST['param4'];
			require "print/prints.php";

			// $result		= $transaksi->save($conn,$id);
		break;
		case "print_print":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];
			$id2		= $_REQUEST['param3'];
			$id3		= $_REQUEST['param4'];
			require "print/print.php";

			// $result		= $transaksi->save($conn,$id);
		break;

		case "print_bar":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];

			require "print/bar.php";

			// $result		= $transaksi->save($conn,$id);
		break;
		
		case "split_data":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];
			$id2		= $_REQUEST['param3'];
			$id3		= $_REQUEST['param4'];
			$result		= $transaksi->split_data($conn,$id,$id1,$id2,$id3);
			header("location:$config->base_url"."list_transaksi/".$id3."/".$result.".html");
		break;
		case "void_data":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];
			$id2		= $_REQUEST['param3'];
			$id3		= $_REQUEST['param4'];
			$id11111 = $ses['0'];
			$result		= $transaksi->void_data($conn,$id,$id1,$id2,$id3,$id11111);
			header("location:$config->base_url"."list_transaksi/".$id3."/".$result.".html");
		break;
		case "pindah_data":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];
			$id2		= $_REQUEST['param3'];
			$id3		= $_REQUEST['param4'];
			
			// $result		= $transaksi->split_data($conn,$id,$id1,$id2,$id3);
			// echo $id3;
			// header("location:$config->base_url"."transaksi_meja/".$id3."/".$result.".html");
		break;
		case "transaksi_meja":
			$pilihan_meja = $_REQUEST['param1'];
			$id = $_REQUEST['param2'];
			$spy		= $id;
			$set		= $transaksi->show_ngarep($conn,$pilihan_meja);
			$data['show_items']				= $transaksi->show_total($conn,$pilihan_meja);
			$data['show_item']				= $transaksi->show_transaksis($conn,$pilihan_meja,$id);
			$data['show_barang']			= $mbarang->show($conn);
			$data['show_ok']				= $transaksi->show_tbll($conn);
			$trs							= $transaksi->show_trs($conn,$pilihan_meja);
			extract($data);
			
			$page_adj	= "peroderan_menu_list";
			$page_atr	= "";
			$page_atrs	= "peroderan_menus";
			require "views/index.php";
		break;
		
		case "cek_trans":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];
			$id2		= $_REQUEST['param3'];
			
			// echo ""+$id;
			$set		= $transaksi->show_ngarep($conn,$id);
			$data['show_itemssss']		= $transaksi->show_total($conn,$id);
			extract($data);
			
			require "views/peroderan_menu_list_cp.php";
		break;
		case "pindah_meja":
			$id				= $_REQUEST['param1'];
			$id1			= $_REQUEST['param2'];
			$id2			= $_REQUEST['param3'];
			// $id3			= $_REQUEST['param4'];
			
			$result		= $transaksi->show_total($conn,$id);
			extract($data);
			
			$cor=$id1;
			
			require "views/peroderan_menu_list_cp.php";
		break;
		case "pindah":
			$id				= $_REQUEST['param1'];
			$id1			= $_REQUEST['param2'];
			$id2			= $_REQUEST['param3'];
			
			$result		= $transaksi->pindah_meja($conn,$id,$id1,$id2);

			header("location:$config->base_url"."list_transaksi/".$id.".html");
		break;
		case "pindh_meja":
			$id				= $_REQUEST['param1'];
			$id1			= $_REQUEST['param2'];
			$id2			= $_REQUEST['param3'];
			$id3			= $_REQUEST['param4'];
			
			$result		= $transaksi->pindh_meja($conn,$id,$id1,$id2,$id3);

			header("location:$config->base_url"."list_transaksi/".$id.".html");
		break;
		
		
		case "simpan_member":
			$id			= $_REQUEST['param1'];
			$id1		= $_REQUEST['param2'];
			$result		= $transaksi->simpan_member($conn,$id,$id1);
		break;
		case "simpan_members":
			$id			= $_REQUEST['param1'];
			$result		= $transaksi->simpan_members($conn,$id);
		break;
		case "print_data":
			$id			= $_REQUEST['param1'];
			$result		= $transaksi->print_data($conn,$id);
		break;
		
		case "index_percobaan":
			$page_adj	= "index_percobaan";
			$page_atr	= "";
			require "views/index.php";
		break;
		
		case "tambh_transaksi":
			$pilihan_meja = $_REQUEST['param1'];
			
			if($pilihan_meja == null){
				$pilihan_meja = 99;
				header("location:$config->base_url");
				exit;
			}
			$spy		= $transaksi->shows($conn,$pilihan_meja);
			$trs		= $transaksi->show_trs($conn,$pilihan_meja);
			
			header("location:$config->base_url"."list_transksi/".$pilihan_meja.".html");
		break;
		case "transksi_meja":

			$pilihan_meja = $_REQUEST['param1'];
			$id = $_REQUEST['param2'];
			$spy		= $id;
			
			$data['show_items']				= $transaksi->show_total($conn,$pilihan_meja);
			$data['show_item']				= $transaksi->show_transaksi($conn,$pilihan_meja,$id);
			$data['show_barang']			= $mbarang->show($conn);
			
			$trs							= $transaksi->show_trs($conn,$pilihan_meja);
			extract($data);
			
			$page_adj	= "peroderan_menu_list";
			$page_atr	= "";
			$page_atrs	= "peroderan_menus";
			require "views/index.php";
		break;
		
		case "Laporan_detail_penjualan":
			$page_adj	= "laporan_detail_penjualan";
			$page_atr	= "";
			
			$va1 	= date("Y-m-d")." 00:00:00";
			$va2 	= date("Y-m-d")." 23:59:59";
			$v1 = strtotime($va1);
			$v2 = strtotime($va2);

			// $page_adj	= "Laporan_rekap_penjualan";
			// $page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter($conn,$v1,$v2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_detail_operasional":
			$page_adj	= "Laporan_detail_operasional";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_operasional($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_detail_operasional_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);

			$page_adj	= "Laporan_detail_operasional";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_operasional($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_detail_penjualan_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);

			$page_adj	= "laporan_detail_penjualan";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_rekap_operasional_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);

			$page_adj	= "Laporan_rekap_operasional";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_rekap_operasional($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_rekap_penjualan_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);

			$page_adj	= "Laporan_rekap_penjualan";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_rekap_penjualan($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_rekap_operasional":
			$page_adj	= "Laporan_rekap_operasional";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_rekap_operasional($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_rekap_penjualan":
			$page_adj	= "Laporan_rekap_penjualan";
			$page_atr	= "";
			
			$va1 	= date("Y-m-d")." 00:00:00";
			$va2 	= date("Y-m-d")." 23:59:59";
			//echo $date1;
			$v1 = strtotime($va1);
			$v2 = strtotime($va2);
			
			
			$data['show_laporan']			= $laporan->show_filter_rekap_penjualan($conn,$v1,$v2);
			
			// $data['show_laporan']			= $laporan->show_rekap_penjualan($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_detail_penjualan_per_menu":
			$page_adj	= "Laporan_detail_penjualan_per_menu";
			$page_atr	= "";
			
			$va1 	= date("Y-m-d")." 00:00:00";
			$va2 	= date("Y-m-d")." 23:59:59";
			$v1 = strtotime($va1);
			$v2 = strtotime($va2);
			
			$data['show_laporan']			= $laporan->show_filter_laporan_detail_penjualan_per_menu($conn,$v1,$v2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_point_member":
			$page_adj	= "Laporan_point_member";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_Laporan_point_member($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_filter_point_member":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);
			
			$page_adj	= "Laporan_point_member";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_Laporan_point_member($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_topup_deposit":
			$page_adj	= "Laporan_topup_deposit";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_Laporan_topup_deposit($conn);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_topup_deposit_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);
			
			$page_adj	= "Laporan_topup_deposit";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_Laporan_topup_deposit($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "Laporan_add_ons":
			$page_adj	= "Laporan_add_ons";
			$page_atr	= "";
			
			
			$va1 	= date("Y-m-d")." 00:00:00";
			$va2 	= date("Y-m-d")." 23:59:59";
			$v1 = strtotime($va1);
			$v2 = strtotime($va2);
			
			$data['show_laporan']			= $laporan->show_laporan_add_ons_filter($conn,$v1,$v2);
			extract($data);
			
			require "views/index.php";
		break;
	
		case "laporan_detail_penjualan_per_menu_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);
			
			$page_adj	= "Laporan_detail_penjualan_per_menu";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_filter_laporan_detail_penjualan_per_menu($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		case "laporan_add_ons_filter":
			$date1 	= $_POST['date1']." 00:00:00";
			$date11 	= $_POST['date1'];
			$date2 	= $_POST['date2']." 23:59:59";
			$date21 	= $_POST['date2'];
			//echo $date1;
			$d1 = strtotime($date1);
			$d2 = strtotime($date2);
			
			$page_adj	= "Laporan_add_ons";
			$page_atr	= "";
			
			$data['show_laporan']			= $laporan->show_laporan_add_ons_filter($conn,$d1,$d2);
			extract($data);
			
			require "views/index.php";
		break;
		default:
			$_SESSION['pst_klbr']=null;
			$page_adj	= "perorderan";
			$page_atr	= "";
			$data['show_ok']			= $transaksi->show_tbll($conn);
			
			extract($data);
			require "views/index.php";
		break;
	}
	
	
	
	
}
?>