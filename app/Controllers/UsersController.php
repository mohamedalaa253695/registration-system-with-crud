<?php namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\UserModel;



class UsersController extends BaseController
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
		

		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		$model = new UserModel();

		$data= [
			'users'    => $model->paginate(1),
			'pager'    => $model->pager,
			'userData' => $this->session->userData,
			'config'   => $this->config,
			'title'    =>'Users'
		];


		echo view('users/index', $data);
	}


	public function create(){
		$data = [
			'title' =>'Create User',
			'userData' => $this->session->userData
		];
		echo view('users/create', $data);
	}

	public function attemptCreate(){
		helper('text');

		// save new user, validation happens in the model
		$users = new UserModel();
		$getRule = $users->getRule('registration');
		$users->setValidationRules($getRule);
		
        $user = [
            'name'          	=> $this->request->getPost('name'),
            'email'         	=> $this->request->getPost('email'),
            'phone_number'      => $this->request->getPost('phone'),
            'address'         	=> $this->request->getPost('address'),
            'password'     		=> $this->request->getPost('password'),
            'password_confirm'	=> $this->request->getPost('password_confirm'),
			'activate_hash'		=> random_string('alnum', 32)
        ];

        if (! $users->save($user)) {
			return redirect()->route('users/create')->withInput()->with('errors', $users->errors());
        }

		// send activation email
		helper('auth');
        send_activation_email($user['email'], $user['activate_hash']);

		// success
        return redirect()->route('users')->with('success', 'user Created successfully');
	}

	public function update($id){
		$users = new UserModel();
		$user = $users->find($id);
		$data = [
			'title' =>'Update User',
			'userData' => $this->session->userData,
			'config' => $this->config,
			'user'=>$user
		];
		echo view('users/update', $data);

	}
	/**
	 * Updates regular user settings.
	 */


	public function updateUser()
	{
		// update user, validation happens in model
		$users = new UserModel();
		$getRule = $users->getRule('update_account');
		$users->setValidationRules($getRule);
		$user = [
			'id'  	=> $this->request->getPost('id'),
			'name' 	=> $this->request->getPost('name'),
			'phone_number'=>$this->request->getPost('phone'),
			'address'=>$this->request->getPost('address')
		];

		if (! $users->save($user)) {
			return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // update session data
        $this->session->push('userData', $user);

        return redirect()->route('users')->with('success', lang('Auth.updateSuccess'));
	}

    //--------------------------------------------------------------------

	/**
	 * Handles email address change.
	 */
	public function changeUserEmail()
	{
		helper('text');

		// check password
		$users = new UserModel();
		$user = $users->find($this->session->get('userData.id'));
		if (
			empty($this->request->getPost('password')) ||
			! password_verify($this->request->getPost('password'), $user['password_hash'])
		) {
			return redirect()->back()->withInput()->with('error', lang('Auth.wrongCredentials'));
		}

		// update user with temporary new email, validation happens in model
		$getRule = $users->getRule('changeEmail');
		$users->setValidationRules($getRule);
		$updatedUser = [
			'id'			=> $this->request->getPost('id'),
			'new_email'		=> $this->request->getPost('new_email'),
			'activate_hash'	=> random_string('alnum', 32)
		];
		if (! $users->save($updatedUser)) {
			return redirect()->route('users')->withInput()->with('errors', $users->errors());
        }

        // update session data
        $this->session->push('userData', ['new_email' => $updatedUser['new_email']]);

		// send confirmation email to new address
		helper('auth');
        send_confirmation_email($updatedUser['new_email'], $updatedUser['activate_hash']);

		// send notification email to old address
        send_notification_email($user['email']);

        return redirect()->route('users')->with('success', lang('Auth.emailUpdateStarted'));
	}

    //--------------------------------------------------------------------

	/**
	 * Verifies and sets new e-mail address.
	 */
	public function confirmNewEmail()
	{
		$users = new UserModel();

		// check token and if new email is set
		$user = $users->where('activate_hash', $this->request->getGet('token'))
			->where('new_email !=', null)
			->first();

		if (! $user) {
			return redirect()->back()->with('error', lang('Auth.activationNoUser'));
		}

		// set new email as current
		$updatedUser['id'] = $user['id'];
		$updatedUser['email'] = $user['new_email'];
		$updatedUser['new_email'] = null;
		$updatedUser['activate_hash'] = null;
		$users->save($updatedUser);

		// update session data, if user is logged in
		if ($this->session->isLoggedIn) {
			$this->session->push('userData', [
				'email'		=> $updatedUser['email'],
            	'new_email'	=> null
        	]);

        	return redirect()->route('users')->with('success', lang('Auth.confirmEmailSuccess'));
		}

		return redirect()->route('login')->with('success', lang('Auth.confirmEmailSuccess'));
	}

    //--------------------------------------------------------------------

	/**
	 * Handles password change.
	 */
	public function changePassword()
	{
		// validate request
		$rules = [
			'password' 	=> 'required|min_length[5]',
			'new_password' => 'required|min_length[5]',
			'new_password_confirm' => 'required|matches[new_password]'
		];

		if (! $this->validate($rules)) {
			return redirect()->back()->withInput()
				->with('errors', $this->validator->getErrors());
		}

		// check current password
		$users = new UserModel();
		$user = $users->find($this->request->getPost('id'));

		if (
			! $user ||
			! password_verify($this->request->getPost('password'), $user['password_hash'])
		) {
			return redirect()->back()->withInput()->with('error', lang('Auth.wrongCredentials'));
		}

		// update user's password
		$updatedUser['id'] = $this->request->getPost('id');
		$updatedUser['password'] = $this->request->getPost('new_password');
		$users->save($updatedUser);

		// redirect to account with success message
		return redirect()->to('users')->with('success', lang('Auth.passwordUpdateSuccess'));
	}


	public function delete($id){
		// dd($id);
		$users = new UserModel();
		$user  =  $users->find($id);
		if(!isset($user)){
			return redirect()->route('users')->with('error', 'user not deleted');
		}

		$users->delete($id);
		return redirect()->route('users')->with('success', lang('User deleted successfully'));
		
	}


	//--------------------------------------------------------------------

}
