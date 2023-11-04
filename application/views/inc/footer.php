				<!-- Main Footer -->
				<div  class="card bg-light footer-div small">
					<div class="card-body">
						<div class="pull-left">
							<strong><?php echo $this->lang->line('copyrights');?> &copy; <?php echo date('Y');?> <a href="#"><?php echo $applicationRow->long_name; ?></a></strong>.    <?php echo $this->lang->line('all_rights_reserved');?>.
						</div>
						<div class="pull-right">
							<b><?php echo $applicationRow->short_name; ?>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>	
		<!-- Load list of VARIABLES to be used in ajax calls -->
		<script> 
			/* Variables used in ajax calls */
			var base_url = '<?php echo base_url() ?>';
			var DT_DISPLAY = '<?php echo $this->lang->line('dt_display');?>';
			var DT_SHOWING = '<?php echo $this->lang->line('dt_showing_page');?>';
			var DT_OF = '<?php echo $this->lang->line('dt_of');?>';
			var DT_RECORDS = '<?php echo $this->lang->line('dt_records_per_page');?>';
			var DT_PREVIOUS = '<?php echo $this->lang->line('dt_previous');?>';
			var DT_NEXT = '<?php echo $this->lang->line('dt_next');?>';
			var DT_COPY_ROWS = '<?php echo $this->lang->line('dt_copy_rows');?>';
			var DT_EXPORT_EXCEL = '<?php echo $this->lang->line('dt_export_excel');?>';
			var DT_EXPORT_CSV = '<?php echo $this->lang->line('dt_export_csv');?>';
			var DT_EXPORT_PDF = '<?php echo $this->lang->line('dt_export_pdf');?>';
			var DT_PRINT = '<?php echo $this->lang->line('dt_print');?>';
			var DT_ROWS_SELECTED = '<?php echo $this->lang->line('dt_rows_selected');?>';
			var DT_SEARCH = '<?php echo $this->lang->line('dt_search');?>';
			var DT_NO_DATA_AVAILABLE = '<?php echo $this->lang->line('dt_no_data_available');?>';
			var DT_TO = '<?php echo $this->lang->line('dt_to');?>';
			var DT_ENTRIES = '<?php echo $this->lang->line('dt_entries');?>';
			var DT_SHOWING_ENT = '<?php echo $this->lang->line('dt_showing');?>';
			
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
			var ALERT_PICKED_VOLUME_OVER_3 = "<?php echo $this->lang->line('alert_picked_volume_over_3');?>";
			var ALERT_PICKED_VOLUME_OVER_4 = "<?php echo $this->lang->line('alert_picked_volume_over_4');?>";
			var ALERT_PICKED_VOLUME_LESS = "<?php echo $this->lang->line('alert_picked_volume_less');?>";
			var ALERT_MISSING_ITEMS_TRANSFER_PICKUP = "<?php echo $this->lang->line('alert_missing_items_transfer_pickup');?>";
			var ALERT_PRODUCT_PICKEDUP_SUCCESS = "<?php echo $this->lang->line('product_pickedup_success');?>";
			var ALERT_SUPPLIER_HAS_NO_PRODUCTS = "<?php echo $this->lang->line('supplier_has_no_products');?>";
			var ALERT_PRODUCT_ADDED_SUCCESS = "<?php echo $this->lang->line('product_added_success');?>";
			var ALERT_PRODUCT_ADDED_FAILURE = "<?php echo $this->lang->line('product_added_failure');?>";
			var NEW_LPO_SUPPLIER_NOT_SELECTED = "<?php echo $this->lang->line('new_lpo_supplier_not_selected');?>";
			var PACKING_STATUS = "<?php echo $this->lang->line('packaging_status');?>";
			var ALERT_PRODUCT_PACKED_SUCCESS = "<?php echo $this->lang->line('product_packed_success');?>";
			var ALERT_PRODUCT_PACKED_FAILURE = "<?php echo $this->lang->line('product_packed_failure');?>";
			var ALERT_UPDATE_FAIL = "<?php echo $this->lang->line('alert_update_fail');?>";
			var ALERT_SMTP_SETTINGS = "<?php echo $this->lang->line('alert_smtp_settings');?>";
			var ALERT_PASSWORD_RETYPE = "<?php echo $this->lang->line('alert_password_retype');?>";
			var MSG_INITIALISING_DEMO = "<?php echo $this->lang->line('intializing');?>";
			var MSG_OLD_DATA_CLEARED = "<?php echo $this->lang->line('old_data_cleared');?>";
			var MSG_COPY_DEMO_DATA = "<?php echo $this->lang->line('copy_demo_data');?>";
			var MSG_DEMO_DATA_INSERTED = "<?php echo $this->lang->line('demo_data_inserted');?>";
			var MSG_DEMO_DATA_FINISH_INSERT = "<?php echo $this->lang->line('finish_inserting_demo_data');?>";
			var MSG_ERROR_COPYING_DEMO_DATA = "<?php echo $this->lang->line('error_copying_demo_data');?>";
			var MSG_ERROR_INSERTING_DEMO_DATA = "<?php echo $this->lang->line('error_inserting_demo_data');?>";
			var ALERT_CURRENCY_ADDED_SUCCESS= "<?php echo $this->lang->line('currency_added_success');?>";
			var ALERT_PHP_MAIL_ENABLED= "<?php echo $this->lang->line('alert_php_mail_enabled');?>";
			var ALERT_PHP_MAIL_DISABLED= "<?php echo $this->lang->line('alert_php_mail_disabled');?>";
			var ALERT_alert = "<?php echo $this->lang->line('alert_alert');?>";
			var ALERT_success = "<?php echo $this->lang->line('alert_success');?>";
			var ALERT_LOGO_EXT = "<?php echo $this->lang->line('alert_logo_extension');?>";
			var ALERT_FAVICON_EXT = "<?php echo $this->lang->line('alert_favicon_extension');?>";
			var ALERT_CAPTCHA_SECRET_KEY = "<?php echo $this->lang->line('alert_captcha_secret_key');?>";
			var ALERT_CAPTCHA_SITE_KEY = "<?php echo $this->lang->line('alert_captcha_site_key');?>";
			var ALERT_USER_TYPE_NAME_EMPTY = "<?php echo $this->lang->line('user_type_name_empty');?>";
			var ALERT_US_TYP_ADDED_SUCCESS= "<?php echo $this->lang->line('alert_user_type_added_success');?>";
			
		</script>
		
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
		<!-- Stepwizard JS -->
		<script src="<?php echo base_url();?>assets/js/stepwizard.js"></script>
		<!-- UPLOAD -->
		<script src="<?php echo base_url();?>assets/js/uploadfile.js"></script>

	</body>
</html>