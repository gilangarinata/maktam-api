<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Welcome extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

	public function index_get()
	{
		$date = $this->get('date');
		$this->db->where('date', $date);
		$kontak = $this->db->get('inventory_expense')->result();
        $this->response($kontak, 200);
	}

	public function index_post()
	{
		$data = array(
			'name'    => $this->post('name'),
			'total'   => $this->post('total'),
			'date'    => $this->post('date'),
		);
		$insert = $this->db->insert('inventory_expense', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

}
