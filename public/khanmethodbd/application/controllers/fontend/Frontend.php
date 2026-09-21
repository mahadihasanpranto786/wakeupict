<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{

	private $main_layout = 'fontend/master';
	private $viewPath = 'fontend/blog/';


	public function index()
	{
		$data = $this->engine->store_nav('home', 'Nothing', 'Welcome to dashboard');

		$path = $this->viewPath . 'home';
		$data['main_content'] = $this->load->view($path, $data, TRUE);
		$this->load->view($this->main_layout, $data);
	}
	//view data into Blog Category table
	public function frontendBlogView()
	{
		$data["title"] = "Blog";
		$par_page_data = 6;
		$offset = pagination_offset(4,$par_page_data);
		$data['blogListTag'] = "";

		$url = "fontend/Frontend/frontendBlogView";
		$total_rows =	$this->M_blog->count_data_multi_conditional_join_like("b_blog", "b_id", "b_blog_category", "blog_id", ["b_status" => 1, "b_b_cat_status" => 1]);

		$data['blogList'] =	$this->M_blog->multipleJoinTable_like_limit("b_blog", "b_id", "b_blog_category", "blog_id", ["b_status" => 1, "b_b_cat_status" => 1], $par_page_data, $offset);

		$data['tagList'] =	$this->M_blog->get_data_multi_conditional('b_tag', ['t_status' => 1]);
		$data['category'] =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1]);

		$search = 	$this->input->get("searchBlogName");
		if ($search) {
			$data['blogList'] =	$this->M_blog->getBlogCatByJoinBySearch("b_title", $search, $par_page_data, $offset);
			$total_rows =	$this->M_blog->getBlogCatByJoinBySearch_count("b_title", $search, $par_page_data, $offset);
			if (empty($data['blogList'])) {
				$data["x"] = "<span class='text-danger'>No Data Found</span>";
			}
		}

		set_pagination($total_rows, $url, $par_page_data);
		$data["total_rows"] = $total_rows;

		$path = $this->viewPath . 'blog_view';
		$data['main_content'] = $this->load->view($path, $data, TRUE);
		$this->load->view($this->main_layout, $data);
	}


	//view data into Blog Category By Id table
	public function frontendBlogCategoryView()
	{
		$data["title"] = "Blog";
		$cat_id = $this->input->get('cat_id');
		$par_page_data = 6;
		$data['blogListTag'] = "";
		$offset = pagination_offset(4,$par_page_data);
		$url = "fontend/Frontend/frontendBlogCategoryView";
		$total_rows =	$this->M_blog->count_data_multi_conditional_join_like("b_blog", "b_id", "b_blog_category", "blog_id", ["b_status" => 1, "b_b_cat_status" => 1, "cat_id" => $cat_id]);
		$data['blogList'] =	$this->M_blog->multipleJoinTable_like_limit("b_blog", "b_id", "b_blog_category", "blog_id", ["b_status" => 1, "b_b_cat_status" => 1, "cat_id" => $cat_id], $par_page_data, $offset);
		$data['tagList'] =	$this->M_blog->get_data_multi_conditional('b_tag', ['t_status' => 1]);
		$data['category'] =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1]);
		set_pagination($total_rows, $url, $par_page_data);
		$data["total_rows"] = $total_rows;
		$path = $this->viewPath . 'blog_view';
		$data['main_content'] = $this->load->view($path, $data, TRUE);
		$this->load->view($this->main_layout, $data);
	}
	//view data into Blog Category By Id table
	public function frontendBlogTagView()
	{
		$data["title"] = "Blog";
		$tag_id = $this->input->get('tag_id');
		$par_page_data = 6;
		$offset = pagination_offset(4,$par_page_data);
		$url = "fontend/Frontend/frontendBlogTagView";
		$data['blogList'] = "";
		$total_rows =	$this->M_blog->count_data_multi_conditional_join_like("b_blog", "b_id", "b_blog_tag", "blog_id", ["b_status" => 1, "b_b_tag_status" => 1, "tag_id" => $tag_id]);
		$data['blogListTag'] =	$this->M_blog->multipleJoinTable_like_limit("b_blog", "b_id", "b_blog_tag", "blog_id", ["b_status" => 1, "b_b_tag_status" => 1, "tag_id" => $tag_id], $par_page_data, $offset);
		$data['tagList'] =	$this->M_blog->get_data_multi_conditional('b_tag', ['t_status' => 1]);
		$data['category'] =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1]);
		set_pagination($total_rows, $url, $par_page_data);
		$data["total_rows"] = $total_rows;
		$path = $this->viewPath . 'blog_view';
		$data['main_content'] = $this->load->view($path, $data, TRUE);
		$this->load->view($this->main_layout, $data);
	}
	//view data into Blog details By Id table
	public function blogDetailsView()
	{
		$data["title"] = "Blog-details";
		$blog_id = $this->input->get("blog_id");
		$b_b_cat_id = $this->input->get("b_b_cat_id");
		$b_b_tag_id = $this->input->get("b_b_tag_id");

		if ($b_b_tag_id) {
			$data['blogListTag'] = $this->M_blog->table_join_multi_condition("b_blog", "b_id", "b_blog_tag", "blog_id", ["b_status" => 1, "b_b_tag_status" => 1, "blog_id" => $blog_id, "b_blog_tag_id" => $b_b_tag_id]);
			$data['blogList'] = "";
		} elseif ($b_b_cat_id) {
			$data['blogList'] = $this->M_blog->table_join_multi_condition("b_blog", "b_id", "b_blog_category", "blog_id", ["b_status" => 1, "b_b_cat_status" => 1, "blog_id" => $blog_id, "b_blog_category_id" => $b_b_cat_id]);
			$data['blogListTag'] = "";
		}
		$data['category'] =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1]);
		$data['tagList'] =	$this->M_blog->get_data_multi_conditional('b_tag', ['t_status' => 1]);

		$path = $this->viewPath . 'blog_details';
		$data['main_content'] = $this->load->view($path, $data, TRUE);
		$this->load->view($this->main_layout, $data);
	}
	// inserted Comments
	public function addComments()
	{
		$com_blog_id = $this->input->get("com_blog_id");

		$catPrimaryIdComment = $this->input->get("com_b_cat_id");
		$name = $this->input->get("com_name");
		$massage = $this->input->get("com_massage");

		$dataArray = array(
			"com_blog_id" => $com_blog_id,
			"com_b_cat_id" => $catPrimaryIdComment,
			"com_name" => $name,
			"com_massage" => $massage,
			"com_created_at" => get_current_time(),
			"com_status" => 1
		);
		$this->M_blog->set_data("b_comments", $dataArray);

		redirect($_SERVER['HTTP_REFERER']);
	}
	//View comments 
	public function viewComments()
	{ ?>
		<?php
		$blog_id = $this->input->get("com_blog_id");
		$catPrimaryIdComment = $this->input->get("com_b_b_cat_id");
		$comments =	$this->M_blog->get_data_multi_conditional('b_comments', ['com_status' => 1, "com_blog_id" => $blog_id, "com_b_cat_id" => $catPrimaryIdComment]);
		echo "<h3 id='totalComments'>{$comments->conn_id->affected_rows} Comments </h3>";
		if ($comments) {
			foreach ($comments->result() as  $value) { ?>
				<ul>
					<li>

						<div class="comments-box grey-bg-2" style="padding: 20px;">
							<div id="show" class="comments-info d-flex">
								<div class="comments-avatar mr-15">
									<img src="<?php echo base_url("assets/uploads/image/logo/image_avatar.jpg") ?>" alt="">
								</div>
								<div class="avatar-name">
									<h5><?= $value->com_name ?></h5>
									<span class="post-meta"><?= date("F d, Y h:i:s a", strtotime($value->com_created_at)) ?></span>
								</div>
							</div>
							<div class="comments-text ml-65">
								<p><?= $value->com_massage ?></p>
								<!-- <span class="text-dark badge btn-sm border  border-grey">
										<i class="fa fa-edit"></i><a class="editCommentBtn" data-id="<?= $value->com_id ?>" data-com_name="<?= $value->com_name ?>" data-com_massage="<?= $value->com_massage ?>">Edit</a>
									</span>
									<span class="text-dark badge btn-sm border bg-danger border-grey">
										<i class="fa text-white fa-trash"></i><a class="trashComments deleteAlert text-white" data-id="<?= $value->com_id ?>">Trash</a>
									</span> -->
							</div>
						</div>
					</li>
				</ul>
<?php }
		}
	}
	//updated comments
	public function updateComments()
	{
		$com_id = $this->input->get("com_idEdit");
		$name = $this->input->get("com_nameEdit");
		$massage = $this->input->get("com_massageEdit");
		$dataArray = array(
			"com_name" => $name,
			"com_massage" => $massage,
			"com_updated_at" => get_current_time()
		);
		$this->M_blog->update_data('b_comments', 'com_id', $com_id, $dataArray);
		redirect($_SERVER['HTTP_REFERER']);
	}
	//updated comments
	public function trashComments()
	{
		$com_id = $this->input->get("com_idEdit");
		$dataArray = array(
			"com_status" => 0
		);
		$this->M_blog->update_data('b_comments', 'com_id', $com_id, $dataArray);
		redirect($_SERVER['HTTP_REFERER']);
	}


	//updated comments
	public function trackCall()
	{
		$tc_mobile = $this->input->post("tc_mobile");
		$dataArray = array(
			"tc_mobile" => $tc_mobile,
			"tc_status" => 1,
			"tc_created_at" => get_current_time()
		);
		$this->M_blog->set_data('track_calls', $dataArray);
	}
}
