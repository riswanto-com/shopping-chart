<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_product extends CI_Model
{
    public function product($flag, $key = '', $data = '')
    {
        if ($flag == 'add') {
            $createCode=$this->createCode();

            $insert = array(
                "pcode" => $createCode,
                "product_name" => $data['nama_produk'],
                "price" => $data['harga_produk']
            );
            $insertStock=array(
                "pcode" => $createCode,
                "jumlah"=>$data['stock_produk']
            );
                $this->db->insert('product', $insert);
                $this->db->insert('stock', $insertStock);
                $res = array(
                    "data" => $insert,
                    "type" => 0,
                    "msg" => "Tambah Data Berhasil"
                );
        } else if ($flag == 'update') {
            $update = array(
                "product_name" => $data['nama_produk'],
                "price" => $data['harga_produk']

            );
            $insertStock=array(
                "pcode" => $key,
                "jumlah"=>$data['stock_produk']
            );
                $this->db->where('pcode', $key)->update('stock', $insertStock);
                $this->db->where('pcode', $key)->update('product', $update);

                $res = array(
                    "data" => $update,
                    "type" => 0,
                    "msg" => "Update Data Berhasil"
                );
            
        } else if ($flag == 'edit') {
            $sql = $this->db->query("select product.pcode as pcode,
            product.product_name as name,
            product.price as price,
            stock.jumlah as stock
            from product join stock on product.pcode =stock.pcode where product.pcode='". $key . "'");
            if ($sql->num_rows() > 0) {
                $res = array(
                    "data" => $sql->row_array(),
                    "type" => 0,
                    "msg" => ""
                );
            } else {
                $res = array(
                    "data" => "",
                    "type" => 1,
                    "msg" => ""
                );
            }
        } else if ($flag == 'delete') {
            $this->db->where('pcode', $key)->delete('stock');
                $this->db->where('pcode', $key)->delete('product');
            $res = array(
                "data" => "",
                "type" => 0,
                "msg" => "Delete Data Berhasil"
            );
        } else {
            $sql = $this->db->query("select product.pcode as pcode,
                                        product.product_name as name,
                                        product.price as price,
                                        stock.jumlah as stock
                                        from product join stock on product.pcode =stock.pcode");
            $res['data'] = $sql;
        }
        return $res;
    }
    private function createCode(){
        $dateKode = date('ym');
		$sqlSort = $this->db->query("select coalesce(max(SUBSTR(pcode,5,4)),'0') as maks from 
        product where SUBSTR(pcode,1,4)='".$dateKode."'");
		$rowSort = $sqlSort->row_array();
		
		if($rowSort['maks'] == '0') {
	        $urutKode = 1;
		} else {
	        $urutKode = ($rowSort['maks']*1) + 1;
        }
        $kodeOrder = $dateKode.''.str_pad($urutKode,4,'0',STR_PAD_LEFT);
        return $kodeOrder;
    }
    public function promo($flag, $key = '', $data = '')
    {
        if ($flag == 'add') {
            $createCode=$this->createCodePromo();

            $insert = array(
                "promo_code" => $createCode,
                "promo_name" => $data['nama_promo'],
                "promo_nom " => $data['nominal_promo']
            );
                $this->db->insert('promo', $insert);
                $res = array(
                    "data" => $insert,
                    "type" => 0,
                    "msg" => "Tambah Data Berhasil"
                );
        } else if ($flag == 'update') {
            $update = array(
                "promo_name" => $data['nama_promo'],
                "promo_nom " => $data['nominal_promo']

            );
                $this->db->where('promo_code', $key)->update('promo', $update);

                $res = array(
                    "data" => $update,
                    "type" => 0,
                    "msg" => "Update Data Berhasil"
                );
            
        } else if ($flag == 'edit') {
            $sql = $this->db->query("select 
                                        promo_code  as keyId,
                                        promo_name  as namePromo,
                                        promo_nom   as nomPromo
                                        from  promo where promo_code='". $key . "'");
            if ($sql->num_rows() > 0) {
                $res = array(
                    "data" => $sql->row_array(),
                    "type" => 0,
                    "msg" => ""
                );
            } else {
                $res = array(
                    "data" => "",
                    "type" => 1,
                    "msg" => ""
                );
            }
        } else if ($flag == 'delete') {
            $this->db->where('promo_code', $key)->delete('promo');
            $res = array(
                "data" => "",
                "type" => 0,
                "msg" => "Delete Data Berhasil"
            );
        } else {
            $sql = $this->db->query("select 
                                        promo_code  as keyId,
                                        promo_name  as namePromo,
                                        promo_nom   as nomPromo
                                        from  promo");
            $res['data'] = $sql;
        }
        return $res;
    }
    private function createCodePromo(){
        $dateKode ='pmo';
		$sqlSort = $this->db->query("select coalesce(max(SUBSTR(promo_code,5,4)),'0') as maks from promo where SUBSTR(promo_code,1,3)='".$dateKode."'");
		$rowSort = $sqlSort->row_array();
		
		if($rowSort['maks'] == '0') {
	        $urutKode = 1;
		} else {
	        $urutKode = ($rowSort['maks']*1) + 1;
        }
        $kodeOrder = $dateKode.'-'.str_pad($urutKode,4,'0',STR_PAD_LEFT);
        return $kodeOrder;
    }
}