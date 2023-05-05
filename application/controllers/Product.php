<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
class Product extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('m_product', 'mproduct');
	}
	public function index(){
		$response=$this->mproduct->product('view');
		$this->load->view('product/product-list-view',$response);
	}
	public function action_product($flag,$key=''){
		if($flag =='add' || $flag =='update'){
			$response['data']=$this->mproduct->product($flag,$key,$_POST);
		}else{
			$response=$this->mproduct->product($flag,$key);
		}
		echo json_encode($response);
	}
}
