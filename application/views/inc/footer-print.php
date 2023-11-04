				
				</div>
			</div>
		</div>
	</div>	
		<!-- Load list of VARIABLES to be used in ajax calls -->
		<script> 
			/* Variables used in ajax calls */
			var base_url = '<?php echo base_url() ?>';
			var ALERT_CODE_NOT_FILLED = "<?php echo $this->lang->line('code_not_filled');?>";
			var ALERT_NAME_NOT_FILLED = "<?php echo $this->lang->line('name_not_filled');?>";
			var ALERT_CAT_ADDED_SUCCESS= "<?php echo $this->lang->line('category_added_success');?>";
			var SELECT_OPTION= "<?php echo $this->lang->line('select');?>";
			var ALERT_FIELD_EMPTY= "<?php echo $this->lang->line('field_empty');?>";
			var ALERT_SUPPLIER_ADDED_SUCCESS= "<?php echo $this->lang->line('supplier_added_success');?>";
			var ALERT_UNIT_ADDED_SUCCESS= "<?php echo $this->lang->line('unit_added_success');?>";
			var ALERT_REMOVE_ROW = "<?php echo $this->lang->line('alert_confirm_action');?>";
			var WAREHOUSE_SPACE_LABEL = "<?php echo $this->lang->line('warehouse_space');?>";
			var STORAGE_AREA_LABEL = "<?php echo $this->lang->line('storage_area_size');?>";
			var SPACE_UTILIZATION_LABEL = "<?php echo $this->lang->line('space_utilization');?>";
			var TOTAL_WAREHOUSE_AREA = "<?php echo $this->warehouse_model->warehouse_total_area($this->session->userdata('warehouseid'));?>";
			var STORAGE_AREA = "<?php echo $this->warehouse_model->storage_area($this->session->userdata('warehouseid')); ?>";
			var TOTAL_INVENTORY_VOLUME = "<?php echo $this->product_model->totalInventoryVolume($this->session->userdata('warehouseid')); ?>";
			var MAX_SHELF_VOLUME = "<?php echo $this->storage_model->max_shelf_volume($this->session->userdata('warehouseid')); ?>";
			var ERROR_BARCODE = "<?php echo $this->lang->line('barcode_selected_not_found'); ?>";
			var ALERT_VOLUME_EMPTY = "<?php echo $this->lang->line('alert_volume_not_filled');?>";
			var ALERT_SHELVES_EMPTY = "<?php echo $this->lang->line('alert_shelves_not_filled');?>";
			var SHELF = "<?php echo $this->lang->line('shelf');?>";
			var ALERT_SHELF_FULL_1 = "<?php echo $this->lang->line('alert_shelf_full_1');?>";
			var ALERT_SHELF_FULL_2 = "<?php echo $this->lang->line('alert_shelf_full_2');?>";
			var ALERT_EMPTY_PHYS_QTY = "<?php echo $this->lang->line('alert_phys_qty_empty');?>";
			var ALERT_ADJUST_INVENTORY = "<?php echo $this->lang->line('alert_adjust_inventory');?>";
			var ADJUST_INVENTORY = "<?php echo $this->lang->line('adjust_inventory');?>";
			var ADJUST_INVENTORY_SUCCESS = "<?php echo $this->lang->line('adjust_inventory_success');?>";
			var ADJUST_INVENTORY_FAILURE = "<?php echo $this->lang->line('adjust_inventory_failure');?>";
			var IMPORTANT_NOTE = "<?php echo $this->lang->line('very_important');?>";
			var CHECK_REAL_STORAGE_POS = "<?php echo $this->lang->line('check_real_storage_positions');?>";
			var CHECK_REAL_STORAGE_STEPS = "<?php echo $this->lang->line('check_real_storage_steps');?>";
			var ALERT_ITEM_EXIST = "<?php echo $this->lang->line('selected_product_already_exists');?>";
			var ALERT_NOT_ENOUGH_STOCK = "<?php echo $this->lang->line('not_enough_stock');?>";
			var ALERT_PICKED_VOLUME_OVER = "<?php echo $this->lang->line('alert_picked_volume_over');?>";
			var ALERT_PICKED_VOLUME_OVER_2 = "<?php echo $this->lang->line('alert_picked_volume_over_2');?>";
			var ALERT_PICKED_VOLUME_LESS = "<?php echo $this->lang->line('alert_picked_volume_less');?>";
			var ALERT_MISSING_ITEMS_TRANSFER_PICKUP = "<?php echo $this->lang->line('alert_missing_items_transfer_pickup');?>";
			var ALERT_PRODUCT_PICKEDUP_SUCCESS = "<?php echo $this->lang->line('product_pickedup_success');?>";
			var ALERT_SUPPLIER_HAS_NO_PRODUCTS = "<?php echo $this->lang->line('supplier_has_no_products');?>";
			var ALERT_PRODUCT_ADDED_SUCCESS = "<?php echo $this->lang->line('product_added_success');?>";
			var NEW_LPO_SUPPLIER_NOT_SELECTED = "<?php echo $this->lang->line('new_lpo_supplier_not_selected');?>";
			var PACKING_STATUS = "<?php echo $this->lang->line('packaging_status');?>";
			var ALERT_PRODUCT_PACKED_SUCCESS = "<?php echo $this->lang->line('product_packed_success');?>";
			var ALERT_PRODUCT_PACKED_FAILURE = "<?php echo $this->lang->line('product_packed_failure');?>";
			
		</script>
		<script src="<?php echo base_url();?>assets/js/phpvariables.js"></script>
		
		<!-- JQUERY & BOOTSTRAP -->
		<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/moment.js"></script>
		<!-- JQUERY REDIRECT -->
		<script src="<?php echo base_url();?>assets/js/jquery.redirect.js"></script>
		<!-- Slimscroll JS -->
		<script src="<?php echo base_url();?>assets/plugins/slimscroll/slimscroll.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/slimscroll/custom-scrollbar.js"></script>
		<!-- Data Tables -->
		<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- Download / CSV / Copy / Print -->
		<script src="<?php echo base_url();?>assets/plugins/datatables/buttons.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/datatables/jszip.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/datatables/pdfmake.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/datatables/vfs_fonts.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/datatables/html5.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/datatables/buttons.print.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/datatables/custom/custom-datatables.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/datatables/custom/fixedHeader.js"></script>
		<!-- Select2 -->
		<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
		<!-- ChartJS -->
		<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
		<!-- Sweet Alert -->
		<script src="<?php echo base_url();?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>


		<!-- Main JS -->
		<script src="<?php echo base_url();?>assets/js/scripts.js"></script>

	</body>
</html>