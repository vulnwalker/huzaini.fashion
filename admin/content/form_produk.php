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

<!-- Popup Tambah -->

<a href="#x" class="overlay" id="add_form"></a>
    <div class="popup" id="produk">
        <a class="close" href="index.php?page=produk"></a>
            <div class="judul-set"><i class="fa fa-product-hunt"></i> Tambah Produk</div>
             <?php echo"<form method='post' enctype='multipart/form-data' id='formAddProduk' action='proses.php?act=add_produk'>"?>
                <div class="wadah">
                    <div>
                      <label>Nama Produk</label>
                      <input type="text" class="input" value=""  name="nama" id="nama" placeholder="Nama Produk" required />
                    </div>
                    <div>
                      <label>Jenis Produk</label>
                      <select name="jenis" id="jenis" class="input" required>
                        <option value="" selected disabled>- Pilih Salah Satu -</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                        <option value="PriaWanita">Pria dan Wanita</option>
                      </select>
                    </div>
                    <div>
                      <label>Info Produk</label>

                      <select name="kategori" class="input" id="kategori" required>
                      <option value="" selected disabled>- Pilih Kategori -</option>
                          <?php
                            $sqlkategori = query("SELECT *FROM kategori");
                            while ($datak = fetch($sqlkategori)) {
                             echo "<option value='$datak[id_kategori]'>$datak[nama_kat]</option>";
                              }
                             echo"</select>
                           <td>";
                          ?>
                      </select>
                    </div>
                    <div>
                      <label>Harga</label>
                      <input type="text" class="input" name="harga" id="harga" placeholder="Harga Produk" required />
                    </div>
                    <div>
                      <label>Stok</label>
                      <input type="text" class="input" name="stok" id="stok" placeholder="Stok Produk" required />
                    </div>
                    <div>
                      <label style="float:left; width:125px;">Deskripsi</label>
                      <textarea class="input ket" placeholder="Deskripsi" name="deskripsi" id="deskripsi" required></textarea>
                    </div>
                    <div>
                      <label>Foto</label>
                      <input type="file" id ="gambar" name="gambar"  required />
                    </div>
                    <input type="hidden" id='tempatBase' >
                    <div>
                       <button type="button" onclick=aksi.saveAddProduk() class="btn-save"><i class="fa fa-save"></i> Simpan</button>
                       <button type="reset"  class="btn-reset"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script type="text/javascript">
        if(window.File && window.FileList && window.FileReader)
        {
            var filesInput = document.getElementById("gambar");

            filesInput.addEventListener("change", function(event){

                var files = event.target.files; //FileList object
                var output = document.getElementById("result");

                for(var i = 0; i< files.length; i++)
                {
                    var file = files[i];

                    //Only pics
                    if(!file.type.match('image'))
                      continue;

                    var picReader = new FileReader();

                    picReader.addEventListener("load",function(event){

                        var picFile = event.target;

                        $("#tempatBase").val(picFile.result);


                    });

                     //Read the image
                    picReader.readAsDataURL(file);
                }

            });



            var filesInput2 = document.getElementById("gambar2");

            filesInput2.addEventListener("change", function(event){

                var files = event.target.files; //FileList object
                var output = document.getElementById("result");

                for(var i = 0; i< files.length; i++)
                {
                    var file = files[i];

                    //Only pics
                    if(!file.type.match('image'))
                      continue;

                    var picReader2 = new FileReader();

                    picReader2.addEventListener("load",function(event){

                        var picFile = event.target;


                        $("#tempatBase2").val(picFile.result);


                    });

                     //Read the image
                    picReader.readAsDataURL(file);
                }

            });
        }
        else
        {
            console.log("Your browser does not support File API");
        }


    </script>
<!-- popup form #2 -->
<?php
  $kode  = $_GET['id'];
  $query = query("SELECT *FROM produk WHERE id='$kode'");
  $data  = fetch($query);
?>

