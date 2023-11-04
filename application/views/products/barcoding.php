			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('products'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('product_barcoding'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row ml-3">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('products/barcoding');?>">
								<div class="row  mr-3">
									<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
										<div class="form-group">
											<label ><?php echo $this->lang->line('select_product');?>:</label>
											<select class="form-control select2" name="barcoding_items" id="barcoding_items" onchange="this.form.submit()" Required>
												<option value=""><?php echo $this->lang->line('select');?></option>
													<?php foreach($products as $product) { ?>
															<option value="<?php echo $product->product_id;?>" <?php if (isset($productRow) && $productRow->product_id==$product->product_id) echo "SELECTED"; ?> ><?php echo $product->product_name.' ('.$product->product_barcode.')';?></option>
													<?php	}	?>
													
											</select>
										</div>
									</div>					
								</div>	
								</form>								
							</div>
						</div>
					</div>
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<div class="row  mr-3">
									<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6">
										<div class="form-group">
											<label ><?php echo $this->lang->line('barcode'); ?></label>
											<input type="text" class="form-control form-control-sm" name="barcoding_productBarcode" id="barcoding_productBarcode" value="<?php if(isset($productRow)) echo  $productRow->product_barcode; ?>" placeholder="<?php echo $this->lang->line('barcode'); ?>" REQUIRED>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
										<div class="form-group">
											<label ><?php echo $this->lang->line('name'); ?></label>
											<input type="text" class="form-control form-control-sm" name="barcoding_productName" id="barcoding_productName" value="<?php  if(isset($productRow)) echo  $productRow->product_name; ?>" placeholder="<?php echo $this->lang->line('name'); ?>" REQUIRED>
										</div>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
										<div class="form-group">
											<button class="btn btn-primary" onclick="printProductBarcodes()"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?> </button>
										</div>
									</div>
								</div>
								<div class="row  mr-3">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="productBarcodesView">
										<?php if (isset($productRow)) {
											//Barcode Type
											if($barcodingRow->barcode_type==1) { $barcode_type='code39';}
											else {$barcode_type='code128';}
											//Paper Size
											if($barcodingRow->paper_size==1) {
												if ($barcodingRow->paper_orientation==1) { $paper_length=210; $paper_width=297; }
												else { $paper_length=297; $paper_width=210;}
											}
											//Other settings
											$margin_top = $barcodingRow->margin_top;
											$mrgtop_percentage =floatval($margin_top)*100/floatval($paper_length);
											$margin_bottom = $barcodingRow->margin_bottom;
											$mrgbottom_percentage =floatval($margin_bottom)*100/floatval($paper_length);
											$margin_left = $barcodingRow->margin_left;
											$mrgleft_percentage =floatval($margin_left)*100/floatval($paper_width);
											$margin_right = $barcodingRow->margin_right;
											$mrgright_percentage =floatval($margin_right)*100/floatval($paper_width);
											$nbBarcodesPerRow = $barcodingRow->barcodes_row;
											$nbBarcodesPerCol = $barcodingRow->barcodes_col;
											$padding = $barcodingRow->barcode_padding;
											
											$barcodingHeight = $paper_width-$margin_top-$margin_bottom-(2*$nbBarcodesPerCol*$padding); 
											$barcode_height = $barcodingHeight* 3.779528/$nbBarcodesPerCol; // 1 mm =  3.779528 px
											$barcodeHeight_percentage =floatval($barcode_height)*100/floatval($paper_width);
											
											$barcodingWidth = $paper_length-$margin_left-$margin_right-(2*$nbBarcodesPerRow*$padding); 
											$barcode_width = $barcodingWidth* 3.779528/$nbBarcodesPerRow; // 1 mm =  3.779528 px
											$barcodeWidth_percentage =floatval($barcode_width)*100/floatval($paper_length);
											
											
											?>
										<table cellspacing="<?php echo ($padding* 3.779528);?>" width="100%">
											<tr height="<?php echo $mrgtop_percentage.'%';?>" colspan="<?php echo $nbBarcodesPerRow; ?>"></tr>
											<?php for ($i=0;$i<$nbBarcodesPerCol;$i++) { ?>
											<tr >
												<?php for ($j=0;$j<$nbBarcodesPerRow;$j++) { 
												echo '<td ><img width="'.($barcode_width+($padding*3.779528*2)).'px" height="'.($barcode_height+($padding*3.779528*2)).'px"  src="'.base_url().'assets/barcode/barcode.php?codetype='.$barcode_type.'&size='.$barcode_height.'&text='.$productRow->product_barcode.'&print=true"/></td>';
												}?>
											</tr>
											<?php } ?>
										</table>
										<?php } ?>
											
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	