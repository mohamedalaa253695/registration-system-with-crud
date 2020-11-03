<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);


//users routes 
$routes->get('users','UsersController::index');
$routes->get('users/create','UsersController::create');
$routes->post('users/create','UsersController::attemptCreate');

$routes->get('users/update/(:num)','UsersController::update/$1');

$routes->post('users/update', 'UsersController::updateUser');

$routes->post('update-user-general-detials', 'UsersController::updateUser');
$routes->post('update-user-email', 'UsersController::changeUserEmail');
$routes->get('confirm-user-email', 'UsersController::confirmNewEmail');
$routes->post('change-user-password', 'UsersController::changePassword');

$routes->get('users/delete/(:num)','UsersController::delete/$1');



$routes->group('', ['namespace' => 'App\Controllers'], function($routes) {
	// Registration
    $routes->get('register', 'RegistrationController::register', ['as' => 'register']);
	$routes->post('register', 'RegistrationController::attemptRegister');
	
	 // Activation
	 $routes->get('activate-account', 'RegistrationController::activateAccount', ['as' => 'activate-account']);

    // Login/out
    $routes->get('login', 'LoginController::login', ['as' => 'login']);
    $routes->post('login', 'LoginController::attemptLogin');
    $routes->get('logout', 'LoginController::logout');

    // Forgotten password and reset
    $routes->get('forgot-password', 'PasswordController::forgotPassword', ['as' => 'forgot-password']);
    $routes->post('forgot-password', 'PasswordController::attemptForgotPassword');
    $routes->get('reset-password', 'PasswordController::resetPassword', ['as' => 'reset-password']);
	$routes->post('reset-password', 'PasswordController::attemptResetPassword');

	 // Account settings
	$routes->get('account', 'AccountController::account', ['as' => 'account']);
    $routes->post('account', 'AccountController::updateAccount');

    $routes->post('update-user-details', 'AccountController::updateUserDetails');
    $routes->post('change-email', 'AccountController::changeEmail');
    $routes->get('confirm-email', 'AccountController::confirmNewEmail');
    $routes->post('change-password', 'AccountController::changePassword');
    $routes->post('delete-account', 'AccountController::deleteAccount');

   
});


/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
