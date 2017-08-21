<?php session_start();
include '../koneksi.php';

foreach ($_POST as $key => $value) {
    $$key = $value;
}

$sukses =   ' <script languange="javascript"> alert("Order berhasil di konfirmasi");
                   history.go(-2);
                  </script>';
$gagal  =   ' <script languange="javascript"> alert("Data gagal disimpan");
                    history.go(-1);
                  </script>';

switch ($_GET['act']) {
  case 'konfirmorder':

  $getDetail = mysql_query("select * from order_detail where id_order = '$id_order'");
  while ($rows = mysql_fetch_array($getDetail)) {
      $jumlahnya = $rows['jumlah'];
      mysql_query("UPDATE produk set stok = stok - $jumlahnya, terjual = terjual + $jumlahnya WHERE id='".$rows['id_produk']."'");
  }

    $username = $_SESSION[id_user];
    mysql_query("UPDATE order_produk set konfirmasi_order='sudah',id_petugas='$username' WHERE id_order='$id_order'");

    echo "UPDATE order_produk set konfirmasi_order='sudah' WHERE id_order='$id_order'";
    echo"$sukses ";


  break;

  }
?>