<a href="#x" class="overlay" id="edit_form"></a>
    <div class="popup" id="produk">
        <a class="close" href="index.php?page=produk"></a>
            <div class="judul-set"><i class="fa fa-product-hunt"></i> Tambah Produk</div>
             <?php echo"<form method='post' enctype='multipart/form-data' id='formEditProduk' action='proses.php?act=edit_produk'>"?>
                <div class="wadah">
                <?php echo'<input type="hidden" value="'.$data['id'].'" name="id">';?>
                    <div>
                      <label>Nama Produk</label>
                      <?php echo'<input type="text" class="input" value="'.$data['nama_produk'].'"  id="nama2" name="nama" placeholder="Nama Produk" required />';?>
                    </div>
                    <div>
                      <label>Jenis Produk</label>
                      <select name="jenis" id='jenis2' class="input" required>
                        <?php
                        if ($data['jenis']=='Pria') {
                            echo"<option value=" . $data['jenis'] . " selected>" . $data['jenis'] . "</option>
                                 <option value='Wanita'>Wanita</option>
                                 <option value='Pria dan Wanita'>Pria dan Wanita</option>";
                        } elseif ($data['jenis']=='Wanita') {
                            echo"<option value=" . $data['jenis'] . " selected>" . $data['jenis'] . "</option>
                                 <option value='Pria'>Pria</option>
                                 <option value='Pria dan Wanita'>Pria dan Wanita</option>";
                        } else {
                            echo"<option value=" . $data['jenis'] . " selected>" . $data['jenis'] . "</option>
                                 <option value='Pria'>Pria</option>
                                 <option value='Wanita'>Wanita</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div>
                      <label>Info Produk</label>

                      <select name="kategori" id = 'kategori2' class="input" required>
                      <option value="" selected disabled>- Pilih Kategori -</option>
                          <?php
                            $sqlkategori = query("SELECT *FROM kategori");
                            while ($datak = fetch($sqlkategori)) {
                              if ($data[id_kategori] == $datak[id_kategori]) {
                                echo"<option value=" . $data[id_kategori] . " selected>" . $datak['nama_kat'] . "</option>";
                              } else {
                             echo "<option value='$datak[id_kategori]'>$datak[nama_kat]</option>";
                              }
                             }
                             echo"</select>
                           <td>";
                          ?>
                      </select>
                    </div>
                    <div>
                      <label>Harga</label>
                      <?php echo'<input type="text" class="input" value="'.$data[harga].'"name="harga" id ="harga2" placeholder="Harga Produk" required />';?>
                    </div>
                    <div>
                      <label style="float:left; width:125px;">Deskripsi</label>
                    <textarea class="input ket" placeholder="Deskripsi" name="deskripsi" id='deskripsi2' required><?php echo $data[deskripsi];?></textarea>
                    </div>
                    <div>
                      <label>Foto</label>
                      <input type="file" name="gambar2" id ="gambar2">
                      <input type="hidden" id='tempatBase2' >
                    </div>
                    <div>
                       <button type="button" class="btn-save" onclick=aksi.saveEditProduk(<?php echo $data[id]; ?>)><i class="fa fa-save"></i> Simpan</button>
                       <button type="reset"  class="btn-reset"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    <script type="text/javascript">
        if(window.File && window.FileList && window.FileReader)
        {



            var img = document.getElementById("gambar2");

            img.addEventListener("change", function(event){

                var files = event.target.files;


                for(var i = 0; i< files.length; i++)
                {
                    var file = files[i];

                    //Only pics
                    if(!file.type.match('image'))
                      continue;

                    var picReader2 = new FileReader();

                    picReader2.addEventListener("load",function(event){

                        var picFile = event.target;


                        $("#tempatBase2").val(picFile.result);


                    });

                     //Read the image
                    picReader2.readAsDataURL(file);
                }

            });
        }
        else
        {
            console.log("Your browser does not support File API");
        }


    </script>

<!-- stok -->
<?php
  $id  = $_GET['kd'];
  $sql = query("SELECT *FROM produk WHERE id='$id'");
  $row = fetch($sql);
?>

<a href="#x" class="overlay" id="stok_form"></a>
    <div class="popup">
        <a class="close" href="index.php?page=produk"></a>
            <div class="judul-set"><i class="fa fa-product-hunt"></i> Tambah Stok</div>
             <?php echo"<form method='post' action='proses.php?act=tambah_stok'>"?>
                <div class="wadah">
                    <div>
                      <label>Id Produk</label>
                      <?php  echo"<input type='text' class='input not' name='id' value='$id' readonly />"?>
                    </div>
                    <div>
                      <label>Nama</label>
                      <?php $namaProduk = $row['nama_produk']; echo"<input type='text' class='input not' name='nama_produk' value='$namaProduk' readonly />"?>
                    </div>
                    <div>
                      <label>Stok Awal</label>
                       <?php  echo"<input type='text' class='input not' name='stok_awal' value='$row[stok]' readonly />"?>
                    </div>
                    <div>
                      <label>Tambah Stok</label>
                      <input type="number" class="input" name="add" id='jumlahAdd' min="1" value="1" required />
                    </div>
                    <div>
                       <button type="button" onclick=aksi.addStok(<?php echo $id; ?>); class="btn-save"><i class="fa fa-save"></i> Simpan</button>
                       <button type="reset"  class="btn-reset"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
