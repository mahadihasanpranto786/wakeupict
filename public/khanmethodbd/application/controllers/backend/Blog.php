<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{

	private $main_layout = 'backend/admin_view/admin_layout';
	private $side_menu = 'backend/admin_view/side_menu';
	private $viewPath = 'backend/blog/';

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
		$data['side_menu'] = $this->load->view($this->side_menu, $data, TRUE);
		$data['main_content'] = $this->load->view($path, $data, TRUE);
		$this->load->view($this->main_layout, $data);
	}

	//view data into b_category table
	public function categoryView()
	{
		$data = $this->engine->store_nav('blog', 'categoryView', 'Category');
		$data['callFor'] = "categoryAdd";
		$data['blogList'] =	$this->M_blog->get_data_multi_conditional('b_blog', ['b_status' => 1]);
		$data['categoryList'] =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1]);
		$path = 'backend/blog/category_view';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//Edit view data into b_category table
	public function categoryEditView()
	{
		$data = $this->engine->store_nav('blog', 'categoryView', 'Category Edit');
		$id = $this->input->get("id");
		$data['callFor'] = "categoryEdit";
		$data['blogCatList'] =	$this->M_blog->get_data_multi_conditional('b_blog_category', ['b_b_cat_status' => 1, "cat_id" => $id]);
		$data['blogList'] =	$this->M_blog->get_data_multi_conditional('b_blog', ['b_status' => 1]);
		$data['categoryList'] =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1, "cat_id" => $id])->row();
		$path = 'backend/blog/category_view';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//inserted data into b_category table
	public function addCategory()
	{
		$title = $this->input->post('title');
		$data = array(
			'cat_title' => $title,
			'cat_status' => 1,
			'cat_created_at' => get_current_time(),
			'cat_created_by' => $this->session->userdata('currentActiveId'),
		);
		$alert = $this->M_blog->set_data('b_category', $data);
		set_confirmation_msg(
			$alert,
			"Category inserted successfully..",
			"Opps... something went wrong!!"
		);
		redirect('backend/Blog/categoryView');
	}

	//Updated data into b_category table
	public function updatedCategory()
	{
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$blog_id = $this->input->post('blog_idEdit');
		$data = array(
			'cat_title' => $title,
			'cat_status' => 1,
			'cat_updated_at' => get_current_time(),
			'cat_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_blog->update_data('b_category', 'cat_id', $id, $data);

		redirect('backend/Blog/categoryView');
	}

	//trash data into b_category table
	public function  trashCategory()
	{
		$id = $this->input->get('id');
		$data = array(
			'cat_status' => 0,
		);
		$this->M_blog->update_data('b_category', 'cat_id', $id, $data);
		$data = array(
			'b_b_cat_status' => 0,
		);
		$this->M_blog->update_data('b_blog_category', 'cat_id', $id, $data);

		//$cat_id =	$this->M_blog->get_data_multi_conditional('b_blog_category', ['cat_status' => 1, "cat_id" => $id, "b_b_cat_status" => 1]);


		redirect('backend/Blog/categoryView');
	}
	//view data into b_tag table
	public function tagView()
	{
		$data = $this->engine->store_nav('blog', 'tagView', 'Tag');

		$data['callFor'] = "tagAdd";
		$data['blogList'] =	$this->M_blog->get_data_multi_conditional('b_blog', ['b_status' => 1]);
		$data['tagList'] =	$this->M_blog->get_data_multi_conditional('b_tag', ['t_status' => 1]);
		$path = 'backend/blog/tag_view';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//Edit view data into tag and b_blog_tag table
	public function tagEditView()
	{
		$data = $this->engine->store_nav('blog', 'tagView', 'Tag');
		$id = $this->input->get('id');

		$data['callFor'] = "tagEdit";

		$data['blogTagList'] =	$this->M_blog->get_data_multi_conditional('b_blog_tag', ['b_b_tag_status' => 1, "tag_id" => $id]);
		$data['blogList'] =	$this->M_blog->get_data_multi_conditional('b_blog', ['b_status' => 1]);
		$data['tagList'] =	$this->M_blog->get_data_multi_conditional('b_tag', ['t_status' => 1, "t_id" => $id])->row();

		$path = 'backend/blog/tag_view';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//inserted data into b_tag table
	public function addTag()
	{
		$title = $this->input->post('title');
		$data = array(
			't_title' => $title,
			't_status' => 1,
			't_created_at' => get_current_time(),
			't_created_by' => $this->session->userdata('currentActiveId'),
		);
		$alert = $this->M_blog->set_data('b_tag', $data);

		set_confirmation_msg(
			$alert,
			"Tag inserted successfully..",
			"Opps... something went wrong!!"
		);
		redirect('backend/Blog/tagView');
	}
	//Updated data into b_tag table
	public function updatedTag()
	{
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$blog_id = $this->input->post('blog_idEdit');
		$data = array(
			't_title' => $title,
			't_status' => 1,
			't_updated_at' => get_current_time(),
			't_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$alert = $this->M_blog->update_data("b_tag", "t_id", $id, $data);

		set_confirmation_msg(
			$alert,
			"Tag inserted successfully..",
			"Opps... something went wrong!!"
		);
		redirect('backend/Blog/tagView');
	}

	//trash data into b_tag table
	public function  trashTag()
	{
		$id = $this->input->get('id');
		$data = array(
			't_status' => 0,
		);
		$this->M_blog->update_data('b_tag', 't_id', $id, $data);
		$data = array(
			'b_b_tag_status' => 0,
		);
		$this->M_blog->update_data('b_blog_tag', 'tag_id', $id, $data);
		redirect('backend/Blog/tagView');
	}


	//view data into User table
	public function userView()
	{
		$data = $this->engine->store_nav('blog', 'userView', 'User');

		$data['userList'] =	$this->M_blog->get_data_multi_conditional('authority', ['authority_isdeleted' => 0]);
		$path = 'backend/blog/user_view';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//view data into User table
	public function userDetails()
	{
		$id = $this->input->get('id');
		$data = $this->engine->store_nav('blog', 'userView', 'User');
		$data['userList'] =	$this->M_blog->get_data_multi_conditional('authority', ['authority_isdeleted' => 0, 'authority_id' => $id]);
		$path = 'backend/blog/user_details';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//view data into b_blog table
	public function blogView()
	{
		$data = $this->engine->store_nav('blog', 'blogView', 'Blog');
		$data['tagList'] =	$this->M_blog->get_data_multi_conditional('b_tag', ['t_status' => 1]);

		$data['blogCatList'] =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1]);
		$data['blogList'] =	$this->M_blog->get_data_multi_conditional('b_blog', ['b_status' => 1]);
		$data['callFor'] = "blogAdd";
		$path = 'backend/blog/blog_view';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	public function addBlogPage()
	{
		$data = $this->engine->store_nav('blog', 'blogView', 'Blog');
		$data['tagList'] =	$this->M_blog->get_data_multi_conditional('b_tag', ['t_status' => 1]);
		$data['blogCatList'] =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1]);
		$data['blogList'] =	$this->M_blog->get_data_multi_conditional('b_blog', ['b_status' => 1]);
		$data['callFor'] = "addBlogPage";
		$path = 'backend/blog/blog_view';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//edit view data into b_blog table
	public function blogEditView()
	{
		$data = $this->engine->store_nav('blog', 'blogView', 'Blog Edit');
		$blog_id = $this->input->get("blog_id");
		$data['blogCatList'] =	$this->M_blog->get_data_multi_conditional('b_blog_category', ['b_b_cat_status' => 1, "blog_id" => $blog_id]);
		$data['tagCatList'] =	$this->M_blog->get_data_multi_conditional('b_blog_tag', ['b_b_tag_status' => 1, "blog_id" => $blog_id]);
		$data['blogList'] =	$this->M_blog->get_data_multi_conditional('b_blog', ['b_status' => 1, "b_id" =>	$blog_id]);
		$data['blogSingleList'] =	$this->M_blog->get_data_multi_conditional('b_blog', ['b_status' => 1, "b_id" =>	$blog_id])->row();
		$data['categoryList'] =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1]);
		$data['tagList'] =	$this->M_blog->get_data_multi_conditional('b_tag', ['t_status' => 1]);
		$data['callFor'] = "blogEdit";
		$path = 'backend/blog/blog_view';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//details view data into b_blog table
	public function blogDetailsView()
	{
		$data = $this->engine->store_nav('blog', 'blogView', 'Blog Edit');
		$blog_id = $this->input->get("id");
		$data['blogList'] =	$this->M_blog->get_data_multi_conditional('b_blog', ['b_status' => 1, "b_id" =>	$blog_id]);
		$data['blogSingleList'] =	$this->M_blog->get_data_multi_conditional('b_blog', ['b_status' => 1, "b_id" =>	$blog_id])->row();
		$data['callFor'] = "blogDetails";
		$path = 'backend/blog/blog_view';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//inserted data into b_blog table
	public function addBlog()
	{
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$text = $this->input->post('text');
		$cat_title = $this->input->post('cat_title');
		$tag_id = $this->input->post('tag_id');
		$image = $this->engine->image_upload_mod("image", "assets/uploads/blog");
		$dataArray = array(
			'b_title' => $title,
			'b_short_description' => $description,
			'b_text' => $text,
			'b_thum_image' => $image,
			'b_created_at' =>  get_current_time(),
			'b_created_by' => $this->session->userdata('currentActiveId'),
			'b_status' => 1
		);
		$alert = $this->M_blog->set_data('b_blog', $dataArray);
		//cat
		foreach ($cat_title as $value) {
			$b_id =	$this->M_blog->get_single_desc_information('b_blog', "b_id", ['b_status' => 1]);
			$data = array(
				'blog_id' => $b_id->b_id,
				'cat_id' => $value,
				'b_b_cat_status' => 1
			);
			$this->M_blog->set_data('b_blog_category', $data);


			$num_of_blog =	$this->M_blog->get_single_row_information("b_category", ['cat_status' => 1, "cat_id" => $value]);
			$updated = array(
				"num_of_blog" => $num_of_blog->num_of_blog + 1
			);
			$this->M_blog->update_data("b_category", "cat_id", $value, $updated);
		}
		//tag
		foreach ($tag_id as $value) {
			$b_id =	$this->M_blog->get_single_desc_information('b_blog', "b_id", ['b_status' => 1]);
			$data = array(
				'blog_id' => $b_id->b_id,
				'tag_id' => $value,
				'b_b_tag_status' => 1
			);
			$this->M_blog->set_data('b_blog_tag', $data);

			$num_of_blog =	$this->M_blog->get_single_row_information("b_tag", ['t_status' => 1, "t_id" => $value]);
			$updated = array(
				"num_of_blog" => $num_of_blog->num_of_blog + 1
			);
			$this->M_blog->update_data("b_tag", "t_id", $value, $updated);
		}
		set_confirmation_msg(
			$alert,
			"Blog data inserted successfully..",
			"Opps... something went wrong!!"
		);
		redirect('backend/Blog/blogView');
	}
	//update data into b_blog table
	public function updateBlog()
	{

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$text = $this->input->post('text');
		$cat_title = $this->input->post('cat_title');
		$tag_id = $this->input->post('tag_id');

		$config['upload_path'] = "assets/uploads/blog";
		$config['encrypt_name'] = false;
		$config['allowed_types'] = '*';

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload("image")) {
			$error = array('error' => $this->upload->display_errors());
			$imagePath = $this->input->post('hidden_image');
		} else {
			$imagePath = $this->upload->data('file_name');
		}
		$dataArray = array(
			'b_title' => $title,
			'b_short_description' => $description,
			'b_text' => $text,
			'b_thum_image' => $imagePath,
			'b_updated_at' =>  get_current_time(),
			'b_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_blog->update_data('b_blog', 'b_id', $id, $dataArray);
		
		$this->M_blog->delete_data("b_blog_category", "blog_id", $id);
		foreach ($cat_title as $value) {
			$data = array(
				'blog_id' => $id,
				'cat_id' => $value,
				'b_b_cat_status' => 1
			);
			$this->M_blog->set_data('b_blog_category', $data);


			$num_of_blog =	$this->M_blog->get_single_row_information("b_category", ['cat_status' => 1, "cat_id" => $value]);
			$updated = array(
				"num_of_blog" => $num_of_blog->num_of_blog + 1
			);
			$this->M_blog->update_data("b_category", "cat_id", $value, $updated);
		}

		$exitData =	$this->db->query('SELECT cat_id from b_blog_category where b_b_cat_status= 1');
		$array_total = array();
		$array_coma = "";
		$sl = 0;
		if ($exitData) {
			foreach ($exitData->result() as $single_pr) {
				$sl++;
				array_push($array_total, $single_pr->cat_id);
				if ($sl != 1) {
					$array_coma .= ",";
				}
				$array_coma .= $single_pr->cat_id;
			}
		}
		$vals = array_count_values($array_total);
		if ($vals) {
			foreach ($vals as $key_pr => $value_pr) {
				$this->M_blog->update_data('b_category', 'cat_id', $key_pr, ["num_of_blog" => $value_pr]);
			}
		}
		$exitData =	$this->db->query("UPDATE `b_category` SET `num_of_blog` = 0 WHERE `cat_id` not in($array_coma)");


		//tag

		$this->M_blog->delete_data("b_blog_tag", "blog_id", $id);

		if ($tag_id) {
			foreach ($tag_id as $value) {
				$data = array(
					'blog_id' => $id,
					'tag_id' => $value,
					'b_b_tag_status' => 1
				);
				$this->M_blog->set_data('b_blog_tag', $data);



				$num_of_blog =	$this->M_blog->get_single_row_information("b_tag", ['t_status' => 1, "t_id" => $value]);
				$updated = array(
					"num_of_blog" => $num_of_blog->num_of_blog + 1
				);
				$this->M_blog->update_data("b_tag", "t_id", $value, $updated);
			}
		}
		$exitData =	$this->db->query('SELECT tag_id from b_blog_tag where b_b_tag_status = 1');
		if ($exitData) {
			$array_total = array();
			$array_coma = "";
			if ($array_coma != "") {
				$sl = 0;
				if ($exitData) {
					foreach ($exitData->result() as $single_pr) {
						$sl++;
						array_push($array_total, $single_pr->tag_id);
						if ($sl != 1) {
							$array_coma .= ",";
						}
						$array_coma .= $single_pr->tag_id;
					}
				}
				$vals = array_count_values($array_total);
				if ($vals) {
					foreach ($vals as $key_pr => $value_pr) {
						$this->M_blog->update_data('b_tag', 't_id', $key_pr, ["num_of_blog" => $value_pr]);
					}
				}
				$exitData =	$this->db->query("UPDATE `b_tag` SET `num_of_blog` = 0 WHERE `t_id` not in($array_coma)");
			}
		}
		redirect('backend/Blog/blogView');
	}
	//trash data into b_blog table
	public function deleteBlog()
	{
		$id = $this->input->get('id');

		$dataArray = array(
			'b_status' => 0
		);
		$this->M_blog->update_data('b_blog', 'b_id', $id, $dataArray);


		$blogList =	$this->M_blog->get_data_multi_conditional('b_blog_category', ["b_b_cat_status" => 1, "blog_id" => $id]);

		foreach ($blogList->result()  as  $value) {
			$b_cat_totalNum =	$this->M_blog->get_single_row_information('b_category', ["cat_status" => 1, "cat_id" =>  $value->cat_id]);
			$this->M_blog->update_data('b_category', 'cat_id', $b_cat_totalNum->cat_id, ["num_of_blog" => (int)$b_cat_totalNum->num_of_blog - 1]);
		}
		$dataCatArray = array(
			'b_b_cat_status' => 0
		);
		$this->M_blog->update_data('b_blog_category', 'blog_id', $id, $dataCatArray);
		redirect('backend/Blog/blogView');
	}

	//CKEDITOR image uploaded into b_blog table
	public function imageUpload()
	{
		$upload_dir = array(
			'img' =>  "assets/uploads/blog",
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
