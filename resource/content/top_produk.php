					<div class="list">
							<div class="col-wd-12">
								<div class="col">
									<i class="fa fa-product-hunt"></i> Produk Terlaris
								</div>
							</div>
						</div>

						<div class="item">
							<div class="col-wd-12">
					<?php
						$batas = 4;
						$sql = "SELECT *FROM produk,kategori,merek WHERE produk.id_kategori = kategori.id_kategori AND produk.id_merek = merek.id_merek AND produk.stok >= 3 order by produk.terjual DESC limit $batas";
      					$result =query($sql);
						$i = 2;
						while ($data=fetch($result)) {
    						echo'
								<div class="col-wd-3">
									<div class="col animated zoomIn delay-0'.$i.'s">
										<a href="index.php?page=produk&id='.$data['id'].'">
											<img src="data:image/png;base64,' . $data['foto'] . '">
										</a>
										<div class="detail">
											<div class="col-wd-12">
												'.$data['nama_produk'].'
											</div>
											<div class="info">
												<b>Rp. </b> '.rupiah($data['harga']).'
												<div class="merek">
													<b>Merek</b> : '.$data['nama_merek'].'
												</div>
											</div>
											<form action="proses.php?act=cart_session" method="POST">
												<input type="hidden" value="'.$data['id'].'" name="id">
												<button type="button" id="btn-cart" onclick=aksi.addToCart('.$data['id'].')>
													<i class="fa fa-shopping-cart"></i>
												</button>
											</form>
											<a href="index.php?page=produk&id='.$data['id'].'">
												<button id="btn-view">
														<i class="fa fa-search"></i>
												</button>
											</a>
										</div>
									</div>
								</div>';
								$i = $i + 2;
								}
							?>
						</div>
					</div>
