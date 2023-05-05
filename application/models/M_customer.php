<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_customer extends CI_Model
{

    public function customer($flag, $key = '', $data = '')
    {
        if ($flag == 'add') {

            $insert = array(
                "customer_name" => $data['nama_customer'],
                "address" => $data['alamat_customer']
            );

            $this->db->insert('customer', $insert);
            $res = array(
                "data" => $insert,
                "type" => 0,
                "msg" => "Tambah Data Berhasil"
            );
        } else if ($flag == 'update') {
            $update = array(
                "customer_name" => $data['nama_customer'],
                "address" => $data['alamat_customer']

            );
            $this->db->where('customer_id', $key)->update('customer', $update);

            $res = array(
                "data" => $update,
                "type" => 0,
                "msg" => "Update Data Berhasil"
            );

        } else if ($flag == 'edit') {
            $sql = $this->db->query("select
                                        customer_id as keyId,
                                        customer_name as name,
                                        address as address from customer
                                        where customer_id='" . $key . "'");
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
            $this->db->where('customer_id', $key)->delete('customer');
            $res = array(
                "data" => "",
                "type" => 0,
                "msg" => "Delete Data Berhasil"
            );
        } else {
            $sql = $this->db->query("select
                                        customer_id as keyId,
                                        customer_name as name,
                                        address as address from customer");
            $res['data'] = $sql;
        }
        return $res;
    }


}