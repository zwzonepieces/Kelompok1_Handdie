        <section class="page-section">
            
        </section>
        <!-- Services-->
        <section class="page-section" id="detail">
            <?php
                $qty=$this->input->post('qty');
              $b=$data->row_array();
              ?>
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Detail Produk</h2>
                    <h3 class="section-subheading text-muted">Detail lengkap dari Handdie</h3>
                </div>
                <a class="btn btn-success" href="<?php echo site_url().'/home/'?>#kategori" role="button"><i class="fas fa-arrow-left"></i> Kembali</a>
                <br><br>
                <div class="card" style="max-width: 1500px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?php echo base_url('assets/images/').$b['produk_gambar'];?>"style="width: 450px;height: 340px;" class="card-img" alt="...">
                    </div>
                    
                    <div class="col-md-1"></div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h4 class="card-title text-uppercase mb-4"><i class="fas fa-store-alt mr-4"></i> <?php echo $b['pengguna_nama'];?></h4><hr>
                            <h5 class="card-title"><?php echo $b['produk_judul'];?></h5>
                            <h7 class="card-title">Kategori <?php echo $b['produk_kategori_nama'];?></h7><br><br>
                            <h6 class="card-title">Total Rp. <?php echo $b['produk_harga'];?></h6>
                            <br>

                            <p class="card-text">
                                <a class="btn btn-primary" href="<?php echo site_url().'/home/order/'.$b['produk_id'];?>#order" role="button"><i class="fas fa-cart-plus"></i> Pesan Produk</a>
                                <a class="btn btn-secondary" href="<?php echo site_url().'/home/get_detail/'.$b['produk_id'];?>#desk" role="button"><i class="fas fa-poll-h"></i> Deskripsi Produk</a>
                                <a class="btn btn-info" href="<?php echo site_url().'/home/get_detail/'.$b['produk_id'];?>#desk" role="button"><i class="fas fa-map-marked-alt"></i> Lokasi Handdie</a>
                                
                            </p>
                            <p class="card-text"><small class="text-muted">Diposting pada : <?php echo $b['produk_tanggal'];?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container" id="desk">
            <div class="card" style="max-width: 1502px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="card-body">
                            <p class="card-text">
                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                  <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                      <h5 class="mb-0">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          Deskripsi Produk
                                        </a>
                                      </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                      <div class="card-block ml-2">
                                        <?php echo $b['produk_isi'];?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="card-text">
                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                  <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                      <h5 class="mb-0">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          Alamat Toko
                                        </a>
                                      </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                      <div class="card-block ml-2">
                                        <?php echo $b['pengguna_alamat'];?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </p>
                        </div>
                    </div>

                </div>
            </div>      