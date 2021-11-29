<?php
class M_produk extends CI_Model{

	function get_all_produk(){
		$hsl=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_produk ORDER BY produk_id DESC");
		return $hsl;
	}
	public function duatable() {
	$id_admin=$this->session->userdata('idadmin');
	 $this->db->select("*");
	 $this->db->from("tbl_pengguna");
	 $this->db->join("tbl_produk","tbl_pengguna.pengguna_id=tbl_produk.produk_pengguna_id WHERE produk_pengguna_id='$id_admin'");
	 $query = $this->db->get();
	 return $query->result();
	}
	function simpan_produk($judul,$harga,$isi,$kategori_id,$kategori_nama,$user_id,$user_nama,$gambar,$slug){
		$hsl=$this->db->query("insert into tbl_produk(produk_judul,produk_harga,produk_isi,produk_kategori_id,produk_kategori_nama,produk_pengguna_id,produk_author,produk_gambar,produk_slug) values ('$judul','$harga','$isi','$kategori_id','$kategori_nama','$user_id','$user_nama','$gambar','$slug')");
		return $hsl;
	}
	function simpan_order($nama,$alamat,$email,$nohp,$produk_id,$produk_nama,$produk_harga){
		$hsl=$this->db->query("insert into tbl_pembeli(pembeli_nama,pembeli_alamat,pembeli_email,pembeli_nohp,pembeli_produk_id,pembeli_produk_nama,pembeli_produk_harga) values ('$nama','$alamat','$email','$nohp','$produk_id','$produk_nama','$produk_harga')");
		return $hsl;
	}
	function get_barang($kobar){
		$hsl=$this->db->query("SELECT * FROM tbl_produk where produk_id='$kobar'");
		return $hsl;
	}
	public function detailjoin($kode) {
	 $hsl=$this->db->select("*");
	 $hsl=$this->db->from("tbl_produk");
	 $hsl=$this->db->join("tbl_pengguna","tbl_produk.produk_pengguna_id=tbl_pengguna.pengguna_id");
	 $hsl=$this->db->where("tbl_produk.produk_id",$kode);
	 $hsl=$this->db->get();
	 return $hsl;
	}
	public function detailorder($kode) {
	 $hsl=$this->db->select("*");
	 $hsl=$this->db->from("tbl_pengguna");
	 $hsl=$this->db->join("tbl_produk","tbl_pengguna.pengguna_id=tbl_produk.produk_pengguna_id");
	 $hsl=$this->db->join("tbl_pembeli","tbl_produk.produk_id=tbl_pembeli.pembeli_produk_id");
	 $hsl=$this->db->where("tbl_produk.produk_id",$kode);
	 $hsl=$this->db->get();
	 return $hsl;
	}
	function get_pembeli_by_kode($kode){
		$hsl=$this->db->query("SELECT * FROM tbl_pembeli where pembeli_id='$kode'");
		return $hsl;
	}
	function get_produk_by_kode($kode){
		$hsl=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_produk where produk_id='$kode'");
		return $hsl;
	}
	function update_produk($produk_id,$judul,$harga,$isi,$kategori_id,$kategori_nama,$user_id,$user_nama,$gambar,$slug){
		$hsl=$this->db->query("update tbl_produk set produk_judul='$judul',produk_harga='$harga',produk_isi='$isi',produk_kategori_id='$kategori_id',produk_kategori_nama='$kategori_nama',produk_pengguna_id='$user_id',produk_author='$user_nama',produk_gambar='$gambar',produk_slug='$slug' where produk_id='$produk_id'");
		return $hsl;
	}
	function update_produk_tanpa_img($produk_id,$judul,$harga,$isi,$kategori_id,$kategori_nama,$user_id,$user_nama,$slug){
		$hsl=$this->db->query("update tbl_produk set produk_judul='$judul',produk_isi='$isi',produk_harga='$harga',produk_kategori_id='$kategori_id',produk_kategori_nama='$kategori_nama',produk_pengguna_id='$user_id',produk_author='$user_nama',produk_slug='$slug' where produk_id='$produk_id'");
		return $hsl;
	}
	function hapus_produk($kode){
		$hsl=$this->db->query("delete from tbl_produk where produk_id='$kode'");
		return $hsl;
	}



	//Front-End

	function get_post_home(){
		$hsl=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d %M %Y') AS tanggal FROM tbl_produk ORDER BY produk_id DESC limit 3");
		return $hsl;
	}

	function get_berita_slider(){
		$hsl=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_produk where produk_img_slider='1' ORDER BY produk_id DESC");
		return $hsl;
	}

	function berita_perpage($offset,$limit){
		$hsl=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_produk ORDER BY produk_id DESC limit $offset,$limit");
		return $hsl;
	}

	function berita(){
		$hsl=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_produk ORDER BY produk_id DESC");
		return $hsl;
	} 
	function get_berita_by_slug($slug){
		$hsl=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_produk where produk_slug='$slug'");
		return $hsl;
	}

