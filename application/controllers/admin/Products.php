<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("product_model");
        $this->load->model("transaction_model");
        $this->load->library('form_validation');
        $this->load->model("user_model");
        if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["products"] = $this->product_model->getAll();
        $this->load->view("admin/product/list", $data);
    }

    public function add()
    {
        $product = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan!');
        }

        $this->load->view("admin/product/new_form");
    }

    public function addTransaction($id = null)
    {
        $transaction = $this->transaction_model;

        $product = $this->product_model;
        
        $validation = $this->form_validation;
        $validation->set_rules($transaction->rules());

        $data = $product->getById($id);

        if($validation->run()) {
            $transaction->save($id, $data->price);
            $this->session->set_flashdata('success', 'Berhasil disimpan!');
        }
        $dataa["products"] = $this->product_model->getAll();
        $this->load->view("admin/product/list", $dataa);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/products');
       
        $product = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["product"] = $product->getById($id);
        if (!$data["product"]) show_404();
        
        $this->load->view("admin/product/edit_form", $data);
    }

    public function buy($id = null)
    {
        if (!isset($id)) redirect('admin/products');
        $product = $this->product_model;
        $data["product"] = $product->getById($id);
        if (!$data["product"]) show_404();
        $this->load->view("admin/product/new_transaction", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->product_model->delete($id)) {
            redirect(site_url('admin/products'));
        }
    }

    public function search()
    {
        $this->load->model('product_model');
        $search = $this->input->post('search');
        $data['products'] =  $this->product_model->search($search);
        $this->load->view("admin/product/list", $data);
    }

    public function transactions()
    {
        $data["transactions"] = $this->transaction_model->getAll();
        $this->load->view("admin/product/transaction", $data);
    }

    public function mytransactions()
    {
        $data["transactions"] = $this->transaction_model->getById($this->session->userdata('user_id'));
        $this->load->view("admin/product/transaction", $data);
    }

}