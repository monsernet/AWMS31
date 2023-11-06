			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item "><?php echo $this->lang->line('warehouses'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('new_warehouse'); ?></li>
				</ol>
				
			</div>
			<div class="main-container ml-2">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?php echo base_url('warehouses/save-new-warehouse');?>">
							<div class="container">
								<div class="card">
									<div class="form">
										<div class="left-side">
											<div class="left-heading">
												<h3><?php echo $this->lang->line('add_new_warehouse'); ?></h3>
											</div>
											<div class="steps-content">
												<h3><?php echo $this->lang->line('step'); ?> <span class="step-number">1</span></h3>
												<p class="step-number-content active"><?php echo $this->lang->line('step1_notes'); ?></p>
												<p class="step-number-content d-none"><?php echo $this->lang->line('step2_notes'); ?></p>
												<p class="step-number-content d-none"><?php echo $this->lang->line('step3_notes'); ?></p>
												<p class="step-number-content d-none"><?php echo $this->lang->line('step4_notes'); ?></p>
												<p class="step-number-content d-none"><?php echo $this->lang->line('step5_notes'); ?></p>
											</div>
											<ul class="progress-bar-step">
												<li class="active"><?php echo $this->lang->line('general_information'); ?></li>
												<li><?php echo $this->lang->line('warehouse_settings'); ?></li>
												<li><?php echo $this->lang->line('storage_settings'); ?></li>
												<li><?php echo $this->lang->line('inventory_settings'); ?></li>
												<li><?php echo $this->lang->line('eoq_settings'); ?></li>
											</ul>
											

											
										</div>
										<div class="right-side">
											<div class="main active">
												<div class="text">
													<h2><?php echo $this->lang->line('general_information'); ?></h2>
													<p><?php echo $this->lang->line('step1_notes'); ?></p>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label ><?php echo $this->lang->line('warehouse_name'); ?></label>
														<input type="text" class="form-control form-control-sm" name="nw_warehouseName" id="nw_warehouseName" required require >
													</div>
													<div class="input-div"> 
														<label ><?php echo $this->lang->line('address'); ?></label>
														<textarea class="form-control form-control-sm" name="nw_warehouseAddress" id="nw_warehouseAddress" required require></textarea>
													</div>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label ><?php echo $this->lang->line('city'); ?></label>
														<input type="text" class="form-control form-control-sm" name="nw_warehouseCity" id="nw_warehouseCity" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('country'); ?></label>
														<input type="text" class="form-control form-control-sm" name="nw_warehouseCountry" id="nw_warehouseCountry" required require>
													</div>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label ><?php echo $this->lang->line('warehouse_manager'); ?></label>
														<input type="text" class="form-control form-control-sm" name="nw_warehouseManager" id="nw_warehouseManager" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('phone'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_warehousePhone" id="nw_warehousePhone" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('mobile'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_warehouseMobile" id="nw_warehouseMobile">
													</div>
													
												</div>
												<div class="buttons">
													<button class="next_button"><span class="icon-arrow-right-circle"></span> <?php echo $this->lang->line('next'); ?></button>
												</div>
											</div>
											<div class="main">
												<small><i class="fa fa-smile-o"></i></small>
												<div class="text">
													<h2><?php echo $this->lang->line('warehouse_settings'); ?></h2>
													<p><?php echo $this->lang->line('step2_notes'); ?></p>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label ><?php echo $this->lang->line('warehouse_length'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_warehouseLength" id="nw_warehouseLength" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('warehouse_width'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_warehouseWidth" id="nw_warehouseWidth" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('warehouse_height'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_warehouseHeigth" id="nw_warehouseHeigth" required require>
													</div>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label ><?php echo $this->lang->line('storage_zone_length'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_storageLength" id="nw_storageLength" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('storage_zone_width'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_storageWidth" id="nw_storageWidth" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('storage_zone_height'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_storageHeigth" id="nw_storageHeigth" required require>
													</div>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label ><?php echo $this->lang->line('office_area'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_officeSpace" id="nw_officeSpace" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('restroom_area'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_restroomSpace" id="nw_restroomSpace" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('other_reserved_area'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_otherSpace" id="nw_otherSpace" required require>
													</div>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label><?php echo $this->lang->line('stock_type'); ?></label>
														<select class="form-control form-control-sm" name="nw_stockType" id="nw_stockType" required require>
															<option value=""><?php echo $this->lang->line('select'); ?></option>
															<option value="1" selected ><?php echo $this->lang->line('finished_products'); ?></option>
															<option value="2" disabled><?php echo $this->lang->line('raw_material'); ?></option>
															<option value="3" disabled><?php echo $this->lang->line('semi_finished_products'); ?></option>
														</select>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('storage_cost_rate'); ?></label>
														<input type="number" min="0" step="0.01" class="form-control form-control-sm" name="nw_storageCostRate" id="nw_storageCostRate" required require>
													</div>
													
												</div>
												<div class="buttons button_space">
													<button class="back_button"><span class="icon-arrow-left-circle"></span> <?php echo $this->lang->line('back'); ?></button>
													<button class="next_button"><span class="icon-arrow-right-circle"></span> <?php echo $this->lang->line('next'); ?></button>
												</div>
											</div>
											<div class="main ">
												<div class="text">
													<h2><?php echo $this->lang->line('storage_settings'); ?></h2>
													<p><?php echo $this->lang->line('step3_notes'); ?></p>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label ><?php echo $this->lang->line('rack_height'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_rackHeight" id="nw_rackHeight" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('rack_length'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_rackLength" id="nw_rackLength" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('rack_width'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_rackWidth" id="nw_rackWidth" required require>
													</div>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label ><?php echo $this->lang->line('shelf_height'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_shelfHeight" id="nw_shelfHeight" required require>
													</div>
													<div class="input-div">
														<label ><?php echo $this->lang->line('asile_width'); ?></label>
														<input type="number" class="form-control form-control-sm" name="nw_aisleWidth" id="nw_aisleWidth" required require>
													</div>
													
												</div>
												<div class="input-text">
													<div class="input-div">
														<label><?php echo $this->lang->line('warehouse_racking_system'); ?></label>
														<select class="form-control form-control-sm" name="nw_rackingSystem" id="nw_rackingSystem" required require>
															<option value=""><?php echo $this->lang->line('select'); ?></option>
															<option value="1" selected><?php echo $this->lang->line('selective_racking_system'); ?></option>
														</select>
													</div>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label><?php echo $this->lang->line('inventory_system'); ?></label>
														<select class="form-control form-control-sm" name="nw_inventorySystem" id="nw_inventorySystem" required require>
															<option value=""><?php echo $this->lang->line('select'); ?></option>
															<?php foreach($inventorySystems as $invSystem) { ?>
																<option value="<?php echo $invSystem->id; ?>" ><?php echo $invSystem->shortName; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label><?php echo $this->lang->line('storage_system'); ?></label>
														<select class="form-control form-control-sm" name="nw_storageSystem" id="nw_storageSystem" required require>
															<option value=""><?php echo $this->lang->line('select'); ?></option>
															<?php foreach($storageSystems as $storSystem) { ?>
																<option value="<?php echo $storSystem->id; ?>"><?php echo $storSystem->systemName; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												
												<div class="buttons button_space">
													<button class="back_button"><span class="icon-arrow-left-circle"></span> <?php echo $this->lang->line('back'); ?></button>
													<button class="next_button"><span class="icon-arrow-right-circle"></span> <?php echo $this->lang->line('next'); ?></button>
												</div>
											</div>
											
											
											
											<div class="main">
												<div class="text">
													<h2><?php echo $this->lang->line('inventory_settings'); ?></h2>
													<p><?php echo $this->lang->line('step4_notes'); ?></p>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label><?php echo $this->lang->line('inventory_management_technique'); ?></label>
														<select class="form-control form-control-sm" name="nw_inventoryTechnique" id="nw_inventoryTechnique" required require>
															<option value=""><?php echo $this->lang->line('select'); ?></option>
															<?php foreach($inventoryTecgniques as $invTechnique) { ?>
																<option value="<?php echo $invTechnique->id; ?>" <?php if($invTechnique->status==0) echo "DISABLED"; ?>  ><?php echo $invTechnique->name; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="input-text">
													<div class="input-div">
														<label><?php echo $this->lang->line('pick_pack_method'); ?></label>
														<select class="form-control form-control-sm" name="nw_pickPackMethod" id="nw_pickPackMethod" required require>
															<option value=""><?php echo $this->lang->line('select'); ?></option>
																	<?php foreach($pickingMethods as $pickMethod) { ?>
																	<option value="<?php echo $pickMethod->id; ?>" <?php if($pickMethod->status==0) echo "DISABLED"; ?>  ><?php echo $pickMethod->name; ?></option>
																	<?php } ?>
														</select>
													</div>
												</div>
												<div class="buttons button_space">
													<button class="back_button"><span class="icon-arrow-left-circle"></span> <?php echo $this->lang->line('back'); ?></button>
													<button class="submit_button"><span class="icon-arrow-right-circle"></span> <?php echo $this->lang->line('submit'); ?></button>
												</div>
											</div>
											
											 <div class="main">
												 <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
													 <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
													<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
												</svg>
												 
												<div class="text congrats">
													<h2><?php echo $this->lang->line('congrats'); ?></h2>
													<p><?php echo $this->lang->line('warehouse_creation_success'); ?></p>
												</div>
												<div class="row buttons button_space justify-content-center col-6">
													<a href="#" class="btn btn-info "><span class="icon-arrow-right-circle"></span> <?php echo $this->lang->line('proceed_choose_warehouse'); ?></a>
												</div>
											</div>
											
										
										  

										

										</div>
									</div>
								</div>
							</div>
						</form>
					</div>		
				</div>
			</div>
				
	