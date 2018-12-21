 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_library extends CI_model {

	public function getdata($key)

	{
		$this->db->where('no_buku', $key);
		$hasil = $this->db->get('library');
		return $hasil;
	}

	public function getupdate($key,$data)
	{
		$this->db->where('no_buku', $key);
		$this->db->update('library', $data);
	}

	public function getinsert($data)
	{
		$this->db->insert('library',$data);
	}

	public function getdelete($key)
	{
		$this->db->where('no_buku', $key);
		$this->db->delete('library');
	}
	
	
}
  