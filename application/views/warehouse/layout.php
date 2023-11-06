			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('warehouse'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('warehouse_layout'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row ml-2">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
						<div class="card h-250">
							<div class="card-header">
								<div class="card-title"><?php echo $this->lang->line('warehouse_layout'); ?></div>
							</div>
							<div class="card-body scrolling-wrapper flex-row flex-nowrap">
								<!-- AISLE LAYOUT -->
								<table  width="100%" id="AsileLayoutTable" >
								<tr>
									<?php 
									$nbAsiles = intval($this->warehouse_model->nb_aisles ($this->session->userdata('warehouseid')));
									$nbRacksPerLine = intval($this->warehouse_model->nb_racks_per_line ($this->session->userdata('warehouseid')));
									$max_rack_volume = floatval($this->storage_model->max_rack_volume ($this->session->userdata('warehouseid')));
									// specify the asile line numbers
									$asileArr = array();
									for($i=1;$i<($nbAsiles*3);$i++) {
										array_push($asileArr, $i);
										$i+=2;
									}
									
									$c=0;
									echo '<th></th>';
									for($i=0;$i<($nbAsiles*3);$i++) {
										if (in_array(($i), $asileArr)){
											echo '<th></th>';
										} else {
											$c++;
											echo '<th class="small text-primary text-center">L'.$c.'</th>';
										}
									}
									
										?>
								</tr>
								
								<?php 
								
								
								for ($i=$nbRacksPerLine;$i>0;$i--) {
									echo '<tr>';
									// specify the asile row numbers
									echo '<td ><div class="asile text-center text-primary" >R'.$i.'</div></td>';
									$c=0;
									for($j=1;$j<=($nbAsiles*3);$j++) {
										// current rack volume -- Note : volume of all shelves in one rack
										$rack_volume = $this->storage_model->rack_volume ($i, $j);
										if($max_rack_volume>0) {
											// % of volume occupancy = current rack volume * 100 / maximum capacity of a rack
											$occupancy = $rack_volume*100/$max_rack_volume;
										} else {
											$occupancy = 0;
										}
										
										if (in_array(($j-1), $asileArr)){
											
											if($i==3 OR $i==9){
												echo '<td id="cell'.$i.'_'.$j.'"><div class="asile text-center text-danger" ><i class="fa fa-long-arrow-up" aria-hidden="true"></i></div></td>';
											} else {
												echo '<td id="cell'.$i.'_'.$j.'"><div class="asile" >&nbsp;</div></td>';
											}
											
										} else {
											
											$c++;
											if($rack_volume ===0) {
												echo '<td id="cell'.$i.'_'.$j.'"><div class="divRack border border-primary" tabindex="0"  role="button" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="bottom" title="'.$this->lang->line('rack_no').' W'.$this->session->userdata('warehouseid').'R'.$i.'L'.$c.'" data-content="'.$this->lang->line('warehouse_no').':  <b>'.$this->session->userdata('warehouseid').'</b><br>'.$this->lang->line('rack_raw').': <b>'.$i.'</b><br>'.$this->lang->line('rack_line').': <b>'.$c.'</b><br>'.$this->lang->line('rack_total_volume').': <b>'.number_format($max_rack_volume,2).' m<sup>3</sup></b><br>'.$this->lang->line('rack_occupied_volume').': <b>'.number_format($rack_volume,2).' m<sup>3</sup></b><br/>'.$this->lang->line('rack_occupancy_rate').': <b>'.number_format($occupancy,2).' %</b>" >&nbsp;</div></td>';
											} elseif ($rack_volume < ($max_rack_volume * 0.7)) {
												echo '<td id="cell'.$i.'_'.$j.'"><div class="divRack rack-notfull" tabindex="0"  role="button" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="bottom" title="'.$this->lang->line('rack_no').' W'.$this->session->userdata('warehouseid').'R'.$i.'L'.$c.'" data-content="'.$this->lang->line('warehouse_no').':  <b>'.$this->session->userdata('warehouseid').'</b><br>'.$this->lang->line('rack_raw').': <b>'.$i.'</b><br>'.$this->lang->line('rack_line').': <b>'.$c.'</b><br>'.$this->lang->line('rack_total_volume').': <b>'.number_format($max_rack_volume,2).' m<sup>3</sup></b><br>'.$this->lang->line('rack_occupied_volume').': <b>'.number_format($rack_volume,2).' m<sup>3</sup></b><br/>'.$this->lang->line('rack_occupancy_rate').': <b>'.number_format($occupancy,2).' %</b>" >&nbsp;</div></td>';
											} else {
												echo '<td id="cell'.$i.'_'.$j.'"><div class="divRack rack-full" tabindex="0"  role="button" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="bottom" title="'.$this->lang->line('rack_no').' W'.$this->session->userdata('warehouseid').'R'.$i.'L'.$c.'" data-content="'.$this->lang->line('warehouse_no').':  <b>'.$this->session->userdata('warehouseid').'</b><br>'.$this->lang->line('rack_raw').': <b>'.$i.'</b><br>'.$this->lang->line('rack_line').': <b>'.$c.'</b><br>'.$this->lang->line('rack_total_volume').': <b>'.number_format($max_rack_volume,2).' m<sup>3</sup></b><br>'.$this->lang->line('rack_occupied_volume').': <b>'.number_format($rack_volume,2).' m<sup>3</sup></b><br/>'.$this->lang->line('rack_occupancy_rate').' : <b>'.number_format($occupancy,2).' %</b>" >&nbsp;</div></td>';
											}
										}
									}
									echo '</tr>';
								}
								?>
								</table>
								
								<div id="tableAux">
									<table width="100%">
										<tr>
										<?php
											$aisle_no=0;
											echo '<td><div class="asile text-center text-danger" ><br/></div></td>';
											for($i=0;$i<($nbAsiles*3);$i++) {
												if($i==0 ) {
													echo '<td><div class="divRack text-center text-danger" ><br/><i class="fa fa-long-arrow-right" aria-hidden="true"></i></div></td>';
												} elseif (in_array(($i), $asileArr)){
													$aisle_no++;
													echo '<td class="text-center"><div class="asile text-info small" ><i class="fa fa-long-arrow-up text-danger" aria-hidden="true"></i><br/>'.$this->lang->line('ais').$aisle_no.'</div></td>';
												} else {
													echo '<td><div class="divRack" ><br/></div></td>';
												}
											}
										?>
										</tr>
									</table>
								</div>
								<div class="h-25 mt-3">
									<table>
										<tr>
											<td class="divRack border border-primary p-2"></td>
											<td><div class="ml-2 mr-5"><?php echo $this->lang->line('empty_rack'); ?></div></td>
											<td class="divRack rack-notfull p-2"></td>
											<td><div class="ml-2 mr-5"><?php echo $this->lang->line('rack_not_full'); ?></div></td>
											<td class="divRack rack-full p-2"></td>
											<td><div class="ml-2 mr-5"><?php echo $this->lang->line('rack_full'); ?></div></td>
											<td class=""><span class="text-info mr-2 ml-5"><?php echo $this->lang->line('ais'); ?></span>: <?php echo $this->lang->line('aisle'); ?></td>
											<td class=""><span class="text-info mr-2 ml-5">R </span>: <?php echo $this->lang->line('row'); ?></td>
											<td class=""><span class="text-info mr-2 ml-5">L </span>: <?php echo $this->lang->line('line'); ?></td>
										</tr>
									</table>
									
								</div>
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
				
	