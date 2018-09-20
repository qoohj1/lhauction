<?php
/**
 * 往届拍卖控制器
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Auction_past extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->init_head_foot();
    }


    public function index() {
      $aid = $this->get_request('aid');
      $this->load->model('auction_past_model');
      $this->data['auctionCate'] = $this->category_model->searchParent();
      $this->data['auctionlist'] = $this->auction_past_model->search($aid);
      // var_dump($this->data['auctionlist']);
      // var_dump($this->data['auctionlist']);
      $this->showPage('auction_past_index', $this->data);
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
