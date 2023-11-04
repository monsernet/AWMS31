// Basic DataTable
$(function(){
	$('#basicExample').DataTable({
		'iDisplayLength': 4,
		"language": {
			"lengthMenu": DT_DISPLAY+"_MENU_"+DT_RECORDS,
			"info": DT_SHOWING+"_PAGE_"+DT_OF+"_PAGES_",
		}
	});
	
});



// FPrint/Copy/CSV
$(function(){
	$('#copy-print-csv').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			{ extend: 'copyHtml5', text: '<i class="fa fa-copy"></i> '+DT_COPY_ROWS },
			{ extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i> '+DT_EXPORT_EXCEL },
			{ extend: 'csvHtml5', text: '<i class="fa fa-file-excel-o"></i> '+DT_EXPORT_CSV },
			{ extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf-o"></i> '+DT_EXPORT_PDF },
			{ extend: 'print', text: '<i class="fa fa-print"></i> '+DT_PRINT }
		],
		'iDisplayLength': 5,
	});
});


// Fixed Header
$(document).ready(function(){
	var table = $('#fixedHeader').DataTable({
		fixedHeader: true,
		'ordering': false,
		'iDisplayLength': 10,
		"language": {
			"lengthMenu": DT_DISPLAY+"_MENU_"+DT_RECORDS,
			"info": DT_SHOWING+"_PAGE_"+DT_OF+"_PAGES_",
			"search": DT_SEARCH,
			"paginate": {
				"previous": DT_PREVIOUS,
				"next": DT_NEXT,
			}
		},
		dom: 'Bfrtip',
		buttons: [
			{ extend: 'copyHtml5', text: '<i class="fa fa-copy"></i> '+DT_COPY_ROWS },
			{ extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i> '+DT_EXPORT_EXCEL },
			{ extend: 'csvHtml5', text: '<i class="fa fa-file-excel-o"></i> '+DT_EXPORT_CSV },
			{ extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf-o"></i> '+DT_EXPORT_PDF },
			{ extend: 'print', text: '<i class="fa fa-print"></i> '+DT_PRINT }
		],
	});
	
	var storPosTable = $('#prStorPos').DataTable({
		fixedHeader: true,
		'iDisplayLength': 10,
		"language": {
			"lengthMenu": DT_DISPLAY+"_MENU_"+DT_RECORDS,
			"info": DT_SHOWING+"_PAGE_"+DT_OF+"_PAGES_",
			"paginate": {
				"previous": DT_PREVIOUS,
				"next": DT_NEXT,
			}
		},
		dom: 'Bfrtip',
		buttons: [
			{ extend: 'copyHtml5', text: '<i class="fa fa-copy"></i> '+DT_COPY_ROWS },
			{ extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i> '+DT_EXPORT_EXCEL },
			{ extend: 'csvHtml5', text: '<i class="fa fa-file-excel-o"></i> '+DT_EXPORT_CSV },
			{ extend: 'pdfHtml5', text: '<i class="fa fa-file-pdf-o"></i> '+DT_EXPORT_PDF },
			{ extend: 'print', text: '<i class="fa fa-print"></i> '+DT_PRINT }
		],
	});
	
});


// Vertical Scroll
$(function(){
	$('#scrollVertical').DataTable({
		"scrollY": "207px",
		"scrollCollapse": true,
		"paging": false,
		"bInfo" : false,
	});
});



// Row Selection
$(function(){
	$('#rowSelection').DataTable({
		'iDisplayLength': 4,
		"language": {
			"lengthMenu": DT_DISPLAY+"_MENU_"+DT_RECORDS,
			"info": DT_SHOWING+"_PAGE_"+DT_OF+"_PAGES_",
		}
	});
	var table = $('#rowSelection').DataTable();

	$('#rowSelection tbody').on( 'click', 'tr', function () {
		$(this).toggleClass('selected');
	});

	$('#button').on('click', function () {
		alert( table.rows('.selected').data().length +DT_ROWS_SELECTED );
	});
});



// Highlighting rows and columns
$(function(){
	$('#highlightRowColumn').DataTable({
		'iDisplayLength': 4,
		"language": {
			"lengthMenu": DT_DISPLAY+"_MENU_"+DT_RECORDS,
		}
	});
	var table = $('#highlightRowColumn').DataTable();  
	$('#highlightRowColumn tbody').on('mouseenter', 'td', function (){
		var colIdx = table.cell(this).index().column;
		$(table.cells().nodes()).removeClass('highlight');
		$(table.column(colIdx).nodes()).addClass('highlight');
	});
});



// Using API in callbacks
$(function(){
	$('#apiCallbacks').DataTable({
		'iDisplayLength': 4,
		"language": {
			"lengthMenu": DT_DISPLAY+"_MENU_"+DT_RECORDS,
		},
		"initComplete": function(){
			var api = this.api();
			api.$('td').on('click', function(){
			api.search(this.innerHTML).draw();
		});
		}
	});
});


// Hiding Search and Show entries
$(function(){
	$('#hideSearchExample').DataTable({
		'iDisplayLength': 4,
		"searching": false,
		"language": {
			"lengthMenu": DT_DISPLAY+"_MENU_"+DT_RECORDS,
			"info": DT_SHOWING+"_PAGE_"+DT_OF+"_PAGES_",
		}
	});
});
