<?php
/**
 * 站内通知控制器
 *
 * @author linzequan <lowkey361@gmail.com>
 *
 */
class Notice extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
        $this->load->model('notice_model');
        $data['resource_url'] = $this->resource_url;
        $data['admin_info'] = $this->session->userdata('loginInfo');
        $data['base_url'] = $this->config->item('base_url');
        $data['current_menu'] = 'notice';
        $data['current_menu_text'] = '站内通知';
        $data['sub_menu'] = array();
        $data['menu_list'] = $this->getMenuList();
        $this->data = $data;
    }


    public function index() {
        $this->load->view('include/_header', $this->data);
        $this->load->view('notice_index', $this->data);
        $this->load->view('include/_footer', $this->data);
    }


    public function get() {
        $actionxm = $this->get_request('actionxm');
        $result = array();
        switch($actionxm) {
            case 'search':
                $result = $this->notice_model->search();
                break;
            case 'detail':
                $id = $this->get_request('id');
                $result = $this->notice_model->getInfoById($id);
                break;
        }
        echo json_encode($result);
    }

    public function post() {
        $actionxm = $this->get_request('actionxm');
        $result = array();
        switch($actionxm) {
            case 'add':
                $params = $this->get_request('params');
                $result = $this->notice_model->add($params);
                break;
            case 'update':
                $id = $this->get_request('id');
                $params = $this->get_request('params');
                $result = $this->notice_model->update($params, array('id'=> $id));
                break;
            case 'delete':
                $id = $this->get_request('id');
                $result = $this->notice_model->delete($id);
                break;
        }
        echo json_encode($result);
    }
}
