<?php
$category = get_rltn_data_multi_con('categories', ['c_status' => 0, 'c_parent' => 0]);
?>
<div class="content-wrapper clearfix ">
	<div class="container">
		<section class="product-list">
			<div class="row">
				<!-- sidebar area start -->
				<div class="col-md-3 col-sm-12">
					<div class="product-list-sidebar clearfix">
						<div class="filter-section clearfix">
							<h4>Category</h4>
							<ul class="filter-category list-inline" style="overflow: scroll; overflow-x: hidden; height:400px">
								<?php
								if ($category) {
									foreach ($category->result() as $row) { ?>


										<li class="">
											<a href="<?php echo base_url(); ?>product/category/<?= $row->c_id ?>">
												<?= $row->c_name ?>
											</a>
											<?php
											$parent = get_rltn_data_multi_con('categories', ['c_parent' => $row->c_id, 'c_status' => 0]);
											//$not_parent=category('categories');
											if ($parent) { ?>
												<ul>
													<?php foreach ($parent->result() as $row1) { ?>
														<li class="">
															<a href="<?php echo base_url(); ?>product/category/<?= $row1->c_id ?>">
																<?= $row1->c_name ?>
															</a>
														</li>
													<?php } ?>


												</ul>
											<?php } ?>
										</li>
								<?php }
								} ?>
							</ul>
						</div>
						<form method="GET" action="<?php echo base_url(); ?>fontend/Product/filter_search" id="product-filter-form">
							<input type="hidden" name="sort" value="latest">


							<div class="price-range-picker">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-sm-3 col-xs-6">
											<label for="price-from">From</label>
											<input type="text" name="fromPrice" class="from-control range-from" id="price-from">
										</div>
										<div class="col-md-6 col-sm-3 col-xs-6">
											<label for="price-to">To</label>
											<input type="text" name="toPrice" class="from-control range-to" id="price-to">
										</div>
									</div>
								</div>
								<div class="slider noUi-target noUi-ltr noUi-horizontal" id="price-range-slider" data-to-price="17120.0000" data-max="17120.0000">
									<div class="noUi-base">
										<div class="noUi-connects"></div>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-filter pull-right">Filter</button>
						</form>
					</div>
				</div>
				<!-- sidebar area end -->
				<!-- Category product area start -->
				<div class="col-md-9 col-sm-12">
					<div class="product-list-header clearfix">
						<div class="search-result-title pull-left">
							<h3>Shops</h3>
							<?php
							$allCatCount = 0;
							if ($categorySingle) {
								$allCategory = $this->Common->get_data_multi_conditional("categories", ["c_parent" => $categorySingle->c_id]);
								if ($allCategory) {
									foreach ($allCategory->result() as $key => $allCat) {
										$productList =	$this->Common->get_data_single_multi_conditional("poducts", ["p_status" => 0, "p_category" => $allCat->c_id]);
										if ($productList) {
											$allCatCount += $allCat->c_status + 1;
										}
									}
								}
							}
							?>
							<span>
								<?php
								if ($allCatCount > 0) {
									echo $allCatCount;
								} else {
									echo $category_product_count;
								}
								?> products found</span>
						</div>
						<div class="search-result-right pull-right">
							<ul class="nav nav-tabs">
								<!-- <li class="view-mode active">
									<a href="#" title="Grid view">
										<i class="fa fa-th-large" aria-hidden="true"></i>
									</a>
								</li> -->
								<!-- <li class="view-mode ">
									<a href="productsb885.html?sort=latest&amp;viewMode=list" title="List view">
										<i class="fa fa-th-list" aria-hidden="true"></i>
									</a>
								</li> -->
							</ul>
							<!-- <div class="form-group">
								<select class="custom-select-black" onchange="location = this.value">
									<option value="products3d57.html?sort=relevance" >
										Relevance
									</option>
									<option value="products6e35.html?sort=alphabetic" >
										Alphabetic
									</option>
									<option value="products2504.html?sort=topRated" >
										Top Rated
									</option>
									<option value="http://edokani.codefixit.com/products?sort=latest" selected>
										Latest
									</option>
									<option value="products8d12.html?sort=priceLowToHigh" >
										Price: Low to High
									</option>
									<option value="products2a07.html?sort=priceHighToLow" >
										Price: High to Low
									</option>
								</select>
							</div> -->
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="product-list-result clearfix">
						<div class="tab-content">
							<div id="grid-view" class="tab-pane active">
								<div class="row">
									<div class="grid-products separator">
										<?php
										if ($category_product) {
											foreach ($category_product->result() as $row) { ?>
												<div class="product-card">
													<div class="product-card-inner">
														<a href="<?php echo base_url(); ?>product/details/<?= $row->p_id ?>">
															<div class="product-image clearfix">
																<ul class="product-ribbon list-inline">
																	<li>
																		<?php if ($row->p_quantity > 0) {
																		} else { ?>
																			<span class="ribbon bg-red">Out of Stock </span>
																		<?php } ?>
																	</li>

																</ul>
																<div class="image-holder">
																	<img src="<?php echo base_url(); ?>assets/products/<?= $row->p_imagepath ?>">
																</div>

															</div>
															<div class="product-content clearfix">
																<span class="product-price"> BDT <?= $row->p_sprice ?></span>
																<span class="product-name"><?= $row->p_tittle ?></span>
															</div>
														</a>
														<div class="add-to-actions-wrapper">
															<a id="<?= $row->p_id ?>" class="btn btn-default btn-add-to-cart add_to_card">
																Add to Cart
															</a>
														</div>
													</div>
												</div>

												<?php }
										}
										if ($categorySingle) {
											$allCategory = $this->Common->get_data_multi_conditional("categories", ["c_parent" => $categorySingle->c_id]);
											if ($allCategory) {
												foreach ($allCategory->result() as $key => $allCat) {

													$productList =	$this->Common->get_data_single_multi_conditional("poducts", ["p_status" => 0, "p_category" => $allCat->c_id]);
													if ($productList) {
												?>
														<div class="product-card">
															<div class="product-card-inner">
																<a href="<?php echo base_url(); ?>product/details/<?= $productList->p_id ?>">
																	<div class="product-image clearfix">
																		<ul class="product-ribbon list-inline">
																			<li>
																				<?php if ($productList->p_quantity > 0) {
																				} else { ?>
																					<span class="ribbon bg-red">Out of Stock </span>
																				<?php } ?>
																			</li>

																		</ul>
																		<div class="image-holder">
																			<img src="<?php echo base_url(); ?>assets/products/<?= $productList->p_imagepath ?>">
																		</div>

																	</div>
																	<div class="product-content clearfix">
																		<span class="product-price">BDT <?= $productList->p_sprice ?></span>
																		<span class="product-name"><?= $productList->p_tittle ?></span>
																	</div>
																</a>
																<div class="add-to-actions-wrapper">
																	<a id="<?= $productList->p_id ?>" class="btn btn-default btn-add-to-cart add_to_card">
																		Add to Cart
																	</a>
																</div>
															</div>
														</div>

										<?php
													}
												}
											}
										}




										?>



									</div>
								</div>
							</div>
							<div id="list-view" class="tab-pane ">
							</div>
						</div>
					</div>
					<!-- <div class="pull-right">
						<ul class="pagination" role="navigation">
							
							<li class="page-item disabled" aria-disabled="true" aria-label="pagination.previous">
								<span class="page-link" aria-hidden="true">&lsaquo;</span>
							</li>
							
							
							
							
							
							<li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
							<li class="page-item"><a class="page-link" href="productsa6a0.html?sort=latest&amp;page=2">2</a></li>
							<li class="page-item"><a class="page-link" href="products17f4.html?sort=latest&amp;page=3">3</a></li>
							<li class="page-item"><a class="page-link" href="products3644.html?sort=latest&amp;page=4">4</a></li>
							<li class="page-item"><a class="page-link" href="productsd205.html?sort=latest&amp;page=5">5</a></li>
							<li class="page-item"><a class="page-link" href="products6fef.html?sort=latest&amp;page=6">6</a></li>
							
							
							<li class="page-item">
								<a class="page-link" href="productsa6a0.html?sort=latest&amp;page=2" rel="next" aria-label="pagination.next">&rsaquo;</a>
							</li>
						</ul>
					</div> -->
				</div>
				<!-- Category product area end -->
			</div>
		</section>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
</div>