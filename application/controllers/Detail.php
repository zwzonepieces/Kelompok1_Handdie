<?php
/**
 * 
 */
class Detail extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_kategori');
		$this->load->model('m_produk');
	}
	function index(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_produk->get_produk_by_kode($kode);
		$x['kat']=$this->m_kategori->get_all_kategori();
		$x['join'] = $this->m_kategori->duatable2(); 
		$x['data']=$this->m_produk->get_all_produk();
		$this->load->view('layout/header.php');
		$this->load->view('v_detail.php',$x);
		$this->load->view('layout/footer.php');
	}
	function get_detail(){
		$kode=$this->uri->segment(4);
		$x['data']=$this->m_produk->get_produk_by_kode($kode);
		$x['kat']=$this->m_kategori->get_all_kategori();
		$this->load->view('v_detail',$x);
	}
}