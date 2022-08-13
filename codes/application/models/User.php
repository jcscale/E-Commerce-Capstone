<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Model {


    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users')->result_array();
        return $query[0];
    }

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

    
    public function create_user($user) {
        $this->output->enable_profiler(TRUE);
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
}


?>