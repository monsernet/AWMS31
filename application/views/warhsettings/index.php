			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('warehouse'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('settings'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<div class="list-group" id="myTab" role="tablist">
										<a class="list-group-item active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><h6><span class="icon-home"></span>  | <?php echo $this->lang->line('general_informations'); ?></h6></a>
										<a class="list-group-item" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false"><h6><span class="icon-cog"></span> | <?php echo $this->lang->line('warehouse_settings'); ?> </h6></a>
										<a class="list-group-item" id="storage-tab" data-toggle="tab" href="#storage" role="tab" aria-controls="storage" aria-selected="false"><h6><span class="icon-archive1"></span> | <?php echo $this->lang->line('storage_settings'); ?> </h6></a>
										<a class="list-group-item" id="inventory-tab" data-toggle="tab" href="#inventory" role="tab" aria-controls="inventory" aria-selected="false"><h6><span class="icon-grid"></span> | <?php echo $this->lang->line('inventory_settings'); ?> </h6></a>
										<a class="list-group-item" id="eoq-tab" data-toggle="tab" href="#eoq" role="tab" aria-controls="eoq" aria-selected="false"><h6><span class="icon-file"></span> | <?php echo $this->lang->line('eoq'); ?> </h6></a>
										
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<div class="tab-content border border-gray" id="myTabContent">
									<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										<div class="row">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<label for="warehouseName"><?php echo $this->lang->line('warehouse_name'); ?></label>
													<input type="text" class="form-control form-control-sm" name="warehouseName" id="warehouseName" value="<?php echo $warehouse->warehouseName;?>" placeholder="<?php echo $this->lang->line('warehouse_name'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="warehouseAddress"><?php echo $this->lang->line('address'); ?></label>
													<textarea class="form-control form-control-sm" name="warehouseAddress" id="warehouseAddress"  placeholder="<?php echo $this->lang->line('address'); ?>" REQUIRED><?php echo $warehouse->address;?></textarea>
												</div>
											</div>
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
												<div class="form-group">
													<label for="warehouseCity"><?php echo $this->lang->line('city'); ?></label>
													<input type="text" class="form-control form-control-sm" name="warehouseCity" id="warehouseCity" value="<?php echo $warehouse->city;?>" placeholder="<?php echo $this->lang->line('city'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
												<div class="form-group">
													<label for="warehouseCountry"><?php echo $this->lang->line('country'); ?></label>
													<input type="text" class="form-control form-control-sm" name="warehouseCountry" id="warehouseCountry" value="<?php echo $warehouse->country;?>" placeholder="<?php echo $this->lang->line('country'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="warehouseManager"><?php echo $this->lang->line('warehouse_manager'); ?></label>
													<input type="text" class="form-control form-control-sm" name="warehouseManager" id="warehouseManager" value="<?php echo $warehouse->manager;?>" placeholder="<?php echo $this->lang->line('warehouse_manager'); ?>" >
												</div>
											</div>
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
												<div class="form-group">
													<label for="warehousePhone"><?php echo $this->lang->line('phone'); ?></label>
													<input type="text" class="form-control form-control-sm" name="warehousePhone" id="warehousePhone" value="<?php echo $warehouse->contact;?>" placeholder="<?php echo $this->lang->line('phone'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
												<div class="form-group">
													<label for="warehouseMobile"><?php echo $this->lang->line('mobile'); ?></label>
													<input type="text" class="form-control form-control-sm" name="warehouseMobile" id="warehouseMobile" value="<?php echo $warehouse->mobile;?>" placeholder="<?php echo $this->lang->line('mobile'); ?>" REQUIRED>
												</div>
											</div>
											
										</div>
										<div class="row justify-content-center col-12">
											<button type="button" name="updateWarehouseInfos" id="updateWarehouseInfos" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_warehouse_info'); ?></button>
											
										</div>
										<div class="row justify-content-center col-12">
											<div class="text-center" id="warehouseUpdateResult"></div>
										</div>
										
									</div>
									<div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
											
											<div class="card">
												<div class="card-body">
													<!-- #### - 1 -  WAREHOUSE DIMENSIONS -->
													
													<div class="row mb-3">
														<div class="col-xl-4 col-lg col-md-4 col-sm-4 col-12">
															<!-- WAREHOUSE LENGTH -->
															<div class="form-group">
																<label><?php echo $this->lang->line('warehouse_length'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" min="0" step="0.01" name="warehouseLength" id="warehouseLength" value="<?php echo $warhDim->warhLength;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('length'); ?>" REQUIRED>
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('m'); ?></div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-xl-4 col-lg col-md-4 col-sm-4 col-12">
															<!-- WAREHOUSE WIDTH -->
															<div class="form-group">
																<label><?php echo $this->lang->line('warehouse_width'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" min="0" step="0.01" name="warehouseWidth" id="warehouseWidth" value="<?php echo $warhDim->warhWidth;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('width'); ?>" REQUIRED>
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('m'); ?></div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-xl-4 col-lg col-md-4 col-sm-4 col-12">
															<!-- WAREHOUSE HEIGTH -->
															<div class="form-group">
																<label><?php echo $this->lang->line('warehouse_height'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" min="0" step="0.01" name="warehouseHeigth" id="warehouseHeigth" value="<?php echo $warhDim->warhHeigth;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('heigth'); ?>" REQUIRED>
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('m'); ?></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!-- #### - 2 -  STORAGE DIMENSIONS -->
													<label><h6><?php echo $this->lang->line('storage_dimensions'); ?></h6></label>
													<div class="row mb-3">
														<div class="col-xl-4 col-lg col-md-4 col-sm-4 col-12">
															<!-- STORAGE ZONE LENGTH -->
															<div class="form-group">
																<label><?php echo $this->lang->line('storage_zone_length'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" min="0" step="0.01" name="storageLength" id="storageLength" value="<?php echo $storage->StorageLength;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('length'); ?>" REQUIRED>
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('m'); ?></div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-xl-4 col-lg col-md-4 col-sm-4 col-12">
															<!-- STORAGE ZONE WIDTH -->
															<div class="form-group">
																<label><?php echo $this->lang->line('storage_zone_width'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" min="0" step="0.01" name="storageWidth" id="storageWidth" value="<?php echo $storage->StorageWidth;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('width'); ?>" REQUIRED>
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('m'); ?></div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-xl-4 col-lg col-md-4 col-sm-4 col-12">
															<!-- STORAGE ZONE HEIGHT -->
															<div class="form-group">
																<label><?php echo $this->lang->line('storage_zone_height'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" min="0" step="0.01" name="storageHeigth" id="storageHeigth" value="<?php echo $storage->StorageHeight;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('heigth'); ?>" REQUIRED>
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('m'); ?></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!-- #### - 3 -  WAREHOUSE FREE ZONE -->
													<label><h6><?php echo $this->lang->line('free_space'); ?></h6></label>
													<div class="row mb-3">
														<div class="col-xl-4 col-lg col-md-4 col-sm-4 col-12">
															<!-- OFFICE -->
															<div class="form-group">
																<label><?php echo $this->lang->line('office_area'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" min="0" step="0.01" name="officeSpace" id="officeSpace" value="<?php echo $warhDim->office;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('office'); ?>" REQUIRED>
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('cubic_meter'); ?></div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-xl-4 col-lg col-md-4 col-sm-4 col-12">
															<!-- RESTROOM -->
															<div class="form-group">
																<label><?php echo $this->lang->line('restroom_area'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" min="0" step="0.01" name="restroomSpace" id="restroomSpace" value="<?php echo $warhDim->restroom;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('restroom'); ?>" REQUIRED>
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('cubic_meter'); ?></div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-xl-4 col-lg col-md-4 col-sm-4 col-12">
															<!-- OTHER SPACE -->
															<div class="form-group">
																<label><?php echo $this->lang->line('other_reserved_area'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" min="0" step="0.01" name="otherSpace" id="otherSpace" value="<?php echo $warhDim->otherFreeSpace;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('other_space'); ?>" REQUIRED>
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('cubic_meter'); ?></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<hr width="100%" class="text-center">
													<!-- #### - 3 -  STOCK TYPE & STORAGE COST -->
													
													<div class="row mb-3">
														<div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
															<!-- STOCK TYPE -->
															<div class="form-group">
																<label><h6><?php echo $this->lang->line('stock_type'); ?></h6></label>
																<select class="form-control select2" name="stockType" id="stockType" REQUIRED>
																	<option value=""><?php echo $this->lang->line('select'); ?></option>
																	<option value="1" selected ><?php echo $this->lang->line('finished_products'); ?></option>
																	<option value="2" disabled><?php echo $this->lang->line('raw_material'); ?></option>
																	<option value="3" disabled><?php echo $this->lang->line('semi_finished_products'); ?></option>
																</select>
															</div>
														</div>
														<div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
															<!-- STORAGE COST RATE -->
															<label><h6><?php echo $this->lang->line('storage_cost_rate'); ?></h6></label>
															<div class="input-group input-group-sm mb-2 mr-sm-2">
																<input type="number" min="0" step="0.01" name="storageCostRate" id="storageCostRate" value="<?php echo $warhDim->storage_cost_rate;?>" placeholder="<?php echo $this->lang->line('storage_cost_rate_placeholder'); ?>" class="form-control form-control-sm"  REQUIRED>
																<div class="input-group-prepend">
																	<div class="input-group-text">%</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row justify-content-center col-12">
														<button type="button" name="updateWarehouseSettings" id="updateWarehouseSettings" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_warehouse_settings'); ?></button>
													</div>
													<div class="row justify-content-center col-12">
														<div class="text-center" id="warehSettingsUpdateResult"></div>
													</div>
												</div>
											</div>
									</div>
									<!-- STORAGE SETTINGS -->
									<div class="tab-pane fade show" id="storage" role="tabpanel" aria-labelledby="storage-tab">
										<!--    RACKING SYSTEM -->
											<div class="card">
												<div class="card-header card-title m-0"><h6><?php echo $this->lang->line('storage_racking'); ?></h6></div>
												<div class="card-body">
													<div class="row">
														<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
															<label ><?php echo $this->lang->line('rack_height'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('rack_height'); ?>" data-content="<?php echo $this->lang->line('rack_height_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
															<div class="input-group input-group-sm mb-2 mr-sm-2">
																<input type="number" min="0" step="0.01" name="rackHeight" id="rackHeight" value="<?php echo $storageRacking->rackHeight; ?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('rack_height'); ?>" REQUIRED>
																<div class="input-group-prepend">
																	<div class="input-group-text"><?php echo $this->lang->line('m'); ?></div>
																</div>
															</div>
														</div>
														<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
															<label ><?php echo $this->lang->line('rack_length'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('rack_length'); ?>" data-content="<?php echo $this->lang->line('rack_length_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
															<div class="input-group input-group-sm mb-2 mr-sm-2">
																<input type="number" min="0" step="0.01" name="rackLength" id="rackLength" value="<?php echo $storageRacking->rackLength; ?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('rack_length'); ?>" REQUIRED>
																<div class="input-group-prepend">
																	<div class="input-group-text"><?php echo $this->lang->line('m'); ?></div>
																</div>
															</div>
														</div>
														<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
															<label ><?php echo $this->lang->line('rack_width'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('rack_width'); ?>" data-content="<?php echo $this->lang->line('rack_width_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
															<div class="input-group input-group-sm mb-2 mr-sm-2">
																<input type="number" min="0" step="0.01" name="rackWidth" id="rackWidth" value="<?php echo $storageRacking->rackWidth; ?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('rack_width'); ?>" REQUIRED>
																<div class="input-group-prepend">
																	<div class="input-group-text"><?php echo $this->lang->line('m'); ?></div>
																</div>
															</div>
														</div>
														<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
															<label ><?php echo $this->lang->line('shelf_height'); ?></label>
															<div class="input-group input-group-sm mb-2 mr-sm-2">
																<input type="number" min="0" step="0.01" name="shelfHeight" id="shelfHeight" value="<?php echo $storageRacking->shelfHeight; ?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('shelf_height'); ?>" REQUIRED>
																<div class="input-group-prepend">
																	<div class="input-group-text"><?php echo $this->lang->line('m'); ?></div>
																</div>
															</div>
														</div>
														<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
															<label ><?php echo $this->lang->line('asile_width'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('asile_width'); ?>" data-content="<?php echo $this->lang->line('asile_width_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
															<div class="input-group input-group-sm mb-2 mr-sm-2">
																<input type="number" min="0" step="0.01" name="aisleWidth" id="aisleWidth" value="<?php echo $storageRacking->aisle; ?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('aisle_width'); ?>" REQUIRED>
																<div class="input-group-prepend">
																	<div class="input-group-text"><?php echo $this->lang->line('m'); ?></div>
																</div>
															</div>
														</div>
														
													</div>
													<div class="row">
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
															<div class="form-group">
																<label ><?php echo $this->lang->line('warehouse_racking_system'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('warehouse_racking_system'); ?>" data-content="<?php echo $this->lang->line('warehouse_racking_system_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
																<select class="form-control select2" name="rackingSystem" id="rackingSystem" REQUIRED>
																	<option value=""><?php echo $this->lang->line('select'); ?></option>
																	<option value="1" selected><?php echo $this->lang->line('selective_racking_system'); ?></option>
																</select>
															</div>
														</div>
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
															<div class="form-group">
																<label ><?php echo $this->lang->line('inventory_system'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('inventory_system'); ?>" data-content="<?php echo $this->lang->line('inventory_system_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
																<select class="form-control select2" name="inventorySystem" id="inventorySystem" REQUIRED>
																	<option value=""><?php echo $this->lang->line('select'); ?></option>
																	<?php foreach($inventorySystems as $invSystem) { ?>
																	<option value="<?php echo $invSystem->id; ?>"  <?php if($storageRacking->inventorySystem==$invSystem->id) echo "SELECTED"; ?>><?php echo $invSystem->shortName; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
															<div class="form-group">
																<label ><?php echo $this->lang->line('storage_system'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('storage_system'); ?>" data-content="<?php echo $this->lang->line('storage_system_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
																<select class="form-control select2" name="storageSystem" id="storageSystem" REQUIRED>
																	<option value=""><?php echo $this->lang->line('select'); ?></option>
																	<?php foreach($storageSystems as $storSystem) { ?>
																	<option value="<?php echo $storSystem->id; ?>"  <?php if($storageRacking->storageSystem==$storSystem->id) echo "SELECTED"; ?>><?php echo $storSystem->systemName; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														
													</div>
													<div class="row justify-content-center col-12">
														<button type="button" name="updateStorageSettings" id="updateStorageSettings" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_storage_settings'); ?></button>
													</div>
													<div class="row justify-content-center col-12">
														<div class="text-center" id="storageSettingsUpdateResult"></div>
													</div>
													
												</div>
											</div>
									</div>
									<!-- INVENTORY SETTINGS -->
									<div class="tab-pane fade show" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
											<div class="card">
												<div class="card-header card-title m-0"><h6><?php echo $this->lang->line('inventory_settings'); ?></h6></div>
												<div class="card-body">
													<div class="row">
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
															<div class="form-group">
																<label ><?php echo $this->lang->line('inventory_management_technique'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('inventory_management_technique'); ?>" data-content="<?php echo $this->lang->line('inventory_management_technique_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
																<select class="form-control select2" name="inventoryTechnique" id="inventoryTechnique" REQUIRED>
																	<option value=""><?php echo $this->lang->line('select'); ?></option>
																	<?php foreach($inventoryTecgniques as $invTechnique) { ?>
																	<option value="<?php echo $invTechnique->id; ?>" <?php if($invTechnique->status==0) echo "DISABLED"; ?>  <?php if($inventorySettings->inventory_technique==$invTechnique->id) echo "SELECTED"; ?>><?php echo $invTechnique->name; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
															<div class="form-group">
																<label ><?php echo $this->lang->line('pick_pack_method'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('pick_pack_method'); ?>" data-content="<?php echo $this->lang->line('pick_pack_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
																<select class="form-control select2" name="pickPackMethod" id="pickPackMethod" REQUIRED>
																	<option value=""><?php echo $this->lang->line('select'); ?></option>
																	<?php foreach($pickingMethods as $pickMethod) { ?>
																	<option value="<?php echo $pickMethod->id; ?>" <?php if($pickMethod->status==0) echo "DISABLED"; ?>  <?php if($inventorySettings->pickpack_method==$pickMethod->id) echo "SELECTED"; ?>><?php echo $pickMethod->name; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														
													</div>
													
												</div>
											</div>
											<div class="card">
												<div class="card-header card-title m-0"><h6><?php echo $this->lang->line('aisle_labelling'); ?></h6>
												
												</div>
												<div class="card-body">
													<div class="row">
														<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
																<i class="fa fa-question-circle text-warning"></i> 
																<?php echo $this->lang->line('aisle_labelling_help1'); ?><br/>
																<b><?php echo $this->lang->line('example'); ?>: BC0302</b><BR/>
																<b>B</b>: <?php echo $this->lang->line('aisle'); ?># B<br/>
																<b>C</b>: <?php echo $this->lang->line('bay'); ?># C<br/>
																<b>3</b>: <?php echo $this->lang->line('shelf'); ?># 03<br/>
																<b>2</b>: <?php echo $this->lang->line('bin'); ?># 02<br/>
														</div>
														<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
															<a href="<?php echo base_url('assets/img/label.png');?>" class="effects">
																<img src="<?php echo base_url('assets/img/label.png');?>" class="img-fluid" alt="<?php echo $this->lang->line('aisle_labelling'); ?>">
																<div class="overlay text-center">
																	<span class="expand"><?php echo $this->lang->line('click_to_enlarge'); ?></span>
																</div>
															</a>
														</div>
														<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
															<div class="form-group">
																<label ><?php echo $this->lang->line('aisle_labelling_format'); ?></label>
																<select class="form-control select2" name="aisleLabellingFormat" id="aisleLabellingFormat" REQUIRED>
																	<option value=""><?php echo $this->lang->line('select'); ?></option>
																	<option value="1" <?php if($inventorySettings->aisle_label_format==1) echo "SELECTED"; ?>><?php echo $this->lang->line('one_letter'); ?> ( A-Z )</option>
																	<option value="2" <?php if($inventorySettings->aisle_label_format==2) echo "SELECTED"; ?>><?php echo $this->lang->line('two_letters'); ?> ( AA-ZZ )</option>
																	<option value="3" <?php if($inventorySettings->aisle_label_format==3) echo "SELECTED"; ?>><?php echo $this->lang->line('one_number'); ?> ( 1-9 )</option>
																	<option value="4" <?php if($inventorySettings->aisle_label_format==4) echo "SELECTED"; ?>><?php echo $this->lang->line('two_numbers'); ?> ( 01-99 )</option>
																</select>
															</div>
														</div>
														<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
															<div class="form-group">
																<label ><?php echo $this->lang->line('bay_labelling_format'); ?></label>
																<select class="form-control select2" name="bayLabellingFormat" id="bayLabellingFormat" REQUIRED>
																	<option value=""><?php echo $this->lang->line('select'); ?></option>
																	<option value="1" <?php if($inventorySettings->bay_label_format==1) echo "SELECTED"; ?>><?php echo $this->lang->line('one_letter'); ?> ( A-Z )</option>
																	<option value="2" <?php if($inventorySettings->bay_label_format==2) echo "SELECTED"; ?>><?php echo $this->lang->line('two_letters'); ?> ( AA-ZZ )</option>
																	<option value="3" <?php if($inventorySettings->bay_label_format==3) echo "SELECTED"; ?>><?php echo $this->lang->line('one_number'); ?> ( 1-9 )</option>
																	<option value="4" <?php if($inventorySettings->bay_label_format==4) echo "SELECTED"; ?>><?php echo $this->lang->line('two_numbers'); ?> ( 01-99 )</option>
																</select>
															</div>
														</div>
														<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
															<div class="form-group">
																<label ><?php echo $this->lang->line('shelf_labelling_format'); ?></label>
																<select class="form-control select2" name="shelfLabellingFormat" id="shelfLabellingFormat" REQUIRED>
																	<option value=""><?php echo $this->lang->line('select'); ?></option>
																	<option value="1" <?php if($inventorySettings->shelf_label_format==1) echo "SELECTED"; ?> ><?php echo $this->lang->line('one_number'); ?> ( 1-9 )</option>
																	<option value="2" <?php if($inventorySettings->shelf_label_format==2) echo "SELECTED"; ?>><?php echo $this->lang->line('two_numbers'); ?> ( 01-99 )</option>
																</select>
															</div>
														</div>
														<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
															<div class="form-group">
																<label ><?php echo $this->lang->line('bin_labelling_format'); ?></label>
																<select class="form-control select2" name="binLabellingFormat" id="binLabellingFormat" REQUIRED>
																	<option value=""><?php echo $this->lang->line('select'); ?></option>
																	<option value="1" <?php if($inventorySettings->bin_label_format==1) echo "SELECTED"; ?> ><?php echo $this->lang->line('one_number'); ?> ( 1-9 )</option>
																	<option value="2" <?php if($inventorySettings->bin_label_format==2) echo "SELECTED"; ?>><?php echo $this->lang->line('two_numbers'); ?> ( 01-99 )</option>
																</select>
															</div>
														</div>
														
													</div>
													
												</div>
											</div>
											<div class="card">
												<div class="card-body">
													<div class="row justify-content-center col-12">
														<button type="button" name="updateInventorySettings" id="updateInventorySettings" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_inventory_settings'); ?></button>
													</div>
													<div class="row justify-content-center col-12">
														<div class="text-center" id="inventorySettingsUpdateResult"></div>
													</div>
												</div>
											</div>
									</div>
									
									<!-- ECONOMIC ORDER QUANTITY -->
									
									<div class="tab-pane fade show" id="eoq" role="tabpanel" aria-labelledby="eoq-tab">
											<div class="card">
												<div class="card-header card-title m-0"><h6><?php echo $this->lang->line('economic_order_qty'); ?></h6></div>
												<div class="card-body">
													<div class="row">
														<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
															<label ><?php echo $this->lang->line('holding_cost'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('holding_cost'); ?>" data-content="<?php echo $this->lang->line('holding_cost_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
															<div class="input-group input-group-sm mb-2 mr-sm-2">
																<input type="number" min="0" step="0.01" name="eoqStorageCosts" id="eoqStorageCosts" value="<?php echo $eoqSettings->holdingCost; ?>" class="form-control form-control-sm" placeholder="" REQUIRED>
																<div class="input-group-prepend">
																	<div class="input-group-text"><?php echo $this->global_model->defaultCurrency($this->session->userdata('warehouseid')); ?></div>
																</div>
															</div>
														</div>
														
														<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
															<label ><?php echo $this->lang->line('ordering_cost'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" data-html="true" title="<?php echo $this->lang->line('ordering_cost'); ?>" data-content="<?php echo $this->lang->line('ordering_cost_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
															<div class="input-group input-group-sm mb-2 mr-sm-2">
																<input type="number" min="0" step="0.01" name="orderingCosts" id="orderingCosts" value="<?php echo $eoqSettings->orderingCost; ?>" class="form-control form-control-sm" placeholder="" REQUIRED>
																<div class="input-group-prepend">
																	<div class="input-group-text"><?php echo $this->global_model->defaultCurrency($this->session->userdata('warehouseid')); ?></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-body">
													<div class="row justify-content-center col-12">
														<button type="button" name="updateEOQSettings" id="updateEOQSettings" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_eoq_settings'); ?></button>
													</div>
													<div class="row justify-content-center col-12">
														<div class="text-center" id="eoqSettingsUpdateResult"></div>
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
				
	