<?php session_start();
$file="profile.php";
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
echo'
<style>
#setprof div#posprof{
    margin:15px 10px 10px 10px;
    padding-left:20px;
}

#setprof label{
    font-size:15px;
    color:#444;
    margin-bottom:5px;
}

#setprof input{
    width:500px;
    height:45px;
    border:2px solid #37415B;
}

#setprof input[type="text"],
#setprof input[type="tel"],
#setprof input[type="email"]{
    padding-left:20px;
}

#setprof textarea{
    width:500px;
    border:2px solid #37415B;
    height:160px;
    margin-left : 0;
    padding-left:20px;
}

#setprof button {
    padding:10px 60px;
    margin-right:10px;
}

#setprof button[type="submit"] {
    background:#3498DB;
    border:1px solid #11C0FF;
    color:#fff;
}

#setprof button[type="reset"] {
    background:#D24525;
    border:1px solid #D24525;
    color:#fff;
}
</style>
<div class="nav">
	<div class="col-wd-12">
		<div class="col animated fadeInDown">
			<i class="fa fa-home"></i>
				<a href="index.php"> Beranda </a>
			<i class="fa fa-angle-right"></i>
				<a href="#">Profile Member</a>
		</div>
	</div>
</div>
<div class="col-wd-12">
	<div class="deskripsi">
		<div class="col animated zoomIn delay-08s">
			<div class="jhistori">Edit Profile</div>
';


$grabProfile = mysql_fetch_array(mysql_query("select * from user where username = '".$_SESSION[user]."'"));
$namaLengkap = $grabProfile['nama_lengkap'];
$email = $grabProfile['email'];
$telepon = $grabProfile['tlp'];
$alamat = $grabProfile['alamat'];
$uname = $_SESSION[user];

    echo '<div class="col animated fadeInRight delay-12s" id="setprof">

            <div id="posprof">
            <input type="hidden" name="uname" id = "uname" value="'.$uname.'">
            <input type="text" name="nama_lengkap" id = "namaLengkap" placeholder="Nama Lengkap" value="'.$namaLengkap.'"></div>
            <div id="posprof">
            <input type="email" name="email" id = "email" placeholder="No telepon" value="'.$email.'"></div>
            <div id="posprof">
            <input type="tel" name="tlp" id="tlp" placeholder="No telepon" value="'.$telepon.'"></div>
            <div id="posprof">
            <textarea name="alamat" id= "alamat" placeholder="Alamat">'.$alamat.'</textarea></div>
            <div id="posprof">
            <button type="submit" onclick=aksi.editProfile();>Update profile</button>
            <button type="reset" onclick=aksi.reset();>Reset</button></div>

        </div>
          ';

		echo'

		</div>
	</div>
	<br>
</div>';

?>
