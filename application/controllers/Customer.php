<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
class Customer extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('m_customer', 'mcustomer');
	}
	public function index(){
		$response=$this->mcustomer->customer('view');
		$this->load->view('customer/customer-list-view',$response);
	}
	public function action($flag,$key=''){
		if($flag =='add' || $flag =='update'){
			$response['data']=$this->mcustomer->customer($flag,$key,$_POST);
		}else{
			$response=$this->mcustomer->customer($flag,$key);
		}
		echo json_encode($response);
	}
}
