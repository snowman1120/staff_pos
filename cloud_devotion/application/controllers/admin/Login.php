<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/AdminController.php';

class Login extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();

        if($this->_login_check(ROLE_ADMIN)) {
            redirect('/admin/dashboard');
        }
        $this->load->model('admin_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->data = array(
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('password'),
        );
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[255]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[255]');

        if($this->form_validation->run() === TRUE)
        {
            $admin_user = $this->admin_model->login($this->data);
            if(!empty($admin_user)){
                $this->session->set_userdata('admin',$admin_user);
                redirect('/admin/dashboard');
            }else{
                $this->session->set_flashdata('error', 'メールアドレスまたはパスワードが正しくありません。');
            }

        }
        $this->load->view('/admin/login');
    }

}