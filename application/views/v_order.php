        <section class="page-section">
            
        </section>
        <!-- Services-->
        <section class="page-section" id="order">
            <?php
                $qty=$this->input->post('qty');
              $b=$data->row_array();
              ?>
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Isi Data Diri</h2>
                    <h3 class="section-subheading text-muted">Lengkapi Data Diri</h3>
                </div>
                <a class="btn btn-success" href="<?php echo site_url().'/home/'?>#kategori" role="button"><i class="fas fa-arrow-left"></i> Kembali</a>
                <br><br>

                <?php
                  $b=$data->row_array();
                  ?>
                <div id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                      <h5 class="mb-0" style="text-align:right;">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Masukan Data Diri  <i class="fas fa-chevron-down"></i>
                        </a>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="card-block ml-4">
                        <form class="form-horizontal" action="<?php echo site_url().'/home/simpan_order'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                                <div class="col-sm-12">
                                    <input type="text" name="xnama" class="form-control" id="inputUserName" placeholder="Nama Lengkap" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAlamat" class="col-sm-4 control-label">Alamat</label>
                                <div class="col-sm-12">
                                    <input type="text" name="xalamat" class="form-control" id="inputAlamat" style="height: 120px;" placeholder="Masukan Alamat" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" name="xemail" class="form-control" id="inputEmail3" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNohp" class="col-sm-4 control-label">No HP</label>
                                <div class="col-sm-12">
                                    <input type="text" name="xkontak" class="form-control" id="inputNohp" placeholder="Masukan No HP Ex. 081222333444" required>
                                </div>
                            </div>
                            <?php
                            $no=0;
                            foreach ($data->result_array() as $i) :
                               $produk_id=$i['produk_id'];
                               $produk_nama=$i['produk_judul'];
                               $produk_harga=$i['produk_harga'];
                               
                            ?>
                            <div class="form-group">
                                <label for="inputNamaP" class="col-sm-4 control-label">Nama Produk</label>
                                <div class="col-sm-12">
                                    <input type="hidden" name="xprodukid" value="<?php echo $produk_id;?>">
                                    <input type="text" name="xnamaproduk" class="form-control" id="inputNamaP" value="<?php echo $b['produk_judul'];?>" placeholder="Nama Produk" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputHarga" class="col-sm-4 control-label">Harga</label>
                                <div class="col-sm-12">
                                    <input type="text" name="xharga" class="form-control" id="inputHarga" placeholder="Harga" value="<?php echo $b['produk_harga'];?>" readonly="">
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  
                  <div class="card" id="bayar">
                    <div class="card-header" role="tab" id="headingTwo">
                      <h5 class="mb-0" style="text-align:right;">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Lakukan Pembayaran <i class="fas fa-chevron-down"></i>
                        </a>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo"><br>
                      <div class="card-block ml-4">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card" style="width: 1050px;">
                              <div class="card-block">
                                <h3 class="card-title text-center"> Silahkan Transfer Ke Rekeninng berikut</h3><hr>
                                <card class="text-center">
                                <p class="card-text">No Rekening : 0207-01-047838-50-3</p>
                                <p class="card-text">BANK : BRI</p>
                                <p class="card-text">A/N: Rizki Lutfiandi</p>
                                </card>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><br>
                  </div>
                </div>

            </div> 
            <!-- Penutup Container -->
        </section>
