<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

     /*  DOCU: This function is triggered by default which displays the sign in page.
        Owner: JC
    */
    public function index() {

        $current_user_id = $this->session->userdata('user_id');

        if(!$current_user_id) {
            $this->load->view('templates/header.php');
            $this->load->view('users/signin');
            $this->load->view('templates/footer.php');
        }
        else {
            redirect('dashboards');
        }
    }

    /*  DOCU: This function will get triggered if there is no user in the session.
        Owner: JC
    */
    public function signin() {
        $current_user_id = $this->session->userdata('user_id');

        if(!$current_user_id) {
            $this->load->view('templates/header.php');
            $this->load->view('users/signin');
            $this->load->view('templates/footer.php');
        }
        else {
            redirect('dashboards');
        }
    }

    public function process_signin() {
        $result = $this->user->validate_signin_form();
        echo $result;
        if($result != "success") {
            $this->session->set_flashdata('input_errors', $result);
            redirect('signin');
        }
        else {
            $email = $this->input->post('email');
            $user = $this->user->get_user_by_email($email);
            $result = $this->user->validate_signin_match($user, $this->input->post('password'));

            if($result == 'success') {
                $this->session->set_userdata(array('user_id' => $user['id'], 'first_name' => $user['first_name']));
                redirect('dashboards');
            }
            else {
                $this->session->set_flashdata('input_errors', $result);
                redirect('signin');
            }
        }
    }

    /*  DOCU: This function will display the registration page if there is no user in the session.
        Owner: JC
    */
    public function signup() {
        $current_user_id = $this->session->userdata('user_id');

        if(!$current_user_id) {
            $this->load->view('templates/header.php');
            $this->load->view('users/signup');
            $this->load->view('templates/footer.php');
        }
        else {
            redirect('dashboards');
        }
    }

    /*  DOCU: This function will validate the user registration.
        Owner: JC
    */
    public function process_signup() {
        $email = $this->input->post('email');
        $result = $this->user->validate_signup($email);

        if($result != null) {
            $this->session->set_flashdata('input_errors', $result);
            redirect('users/signup');
        }
        else {
            $form_data = $this->input->post();
            $this->user->create_user($form_data);

            $new_user = $this->user->get_user_by_email($form_data['email']);
            $this->session->set_userdata(array('user_id' => $new_user['id'], 'first_name' => $new_user['first_name']));

            redirect('dashboards');
        }
    }

    /*  DOCU: This function will destroy the session if the user logs out.
        Owner: JC
    */
    public function logout() {
        $this->session->sess_destroy();
        redirect("/");
    }
}








?>