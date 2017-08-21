<?php session_start();
include '../../func/fungsi.php';
include '../../framework/config.php';
$baseurl = $_COOKIE['baseurl'];
$basedir = $_COOKIE['basedir'];
echo "
    <script language='JavaScript' src='$baseurl/js/ajaxc2.js' type='text/javascript'></script>
    <script language='JavaScript' src='$baseurl/dialog/dialog.js' type='text/javascript'></script>
    <script language='JavaScript' src='$baseurl/js/global.js' type='text/javascript'></script>
    <script language='JavaScript' src='$baseurl/js/base.js' type='text/javascript'></script>
    <script language='JavaScript' src='$baseurl/js/encoder.js' type='text/javascript'></script>
    <script language='JavaScript' src='$baseurl/lib/chatx/chatx.js' type='text/javascript'></script>
    <script src='$baseurl/js/daftarobj.js' type='text/javascript'></script>
    <script src='$baseurl/js/pageobj.js' type='text/javascript'></script>   ";
echo "<script type='text/javascript' src='$baseurl/js/aksi/aksi.js'></script>";
$session_id = session_id();

$gagal = '    <script languange="javascript"> alert("Data gagal");
                history.go(-2);
              </script>';

$index = ' 	  <script languange="javascript">
			 	  document.location="../../index.php#alert_form";
		   	  </script>';


$today = date ("Ymd");
$sql = "SELECT max(id_order) as akhir FROM order_produk WHERE id_order LIKE 'ID-$today%'";
$hasil = query($sql);
$data = fetch($hasil);
$lastID = $data['akhir'];
$lastNoUrut = substr($lastID, 12, 3);
$nextNoUrut = $lastNoUrut + 1;
$id_order = $today.sprintf("%03s",$nextNoUrut);

switch ($act) {
	case 'simpan_order':
		mysql_query("INSERT into order_produk values('ID-$id_order','$id_user','$prov','$kabkot','$kec','$alamat','$bank','$jasa','$tglnow','belum','0')");



    $getDetail = mysql_query("select * from order_session where session_id = '$session_id'");
    while ($rows = mysql_fetch_array($getDetail)) {
        mysql_query("INSERT into order_detail values('ID-$id_order','$session_id','".$rows['id_produk']."','".$rows['jumlah']."')");
    }


		$delete = query("DELETE FROM order_session where session_id = '$session_id' ");

		// if ($simpan AND $detail AND $delete) {
			echo"$index";
		// } else {
		// 	echo "$gagal";
		// }

	break;
}
?>
