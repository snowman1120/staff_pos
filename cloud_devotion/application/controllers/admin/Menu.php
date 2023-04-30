<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/core/AdminController.php';

class Menu extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct(ROLE_ADMIN);

        $this->load->model('setting_model');
        $this->load->model('staff_model');
        $this->load->model('order_item_model');

        $this->header['page'] = 'menu';
        $this->header['title'] = 'メニュー管理';

    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $mode = $this->input->post('mode');

        $this->data['search'] =  $this->input->post('searchText') ? $this->input->post('searchText') : '';

        $this->load->library('pagination');

        $this->data['list_cnt'] = $this->staff_model->getList('*', $this->data['search'],true);
        $returns = $this->_paginationCompress( "admin/staff/index", $this->data['list_cnt'], 10 ,4);

        $this->data['start_page']  = $returns["segment"]+1;
        $this->data['end_page']  = $returns["segment"]+$returns["page"];
        if($this->data['end_page']>$this->data['list_cnt']) $this->data['end_page'] = $this->data['list_cnt'];
        if(!$this->data['start_page']) $this->data['start_page'] = 1;

        $this->data['list'] = $this->order_item_model->getList('*',$this->data['search'],false,$returns['page'],$returns['segment']);

        $this->_load_view_admin("admin/menu/index");
    }

    public function edit($_id)
    {
        if($_id == null)
        {
            redirect('admin/menu');
        }

        $menu = $this->order_item_model->getFromId($_id);
        if(empty($menu))
        {
            redirect('admin/menu');
        }
        $mode = $this->input->post('mode');
        if($mode == 'save'){

           $this->data['menu'] = array(
                'item_id'=>$_id,
                'item_title'=>$this->input->post('item_title'),
                'item_amount'=>$this->input->post('item_amount'),
            );

            $this->form_validation->set_rules('item_title','メニュー名','trim|required|max_length[128]');
            $this->form_validation->set_rules('item_amount','金額','trim|required|max_length[128]');

            if($this->form_validation->run() === TRUE){
                    $this->data['menu']['update_date'] = date('Y-m-d H:i:s');

                    $result = $this->order_item_model->edit($this->data['menu'],'item_id');
                    if($result){
                        $this->session->set_flashdata('success', '正常に更新されました。');
                        $this->session->set_flashdata('error', '');
                    }else{
                        $this->session->set_flashdata('success', '');
                        $this->session->set_flashdata('error', '更新に失敗しました。');
                    }
            }

        }else{
            $this->data['menu'] = $menu;
        }

        $this->_load_view_admin("admin/menu/edit");

    }
    /**
     * This function is used to load the user list
     */
    function add()
    {
        $mode = $this->input->post('mode');
        if($mode == 'save'){

            $this->data['menu'] = array(
                'item_id'=>NULL,
                'item_title'=>$this->input->post('item_title'),
                'item_amount'=>$this->input->post('item_amount'),
            );

            $this->form_validation->set_rules('item_title','メニュー名','trim|required|max_length[128]');
            $this->form_validation->set_rules('item_amount','金額','trim|required|max_length[128]');

            if($this->form_validation->run() === TRUE)
            {

                $this->data['menu']['del_flag'] = 0;
                $this->data['menu']['create_date'] = date('Y-m-d H:i:s');
                $this->data['menu']['update_date'] = date('Y-m-d H:i:s');
                $result = $this->order_item_model->add($this->data['menu']);
                if($result){
                    $this->session->set_flashdata('success', '正常に登録されました。');
                    $this->session->set_flashdata('error', '');

                    redirect('admin/menu');

                }else{
                    $this->session->set_flashdata('success', '');
                    $this->session->set_flashdata('error', '更新に失敗しました。');
                }
            }else{
//                var_dump(validation_errors());;
            }

        }

        $this->_load_view_admin("admin/menu/add");

    }

    public function _uuid() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
    /**
     * This function is used to check whether email already exist or not
     */
    function _check_email($email,$staff_id=0)
    {
        if(empty($staff_id)){
            $result = $this->staff_model->checkEmailExists($email);
        } else {
            $result = $this->staff_model->checkEmailExists($email, $staff_id);
        }

        return empty($result) ? true: false;
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function delete()
    {
        $userId = $this->input->post('userId');

        $result = $this->staff_model->delete($userId,'staff_id');

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }


    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistoy($userId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $userId = ($userId == NULL ? 0 : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->user_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress ( "login-history/".$userId."/", $count, 10, 3);

            $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'ユーザー：ログイン履歴';
            
            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }        
    }

    /**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
        $data["userInfo"] = $this->user_model->getUserInfoWithRole($this->vendorId);
        $data["active"] = $active;
        
        $this->global['pageTitle'] = $active == "詳細" ? 'パスワード変更' : 'プロフィール編集';
        $this->loadViews("profile", $this->global, $data, NULL);
    }

    /**
     * This function is used to update the user details
     * @param text $active : This is flag to set the active tab
     */
    function profileUpdate($active = "details")
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]|callback_emailExists');        
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $name = strtolower($this->security->xss_clean($this->input->post('fname')));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            
            $userInfo = array('name'=>$name, 'email'=>$email, 'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->editUser($userInfo, $this->vendorId);
            
            if($result == true)
            {
                $this->session->set_userdata('name', $name);
                $this->session->set_flashdata('success', 'パスワードの更新に成功しました。');
            }
            else
            {
                $this->session->set_flashdata('error', 'パスワードの更新に失敗しました。');
            }

            redirect('profile/'.$active);
        }
    }

    /**
     * This function is used to change the password of the user
     * @param text $active : This is flag to set the active tab
     */
    function changePassword($active = "changepass")
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');

        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');

            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);

            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('profile/'.$active);
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));

                $result = $this->user_model->changePassword($this->vendorId, $usersData);

                if($result > 0) { $this->session->set_flashdata('success', 'パスワードの更新に成功しました。'); }
                else { $this->session->set_flashdata('error', 'パスワードの更新に失敗しました。'); }

                redirect('profile/'.$active);
            }
        }
    }

    /**
     * This function is used to check whether email already exist or not
     * @param {string} $email : This is users email
     */
    function emailExists($email)
    {
        $userId = $this->vendorId;
        $return = false;

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ $return = true; }
        else {
            $this->form_validation->set_message('emailExists', 'The {field} already taken');
            $return = false;
        }

        return $return;
    }
}

?>