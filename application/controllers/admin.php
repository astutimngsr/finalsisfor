<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index() {
		$this->load->view('admin/index');
	}
	public function login() {
		$this->load->view('login');
	}
	public function getlogin() 
	{
		$u = $this->input->post('username');
		$p = $this->input->post('password');
		$this->load->model('model_login');
		$this->model_login->getlogin($u,$p);
	}

	public function customer() {
		$this->load->view('admin/customer');
	}
	public function customerTambah(){
		$this->load->view('admin/customerForm');	
	}
	public function company() {
		$this->load->view('admin/company');
	}
	public function companyTambah(){
		$this->load->view('admin/companyForm');	
	}
	public function library() {
		{
		$this->load->model('Model_library');
		$isi['content'] = 'admin/library';
		$isi['judul']	= 'library';
		$isi['data'] = $this->db->get('library');
		$this->load->view('admin/library', $isi );

	}
	}
	public function libraryTambah(){
		
		
		$isi['content'] = 'admin/libraryForm';
		$isi['judul']	= 'library';
		$isi['sub_judul'] = 'tambah library'; 
		$isi['no_buku']	= '';
		$isi['judul_buku']	= '';
		$isi['kategori']	= '';
		$isi['penulis'] = '';
		$isi['bahasa']	= '';
		$isi['deskripsi_singkat_buku']	= '';
		$isi['status']	= '';
		$this->load->view('admin/libraryForm', $isi );
 
	}
	public function librarySimpan()
	{
		
		$key					= $this->input->post('no_buku');
		$data['no_buku']		= $this->input->post('no_buku');
		$data['judul_buku']		= $this->input->post('judul_buku');
		$data['kategori']		= $this->input->post('kategori');
		$data['penulis']		= $this->input->post('penulis');
		$data['bahasa']			= $this->input->post('bahasa');
		$data['deskripsi_singkat_buku']	= $this->input->post('deskripsi_singkat_buku');
		$data['status']			= $this->input->post('status');


		$this->load->model('model_library');
		$query = $this->model_library->getdata($key);
		if($query->num_rows()>0)
		{
			$this->model_library->getupdate($key,$data);
			$this->session->set_flashdata('info','data sukses di update');
		}
		else
		{
			$this->model_library->getinsert($data);
			$this->session->set_flashdata('info','data sukses di simpan');
		}
		redirect('admin/libraryTambah');
	}

	public function libraryEdit()
	{
	
		$isi['content'] = 'admin/libraryForm';
		$isi['judul']	= 'library';
		$isi['sub_judul'] = 'edit library'; 

		$key = $this->uri->segment(3);
		$this->db->where('no_buku', $key);
		$query = $this->db->get('library');
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row) 
			{
				$isi['no_buku']					= $row->no_buku;
				$isi['judul_buku']				= $row->judul_buku;
				$isi['kategori']				= $row->kategori;
				$isi['penulis'] 				= $row->penulis;
				$isi['bahasa']					= $row->bahasa;
				$isi['deskripsi_singkat_buku']	= $row->deskripsi_singkat_buku;
				$isi['status']					= $row->status;
			}

		}
		else
		{
				$isi['no_buku']					= '';
				$isi['judul_buku']				= '';
				$isi['kategori']				= '';
				$isi['penulis'] 				= '';
				$isi['bahasa']					= '';
				$isi['deskripsi_singkat_buku']	= '';
				$isi['status']					= '';
		}
		$this->load->view('admin/libraryForm', $isi );
 		

	}

	public function libraryDelete()
	{
		$this->load->model('model_library');

		$key = $this->uri->segment(3);
		$this->db->where('no_buku', $key);
		$query = $this->db->get('library'); 
		if($query->num_rows()>0)
		{
			$this->model_library->getdelete($key);
		} 
		redirect('admin/library');
	}
	public function product() {
		$this->load->view('admin/product');
	}
	public function productTambah(){
		$this->load->view('admin/productForm');	
	}
	public function post(){
		$this->load->view('admin/posts');	
	}
}
