//Select2
$(function () {
    $('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });

// Loading
$(function() {
	$("#loading-wrapper").fadeOut(3000);
});

// Tooltip
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})
// Popover
$(function () {
	$('[data-toggle="popover"]').popover()
})


  
  // to convert date to format yyyy-mm-dd
function convertDate(dateString){
	var p = dateString.split(/\D/g);
	return [p[2],p[1],p[0] ].join("-");
}


//General function to Load the Options of a given SELECT
function loadSelectOptions(selectId, tableId, valueField, nameFiled)
{    	
	$(selectId).empty().append('<option>'+SELECT_OPTION+'</option>');        
	$.ajax({
		url: base_url+'global_controller/loadSelect',
		dataType: 'json',
		type: 'POST',
		data: { tableName: tableId },
		success: function(response) {
			var options = '';
			for (var i = 0; i < response.length-1; i++) {
				options += '<option value="' + response[i][valueField] + '">' + response[i][nameFiled] + '</option>';
			}
			options += '<option value="' + response[(response.length)-1][valueField] + '" selected>' + response[(response.length)-1][nameFiled] + '</option>';
			$(selectId).html(options);
		},
		error: function(xhr, status, error){
			var errorMessage = xhr.status + ': ' + xhr.statusText
			alert('Error - ' + errorMessage);
		}
	});
		
}

//General function to Load the Options of a given SELECT -- with condition
function loadSelectOptionsWithCondition(selectId, tableId, valueField, nameFiled, condition)
{    	
	$(selectId).empty().append('<option>'+SELECT_OPTION+'</option>');        
	$.ajax({
		url: base_url+'global_controller/loadSelectWithCondition',
		dataType: 'json',
		type: 'POST',
		data: { 
				tableName: tableId,
				condition: condition
			},
		success: function(response) {
			var options = '';
			for (var i = 0; i < response.length-1; i++) {
				options += '<option value="' + response[i][valueField] + '">' + response[i][nameFiled] + '</option>';
			}
			options += '<option value="' + response[(response.length)-1][valueField] + '" selected>' + response[(response.length)-1][nameFiled] + '</option>';
			$(selectId).html(options);
		},
		error: function(xhr, status, error){
			var errorMessage = xhr.status + ': ' + xhr.statusText
			alert('Error - ' + errorMessage);
		}
	});
		
}
	

// Textarea characters left
$(function() {
	$('#characterLeft').text('140 characters left');
	$('#message').keydown(function () {
		var max = 140;
		var len = $(this).val().length;
		if (len >= max) {
			$('#characterLeft').text('You have reached the limit');
			$('#characterLeft').addClass('red');
			$('#btnSubmit').addClass('disabled');            
		} 
		else {
			var ch = max - len;
			$('#characterLeft').text(ch + ' characters left');
			$('#btnSubmit').removeClass('disabled');
			$('#characterLeft').removeClass('red');            
		}
	});
});



// Todo list
$('.todo-body').on('click', 'li.todo-list', function() {
	$(this).toggleClass('done');
});



// Tasks
(function($) {
	var checkList = $('.task-checkbox'),
	toDoCheck = checkList.children('input[type="checkbox"]');
	toDoCheck.each(function(index, element) {
		var $this = $(element),
		taskItem = $this.closest('.task-block');
		$this.on('click', function(e) {
			taskItem.toggleClass('task-checked');
		});
	});
})(jQuery);





// Tasks Important Active
$('.task-actions').on('click', '.important', function() {
	$(this).toggleClass('active');
});



// Tasks Important Active
$('.task-actions').on('click', '.star', function() {
	$(this).toggleClass('active');
});

// Warehouse Management Chart
// charts
  $(function () {
	const ctx = document.getElementById('barChart').getContext('2d');
	const myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: [WAREHOUSE_SPACE_LABEL, STORAGE_AREA_LABEL, SPACE_UTILIZATION_LABEL],
			datasets: [{
				label: '',
				data: [parseInt(TOTAL_WAREHOUSE_AREA), parseInt(STORAGE_AREA), parseInt(TOTAL_INVENTORY_VOLUME)],
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
  });
 


$(document).ready(function(){
	
   $('.productStoragePosTable').dataTable();
   $('select[data-select2-id]').on('select2:opening', function (e) {
    // Check if select tag is readonly.
	if( $(this).attr('readonly') == 'readonly') { 
        e.preventDefault();
        $(this).select2('close'); 
        return false;
    }
	});
	
	/**
	 * REFRESH CAPTURE CODE 
	 * WHEN CLICK ON REFRESH ICON
	**/
	$("#captchaRefreshIcon").click(function() {
		
		$.ajax({
			data: {
			},
			type: 'POST',
			dataType: 'json',
			url: base_url+'user/refreshCaptcha',
			success: function(result) {
				
				$('#image_captcha').html(result.captImage);
				$('#captchaSess').val(result.captSess);
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
		});
	});
	
   
   // ADD NEW CATEGORY FROM PRODUCT CREATING PAGE
   
	$('#newProduct_saveCategory').click(function() {
		
		var categoryName = $("#newProduct_categoryName").val();
		
		//Check the inputs
		if(categoryName =='') {
			//alert(ALERT_CODE_NOT_FILLED);
			Swal.fire({
					title: ALERT_alert,
					text: ALERT_CODE_NOT_FILLED,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
			$("#newProduct_categoryName").focus();
			return false;
		}
				
		//SAVE New Category
			$.ajax({
				data: {
					categoryName    : categoryName
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'product/saveNewCategory',
				success: function(result) {
					alert(ALERT_CAT_ADDED_SUCCESS);
					$('#addNewCategoryModal').modal('hide');
					loadSelectOptions("#productCategory", "product_categories", "category_id", "category_name");
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// ADD NEW SUPPLIER FROM PRODUCT CREATING PAGE
	$('#newProduct_saveSupplier').click(function() {
		
		
		var supplierCode      = $("#newProduct_supplierCode").val();
		var supplierName      = $("#newProduct_supplierName").val();
		var supplierRegister  = $("#newProduct_supplierRegister").val();
		var supplierPhone     = $("#newProduct_supplierPhone").val();
		var supplierMobile    = $("#newProduct_supplierMobile").val();
		var supplierAddress   = $("#newProduct_supplierAddress").val();
		var supplierCity      = $("#newProduct_supplierCity").val();
		var supplierCountry   = $("#newProduct_supplierCountry").val();
		var supplierEmail     = $("#newProduct_supplierEmail").val();
		var supplierStatus    = $("#newProduct_supplierStatus").val();
		
		//Check the inputs
		if(supplierCode =='' || supplierName =='' || supplierRegister =='' || supplierPhone =='' || supplierMobile =='' || supplierAddress =='' || supplierCity =='' || supplierCountry =='' || supplierEmail =='' || supplierStatus =='' ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
					title: ALERT_alert,
					text: ALERT_FIELD_EMPTY,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
			return false;
		}
				
		//SAVE New Supplier
			$.ajax({
				data: {
					supplierCode       : supplierCode,
					supplierName       : supplierName,
					supplierRegister   : supplierRegister,
					supplierPhone      : supplierPhone,
					supplierMobile     : supplierMobile,
					supplierAddress    : supplierAddress,
					supplierCity       : supplierCity,
					supplierCountry    : supplierCountry,
					supplierEmail      : supplierEmail,
					supplierStatus     : supplierStatus
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'supplier/saveNewSupplier',
				success: function(result) {
					alert(ALERT_SUPPLIER_ADDED_SUCCESS);
					$('#addNewSupplierModal').modal('hide');
					loadSelectOptions("#productSupplier", "suppliers", "supplier_id", "full_name");
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// ADD NEW UNIT FROM PRODUCT CREATING PAGE
	$('#newProduct_saveUnit').click(function() {
		
		var unitCode = $("#newProduct_unitCode").val();
		var unitName = $("#newProduct_unitName").val();
		
		//Check the inputs
		if(unitCode =='' || unitName =='') {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
					title: ALERT_alert,
					text: ALERT_FIELD_EMPTY,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
			$("#newProduct_unitCode").focus();
			return false;
		}
				
		//SAVE New UNit
			$.ajax({
				data: {
					unitCode    : unitCode,
					unitName    : unitName,
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'product/saveNewUnit',
				success: function(result) {
					alert(ALERT_UNIT_ADDED_SUCCESS);
					$('#addNewUnitModal').modal('hide');
					loadSelectOptions("#productUnit", "measuring_units", "id", "designation");
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// DISPLAY THE PRODUCT DIMENSIONS
	$('#productDim_products').change(function() {
		$('#productDim_length').val('');
		$('#productDim_width').val('');
		$('#productDim_height').val('');
		$('#productDim_weight').val('');
		$('#productDim_units').val('');
		var productId = $("#productDim_products").val();
		//Check the inputs
		if(productId =='' ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			$("#productDim_products").focus();
			return false;
		}
				
		//Dispaly dimensions
			$.ajax({
				data: {
					productId    : productId
				},
				type: 'POST',
				dataType: 'json',
				beforeSend: function(){
					$("#saveDimensions").prop('disabled', true);
				},
				url: base_url+'product/displayDimensions',
				success: function(result) {
					$('#productDim_length').val(result.length_pr);
					$('#productDim_width').val(result.width_pr);
					$('#productDim_height').val(result.height_pr);
					$('#productDim_weight').val(result.weight_pr);
					$('#productDim_units').val(result.units_pr);
				},
				complete:function(data){
					$("#saveDimensions").prop('disabled', false);;
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	//DEACTIVATED PRODUCT
	$('.productTable').on('click', '.pr_action', function() {
		var row = $(this).closest("tr");
		var indice = $(this).closest("tr").index();
		var pr = "#action_productId"+(indice+1);
		var productId = $(pr).val();
		job=confirm(ALERT_REMOVE_ROW);
			if(job!=true){
				//cancel the action of deactivating a product
				return false;
			} else {
				//deactivate product
				$.ajax({
					data: {
						productId    : productId
					},
					type: 'POST',
					dataType: 'json',
					url: base_url+'product/activationAction',
					success: function(result) {
						window.location.href = base_url+'products';
					},
					error: function(xhr, status, error){
						var errorMessage = xhr.status + ': ' + xhr.statusText
						alert('Error - ' + errorMessage);
					}
				});
			}
		
	});
	
	$(".divRack").popover({
		title: '<h4>Newsletter Subscription</h4>',
		container: 'body',
		placement: 'bottom',
		html: true, 
		content: function() {
          return $('#popover-form').html();
		}
	});
	
	$("#addStockBarcode").focusout(function(e){
		var barcode = $("#addStockBarcode").val();
		//empty the stock qty if already not empty
		$("#addStockQty").val("");
		//empty the volume if already not empty
		$("#addStockRequiredVolume").val("");
		//empty the number of shelves if already not empty
		$("#addStockRequiredShelves").val("");
		//clear the table of storage locations
		$('#addStockLocationsTable').find("tr:gt(0)").remove();
		//hide the table of storage locations
		$(".collapse").collapse('hide');
		//hide the button collapse
		$("#addStockLocationsButton").hide();
		
		$.ajax({
					data: {
						barcode    : barcode
					},
					type: 'POST',
					dataType: 'json',
					url: base_url+'product/getProductFromBarcode',
					success: function(result) {
						
						if(result.productId.length > 0) {
						$("#errorBarcode").html('');
						$("#addStockProduct").select2("val", result.productId);
						$("#addStockBloc").removeClass("disabled-div");
						$("#addStockBloc").removeClass("disabled-bloc");
						
						$("#addStockBarcode1").val(barcode);
						$("#addStockProduct1").select2("val", result.productId);
						$("#addStockCurrentStock").val(result.productStock);
						} else {
							$("#errorBarcode").html('<i class="fa fa-exclamation-triangle"></i> '+ERROR_BARCODE);
							$("#addStockProduct").select2("val", result.productId);
							$("#addStockBloc").addClass("disabled-div");
							$("#addStockBloc").addClass("disabled-bloc");
							$("#addStockBarcode1").val('');
							$("#addStockProduct1").select2("val", '0');
							$("#addStockCurrentStock").val('');
						}
					},
					error: function(xhr, status, error){
						var errorMessage = xhr.status + ': ' + xhr.statusText
						alert('Error - ' + errorMessage);
					}
		});
	  
	  e.preventDefault();
	});
	
	//calculate the added stock volume
	$("#addStockQty").keyup(function(){
		var productId = $("#addStockProduct1").val();
		var qty = $("#addStockQty").val();
		//clear the table of storage locations
		$('#addStockLocationsTable').find("tr:gt(0)").remove();
		//hide the table of storage locations
		$(".collapse").collapse('hide');
		
		//required volume
		$.ajax({
			data: {
				productId    : productId
			},
			type: 'POST',
			dataType: 'json',
			url: base_url+'product/getProductVolume',
			success: function(result) {
				//total quantity volume
				var prodVolume =parseFloat(result.prodVolume)*parseFloat(qty);
				// number of shelves required = total volume / volume of a single shelf
				var storageVolume =Math.ceil((prodVolume/parseFloat(result.storVolume)));
				$("#addStockRequiredVolume").val(prodVolume.toFixed(2));
				$("#addStockRequiredShelves").val(storageVolume.toFixed(2));
				$("#addStockLocationsButton").show();
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
		});
		
	});
	
	//fill table with locations and volumes
	$("#addStockLocationsButton").click(function(){
		var requiredVolume = $("#addStockRequiredVolume").val();
		var requiredShelves = $("#addStockRequiredShelves").val();
		if(requiredVolume=='' || requiredVolume==0){
			//alert(ALERT_VOLUME_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_VOLUME_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			$("#addStockQty").val('');
			$("#addStockQty").focus();
			return false;
			
		}
		if(requiredShelves=='' || requiredShelves==0){
			//alert(ALERT_SHELVES_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_SHELVES_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			$("#addStockQty").val('');
			$("#addStockQty").focus();
			return false;
		}
		
		$.ajax({
			data: {
				volume : requiredVolume,
				nbShelves : requiredShelves
			},
			type: 'POST',
			dataType: 'json',
			url: base_url+'product/addStockLocations',
			success: function(result) {
				//alert(result);
				$("#addStockLocationsTable tbody").html(result);
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
		});
		
	});
	
	
	//ALERT WHEN STORAGE LOCATION IS FULL OR DOES NOT FIT THE SELECTED VOLUME -- ADD STOCK FORM --
	$('#addStockLocationsTable').on('change', '.add-stock-shelf', function() {
		var row = $(this).closest("tr");
		var indice = $(this).closest("tr").index();
		var rowId , lineId, shelfId, shelfVolume, selectedLineText;
		var tmpRow, tmpLine, tmpShelf, tmpVolume, tmpTableRow;
		var shelfName;
		tmpRow='#addStockRow'+indice;
		tmpLine='#addStockLine'+indice;
		tmpShelf='#addStockShelf'+indice;
		tmpTableRow ='#addStockTableRow'+indice;
		tmpVolume='#shelfVolume'+indice;
		rowId = $(tmpRow).val();
		lineId = $(tmpLine).val();
		shelfId = $(tmpShelf).val();
		shelfVolume = $(tmpVolume).val();
		selectedLineText = $( tmpLine+" option:selected" ).text();
		shelfName =' (R'+rowId+'-L'+selectedLineText+'-S'+shelfId+') ';
		
		$.ajax({
				data: {
					rowId : rowId,
					lineId : lineId,
					shelfId : shelfId
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'storage/getShelfOcuupancy',
				success: function(result) {
					//$(tmpTableRow).removeClass();
					if((parseFloat(MAX_SHELF_VOLUME)-parseFloat(shelfVolume)-parseFloat(result))<0) {
						//alert('Line'+(i-1)+' exceeds the maximum volume, please choose another shelf');
						Swal.fire({
							title: "Storage Location Warning",
							text: SHELF+shelfName+ALERT_SHELF_FULL_1+' ('+shelfVolume+ALERT_SHELF_FULL_2,
							icon: "warning",
							button: "OK",
							allowEscapeKey: false,
							allowEnterKey: false,
							allowOutsideClick: false,
						});
						$(tmpTableRow).addClass("row-error-stock");
						
					}
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
	});
	
	//DISPLAY BARCODE WHEN SELECTING A PRODUCT FROM THE LIST - ADD STOCK FORM -- 
	$('#addStockProduct').change(function() {
		var product = $('#addStockProduct').val();
		//empty the stock qty if already not empty
		$("#addStockQty").val("");
		//empty the volume if already not empty
		$("#addStockRequiredVolume").val("");
		//empty the number of shelves if already not empty
		$("#addStockRequiredShelves").val("");
		//clear the table of storage locations
		$('#addStockLocationsTable').find("tr:gt(0)").remove();
		//hide the table of storage locations
		$(".collapse").collapse('hide');
		//hide the button collapse
		$("#addStockLocationsButton").hide();
		$.ajax({
			data: {
				productId : product
			},
			type: 'POST',
			dataType: 'json',
			url: base_url+'product/getProductBarcode',
			success: function(result) {
				if(result.productBarcode.length > 0) {
					$("#errorBarcode").html('');
					$("#addStockBarcode").val(result.productBarcode);
					$("#addStockBloc").removeClass("disabled-div");
					$("#addStockBloc").removeClass("disabled-bloc");
						
					$("#addStockBarcode1").val(result.productBarcode);
					$("#addStockProduct1").select2("val", product);
					$("#addStockCurrentStock").val(result.productStock);
				} else {
					$("#errorBarcode").html('<i class="fa fa-exclamation-triangle"></i> '+ERROR_BARCODE);
					//$("#addStockProduct").select2("val", result.productId);
					$("#addStockBarcode").val('');
					$("#addStockBloc").addClass("disabled-div");
					$("#addStockBloc").addClass("disabled-bloc");
					$("#addStockBarcode1").val('');
					$("#addStockProduct1").select2("val", '0');
					$("#addStockCurrentStock").val('');
				}
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
		});
	});
	
	//SELECT AN ITEM FROM THE LIST TO DISPLAY ITS MOVEMENTS
	$("#inventory_items").change(function() {
		$(".inventory-row").remove();
		var productId = $("#inventory_items").val();
			
			
        $.ajax({
			data: {
				productId: productId,
			},
			type: 'POST',
			dataType: 'json',
			url: base_url+'product/productMvt',
			success: function(response) {
				$(".productMvtTable tbody").empty();
				$(".productMvtTable tbody").append(response);
					  
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
        });
	});
	
	// UPDATE THE ALERT QTY WHEN CHANGING MINIMUM QTY
	$('#minimumStock').keyup(function() {
		var minQty, secQty
		if($('#minimumStock').val()=='') {
			minQty = 0;
		} else {
			minQty = parseFloat($('#minimumStock').val());
		}
		if($('#securityStock').val()=='') {
			secQty = 0;
		} else {
			secQty = parseFloat($('#securityStock').val());
		}
		alertQty = minQty+secQty;
		$('#productAlert').val(alertQty);
		
	});
	
	// UPDATE THE ALERT QTY WHEN CHANGING SECURITY QTY
	$('#securityStock').keyup(function() {
		var minQty, secQty
		if($('#minimumStock').val()=='') {
			minQty = 0;
		} else {
			minQty = parseFloat($('#minimumStock').val());
		}
		if($('#securityStock').val()=='') {
			secQty = 0;
		} else {
			secQty = parseFloat($('#securityStock').val());
		}
		alertQty = minQty+secQty;
		$('#productAlert').val(alertQty);
		
	});
	
	// UPDATE THE PHYSICAL QUANTITY
	$('#editPhysQtyUpdate').click(function() {
		
		var invId = $("#editPhysQtyInvId").val();
		var prId = $("#editPhysQtyProductId").val();
		var prStock = parseFloat($("#editPhysQtyStock").val());
		var physQty = parseFloat($("#editPhysQtyPhysQty").val());
		
		//Check the inputs
		if(physQty =='') {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			$("#editPhysQtyPhysQty").focus();
			return false;
		}
				
		//SAVE New UNit
			$.ajax({
				data: {
					invId    : invId,
					prId    : prId,
					stock    : prStock,
					physQty    : physQty
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'inventory/updatePhysQty',
				success: function(result) {
					$("#updateResult").html(result.message);
					window.setTimeout(function() {
						window.location.href = base_url+'inventory/physical-inventory';
					}, 1000);
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// ADD PRODUCT TO TRANSFER 
	$('#addProductToTransferTable').click(function() {
		
		var prId = $("#transferProducts").val();
		var qty = $("#transferQty").val();
		
		//Check the inputs
		if(prId =="" || qty == "" || qty == 0) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		// this is to check if the selected product is already exist in the table or not
		var item = document.getElementsByName('transferPrId[]');
		var tbody = document.querySelector("#transferProductList tbody");
    	var nbRows = tbody.querySelectorAll("tr").length;
		var itemExist = false;
		for ( i=0; i<nbRows; i++) {
			if(item[i].value == prId) {
				itemExist = true;
				//alert(ALERT_ITEM_EXIST);
				Swal.fire({
					title: ALERT_alert,
					text: ALERT_FIELD_EMPTY,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
				return false;
			}
		}
				
		//Add the product
			$.ajax({
				data: {
					prId    : prId,
					qty    : qty
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'transfer/addProductToTransfer',
				success: function(result) {
					if(result=='notenoughstock') {
						//alert(ALERT_NOT_ENOUGH_STOCK);
						Swal.fire({
							title: ALERT_alert,
							text: ALERT_NOT_ENOUGH_STOCK,
							icon: "warning",
							button: "OK",
							allowEscapeKey: false,
							allowEnterKey: false,
							allowOutsideClick: false,
						});
					} else {
						$("#transferProductList tbody").append(result);
						// Enable the save transfer button
						$("#saveTransfer").prop('disabled', false);
					}
					//clear fields 
					$('#transferProducts').val(null).trigger('change');
					$("#transferQty").val('');
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	//remove current row from table
	$('#transferProductList').on('click', '.removeRow', function() {
			var row = $(this).closest("tr");
			var indice = $(this).closest("tr").index();
			job=confirm(ALERT_REMOVE_ROW);
			if(job!=true){
				return false;
			} else {
				row.remove();
				//if no rows in the table, then disable the save transfer button
				var tbody = document.querySelector("#transferProductList tbody");
				var nbRows = tbody.querySelectorAll("tr").length;
				if(nbRows == 0) {
					$("#saveTransfer").prop('disabled', true);
				}
			}

	});
	
	//remove current row from table
	$('#lpoProductList').on('click', '.removeRow', function() {
			var row = $(this).closest("tr");
			var indice = $(this).closest("tr").index();
			job=confirm(ALERT_REMOVE_ROW);
			if(job!=true){
				return false;
			} else {
				row.remove();
				//if no rows in the table, then disable the save lpo button
				var tbody = document.querySelector("#lpoProductList tbody");
				var nbRows = tbody.querySelectorAll("tr").length;
				if(nbRows == 0) {
					$("#saveLpo").prop('disabled', true);
				}
			}

	});
	
	//remove current row from table
	$('#packageBarcode_productList').on('click', '.removeRow', function() {
			var row = $(this).closest("tr");
			var indice = $(this).closest("tr").index();
			job=confirm(ALERT_REMOVE_ROW);
			if(job!=true){
				return false;
			} else {
				row.remove();
				//if no rows in the table, then disable the generate button
				var tbody = document.querySelector("#packageBarcode_productList tbody");
				var nbRows = tbody.querySelectorAll("tr").length;
				if(nbRows == 0) {
					$("#packageBarcode_generateBarcode").prop('disabled', true);
				}
			}

	});
	
	//GET THE DESTINATION WAREHOUSE INFORMATION
	$("#destinationWarehouse").change(function() {
		
		var warehouseId = $("#destinationWarehouse").val();
			
			
        $.ajax({
			data: {
				warehouseId: warehouseId,
			},
			type: 'POST',
			dataType: 'json',
			url: base_url+'transfer/getDestWarhInfo',
			success: function(response) {
				$("#destinationAddress").val(response.warehouseAddress);
				$("#destinationManager").val(response.contactName);
				$("#destinationPhone").val(response.contactPhone);
					  
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
        });
	});
	
	
	//APPROVE PICKUP LOCATION FOR A TRANSFERRED PRODUCT
	$("#loadTransfer_savePickupLocations").click(function() {
		
		// get the number of the rows of the table
		var tbody = document.querySelector("#transferProductVolumeList tbody");
		var nbRows = tbody.querySelectorAll("tr").length;
		// Checked volumes
		var chosenVolumes = document.getElementsByName('chosenVolumes[]');
		// Volume to be picked up from the shelf
		var pickVolume = document.getElementsByName('pickedVolume[]');
		// Storage Row
		var storageRow = document.getElementsByName('currRow[]');
		// Storage Line
		var storageLine = document.getElementsByName('currLine[]');
		// Storage Shelf
		var storageShelf = document.getElementsByName('currShelf[]');
		var checkedStatus = false;
		var totalPickedVolume =0;
		
		
		if(nbRows>0) {
			//nbChecked => only checked items will be saved
			var nbChecked =[];
			// pickedVol => total volume picked up
			var pickedVol = 0;
			for ( i=0; i<nbRows; i++) {
				//if item checked => increment nbChecked and add the pickedup volume to pickedVol
				if (chosenVolumes[i].checked) {
					checkedStatus = true;
					pickedVol = pickedVol + parseFloat(pickVolume[i]);
					nbChecked.push(i);
				}
			}
			//if picked volume is greater than the product volume
			if(pickedVol > parseFloat($('#pickupTransfer_prVolume').val()) ){
				//alert(ALERT_PICKED_VOLUME_OVER);
				Swal.fire({
					title: ALERT_alert,
					text: ALERT_PICKED_VOLUME_OVER,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
				return false;
			//if picked volume is less than the product volume
			} else if(pickedVol < parseFloat($('#pickupTransfer_prVolume').val()) ){
				//alert(ALERT_PICKED_VOLUME_LESS);
				Swal.fire({
					title: ALERT_alert,
					text: ALERT_PICKED_VOLUME_LESS,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
				return false;
			//if picked volume is equal to the product volume
			} else {
				//update the stock => remove the quantity approved for transfer
				$.ajax({
						data: {
							outQty: $("#pickupTransfer_prQty").val(),
							productId: $("#pickupTransfer_prId").val(),
							transferId: $("#pickupTransfer_trId").val()
						},
						type: 'POST',
						dataType: 'json',
						url: base_url+'transfer/updateInventory',
						success: function(response) {
							$("#pickupTransfer_InventoryId").val(response);
						},
						error: function(xhr, status, error){
							var errorMessage = xhr.status + ': ' + xhr.statusText
							alert('Error - ' + errorMessage);
						}
				});
				//remove the reserved quantity from the temporary inventory
				$.ajax({
						data: {
							productId: $("#pickupTransfer_prId").val(),
							transferId: $("#pickupTransfer_trId").val()
						},
						type: 'POST',
						dataType: 'json',
						url: base_url+'transfer/removeResTransferQty',
						success: function(response) {
							
						},
						error: function(xhr, status, error){
							var errorMessage = xhr.status + ': ' + xhr.statusText
							alert('Error - ' + errorMessage);
						}
				});
				
				//update the product in the "approved_transfer" table ==> set loaded to 1;
				$.ajax({
						data: {
							productId: $("#pickupTransfer_prId").val(),
							transferId: $("#pickupTransfer_trId").val()
						},
						type: 'POST',
						dataType: 'json',
						url: base_url+'transfer/updateProductLoading',
						success: function(response) {
							
						},
						error: function(xhr, status, error){
							var errorMessage = xhr.status + ': ' + xhr.statusText
							alert('Error - ' + errorMessage);
						}
				});
				
				// update volume in storage locations
				var arr=[];
				for ( i=0; i<nbChecked.length; i++) {
					//alert(pickVolume[nbChecked[i]].value);
					$.ajax({
						data: {
							
							inventory_id: $("#pickupTransfer_InventoryId").val(),
							transfer_id: $("#pickupTransfer_trId").val(),
							out_occ: pickVolume[nbChecked[i]].value,
							product_id: $("#pickupTransfer_prId").val(),
							row_occ: storageRow[nbChecked[i]].value,
							line_occ: storageLine[nbChecked[i]].value,
							shelf_occ: storageShelf[nbChecked[i]].value
						},
						type: 'POST',
						dataType: 'json',
						url: base_url+'transfer/saveTransferPickup',
						success: function(response) {
							var items = parseInt($("#savedItems").val());
							$("#savedItems").val(items+1);
						},
						error: function(xhr, status, error){
							var errorMessage = xhr.status + ': ' + xhr.statusText
							alert('Error - ' + errorMessage);
						}
					});
					
				}
				//check if all checked items are saved 
				if (nbChecked.length > parseInt($("#savedItems").val())) {
					//some storage locations are not saved 
					//alert(ALERT_MISSING_ITEMS_TRANSFER_PICKUP);
					Swal.fire({
						title: ALERT_alert,
						text: ALERT_MISSING_ITEMS_TRANSFER_PICKUP,
						icon: "warning",
						button: "OK",
						allowEscapeKey: false,
						allowEnterKey: false,
						allowOutsideClick: false,
					});
				} else {
					//product picked up successfully
					//alert(ALERT_PRODUCT_PICKEDUP_SUCCESS);
					Swal.fire({
						title: ALERT_alert,
						text: ALERT_PRODUCT_PICKEDUP_SUCCESS,
						icon: "warning",
						button: "OK",
						allowEscapeKey: false,
						allowEnterKey: false,
						allowOutsideClick: false,
					});
				}
			}
			window.location.href = base_url+'transfers/issued';
				
			
			
		} else {
			//no storage locations found
			return false ;
		}
		
	});
	
	// RECEPTION - GET PRODUCT INFO
	$('#receptionTrProduct').change(function() {
		
		var prId = $("#receptionTrProduct").val();
		var transferId = $("#receptionTrId").val();
		$("#receptionTrPrQty").val('');
			$("#receptionTrPrVolume").val('');
			$("#receptionTrPrShelves").val('');
			$("#receptionLocationsButton").addClass("div-hidden");
			$("#receptionLocationsTable tbody").html('');
			$("#saveTrReceptionLocations").addClass("div-hidden");
			$("#receptionLocations").hide();
		
		//Check the inputs
		if(prId =="" || transferId == "") {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		
		//Add the product
			$.ajax({
				data: {
					productId    : prId,
					transferId   : transferId
				},
				type: 'POST',
				dataType: 'json',
				beforeSend: function(){
					$("#receptionTrPrQty").val('');
					$("#receptionTrPrVolume").val('');
					$("#receptionTrPrShelves").val('');
					$("#receptionLocationsButton").addClass("div-hidden");
					$("#receptionLocationsTable tbody").html('');
					$("#saveTrReceptionLocations").addClass("div-hidden");
					$("#receptionLocations").hide();
				},
				url: base_url+'transfer/getReceptionDetails',
				success: function(result) {
					var maxShelfVolume = parseFloat(result.maxVolume);
					var prVolume = result.volume;
					
					$("#receptionTrPrQty").val(result.qty);
					$("#receptionTrPrVolume").val(prVolume.toFixed(2));
					$("#receptionTrPrShelves").val(Math.ceil(parseFloat(prVolume)/maxShelfVolume));
					$("#receptionLocationsButton").removeClass("div-hidden");
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	
	//RECEPTION - fill table with locations and volumes
	$("#receptionLocationsButton").click(function(){
		var requiredVolume = $("#receptionTrPrVolume").val();
		var requiredShelves = $("#receptionTrPrShelves").val();
		if(requiredVolume=='' || requiredVolume==0){
			//alert(ALERT_VOLUME_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_VOLUME_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
			
		}
		if(requiredShelves=='' || requiredShelves==0){
			//alert(ALERT_SHELVES_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_SHELVES_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		
		$.ajax({
			data: {
				volume : requiredVolume,
				nbShelves : requiredShelves
			},
			type: 'POST',
			dataType: 'json',
			beforeSend: function(){
					
					$("#receptionLocations").hide();
				},
			url: base_url+'product/addStockLocations',
			success: function(result) {
				//alert(result);
				$("#receptionLocationsTable tbody").html(result);
				$("#saveTrReceptionLocations").removeClass("div-hidden");
				$("#receptionLocations").show();
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
		});
		
	});
	
	//ENABLE / DISABLE SUPPLIER
	$('.supplierTable').on('click', '.supp_action', function() {
		var row = $(this).closest("tr");
		var indice = $(this).closest("tr").index();
		var supp = "#suppliers_suppId"+(indice+1);
		var supplierId = $(supp).val();
		job=confirm(ALERT_REMOVE_ROW);
			if(job!=true){
				//cancel the action of deactivating a product
				return false;
			} else {
				//deactivate product
				$.ajax({
					data: {
						supplierId    : supplierId
					},
					type: 'POST',
					dataType: 'json',
					url: base_url+'supplier/activationAction',
					success: function(result) {
						window.location.href = base_url+'suppliers';
					},
					error: function(xhr, status, error){
						var errorMessage = xhr.status + ': ' + xhr.statusText
						alert('Error - ' + errorMessage);
					}
				});
			}
		
	});
	
	// NEW LPO - GET PRODUCTS OF SELECTED SUPPLIER
	$("#newLPOSupplier").change(function(e){
		var supplierId = $("#newLPOSupplier").val();
		var supplierName = $("#newLPOSupplier option:selected" ).text();
		//Check the inputs
		if(supplierId =="") {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		//Get products of the selected supplier
		$.ajax({
			data: {
				supplierId : supplierId
			},
			type: 'POST',
			dataType: 'json',
			beforeSend: function(){
				$('#lpoProducts').empty();
				$('#lpoProductQty').val('');
				$('#lpoProductList').find("tr:gt(0)").remove();
				$("#saveLpo").prop('disabled', true);
				$("#newLpoAddProductDiv").addClass("disabled-div");
			},
			url: base_url+'product/getSupplierProducts',
			success: function(result) {
				if(result=='noproducts') {
					//alert(ALERT_SUPPLIER_HAS_NO_PRODUCTS);
					Swal.fire({
						title: ALERT_alert,
						text: ALERT_SUPPLIER_HAS_NO_PRODUCTS,
						icon: "warning",
						button: "OK",
						allowEscapeKey: false,
						allowEnterKey: false,
						allowOutsideClick: false,
					});
				} else {
					$('#lpoProducts').html(result);
				}
				$('#newLPO_productSupplierId').val(supplierId);
				$('#newLPO_productSupplierName').val(supplierName);
				$("#newLpoAddProductDiv").removeClass("disabled-div");
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
		});
	});
	
	// ADD NEW SUPPLIER FROM NEW LPO PAGE
	$('#newLPO_saveSupplier').click(function() {
		
		
		var supplierCode      = $("#newLPO_supplierCode").val();
		var supplierName      = $("#newLPO_supplierName").val();
		var supplierRegister  = $("#newLPO_supplierRegister").val();
		var supplierPhone     = $("#newLPO_supplierPhone").val();
		var supplierMobile    = $("#newLPO_supplierMobile").val();
		var supplierAddress   = $("#newLPO_supplierAddress").val();
		var supplierCity      = $("#newLPO_supplierCity").val();
		var supplierCountry   = $("#newLPO_supplierCountry").val();
		var supplierEmail     = $("#newLPO_supplierEmail").val();
		var supplierStatus    = $("#newLPO_supplierStatus").val();
		
		//Check the inputs
		if(supplierCode =='' || supplierName =='' || supplierRegister =='' || supplierPhone =='' || supplierMobile =='' || supplierAddress =='' || supplierCity =='' || supplierCountry =='' || supplierEmail =='' || supplierStatus =='' ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
				
		//SAVE New Supplier
			$.ajax({
				data: {
					supplierCode       : supplierCode,
					supplierName       : supplierName,
					supplierRegister   : supplierRegister,
					supplierPhone      : supplierPhone,
					supplierMobile     : supplierMobile,
					supplierAddress    : supplierAddress,
					supplierCity       : supplierCity,
					supplierCountry    : supplierCountry,
					supplierEmail      : supplierEmail,
					supplierStatus     : supplierStatus
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'supplier/saveNewSupplier',
				success: function(result) {
					//alert(ALERT_SUPPLIER_ADDED_SUCCESS);
					Swal.fire({
						title: ALERT_SUPPLIER_ADDED_SUCCESS,
						text: ALERT_SUPPLIER_ADDED_SUCCESS,
						icon: "success",
						button: "OK",
						allowEscapeKey: false,
						allowEnterKey: false,
						allowOutsideClick: false,
					});
					$('#newLpo_newSupplierModal').modal('hide');
					loadSelectOptions("#newLPOSupplier", "suppliers", "supplier_id", "full_name");
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	
	
	// ADD NEW PRODUCT FROM NEW LPO PAGE
	$('#newLPO_saveProduct').click(function() {
		
		
		var productCode      = $("#newLPO_productBarcode").val();
		var productName      = $("#newLPO_productName").val();
		var productCategory  = $("#newLPO_productCategory").val();
		var productSupplier  = $("#newLPO_productSupplierId").val();
		var productUnit      = $("#newLPO_productUnit").val();
		
		//Check the inputs
		if(productCode =='' || productName =='' || productCategory =='' || productSupplier =='' || productUnit ==''  ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
				
		//SAVE New Product
			$.ajax({
				data: {
					productCode       : productCode,
					productName       : productName,
					productCategory   : productCategory,
					productSupplier   : productSupplier,
					productUnit       : productUnit
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'product/saveProductFromLPO',
				success: function(result) {
					if(result.msg=='productadded') {
						alert(ALERT_PRODUCT_ADDED_SUCCESS);
						$('#newLpo_newProductModal').modal('hide');
						$('#lpoProducts').html(result.supplierProducts);
						//var selectCondition ="['warehouse_id' => "+result.warehouse+", 'supplier_id' =>"+productSupplier+"]";
						//loadSelectOptionsWithCondition("#lpoProducts", "products", "product_id", "product_name", selectCondition );
					} else {
						//alert('product not added');
						Swal.fire({
							title: ALERT_alert,
							text: ALERT_PRODUCT_ADDED_FAILURE,
							icon: "warning",
							button: "OK",
							allowEscapeKey: false,
							allowEnterKey: false,
							allowOutsideClick: false,
						});
					}
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// ADD PRODUCT TO ORDER TABLE 
	$('#addProductToLpoTable').click(function() {
		
		var prId = $("#lpoProducts").val();
		var qty = $("#lpoProductQty").val();
		
		//Check the inputs
		if(prId =="" || qty == "" || qty == 0) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		// this is to check if the selected product is already exist in the table or not
		var item = document.getElementsByName('lpoPrId[]');
		var tbody = document.querySelector("#lpoProductList tbody");
    	var nbRows = tbody.querySelectorAll("tr").length;
		var itemExist = false;
		for ( i=0; i<nbRows; i++) {
			if(item[i].value == prId) {
				itemExist = true;
				//alert(ALERT_ITEM_EXIST);
				Swal.fire({
					title: ALERT_alert,
					text: ALERT_ITEM_EXIST,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
				//clear fields 
				$('#lpoProducts').val(null).trigger('change');
				$("#lpoProductQty").val('');
				return false;
			}
		}
				
		//Add the product
			$.ajax({
				data: {
					prId    : prId,
					qty    : qty
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'order/addProductToLPO',
				success: function(result) {
					
					$("#lpoProductList tbody").append(result);
					// Enable the save transfer button
					$("#saveLpo").prop('disabled', false);
					//clear fields 
					$('#lpoProducts').val(null).trigger('change');
					$("#lpoProductQty").val('');
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// PO RECEIVING - GET PRODUCT INFO
	$('#rcProduct').change(function() {
		
		var prId = $("#rcProduct").val();
		var rcId = $("#recReceivingId").val();
		$("#rcPrQty").val('');
			$("#rcPrVolume").val('');
			$("#rcPrShelves").val('');
			$("#receivingLocationsButton").addClass("div-hidden");
			$("#receivingLocationsTable tbody").html('');
			$("#saveReceivingLocations").addClass("div-hidden");
			$("#receivingLocations").hide();
		
		//Check the inputs
		if(prId =="" || rcId == "") {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		
		//Add the product
			$.ajax({
				data: {
					productId    : prId,
					rcId   : rcId
				},
				type: 'POST',
				dataType: 'json',
				beforeSend: function(){
					$("#rcPrQty").val('');
					$("#rcPrVolume").val('');
					$("#rcPrShelves").val('');
					$("#receivingLocationsButton").addClass("div-hidden");
					$("#receivingLocationsTable tbody").html('');
					$("#saveReceivingLocations").addClass("div-hidden");
					$("#receivingLocations").hide();
				},
				url: base_url+'order/getReceivingDetails',
				success: function(result) {
					var maxShelfVolume = parseFloat(result.maxVolume);
					var prVolume = result.volume;
					
					$("#rcPrQty").val(result.qty);
					$("#rcPrVolume").val(prVolume.toFixed(2));
					$("#rcPrShelves").val(Math.ceil(parseFloat(prVolume)/maxShelfVolume));
					$("#receivingLocationsButton").removeClass("div-hidden");
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	//PO RECEIVING - fill table with locations and volumes
	$("#receivingLocationsButton").click(function(){
		var requiredVolume = $("#rcPrVolume").val();
		var requiredShelves = $("#rcPrShelves").val();
		if(requiredVolume=='' || requiredVolume==0){
			//alert(ALERT_VOLUME_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_VOLUME_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
			
		}
		if(requiredShelves=='' || requiredShelves==0){
			//alert(ALERT_SHELVES_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_SHELVES_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		
		$.ajax({
			data: {
				volume : requiredVolume,
				nbShelves : requiredShelves
			},
			type: 'POST',
			dataType: 'json',
			beforeSend: function(){
					
					$("#receivingLocations").hide();
				},
			url: base_url+'product/addStockLocations',
			success: function(result) {
				//alert(result);
				$("#receivingLocationsTable tbody").html(result);
				$("#saveReceivingLocations").removeClass("div-hidden");
				$("#receivingLocations").show();
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
		});
		
	});
	
	//ENABLE / DISABLE CUSTOMER
	$('.customerTable').on('click', '.cust_action', function() {
		var row = $(this).closest("tr");
		var indice = $(this).closest("tr").index();
		var cust = "#customers_custId"+(indice+1);
		var custId = $(cust).val();
		job=confirm(ALERT_REMOVE_ROW);
			if(job!=true){
				//cancel the action of deactivating a customer
				return false;
			} else {
				//deactivate customer
				$.ajax({
					data: {
						custId    : custId
					},
					type: 'POST',
					dataType: 'json',
					url: base_url+'customer/activationAction',
					success: function(result) {
						window.location.href = base_url+'customers';
					},
					error: function(xhr, status, error){
						var errorMessage = xhr.status + ': ' + xhr.statusText
						alert('Error - ' + errorMessage);
					}
				});
			}
		
	});
	
	//NEW CUSTOMER ORDER - ACTIVATE PRODUCT BLOC AFTER CHOOSING A CUSTOMER NAME
	$("#custCustomer").change(function(){
		var custId = $("#custCustomer").val();
		
		if(custId == '' ) {
			//disable the product bloc
			$("#cpoProductDiv").addClass("disabled-bloc");
			$("#cpoProductDiv").addClass("disabled-div");
		} else {
			//activate the product bloc
			$("#cpoProductDiv").removeClass("disabled-bloc");
			$("#cpoProductDiv").removeClass("disabled-div");
		} 
		
	});
	
	// ADD PRODUCT TO CUSTOMER ORDER 
	$('#addProductToCustOrderTable').click(function() {
		
		var prId = $("#custOrderProducts").val();
		var qty = $("#custOrderQty").val();
		
		//Check the inputs
		if(prId =="" || qty == "" || qty == 0) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		// this is to check if the selected product is already exist in the table or not
		var item = document.getElementsByName('orderPrId[]');
		var tbody = document.querySelector("#custOrderProductList tbody");
    	var nbRows = tbody.querySelectorAll("tr").length;
		var itemExist = false;
		for ( i=0; i<nbRows; i++) {
			if(item[i].value == prId) {
				itemExist = true;
				//alert(ALERT_ITEM_EXIST);
				Swal.fire({
					title: ALERT_alert,
					text: ALERT_ITEM_EXIST,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
				return false;
			}
		}
				
		//Add the product
			$.ajax({
				data: {
					prId    : prId,
					qty    : qty
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'delivery/addProductToCustomerOrder',
				success: function(result) {
					if(result=='notenoughstock') {
						//alert(ALERT_NOT_ENOUGH_STOCK);
						Swal.fire({
							title: ALERT_alert,
							text: ALERT_NOT_ENOUGH_STOCK,
							icon: "warning",
							button: "OK",
							allowEscapeKey: false,
							allowEnterKey: false,
							allowOutsideClick: false,
						});
					} else {
						$("#custOrderProductList tbody").append(result);
						// Enable the save transfer button
						$("#saveCustOrder").prop('disabled', false);
					}
					//clear fields 
					$('#custOrderProducts').val(null).trigger('change');
					$("#custOrderQty").val('');
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	
	//APPROVE PICKUP LOCATION FOR A DELIVERED PRODUCT
	$("#saveDelPrPickupLocations").click(function() {
		
		// get the number of the rows of the table
		var tbody = document.querySelector("#DeliveryProductVolumeList tbody");
		var nbRows = tbody.querySelectorAll("tr").length;
		// Checked volumes
		var chosenVolumes = document.getElementsByName('chosenVolumes[]');
		// Volume to be picked up from the shelf
		var pickVolume = document.getElementsByName('pickedVolume[]');
		// Storage Row
		var storageRow = document.getElementsByName('currRow[]');
		// Storage Line
		var storageLine = document.getElementsByName('currLine[]');
		// Storage Shelf
		var storageShelf = document.getElementsByName('currShelf[]');
		var checkedStatus = false;
		var totalPickedVolume =0;
		
		
		if(nbRows>0) {
			//nbChecked => only checked items will be saved
			var nbChecked =[];
			// pickedVol => total volume picked up
			var pickedVol = 0;
			for ( i=0; i<nbRows; i++) {
				//if item checked => increment nbChecked and add the pickedup volume to pickedVol
				if (chosenVolumes[i].checked) {
					checkedStatus = true;
					pickedVol = pickedVol + parseFloat(pickVolume[i]);
					nbChecked.push(i);
				}
			}
			//if picked volume is greater than the product volume
			if(pickedVol > parseFloat($('#pickupDelivery_prVolume').val()) ){
				//alert(ALERT_PICKED_VOLUME_OVER);
				Swal.fire({
					title: ALERT_alert,
					text: ALERT_PICKED_VOLUME_OVER,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
				return false;
			//if picked volume is less than the product volume
			} else if(pickedVol < parseFloat($('#pickupDelivery_prVolume').val()) ){
				//alert(ALERT_PICKED_VOLUME_LESS);
				Swal.fire({
					title: ALERT_alert,
					text: ALERT_PICKED_VOLUME_LESS,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
				return false;
			//if picked volume is equal to the product volume
			} else {
				//update the stock => remove the quantity approved for transfer
				$.ajax({
						data: {
							outQty: $("#pickupDelivery_prQty").val(),
							productId: $("#pickupDelivery_prId").val(),
							deliveryId: $("#pickupDelivery_deliveryId").val()
						},
						type: 'POST',
						dataType: 'json',
						url: base_url+'delivery/updateInventory',
						success: function(response) {
							$("#pickupTransfer_InventoryId").val(response);
						},
						error: function(xhr, status, error){
							var errorMessage = xhr.status + ': ' + xhr.statusText
							alert('Error - ' + errorMessage);
						}
				});
				
				//update the product in the "approved_transfer" table ==> set loaded to 1;
				$.ajax({
						data: {
							productId: $("#pickupDelivery_prId").val(),
							deliveryId: $("#pickupDelivery_deliveryId").val()
						},
						type: 'POST',
						dataType: 'json',
						url: base_url+'delivery/updateProductLoading',
						success: function(response) {
							
						},
						error: function(xhr, status, error){
							var errorMessage = xhr.status + ': ' + xhr.statusText
							alert('Error - ' + errorMessage);
						}
				});
				
				// update volume in storage locations
				var arr=[];
				for ( i=0; i<nbChecked.length; i++) {
					$.ajax({
						data: {
							
							inventory_id: $("#pickupDelivery_InventoryId").val(),
							delivery_id: $("#pickupDelivery_deliveryId").val(),
							out_occ: pickVolume[nbChecked[i]].value,
							product_id: $("#pickupDelivery_prId").val(),
							row_occ: storageRow[nbChecked[i]].value,
							line_occ: storageLine[nbChecked[i]].value,
							shelf_occ: storageShelf[nbChecked[i]].value
						},
						type: 'POST',
						dataType: 'json',
						url: base_url+'delivery/saveDeliveryPickup',
						success: function(response) {
							var items = parseInt($("#DelSavedItems").val());
							$("#DelSavedItems").val(items+1);
						},
						error: function(xhr, status, error){
							var errorMessage = xhr.status + ': ' + xhr.statusText
							alert('Error - ' + errorMessage);
						}
					});
					
				}
				//check if all checked items are saved 
				/*if (nbChecked.length > parseInt($("#DelSavedItems").val())) {
					//some storage locations are not saved 
					//alert(ALERT_MISSING_ITEMS_TRANSFER_PICKUP);
					Swal.fire({
						title: ALERT_alert,
						text: ALERT_MISSING_ITEMS_TRANSFER_PICKUP,
						icon: "warning",
						button: "OK",
						allowEscapeKey: false,
						allowEnterKey: false,
						allowOutsideClick: false,
					});
				} else {*/
					//product picked up successfully
					//alert(ALERT_PRODUCT_PICKEDUP_SUCCESS);
					Swal.fire({
						title: ALERT_success,
						text: ALERT_PRODUCT_PICKEDUP_SUCCESS,
						icon: "success",
						button: "OK",
						allowEscapeKey: false,
						allowEnterKey: false,
						allowOutsideClick: false,
					});
				//}
			}
			window.location.href = base_url+'customers/deliveries';
				
			
			
		} else {
			//no storage locations found
			return false ;
		}
		
	});
	
	//DELIVERY PACKING -- SET PRODUCT AS PACKED
	$('#deliverPackProductList').on('click', '.pr_deliv_pack', function() {
		
		var row = $(this).closest("tr");
		var indice = $(this).closest("tr").index();
		var pr = "#packagingPrId"+(indice+1);
		var deliv = "#packagingDelivId"+(indice+1);
		var productId = $(pr).val();
		var deliveryId = $(deliv).val();
		job=confirm(ALERT_REMOVE_ROW);
			if(job!=true){
				//cancel the action of setting product as packed
				return false;
			} else {
				//set the product as packed
				$.ajax({
					data: {
						productId    : productId,
						deliveryId   : deliveryId
					},
					type: 'POST',
					dataType: 'json',
					url: base_url+'delivery/approveProductPack',
					success: function(result) {
						if(result) {
							Swal.fire({
								title: PACKING_STATUS,
								text: ALERT_PRODUCT_PACKED_SUCCESS,
								icon: "success",
								button: "OK",
								allowEscapeKey: false,
								allowEnterKey: false,
								allowOutsideClick: false,
							});
							window.location.href = base_url+'customers/deliveries';
						} else {
							Swal.fire({
								title: PACKING_STATUS,
								text: ALERT_PRODUCT_PACKED_FAILURE,
								icon: "error",
								button: "OK",
								allowEscapeKey: false,
								allowEnterKey: false,
								allowOutsideClick: false,
							});
						}
					},
					error: function(xhr, status, error){
						var errorMessage = xhr.status + ': ' + xhr.statusText
						alert('Error - ' + errorMessage);
					}
				});
			}
		
	});
	
	//Generate Barcode Example  /* General Settings Page */
	$('#barcodeSetting_generate').click(function() {
		
		var barcodeType = $("#productBarcodeType").val();
		var barcodeNumber = $("#testBarcodeNumber").val();
		
		//Check the inputs
		if(barcodeType =="" || barcodeNumber == "" || barcodeNumber == 0) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		//Call the function that will generate the barcode
			$.ajax({
				data: {
					barcodeType    : barcodeType,
					barcodeNumber  : barcodeNumber
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'GeneralSettings/generateBarcodeExample',
				success: function(result) {
					$("#testBarcodeGenerated").html(result);
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	
	
	// DISPLAY SHIPPING ADDRESS OF A SELECTED CUSTOMER -- BARCODING PACKAGE PAGE 
	$('#packageBarcode_customers').change(function() {
		
		var custId = $("#packageBarcode_customers").val();
		$("#packageBarcode_clientShipAdr").val("");
		
		//Check the inputs
		if(custId =="" ) {
			//disable the package bloc
			$("#barcodingPackageDiv").addClass("disabled-bloc");
			$("#barcodingPackageDiv").addClass("disabled-div");
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		} else {
			//enable the package bloc
			$("#barcodingPackageDiv").removeClass("disabled-bloc");
			$("#barcodingPackageDiv").removeClass("disabled-div");
		}
		
		//Add the shipping address
			$.ajax({
				data: {
					custId    : custId
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'customer/getClientShippingAddress',
				success: function(result) {
					
					$("#packageBarcode_clientShipAdr").val(result);
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// ADD PRODUCT TO PACKAGE LIST -- BARCODING PACKAGE PAGE 
	$('#packageBarcode_addProduct').click(function() {
		
		var prId = $("#packageBarcode_Products").val();
		var qty = $("#packageBarcode_PrQty").val();
		
		//Check the inputs
		if(prId =="" || qty == "" || qty == 0) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		// this is to check if the selected product is already exist in the table or not
		var item = document.getElementsByName('packBarPrId[]');
		var tbody = document.querySelector("#packageBarcode_productList tbody");
    	var nbRows = tbody.querySelectorAll("tr").length;
		var itemExist = false;
		for ( i=0; i<nbRows; i++) {
			if(item[i].value == prId) {
				itemExist = true;
				//alert(ALERT_ITEM_EXIST);
				Swal.fire({
					title: ALERT_alert,
					text: ALERT_ITEM_EXIST,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
				//clear fields 
				$('#packageBarcode_Products').val(null).trigger('change');
				$("#packageBarcode_PrQty").val('');
				return false;
			}
		}
				
		//Add the product
			$.ajax({
				data: {
					prId    : prId,
					qty    : qty
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'product/addProductToPackageList',
				success: function(result) {
					$("#packageBarcode_productList tbody").append(result);
					// Enable the save transfer button
					$("#packageBarcode_generateBarcode").prop('disabled', false);
					//clear fields 
					$('#packageBarcode_Products').val(null).trigger('change');
					$("#packageBarcode_PrQty").val('');
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// UPDATE WAREHOUSE INFORMATIONS 
	$('#updateWarehouseInfos').click(function() {
		
		var warehouseName = $("#warehouseName").val();
		var warehouseAddress = $("#warehouseAddress").val();
		var warehouseCity = $("#warehouseCity").val();
		var warehouseCountry = $("#warehouseCountry").val();
		var warehouseManager = $("#warehouseManager").val();
		var warehousePhone = $("#warehousePhone").val();
		var warehouseMobile = $("#warehouseMobile").val();
		
		
		//Check the inputs
		if(warehouseName =="" || warehouseAddress == "" || warehouseCity == "" || warehouseCountry == "" || warehouseManager == "" || warehousePhone == "" ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		
		//Update Warehouse Information
			$.ajax({
				data: {
					warehouseName    : warehouseName,
					warehouseAddress    : warehouseAddress,
					warehouseCity    : warehouseCity,
					warehouseCountry    : warehouseCountry,
					warehouseManager    : warehouseManager,
					warehousePhone    : warehousePhone,
					warehouseMobile    : warehouseMobile
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'warehouse/updateWarehouseInformation',
				success: function(result) {
					if(result) {
						$("#warehouseUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#warehouseUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// UPDATE WAREHOUSE SETTINGS 
	$('#updateWarehouseSettings').click(function() {
		
		var warhLength = $("#warehouseLength").val();
		var warhWidth = $("#warehouseWidth").val();
		var warhHeight = $("#warehouseHeigth").val();
		var storageZoneLength = $("#storageLength").val();
		var storageZoneWidth = $("#storageWidth").val();
		var storageZoneHeight = $("#storageHeigth").val();
		var officeArea = $("#officeSpace").val();
		var restroomArea = $("#restroomSpace").val();
		var otherArea = $("#otherSpace").val();
		var stockType = $("#stockType").val();
		var storageCost = $("#storageCostRate").val();
		
		//Check the inputs
		if(parseFloat(warhLength) == 0 || parseFloat(warhWidth) == 0 || parseFloat(warhHeight) == 0 || parseFloat(storageZoneLength) == 0 || parseFloat(storageZoneWidth) == 0 || parseFloat(storageZoneHeight) == 0 || parseFloat(officeArea) == 0 || parseFloat(restroomArea) == 0 || otherArea == "" || stockType == "" || parseFloat(storageCost) == 0 ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		
		//Update Warehouse Settings
			$.ajax({
				data: {
					warhLength : warhLength ,
					warhWidth : warhWidth ,
					warhHeight : warhHeight ,
					storageZoneLength : storageZoneLength ,
					storageZoneWidth : storageZoneWidth ,
					storageZoneHeight : storageZoneHeight ,
					officeArea : officeArea ,
					restroomArea : restroomArea ,
					otherArea : otherArea ,
					stockType : stockType ,
					storageCost : storageCost 
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'warehouse/updateWarehouseSettings',
				success: function(result) {
					if(result) {
						$("#warehSettingsUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#warehSettingsUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// UPDATE STORAGE SETTINGS 
	$('#updateStorageSettings').click(function() {
		
		var rackHeight = $("#rackHeight").val();
		var rackLength = $("#rackLength").val();
		var rackWidth = $("#rackWidth").val();
		var shelfHeight = $("#shelfHeight").val();
		var aisleWidth = $("#aisleWidth").val();
		var rackingSystem = $("#rackingSystem").val();
		var inventorySystem = $("#inventorySystem").val();
		var storageSystem = $("#storageSystem").val();
		
		
		//Check the inputs
		if(parseFloat(rackHeight) == 0 || parseFloat(rackLength) == 0 || parseFloat(rackWidth) == 0 || parseFloat(shelfHeight) == 0 || parseFloat(aisleWidth) == 0  || rackingSystem == "" || inventorySystem == "" || storageSystem == "" ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		
		//Update Stoarge Information
			$.ajax({
				data: {
					rackHeight : rackHeight ,
					rackLength : rackLength ,
					rackWidth : rackWidth ,
					shelfHeight : shelfHeight ,
					aisleWidth : aisleWidth ,
					rackingSystem : rackingSystem ,
					inventorySystem : inventorySystem ,
					storageSystem : storageSystem
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'warehouse/updateStorageSettings',
				success: function(result) {
					if(result) {
						$("#storageSettingsUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#storageSettingsUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
	});
			
	// UPDATE INVENTORY SETTINGS 
	$('#updateInventorySettings').click(function() {
				
		var inventoryTechnique = $("#inventoryTechnique").val();
		var pickPackMethod = $("#pickPackMethod").val();
		var aisleLabellingFormat = $("#aisleLabellingFormat").val();
		var bayLabellingFormat = $("#bayLabellingFormat").val();
		var shelfLabellingFormat = $("#shelfLabellingFormat").val();
		var binLabellingFormat = $("#binLabellingFormat").val();
				
				
		//Check the inputs
		if( inventoryTechnique == "" || pickPackMethod == "" || aisleLabellingFormat == "" || bayLabellingFormat == "" || shelfLabellingFormat == "" || binLabellingFormat == "" ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
				
		//Update Inventory Information
			$.ajax({
				data: {
					inventoryTechnique : inventoryTechnique ,
					pickPackMethod : pickPackMethod ,
					aisleLabellingFormat : aisleLabellingFormat ,
					bayLabellingFormat : bayLabellingFormat ,
					shelfLabellingFormat : shelfLabellingFormat ,
					binLabellingFormat : binLabellingFormat
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'warehouse/updateInventorySettings',
				success: function(result) {
					if(result) {
						$("#inventorySettingsUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#inventorySettingsUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
							
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
	});
	
	// UPDATE EOQ SETTINGS 
	$('#updateEOQSettings').click(function() {
				
		var eoqStorageCosts = $("#eoqStorageCosts").val();
		var orderingCosts = $("#orderingCosts").val();
				
				
		//Check the inputs
		if( eoqStorageCosts == "" || orderingCosts == ""  ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
				
		//Update EOQ Information
			$.ajax({
				data: {
					eoqStorageCosts : eoqStorageCosts ,
					orderingCosts : orderingCosts
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'warehouse/updateEOQSettings',
				success: function(result) {
					if(result) {
						$("#eoqSettingsUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#eoqSettingsUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
							
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
	});
	
	// UPDATE COMPANY INFOS 
	$('#updateCompanyInfos').click(function() {
				
		var companyFullName = $("#companyFullName").val();
		var companyShortName = $("#companyShortName").val();
		var companyEmail = $("#companyEmail").val();
		var companyPhone = $("#companyPhone").val();
		var companyShippingAddress = $("#companyShippingAddress").val();
		var companyBillingAddress = $("#companyBillingAddress").val();
		var companyTaxNumber = $("#companyTaxNumber").val();
		var companyRegisterNumber = $("#companyRegisterNumber").val();
		var companyCountry = $("#companyCountry").val();
		var companyCity = $("#companyCity").val();
				
				
		//Check the inputs
		if( companyFullName == "" || companyShortName == "" || companyEmail == "" || companyPhone == "" || companyShippingAddress == "" || companyBillingAddress == "" || companyTaxNumber == "" || companyRegisterNumber == "" || companyCountry == "" || companyCity == ""  ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
				
		//Update EOQ Information
			$.ajax({
				data: {
					companyFullName : companyFullName,
					companyShortName : companyShortName,
					companyEmail : companyEmail,
					companyPhone : companyPhone,
					companyShippingAddress : companyShippingAddress,
					companyBillingAddress : companyBillingAddress,
					companyTaxNumber : companyTaxNumber,
					companyRegisterNumber : companyRegisterNumber,
					companyCountry : companyCountry,
					companyCity : companyCity,
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'generalsettings/updateCompanyInformation',
				success: function(result) {
					if(result) {
						$("#companyUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#companyUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
							
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
	});
	
	// UPDATE APPLICATION SETTINGS 
	$('#updateApplicationSettings').click(function() {
				
		var applicationLongName = $("#applicationLongName").val();
		var applicationShortName = $("#applicationShortName").val();
		var captchaStatus = $("#googleCaptchaCheckStatus").val();
		var siteKey = $("#siteKey").val();
		var secretKey = $("#secretKey").val();
		
		//Check the inputs
		if( applicationLongName == "" || applicationShortName == ""   ) {
			
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		
				//Check if "use Google Captcha checkbox is checked" so as Site Key and Secret Key should be added
		if( captchaStatus == "yes") {
			if( siteKey == "") {
				Swal.fire({
					title: ALERT_alert,
					text: ALERT_CAPTCHA_SITE_KEY,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
				return false;
			}
			if( secretKey == "") {
				Swal.fire({
					title: ALERT_alert,
					text: ALERT_CAPTCHA_SECRET_KEY,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
				return false;
			}
		}
				
		//Update Database Fields 
			$.ajax({
				data: {
					applicationLongName : applicationLongName,
					applicationShortName : applicationShortName,
					applicationLogo : $("#encryptedLogo").val(),
					applicationFavicon : $("#encryptedFavicon").val(),
					captchaStatus : captchaStatus,
					siteKey : siteKey,
					secretKey : secretKey
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'GeneralSettings/updateApplicationSettings',
				success: function(result) {
					
					if(result) {
						$("#applicationUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#applicationUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
							
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
	});
	
	// UPDATE LOCAL SETTINGS 
	$('#updateLocalSettings').click(function() {
				
		var defaultLanguage = $("#defaultLanguage").val();
		var default_timezone = $("#default_timezone").val();
		var firstDayOfWeek = $("#firstDayOfWeek").val();
		var autorizeMultiLanguages = 0;
		if ($('#autorizeMultiLanguages').is(":checked")) {
			autorizeMultiLanguages = 1;
		}else{
			autorizeMultiLanguages = 0;
		}
		//var autorizeMultiLanguages = $("#autorizeMultiLanguages").val();
		var defaultDateFormat = $("#defaultDateFormat").val();
		var defaultTimeFormat = $("#defaultTimeFormat").val();
		var defaultCurrency = $("#defaultCurrency").val();
		var currencyDecimalDigits = $("#currencyDecimalDigits").val();
		var useThousandSeparator = 0;
		var thousandSeparator = 2;
		if ($('#useThousandSeparator').is(":checked")) {
			useThousandSeparator = 1;
			thousandSeparator = $("#thousandSeparator").val();
		}else{
			useThousandSeparator = 0;
			thousandSeparator = 2;
		}
		
				
				
		//Check the inputs
		if( defaultLanguage == "" || default_timezone == "" || firstDayOfWeek == "" || defaultDateFormat == "" || defaultTimeFormat == "" || defaultCurrency == "" || currencyDecimalDigits == ""  ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
				
		//Update LOcal Settings Information
			$.ajax({
				data: {
					defaultLanguage : defaultLanguage,
					default_timezone : default_timezone,
					firstDayOfWeek : firstDayOfWeek,
					autorizeMultiLanguages : autorizeMultiLanguages,
					defaultDateFormat : defaultDateFormat,
					defaultTimeFormat : defaultTimeFormat,
					defaultCurrency : defaultCurrency,
					currencyDecimalDigits : currencyDecimalDigits,
					useThousandSeparator : useThousandSeparator,
					thousandSeparator : thousandSeparator,
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'generalsettings/updateLocalSettings',
				success: function(result) {
					if(result) {
						$("#localSettingsUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#localSettingsUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
							
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
	});
	
	// TEST IF "USE GOOGLE CAPTCHA" CHECKBOX IS CHECKED OR NOT 
	$('#useGoogleCaptcha').change(function() {
		if(this.checked) {
			$("#googleCaptchaCheckStatus").val("yes");
			 $("#siteKey").removeAttr('disabled');
			 $("#secretKey").removeAttr('disabled');
		}else{
			$("#googleCaptchaCheckStatus").val("no");
			$("#siteKey").attr("disabled","disabled");
			$("#secretKey").attr("disabled","disabled");
		}		
		
	});
	
	
	
	
	// UPDATE LOGIN SETTINGS 
	$('#updateLoginSettings').click(function() {
				
		var sessionTimeout = $("#sessionTimeout").val();
		var loginAttemps = $("#loginAttemps").val();
		var accountLockTime = $("#accountLockTime").val();
		
				
				
		//Check the inputs
		if( sessionTimeout == "" || loginAttemps == "" || accountLockTime == "") {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		
				
		//Update LOcal Settings Information
			$.ajax({
				data: {
					sessionTimeout : sessionTimeout,
					loginAttemps : loginAttemps,
					accountLockTime : accountLockTime
					
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'generalsettings/updateLoginSettings',
				success: function(result) {
					if(result) {
						$("#loginSettingsUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#loginSettingsUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
							
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
	});
	
	// UPDATE EMAIL SETTINGS 
	$('#updateMailSettings').click(function() {
				
		var emailSendingMethod = $("#emailSendingMethod").val();
		var senderName = $("#senderName").val();
		var senderEmail = $("#senderEmail").val();
		var mailServer = $("#mailServer").val();
		var mailPort = $("#mailPort").val();
		var mailPassword = $("#mailPassword").val();
		var mailRetypePassword = $("#mailRetypePassword").val();
		
				
		//Check the inputs
		if( emailSendingMethod == "" || senderName == "" || senderEmail == "" || mailPassword == ""  || mailRetypePassword == ""  ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		//Check server and port
		if( emailSendingMethod == "smtp" && mailServer == "" || emailSendingMethod == "smtp" && mailPort == "" || emailSendingMethod == "smtp" && mailPort == "0"   ) {
			//alert(ALERT_SMTP_SETTINGS);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_SMTP_SETTINGS,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		//Check retype password
		if( mailPassword !=  mailRetypePassword   ) {
			//alert(ALERT_PASSWORD_RETYPE);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_PASSWORD_RETYPE,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
		if( emailSendingMethod == "phpmail" ) {
			mailServer=="NA";
			mailPort==0;
		}
				
		//Update Email Settings Information
			$.ajax({
				data: {
					emailSendingMethod : emailSendingMethod,
					senderName : senderName,
					senderEmail : senderEmail,
					mailServer : mailServer,
					mailPort : mailPort,
					mailPassword : mailPassword
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'generalsettings/updateEmailSettings',
				success: function(result) {
					if(result) {
						$("#mailSettingsUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#mailSettingsUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
							
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
	});
	
	// UPDATE PRODUCT BARCODING SETTINGS 
	$('#updateProductBarcodeSettings').click(function() {
				
		var productBarcodeTechnology = $("#productBarcodeTechnology").val();
		var productBarcodeType = $("#productBarcodeType").val();
		var paperSize = $("#paperSize").val();
		var paperOrientation = $("#paperOrientation").val();
		var marginTop = $("#marginTop").val();
		var marginBottom = $("#marginBottom").val();
		var marginLeft = $("#marginLeft").val();
		var marginRight = $("#marginRight").val();
		var barcodesPerRow = $("#barcodesPerRow").val();
		var barcodesPerCol = $("#barcodesPerCol").val();
		var barcodePadding = $("#barcodePadding").val();
		
				
		//Check the inputs
		if( productBarcodeTechnology == "" || productBarcodeType == "" || paperSize == "" || paperOrientation == ""  || marginTop == "" || marginBottom == "" || marginLeft == "" || marginRight == ""  || barcodesPerRow == "" || barcodesPerCol == ""  || barcodePadding == "" ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}	
		//Update Barcode Settings Information
			$.ajax({
				data: {
					productBarcodeTechnology : productBarcodeTechnology,
					productBarcodeType : productBarcodeType,
					paperSize : paperSize,
					paperOrientation : paperOrientation,
					marginTop : marginTop,
					marginBottom : marginBottom,
					marginLeft : marginLeft,
					marginRight : marginRight,
					barcodesPerRow : barcodesPerRow,
					barcodesPerCol : barcodesPerCol,
					barcodePadding : barcodePadding
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'generalsettings/updateProductBarcodeSettings',
				success: function(result) {
					if(result) {
						$("#ProductBarcodeSettingsUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#ProductBarcodeSettingsUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
							
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
	});
	
	// UPDATE PACKAGE BARCODE SETTINGS 
	$('#updatePackageBarcodeSettings').click(function() {
				
		var packBarcodeTechnology = $("#packBarcodeTechnology").val();
		var packBarcodeType = $("#packBarcodeType").val();
		var packPaperSize = $("#packPaperSize").val();
		
				
				
		//Check the inputs
		if( packBarcodeTechnology == "" || packBarcodeType == "" || packPaperSize == "") {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
				
		//Update LOcal Settings Information
			$.ajax({
				data: {
					packBarcodeTechnology : packBarcodeTechnology,
					packBarcodeType : packBarcodeType,
					packPaperSize : packPaperSize
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'generalsettings/updatePackBarcodeSettings',
				success: function(result) {
					if(result) {
						$("#packageBarcodeSettingsUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#packageBarcodeSettingsUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
							
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
	});
	
	// UPDATE PRODUCT QR CODE SETTINGS 
	$('#updateProductQrSettings').click(function() {
				
		var qrEccLevel = $("#ecc_level").val();
		var qrSize = $("#qr_size").val();
				
		//Check the inputs
		if( qrEccLevel == "" || qrSize == "") {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		}
				
		//Update Product QR Code Settings
			$.ajax({
				data: {
					qrEccLevel : qrEccLevel,
					qrSize : qrSize
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'generalsettings/updateProductQrSettings',
				success: function(result) {
					if(result) {
						$("#productQrSettingsUpdateResult").html('<span class="text-success"><i class="fa fa-check-circle"></i> '+result+'</span>');
					}else {
						$("#productQrSettingsUpdateResult").html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '+ALERT_UPDATE_FAIL+'</span>');
					}
							
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
	});
	
	// INSTALL DEMO DATA
	$('#installdemoData').click(function() {
		
			$.ajax({
				data: {
				},
				type: 'POST',
				dataType: 'json',
				beforeSend: function(){
					$("#installdemoData").prop('disabled', true);
					$("#demoModal_close1").prop('disabled', true);
					$("#demoModal_close2").prop('disabled', true);
					$("#installDemo_warningMsg").addClass("div-hidden");
					$("#demoInstallationMessage").removeClass("div-hidden");
					$("#demoInstallProcess").html(MSG_INITIALISING_DEMO);
				},
				url: base_url+'global_controller/clearOldData',
				success: function(result) {
					if(result=="dataempty") {
						$("#demoInstallProcess").append(MSG_OLD_DATA_CLEARED);
						$("#demoInstallProcess").append(MSG_COPY_DEMO_DATA);
						// copying demo data
						$.ajax({
							data: {
							},
							type: 'POST',
							dataType: 'json',
							url: base_url+'global_controller/installDemoData',
							success: function(datacopyresult) {
								if(datacopyresult=="datainserted") {
									$("#demoInstallProcess").append(MSG_DEMO_DATA_INSERTED);
									// copying demo data
									$.ajax({
										data: {
										},
										type: 'POST',
										dataType: 'json',
										url: base_url+'global_controller/copyfolderdata',
										success: function(filecopyresult) {
											$("#demoInstallProcess").append(filecopyresult);
											$("#demoInstallProcess").append(MSG_DEMO_DATA_FINISH_INSERT);
										},
										error: function(xhr, status, error){
											var errorMessage = xhr.status + ': ' + xhr.statusText
											alert('Error - ' + errorMessage);
										}
									});
									
									
									
								}else {
									$("#demoInstallProcess").append(MSG_ERROR_COPYING_DEMO_DATA);
								}
										
							},
							error: function(xhr, status, error){
								var errorMessage = xhr.status + ': ' + xhr.statusText
								alert('Error - ' + errorMessage);
							}
						});
						
					}else {
						$("#demoInstallProcess").append(MSG_ERROR_INSERTING_DEMO_DATA);
					}
							
				},
				complete:function(data){
					
					$("#installdemoData").prop('disabled', false);
					$("#demoModal_close1").prop('disabled', false);
					$("#demoModal_close2").prop('disabled', false);
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
	});
	
// ADD NEW CURRENCY FROM GENERAL SETTINGS PAGE
	$('#newCurrency_save').click(function() {
		
		var currencySymbol = $("#newCurrency_symbol").val();
		var currencyCode = $("#newCurrency_code").val();
		var currencyName = $("#newCurrency_name").val();
		
		//Check the inputs
		if(currencySymbol =='' || currencyCode =='' || currencyName =='') {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			$("#newCurrency_symbol").focus();
			return false;
		}
				
		//SAVE New UNit
			$.ajax({
				data: {
					currencySymbol    : currencySymbol,
					currencyCode    : currencyCode,
					currencyName    : currencyName
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'generalsettings/saveNewCurrency',
				success: function(result) {
					alert(ALERT_CURRENCY_ADDED_SUCCESS);
					$('#addNewCurrencyModal').modal('hide');
					loadSelectOptions("#defaultCurrency", "currencies", "id", "curr_symbol");
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// CHECK IF MAIL() FUNCTION IS ENABLED
	$('#emailSendingMethod').change(function() {
		
		var emailMethod = $("#emailSendingMethod").val();
		//$("#packageBarcode_clientShipAdr").val("");
		
		//Check the inputs
		if(emailMethod =="" ) {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			return false;
		} 
		//Add the shipping address
			$.ajax({
				data: {
					emailMethod    : emailMethod
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'generalsettings/checkMailFunction',
				success: function(result) {
					
					if(result=='enabled') {
						$("#mailServer").prop('disabled', true);
						$("#mailPort").prop('disabled', true);
						$("#mailPassword").prop('disabled', true);
						$("#mailRetypePassword").prop('disabled', true);
						$("#testSmtpServer").prop('disabled', true);
						$("#testMailMethod").html('<div class="text-success"><i class="fa fa-check-circle"></i>'+ALERT_PHP_MAIL_ENABLED+'</div>');
					} else if(result=='disabled') {
						$("#mailServer").prop('disabled', false);
						$("#mailPort").prop('disabled', false);
						$("#mailPassword").prop('disabled', false);
						$("#mailRetypePassword").prop('disabled', false);
						$("#testSmtpServer").prop('disabled', true);
						$("#testMailMethod").html('<div class="text-danger"><i class="fa fa-exclamation-triangle"></i>'+ALERT_PHP_MAIL_DISABLED+'</div>');
					} else {
						$("#mailServer").prop('disabled', false);
						$("#mailPort").prop('disabled', false);
						$("#mailPassword").prop('disabled', false);
						$("#mailRetypePassword").prop('disabled', false);
						$("#testSmtpServer").prop('disabled', false);
						$("#testMailMethod").html('');
					}
					
					
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	// TEST SMTP CONNECTION
	$('#testSmtpServer').click(function() {
		
		var smtpServer = $("#mailServer").val();
		var smtpPort = $("#mailPort").val();
		var senderName = $("#senderName").val();
		var senderMail = $("#senderEmail").val();
		var senderPassword = $("#mailPassword").val();

		
		
		
		//Check the inputs
		if(smtpServer =='' || smtpPort =='' || senderName =='' || senderMail =='' || senderPassword =='') {
			//alert(ALERT_FIELD_EMPTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_FIELD_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			$("#smtpServer").focus();
			return false;
		}
				
		//SAVE New UNit
			$.ajax({
				data: {
					smtpServer   	: smtpServer,
					smtpPort    	: smtpPort,
					senderName    	: senderName,
					senderMail    	: senderMail,
					senderPassword 	: senderPassword
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'generalsettings/testSmtpConnection',
				success: function(result) {
					$("#smtpTestReport").html(result);
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		});	
		// BACKUP FILES
		$('#createbackupfiles').click(function() {
			$.ajax({
				data: {
				},
				type: 'POST',
				dataType: 'json',
				beforeSend: function(){
					$("#createbackupfiles").prop('disabled', true);
					$("#createbackupfiles").html("Backup in progress. Please wait...");
				},
				url: base_url+'backup/createFilesBackup',
				success: function(result) {
					//alert(result);
					if(result=='extensionNotLoaded'){
						$("#backupfileResult").html('<div class="text-danger mt-3"><i class="fa fa-exclamation-triangle"></i> Extension zip must be loaded!</div>');
					} else if(result=='pathNotValid'){ 
						$("#backupfileResult").html('<div class="text-danger mt-3"><i class="fa fa-exclamation-triangle"></i> Unable to identify source folder/file!</div>');
					} else if(result=='success'){ 
						$("#backupfileResult").html('<div class="text-success mt-3"><i class="fa fa-check-circle"></i> Backup created successfully!</div>');
					} else {
						$("#backupfileResult").html('<div class="text-danger mt-3"><i class="fa fa-exclamation-triangle"></i> Error occurred while creating the backup. Please try again!</div>');
					}
							
				},
				complete:function(data){
					$("#createbackupfiles").html('<i class="fa fa-hdd-o"></i> Create Backup of Files');
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
				
		});
			
	// ADD NEW USER TYPE FROM USER CREATING PAGE
   
	$('#newUserTypeSave').click(function() {
		
		alert("OK");
		var userTypeName = $("#newUserTypeName").val();
		var userTypeDescription = $("#newUserTypeDescription").val();
		
		
		//Check the inputs
		if(userTypeName =='') {
			//alert(ALERT_CODE_NOT_FILLED);
			Swal.fire({
					title: ALERT_alert,
					text: ALERT_USER_TYPE_NAME_EMPTY,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
			$("#newUserTypeName").focus();
			return false;
		}
				
		//SAVE New User Type
			$.ajax({
				data: {
					userTypeName          : userTypeName
					userTypeDescription   : userTypeDescription
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'user/saveNewUserType',
				success: function(result) {
					if(result) {
						alert(ALERT_US_TYP_ADDED_SUCCESS);
						$('#addNewUserTypeModal').modal('hide');
						loadSelectOptions("#new_user_user_type", "user_types", "id", "user_type");
					} else {
						alert("error occurred");
					}
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
	});
	
	
	
	
	

	
	
	
	
});

//SAVE INVENTORY PHYSICAL QUANTITY
function savePhysicalInventory(indice) {
	/* Product Id */
		var pr = "#physInv_prId"+(indice);
		var productId = $(pr).val();
		/* Inventory Id */
		var inv = "#physInvId"+(indice);
		var invId = $(inv).val();
		/* Physical Qty */
		var physQtyId = "#productPhysInv"+(indice);
		var physQty   = $(physQtyId).val();
		
		if(physQty=='' ) {
			//alert(ALERT_EMPTY_PHYS_QTY);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_EMPTY_PHYS_QTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			$(physQtyId).focus();
		} else {
			$.ajax({
				data: {
					invId     : invId,
					productId : productId,
					invQty    : physQty
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'inventory/addPhysicalInventory',
				success: function(result) {
					window.location.href = base_url+'inventory/physical-inventory';
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		}
}

//EDIT INVENTORY PHYSICAL QUANTITY
function editPhysicalInventory(indice) {
	/* Product Id */
		var productId = indice;
		$("#editPhysQtyProductId").val(productId);
		/* Inventory Id */
		var invId = $("#inventoryList").val();
		// GET INVENTORY DETAILS
			$.ajax({
				data: {
					invId     : invId,
					productId : productId
				},
				type: 'POST',
				dataType: 'json',
				url: base_url+'inventory/getInventoryDetails',
				success: function(result) {
					$("#editPhysQtyProductName").val(result.productName);
					$("#editPhysQtyProductBarcode").val(result.productBarcode);
					$("#editPhysQtyStock").val(result.stock);
					$("#editPhysQtyPhysQty").val(result.physQty);
					
					
				},
				error: function(xhr, status, error){
					var errorMessage = xhr.status + ': ' + xhr.statusText
					alert('Error - ' + errorMessage);
				}
			});
		
}


//ADJUST INVENTORY
function adjustInventory(indice) {
	/* Product Id */
		var productId = indice;
		/* Inventory Id */
		var invId = $("#inventoryList").val();
		job=confirm(ALERT_ADJUST_INVENTORY);
			if(job!=true){
				//cancel the action of adjusting the stock
				return false;
			} else {
				//adjust stock
				$.ajax({
					data: {
						productId    : productId,
						invId        : invId
					},
					type: 'POST',
					dataType: 'json',
					url: base_url+'inventory/adjustInventory',
					success: function(result) {
						var htmlContent = ADJUST_INVENTORY_SUCCESS+'<br/><span class="text-danger small text-left"><b><i class="fa fa-exclamation-triangle"></i> '+IMPORTANT_NOTE+'</b><br/>'+CHECK_REAL_STORAGE_POS+CHECK_REAL_STORAGE_STEPS;
						
						if(result =='done') {
							Swal.fire({
								title: ADJUST_INVENTORY,
								html: htmlContent,
								icon: "success",
								button: "OK",
								allowEscapeKey: false,
								allowEnterKey: false,
								allowOutsideClick: false,
							}).then((result) => {
								window.location.href = base_url+'inventory/physical-inventory';
							});
						} else {
							Swal.fire({
								title: ADJUST_INVENTORY,
								text: ADJUST_INVENTORY_FAILURE,
								icon: "warning",
								button: "OK",
								allowEscapeKey: false,
								allowEnterKey: false,
								allowOutsideClick: false,
							}).then((result) => {
								window.location.href = base_url+'inventory/physical-inventory';
							});
						}
						
					},
					error: function(xhr, status, error){
						var errorMessage = xhr.status + ': ' + xhr.statusText
						alert('Error - ' + errorMessage);
					}
				});
			}
		
}

//DISPLAY STORAGE LOCATIONS OF A PRODUCT TO CHOOSE THE VOLUME TO BE PICKED  -- TRANSFER --
function manageTransferVolumes(transferId, productId) {
	
	// GET DETAILS
		$.ajax({
			data: {
				transferId     : transferId,
				productId      : productId
			},
			type: 'POST',
			dataType: 'json',
			url: base_url+'transfer/getproductDetailsFromTransfer',
			success: function(result) {
				$("#pickupTransfer_trCode").val(result.transferCode);
				$("#pickupTransfer_trDate").val(result.transferDate);
				$("#pickupTransfer_prId").val(productId);
				$("#pickupTransfer_prBarcode").val(result.productBarcode);
				$("#pickupTransfer_prName").val(result.productName);
				$("#pickupTransfer_prQty").val(result.qty);
				$("#pickupTransfer_prVolume").val(result.productVolume);
				$("#transferProductVolumeList tbody").html(result.storagepos);
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
		});
		
}

//CALCULATE REMAINING VOLUME -- TRANSFER STORAGE LOCATIONS
function calculateRemainingVolume() {
	
	// Volume of the product subject to the current pickup
	var productVolume = $('#pickupTransfer_prVolume').val();
	// Volume of a each shelf containing the current product
	var shelfVolume = document.getElementsByName('shelfPrVolume[]');  
	// Volume to be picked up from the shelf
	var pickedVolume = document.getElementsByName('pickedVolume[]');
	// Remaining Volume in the shelf 
	var shelfRemainingVolume = document.getElementsByName('remainingVolume[]');
	// get the number of the rows of the table
	var tbody = document.querySelector("#transferProductVolumeList tbody");
	// get the checkbox
	var chks = document.getElementsByName('chosenVolumes[]');
	var nbRows = tbody.querySelectorAll("tr").length;
	var totalPickedVolume = 0;
	// check if the product volume is set 
	if(productVolume ==0 || productVolume =='') {
		//alert(ALERT_VOLUME_EMPTY);
		Swal.fire({
				title: ALERT_alert,
				text: ALERT_VOLUME_EMPTY,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
		$('#pickupTransfer_prVolume').focus();
		return false;
	}
	for ( i=0; i<nbRows; i++) {
		var pickedVolumeElement
		if(pickedVolume[i].value =='') {
			pickedVolumeElement = 0;
		} else {
			pickedVolumeElement = parseFloat(pickedVolume[i].value);
		}
		totalPickedVolume = totalPickedVolume + pickedVolumeElement ;
		//check if the total of the volume entered still less or equal to the volume to be picked up
		if(totalPickedVolume > (productVolume+0.01)) {
			//alert(ALERT_PICKED_VOLUME_OVER);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_PICKED_VOLUME_OVER,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			pickedVolume[i].value='';
			chks[i].checked = false;
			return false;
		} else {
			var remaingVolume = parseFloat(productVolume)-totalPickedVolume;
			var shRemVol = parseFloat(shelfVolume[i].value) - parseFloat(pickedVolume[i].value);
			shelfRemainingVolume[i].value = shRemVol.toFixed(2);
			
				//check if volume of the selected shelf can fit the volume entered
				if(parseFloat(shelfRemainingVolume[i].value) <0) {
					//Volume picked up is greater than the shelf volume ==> ERROR
					//alert(ALERT_PICKED_VOLUME_OVER_2);
					Swal.fire({
						title: ALERT_alert,
						text: ALERT_PICKED_VOLUME_OVER_2,
						icon: "warning",
						button: "OK",
						allowEscapeKey: false,
						allowEnterKey: false,
						allowOutsideClick: false,
					});
					pickedVolume[i].value='';
					shelfRemainingVolume[i].value='';
					chks[i].checked = false;
					return false;
				} else {
					if(remaingVolume >= 0) {
						//Volume picked up is less than the shelf volume ==> OK
						$("#prRemainingVolume").val(remaingVolume.toFixed(2));
					} else {
						//alert(ALERT_PICKED_VOLUME_OVER_3);
						Swal.fire({
							title: ALERT_alert,
							text: ALERT_PICKED_VOLUME_OVER_3,
							icon: "warning",
							button: "OK",
							allowEscapeKey: false,
							allowEnterKey: false,
							allowOutsideClick: false,
						});
						pickedVolume[i].value='';
						shelfRemainingVolume[i].value='';
						chks[i].checked = false;
						return false;
					}
				}
				if (pickedVolume[i].value=='' || pickedVolume[i].value==0){
					chks[i].checked = false;
				} else {
					chks[i].checked = true;
				}
			
			
		}
	}
		
	
}

//DISPLAY STORAGE LOCATIONS OF A PRODUCT TO CHOOSE THE VOLUME TO BE PICKED -- DELIVERY --
function manageDeliveryVolumes(deliveryId, productId) {
	
	// GET DETAILS
		$.ajax({
			data: {
				deliveryId     : deliveryId,
				productId      : productId
			},
			type: 'POST',
			dataType: 'json',
			url: base_url+'delivery/getproductDetailsFromDelivery',
			
			success: function(result) {
				$("#pickupDelivery_deliveryCode").val(result.deliveryCode);
				$("#pickupDelivery_deliveryDate").val(result.deliveryDate);
				$("#pickupDelivery_prId").val(productId);
				$("#pickupDelivery_prBarcode").val(result.productBarcode);
				$("#pickupDelivery_prName").val(result.productName);
				$("#pickupDelivery_prQty").val(result.qty);
				$("#pickupDelivery_prVolume").val(result.productVolume);
				$("#DeliveryProductVolumeList tbody").html(result.storagepos);
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
		});
		
	// GET LAST INVENTORY ID
		$.ajax({
			data: {
			},
			type: 'POST',
			dataType: 'json',
			url: base_url+'inventory/getLastInventoryId',
			
			success: function(result) {
				var lastInvId = parseFloat(result)+1;
				$("#pickupDelivery_InventoryId").val(lastInvId);
			},
			error: function(xhr, status, error){
				var errorMessage = xhr.status + ': ' + xhr.statusText
				alert('Error - ' + errorMessage);
			}
		});
		
}

//CALCULATE REMAINING VOLUME -- DELIVERY STORAGE LOCATIONS
function calculateDeliveryRemainingVolume() {
	
	// Volume of the product subject to the current pickup
	var productVolume = $('#pickupDelivery_prVolume').val();
	// Volume of a each shelf containing the current product
	var shelfVolume = document.getElementsByName('shelfPrVolume[]');  
	// Volume to be picked up from the shelf
	var pickedVolume = document.getElementsByName('pickedVolume[]');
	// Remaining Volume in the shelf 
	var shelfRemainingVolume = document.getElementsByName('remainingVolume[]');
	// get the number of the rows of the table
	var tbody = document.querySelector("#DeliveryProductVolumeList tbody");
	// get the checkbox
	var chks = document.getElementsByName('chosenVolumes[]');
	var nbRows = tbody.querySelectorAll("tr").length;
	var totalPickedVolume = 0;
	// check if the product volume is set 
	if(productVolume ==0 || productVolume =='') {
		//alert(ALERT_VOLUME_EMPTY);
		Swal.fire({
			title: ALERT_alert,
			text: ALERT_VOLUME_EMPTY,
			icon: "warning",
			button: "OK",
			allowEscapeKey: false,
			allowEnterKey: false,
			allowOutsideClick: false,
		});
		$('#pickupDelivery_prVolume').focus();
		return false;
	}
	for ( i=0; i<nbRows; i++) {
		var pickedVolumeElement
		if(pickedVolume[i].value =='') {
			pickedVolumeElement = 0;
		} else {
			pickedVolumeElement = parseFloat(pickedVolume[i].value);
		}
		totalPickedVolume = totalPickedVolume + pickedVolumeElement ;
		//check if the total of the volume entered still less or equal to the volume to be picked up
		if(totalPickedVolume > (productVolume+0.01)) {
			//alert(ALERT_PICKED_VOLUME_OVER);
			Swal.fire({
				title: ALERT_alert,
				text: ALERT_PICKED_VOLUME_OVER,
				icon: "warning",
				button: "OK",
				allowEscapeKey: false,
				allowEnterKey: false,
				allowOutsideClick: false,
			});
			pickedVolume[i].value='';
			chks[i].checked = false;
			return false;
		} else {
			var remaingVolume = parseFloat(productVolume)-totalPickedVolume;
			var shRemVol = parseFloat(shelfVolume[i].value) - parseFloat(pickedVolume[i].value);
			shelfRemainingVolume[i].value = shRemVol.toFixed(2);
			//check if volume of the selected shelf can fit the volume entered
			if(parseFloat(shelfRemainingVolume[i].value) <0) {
				//Volume picked up is greater than the shelf volume ==> ERROR
				//alert(ALERT_PICKED_VOLUME_OVER_2);
				Swal.fire({
					title: ALERT_alert,
					text: ALERT_PICKED_VOLUME_OVER_2,
					icon: "warning",
					button: "OK",
					allowEscapeKey: false,
					allowEnterKey: false,
					allowOutsideClick: false,
				});
				pickedVolume[i].value='';
				shelfRemainingVolume[i].value='';
				chks[i].checked = false;
				return false;
			} else {
				
				if(remaingVolume >= 0) {
						//Volume picked up is less than the shelf volume ==> OK
						$("#DeliveryPrRemainingVolume").val(remaingVolume.toFixed(2));
					} else {
						
						Swal.fire({
							title: ALERT_alert,
							text: ALERT_PICKED_VOLUME_OVER_4,
							icon: "warning",
							button: "OK",
							allowEscapeKey: false,
							allowEnterKey: false,
							allowOutsideClick: false,
						});
						pickedVolume[i].value='';
						shelfRemainingVolume[i].value='';
						chks[i].checked = false;
						return false;
					}
			}
			if (pickedVolume[i].value=='' || pickedVolume[i].value==0){
				chks[i].checked = false;
			} else {
				chks[i].checked = true;
			}
			
		}
	}
		
	
}

//FUNCTION TO PRINT A SPECIFIC CONTENT
function printPackingList() {
	
	$("#noPrintPackingList").hide();
	window.print();
	$("#noPrintPackingList").show();
}

//Print Product Barcodes
function printProductBarcodes() {
    var divContents = document.getElementById("productBarcodesView").innerHTML;
	var a = window.open('', '', 'height=500, width=500');
	a.document.write('<html>');
	a.document.write('<body >');
	a.document.write(divContents);
	a.document.write('</body></html>');
	a.document.close();
	a.print();
}

//Print Package Barcode
function printPackageBarcode() {
   
	var printContents = document.getElementById("packageBarcodesView").innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}


		














// Custom Sidebar JS
jQuery(function ($) {

	// Dropdown menu
	$(".sidebar-dropdown > a").click(function () {
		$(".sidebar-submenu").slideUp(200);
		if ($(this).parent().hasClass("active")) {
			$(".sidebar-dropdown").removeClass("active");
			$(this).parent().removeClass("active");
		} else {
			$(".sidebar-dropdown").removeClass("active");
			$(this).next(".sidebar-submenu").slideDown(200);
			$(this).parent().addClass("active");
		}
	});



	//toggle sidebar
	$("#toggle-sidebar").click(function () {
		$(".page-wrapper").toggleClass("toggled");
	});



	// Pin sidebar on click
	$("#pin-sidebar").click(function () {
		if ($(".page-wrapper").hasClass("pinned")) {
			// unpin sidebar when hovered
			$(".page-wrapper").removeClass("pinned");
			$("#sidebar").unbind( "hover");
		} else {
			$(".page-wrapper").addClass("pinned");
			$("#sidebar").hover(
				function () {
					console.log("mouseenter");
					$(".page-wrapper").addClass("sidebar-hovered");
				},
				function () {
					console.log("mouseout");
					$(".page-wrapper").removeClass("sidebar-hovered");
				}
			)
		}
	});



	// Pinned sidebar
	$(function() {
		$(".page-wrapper").hasClass("pinned");
		$("#sidebar").hover(
			function () {
				console.log("mouseenter");
				$(".page-wrapper").addClass("sidebar-hovered");
			},
			function () {
				console.log("mouseout");
				$(".page-wrapper").removeClass("sidebar-hovered");
			}
		)
	});




	// Toggle sidebar overlay
	$("#overlay").click(function () {
		$(".page-wrapper").toggleClass("toggled");
	});



	// Added by Srinu 
	$(function(){
		// When the window is resized, 
		$(window).resize(function(){
			// When the width and height meet your specific requirements or lower
			if ($(window).width() <= 768){
				$(".page-wrapper").removeClass("pinned");
			}
		});
		// When the window is resized, 
		$(window).resize(function(){
			// When the width and height meet your specific requirements or lower
			if ($(window).width() >= 768){
				$(".page-wrapper").removeClass("toggled");
			}
		});
	});
	
	
	
	
	
	


});