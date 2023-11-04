			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('general_settings'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="card">
							<div class="card-body txtMedium">
								<div class="list-group " id="myTab" role="tablist">
										<a class="list-group-item active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><h6><span class="icon-home"></span>  | <?php echo $this->lang->line('company_information'); ?></h6></a>
										<a class="list-group-item" id="application-tab" data-toggle="tab" href="#application" role="tab" aria-controls="application" aria-selected="false"><h6><span class="icon-airplay"></span> | <?php echo $this->lang->line('application_settings'); ?> </h6></a>
										<a class="list-group-item" id="locale-tab" data-toggle="tab" href="#locale" role="tab" aria-controls="locale" aria-selected="false"><h6><span class="icon-language"></span> | <?php echo $this->lang->line('locale_settings'); ?> </h6></a>
										<a class="list-group-item" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false"><h6><span class="icon-lock"></span>  | <?php echo $this->lang->line('login_sessions'); ?></h6></a>
										<a class="list-group-item" id="emailsettings-tab" data-toggle="tab" href="#emailsettings" role="tab" aria-controls="emailsettings" aria-selected="false"><h6><span class="icon-mail"></span>  | <?php echo $this->lang->line('email_settings'); ?></h6></a>
										<a class="list-group-item" id="productBarcoding-tab" data-toggle="tab" href="#productBarcoding" role="tab" aria-controls="productBarcoding" aria-selected="false"><h6><i class="fa fa-barcode"></i>  | <?php echo $this->lang->line('product_barcoding_settings'); ?></h6></a>
										<a class="list-group-item" id="packBarcoding-tab" data-toggle="tab" href="#packBarcoding" role="tab" aria-controls="packBarcoding" aria-selected="false"><h6><i class="fa fa-barcode"></i>  | <?php echo $this->lang->line('package_barcoding_settings'); ?></h6></a>
										<a class="list-group-item" id="productQrCode-tab" data-toggle="tab" href="#productQrCode" role="tab" aria-controls="productQrCode" aria-selected="false"><h6><i class="fa fa-qrcode"></i>  | <?php echo $this->lang->line('product_qrcode_settings'); ?></h6></a>
										
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<div class="tab-content border border-gray" id="myTabContent">
									
									<!-- ***************** COMPANY INFOAMTION TAB *************** -->
									
									<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										<div class="row">
											<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
												<div class="form-group">
													<label for="companyFullName"><?php echo $this->lang->line('company_fullname'); ?></label>
													<input type="text" class="form-control form-control-sm" name="companyFullName" id="companyFullName" value="<?php echo $companyRow->companyName; ?>" placeholder="<?php echo $this->lang->line('company_fullname'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
												<div class="form-group">
													<label for="companyShortName"><?php echo $this->lang->line('company_shortname'); ?></label>
													<input type="text" class="form-control form-control-sm" name="companyShortName" id="companyShortName" value="<?php echo $companyRow->business_title; ?>" placeholder="<?php echo $this->lang->line('company_shortname'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
												<div class="form-group">
													<label for="companyEmail"><?php echo $this->lang->line('email'); ?></label>
													<input type="email" class="form-control form-control-sm" name="companyEmail" id="companyEmail" value="<?php echo $companyRow->companyEmail; ?>" placeholder="<?php echo $this->lang->line('email'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
												<div class="form-group">
													<label for="companyPhone"><?php echo $this->lang->line('phone'); ?></label>
													<input type="text" class="form-control form-control-sm" name="companyPhone" id="companyPhone" value="<?php echo $companyRow->companyPhone; ?>" placeholder="<?php echo $this->lang->line('phone'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="companyShippingAddress"><?php echo $this->lang->line('shipping_address'); ?></label>
													<textarea class="form-control form-control-sm" name="companyShippingAddress" id="companyShippingAddress"  placeholder="<?php echo $this->lang->line('shipping_address'); ?>" REQUIRED><?php echo $companyRow->shippingAddress; ?></textarea>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="companyBillingAddress"><?php echo $this->lang->line('billing_address'); ?></label>
													<textarea class="form-control form-control-sm" name="companyBillingAddress" id="companyBillingAddress"  placeholder="<?php echo $this->lang->line('billing_address'); ?>" REQUIRED><?php echo $companyRow->companyAddress; ?></textarea>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="companyTaxNumber"><?php echo $this->lang->line('tax_number'); ?></label>
													<input type="text" class="form-control form-control-sm" name="companyTaxNumber" id="companyTaxNumber" value="<?php echo $companyRow->tax_number; ?>" placeholder="<?php echo $this->lang->line('tax_number'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="companyRegisterNumber"><?php echo $this->lang->line('register_number'); ?></label>
													<input type="text" class="form-control form-control-sm" name="companyRegisterNumber" id="companyRegisterNumber" value="<?php echo $companyRow->register_number; ?>" placeholder="<?php echo $this->lang->line('register_number'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="companyCountry"><?php echo $this->lang->line('country'); ?></label>
													<input type="text" class="form-control form-control-sm" name="companyCountry" id="companyCountry" value="<?php echo $companyRow->country; ?>" placeholder="<?php echo $this->lang->line('country'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="companyCity"><?php echo $this->lang->line('city'); ?></label>
													<input type="text" class="form-control form-control-sm" name="companyCity" id="companyCity" value="<?php echo $companyRow->city; ?>" placeholder="<?php echo $this->lang->line('city'); ?>" REQUIRED>
												</div>
											</div>
											<div class="row justify-content-center col-12">
												<button type="button" name="updateCompanyInfos" id="updateCompanyInfos" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_company_info'); ?></button>
												
											</div>
											<div class="row justify-content-center col-12 mt-2">
												<div class="text-center" id="companyUpdateResult"></div>
											</div>
										</div>
										
									</div>
									
									<!-- ***************** APPLICATION SETTINGS TAB *************** -->
									
									<div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application-tab">
										<form method="post" action="" enctype="multipart/form-data">
											<div class="text-header mb-3"><?php echo $this->lang->line('application_settings'); ?></div>
											<div class="row">
												<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
													<div class="form-group">
														<label for="applicationLongName"><?php echo $this->lang->line('application_long_name'); ?></label>
														<textarea  class="form-control form-control-sm" rows="2" name="applicationLongName" id="applicationLongName"  REQUIRED><?php echo $applicationRow->long_name; ?></textarea>
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label for="applicationShortName"><?php echo $this->lang->line('application_short_name'); ?></label>
														<input type="text" class="form-control form-control-sm" name="applicationShortName" id="applicationShortName" value="<?php echo $applicationRow->short_name; ?>"  REQUIRED>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label for="applicationLogo"><?php echo $this->lang->line('application_logo'); ?></label>
														<input type="hidden" value="" name="encryptedLogo"  id="encryptedLogo">
														<input type="file" class="form-control form-control-sm application-logo" name="applicationLogo" id="applicationLogo"   REQUIRED>
														<div id="applicationLogoDiv" >
															<?php 
																if($applicationRow->logo !='' || $applicationRow->logo != NULL) {
																	echo '<img src="'.base_url().'uploads/application/'.$applicationRow->logo.'" class="img-fluid" id="appLogoImage"   />'; 
																} else {
																	echo '<img src="'.base_url().'uploads/application/avatar.png" class="img-fluid" id="appLogoImage"   />'; 
																}
															?>
														</div>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label for="applicationFavicon"><?php echo $this->lang->line('application_favicon'); ?></label>
														<input type="hidden" value="" name="encryptedFavicon"  id="encryptedFavicon">
														<input type="file" class="form-control form-control-sm application-favicon" name="applicationFavicon" id="applicationFavicon"   REQUIRED>
														<div id="applicationFaviconDiv ">
															<?php
																if($applicationRow->favicon !='' || $applicationRow->favicon != NULL) {
																	echo '<img src="'.base_url().'uploads/application/'.$applicationRow->favicon.'" class="img-fluid" id="appFaviconImage"   />'; 
																} else {
																	echo '<img src="'.base_url().'uploads/application/avatar.png" class="img-fluid" id="appFaviconImage"   />'; 
																}
															?>
														</div>
													</div>
												</div>
											</div>
											<div class="text-header mb-3"><?php echo $this->lang->line('google_captcha_settings'); ?> <a href="https://www.iqcomputing.com/support/articles/generate-google-recaptcha-v2-keys/" class="text-danger small ml-5" target="_blank"><span class="icon-light-bulb"></span> How to create Google Recaptcha V2 Keys</a></div>
											<div class="row">
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-check mb-2">
														<input class="form-check-input" type="checkbox" value="" id="useGoogleCaptcha" <?php if($applicationRow->use_captcha=='yes') { echo "checked"; }?>>
														<label class="form-check-label" for="defaultCheck1">
															<?php echo $this->lang->line('use_google_captcha_login'); ?>
														</label>
														<input class="form-control" type="hidden" value="" id="googleCaptchaCheckStatus">
													</div>
												</div>
												
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label > <?php echo $this->lang->line('site_key'); ?></label>
														<input type="text" class="form-control form-control-sm" name="siteKey" id="siteKey" value="<?php echo $applicationRow->site_key; ?>" <?php if($applicationRow->use_captcha=='no') { echo "DISABLED"; }?> >
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label > <?php echo $this->lang->line('secret_key'); ?></label>
														<input type="text" class="form-control form-control-sm" name="secretKey" id="secretKey" value="<?php echo $applicationRow->secret_key; ?>" <?php if($applicationRow->use_captcha=='no') { echo "DISABLED"; }?> >
													</div>
												</div>
												
											</div>
											<div class="row justify-content-center col-12">
												<button type="button" name="updateApplicationSettings" id="updateApplicationSettings" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_application_settings'); ?></button>
												
											</div>
											<div class="row justify-content-center col-12 mt-2">
												<div class="text-center" id="applicationUpdateResult"></div>
											</div>
										</form>
									</div>
									
									<!-- ***************** LOCAL SETTINGS TAB *************** -->
									
									<div class="tab-pane fade" id="locale" role="tabpanel" aria-labelledby="locale-tab">
										<div class="row">
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="defaultLanguage"><?php echo $this->lang->line('default_language'); ?></label>
													<select class="form-control select2" name="defaultLanguage" id="defaultLanguage" REQUIRED>
														<option value=""><?php echo $this->lang->line('select_language'); ?></option>
														<?php foreach($langs as $lang) { ?>
															<option value="<?php echo $lang->id; ?>" <?php if($lang->id==$localSettings->lang) { echo "selected"; }?>>
																<?php echo $lang->lang_name; ?>
															</option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												
											</div>
											<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
												<div class="form-group">
													<label for="default_timezone"><?php echo $this->lang->line('time_zone'); ?></label>
													<select class="form-control select2" name="default_timezone" id="default_timezone" REQUIRED>
														<option value=""><?php echo $this->lang->line('select_timezone'); ?></option>
														<?php foreach($timezones as $tzone) { ?>
															<option value="<?php print $tzone['zone'] ?>" <?php if($localSettings->tzone==$tzone['zone']) { echo "selected"; }?>>
																<?php print $tzone['zone'].' - '.$tzone['diff_from_GMT'];  ?>
															</option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
												<div class="form-group">
													<label for="firstDayOfWeek"><?php echo $this->lang->line('first_day_week'); ?></label>
													<select class="form-control select2" name="firstDayOfWeek" id="firstDayOfWeek" REQUIRED>
														<option value=""><?php echo $this->lang->line('select_firstday'); ?></option>
														<option value="1" <?php if($localSettings->firstDay==1) { echo "selected"; }?>><?php echo $this->lang->line('sunday'); ?></option>
														<option value="2" <?php if($localSettings->firstDay==2) { echo "selected"; }?>><?php echo $this->lang->line('monday'); ?></option>
													</select>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<input class="form_control mr-2 mb-0" type="checkbox" name="autorizeMultiLanguages" id="autorizeMultiLanguages" <?php if($localSettings->multiLang==1) { echo "CHECKED"; }?>>
													<label class="label-disabled" for="autorizeMultiLanguages">
														<?php echo $this->lang->line('autorize_multi_lang'); ?>
													</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="defaultDateFormat"><?php echo $this->lang->line('date_format'); ?></label>
													<select class="form-control select2" name="defaultDateFormat" id="defaultDateFormat" REQUIRED>
														<option value=""><?php echo $this->lang->line('select_format'); ?></option>
														<option value="dd-mm-yyyy" <?php if($localSettings->dateFormat=='dd-mm-yyyy') { echo "selected"; }?>>d-m-Y</option>
														<option value="mm-dd-yyyy" <?php if($localSettings->dateFormat=='mm-dd-yyyy') { echo "selected"; }?>>m-d-Y</option>
														<option value="dd/mm/yyyy" <?php if($localSettings->dateFormat=='dd/mm/yyyy') { echo "selected"; }?>>d/m/Y</option>
														<option value="mm/dd/yyyy" <?php if($localSettings->dateFormat=='mm/dd/yyyy') { echo "selected"; }?>>m/d/Y</option>
														<option value="yyyy-mm-dd" <?php if($localSettings->dateFormat=='yyyy-mm-dd') { echo "selected"; }?>>Y-m-d</option>
														<option value="yyyy/mm/dd" <?php if($localSettings->dateFormat=='yyyy/mm/dd') { echo "selected"; }?>>Y/m/d</option>
													</select>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="defaultTimeFormat"><?php echo $this->lang->line('time_format'); ?></label>
													<select class="form-control select2" name="defaultTimeFormat" id="defaultTimeFormat" REQUIRED>
														<option value=""><?php echo $this->lang->line('select_format'); ?></option>
														<option value="1" <?php if($localSettings->timeFormat==1) { echo "selected"; }?>><?php echo $this->lang->line('24_hr');  ?></option>
														<option value="2" <?php if($localSettings->timeFormat==2) { echo "selected"; }?>><?php echo $this->lang->line('12_hr');  ?></option>
													</select>
												</div>
											</div>
										</div>
										<!-- CURRENCY -->
										<div class="row">
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label for="defaultCurrency"><?php echo $this->lang->line('default_currency'); ?></label>
													<div class="d-flex">
														<select class="form-control select2" name="defaultCurrency" id="defaultCurrency" REQUIRED>
															<option value=""><?php echo $this->lang->line('select_currency'); ?></option>
															<?php foreach($currencies as $curr) { ?>
																<option value="<?php echo $curr->id; ?>" <?php if($localSettings->defaultCurrency==$curr->id) { echo "selected"; }?>><?php echo $curr->curr_code.' ('.$curr->curr_symbol.')'; ?></option>
															<?php } ?>
														</select>
														<button type="button" id="addNewCurrency" class="btn btn-primary btn-sm  ml-2" data-toggle="modal" data-target="#addNewCurrencyModal" /> <?php echo $this->lang->line('new'); ?> </button>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
												<div class="form-group">
													<label for="currencyDecimalDigits"><?php echo $this->lang->line('decimal_digits'); ?></label>
													<select class="form-control select2" name="currencyDecimalDigits" id="currencyDecimalDigits" REQUIRED>
														<option value=""><?php echo $this->lang->line('select'); ?></option>
														<option value="1" <?php if($localSettings->decimalDigits==1) { echo "selected"; } ?>>1 <?php echo $this->lang->line('digit'); ?> | .#</option>
														<option value="2" <?php if($localSettings->decimalDigits==2) { echo "selected"; } ?>>2 <?php echo $this->lang->line('digits'); ?> | .##</option>
														<option value="3" <?php if($localSettings->decimalDigits==3) { echo "selected"; } ?>>3 <?php echo $this->lang->line('digits'); ?> | .###</option>
													</select>
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 text-right">
												<div class="form-group">
													<input class="form_control mr-2 mt-4" type="checkbox" name="useThousandSeparator" id="useThousandSeparator" <?php if($localSettings->useThSep==1) { echo "CHECKED"; } ?>>
													<?php if($localSettings->useThSep==1) { ?>
														<label class="label-disabled" for="useThousandSeparator">
													<?php } else { ?>
													<label  for="useThousandSeparator">
													<?php } ?>	
														<?php echo $this->lang->line('use_thousand_separator'); ?>
													</label>
												</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
												<div class="form-group">
													<label for="thousandSeparator" class="text-muted"><?php echo $this->lang->line('thousand_separator'); ?></label>
													<select class="form-control select2 label-disabled" name="thousandSeparator" id="thousandSeparator" <?php if($localSettings->useThSep==0) { echo "DISABLED"; } ?>>
														<option value=""><?php echo $this->lang->line('select'); ?></option>
														<option value="1" <?php if($localSettings->thSepChar==1) { echo "selected"; }?>><?php echo $this->lang->line('space'); ?> (" ")</option>
														<option value="2" <?php if($localSettings->thSepChar==2) { echo "selected"; }?>><?php echo $this->lang->line('comma'); ?> (",")</option>
														
													</select>
												</div>
											</div>
											<div class="row justify-content-center col-12">
												<button type="button" name="updateLocalSettings" id="updateLocalSettings" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_local_settings'); ?></button>
												
											</div>
											<div class="row justify-content-center col-12 mt-2">
												<div class="text-center" id="localSettingsUpdateResult"></div>
											</div>
											
										</div>
									</div>
									
									<!-- ***************** LOGIN & SESSIONS TAB *************** -->
									
									<div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">

										<div class="text-header mb-3">Login Settings</div>
										<div class="row">
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('session_timeout'); ?></label>
													<input type="text" class="form-control form-control-sm" name="sessionTimeout" id="sessionTimeout" value="<?php echo $loginSessRow->session_timeout; ?>" placeholder="<?php echo $this->lang->line('session_timeout'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('login_attemps'); ?></label>
													<input type="text" class="form-control form-control-sm" name="loginAttemps" id="loginAttemps" value="<?php echo $loginSessRow->login_attempts; ?>" placeholder="<?php echo $this->lang->line('login_attemps'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('account_lock_time'); ?></label>
													<input type="text" class="form-control form-control-sm col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" name="accountLockTime" id="accountLockTime" value="<?php echo $loginSessRow->wrong_attempts; ?>" placeholder="<?php echo $this->lang->line('account_lock_time'); ?>" REQUIRED>
												</div>
											</div>
											<div class="row justify-content-center col-12">
												<button type="button" name="updateLoginSettings" id="updateLoginSettings" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_login_settings'); ?></button>
												
											</div>
											<div class="row justify-content-center col-12 mt-2">
												<div class="text-center" id="loginSettingsUpdateResult"></div>
											</div>
										</div>
									</div>
									
									<!-- ***************** EMAIL SETTINGS TAB *************** -->
									
									<div class="tab-pane fade" id="emailsettings" role="tabpanel" aria-labelledby="emailsettings-tab">
										
										
										<div class="row">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('email_sending_method'); ?></label>
													<select class="form-control select2 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" name="emailSendingMethod" id="emailSendingMethod" REQUIRED>
														<option value="phpmail" selected><?php echo $this->lang->line('php_mail'); ?></option>
													</select>
													<div id="testMailMethod"></div>
												</div>
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('sender_name'); ?></label>
													<input type="text" class="form-control form-control-sm " name="senderName" id="senderName" value="<?php echo $mailSettingsRow->sender_name; ?>" placeholder="<?php echo $this->lang->line('sender_name'); ?>" REQUIRED>
												</div>
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('sender_email'); ?></label><span class="text-primary small ml-3"><i class="fa fa-exclamation-circle"></i> <?php echo $this->lang->line('sender_email_note'); ?></span>
													<input type="email" class="form-control form-control-sm " name="senderEmail" id="senderEmail" value="<?php echo $mailSettingsRow->sender_email; ?>" placeholder="<?php echo $this->lang->line('sender_email'); ?>" REQUIRED>
												</div>
												
											</div>
											
											
											<div class="row justify-content-center col-12 mt-5">
												<button type="button" name="updateMailSettings" id="updateMailSettings" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_email_settings'); ?></button>
												
											</div>
											<div class="row justify-content-center col-12 mt-2">
												<div class="text-center" id="mailSettingsUpdateResult"></div>
											</div>
										</div>
									</div>
									
									<!-- ***************** PRODUCT BARCODING TAB *************** -->
									
									<div class="tab-pane fade" id="productBarcoding" role="tabpanel" aria-labelledby="productBarcoding-tab">
										<div class="row">
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
												<div class="form-group">
													<label ><?php echo $this->lang->line('barcode_technology'); ?></label>
													<select class="form-control select2" name="productBarcodeTechnology" id="productBarcodeTechnology" REQUIRED>
														<option value="1" <?php if($productBarcodingRow->barcode_technology=='1') { echo "selected"; }?>><?php echo $this->lang->line('barcode_1d'); ?></option>
														<option value="2" disabled ><?php echo $this->lang->line('barcode_2d'); ?></option>
													</select>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
												<div class="form-group">
													<label ><?php echo $this->lang->line('barcode_type'); ?></label>
													<select class="form-control select2" name="productBarcodeType" id="productBarcodeType" REQUIRED>
														<option value="1" <?php if($productBarcodingRow->barcode_type=='1') { echo "selected"; }?>><?php echo $this->lang->line('barcode_39'); ?></option>
														<option value="2" <?php if($productBarcodingRow->barcode_type=='2') { echo "selected"; }?>><?php echo $this->lang->line('barcode_128'); ?></option>
													</select>
												</div>
												
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
												<div class="card">
													<div class="card-header card-title m-0"><h6><?php echo $this->lang->line('example'); ?></h6>
													</div>
													<div class="card-body  bloc-example">
														<div class="row">
															<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
																<div class="form-group">
																	<label ><?php echo $this->lang->line('enter_barcode_example'); ?></label>
																	<div class="d-flex">
																		<input type="text" class="form-control form-control-sm col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12  " name="testBarcodeNumber" id="testBarcodeNumber" value="">
																		<button type="button" id="barcodeSetting_generate" class="btn btn-primary btn-sm  ml-2"  /> <?php echo $this->lang->line('generate'); ?> </button>
																	</div>
																</div>
															</div>
															<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
																<div id="testBarcodeGenerated"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
												<div class="card">
													<div class="card-header card-title m-0"><h6><?php echo $this->lang->line('barcode_printing_steup'); ?></h6>
													</div>
													<div class="card-body">
														
																<img src="<?php echo base_url();?>assets/img/barcode.png" class="content-img" alt="barcode page example"  >
															
														<div class="row mt-2">
															<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
																<div class="form-group">
																	<label ><?php echo $this->lang->line('paper_size'); ?></label>
																	<select class="form-control select2" name="paperSize" id="paperSize" REQUIRED>
																		<option value=""><?php echo $this->lang->line('select'); ?></option> 
																		<option value="1" <?php if($productBarcodingRow->paper_size=='1') { echo "selected"; }?>>A4</option>
																		<option value="2" <?php if($productBarcodingRow->paper_size=='2') { echo "selected"; }?> >Letter</option>
																	</select>
																</div>
															</div>
															<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
																<div class="form-group">
																	<label ><?php echo $this->lang->line('paper_orientation'); ?></label>
																	<select class="form-control select2" name="paperOrientation" id="paperOrientation" REQUIRED>
																		<option value="1" <?php if($productBarcodingRow->paper_orientation=='1') { echo "selected"; }?>>Portrait</option>
																		<option value="2" <?php if($productBarcodingRow->paper_orientation=='2') { echo "selected"; }?> >Landscape</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="row mt-2">
															<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
																<label ><?php echo $this->lang->line('margin_top'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" class="form-control form-control-sm text-right" name="marginTop" id="marginTop" value="<?php echo $productBarcodingRow->margin_top;?>">
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('mm'); ?></div>
																	</div>
																</div>
															</div>
															<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
																<label ><?php echo $this->lang->line('margin_bottom'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" class="form-control form-control-sm text-right" name="marginBottom" id="marginBottom" value="<?php echo $productBarcodingRow->margin_bottom;?>">
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('mm'); ?></div>
																	</div>
																</div>
															</div>
															<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
																<label ><?php echo $this->lang->line('margin_left'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" class="form-control form-control-sm text-right" name="marginLeft" id="marginLeft" value="<?php echo $productBarcodingRow->margin_left;?>">
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('mm'); ?></div>
																	</div>
																</div>
															</div>
															<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
																<label ><?php echo $this->lang->line('margin_right'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" class="form-control form-control-sm text-right" name="marginRight" id="marginRight" value="<?php echo $productBarcodingRow->margin_right;?>">
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('mm'); ?></div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row mt-2">
															<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
																<label ><?php echo $this->lang->line('barcodes_per_row'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" class="form-control form-control-sm text-right" name="barcodesPerRow" id="barcodesPerRow" value="<?php echo $productBarcodingRow->barcodes_row;?>">
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('units'); ?></div>
																	</div>
																</div>
															</div>
															<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
																<label ><?php echo $this->lang->line('barcodes_per_col'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" class="form-control form-control-sm text-right" name="barcodesPerCol" id="barcodesPerCol" value="<?php echo $productBarcodingRow->barcodes_col;?>">
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('units'); ?></div>
																	</div>
																</div>
															</div>
															<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
																<label ><?php echo $this->lang->line('barcode_padding'); ?></label>
																<div class="input-group input-group-sm mb-2 mr-sm-2">
																	<input type="number" class="form-control form-control-sm text-right" name="barcodePadding" id="barcodePadding" value="<?php echo $productBarcodingRow->barcode_padding;?>">
																	<div class="input-group-prepend">
																		<div class="input-group-text"><?php echo $this->lang->line('mm'); ?></div>
																	</div>
																</div>
															</div>
															<div class="row justify-content-center col-12">
																<button type="button" name="updateProductBarcodeSettings" id="updateProductBarcodeSettings" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_product_barcode_settings'); ?></button>
																
															</div>
															<div class="row justify-content-center col-12 mt-2">
																<div class="text-center" id="ProductBarcodeSettingsUpdateResult"></div>
															</div>
														</div>
														
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<!-- ***************** PACKAGE BARCODING TAB *************** -->
									
									<div class="tab-pane fade" id="packBarcoding" role="tabpanel" aria-labelledby="packBarcoding-tab">
										<div class="row">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
												<div class="row">
													<div class="text-center">
														<img src="<?php echo base_url();?>assets/img/palletBarcode.png" width="80%" height="80%" />
													</div>
												</div>
												<div class="row mt-2">
													
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-2">
														<div class="form-group">
															<label ><?php echo $this->lang->line('barcode_technology'); ?></label>
															<select class="form-control select2" name="packBarcodeTechnology" id="packBarcodeTechnology" REQUIRED>
																<option value="1" <?php if($packBarcodingRow->barcode_technology=='1') { echo "selected"; }?>><?php echo $this->lang->line('barcode_1d'); ?></option>
																<option value="2" disabled ><?php echo $this->lang->line('barcode_2d'); ?></option>
															</select>
														</div>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-2">
														<div class="form-group">
															<label ><?php echo $this->lang->line('barcode_type'); ?></label>
															<select class="form-control select2" name="packBarcodeType" id="packBarcodeType" REQUIRED>
																<option value="1" <?php if($packBarcodingRow->barcode_type=='1') { echo "selected"; }?>><?php echo $this->lang->line('barcode_39'); ?></option>
																<option value="2" <?php if($packBarcodingRow->barcode_type=='2') { echo "selected"; }?>><?php echo $this->lang->line('barcode_128'); ?></option>
															</select>
														</div>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('paper_size'); ?></label>
															<select class="form-control select2" name="packPaperSize" id="packPaperSize" REQUIRED>
																<option value=""><?php echo $this->lang->line('select'); ?></option> 
																<option value="1" <?php if($packBarcodingRow->paper_size=='1') { echo "selected"; }?>>A4</option>
																<option value="2" <?php if($packBarcodingRow->paper_size=='2') { echo "selected"; }?> >A5</option>
															</select>
														</div>
													</div>
													<div class="row justify-content-center col-12">
														<button type="button" name="updatePackageBarcodeSettings" id="updatePackageBarcodeSettings" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_pack_barcode_settings'); ?></button>
																
													</div>
													<div class="row justify-content-center col-12 mt-2">
														<div class="text-center" id="packageBarcodeSettingsUpdateResult"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<!-- ***************** PRODUCT QR Code TAB *************** -->
									
									<div class="tab-pane fade" id="productQrCode" role="tabpanel" aria-labelledby="productQrCode-tab">
										<div class="row">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('enter_product_data'); ?></label>
													<textarea class="form-control form-control-sm" name="qrData" id="qrData" rows="4"><?php echo $this->lang->line('test_qr_product_data'); ?></textarea>
												</div>
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
												<div class="card">
													<div class="card-header card-title m-0"><h6><?php echo $this->lang->line('generate_to_view_qrcode'); ?></h6>
													</div>
													<div class="card-body  bloc-example">
														<div class="row text-center">
															<img src="<?php echo base_url();?>assets/img/qrcodeexample.png" class="img-fluid"  />
															<img src="<?php echo base_url();?>assets/img/resultofqrcode.png" class="img-fluid"  />
														</div>
													</div>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
												<div class="form-group">
													<label ><?php echo $this->lang->line('ecc_level'); ?></label>
													<select class="form-control select2" name="ecc_level" id="ecc_level" REQUIRED>
														<option value="L" <?php if($productQr->ecc_level=='L') { echo "selected"; }?> ><?php echo $this->lang->line('level'); ?> L</option>
														<option value="M" <?php if($productQr->ecc_level=='M') { echo "selected"; }?>  ><?php echo $this->lang->line('level'); ?> M</option>
														<option value="Q" <?php if($productQr->ecc_level=='Q') { echo "selected"; }?>  ><?php echo $this->lang->line('level'); ?> Q</option>
														<option value="H" <?php if($productQr->ecc_level=='H') { echo "selected"; }?>  ><?php echo $this->lang->line('level'); ?> H</option>
													</select>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
												<div class="form-group">
													<label ><?php echo $this->lang->line('size'); ?></label>
													<select class="form-control select2" name="qr_size" id="qr_size" REQUIRED>
														<option value="1" <?php if($productQr->size=='1') { echo "selected"; }?> >1</option>
														<option value="2" <?php if($productQr->size=='2') { echo "selected"; }?> >2</option>
														<option value="3" <?php if($productQr->size=='3') { echo "selected"; }?> >3</option>
														<option value="4" <?php if($productQr->size=='4') { echo "selected"; }?> >4</option>
														<option value="5" <?php if($productQr->size=='5') { echo "selected"; }?> >5</option>
														<option value="6" <?php if($productQr->size=='6') { echo "selected"; }?> >6</option>
														<option value="7" <?php if($productQr->size=='7') { echo "selected"; }?> >7</option>
														<option value="8" <?php if($productQr->size=='8') { echo "selected"; }?> >8</option>
														<option value="9" <?php if($productQr->size=='9') { echo "selected"; }?> >9</option>
														<option value="10" <?php if($productQr->size=='10') { echo "selected"; }?> >10</option>
													</select>
												</div>
											</div>
											<div class="row justify-content-center col-12">
												<button type="button" name="updateProductQrSettings" id="updateProductQrSettings" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('update_qr_settings'); ?></button>
											</div>
											<div class="row justify-content-center col-12 mt-2">
												<div class="text-center" id="productQrSettingsUpdateResult"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<!--   MODALS -->
				<!-- ADD NEW CURRENCY -->
				<div class="modal fade" id="addNewCurrencyModal" tabindex="-1" role="dialog" aria-labelledby="addNewCurrencyModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id=""><?php echo $this->lang->line('add_new_currency'); ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
								<div class="modal-body">
									<div class="row ">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<div class="form-group form-group-sm">
												<label> <?php echo $this->lang->line('currency_symbol'); ?></label>
												<input type="text" name="newCurrency_symbol" id="newCurrency_symbol" Placeholder="<?php echo $this->lang->line('currency_symbol'); ?>" class="form-control form-control-sm" value="" Required >
											</div>
										</div>
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<div class="form-group">
												<label><?php echo $this->lang->line('currency_code'); ?></label>
												<input type="text" name="newCurrency_code" id="newCurrency_code" Placeholder="<?php echo $this->lang->line('currency_code'); ?>" class="form-control form-control-sm" value=""  >
											</div>
										</div>
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<div class="form-group">
												<label><?php echo $this->lang->line('currency_name'); ?></label>
												<input type="text" name="newCurrency_name" id="newCurrency_name" Placeholder="<?php echo $this->lang->line('currency_name'); ?>" class="form-control form-control-sm" value=""  >
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
									<button type="button" id="newCurrency_save" class="btn btn-info btn-sm"><?php echo $this->lang->line('save_currency'); ?></button>
								</div>
						</div>
					</div>
				</div>
				
	