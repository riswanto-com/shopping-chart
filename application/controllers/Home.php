<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
class Home extends CI_Controller {
	
	public function index(){
		$order=$this->db->query("select * from order_header where total >0");
		$product=$this->db->query("select * from product ");
		$customer=$this->db->query("select * from customer ");
		$response=array(
			"order"=>$order->num_rows(),
			"product"=>$product->num_rows(),
			"customer"=>$customer->num_rows(),
		);
		$this->load->view('home/home-page-view',$response);
	}

}
