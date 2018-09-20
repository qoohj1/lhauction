<?php
/**
 * 网站地图控制器
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Sitemap extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->init_head_foot();
    }


    public function index() {
      // $this->load->model('sitemap_model');
      $this->data['auctionCate'] = $this->category_model->searchParent();
      $this->showPage('sitemap_index', $this->data);
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
