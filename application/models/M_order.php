<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_order extends CI_Model
{
    public function order($flag, $key = '', $data = '')
    {
        if ($flag == 'add') {
            $createCode = $this->createCodeOrder();
            $insert = array(
                "order_id" => $createCode,
                "order_date" => date('Y-m-d')
            );
            $this->db->insert('order_header', $insert);
            $res = array(
                "data" => $insert,
                "type" => 0,
                "msg" => "Create Data Berhasil"
            );

        } else if ($flag == 'update') {
            $orderId = json_decode(base64_decode(urldecode($data['keyId'])), true);
            $sqlTotal=$this->db->query("SELECT COALESCE(sum(subtotal),0) as total FROM order_detail
            WHERE order_id='".$orderId['data']['order_id']."'");
            if($sqlTotal->row('total')>0){
                $total=$sqlTotal->row('total');
            }else{
                $total=0;
            }
            if($data['promo'] ==''){
                $diskon=0;
            }else{
                $sqlPromo=$this->db->query("select 
                                            promo_code  as keyId,
                                            promo_name  as namePromo,
                                            promo_nom   as nomPromo
                                            from  promo where UPPER(promo_code) ='".strtoupper($data['promo']) . "'");
                if($sqlPromo->num_rows()>0){
                    $diskon=$sqlPromo->row('nomPromo');
                }else{
                    $diskon=0;
                }
            }
            $ppn=($total-$diskon)*10/100;
            $totalNett=($total-$diskon)+$ppn;
            $dataOrder = array(
                "customer_name" => $data['customer'],
                "promo_code" => $data['promo'],
                "amount_discount" => $diskon,
                "net" => $total,
                "ppn" => $ppn,
                "total" => $totalNett,
            );
            $this->db->where('order_id',$orderId['data']['order_id'])->update('order_header', $dataOrder);
            $listProduct=$this->orderDetail('view',$orderId['data']['order_id']);

            if($listProduct['data']->num_rows()>0){
                    foreach($listProduct['data']->result_array() as $rrList){
                        $insertMutasi[]=array(
                            "tgl_mutasi"    =>date('Y-m-d'),
                            "pcode" =>$rrList['pcode'],
                            "order_id"  =>$rrList['order_id'],
                            "type_mutasi"   =>'O',
                            "jumlah"    =>$rrList['qty']
                        );
                        $updateStock=array(
                            "jumlah"=>$rrList['jumlah']-$rrList['qty']
                        );
                        $this->db->where('pcode',$rrList['pcode'])->update('stock',$updateStock);
                    }
                    $this->db->insert_batch('mutasi_stock',$insertMutasi);
            }else{

            }

            $res = array(
                "data" => $dataOrder,
                "type" => 0,
                "msg" => "Order Data Berhasil"
            );
        } else if($flag =='list'){
            $orderId = json_decode(base64_decode(urldecode($key)), true);
            $sqlHd=$this->db->where('order_id',$orderId['data']['order_id'])->get('order_header');
            if($sqlHd->num_rows()>0){

                $dataHd=$sqlHd->row_array();
                $sqlDet = $this->db->query("select * 
                from  order_detail join product on product.pcode =order_detail.pcode
                where order_id='" . $orderId['data']['order_id'] . "'");
                if($sqlDet->num_rows()>0){
                    $dataDet=$sqlDet->result_array();
                }else{
                    $dataDet=array();
                }
                $dataOrder=array(
                    "orderHd"=>$dataHd,
                    "orderDetail"=>$dataDet
                );

                $res = array(
                    "data" => $dataOrder,
                    "type" => 0,
                    "msg" => "Data Ada"
                );
            }else{
                $res = array(
                    "data" => "",
                    "type" => 1,
                    "msg" => "Data Tidak Ada"
                );
            }

        }else {
            $sql = $this->db->query("select * from order_header where total >0");
            $res['data'] = $sql;
        }
        return $res;
    }
    private function createCodeOrder()
    {
        $dateKode = 'INV/' . date('m') . '/' . date('Y');
        $sqlSort = $this->db->query("SELECT coalesce(max(SUBSTR(order_id,13,5)),'0') as maks from order_header where SUBSTR(order_id,1,11)='" . $dateKode . "'");
        $rowSort = $sqlSort->row_array();

        if ($rowSort['maks'] == '0') {
            $urutKode = 1;
        } else {
            $urutKode = ($rowSort['maks'] * 1) + 1;
        }
        $kodeOrder = $dateKode . '/' . str_pad($urutKode, 4, '0', STR_PAD_LEFT);
        return $kodeOrder;
    }
    public function orderDetail($flag, $key = '', $data = '')
    {
        if ($flag == 'add') {
            $orderId = json_decode(base64_decode(urldecode($data['keyId'])), true);
            $insert = array(
                "order_id" => $orderId['data']['order_id'],
                "pcode" => $data['nama_produk'],
                "qty" => $data['qty'],
                "price" => 0,
                "subtotal" => 0
            );
            $checkDetail = $this->checkDetail($insert);
            $checkStock = $this->checkStock($data['nama_produk'], $checkDetail['qty']);
            if ($checkStock['type'] == 0) {
                $newArrayInsert = array(
                    "order_id" => $orderId['data']['order_id'],
                    "pcode" => $data['nama_produk'],
                    "qty" => $checkDetail['qty'],
                    "price" => $checkStock['data']['price'],
                    "subtotal" => $checkStock['data']['total']
                );
                if ($checkDetail['status'] == 'update') {
                    $this->db->where('pcode', $newArrayInsert['pcode'])->where('order_id', $newArrayInsert['order_id'])->update("order_detail", $newArrayInsert);
                    $res = array(
                        "type" => 0,
                        "msg" => "Produk Berhasil DiUpdate",
                        "data" => $data
                    );
                } else {
                    $this->db->insert('order_detail', $newArrayInsert);
                    $res = array(
                        "type" => 0,
                        "msg" => "Produk Berhasil DiTambah",
                        "data" => array()
                    );
                }
            } else {
                $res = $checkStock;
            }

        } else if ($flag == 'tambah') {
            $cekList = $this->ListDetail($data['keyId']);
            $qty = $data['keyData'] + 1;
            $checkStock = $this->checkStock($cekList['pcode'], $qty);
            if ($checkStock['type'] == 0) {
                $updateList = array(
                    "qty" => $qty,
                    "subtotal" => $checkStock['data']['total']
                );
                $this->db->where('order_detail_id', $key)->update('order_detail', $updateList);
                $res = array(
                    "data" => "",
                    "type" => 0,
                    "msg" => "Update Data Berhasil"
                );
            } else {
                $res = $checkStock;
            }
        } else if ($flag == 'kurang') {
            $cekList = $this->ListDetail($data['keyId']);
            $total = ($data['keyData'] - 1) * $cekList['price'];
            $updateList = array(
                "qty" => $data['keyData'] - 1,
                "subtotal" => $total
            );
            $this->db->where('order_detail_id', $key)->update('order_detail', $updateList);
            $res = array(
                "data" => "",
                "type" => 0,
                "msg" => "Update Data Berhasil"
            );
        } else if ($flag == 'delete') {
            $this->db->where('order_detail_id', $key)->delete('order_detail');
            $res = array(
                "data" => "",
                "type" => 0,
                "msg" => "Delete Data Berhasil"
            );
        } else {
            $sql = $this->db->query("select * 
                                        from  order_detail 
                                        join product on product.pcode =order_detail.pcode
                                        join stock on stock.pcode=product.pcode
                                        where order_id='" . $key . "'");
            $res['data'] = $sql;
        }
        return $res;
    }
    private function checkStock($id, $qty)
    {
        $sql = $this->db->query("select product.pcode as pcode,
                                product.product_name as name,
                                product.price as price,
                                stock.jumlah as stock
                                from product join stock on product.pcode =stock.pcode where product.pcode ='" . $id . "'");
        if ($sql->num_rows() > 0) {
            $rows = $sql->row_array();
            if ($rows['stock'] >= $qty) {
                $data = array(
                    "price" => $rows['price'],
                    "total" => $qty * $rows['price'],
                );
                $res = array(
                    "type" => 0,
                    "msg" => "Stock Produk Tersedia",
                    "data" => $data
                );
            } else {
                $res = array(
                    "type" => 1,
                    "msg" => "Stok Produk Tidak Tersedia",
                    "data" => array()
                );
            }
        } else {
            $res = array(
                "type" => 1,
                "msg" => "Produk Tidak Ditemukan",
                "data" => array()
            );
        }
        return $res;
    }
    private function checkDetail($data)
    {
        $sql = $this->db->query("select * from order_detail where 
                                    order_id ='" . $data['order_id'] . "'
                                    AND pcode ='" . $data['pcode'] . "'
        ");
        if ($sql->num_rows() > 0) {
            $rows = $sql->row_array();
            $qty = $data['qty'] + $rows['qty'];
            $subtotal = $data['subtotal'] + $rows['subtotal'];
            $insert = array(
                "order_id" => $data['order_id'],
                "pcode" => $data['pcode'],
                "qty" => $qty,
                "price" => $data['price'],
                "status" => 'update',
                "subtotal" => $subtotal
            );
            $res = $insert;
        } else {

            $data['status'] = 'insert';
            $res = $data;
        }
        return $res;
    }
    private function ListDetail($id)
    {
        $sql = $this->db->query("select * from order_detail where 
                                order_detail_id ='" . $id . "'
                                ");
        if ($sql->num_rows() > 0) {
            $rows = $sql->row_array();
            $res = $rows;
        } else {

            $data['status'] = 'insert';
            $res = $data;
        }
        return $res;
    }
}