<!-- cart mini area start -->
<style>
	.postShort+p {
		overflow: hidden;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
	}
</style>
<link rel="stylesheet" href="<?php echo base_url(''); ?>assets/admin_layout/css/blog.css" />
<!-- page title area -->
<section class="page__title-area  pt-85">
	<div class="container">
		<div class="row">
			<div class="col-xxl-12">
				<div class="page__title-content mb-50" style="padding: 20px 0px 7px 15px;">
					<h2 class="page__title">Latest From The Blog</h2>
					<nav aria-label="breadcrumb" style="padding: 10px 0px 0px 0px;">
						<ol class="breadcrumb">
							<li class="breadcrumb-item " aria-current="page"> <a href="<?php echo base_url("blog") ?>">Blog</a> </li>
							<li class="active">Blog-details</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="page__title-area pt-85">
	<div class="container" style="padding: 28px 0px 7px 15px;">
		<?php
		if ($blogList) {
			foreach ($blogList->result() as $blog) { ?>
				<h1 class="page__title"><?= $blog->b_title ?></h1>
				<div class="postbox__author-2 mt-20">
					<div class="row" style="padding: 25px 0px 20px 30px;">
						<ul class="nav navbar-nav">
							<li class="dropdown fluid-menu">
								<div class="postbox__author-thumb-2">
									<img src="<?php echo base_url("assets/uploads/authority/") . resultCheck($blog->b_created_by, "authority_id", "authority_image", "authority");  ?>" alt="">
								</div>
							</li>
							<li class="">
								<h6><a href="#"><?= resultCheck($blog->b_created_by, "authority_id", "authority_name", "authority"); ?></a></h6>
							</li>
							<li>
								<h6><?= date("F d, Y", strtotime($blog->b_created_at)) ?></h6>
								<span>Published</span>
							</li>
						</ul>
					</div>
				</div>
			<?php }
		} elseif ($blogListTag) {
			foreach ($blogListTag->result() as $blog) { ?>
				<h1 class="page__title"><?= $blog->b_title ?></h1>
				<div class="postbox__author-2 mt-20">
					<div class="row" style="padding: 25px 0px 20px 30px;">
						<ul class="nav navbar-nav">
							<li class="dropdown fluid-menu">
								<div class="postbox__author-thumb-2">
									<img src="<?php echo base_url("assets/uploads/authority/") . resultCheck($blog->b_created_by, "authority_id", "authority_image", "authority");  ?>" alt="">
								</div>
							</li>
							<li class="">
								<h6><a href="#"><?= resultCheck($blog->b_created_by, "authority_id", "authority_name", "authority"); ?></a></h6>
							</li>
							<li>
								<h6><?= date("F d, Y", strtotime($blog->b_created_at)) ?></h6>
								<span>Published</span>
							</li>
						</ul>
					</div>
				</div>
		<?php }
		} ?>
	</div>
</section>
<!-- page title end -->

