 <!--Counter Inbox-->
 <?php
  $query = $this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
  $jum_pesan = $query->num_rows();
  $query1 = $this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
  $jum_komentar = $query1->num_rows();
  ?>
 <!DOCTYPE html>
 <html>

 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Handdie | Post List</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/img/team/logo.jpeg' ?>">
   <!-- Bootstrap 3.3.6 -->
   <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
   <!-- DataTables -->
   <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
   <!-- Theme style -->
   <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
   <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />

   <?php
    function limit_words($string, $word_limit)
    {
      $words = explode(" ", $string);
      return implode(" ", array_splice($words, 0, $word_limit));
    }

    ?>

 </head>

 <body class="hold-transition skin-blue sidebar-mini">
   <div class="wrapper">

     <?php
      $this->load->view('admin/v_header');
      $this->load->view('admin/v_sidebar');
      ?>

     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
         <h1>
           Post Lists
           <small></small>
         </h1>
         <ol class="breadcrumb">
           <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
           <li><a href="#">Post</a></li>
           <li class="active">Lists</li>
         </ol>
       </section>

       <!-- Main content -->
       <section class="content">
         <div class="row">
           <div class="col-xs-12">
             <div class="box">

               <div class="box">
                 <div class="box-header">
                   <a class="btn btn-success btn-flat" href="<?php echo site_url() . '/admin/produk/add_produk' ?>"><span class="fa fa-plus"></span> Add New</a>
                 </div>
                 <!-- /.box-header -->
                 <div class="box-body">
                   <table id="example1" class="table table-striped" style="font-size:13px;">
                     <thead>
                       <tr>
                         <th>Gambar</th>
                         <th>Nama Produk</th>
                         <th>Harga</th>
                         <th>Deskripsi</th>
                         <th>Tanggal</th>
                         <th>Nama Toko</th>
                         <th>Baca</th>
                         <th>Kategori</th>
                         <th style="text-align:right;">Aksi</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php
                        foreach ($join2 as $row) { ?>
                         <tr>
                           <td><img src="<?php echo base_url() . 'assets/images/' . $row->produk_gambar; ?>" style="width:90px;"></td>
                           <td><?php echo $row->produk_judul; ?></td>
                           <td><?php echo $row->produk_harga; ?></td>
                           <td class="small">
                             <?php echo substr($row->produk_isi, 0, 120) ?>...</td>
                           <td><?php echo $row->produk_tanggal; ?></td>
                           <td><?php echo $row->produk_author; ?></td>
                           <td><?php echo $row->produk_views; ?></td>
                           <td><?php echo $row->produk_kategori_nama; ?></td>
                           <td style="text-align:right;">
                             <a class="btn" href="<?php echo site_url() . '/admin/produk/get_edit/' . $row->produk_id; ?>"><span class="fa fa-pencil"></span></a>
                             <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $row->produk_id; ?>"><span class="fa fa-trash"></span></a>
                           </td>
                         </tr>
                       <?php } ?>
                     </tbody>
                   </table>
                 </div>
                 <!-- /.box-body -->
               </div>
               <!-- /.box -->
             </div>
             <!-- /.col -->
           </div>
           <!-- /.row -->
       </section>
       <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->
     <footer class="main-footer">
       <div class="pull-right hidden-xs">
         <b>Version</b> 1.3
       </div>
       <strong>Copyright &copy; 2021 <a>Kelompok1</a></strong>
     </footer>


     <div class="control-sidebar-bg"></div>
   </div>
   <!-- ./wrapper -->



   <?php foreach ($data->result_array() as $i) :
      $produk_id = $i['produk_id'];
      $produk_judul = $i['produk_judul'];
      $produk_gambar = $i['produk_gambar'];
    ?>
     <!--Modal Hapus Pengguna-->
     <div class="modal fade" id="ModalHapus<?php echo $produk_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
             <h4 class="modal-title" id="myModalLabel">Hapus Berita</h4>
           </div>
           <form class="form-horizontal" action="<?php echo site_url() . '/admin/produk/hapus_produk' ?>" method="post" enctype="multipart/form-data">
             <div class="modal-body">
               <input type="hidden" name="kode" value="<?php echo $produk_id; ?>" />
               <input type="hidden" value="<?php echo $produk_gambar; ?>" name="gambar">
               <p>Apakah Anda yakin mau menghapus Posting <b><?php echo $produk_judul; ?></b> ?</p>

             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   <?php endforeach; ?>




   <!-- jQuery 2.2.3 -->
   <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
   <!-- Bootstrap 3.3.6 -->
   <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
   <!-- DataTables -->
   <script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
   <script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
   <!-- SlimScroll -->
   <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
   <!-- FastClick -->
   <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
   <!-- AdminLTE App -->
   <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
   <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
   <!-- page script -->
   <script>
     $(function() {
       $("#example1").DataTable();
       $('#example2').DataTable({
         "paging": true,
         "lengthChange": false,
         "searching": false,
         "ordering": true,
         "info": true,
         "autoWidth": false
       });
     });
   </script>
   <?php if ($this->session->flashdata('msg') == 'error') : ?>
     <script type="text/javascript">
       $.toast({
         heading: 'Error',
         text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
         showHideTransition: 'slide',
         icon: 'error',
         hideAfter: false,
         position: 'bottom-right',
         bgColor: '#FF4859'
       });
     </script>

   <?php elseif ($this->session->flashdata('msg') == 'success') : ?>
     <script type="text/javascript">
       $.toast({
         heading: 'Success',
         text: "Berita Berhasil disimpan ke database.",
         showHideTransition: 'slide',
         icon: 'success',
         hideAfter: false,
         position: 'bottom-right',
         bgColor: '#7EC857'
       });
     </script>
   <?php elseif ($this->session->flashdata('msg') == 'info') : ?>
     <script type="text/javascript">
       $.toast({
         heading: 'Info',
         text: "Berita berhasil di update",
         showHideTransition: 'slide',
         icon: 'info',
         hideAfter: false,
         position: 'bottom-right',
         bgColor: '#00C9E6'
       });
     </script>
   <?php elseif ($this->session->flashdata('msg') == 'success-hapus') : ?>
     <script type="text/javascript">
       $.toast({
         heading: 'Success',
         text: "Berita Berhasil dihapus.",
         showHideTransition: 'slide',
         icon: 'success',
         hideAfter: false,
         position: 'bottom-right',
         bgColor: '#7EC857'
       });
     </script>
   <?php else : ?>

   <?php endif; ?>
 </body>

 </html>