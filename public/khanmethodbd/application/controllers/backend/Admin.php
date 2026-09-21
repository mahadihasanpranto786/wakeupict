<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Backend');
        if (!isset($this->session->userdata['currentActiveId'])) {
            $this->session->set_flashdata('login_failed', 'Link is broken');
            redirect('login');
        }
    }

    public function index()
    {
        $default_page = 'backend/admin_view/dashboard';
        $data['main_nav'] = 'dashboard';
        $data['sub_nav'] = '';
        $data['tittle'] = "dashboard";
        $newDate = date("Y-m-d", strtotime(date("Y/m/d")));
        $company_info = $this->Common->get_single_row_information('settings', 's_companyid', 1);
        if ($company_info->invoice_style_id == 2) {
            $default_page = 'backend/admin_view/dashboard_mod';
        }

        $today = $newDate;
        $last_seven_days = date("Y-m-d", strtotime("-7 days"));
        $last_thiry_days = date("Y-m-d", strtotime("-30 days"));
        $data['yesterday_sales'] = $this->Boardend->sales_of_a_day($today);
        $data['last_seven_days'] = $this->Boardend->sales_of_a_condition($last_seven_days);
        $data['last_thiry_days'] = $this->Boardend->sales_of_a_condition($last_thiry_days);
        $data['yesterday_sales_profit'] = $this->Boardend->profit_of_a_day($today);
        $data['last_seven_days_profit'] = $this->Boardend->profit_of_a_condition($last_seven_days);
        $data['last_thiry_days_profit'] = $this->Boardend->profit_of_a_condition($last_thiry_days);


        $data['orderSummary'] = $this->Boardend->orderSummary();

        $data['pending_list'] = $this->Common->get_data_single_conditional('invoice', 'i_status', 0);
        $data['ship_list'] = $this->Common->get_data_single_conditional('invoice', 'i_status', 5);
        $data['complete_list'] = $this->Common->get_data_single_conditional('invoice', 'i_status', 1);
        $data['today_profit'] = $this->Boardend->today_income($newDate);
        $data['total_profit'] = $this->Boardend->total_income();
        $data['pending_order'] = $this->Common->count_fact('invoice', 'i_status', 0);
        $data['complete_order'] = $this->Common->count_fact('invoice', 'i_status', 1);

        $par_page_data = 5;
        $offset = pagination_offset(4, $par_page_data);
        $url = "backend/Admin/index";
        $data["serial"] = serial_number_par_page(4, $par_page_data);


        if (empty($report)) {
            $report = '';
        }

        $data['list_data'] = $this->Common->get_multi_data_limit_mod("invoice",  $par_page_data, $offset, "i_id", []);
        $total_rows = $this->Common->get_multi_condition_count_mod("invoice", "i_id",  []);
        $data['total_rows'] = $total_rows;
        set_pagination($total_rows, $url, $par_page_data);
        if ($this->input->get("user_number")) {
            $data['list_data'] = $this->Common->get_multi_data_limit_like_mod(
                "invoice",
                $par_page_data,
                $offset,
                "i_mobile",
                $this->input->get("user_number"),
                [],
                "i_id"
            );
            $total_rows = $this->Common->get_multi_data_like_count_mod("invoice", "i_mobile", $this->input->get("user_number"), [],   "i_id");
            $data['total_rows'] = $total_rows;
            set_pagination($total_rows, $url, $par_page_data);
        }
        if ($this->input->get("invoice_id")) {
            $invoice_id =  abs((int)1000 - (int)$this->input->get("invoice_id"));
            if ($invoice_id) {
                $data['list_data'] = $this->Common->get_multi_data_limit_like_mod(
                    "invoice",
                    $par_page_data,
                    $offset,
                    "i_id",
                    $invoice_id,
                    [],
                    "i_id"
                );
                $total_rows = $this->Common->get_multi_data_like_count_mod("invoice", "i_id", $invoice_id, [],   "i_id");
                $data['total_rows'] = $total_rows;
                set_pagination($total_rows, $url, $par_page_data);
            }
        }



        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view($default_page, $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function category()
    {
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'category';
        $data['tittle'] = "dashboard";
        $data['categories_list'] = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => 0]);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/product/category', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function category_store()
    {
        $information_store['c_name'] = $this->input->post('c_name');
        $information_store['c_parent'] = 0;
        $information_store['c_status'] = 0;
        $information_store['c_createdby'] = $this->session->userdata('currentActiveId');
        $res = $this->Common->set_data('categories', $information_store);
        $this->set_confirmation_msg($res, "System Updated", "Error Occure");
        redirect('category', 'location');
    }

    public function category_update()
    {
        $identifier = $this->input->post('identifier');
        $table = "categories";
        $index = "c_id";
        $information_store['c_name'] = $this->input->post('c_name');
        $res = $this->Common->update_data($table, $index, $identifier, $information_store);
        $this->backend->set_confirmation_msg($res, "Information Updated successfully.", "Fail to Updated Expense information.");
        redirect('category', 'location');
    }

    public function category_delete($identifier)
    {
        $update_information = array(
            'c_status' => 1,
            'c_deletedby' => $this->session->userdata('currentActiveId')
        );
        $res = $this->Common->update_data("categories", "c_id", $identifier, $update_information);
        $this->set_confirmation_msg($res, "System Updated", "Error Occure");
        redirect('category', 'location');
    }

    public function sub_category()
    {
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'sub_category';
        $data['tittle'] = "dashboard";
        $data['sub_categories_list'] = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent !=' => 0]);

        $data['categories_list'] = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => 0]);

        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/product/sub_category', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function sub_category_store()
    {
        $information_store['c_name'] = $this->input->post('c_name');
        $information_store['c_parent'] = $this->input->post('c_parent');
        $information_store['c_status'] = 0;
        $information_store['c_createdby'] = $this->session->userdata('currentActiveId');
        $res = $this->Common->set_data('categories', $information_store);
        $this->set_confirmation_msg($res, "System Updated", "Error Occure");
        redirect('sub_category', 'location');
    }

    public function sub_category_update()
    {
        $identifier = $this->input->post('identifier');
        $table = "categories";
        $index = "c_id";
        $information_store['c_name'] = $this->input->post('c_name');
        $information_store['c_parent'] = $this->input->post('c_parent');

        $res = $this->Common->update_data($table, $index, $identifier, $information_store);
        $this->backend->set_confirmation_msg($res, "Information Updated successfully.", "Fail to Updated Expense information.");
        redirect('sub_category', 'location');
    }

    public function sub_category_delete($identifier)
    {
        $update_information = array(
            'c_status' => 1,
            'c_deletedby' => $this->session->userdata('currentActiveId')
        );
        $res = $this->Common->update_data("categories", "c_id", $identifier, $update_information);
        $this->set_confirmation_msg($res, "System Updated", "Error Occure");
        redirect('sub_category', 'location');
    }


    public function product_list()
    {
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'product_list';
        $data['tittle'] = "Product List";
        $par_page_data = 5;
        $offset = pagination_offset(4, $par_page_data);
        $url = "backend/Admin/product_list";
        $data["serial"] = serial_number_par_page(4, $par_page_data);
        $data['products_list'] = $this->Common->get_multi_data_limit_mod("poducts",  $par_page_data, $offset, "p_id", ["p_status" => 0]);
        $total_rows = $this->Common->get_multi_condition_count_mod("poducts", "p_id",  ["p_status" => 0]);
        $data['total_rows'] = $total_rows;
        set_pagination($total_rows, $url, $par_page_data);
        if ($this->input->get("product_name")) {
            $data['products_list'] = $this->Common->get_multi_data_limit_like_mod(
                "poducts",
                $par_page_data,
                $offset,
                "p_tittle",
                $this->input->get("product_name"),
                ["p_status" => 0],
                "p_id"
            );
            $total_rows = $this->Common->get_multi_data_like_count_mod("poducts", "p_tittle", $this->input->get("product_name"), ["p_status" => 0],   "p_id");
            $data['total_rows'] = $total_rows;
            set_pagination($total_rows, $url, $par_page_data);
        }

        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/product/product_list', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function create_product()
    {
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'create_product';
        $data['tittle'] = "Create Product";
        $data['categories_list'] = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => 0]);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/product/create_product', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }


    public function stock_view()
    {

        $id =  $this->input->get("p_id");
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'product_list';
        $data['tittle'] = "Product List";
        $data['stock_list'] = $this->Common->get_data_multi_conditional("stocks", ["s_p_id" => $id]);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/product/stock_view', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }
    public function stock_store()
    {

        $poducts = $this->Common->get_data_single_multi_conditional("poducts", ["p_id" => $this->input->post('s_p_id')]);
        $update_information = array(
            'p_quantity' => (int)$poducts->p_quantity + (int)$this->input->post('s_quantity')
        );
        $res = $this->Common->update_data("poducts", "p_id",   $poducts->p_id, $update_information);

        $information_store['s_date'] = $this->input->post('s_date');
        $information_store['s_p_id'] = $this->input->post('s_p_id');
        $information_store['s_quantity'] = $this->input->post('s_quantity');
        $information_store['s_status'] = 0;
        $res = $this->Common->set_data('stocks', $information_store);
        $this->set_confirmation_msg($res, "System store", "Error Occure");
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function stock_delete()
    {
        $identifier = $this->input->get('s_id');
        $stocks = $this->Common->get_data_single_multi_conditional("stocks", ["s_id" => $identifier]);
        $poducts = $this->Common->get_data_single_multi_conditional("poducts", ["p_id" =>  $stocks->s_p_id]);
        $update_information = array(
            'p_quantity' => (int)$poducts->p_quantity - (int)$stocks->s_quantity
        );
        $res = $this->Common->update_data("poducts", "p_id",   $poducts->p_id, $update_information);
        $res =   $this->Common->delete_data("stocks", "s_id", $identifier);
        $this->set_confirmation_msg($res, "System Deleted", "Error Occure");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_pinned_status()
    {
        $id = $this->input->get('id');
        $poducts = $this->Common->get_data_single_multi_conditional("poducts", ["p_id" => $id]);

        if ($poducts->p_spin == 1) {
            $id_status = 0;
        } elseif ($poducts->p_spin == 0) {
            $id_status = 1;
        }

        $this->Common->update_data("poducts", "p_id", $poducts->p_id, ["p_spin" =>  $id_status]);
        redirect('product_list', 'location');
    }

    public function store_product()
    {
        $information_store = $this->input->post();
        $x = $this->imgae_upload();
        if ($_FILES['product_file']['name']) {
            $temp = explode(".", $_FILES["product_file"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $information_store['p_file']  = $newfilename;
            $dri = "./assets/pdf_files/" . $newfilename;
            move_uploaded_file($_FILES['product_file']['tmp_name'], $dri);
        } else {
            $newfilename = "No Files inserted";
        }
        $information_store['p_imagepath'] = $x;
        $information_store['p_file'] = $newfilename;
        $information_store['p_createdby'] = $this->session->userdata('currentActiveId');
        $information_store['p_status'] = 0;
        unset($information_store['_wysihtml5_mode']);
        $res = $this->Common->set_data('poducts', $information_store);
        $this->set_confirmation_msg($res, "System Inserted Successfully", "Error Occure");
        redirect('add_product', 'location');
    }


    public function edit_product($identifier = null)
    {
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'create_product';
        $data['tittle'] = "Update Product";
        $data['categories_list'] = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => 0]);
        $data['product_information'] = $this->Common->get_single_row_information('poducts', 'p_id', $identifier);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/product/edit_product', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
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


        if ($_FILES['product_file']['name']) {
            $temp = explode(".", $_FILES["product_file"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);


            $information_store['p_file']  = $newfilename;
            $dri = "./assets/pdf_files/" . $newfilename;
            move_uploaded_file($_FILES['product_file']['tmp_name'], $dri);
        } else {
            $hidden_files =  $this->input->post('p_file');
            $files = isset($hidden_files) ? $hidden_files : "No files uploaded";
            $information_store['p_file'] = $files;
        }


        $information_store['p_createdby'] = $this->session->userdata('currentActiveId');
        $information_store['p_status'] = 0;
        $identifier = $information_store['identifier'];
        unset($information_store['_wysihtml5_mode']);
        unset($information_store['identifier']);
        unset($information_store['temp_img']);
        $table = "poducts";
        $index = "p_id";
        $res = $this->Common->update_data($table, $index, $identifier, $information_store);
        $this->backend->set_confirmation_msg($res, "Information Updated successfully.", "Fail to Updated Expense information.");
        redirect('product_list', 'location');
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
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/product/product_image_list', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function related_product_images_create($id)
    {
        $data['main_nav'] = 'products';
        $data['sub_nav'] = 'product_list';
        $data['tittle'] = "Product List";
        $data['p_id'] = $id;
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/product/create_product_image', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }
    public function store_product_image()
    {
        $information = array(
            'poduct_images_image' => $this->imgae_upload(),
            'poduct_images_p_id' => $this->input->post('p_id'),
            'poduct_images_status' => 1,
            'poduct_images_isdeleted' => 0,
            'poduct_images_created_by' => $this->session->userdata('currentActiveId'),
        );

        $res = $this->Common->set_data("poduct_images", $information);



        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/Admin/related_product_images_list/' . $this->input->post('p_id'), 'location');
    }

    public function product_image_delete($identifier, $p_id)
    {
        $table = "poduct_images";
        $index = "poduct_images_id";
        $data['p_id'] = $p_id;
        $information_store = ['poduct_images_status' => 0, 'poduct_images_isdeleted' => 1];
        $res = $this->Common->update_data($table, $index, $identifier, $information_store);
        $this->backend->set_confirmation_msg($res, "Information Updated successfully.", "Fail to Updated Expense information.");
        redirect('backend/Admin/related_product_images_list/' . $p_id, 'location');
    }

    public function settings()
    {
        $data['company_info'] = $this->Common->get_single_row_information('settings', 's_companyid', 1);
        $data['main_nav'] = 'settings';
        $data['sub_nav'] = 'category';
        $data['tittle'] = "Settings";
        $data['categories_list'] = $this->Common->get_data_single_conditional('categories', 'c_status', '0');
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/setting', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function settings_updated()
    {
        $information_store = $this->input->post();
        $x = $this->imgae_upload();
        if ($x == "demo.jpg") {
            $information_store['s_invoice_logo'] = $information_store['temp_img'];
        } else {
            $information_store['s_invoice_logo'] = $x;
        }
        $y = $this->c_imgae_upload();
        if ($y == "demo.jpg") {
            $information_store['s_company_logo'] = $information_store['c_temp_img'];
        } else {
            $information_store['s_company_logo'] = $y;
        }


        unset($information_store['temp_img']);
        unset($information_store['c_temp_img']);
        unset($information_store['image_path']);
        unset($information_store['c_image_path']);
        unset($information_store['_wysihtml5_mode']);


        /*$upload_image=$this->Common->get_single_row_information("settings","s_id",1)->s_company_logo;
        $temp_image1=$this->c_imgae_upload();
        if($temp_image1){
            $upload_image=$temp_image1;
        }
        $information_store['s_company_logo']=$upload_image;*/

        $index = "s_id";
        $table = "settings";
        // echo '<pre>';
        // print_r($information_store);
        // exit();
        $res = $this->Common->update_data($table, $index, 1, $information_store);
        $this->backend->set_confirmation_msg($res, "Information Updated successfully.", "Fail to Updated Expense information.");
        redirect('settings', 'location');
    }

    public function change_profile()
    {
        $data['admin_info'] = $this->Common->get_single_row_information('authority', 'authority_id', 1);
        $data['main_nav'] = 'settings';
        $data['sub_nav'] = 'category';
        $data['tittle'] = "change_profile";
        $data['categories_list'] = $this->Common->get_data_single_conditional('categories', 'c_status', '0');
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/change_profile', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
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

    public function populer_and_best_product()
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'populer_product';
        $data['tittle'] = "Dashboard || Populer Product";
        $populer_product = ['pb_isdeleted' => 0];
        $data['populer_product_list'] = $this->Common->get_data_multi_conditional("popular_and_best_product", $populer_product);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/product/popular_product', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function populer_and_best_product_edit($id)
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'Nothing';
        $data['tittle'] = "Dashboard || Populer Product";
        $data['populer_product_list'] = $this->Common->get_data_single("popular_and_best_product", "pb_id", $id);

        $data['products_list'] = $this->Common->get_data_single_conditional('poducts', 'p_status', '0');
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/product/edit_popular_product', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }


    public function check_update_available_populer_product()
    {
        $id = $this->input->post('id');
        $product = $this->input->post('product');
        $data = $this->Common->is__check_where_data_available(["pb_id !=" => $id, "pb_product" => $product, "pb_isdeleted" => 0], "popular_and_best_product");
        echo $data;
    }

    public function populer_and_best_product_update()
    {
        $id = $this->input->post('id');

        $information = [
            'pb_product' => $this->input->post('product'),
            'pb_status' => $this->input->post('status'),
            'pb_type' => $this->input->post('type'),
        ];

        $this->Common->update_data("popular_and_best_product", "pb_id", $id, $information);
    }

    public function populer_and_best_product_add()
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'Nothing';
        $data['tittle'] = "Dashboard || Populer Product";

        $data['products_list'] = $this->Common->get_data_single_conditional('poducts', 'p_status', '0');
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/product/add_popular_product', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function check_available_populer_product()
    {
        $product = $this->input->post('product');
        $data = $this->Common->is__check_where_data_available(["pb_product" => $product, "pb_isdeleted" => 0], "popular_and_best_product");
        echo $data;
    }

    public function populer_and_best_product_submit()
    {
        $information = [
            'pb_product' => $this->input->post('product'),
            'pb_type' => $this->input->post('type'),
            'pb_status' => 1,
            'pb_isdeleted' => 0,
            'pb_created_by' => $this->session->userdata('currentActiveId'),
        ];
        $res = $this->Common->set_data("popular_and_best_product", $information);
    }

    public function populer_and_best_product_delete($identifier)
    {

        $update_information = array(
            'pb_isdeleted' => 1
        );
        $res = $this->Common->update_data("popular_and_best_product", "pb_id", $identifier, $update_information);
        $this->set_confirmation_msg($res, "System Updated", "Error Occure");
        redirect('backend/Admin/populer_and_best_product', 'location');
    }

    public function user_list()
    {
        $data['main_nav'] = 'user';
        $data['sub_nav'] = 'user';
        $data['tittle'] = "Dashboard || Slider";
        $user = ['u_isdeleted' => 0];

        $par_page_data = 10;
        $offset = pagination_offset(4, $par_page_data);
        $url = "backend/Admin/user_list";
        $data["serial"] = serial_number_par_page(4, $par_page_data);

        $data['user_list'] = $this->Common->get_multi_data_limit_mod("user",  $par_page_data, $offset, "u_phone", ["u_status" => 1]);
        $total_rows = $this->Common->get_multi_condition_count_mod("user", "u_phone",  ["u_status" => 1]);
        $data['total_rows'] = $total_rows;
        set_pagination($total_rows, $url, $par_page_data);

        $user_info =  $this->input->get();
        if ($user_info) {
            if ($user_info["user_name"]) {
                $data['user_list'] = $this->Common->get_multi_data_limit_like_mod(
                    "user",
                    $par_page_data,
                    $offset,
                    "u_first_name",
                    $user_info["user_name"],
                    ["u_status" => 1],
                    "u_phone"
                );
                $total_rows = $this->Common->get_multi_data_like_count_mod("user", "u_first_name", $user_info["user_name"], ["u_status" => 1],   "u_phone");
                $data['total_rows'] = $total_rows;
                set_pagination($total_rows, $url, $par_page_data);
            }
            if ($user_info["user_number"]) {
                $data['user_list'] = $this->Common->get_multi_data_limit_like_mod(
                    "user",
                    $par_page_data,
                    $offset,
                    "u_phone",
                    $user_info["user_number"],
                    ["u_status" => 1],
                    "u_phone"
                );
                $total_rows = $this->Common->get_multi_data_like_count_mod("user", "u_phone", $user_info["user_number"], ["u_status" => 1],   "u_phone");
                $data['total_rows'] = $total_rows;
                set_pagination($total_rows, $url, $par_page_data);
            }
        }

        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/user/user_list', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }
    public function user_total_order()
    {
        $id = $this->input->get("u_phone");
        $data['main_nav'] = 'user';
        $data['sub_nav'] = 'user';
        $data['tittle'] = "User Total Order";

        $data["invoices"] =   $this->Common->get_data_multi_conditional("invoice", ["i_status" => 1, "i_mobile" => $id]);

        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/user/user_total_order', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }


    public function pending_withdrawal_list()
    {
        $data['main_nav'] = 'withdrawal';
        $data['sub_nav'] = 'pending_withdrawal_list';
        $data['tittle'] = "Withdrawal List";
        $data['withdrawal_list'] = $this->Common->get_data_multi_conditional('withdrawals', ['status' => 0]);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/withdrawal/index', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }
    public function accepted_withdrawal_list()
    {
        $data['main_nav'] = 'withdrawal';
        $data['sub_nav'] = 'accepted_withdrawal_list';
        $data['tittle'] = "Withdrawal List";
        $data['withdrawal_list'] = $this->Common->get_data_multi_conditional('withdrawals', ['status' => 1]);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/withdrawal/accepted', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function accept_withdrawal($identifier)
    {
        $update_information = array(
            'status' => 1
        );
        $res = $this->Common->update_data("withdrawals", "id", $identifier, $update_information);
        $this->set_confirmation_msg($res, "Withdrawal Accepted", "Error Occure");
        redirect('accepted_withdrawal_list', 'location');
    }

    public function authority_info()
    {
        $data['main_nav'] = 'authority';
        $data['sub_nav'] = 'authority';
        $data['tittle'] = "Authority Info";
        $data['authorityData'] = $this->Common->get_data_single_multi_conditional('authority', ['authority_isdeleted' => '0', 'authority_type' => 1]);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/authority_info', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }
    public function updateAuthority()
    {
        $id = $this->input->post("authority_id");
        if ($this->input->post("con_id") == 1) {
            $update_information = array(
                "authority_name" => $this->input->post("authority_name"),
                "authority_email" => $this->input->post("authority_email"),
                "authority_address" => $this->input->post("authority_address"),
                "authority_phone" => $this->input->post("authority_phone"),
            );
            $res = $this->Common->update_data("authority", "authority_id", $id, $update_information);
            redirect('authority_info?id=1', 'location');
        } elseif ($this->input->post("con_id") == 2) {
            if (strlen($this->input->post('authority_password')) >= 6) {
                $update_information = array(
                    "authority_password" => md5($this->input->post("authority_password"))
                );
                $res = $this->Common->update_data("authority", "authority_id", $id, $update_information);
                $this->set_confirmation_msg($res, "Password successfully reset", "Error!");
                redirect('authority_info?id=2', 'location');
            } else {
                $this->set_confirmation_msg(FALSE, "Withdrawal Accepted", "Error! Password minimum 6 characters");
                redirect('authority_info?id=2', 'location');
            }
        } elseif ($this->input->post("con_id") == 3) {
            $config['upload_path'] = 'assets/uploads/authority';
            $config['encrypt_name'] = TRUE;
            $config['allowed_types'] = 'JPG|JPEG|GIF|PNG|gif|jpg|png|jpeg|tft|TFT|webp';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('authority_image')) {
                $fileName =  $this->input->post("hidden_img");
            } else {
                $fileName = $this->upload->data('file_name');
            }
            $update_information = array(
                "authority_image" =>  $fileName
            );
            $res = $this->Common->update_data("authority", "authority_id", $id, $update_information);
            redirect('authority_info?id=3', 'location');
        }
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
        $config['allowed_types'] = 'JPG|JPEG|GIF|PNG|gif|jpg|png|jpeg|tft|TFT|webp';
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
        $this->session->unset_userdata('currentActiveId');
        $this->session->sess_destroy();
        redirect('login', 'location');
    }

    //CKEDITOR image uploaded into b_blog table
    public function imageUpload()
    {
        $upload_dir = array(
            'img' =>  "assets/products",
        );
        // Allowed image properties  
        $imgset = array(
            'maxsize' => 211000,
            'minwidth' => 50,
            'minheight' => 50,
            'maxwidth' => 10241,
            'maxheight' => 81100,
            /* 'minwidth' => 101111,
			'minheight' => 111110, */
            'type' => array('bmp', 'gif', 'jpg', 'jpeg', 'png'),
        );
        define('RENAME_F', 1);
        function setFName($p, $fn, $ex, $i)
        {
            if (RENAME_F == 1 && file_exists($p . $fn . $ex)) {
                return setFName($p, F_NAME . '_' . ($i + 1), $ex, ($i + 1));
            } else {
                return $fn . $ex;
            }
        }
        $re = '';
        if (isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1) {

            define('F_NAME', preg_replace('/\.(.+?)$/i', '', basename($_FILES['upload']['name'])));

            $sepext = explode('.', strtolower($_FILES['upload']['name']));
            $type = end($sepext);
            $upload_dir = in_array($type, $imgset['type']) ? $upload_dir['img'] : $upload_dir['audio'];
            $upload_dir = trim($upload_dir, '/') . '/';
            // Validate file type 
            if (in_array($type, $imgset['type'])) {
                // Image width and height 
                list($width, $height) = getimagesize($_FILES['upload']['tmp_name']);
                if (isset($width) && isset($height)) {
                    if ($width > $imgset['maxwidth'] || $height > $imgset['maxheight']) {
                        $re .= '\\n Width x Height = ' . $width . ' x ' . $height . ' \\n The maximum Width x Height must be: ' . $imgset['maxwidth'] . ' x ' . $imgset['maxheight'];
                    }
                    if ($width < $imgset['minwidth'] || $height < $imgset['minheight']) {
                        $re .= '\\n Width x Height = ' . $width . ' x ' . $height . '\\n The minimum Width x Height must be: ' . $imgset['minwidth'] . ' x ' . $imgset['minheight'];
                    }

                    if ($_FILES['upload']['size'] > $imgset['maxsize'] * 1000) {
                        $re .= '\\n Maximum file size must be: ' . $imgset['maxsize'] . ' KB.';
                    }
                }
            } else {
                $re .= 'The file: ' . $_FILES['upload']['name'] . ' has not the allowed extension type.';
            }
            // File upload path 
            $f_name = setFName($_SERVER['DOCUMENT_ROOT'] . '/' . $upload_dir, F_NAME, ".$type", 0);
            $uploadpath = $upload_dir . $f_name;

            // If no errors, upload the image, else, output the errors 
            if ($re == '') {
                if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)) {
                    $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
                    $url =  base_url($upload_dir . $f_name);
                    $msg = F_NAME . '.' . $type . ' successfully uploaded: \\n- Size: ' . number_format($_FILES['upload']['size'] / 1024, 2, '.', '') . ' KB';
                    $re = in_array($type, $imgset['type']) ? "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>" : '<script>var cke_ob = window.parent.CKEDITOR; for(var ckid in cke_ob.instances) { if(cke_ob.instances[ckid].focusManager.hasFocus) break;} cke_ob.instances[ckid].insertHtml(\' \', \'unfiltered_html\'); alert("' . $msg . '"); var dialog = cke_ob.dialog.getCurrent();dialog.hide();</script>';
                } else {
                    $re = '<script>alert("Unable to upload the file")</script>';
                }
            } else {
                $re = '<script>alert("' . $re . '")</script>';
            }
        }
        // Render HTML output 
        header('Content-type: text/html; charset=utf-8');
        echo $re;
    }
}
