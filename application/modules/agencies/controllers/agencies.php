<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agencies extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('contact_model','ContactManager');
	}

	public function index()
	{
		
	}

	

}
/* End of file group.php */
/* Location: ./application/modules/sms/controllers/group.php */