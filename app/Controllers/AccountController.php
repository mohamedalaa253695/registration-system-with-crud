<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\UserModel;

class AccountController extends Controller
{

	/**
	 * Access to current session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
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

    //--------------------------------------------------------------------

	/**
	 * Displays account settings.
	 */
	public function account()
	{
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		return view($this->config->views['account'], [
			'userData' => $this->session->userData,
			'config' => $this->config,
			'title' => 'Account'
 		]);
	}

    //--------------------------------------------------------------------

	/**
	 * Updates regular account settings.
	 */
	public function updateAccount()
	{
		// update user, validation happens in model
		$users = new UserModel();
		$getRule = $users->getRule('update_account');
		$users->setValidationRules($getRule);
		$user = [
			'id'  	=> $this->session->get('userData.id'),
			'name' 	=> $this->request->getPost('name'),
			'phone_number'=>$this->request->getPost('phone'),
			'address'=>$this->request->getPost('address')
		];

		if (! $users->save($user)) {
			return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // update session data
        $this->session->push('userData', $user);

        return redirect()->to('account')->with('success', lang('Auth.updateSuccess'));
	}

    //--------------------------------------------------------------------

	/**
	 * Handles email address change.
	 */
	public function changeEmail()
	{
		helper('text');

		// check password
		$users = new UserModel();
		$user = $users->find($this->session->get('userData.id'));
		if (
			empty($this->request->getPost('password')) ||
			! password_verify($this->request->getPost('password'), $user['password_hash'])
		) {
			return redirect()->to('account')->withInput()->with('error', lang('Auth.wrongCredentials'));
		}

		// update user with temporary new email, validation happens in model
		$getRule = $users->getRule('changeEmail');
		$users->setValidationRules($getRule);
		$updatedUser = [
			'id'			=> $this->session->get('userData.id'),
			'new_email'		=> $this->request->getPost('new_email'),
			'activate_hash'	=> random_string('alnum', 32)
		];
		if (! $users->save($updatedUser)) {
			return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // update session data
        $this->session->push('userData', ['new_email' => $updatedUser['new_email']]);

		// send confirmation email to new address
		helper('auth');
        send_confirmation_email($updatedUser['new_email'], $updatedUser['activate_hash']);

		// send notification email to old address
        send_notification_email($user['email']);

        return redirect()->to('account')->with('success', lang('Auth.emailUpdateStarted'));
	}

    //--------------------------------------------------------------------

	/**
	 * Verifies and sets new e-mail address.
	 */
	public function activateAccount()
	{
		$users = new UserModel();

		// check token and if new email is set
		$user = $users->where('activate_hash', $this->request->getGet('token'))
			->where('new_email !=', null)
			->first();

		if (! $user) {
			return redirect()->to('account')->with('error', lang('Auth.activationNoUser'));
		}

		// set new email as current
		$updatedUser['id'] = $user['id'];
		$updatedUser['email'] = $user['new_email'];
		$updatedUser['new_email'] = null;
		$updatedUser['activate_hash'] = null;
		$updatedUser['active'] = 1;
		$users->save($updatedUser);

		// update session data, if user is logged in
		if ($this->session->isLoggedIn) {
			$this->session->push('userData', [
				'email'		=> $updatedUser['email'],
            	'new_email'	=> null
        	]);

        	return redirect()->to('account')->with('success', lang('Auth.confirmEmailSuccess'));
		}

		return redirect()->to('login')->with('success', lang('Auth.confirmEmailSuccess'));
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
			return redirect()->to('account')->withInput()
				->with('errors', $this->validator->getErrors());
		}

		// check current password
		$users = new UserModel();
		$user = $users->find($this->session->get('userData.id'));

		if (
			! $user ||
			! password_verify($this->request->getPost('password'), $user['password_hash'])
		) {
			return redirect()->to('account')->withInput()->with('error', lang('Auth.wrongCredentials'));
		}

		// update user's password
		$updatedUser['id'] = $this->session->get('userData.id');
		$updatedUser['password'] = $this->request->getPost('new_password');
		$users->save($updatedUser);

		// redirect to account with success message
		return redirect()->to('account')->with('success', lang('Auth.passwordUpdateSuccess'));
	}


	// public function updateUserDetails(){

	// 	#validate new data
	// 	$rules = [
	// 		'current_password'=>'required|min_length[5]',
	// 		'new_assword'=>'required|min_length[5]',
	// 		'new_password_confirm'=>'required|matches[new_password]'

	// 	];

	// 	if (! $this->validate($rules)) {
	// 		return redirect()->to('account')->withInput()
	// 			->with('errors', $this->validator->getErrors());
	// 	}

	// 	// check current password
	// 	$users = new UserModel();
	// 	$user = $users->find($this->session->get('userData.id'));

	// 	if (
	// 		! $user ||
	// 		! password_verify($this->request->getPost('password'), $user['password_hash'])
	// 	) {
	// 		return redirect()->to('account')->withInput()->with('error', lang('Auth.wrongCredentials'));
	// 	}


	// 	if($user->find($this->session->get('userData.emial' )) != )




	// 	# see if user update email 
	// 	  #redirect ro login until mail activation
	// 	#see if user want to update password
	// 		#confirm the current password is the same as in the database
	// 		#if no redirect to account with error Auth wrong credentials

	// 	#save new data to database 
	// 	#notification your details updated successfully

	// 	$users = new UserModel();
		
		



	// }

    //--------------------------------------------------------------------

	/**
	 * Deletes user account.
	 */
	public function deleteAccount()
	{
		// check current password
		$users = new UserModel();
		$user = $users->find($this->session->get('userData.id'));

		if (
			! $user ||
			! password_verify($this->request->getPost('password'), $user['password_hash'])
		) {
			return redirect()->back()->withInput()->with('error', lang('Auth.wrongCredentials'));
		}

		// delete account from DB
		$users->delete($this->session->get('userData.id'));

		// log out user
		$this->session->remove(['isLoggedIn', 'userData']);

		// redirect to register with success message
		return redirect()->to('register')->with('success', lang('Auth.accountDeleted'));
	}

}
