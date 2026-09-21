<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Backend');
        if (!isset($this->session->userdata['currentActiveVendorId'])) {
            $this->session->set_flashdata('login_failed', 'Link is broken');
            redirect('login');
        }
    }

    public function index()
    {
        $default_page = 'backend/vendor_view/dashboard';
        $data['main_nav'] = 'dashboard';
        $data['sub_nav'] = '';
        $data['tittle'] = "dashboard";
        $newDate = date("Y-m-d", strtotime(date("Y/m/d")));
        $company_info = $this->Common->get_single_row_information('settings', 's_companyid', 1);
        if ($company_info->invoice_style_id == 2) {
            $default_page = 'backend/vendor_view/dashboard_mod';
        }

        $today = $newDate;
        $last_seven_days = date("Y-m-d", strtotime("-7 days"));
        $last_thiry_days = date("Y-m-d", strtotime("-30 days"));

        $data['total_sale'] = $this->Boardend->sales_total_of_vendor();
        $data['withdrawal'] = $this->Boardend->total_withdrawal(['vendor_id' => $this->session->userdata('currentActiveVendorId')]);
        $data['current_balance'] = $data['total_sale'] - $data['withdrawal'];
        $data['yesterday_sales'] = $this->Boardend->sales_of_a_day_vendor($today);
        $data['last_seven_days'] = $this->Boardend->sales_of_a_day_vendor_condition($last_seven_days);
        $data['last_thiry_days'] = $this->Boardend->sales_of_a_day_vendor_condition($last_thiry_days);
        $data['pending_list'] = $this->Boardend->get_vendor_invoice_list(['invoice.i_status' => 0, ' oder_products.o_createdby' => $this->session->userdata('currentActiveVendorId')]);
        $data['ship_list'] = $this->Boardend->get_vendor_invoice_list(['invoice.i_status' => 5, ' oder_products.o_createdby' => $this->session->userdata('currentActiveVendorId')]);
        $data['complete_list'] = $this->Boardend->get_vendor_invoice_list(['invoice.i_status' => 1, ' oder_products.o_createdby' => $this->session->userdata('currentActiveVendorId')]);

        $data['pending_order'] = $this->Boardend->order_count(['oder_products.o_createdby' => $this->session->userdata('currentActiveVendorId'), 'invoice.i_status' => 0]);
        $data['complete_order'] = $this->Boardend->order_count(['oder_products.o_createdby' => $this->session->userdata('currentActiveVendorId'), 'invoice.i_status' => 1]);
        $condition = array(
            'i_status!=' => 2,
        );
        $data['list_data'] = $this->Boardend->get_vendor_invoice_list(['invoice.i_status!=' => 2, ' oder_products.o_createdby' => $this->session->userdata('currentActiveVendorId')]);

        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view($default_page, $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }

    public function product_list()
    {
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'product_list';
        $data['tittle'] = "Product List";
        $data['products_list'] = $this->Common->get_data_multi_conditional('poducts', ['p_status' => 0, 'p_createdby' => $this->session->userdata('currentActiveVendorId')]);
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/product/product_list', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }

    public function create_product()
    {
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'create_product';
        $data['tittle'] = "Create Product";
        $data['categories_list'] = $this->Common->get_data_single_conditional('categories', 'c_status', '0');
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/product/create_product', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }



    public function store_product()
    {
        $information_store = $this->input->post();
        $x = $this->imgae_upload();
        $information_store['p_imagepath'] = $x;
        $information_store['p_createdby'] = $this->session->userdata('currentActiveVendorId');
        $information_store['p_status'] = 0;
        unset($information_store['_wysihtml5_mode']);
        $res = $this->Common->set_data('poducts', $information_store);
        $this->set_confirmation_msg($res, "System Updated", "Error Occure");
        redirect('add_product', 'location');
    }


    public function edit_product($identifier = null)
    {
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'create_product';
        $data['tittle'] = "Update Product";
        $data['categories_list'] = $this->Common->get_data_single_conditional('categories', 'c_status', '0');
        $data['product_information'] = $this->Common->get_single_row_information('poducts', 'p_id', $identifier);
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/product/edit_product', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }

    public function update_product()
    {
        $information_store = $this->input->post();
        $x = $this->imgae_upload();
        if ($x == "demo.jpg") {
            $information_store['p_imagepath'] = $information_store['temp_img'];
        } else {
            $information_store['p_imagepath'] = $x;
        }
        $information_store['p_createdby'] = $this->session->userdata('currentActiveVendorId');
        $information_store['p_status'] = 0;
        $identifier = $information_store['identifier'];
        unset($information_store['_wysihtml5_mode']);
        unset($information_store['identifier']);
        unset($information_store['temp_img']);
        $table = "poducts";
        $index = "p_id";
        $res = $this->Common->update_data($table, $index, $identifier, $information_store);
        $this->backend->set_confirmation_msg($res, "Information Updated successfully.", "Fail to Updated Expense information.");
        redirect('vendor/product_list', 'location');
    }



    public function product_delete($identifier)
    {
        $table = "poducts";
        $index = "p_id";
        $information_store['p_status'] = 1;
        $res = $this->Common->update_data($table, $index, $identifier, $information_store);
        $this->backend->set_confirmation_msg($res, "Information Updated successfully.", "Fail to Updated Expense information.");
        redirect('product_list', 'location');
    }


    public function related_product_images_list($id)
    {
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'product_list';
        $data['tittle'] = "Product List";
        $data['products_list'] = $this->Common->get_data_multi_conditional('poduct_images', ['poduct_images_status' => 1, 'poduct_images_p_id' => $id, 'poduct_images_isdeleted' => 0]);
        $data['p_id'] = $id;
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/product/product_image_list', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }
    public function related_product_images_create($id)
    {
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'product_list';
        $data['tittle'] = "Product List";
        $data['p_id'] = $id;
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/product/create_product_image', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }
    public function store_product_image()
    {
        $information = array(
            'poduct_images_image' => $this->imgae_upload(),
            'poduct_images_p_id' => $this->input->post('p_id'),
            'poduct_images_status' => 1,
            'poduct_images_isdeleted' => 0,
            'poduct_images_created_by' => $this->session->userdata('currentActiveVendorId'),
        );

        $res = $this->Common->set_data("poduct_images", $information);



        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/Vendor/related_product_images_list/' . $this->input->post('p_id'), 'location');
    }

    public function product_image_delete($identifier, $p_id)
    {
        $table = "poduct_images";
        $index = "poduct_images_id";
        $data['p_id'] = $p_id;
        $information_store = ['poduct_images_status' => 0, 'poduct_images_isdeleted' => 1];
        $res = $this->Common->update_data($table, $index, $identifier, $information_store);
        $this->backend->set_confirmation_msg($res, "Information Updated successfully.", "Fail to Updated Expense information.");
        redirect('backend/Vendor/related_product_images_list/' . $p_id, 'location');
    }



    public function change_profile()
    {
        $data['admin_info'] = $this->Common->get_single_row_information('authority', 'authority_id', 1);
        $data['main_nav'] = 'settings';
        $data['sub_nav'] = 'category';
        $data['tittle'] = "change_profile";
        $data['categories_list'] = $this->Common->get_data_single_conditional('categories', 'c_status', '0');
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/change_profile', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }

    public function profile_updated()
    {
        $information_store = $this->input->post();


        $x = $information_store['password'];

        if ($x != "000000") {
            $information_store['authority_password'] = md5($information_store['password']);
        }


        unset($information_store['password']);



        $table = "authority";
        $index = "authority_id";
        $res = $this->Common->update_data($table, $index, 1, $information_store);
        $this->backend->set_confirmation_msg($res, "Information Updated successfully.", "Fail to Updated  information.");
        redirect('change_profile', 'location');
    }





    private function x_debug($data)
    {
        print_r($data);
        echo "<br>";
        exit();
    }


    public function imgae_upload()
    {
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
    public function c_imgae_upload()
    {
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



    private function set_confirmation_msg($data, $true_msg, $false_msg)
    {
        $confirm = 0;
        if ($data == FALSE) {
            $this->session->set_flashdata('error', $false_msg);
        } else {
            $this->session->set_flashdata('success', $true_msg);
            $confirm = 1;
        }
        return $confirm;
    }

    public function user_logout()
    {
        $this->session->unset_userdata('currentActiveVendorId');
        $this->session->sess_destroy();
        redirect('login', 'location');
    }
}
