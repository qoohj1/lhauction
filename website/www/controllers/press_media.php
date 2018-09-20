<?php
/**
 * 新闻稿及相册控制器
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Press_media extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->init_head_foot();
    }


    public function index() {
      $this->load->model('press_media_model');
      $this->load->model('press_release_model');
      $this->data['submenu'] = $this->press_release_model->search();
      $this->data['searchNews'] = $this->press_media_model->search();
      // var_dump($this->data['searchNews']);
      $this->showPage('press_media_index', $this->data);
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
