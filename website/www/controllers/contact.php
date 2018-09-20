<?php
/**
 * 联络我们控制器
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Contact extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('mailer');
    }


    public function index() {
      $this->init_head_foot();
      $this->load->model('static_model');
      $this->data['contact1'] = $this->static_model->contact();
      $this->showPage('contact_index', $this->data);
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
        $this->load->model('contact_model');
        $actionxm = $this->get_request('actionxm');
        $result = array();
        switch($actionxm) {
          case 'cataRequest':
            $params = $this->get_request('params');
            $result = $this->contact_model->cataRequest($params);
            if ($result['status']==0) {
                $this->mailer->MakeMailInfo('email', 'haha', 'test');
        	    $this->mailer->addAddress('113182191@qq.com', 'hj');
                $res = $this->mailer->send();
            }
            break;
        }
        echo json_encode($result);
    }

}
