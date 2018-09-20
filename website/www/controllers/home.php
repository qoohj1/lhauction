<?php
/**
 * 首页控制器
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }


    public function index() {
        $this->init_head_foot();
        $this->load->model('static_model');
        $this->load->model('pic_content_model');
        $this->load->model('pic_clazz_model');
        $this->load->model('indexbg_model');
        $this->data['newcontent'] = $this->static_model->latest();
        $this->data['pic_clazz'] = $this->pic_clazz_model->search();
        $this->data['indexbg'] = $this->indexbg_model->search();
        foreach ($this->data['pic_clazz'] as $k => &$v) {
          $id = $v['id'];
          $v['pic_content'] = $this->pic_content_model->search($id);
        }
        $this->showPage('index', $this->data);
    }


    public function get() {
        $actionxm = $this->get_request('actionxm');
        $result = array();
        switch($actionxm) {
          case 'getBanner':
              $this->load->model('banner_model');
              $result = $this->banner_model->search();
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
