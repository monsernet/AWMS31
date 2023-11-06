<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'User';

$route['home'] = 'dashboard/index';

/****** SETTINGS *******/
$route['general_settings'] = 'GeneralSettings/index';
$route['warehouse/settings'] = 'WarehouseSettings/index';
$route['company/settings'] = 'GeneralSettings/companysettings';
$route['company/save-settings'] = 'GeneralSettings/savecompanysettings';

/****** USER *******/
$route['login'] = 'user/login';
$route['user/change-password'] = 'user/changeuserpassword';
$route['save-user-password'] = 'user/saveLoginPassword';
$route['logout'] = 'user/logout';
$route['update-user-infos'] = 'user/updateLoginInfos';
$route['save-user-infos'] = 'user/saveLoginInfos';
$route['register'] = 'user/register';
$route['register/save'] = 'user/savenewuser';
$route['register/email-confirmation/(:any)'] = 'user/confirnEmail/$1';

/****** WAREHOUSE *******/
$route['warehouse'] = 'warehouse/index';
$route['storage/overview'] = 'storage/index';
$route['warehouse/layout'] = 'warehouse/layout';
$route['storage/rack-barcoding'] = 'storage/rackbarcoding';
$route['warehouses/new'] = 'warehouse/create';
$route['warehouses/save-new-warehouse'] = 'warehouse/save';

/****** PRODUCTS *******/
$route['products'] = 'product/index';
$route['products/new'] = 'product/create';
$route['products/edit/(:num)'] = 'product/edit/$1';
$route['products/alert'] = 'product/alertproducts';
$route['products/oos'] = 'product/outofstock';
$route['products/dimensions'] = 'product/productdimensions';
$route['products/proddimensions'] = 'product/disableddimensions';
$route['categories'] = 'product/productCategories';
$route['categories/new'] = 'product/createcategory';
$route['categories/edit/(:num)'] = 'product/editcategory/$1';
$route['products/addstock'] = 'product/addnewstock';
$route['products/stock'] = 'product/currentstock';
$route['stock/mvts'] = 'product/stockMovements';
$route['products/barcoding'] = 'product/productbarcoding';
$route['packages/barcoding'] = 'product/packagebarcoding';
$route['packages/store'] = 'product/storepackage';
$route['products/qrcodes'] = 'product/productQrcode';

/****** INVENTORY *******/
$route['stock/inventory'] = 'inventory/index';
$route['inventory/economic-order-qty'] = 'inventory/eoq';
$route['inventory/physical-inventory'] = 'inventory/physicalinventory';
$route['inventory/storage-positions'] = 'inventory/storagepos';

/****** TRANSFERS *******/
$route['transfers/new'] = 'transfer/create';
$route['transfers/save'] = 'transfer/store';
$route['transfers/issued'] = 'transfer/transfersSent';
$route['transfers/received'] = 'transfer/transfersReceived';
$route['transfers/approve'] = 'transfer/approveTransfer';
$route['transfers/saveapproval'] = 'transfer/storeApproval';
$route['transfers/loading'] = 'transfer/loadTransfer';
$route['transfers/reception'] = 'transfer/receivetransfer';
$route['transfers/reception/store'] = 'transfer/storeReception';


/****** PURCHASINGS *******/
$route['suppliers/new'] = 'supplier/create';
$route['suppliers'] = 'supplier/index';
$route['purchases/lpo'] = 'order/lpo';
$route['purchases/lpo/new'] = 'order/createlpo';
$route['purchases/po'] = 'order/po';
$route['purchases/order'] = 'order/approvelpo';
$route['purchases/saveorder'] = 'order/saveorder';
$route['purchases/receivings'] = 'order/receivings';
$route['purchases/receivings/new'] = 'order/createreceiving';
$route['purchases/savereceiving'] = 'order/savereceiving';
$route['purchases/receiving/store'] = 'order/storeReceiving';

/****** DELIVERIES *******/
$route['customers/new'] = 'customer/create';
$route['customers'] = 'customer/index';
$route['customers/orders'] = 'delivery/orders';
$route['customers/orders/new'] = 'delivery/createorder';
$route['customers/orders/save'] = 'delivery/storeorder';
$route['customers/deliveries'] = 'delivery/deliveryList';
$route['deliveries/delivery-note'] = 'delivery/deliveryNote';
$route['deliveries/loading'] = 'delivery/loadDelivery';
$route['deliveries/savedeliverynote'] = 'delivery/saveDelivery';
$route['deliveries/pick'] = 'delivery/pickDelivery';
$route['deliveries/pack'] = 'delivery/packDelivery';
$route['customers/deliveries/packingslip/(:num)'] = 'delivery/packingList/$1';
$route['deliveries/load'] = 'delivery/loadDelivery';

/****** RETURNS *******/
$route['transfers/returns/new'] = 'goodreturn/createTransferReturn';
$route['transfers/newreturn/save'] = 'goodreturn/saveTransferReturn';
$route['transfers/returns'] = 'goodreturn/TransferReturns';
$route['deliveries/returns/new'] = 'goodreturn/createDeliveryReturn';
$route['deliveries/newreturn/save'] = 'goodreturn/saveDeliveryReturn';
$route['deliveries/returns'] = 'goodreturn/deliveryReturns';

/****** BACKUPS *******/
$route['data/backup'] = 'backup/index';

/****** HELP ******/
$route['help/google-recaptcha'] = 'help/google_recaptcha';

/****** USER MANAGEMENT *******/
$route['users/list'] = 'user/userList';
$route['users/new'] = 'user/createuser';
$route['users/edit/(:num)'] = 'user/edituser/$1';
$route['users/roles'] = 'user/userroles';
$route['users/banned'] = 'user/bannedusers';




$route['404_override'] = 'customError404/index';
$route['translate_uri_dashes'] = FALSE;
