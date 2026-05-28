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
$route['default_controller'] = 'welcome';
$route['login'] = 'register/login';
$route['logout'] = 'register/logout';
$route['forgot-password'] = 'register/forgotPassword';
$route['my-network'] = 'user/myNetwork';
$route['my-profile'] = 'user/myProfile';
$route['change-cover-image'] = 'user/changeCoverImage';
$route['change-avatar-image'] = 'user/changeAvatarImage';
$route['edit-profile-info'] = 'user/editProfileInfo';
$route['change-password'] = 'user/changePassword';
$route['change-email'] = 'user/changeEmail';
$route['confirm-email-address/(:any)'] = 'user/confirmEmailAddress/$1';
$route['validated-tickets-datables'] = 'user/validatedTicketsDatables';
$route['my-tickets'] = 'user/myTickets';
$route['insert-ticket'] = 'user/insertTicket';
$route['my-payment'] = 'user/myPayment';


/* Company user type routes */

$route['payments'] = 'company/payments';
$route['invoices'] = 'company/invoices';
$route['archives'] = 'company/archives';

$route['add-tickets'] = 'company/addTickets';
$route['tickets'] = 'company/tickets';
$route['list-of-tickets'] = 'company/generatedTicketsDatables';
$route['delete-ticket'] = 'company/deleteTicket';
$route['validate-ticket'] = 'company/validateTicket';
$route['qr-validation-bridge'] = 'qrvalidationbridge/index';
$route['download-tickets'] = 'company/downloadTickets';
$route['products'] = 'products/index';
$route['add-product'] = 'products/addProduct';
$route['products-data-tables'] = 'products/productsDataTables';
$route['upload-photos'] = 'products/uploadPhotos';
$route['delete-product'] = 'products/deleteProduct';
$route['delete-product-image'] = 'products/deleteProductImage';
$route['change-product-status'] = 'products/changeProductStatus';
$route['delete-product-image'] = 'products/deleteProductImage';
$route['edit-product/(.*)'] = 'products/editProduct/$1';


/* End company user type routes */

/* Admin user type routes */
$route['users-data-tables'] = 'admin/usersDataTables';
$route['delete-user'] = 'admin/deleteUser';
$route['change-user-status'] = 'admin/changeUserStatus';
$route['edit-user/:num'] = 'admin/editUser';
$route['generate-user-legitimation/(:any)'] = 'admin/generateUserLegitimation';
$route['companies-data-tables'] = 'admin/companiesDataTables';
$route['edit-company/:num'] = 'admin/editCompany';
$route['company/my-profile'] = 'company/myProfile';
$route['company/change-cover-image'] = 'company/changeCoverImage';
$route['company/change-avatar-image'] = 'company/changeAvatarImage';
$route['company/change-password'] = 'company/changePassword';
$route['company/change-email'] = 'company/changeEmail';
$route['company/confirm-email-address'] = 'company/confirmEmailAddress';
$route['company/company-details'] = 'company/companyDetails';
$route['company-details'] = 'company/companyDetails';
$route['company-generate-invoice'] = 'invoices/generateInvoice';
$route['company-view-invoice/(.*)'] = 'invoices/viewInvoice/$1';
/* End admin user type routes */

/* Pages routes */
$route['companies/(.*)'] = 'pages/companies/$1';
$route['company/(.*)'] = 'pages/companyDetails/$1';
$route['companies'] = 'pages/companies';
$route['terms-and-conditions/(.*)/(.*)' ]= 'pages/termsAndConditions/$1/$2';
$route['terms-and-conditions/(.*)' ]= 'pages/termsAndConditions/$1';

/* End pages routes

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;*/

/* Admin routes */
$route['pages-data-tables/(.*)/(.*)'] = 'admin/pagesDataTables/$1/$2';
$route['add-page/(.*)/(.*)'] = 'admin/addPage/$1/$2';
$route['edit-page/(.*)'] = 'admin/editPage/$1';
$route['change-page-status'] = 'admin/changePageStatus';
$route['delete-page'] = 'admin/deletePage';
$route['pages/(:num)-(.*)'] = 'pages/documentation/$1-$2';
$route['add-page/(.*)/(.*)'] = 'admin/addPage/$1/$2';
$route['dynamic-content/(.*)/(.*)'] = 'admin/documentation/$1/$2';
$route['dynamic-content/(.*)'] = 'admin/documentation/$1';
$route['domains-data-tables'] = 'admin/domainsDataTables';
$route['add-domain'] = 'admin/addDomain';
$route['edit-domain/(.*)'] = 'admin/editDomain/$1';
$route['change-domain-status'] = 'admin/changeDomainStatus';
$route['delete-domain'] = 'admin/deleteDomain';
$route['login-as-company/(.*)'] = 'admin/loginAsCompany/$1';






/* End Admin routes */