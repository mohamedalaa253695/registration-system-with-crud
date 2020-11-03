<?php namespace App\Controllers;

use Config\Services;
use App\Models\RoleModel;



class RolesController extends BaseController
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

		$model = new RoleModel();

		$data= [
			'roles'    => $model->paginate(1),
			'pager'    => $model->pager,
			'userData' => $this->session->userData,
			'config'   => $this->config,
			'title'    =>'Roles'
		];


		echo view('roles/index', $data);
	}


	public function create(){
		$data = [
			'title' =>'Create Role',
			'userData' => $this->session->userData
		];
		return view('roles/create',$data);
	}

	public function attemptCreate(){
		$roles = new RoleModel();
		$getRule = $roles->getRule('validationRules');
		$roles->setValidationRules($getRule);
		$role =[
			'name'=> $this->request->getPost('name')
		];
		if(!$roles->save($role)){
			return redirect()->to('roles/create')->withInput()->with('errors',$roles->errors());
		}
		return redirect()->route('roles')->with('success','Role created successfully');
	}


	public function update($id){
		 $roles = new RoleModel();
		 $role = $roles->find($id);
		 
		
		$data = [
			'title' =>'Update Role',
			'userData' => $this->session->userData,
			'role'=>$role
		];

		echo view('roles/update', $data);

	}

	public function attemptUpdate(){
		
		$roles = new RoleModel();
		$getRule = $roles->getRule('validationRules');
		$roles->setValidationRules($getRule);
		$role = [
			'id'  				=> $this->request->getPost('id'),
			'name'          	=> $this->request->getPost('name'),           
		];

		if (! $roles->save($role)) {
			return redirect()->back()->withInput()->with('errors', $roles->errors());
        }

        // update session data

        return redirect()->route('roles')->with('success', 'role updated successfully');


	}

	public function delete($id){
		// dd($id);
		$roles = new RoleModel();
		$role  =  $roles->find($id);

		// dd($role['id']);
		if(!isset($role)){
			return redirect()->route('roles')->with('error', 'role not deleted');
		}

		$roles->delete($id);
		return redirect()->route('roles')->with('success', 'role deleted successfully');
		
	}



	//--------------------------------------------------------------------

}
