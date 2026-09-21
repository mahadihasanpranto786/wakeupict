<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{

    private $main_layout = 'backend/master_layout';
    private $side_menu = 'backend/authority/operator/side_menu';
    private $viewPath = 'backend/authority/operator/';

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('currentActiveId')) {
        } else {
            $this->session->set_flashdata('login_failed', 'Link is broken');
            redirect('login');
        }
    }

    public function index()
    {
        $data = $this->engine->store_nav('dashboard', 'Nothing', 'Welcome to dashboard');
        $path = $this->viewPath . 'dashboard';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }
}
