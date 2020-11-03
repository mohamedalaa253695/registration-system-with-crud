<?php namespace App\Controllers;

use Config\Services;
use App\Models\UserModel;

use App\Models\RoleModel;

class Home extends BaseController
{


	protected $session;

	/**
	 * Authentication settings.
	 */
	protected $config;


    //--------------------------------------------------------------------

	public function __construct()
	{
		// start session
		$this->session = Services::session();

		// load auth settings
		$this->config = config('Auth');
	}

	public function index()
	{

		$users = new UserModel();
		$numberOfUsers= $users->countAll();
		$roles = new RoleModel();
		$numberOfRoles = $roles->countAll();
		
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		echo view('dashboard', [
			'userData' => $this->session->userData,
			'config' => $this->config,
			'title'	=> 'Dashboard',
			'numberOfUsers'=>$numberOfUsers,
			'numberOfRoles'=>$numberOfRoles
		]);
	}

	//--------------------------------------------------------------------

}
