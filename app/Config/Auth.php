<?php
namespace App\Config;

use CodeIgniter\Config\BaseConfig;

class Auth extends BaseConfig
{
	//--------------------------------------------------------------------
    // Views used by Auth Controllers
    //--------------------------------------------------------------------

    public $views = [
        'login' => 'App\Views\login',
        'register' => 'App\Views\register',
        'forgot-password' => 'App\Views\forgot',
        'reset-password' => 'App\Views\reset',
        'account' => 'App\Views\account'
    ];

    // Layout for the views to extend
    public $viewLayout = 'App\Views\layouts';
}
