<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
class Order extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('m_order', 'morder');
	}
	public function index(){
		$response=$this->morder->order('add');
		$url = urlencode(str_replace('=', '', base64_encode(json_encode($response))));
		redirect('order/create/'.$url);
	}
	public function create($key){
		$this->load->model('m_product', 'mproduct');
		$this->load->model('m_customer', 'mcustomer');
		$response['data'] = json_decode(base64_decode(urldecode($key)), true);
		$response['customer']=$this->mcustomer->customer('view');
		$response['product']=$this->mproduct->product('view');
		$response['keyData']=$key;
		$response['listProduk']=$this->morder->orderDetail('view',$response['data']['data']['order_id']);
		$this->load->view('order/order-create-view',$response);
	}
	public function check_out($key){
		$response['data'] = json_decode(base64_decode(urldecode($key)), true);
		$response['keyId']=$key;
		$this->load->view('order/order-checkout-view',$response);
	}
	public function list(){
		$response = $response=$this->morder->order('view');
		$this->load->view('order/order-list-view',$response);
	}
	public function action($flag,$key=''){
		if($flag =='update'){
			$data = json_decode(file_get_contents('php://input'), true);
			$response=$this->morder->order($flag,$key,$data);
		}else{
			$response=$this->morder->order($flag,$key);
		}
		echo json_encode($response);
	}
	public function action_detail($flag,$key=''){
		if($flag =='add' || $flag =='update'){
			$response['data']=$this->morder->orderDetail($flag,$key,$_POST);
		}else if($flag =='tambah' || $flag =='kurang'){
			$data = json_decode(file_get_contents('php://input'), true);
			$response=$this->morder->orderDetail($flag,$key,$data);
		}else{
			$response=$this->morder->orderDetail($flag,$key);
		}
		echo json_encode($response);
	}
	
}
