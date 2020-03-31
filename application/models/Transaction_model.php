<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model
{
    private $_table = "transactions";

    public $id_transactions;
    public $product_id;
    public $user_id;
    public $alamat;
    public $kodepos;
    public $jumlah;
    public $total_harga;
    public $transaction_made;

    public function rules()
    {
        return [
            ['field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'required'],

            ['field' => 'kodepos',
            'label' => 'Kodepos',
            'rules' => 'required'],

            ['field' => 'jumlah',
            'label' => 'Jumlah',
            'rules' => 'numeric'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["user_id" => $id])->result();
    }

    public function save($id, $harga)
    {
        $post = $this->input->post();
        $this->id_transactions = uniqid();
        $this->product_id = $id;
        $this->user_id = $this->session->userdata('user_id');
        $this->alamat = $post["alamat"];
        $this->kodepos = $post["kodepos"];
        $this->jumlah = $post["jumlah"];
        $this->total_harga = ($post["jumlah"]) * $harga;
        return $this->db->insert($this->_table, $this);
    }

}