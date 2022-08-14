<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Model {

     /*  DOCU: This function will get the email of the user.
        Owner: JC
    */
    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users')->result_array();
        return $query[0];
    }

     /*  DOCU: This function will validate the input fields during signup.
        Owner: JC
    */
    public function validate_signup($email) {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else if($this->user->get_user_by_email($email)) {
            return "Email already taken";
        }
    }

     /*  DOCU: This function will create new user in the database.
        Owner: JC
    */
    public function create_user($user) {
        // $this->output->enable_profiler(TRUE);
        $hashPassword = password_hash($user['password'], PASSWORD_DEFAULT);

        $row = $this->db->count_all_results('users');

        if($row == 0) {
            $account = array(
                'is_admin' => 1,
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'password' => $hashPassword
            );
        }
        else {
            $account = array(
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'password' => $hashPassword
            );
        }

        $query = $this->db->insert('users', $account);
        return $query;
    }

     /*  DOCU: This function will validate the sigin form if there are no errors.
        Owner: JC
    */
    public function validate_signin_form() {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else {
            return 'success';
        }
    }

     /*  DOCU: This function will match the records in the database base on the email and password.
        Owner: JC
    */
    public function validate_signin_match($user, $password) {
        if ($user && password_verify($password, $user['password'])) {
            return "success";
        }
        else {
            return "Incorrect email/password";
        }
    }

}


?>