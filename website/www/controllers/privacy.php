<?php
/**
 * 個人隱私控制器
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Privacy extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->init_head_foot();
    }


    public function index() {
      $this->load->model('static_model');
      $this->data['privacy1'] = $this->static_model->privacy();
      $this->showPage('privacy_index', $this->data);
    }


    public function get() {
        $actionxm = $this->get_request('actionxm');
        $result = array();
        switch($actionxm) {
          case 'search':
              // $result = $this->banner_model->search();
              break;
        }
        echo json_encode($result);
    }


    public function post() {
        $actionxm = $this->get_request('actionxm');
        $result = array();
        switch($actionxm) {
        }
        echo json_encode($result);
    }

}
