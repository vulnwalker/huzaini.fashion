<?php session_start();
// include 'func/fungsi.php';
$sql = query("SELECT * FROM user where username ='$_SESSION[user]'");
$data = fetch($sql);
echo'
      <div class="col-wd-3">
        <div class="col animated fadeInLeft delay-02s" id="profkotak">
            <div id="nml">'.$data[nama_lengkap].'
                <a href="profile.php?page=editProfile"><i class="fa fa-pencil" title="Edit Profile"></i></a>
             </div>
              <small><b>Bergabung Pada</b> '.$data[bergabung_tgl].' </small>
          <div class="fkotak">
            <i class="fa fa-star" style="cursor:pointer;" onclick=javascript:window.location.replace("profile.php"); >&nbsp Riwayat Pembelian</i>
            <a href="proses.php?act=logout">
              <i class="fa fa-sign-out" title="Logout" id="signout"></i>
            </a>
          </div>
        </div>
        <div class="col animated fadeInUp delay-07s" id="inkotak">
            <ul>
              <li><i class="fa fa-rss"></i>'.$data[email].'</li>
              <li><i class="fa fa-phone"></i>'.$data[tlp].'</li>
              <li><i class="fa fa-globe"></i>'.$data[alamat].'</li>
            </ul>
        </div>';
      ?>
