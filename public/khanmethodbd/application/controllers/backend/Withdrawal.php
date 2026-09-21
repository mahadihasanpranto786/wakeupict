<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawal extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
            $this->load->library('Backend');
            if($this->session->userdata('currentActiveVendorId')){
                
            }
            else
            {
                $this->session->set_flashdata('login_failed','Link is broken');
                redirect('backend/Login');
            }
    }
    
      

    public function index()
    {
        $data['main_nav'] = 'withdrawal';
        $data['sub_nav'] = 'withdrawal_list';
        $data['tittle'] = "Withdrawal List";
        $data['withdrawal_list'] = $this->Common->get_data_multi_conditional('withdrawals', ['vendor_id'=>$this->session->userdata('currentActiveVendorId')]);
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/withdrawal/index', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }
    public function create()
    {
        $data['main_nav'] = 'withdrawal';
        $data['sub_nav'] = 'withdrawal_add';
        $data['tittle'] = "Withdrawal Add";
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/withdrawal/create', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }

    public function store(){
            $information = array('amount'=>$this->input->post('amount'),
                                        'method'=>$this->input->post('method'),
                                        'vendor_id'=>$this->session->userdata('currentActiveVendorId'),
                                        'number'=>$this->input->post('number'),
                                        'status'=>0,
                                        'is_deleted'=>0,
                                        'created_by'=>0,
                                        );
        $income=$this->Boardend->sales_total_of_vendor();

        $withdrawal=$this->Boardend->total_withdrawal(['vendor_id'=>$this->session->userdata('currentActiveVendorId')]);
         $current_balance=$income-$withdrawal;
        if ($current_balance< $this->input->post('amount')) {
            $this->set_confirmation_msg(TRUE,"You have not sufficent balance","You have not sufficent balance");
            redirect('vendor/withdrawal_create','location'); 
        }else{
           
        $res=$this->Common->set_data("withdrawals",$information);
 


        $this->set_confirmation_msg($res,"Store in System","Error Occure");
      
        redirect('vendor/withdrawal_list','location'); 
        }
        
    }
    
    
    
    private function x_debug($data){
        print_r($data);
        echo "<br>";
        exit();
    }

    
    public function imgae_upload(){
        $config['upload_path'] = './assets/products';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';    
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image_path')) {
            $error = array('error' => $this->upload->display_errors());
           
            // echo "<script>alert('image does not supported ')</script>";
             return "demo.jpg";
        } else {
            return $this->upload->data('file_name');
        }

    } 
    public function c_imgae_upload(){
        $config['upload_path'] = './assets/storefront/public/images';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';    
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('c_image_path')) {
            $error = array('error' => $this->upload->display_errors());
           
            // echo "<script>alert('image does not supported ')</script>";
             return "demo.jpg";
        } else {
            return $this->upload->data('file_name');
        }

    } 

    

    private function set_confirmation_msg($data,$true_msg,$false_msg){
        $confirm=0;
        if ($data==FALSE) {
            $this->session->set_flashdata('error',$false_msg);
        }
        else
        {
            $this->session->set_flashdata('success',$true_msg);
            $confirm=1;
        }
        return $confirm;
    }

}
