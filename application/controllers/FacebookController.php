<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FacebookController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('admin/User_model','User');
        $this->load->model('user/Common_model','Common');
		// Load library and url helper
		$this->load->library('facebook');
		$this->load->helper('url');
                $this->load->model('user/Common_model','Common');
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
	}

	// ------------------------------------------------------------------------

	/**
	 * Index page
	 */
	public function index()
	{
           // $this->load->view('examples/start');
           redirect('login');
	}

	// ------------------------------------------------------------------------

	/**
	 * Web redirect login example page
	 */
	public function web_login()
	{
		$data['user'] = array();

		// Check if user is logged in
		if ($this->facebook->is_authenticated())
		{
			// User logged in, get user details
			$user = $this->facebook->request('get', '/me?fields=id,name,email,first_name,last_name,picture.type(large)');
			if (!isset($user['error']))
			{
			    $this->session->set_userdata('web_login', true);
			    
			    $check = $this->User->get_user($user['email']);
                $checkCount = $this->User->get_user_count($user['email']);
                
                $session_data = array(
                    'id'=> $check->ID,
                    'first_name'=> $user['first_name'],
                    'user_name' => $user['email'],
                    'profile'=> $user['picture']['data']['url'],
                    'accountType'=> $check->AccountType,
                    'type' => 1
                );
                $this->session->set_userdata('user_profile', $session_data);
                //if database in not avaliable data then insert data
                if($checkCount <= 0){
                    $data=array(
                        'SocialID'=> $user['id'],
                        'FirstName'=> $user['first_name'],
                        'LastName'=> $user['last_name'],
                        'UserName'=> $user['email'],
                        'Profile'=>$user['picture']['data']['url'],
                       // 'Token'=>  $this->googleplus->getAccessToken(),
                        //'link'=>$userData['link'],
                        'RegisterType'=>1,
                    );
                    $data = $this->User->add_user($data);
                    $r_data = $this->User->get_user_id($data);
                    $session_data = array(
                        'id'=> $r_data->ID,
                        'first_name'=> $user['first_name'],
                        'user_name' => $user['email'],
                        'profile'=> $user['picture']['data']['url'],
                        'accountType'=> $r_data->AccountType,
                        'type' => 1
                    );
                    $this->session->set_userdata('user_profile', $session_data);
                    //print_r($check); exit();
                    if($data){
                        redirect('google_profile');
                    }
                }else{
                    redirect('google_profile');
                }
			
			}

		}

		// display view
               // if($this->facebook->is_authenticated()){
                   // $this->load->view('examples/web', $data);
                  // echo json_encode($user, true);
                  // echo $user['picture']['data']['url'];
                 // echo $user['name'];
                 //  foreach($user as $key=>$value){
                      
                     //  echo $key.'-'.$value.'<br>';
                    // echo json_encode($value, true);
                 //  }
               // }else{
                   // $this->load->view('admin/auth/login');
               //    redirect('login');
              //  }
		
	}

	// ------------------------------------------------------------------------

	/**
	 * JS SDK login example
	 */
	public function js_login()
	{
		// Load view
		$this->load->view('examples/js');
	}

	// ------------------------------------------------------------------------

	/**
	 * AJAX request method for positing to facebook feed
	 */
	public function post()
	{
		header('Content-Type: application/json');

		$result = $this->facebook->request(
			'post',
			'/me/feed',
			['message' => $this->input->post('message')]
		);

		echo json_encode($result);
	}

	// ------------------------------------------------------------------------

	/**
	 * Logout for web redirect example
	 *
	 * @return  [type]  [description]
	 */
	public function logout()
	{
		$this->facebook->destroy_session();
		redirect('login', redirect);
	}
}