<!-- postbox area start -->
<section class="postbox__area pb-120">
	<div class="container">
		<div class="row">
			<div class="col-xxl-8 col-xl-8 col-lg-8" style="padding: 0px 0px 70px 0px;">
				<div class="postbox__wrapper">
					<?php
					if ($blogList) {
						foreach ($blogList->result() as $row) { ?>
							<article class="postbox__item format-image fix mb-50 wow fadeInUp" data-wow-delay=".2s">
								<div class="postbox__thumb">
									<a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_cat_id=<?= $row->b_blog_category_id ?>" class="w-img">
										<img src="<?php echo base_url("assets/uploads/blog/") . $row->b_thum_image ?>" max-width="100%" height="450px" alt="">
									</a>
								</div>
								<div class="postbox__content">
									<div class="postbox__meta d-flex mb-10">
										<div class="postbox__tag mr-20">
											<a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_cat_id=<?= $row->b_blog_category_id ?>">
												<?php
												$pageDetailsList =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1, "cat_id" => $row->cat_id]);
												if ($pageDetailsList) {
													foreach ($pageDetailsList->result() as  $value) {
														echo $value->cat_title;
													}
												}

												?></a>
										</div>
										<div class="postbox__date">
											<span><i class="fal fa-clock"></i> <?= date("F d, Y", strtotime($row->b_created_at)) ?></span>
										</div>
									</div>
									<h3 class="postbox__title mb-15"><a href="<?= base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_cat_id=<?= $row->b_blog_category_id ?> "><?= $row->b_title ?></a></h3>
									<div class="postbox__details mb-30">
										<p><?= $row->b_text  ?></p>
									</div>
									<div class="postbox__text mb-20">
										<p><?= $row->b_short_description  ?></p>
									</div>
									<div class="postbox__author d-flex align-items-center">
										<div class="postbox__author-thumb mr-15">
											<img src="<?php echo base_url("assets/uploads/authority/");
														echo resultCheck($row->b_created_by, "authority_id", "authority_image", "authority")  ?>" alt="">
										</div>
										<h5>Post by <a href="#"><?= resultCheck($row->b_created_by, "authority_id", "authority_name", "authority");
																?>
											</a> </h5>
									</div>
									<input id="blogIdForComment" type="hidden" value="<?= $row->blog_id ?>" name="blog_id">
									<input id="blogCatIdForComment" type="hidden" value="<?= $row->b_blog_category_id ?>" name="b_b_cat_id">
								</div>
							</article>
							<div class="postbox__tag postbox__tag-3 d-sm-flex mb-25 " style="padding: 0px 0px 15px 20px;">
								<h5 style="padding: 0px 0px 15px 5px;">Tagged with:</h5>
								<?php

								$blog_tag_details =	$this->M_blog->get_data_multi_conditional('b_blog_tag', ['b_b_tag_status' => 1, "blog_id" => $row->blog_id]);
								if ($blog_tag_details) {
									foreach ($blog_tag_details->result() as  $blog_tag_id) {
										$tag =	$this->M_blog->get_single_row_information("b_tag", ['t_status' => 1, "t_id" => $blog_tag_id->tag_id]);
								?>
										<a href="<?php echo base_url('fontend/Frontend/frontendBlogTagView?') ?>tag_id=<?= $tag->t_id ?>"><?= $tag->t_title ?></a>
								<?php }
								}
								?>
							</div>
						<?php 	}
					} elseif ($blogListTag) {
						foreach ($blogListTag->result() as $row) { ?>
							<article class="postbox__item format-image fix mb-50 wow fadeInUp" data-wow-delay=".2s">
								<div class="postbox__thumb">
									<a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_tag_id=<?= $row->b_blog_tag_id ?>" class="w-img">
										<img src="<?php echo base_url("assets/uploads/blog/") . $row->b_thum_image ?>" max-width="100%" height="450px" alt="">
									</a>
								</div>
								<div class="postbox__content">
									<div class="postbox__meta d-flex mb-10">
										<div class="postbox__tag mr-20">
											<a style="padding: 5px ;" href="<?php echo base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_tag_id=<?= $row->b_blog_tag_id ?>">
												<?php
												$blog_cat =	$this->M_blog->get_single_row_information('b_blog_category', ['b_b_cat_status' => 1, "blog_id" => $row->b_id]);
												if ($blog_cat) {
													$pageDetailsList =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1, "cat_id" => $blog_cat->cat_id]);
													if ($pageDetailsList) {
														foreach ($pageDetailsList->result() as  $value) {
															echo $value->cat_title;
														}
													}
												}
												?></a>
										</div>
										<div class="postbox__date">
											<span><i class="fal fa-clock"></i> <?= date("F d, Y", strtotime($row->b_created_at)) ?></span>
										</div>
									</div>
									<h3 class="postbox__title mb-15"><a href="<?= base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_tag_id=<?= $row->b_blog_tag_id ?> "><?= $row->b_title ?></a></h3>
									<div class="postbox__text mb-20">
										<p><?= $row->b_short_description  ?></p>
									</div>
									<div class="postbox__details mb-30">
										<p><?= $row->b_text  ?></p>
									</div>
									<div class="postbox__author d-flex align-items-center">
										<div class="postbox__author-thumb mr-15">
											<img src="<?php echo base_url("assets/uploads/authority/");
														echo resultCheck($row->b_created_by, "authority_id", "authority_image", "authority")  ?>" alt="">
										</div>
										<h5>Post by <a href="#"><?= resultCheck($row->b_created_by, "authority_id", "authority_name", "authority");
																?>
											</a> </h5>
									</div>
								</div>
							</article>
							<div class="postbox__tag postbox__tag-3 d-sm-flex mb-25" style="padding: 0px 15px 15px 10px;">
								<h5 style="padding: 0px 0px 15px 5px;">Tagged with:</h5>
								<?php

								$blog_tag_details =	$this->M_blog->get_data_multi_conditional('b_blog_tag', ['b_b_tag_status' => 1, "blog_id" => $row->blog_id]);
								if ($blog_tag_details) {
									foreach ($blog_tag_details->result() as  $blog_tag_id) {
										$tag =	$this->M_blog->get_single_row_information("b_tag", ['t_status' => 1, "t_id" => $blog_tag_id->tag_id]);
								?>
										<a href="<?php echo base_url('fontend/Frontend/frontendBlogTagView?') ?>tag_id=<?= $tag->t_id ?>"><?= $tag->t_title ?></a>
								<?php }
								}
								?>
							</div>
					<?php 	}
					}
					?>
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
						<div class="sidebar__widget mb-30">
							<div class="sidebar__widget-title">
								<h3>Recent News</h3>
							</div>
							<div class="sidebar__widget-content">
								<div class="rc__post-wrapper">
									<?php
									if (isset($x)) {
										echo $x;
									}
									if ($blogList) {
										foreach ($blogList->result() as $key => $value) {
											if ($key == 4) {
												break;
											}
									?>
											<div class="rc__post d-flex align-items-center">
												<div class="rc__thumb mr-15">
													<div class="row">
														<div class="col-md-3 col-3">
															<a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_cat_id=<?= $value->b_blog_category_id ?> "><img src="<?php echo base_url("assets/uploads/blog/") . $value->b_thum_image ?>" height="50" width="60" alt=""></a>
														</div>
														<div class="col-md-9 col-9">
															<span><?= date("F d, Y", strtotime($value->b_created_at)) ?></span>
															<h6 class="rc__title"><a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_cat_id=<?= $value->b_blog_category_id ?> "><?= $value->b_title ?></a></h6>
														</div>
													</div>
												<?php }
										}
										if ($blogListTag) {
											foreach ($blogListTag->result() as $key => $value) {
												if ($key == 4) {
													break;
												}
												?>
													<div class="rc__post d-flex align-items-center">
														<div class="rc__thumb mr-15">
															<div class="row">
																<div class="col-md-3 col-3">
																	<a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_tag_id=<?= $value->b_blog_tag_id ?> "><img src="<?php echo base_url("assets/uploads/blog/") . $value->b_thum_image ?>" height="50" width="60" alt=""></a>
																</div>
																<div class="col-md-9 col-9">
																	<span><?= date("F d, Y", strtotime($value->b_created_at)) ?></span>
																	<h6 class="rc__title"><a href="<?php echo base_url("blog_details?") ?>blog_id=<?= $row->blog_id ?>&&b_b_tag_id=<?= $value->b_blog_tag_id ?> "><?= $value->b_title ?></a></h6>
																</div>
															</div>
													<?php }
											} ?>
														</div>
													</div>
												</div>
												<div class="sidebar__widget mb-30">
													<div class="sidebar__widget-title">
														<h3>Categories</h3>
													</div>
													<div class="sidebar__widget-content">
														<div class="sidebar__catagory" style="overflow: scroll; overflow-x: hidden; height:150px"">
															<ul>
																<?php

																$blog_tag_details =	$this->M_blog->get_data_multi_conditional('b_category', ['num_of_blog !=' => 0, "cat_status" => 1]);
																if ($blog_tag_details) {
																	foreach ($blog_tag_details->result() as  $blog_cat_id) {
																?>
																		<li><i class=" fa fa-angle-right" aria-hidden="true"></i><a href="<?php echo base_url('fontend/Frontend/frontendBlogCategoryView?') ?>cat_id=<?= $blog_cat_id->cat_id ?>"><?= $blog_cat_id->cat_title ?>
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
																	<a href=" <?php echo base_url('fontend/Frontend/frontendBlogTagView?') ?>tag_id=<?= $blog_tag_id->t_id ?>"><?= $blog_tag_id->t_title ?></a>
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
				</div>
			</div>
		</div>
	</div>
</section>
<!-- postbox area end -->

</main>