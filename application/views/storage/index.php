			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('storage'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('overview'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="card h-250">
							<div class="card-header">
								<div class="card-title"><?php echo $this->lang->line('warehouse_space'); ?></div>
							</div>
							<?php
							/*
							* Variables to be used 
							*/
							$total_warehouse_area = $this->warehouse_model->warehouse_total_area($this->session->userdata('warehouseid'));
							$storage_area = $this->warehouse_model->storage_area($this->session->userdata('warehouseid'));
							$potential_storage_area = floatval($total_warehouse_area)> 0 ? (floatval($storage_area)*100 / floatval($total_warehouse_area)) : 0 ;
							$totalInventoryVolume = $this->product_model->totalInventoryVolume($this->session->userdata('warehouseid'));
							$space_utilzation = floatval($storage_area)> 0 ? (floatval($totalInventoryVolume)*100 / floatval($storage_area)) : 0 ;
							?>
							<div class="card-body">
								<ul class="list-group">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span><?php echo $this->lang->line('total_warehouse_size'); ?><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('total_warehouse_size'); ?>" data-content="<?php echo $this->lang->line('total_warehouse_size_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a></span>
										<span class="badge badge-primary badge-pill"><h6><?php echo $total_warehouse_area ;?> <?php echo $this->lang->line('cubic_meter'); ?></h6></span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span><?php echo $this->lang->line('storage_area_size'); ?><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('storage_area_size'); ?>" data-content="<?php echo $this->lang->line('storage_area_size_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a></span>
										<span class="badge badge-primary badge-pill"><h6><?php echo $storage_area ;?> <?php echo $this->lang->line('cubic_meter'); ?></h6></span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span><?php echo $this->lang->line('potential_storage_area'); ?><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('potential_storage_area'); ?>" data-content="<?php echo $this->lang->line('potential_storage_area_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a></span>
										<span class="badge badge-primary badge-pill"><h6><?php echo number_format($potential_storage_area,2) ;?> %</h6></span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span><?php echo $this->lang->line('space_utilization'); ?><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('space_utilization'); ?>" data-content="<?php echo $this->lang->line('space_utilization_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a></span>
										<span class="badge badge-primary badge-pill"><h6><?php echo number_format($space_utilzation,2) ;?> %</h6></span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="card h-250">
							<div class="card-header">
								<div class="card-title"><?php echo $this->lang->line('warehouse_space_chart'); ?></div>
							</div>
							<div class="card-body">
								<canvas id="barChart" style="min-height: 210px; height: 210px; max-height: 210px; max-width: 100%;"></canvas>
							</div>
						</div>
					</div>
					<?php
							/*
							* Variables to be used 
							*/
							$nb_aisles = intval($this->warehouse_model->nb_aisles ($this->session->userdata('warehouseid')));
							$nb_racks = intval($this->warehouse_model->nb_racks ($this->session->userdata('warehouseid')));
							$nb_shelves = intval($this->warehouse_model->nb_shelves ($this->session->userdata('warehouseid')));
							
							?>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="card h-250">
							<div class="card-header">
								<div class="card-title"><?php echo $this->lang->line('storage_organization'); ?></div>
							</div>
							<div class="card-body">
								<ul class="list-group">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span><?php echo $this->lang->line('max_nb_asiles'); ?><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('max_nb_asiles'); ?>" data-content="<?php echo $this->lang->line('max_nb_asiles_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a></span>
										<span class="badge badge-primary badge-pill"><h6><?php echo $nb_aisles;?> <?php echo $this->lang->line('aisles'); ?></h6></span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span><?php echo $this->lang->line('max_nb_racks_line'); ?></span>
										<span class="badge badge-primary badge-pill"><h6><?php echo $nb_aisles*2;?> <?php echo $this->lang->line('rack_lines'); ?></h6></span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span><?php echo $this->lang->line('max_nb_racks'); ?></span>
										<span class="badge badge-primary badge-pill"><h6><?php echo $nb_racks;?> <?php echo $this->lang->line('racks'); ?></h6></span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span><?php echo $this->lang->line('max_nb_shelves'); ?></span>
										<span class="badge badge-primary badge-pill"><h6><?php echo $nb_shelves;?> <?php echo $this->lang->line('shelves'); ?></h6></span>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
					<!-- BARCODES -->
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="card h-250">
							<div class="card-header">
								<div class="card-title"><?php echo $this->lang->line('aisle_barcoding'); ?></div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-2">
										<img src="<?php echo base_url('assets/img/label_barcode.png');?>" class="img-fluid" alt="<?php echo $this->lang->line('aisle_barcoding'); ?>">
									</div>
									<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 mb-2">
										<div class="form-group">
											<label for="defaultLanguage"><?php echo $this->lang->line('barcode_technology'); ?></label>
											<select class="form-control select2" name="barcodeTechnology" id="barcodeTechnology" REQUIRED>
												<option value="1" selected><?php echo $this->lang->line('barcode_1d'); ?></option>
												<option value="2" ><?php echo $this->lang->line('barcode_2d'); ?></option>
											</select>
										</div>
										<div class="form-group">
											<label for="defaultLanguage"><?php echo $this->lang->line('barcode_type'); ?></label>
											<select class="form-control select2" name="barcodeType" id="barcodeType" REQUIRED>
												<option value="1" selected><?php echo $this->lang->line('barcode_39'); ?></option>
												<option value="2" ><?php echo $this->lang->line('barcode_128'); ?></option>
											</select>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
				
	