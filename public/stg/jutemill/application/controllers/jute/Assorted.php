<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assorted extends CI_Controller
{
	private $main_layout = '';
	private $side_menu = '';


	public function __construct()
	{
		parent::__construct();
		$this->main_layout = 'backend/master_layout';
		$this->side_menu = 'backend/authority/operator/side_menu';
		$this->load->model('M_khamal');
		$this->load->model('M_grade');
	}

	// Add Assorted Form 
	public function addAssorted()
	{
		$data = $this->engine->store_nav('assorted', 'add_assorted', 'Add Assorted');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/assorted/add_assorted';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// List Assorted Form 
	public function listAssorted()
	{
		$data = $this->engine->store_nav('assorted', 'list_assorted', 'List Assorted');
		$data['list'] = array();
		$path = 'backend/jute/assorted/list_assorted';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
}
