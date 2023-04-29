<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/core/AdminController.php';

class Menu extends AdminController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct(ROLE_STAFF);
        if ($this->staff['staff_auth'] < 4) {
            redirect('login');
        }

        $this->header['page'] = 'menu';
        $this->header['sub_page'] = 'menu';
        $this->header['title'] = 'メニュー';

        $this->load->model('category_model');
        $this->load->model('menu_model');
        
        $this->data['categories'] = $this->category_model->getCategoryList([]);
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $search_word = $this->input->post('search_word', '');

        $this->data['search_word'] = $search_word;
        $company_id = 2;

        $cond['company_id'] = 2;
        $cond['is_user_menu'] = 1;
        $cond['word'] = $search_word;
        $this->data['menus'] = $this->menu_model->getMenuList($cond);
        
        $menu_id = $this->input->get('id', '');

        if (empty($menu_id)){
            $menu = [
                'menu_id' => '',
                'menu_title' => '',
                'menu_price' => '',
                'menu_detail' => '',
                'sort_no' => '',
                'is_user_menu' => 0,
                'menu_time' => '',
                'category_id' => ''
            ];
        }else{
            $menu = $this->menu_model->getMenuInfo($menu_id);
        }

        $this->data['menu'] = $menu;
        
        $this->load_view_with_menu("menu/menu.php");
    }
    
    public function save()
    {
        $menu_id = $this->input->post('menu_id');
        $category_id = $this->input->post('category_id');


        $this->load->library('form_validation');
        $this->form_validation->set_rules('menu_id', 'menu_id', 'required', array('required'=>'メニューを選択してください。')); 
        if ($this->form_validation->run() !== true){
            $this->data['menu'] = [
                'menu_id' => '',
                'menu_title' => '',
                'menu_price' => '',
                'menu_detail' => '',
                'sort_no' => '',
                'is_user_menu' => 0,
                'menu_time' => '',
                'category_id' => ''
            ];;
            $this->data['search_word'] = $this->input->post('search_word', '');

            $cond['company_id'] = 2;
            $cond['is_user_menu'] = 1;
            $this->data['menus'] = $this->menu_model->getMenuList($cond);
            
            $this->load_view_with_menu("menu/menu.php");
            return;
        }

        $menu = $this->menu_model->getFromId($menu_id);
        $menu['category_id'] = $category_id;
        $this->menu_model->updateRecord($menu, 'menu_id');
        
        redirect('/menu/menu/index?id='.$menu_id);
    }

    public function delete()
    {
        $id = $this->input->post('id');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'name', 'required', array('required'=>'エラーが発生しました。')); 
        if ($this->form_validation->run() !== true){
            $this->data['category'] = array(
                'id' => '',
                'code' => '',
                'name' => '',
                'alias' => '',
                'description' => '',
                'order_no' => '',
                'color' => ''
            );
            $this->data['search_word'] = $this->input->post('search_word', '');

            $this->data['categories'] = $this->category_model->getCategoryList(['word'=>$this->data['search_word']], 'order_no');
            
            $this->load_view_with_menu("menu/category.php");
            return;
        }

        $this->category_model->delete_force($id, 'id');
        
        redirect('/menu/category/index');
    }
}
?>
