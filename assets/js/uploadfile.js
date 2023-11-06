//add new product picture
$(document).on("click", ".addProductPicture", function() {
  var file = $(this).parents().find(".addProductPicture");
  file.trigger("click");
});
$('input[name="productFile"]').change(function(e) {
  var fileName = e.target.files[0].name;
  //$("#file").val(fileName);

  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("addProductImage").src = e.target.result;
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
});
//Edit product picture
$(document).on("click", ".editProductPicture", function() {
  var file = $(this).parents().find(".editProductPicture");
  file.trigger("click");
});
$('input[name="productFileEdit"]').change(function(e) {
  var fileName = e.target.files[0].name;
  //$("#filefav").val(fileName);

  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("editProductImage").src = e.target.result;
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
});

//add new user picture
$(document).on("click", ".addUserPicture", function() {
  var file = $(this).parents().find(".addUserPicture");
  file.trigger("click");
});
$('input[name="userImageFile"]').change(function(e) {
  var fileName = e.target.files[0].name;
  //$("#file").val(fileName);

  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("addUserImage").src = e.target.result;
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
});

//Application Logo
$(document).on("click", ".application-logo", function() {
  var file = $(this).parents().find(".application-logo");
  file.trigger("click");
});
$('input[name="applicationLogo"]').change(function(e) {
	var fileName = e.target.files[0].name;
	//check extensions
	var appLogoFile = document.getElementById("applicationLogo");
	var logoFileName= appLogoFile.files[0].name;
	var logoExt = logoFileName.substring(logoFileName.lastIndexOf('.') + 1, logoFileName.length);
	//Check authorized extensions for Logo
	if( logoExt.toLowerCase() != "jpg" && logoExt.toLowerCase() != "png" && logoExt.toLowerCase() != "gif" && logoExt.toLowerCase() != "jpeg"   ) 
	{
		Swal.fire({
			title: ALERT_alert,
			text: ALERT_LOGO_EXT,
			icon: "warning",
			button: "OK",
			allowEscapeKey: false,
			allowEnterKey: false,
			allowOutsideClick: false,
		});
		 $('#applicationLogo').val('');
		return false;
	}

	var reader = new FileReader();
	reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("appLogoImage").src = e.target.result;
	};
	// read the image file as a data URL.
	reader.readAsDataURL(this.files[0]);
	// upload the file
	var fd = new FormData();
	var files = $('#applicationLogo')[0].files[0];
	fd.append('file', files);
	$.ajax({
		url: base_url+'GeneralSettings/uploadFileAjax',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            if(response != "notuploaded"){
                $('#encryptedLogo').val(response.replace(/^"(.*)"$/, '$1'));
            }
            else{
                $('#encryptedLogo').val('');
            }
        },
	});
});

//Application Favicon
$(document).on("click", ".application-favicon", function() {
  var file = $(this).parents().find(".application-favicon");
  file.trigger("click");
});
$('input[name="applicationFavicon"]').change(function(e) {
  var fileName = e.target.files[0].name;
  //check extensions
	var appFaviconFile = document.getElementById("applicationFavicon");
	var favFileName= appFaviconFile.files[0].name;
	var faviconExt = favFileName.substring(favFileName.lastIndexOf('.') + 1, favFileName.length);
	
	//Check authorized extensions for Favicon
	if( faviconExt.toLowerCase() != "ico"   ) {
		Swal.fire({
			title: ALERT_alert,
			text: ALERT_FAVICON_EXT,
			icon: "warning",
			button: "OK",
			allowEscapeKey: false,
			allowEnterKey: false,
			allowOutsideClick: false,
		});
		$('#applicationFavicon').val('');
		return false;
	}

  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("appFaviconImage").src = e.target.result;
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
  // Upload the Favicon Image
  var fd = new FormData();
    var files = $('#applicationFavicon')[0].files[0];
    fd.append('file', files);
    $.ajax({
		url: base_url+'GeneralSettings/uploadFileAjax',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            if(response != "notuploaded"){
                $('#encryptedFavicon').val(response.replace(/^"(.*)"$/, '$1'));
            }
            else{
                $('#encryptedFavicon').val('');
            }
        },
	});
});