<?php
$baseurl = $_COOKIE['baseurl'];
$basedir = $_COOKIE['basedir'];
// include('$basedir/framework/config.php');
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
?>


<div class="col-wd-12 animated flipInX">
	<nav>
		<ul class="mainmenu">
			<a href="index.php"><li><i class="fa fa-home"></i> Beranda</li></a>
			<a href="index.php?page=tentangkami"><li><i class="fa fa-info-circle"></i> Tentang Kami</li></a>
			<a href="index.php?page=Kontak"><li><i class="fa fa-phone-square"></i> Kontak</li></a>
			<a href="index.php?page=cara-belanja"><li><i class="fa  fa-mouse-pointer"></i> Cara Berbelanja</li></a>
		</ul>
        <?php
            if(empty($_SESSION[user]))  {
		      echo'<a href="#login_form"><div class="login"><i class="fa fa-user"></i> Login</div></a>';
            }else {
                echo'<a href="profile.php">
                        <div class="login">
                            <i class="fa fa-user"></i> '.$_SESSION[user].'

                        </div>
                    </a>';
            }
        ?>

	</nav>
</div>

<?php if(empty($_SESSION[user]) AND $_SESSION[level] !="member")  { ?>
        <a href="#x" class="overlay" id="login_form"></a>
        <div class="popup">
        <form action="proses.php?act=login" method="POST">
            <div class="form">Login</div><br>
                <?php
                if(!empty($_SESSION[pesan]))
                  {echo "<p style='color:#fff' align='center'>
                         <i class='fa fa-warning'> </i> $_SESSION[pesan]</p>";
                  unset($_SESSION[pesan]);}
                ?>
            <div>
                <input type="text" name="username" placeholder="Userame" required>
            </div>
            <div>
                <input type="password" name="pass" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
            <div class="footer">
            Belum Punya akun ? &nbsp;&nbsp;
            <a href="#join_form" id="join_pop">Daftar Sekarang!</a>
            </div>

            <a class="close" href="#close"></a>
        </div>

        <!-- Register Form -->
        <a href="#x" class="overlay" id="join_form"></a>

        <div class="popup" id="register">
           <form action="proses.php?act=register" method="POST" name="formRegister" id="formRegister">
            <div class="form">Daftar</div>
            <?php
                if(!empty($_SESSION[salah]))
                  {echo "<p style='color:#fff' align='center'>
                         <i class='fa fa-warning'> </i> $_SESSION[salah]</p>";
                  unset($_SESSION[salah]);}
            ?>
            <div>
                <div class="label">* Nama</div>
                <input type="text" name="nama" id="nama"  required/>
            </div>
            <div>
                <div class="label">* Username</div>
                <input type="text" name="username" id="login"  required/>
            </div>
            <div>
                <div class="label">* Password</div>
                <input type="password" name="password" id="login" required/>
            </div>
            <div>
                <div class="label">* Email</div>
                <input type="text" name="email" id="login" required/>
            </div>
            <div>
                <div class="label">* No Telepon</div>
                <input type="text" name="tlp" id="login" required/>
            </div>
            <div>
                <div class="label">* Alamat Rumah</div>
                <textarea name="alamat" required></textarea>
            </div>
            <button type="button" onclick='aksi.register();'>Daftar</button>
            </form>
            <div class="footer">
            Sudah Punya Akun ? &nbsp;&nbsp;
            <a href="#login_form" id="join_pop">Login Sekarang!</a>
            </div>

            <a class="close" href="#close"></a>
        </div>
<?php } ?>
         <!-- Alert Form -->

      <a href="#x" class="overlay" id="alert_form"></a>
        <div class="popup" id="alert">

            <div class="form">Sukses</div><br>
               <div class="i_alert">
                Data pemesanan anda sedang kami proses. Silahkan cek email anda untuk melihat konfimasi dari kami . Apabila dalam 24 jam tidak ada respon mohon hubungi Customer Service kami di: <br> <b><i class="fa fa-phone "></i> 0823 1746 1564 </b> <br> Atau lewat Email Kami <br> <b><i class="fa fa-mail-forward "></i>  owner@huzaini.fashion</b>
                </div>
            <a href="index.php"><button>Ok</button></a>

            <a class="close" href="#close"></a>
        </div>
