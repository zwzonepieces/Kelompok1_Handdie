<?php
class Produk extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_produk');
		$this->load->model('m_pengguna');
		$this->load->library('upload');
	}
	function index(){
		$kode=$this->session->userdata('idadmin');
		$x['user']=$this->m_pengguna->get_pengguna_login($kode);
		$x['join2'] = $this->m_produk->duatable(); 
		$x['data']=$this->m_produk->get_all_produk();
		$this->load->view('admin/v_produk',$x);
	}
	function super(){
		$kode=$this->session->userdata('idadmin');
		$x['user']=$this->m_pengguna->get_pengguna_login($kode);
		$x['join2'] = $this->m_produk->duatable(); 
		$x['data']=$this->m_produk->get_all_produk();
		$this->load->view('admin/v_admin_produk',$x);
	}
	function add_produk(){
		$x['kat']=$this->m_kategori->get_all_kategori();
		$this->load->view('admin/v_add_produk',$x);
	}
	function add_produk_admin(){
		$x['kat']=$this->m_kategori->get_all_kategori();
		$this->load->view('admin/v_add_produk_admin',$x);
	}
	function get_edit(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_produk->get_produk_by_kode($kode);
		$x['kat']=$this->m_kategori->get_all_kategori();
		$this->load->view('admin/v_edit_produk',$x);
	}
	function get_edit_admin(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_produk->get_produk_by_kode($kode);
		$x['kat']=$this->m_kategori->get_all_kategori();
		$this->load->view('admin/v_edit_produk_admin',$x);
	}
	function simpan_produk(){
				$config['upload_path'] = './assets/images/'; //path folder
	            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

	            $this->upload->initialize($config);
	            if(!empty($_FILES['filefoto']['name']))
	            {
	                if ($this->upload->do_upload('filefoto'))
	                {
	                        $gbr = $this->upload->data();
	                        //Compress Image
	                        $config['image_library']='gd2';
	                        $config['source_image']='./assets/images/'.$gbr['file_name'];
	                        $config['create_thumb']= FALSE;
	                        $config['maintain_ratio']= FALSE;
	                        $config['quality']= '60%';
	                        $config['width']= 840;
	                        $config['height']= 450;
	                        $config['new_image']= './assets/images/'.$gbr['file_name'];
	                        $this->load->library('image_lib', $config);
	                        $this->image_lib->resize();

	                        $gambar=$gbr['file_name'];
							$judul=strip_tags($this->input->post('xjudul'));
							$filter=str_replace("?", "", $judul);
							$filter2=str_replace("$", "", $filter);
							$pra_slug=$filter2.'.html';
							$slug=strtolower(str_replace(" ", "-", $pra_slug));
							$harga=$this->input->post('xharga');
							$isi=$this->input->post('xisi');
							$kategori_id=strip_tags($this->input->post('xkategori'));
							$data=$this->m_kategori->get_kategori_byid($kategori_id);
							$q=$data->row_array();
							$kategori_nama=$q['kategori_nama'];
							$kode=$this->session->userdata('idadmin');
							$user=$this->m_pengguna->get_pengguna_login($kode);
							$p=$user->row_array();
							$user_id=$p['pengguna_id'];
							$user_nama=$p['pengguna_nama'];
							$this->m_produk->simpan_produk($judul,$harga,$isi,$kategori_id,$kategori_nama,$user_id,$user_nama,$gambar,$slug);
							echo $this->session->set_flashdata('msg','success');
							redirect('admin/produk');
					}else{
	                    echo $this->session->set_flashdata('msg','warning');
	                    redirect('admin/produk');
	                }
	                 
	            }else{
					redirect('admin/produk');
				}
				
	}
	
	function update_produk(){
				
	            $config['upload_path'] = './assets/images/'; //path folder
	            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

	            $this->upload->initialize($config);
	            if(!empty($_FILES['filefoto']['name']))
	            {
	                if ($this->upload->do_upload('filefoto'))
	                {
	                        $gbr = $this->upload->data();
	                        //Compress Image
	                        $config['image_library']='gd2';
	                        $config['source_image']='./assets/images/'.$gbr['file_name'];
	                        $config['create_thumb']= FALSE;
	                        $config['maintain_ratio']= FALSE;
	                        $config['quality']= '60%';
	                        $config['width']= 840;
	                        $config['height']= 450;
	                        $config['new_image']= './assets/images/'.$gbr['file_name'];
	                        $this->load->library('image_lib', $config);
	                        $this->image_lib->resize();

	                        $gambar=$gbr['file_name'];
	                        $produk_id=$this->input->post('kode');
	                        $judul=strip_tags($this->input->post('xjudul'));
	                        $filter=str_replace("?", "", $judul);
							$filter2=str_replace("$", "", $filter);
							$pra_slug=$filter2.'.html';
							$slug=strtolower(str_replace(" ", "-", $pra_slug));
							$harga=$this->input->post('xharga');
							$isi=$this->input->post('xisi');
							$kategori_id=strip_tags($this->input->post('xkategori'));
							$data=$this->m_kategori->get_kategori_byid($kategori_id);
							$q=$data->row_array();
							$kategori_nama=$q['kategori_nama'];
							$kode=$this->session->userdata('idadmin');
							$user=$this->m_pengguna->get_pengguna_login($kode);
							$p=$user->row_array();
							$user_id=$p['pengguna_id'];
							$user_nama=$p['pengguna_nama'];
							$this->m_produk->update_produk($produk_id,$judul,$harga,$isi,$kategori_id,$kategori_nama,$user_id,$user_nama,$gambar,$slug);
							echo $this->session->set_flashdata('msg','info');
							redirect('admin/produk');
	                    
	                }else{
	                    echo $this->session->set_flashdata('msg','warning');
	                    redirect('admin/pengguna');
	                }
	                
	            }else{
							$produk_id=$this->input->post('kode');
							$judul=strip_tags($this->input->post('xjudul'));
							$filter=str_replace("?", "", $judul);
							$filter2=str_replace("$", "", $filter);
							$pra_slug=$filter2.'.html';
							$slug=strtolower(str_replace(" ", "-", $pra_slug));
							$harga=$this->input->post('xharga');
							$isi=$this->input->post('xisi');
							$kategori_id=strip_tags($this->input->post('xkategori'));
							$data=$this->m_kategori->get_kategori_byid($kategori_id);
							$q=$data->row_array();
							$kategori_nama=$q['kategori_nama'];
							$kode=$this->session->userdata('idadmin');
							$user=$this->m_pengguna->get_pengguna_login($kode);
							$p=$user->row_array();
							$user_id=$p['pengguna_id'];
							$user_nama=$p['pengguna_nama'];
							$this->m_produk->update_produk_tanpa_img($produk_id,$judul,$harga,$isi,$kategori_id,$kategori_nama,$user_id,$user_nama,$slug);
							echo $this->session->set_flashdata('msg','info');
							redirect('admin/produk');
	            } 

	}
	function update_produk_admin(){
				
        $config['upload_path'] = './assets/images/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']['name']))
        {
            if ($this->upload->do_upload('filefoto'))
            {
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library']='gd2';
                    $config['source_image']='./assets/images/'.$gbr['file_name'];
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= FALSE;
                    $config['quality']= '60%';
                    $config['width']= 840;
                    $config['height']= 450;
                    $config['new_image']= './assets/images/'.$gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $gambar=$gbr['file_name'];
                    $produk_id=$this->input->post('kode');
                    $judul=strip_tags($this->input->post('xjudul'));
                    $filter=str_replace("?", "", $judul);
					$filter2=str_replace("$", "", $filter);
					$pra_slug=$filter2.'.html';
					$slug=strtolower(str_replace(" ", "-", $pra_slug));
					$harga=$this->input->post('xharga');
					$isi=$this->input->post('xisi');
					$kategori_id=strip_tags($this->input->post('xkategori'));
					$data=$this->m_kategori->get_kategori_byid($kategori_id);
					$q=$data->row_array();
					$kategori_nama=$q['kategori_nama'];
					$kode=$this->session->userdata('idadmin');
					$user=$this->m_pengguna->get_pengguna_login($kode);
					$p=$user->row_array();
					$user_id=$p['pengguna_id'];
					$user_nama=$p['pengguna_nama'];
					$this->m_produk->update_produk($produk_id,$judul,$harga,$isi,$kategori_id,$kategori_nama,$user_id,$user_nama,$gambar,$slug);
					echo $this->session->set_flashdata('msg','info');
					redirect('admin/produk/super');
                
            }else{
                echo $this->session->set_flashdata('msg','warning');
                redirect('admin/pengguna/super');
            }
            
        }else{
					$produk_id=$this->input->post('kode');
					$judul=strip_tags($this->input->post('xjudul'));
					$filter=str_replace("?", "", $judul);
					$filter2=str_replace("$", "", $filter);
					$pra_slug=$filter2.'.html';
					$slug=strtolower(str_replace(" ", "-", $pra_slug));
					$harga=$this->input->post('xharga');
					$isi=$this->input->post('xisi');
					$kategori_id=strip_tags($this->input->post('xkategori'));
					$data=$this->m_kategori->get_kategori_byid($kategori_id);
					$q=$data->row_array();
					$kategori_nama=$q['kategori_nama'];
					$kode=$this->session->userdata('idadmin');
					$user=$this->m_pengguna->get_pengguna_login($kode);
					$p=$user->row_array();
					$user_id=$p['pengguna_id'];
					$user_nama=$p['pengguna_nama'];
					$this->m_produk->update_produk_tanpa_img($produk_id,$judul,$harga,$isi,$kategori_id,$kategori_nama,$user_id,$user_nama,$slug);
					echo $this->session->set_flashdata('msg','info');
					redirect('admin/produk/super');
        } 

	}

	function hapus_produk(){
		$kode=$this->input->post('kode');
		$gambar=$this->input->post('gambar');
		$path='./assets/images/'.$gambar;
		unlink($path);
		$this->m_produk->hapus_produk($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/produk');
	}
	function hapus_produk_admin(){
		$kode=$this->input->post('kode');
		$gambar=$this->input->post('gambar');
		$path='./assets/images/'.$gambar;
		unlink($path);
		$this->m_produk->hapus_produk($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/produk/super');
	}

}