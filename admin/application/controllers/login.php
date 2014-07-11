<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
public function index() {
	    if( $this->session->userdata('isLoggedIn') ) {
	        redirect('entrada','refresh');
	    } else {

	        $this->show_login(false);
	    }

	}
	public function show_login( $show_error = false ) {
    $data['error'] = $show_error;

    $this->load->helper('form');
    $data['pg']="sss";
    $data['title']="Entrar";
    $session_data = $this->session->userdata('isLoggedIn');
        $data['logged'] = $session_data;
    $data["content"]="login/login";
    $this->load->view('template',$data);
}
	public function login_user() {
      // Create an instance of the user model

      // Grab the username and password from the form POST
      $username = $this->input->post('username');
      $pass  = $this->input->post('password');

      //Ensure values exist for username and pass, and validate the user's credentials
      if( $username && $pass && $this->validate_user($username,$pass)) {
          // If the user is valid, redirect to the main view
          redirect(base_url());
      } else {
          // Otherwise show the login screen with an error message.
          $this->show_login(true);
      }
  }

  public function validate_user( $username, $password ) {
    // Build a query to retrieve the user's details
    // based on the received username and password


    // The results of the query are stored in $login.
    // If a value exists, then the user account exists and is validated
    if ($username=="adminHelena" && $password=="adminHelena99") {
            // Call set_session to set the user's session vars via CodeIgniter
        $this->set_session();
        return true;
    }

    return false;
}

function set_session() {
    // session->set_userdata is a CodeIgniter function that
    // stores data in a cookie in the user's browser.  Some of the values are built in
    // to CodeIgniter, others are added (like the IP address).  See CodeIgniter's documentation for details.
    $this->session->set_userdata( array(
            'isLoggedIn'=>true
        )
    );
}
public function logout() {
$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
$this->output->set_header('Pragma: no-cache');
		$this->session->unset_userdata('isLoggedIn');
        $this->session->sess_destroy();
        redirect("../");
    }
}


/* End of file login.php */
/* Location: ./application/controllers/login.php */