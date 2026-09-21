<style>
	.product-grid {
		box-shadow: 0 5px 20px rgba(0, 0, 0, 0.18), 0 8px 8px rgba(0, 0, 0, 0.17);
	}

	.blog_title_ellipse {
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 3;
		-webkit-box-orient: vertical;
	}

	/* --------------------
	=> Date: 15/09/2022 
	-------------------- */
	.image-holder img {
		position: absolute;
		left: 50%;
		top: 50%;
		-webkit-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
		width: 100%;
		border: 3px solid #fff;
		border-radius: 8px;
	}

	.product-card .add-to-actions-wrapper {
		top: 0;
	}

	.product-card .add-to-actions-wrapper .blog__hover__text {
		display: -webkit-box;
		-webkit-line-clamp: 5;
		-webkit-box-orient: vertical;
		overflow: hidden;
		text-overflow: ellipsis;
		color: #000;
		padding: 0 25px;
	}

	.product-card:hover .product-image .image-holder,
	.product-card:hover .product-image .image-placeholder {
		opacity: 0.1;
	}
</style>

<link rel="stylesheet" href="<?php echo base_url(''); ?>assets/admin_layout/css/blog.css" />
<main>


	<!-- bg shape area end -->

	<!-- page title area -->
	<section class="page__title-area  pt-85">
		<div class="container">
			<div class="row">
				<div class="col-xxl-12">
					<div class="page__title-content mb-50" style="padding: 20px 0px 7px 15px;">
						<h2 class="page__title">Latest From The Blog</h2>
						<nav aria-label="breadcrumb" style="padding: 10px 0px 0px 0px;">
							<ol class="breadcrumb">
								<li class="active" aria-current="page"> <a href="<?php echo base_url("blog") ?>">Blog</a> </li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- page title end -->

	<!-- postbox area start -->


	<section class="postbox__area pb-120">
		<div class="container" style="margin-bottom: 20px;">
			<div class="row">
				<div class="col-xxl-8 col-xl-8 col-lg-8">
					<div class="postbox__wrapper">
						<?php
						if ($blogList) {
							$sl = 0;
							foreach ($blogList->result() as $row) {
								$sl++ ?>

								<div class="col-md-6">
									<a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_cat_id=<?= $row->b_blog_category_id ?>" class="product-card">
										<div class="product-card-inner">
											<div class="product-image clearfix">
												<ul class="product-ribbon list-inline">
													<!-- Content will show over image  -->
												</ul>
												<div class="image-holder">
													<img src="<?php echo base_url("assets/uploads/blog/") . $row->b_thum_image ?>" max-width="100%" height="450px" alt="">
												</div>
											</div>

											<div class="add-to-actions-wrapper">
												<p class="blog__hover__text">
													<?php //Previously used php code 

													?>
													<span class="h4"><?php
																		if (strlen($row->b_title) > 100) {
																			echo substr($row->b_title, 0, 100) . '..';
																		} else {
																			echo $row->b_title;
																		}
																		?></span>
													<br>
													<span class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i><?= date("F d, Y", strtotime($row->b_created_at)) ?></span>
													<br>
													<span><?php
															if (strlen($row->b_text) > 200) {
																echo substr($row->b_text, 0, 200) . '...';
															} else {
																echo $row->b_text;
															}
															?></span>

												</p>
											</div>
										</div>
									</a>
								</div>
								<input type="hidden" id="countValue" value="<?= isset($blogList->result_id->num_rows) ? "{$blogList->result_id->num_rows}" : "0"; ?>">
							<?php 	}
						}
						if ($blogListTag) {
							$sl = 0;
							foreach ($blogListTag->result() as $row) {
								$sl++ ?>
								<div class="col-md-6">
									<a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_tag_id=<?= $row->b_blog_tag_id ?>" class="product-card">
										<div class="product-card-inner">
											<div class="product-image clearfix">
												<ul class="product-ribbon list-inline">
													<!-- Content will show over image  -->
												</ul>
												<div class="image-holder">
													<img src="<?php echo base_url("assets/uploads/blog/") . $row->b_thum_image ?>" max-width="100%" height="450px" alt="">
												</div>
											</div>

											<div class="add-to-actions-wrapper">
												<p class="blog__hover__text">
													<?php //Previously used php code 

													?>
													<span class="h4"><?php
																		if (strlen($row->b_title) > 100) {
																			echo substr($row->b_title, 0, 100) . '..';
																		} else {
																			echo $row->b_title;
																		}
																		?></span>
													<br>
													<span class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i><?= date("F d, Y", strtotime($row->b_created_at)) ?></span>
													<br>
													<span><?php
															if (strlen($row->b_text) > 200) {
																echo substr($row->b_text, 0, 200) . '...';
															} else {
																echo $row->b_text;
															}
															?></span>

												</p>
											</div>
										</div>
									</a>
								</div>
								<input type="hidden" id="countValue" value="<?= isset($blogListTag->result_id->num_rows) ? "{$blogListTag->result_id->num_rows}" : "0"; ?>">

						<?php 	}
						}
						?>

					</div>
					<div class="row">
						<div class="col-md-12 " style="margin: 15px 0px 0px 0px;">
							<div class=" basic-pagination wow fadeInUp text-center" data-wow-delay=".2s" style="border-bottom:0px">
								<?= $this->pagination->create_links() ?>
								<span>Showing <span id="showingRow"></span> Result From <?= isset($total_rows) ? "$total_rows" : "0"; ?> Result</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xxl-4 col-xl-4 col-lg-4">
					<div class="blog__sidebar-wrapper  ml-30">
						<div class="blog__sidebar mb-30">
							<div class="sidebar__widget mb-30">
								<div class="sidebar__widget-content">
									<div class="sidebar__search-wrapper">

										<form action="<?php echo base_url("fontend/Frontend/frontendBlogView") ?>">
											<input type="text" name="searchBlogName" placeholder="Search ...">
											<button type="submit"><i class="fa fa-search" aria-hidden="true"></i>
											</button>
										</form>
									</div>
								</div>
							</div>
							<div class="panel ">
								<div class="panel-body">
									<h3>Recent News</h3>
								</div>
								<div class="sidebar__widget-content">
									<div class="rc__post-wrapper" style="overflow: scroll; overflow-x: hidden; height:200px">
										<?php
										if (isset($x)) {
											echo $x;
										}
										if ($blogList) {
											foreach ($blogList->result() as $key => $value) {

										?>

												<div class="rc__post d-flex align-items-center">
													<div class="row">
														<div class="col-md-3 col-3">
															<a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $value->blog_id ?>&&b_b_cat_id=<?= $value->b_blog_category_id ?> "><img src="<?php echo base_url("assets/uploads/blog/") . $value->b_thum_image ?>" height="50" width="60" alt=""></a>
														</div>
														<div class="col-md-9 col-9">
															<span><?= date("F d, Y", strtotime($value->b_created_at)) ?></span>
															<h6 class="rc__title"><a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $value->blog_id ?>&&b_b_cat_id=<?= $value->b_blog_category_id ?> "><?= $value->b_title ?></a></h6>
														</div>
													</div>
												</div>
											<?php }
										} elseif ($blogListTag) {
											foreach ($blogListTag->result() as $key => $value) {
												if ($key == 4) {
													break;
												}
											?>

												<div class="rc__post d-flex align-items-center">
													<div class="row">
														<div class="col-md-3 col-3">
															<a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $value->blog_id ?>&&b_b_tag_id=<?= $value->b_blog_tag_id ?> "><img src="<?php echo base_url("assets/uploads/blog/") . $value->b_thum_image ?>" height="50" width="60" alt=""></a>
														</div>
														<div class="col-md-9 col-9">
															<span><?= date("F d, Y", strtotime($value->b_created_at)) ?></span>
															<h6 class="rc__title"><a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $value->blog_id ?>&&b_b_tag_id=<?= $value->b_blog_tag_id ?> "><?= $value->b_title ?></a></h6>
														</div>
													</div>

												</div>
										<?php }
										} ?>
									</div>
								</div>
							</div>
							<div class="sidebar__widget mb-30 panel">
								<div class="sidebar__widget-title">
									<h3>Categories</h3>
								</div>
								<div class="sidebar__widget-content">
									<div class="sidebar__catagory" style="overflow: scroll; overflow-x: hidden; height:100px">
										<ul>
											<?php

											$blog_tag_details =	$this->M_blog->get_data_multi_conditional('b_category', ['num_of_blog !=' => 0, "cat_status" => 1]);
											if ($blog_tag_details) {
												foreach ($blog_tag_details->result() as  $blog_cat_id) {
											?>
													<li><i class="fa fa-angle-right" aria-hidden="true"></i><a href="<?php echo base_url('fontend/Frontend/frontendBlogCategoryView?') ?>cat_id=<?= $blog_cat_id->cat_id ?>"><?= $blog_cat_id->cat_title ?>
															<?php $blog_cat_id->cat_title;
															echo "( " . $blog_cat_id->num_of_blog . " )";
															?>
														</a>
													</li>
											<?php }
											}
											?>
										</ul>
									</div>
								</div>
							</div>
							<div class="sidebar__widget">
								<div class="sidebar__widget-title">
									<h3>Popular Tags</h3>
								</div>
								<div class="sidebar__widget-content">
									<div class="tags" style="overflow: scroll; overflow-x: hidden; height:100px">
										<?php

										$blog_tag_details =	$this->M_blog->get_data_multi_conditional('b_tag', ['num_of_blog !=' => 0, "t_status" => 1]);
										if ($blog_tag_details) {
											foreach ($blog_tag_details->result() as  $blog_tag_id) {
										?>
												<a href="<?php echo base_url('fontend/Frontend/frontendBlogTagView?') ?>tag_id=<?= $blog_tag_id->t_id ?>"><?= $blog_tag_id->t_title ?></a>
										<?php }
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- postbox area end -->
</main>

<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>

<script>
	$(document).ready(function() {
		var valueCount = $("#countValue").val()

		if (valueCount == undefined) {
			$("#showingRow").text(0)
		} else {
			$("#showingRow").text(valueCount)
		}
	})
</script>