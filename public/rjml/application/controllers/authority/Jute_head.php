<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jute_head extends CI_Controller
{

	private $main_layout = 'backend/master_layout';
	private $side_menu = 'backend/authority/jute_head/side_menu';
	private $viewPath = 'backend/authority/jute_head/';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('currentActiveId')) {
		} else {
			$this->session->set_flashdata('login_failed', 'Link is broken');
			redirect('login');
		}
		$this->load->model('M_area');
		$this->load->model('M_jute_report');
	}

	public function index()
	{
		$data = $this->engine->store_nav('dashboard', 'Nothing', 'Welcome to dashboard');
		$data['alertSetting'] = $this->M_jute_report->getJuteStockAlertQuantity();
		$path = $this->viewPath . 'dashboard';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
}