	function get_produk_by_kategori($kategori_id){
		$hsl=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_produk where produk_kategori_id='$kategori_id'");
		return $hsl;
	}

	function get_produk_by_kategori_perpage($kategori_id,$offset,$limit){
		$hsl=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_produk where produk_kategori_id='$kategori_id' limit $offset,$limit");
		return $hsl;
	}

	function search_produk($keyword){
		$hsl=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_produk WHERE produk_judul LIKE '%$keyword%'");
		return $hsl;
	}

	function post_komentar($nama,$email,$web,$msg,$produk_id){
		$hsl=$this->db->query("INSERT INTO tbl_komentar (komentar_nama,komentar_email,komentar_web,komentar_isi,komentar_produk_id) VALUES ('$nama','$email','$web','$msg','$produk_id')");
		return $hsl;
	}


	function count_views($kode){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        $cek_ip=$this->db->query("SELECT * FROM tbl_post_views WHERE views_ip='$user_ip' AND views_produk_id='$kode' AND DATE(views_tanggal)=CURDATE()");
        if($cek_ip->num_rows() <= 0){
            $this->db->trans_start();
				$this->db->query("INSERT INTO tbl_post_views (views_ip,views_produk_id) VALUES('$user_ip','$kode')");
				$this->db->query("UPDATE tbl_produk SET produk_views=produk_views+1 where produk_id='$kode'");
			$this->db->trans_complete();
			if($this->db->trans_status()==TRUE){
				return TRUE;
			}else{
				return FALSE;
			}
        }
    }

    //Count rating Good
    function count_good($kode){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        $cek_ip=$this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_produk_id='$kode'");
        if($cek_ip->num_rows() <= 0){
            $this->db->trans_start();
				$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_produk_id) VALUES('$user_ip','1','$kode')");
				$this->db->query("UPDATE tbl_produk SET produk_rating=produk_rating+1 where produk_id='$kode'");
			$this->db->trans_complete();
			if($this->db->trans_status()==TRUE){
				return TRUE;
			}else{
				return FALSE;
			}
        }
    }

    //Count rating Like
    function count_like($kode){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        $cek_ip=$this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_produk_id='$kode'");
        if($cek_ip->num_rows() <= 0){
            $this->db->trans_start();
				$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_produk_id) VALUES('$user_ip','2','$kode')");
				$this->db->query("UPDATE tbl_produk SET produk_rating=produk_rating+2 where produk_id='$kode'");
			$this->db->trans_complete();
			if($this->db->trans_status()==TRUE){
				return TRUE;
			}else{
				return FALSE;
			}
        }
    }

    //Count rating Like
    function count_love($kode){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        $cek_ip=$this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_produk_id='$kode'");
        if($cek_ip->num_rows() <= 0){
            $this->db->trans_start();
				$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_produk_id) VALUES('$user_ip','3','$kode')");
				$this->db->query("UPDATE tbl_produk SET produk_rating=produk_rating+3 where produk_id='$kode'");
			$this->db->trans_complete();
			if($this->db->trans_status()==TRUE){
				return TRUE;
			}else{
				return FALSE;
			}
        }
    }

    //Count rating Like
    function count_genius($kode){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        $cek_ip=$this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_produk_id='$kode'");
        if($cek_ip->num_rows() <= 0){
            $this->db->trans_start();
				$this->db->query("INSERT INTO tbl_post_rating (rate_ip,rate_point,rate_produk_id) VALUES('$user_ip','4','$kode')");
				$this->db->query("UPDATE tbl_produk SET produk_rating=produk_rating+4 where produk_id='$kode'");
			$this->db->trans_complete();
			if($this->db->trans_status()==TRUE){
				return TRUE;
			}else{
				return FALSE;
			}
        }
    }

    function cek_ip_rate($kode){
    	$user_ip=$_SERVER['REMOTE_ADDR'];
        $hsl=$this->db->query("SELECT * FROM tbl_post_rating WHERE rate_ip='$user_ip' AND rate_produk_id='$kode'");
        return $hsl;
    }


    function get_produk_populer(){
		$hasil=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d %M %Y') AS tanggal FROM tbl_produk ORDER BY produk_views DESC limit 10");
		return $hasil;
	}

	function get_produk_terbaru(){
		$hasil=$this->db->query("SELECT tbl_produk.*,DATE_FORMAT(produk_tanggal,'%d %M %Y') AS tanggal FROM tbl_produk ORDER BY produk_id DESC limit 10");
		return $hasil;
	}

	function get_kategori_for_blog(){
		$hasil=$this->db->query("SELECT COUNT(produk_kategori_id) AS jml,kategori_id,kategori_nama FROM tbl_produk JOIN tbl_kategori ON produk_kategori_id=kategori_id GROUP BY produk_kategori_id");
		return $hasil;
	}
	

}