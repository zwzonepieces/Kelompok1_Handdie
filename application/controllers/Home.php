<?php
/**
 * 
 */
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_kategori');
		$this->load->model('m_produk');
	}
	function index(){
		$x['join'] = $this->m_kategori->duatable2(); 
		$x['data']=$this->m_produk->get_all_produk();
		$this->load->view('layout/header.php');
		$this->load->view('layout/home.php',$x);
		$this->load->view('layout/tentang.php');
		$this->load->view('layout/team.php');
		$this->load->view('layout/kontak.php');
		$this->load->view('layout/footer.php');
	}
	function get_detail(){
		/*$produk_harga=$this->input->post('produk_harga');
		$x['qty']=$this->input->post('qty');
		$x['total']=$produk_harga*$x['qty'];*/

		$kode=$this->uri->segment(3);
		$x['data']=$this->m_produk->detailjoin($kode); 
		// $x['data']=$this->m_produk->get_produk_by_kode($kode);
		$x['kat']=$this->m_kategori->get_all_kategori();
		$this->load->view('layout/header.php');
		$this->load->view('v_detail',$x);
		$this->load->view('layout/footer.php');
	}
	function order(){
		/*$produk_harga=$this->input->post('produk_harga');
		$x['qty']=$this->input->post('qty');
		$x['total']=$produk_harga*$x['qty'];*/

		$kode=$this->uri->segment(3);
		$x['data']=$this->m_produk->detailjoin($kode); 
		// $x['data']=$this->m_produk->get_produk_by_kode($kode);
		$x['kat']=$this->m_kategori->get_all_kategori();
		$this->load->view('layout/header.php');
		$this->load->view('v_order',$x);
		$this->load->view('layout/footer.php');
	}
	function simpan_order(){
		$kode=$this->uri->segment(3);
		$x['data']=$this->m_produk->detailorder($kode); 
		$x['kat']=$this->m_kategori->get_all_kategori();

        $nama=$this->input->post('xnama');
        $alamat=$this->input->post('xalamat');
        $email=$this->input->post('xemail');
        $nohp=$this->input->post('xkontak');
        $produk_id=$this->input->post('xprodukid');
        $produk_nama=$this->input->post('xnamaproduk');
        $produk_harga=$this->input->post('xharga');
        $this->m_produk->simpan_order($nama,$alamat,$email,$nohp,$produk_id,$produk_nama,$produk_harga);
       
		redirect('home/order#bayar');
				
	}
}