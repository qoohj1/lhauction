<?php
/**
 * 图片展控制器
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Web extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }


    public function getMedia() {
        $id = $this->get_request('id');
        $this->load->model('press_media_model');
        $this->data['press_media'] = $this->press_media_model->getMedia($id);
        if($this->data['press_media']->pdf_tc){
            $url = $this->data['press_media']->pdf_tc;
            header("location: ".$url);
        }else{
            $this->load->view('web', $this->data);
        }
    }


    public function get() {
        $actionxm = $this->get_request('actionxm');
        $result = array();
        switch($actionxm) {
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
