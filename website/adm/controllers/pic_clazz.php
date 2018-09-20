<?php
/**
 * 图录分类控制器
 *
 * @author linzequan <lowkey361@gmail.com>
 *
 */
class Pic_clazz extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
        $this->load->model('pic_clazz_model');
        $data['resource_url'] = $this->resource_url;
        $data['admin_info'] = $this->session->userdata('loginInfo');
        $data['base_url'] = $this->config->item('base_url');
        $data['current_menu'] = 'pic_clazz';
        $data['current_menu_text'] = '產品分类';
        $data['sub_menu'] = array();
        $data['menu_list'] = $this->getMenuList();
        $this->data = $data;
    }


    public function index() {
        $this->showPage('pic_clazz_index', $this->data);
    }


    public function get() {
        $actionxm = $this->get_request('actionxm');
        $result = array();
        switch($actionxm) {
            case 'search':
                $result = $this->pic_clazz_model->search();
                break;
            case 'detail':
                $id = $this->get_request('id');
                $result = $this->pic_clazz_model->getClazzById($id);
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
                $result = $this->pic_clazz_model->add($params);
                break;
            case 'update':
                $id = $this->get_request('id');
                $params = $this->get_request('params');
                $result = $this->pic_clazz_model->update($params, array('id'=> $id));
                break;
            case 'delete':
                $id = $this->get_request('id');
                $result = $this->pic_clazz_model->delete($id);
                break;
            case 'uploadPdf':
                if(!empty($_FILES)) {
                    // 判断文件大小
                    if($_FILES['uploadfile']['size'] > 1024*1024*100 || $_FILES['uploadfile']['error'] != UPLOAD_ERR_OK) {
                        $result = array('status'=> -1, 'msg'=> '文件不可超过100M！');
                    } else {
                        $fileParts = pathinfo($_FILES['uploadfile']['name']);
                        $tempFile = $_FILES['uploadfile']['tmp_name'];
                        $targetFolder = '/public/pdf/pic_clazz';
                        $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
                        if(!is_dir($targetPath)) mkdir($targetPath, 0777, true);
                        $now = time() . myrandom(8);
                        $fileName = $now . '.' . $fileParts['extension'];
                        $targetFile = rtrim($targetPath, '/') . '/' . $fileName;
                        $fileTypes = array('pdf');
                        if(in_array(strtolower($fileParts['extension']), $fileTypes)) {
                            move_uploaded_file($tempFile, $targetFile);
                            $result = array('status'=> 0, 'name'=> 'http://' . $_SERVER['HTTP_HOST'] . $targetFolder . '/' . $fileName);
                        } else {
                            $result = array('status'=> -1, 'msg'=> '文件格式不正确');
                        }
                    }
                }
                break;
        }
        echo json_encode($result);
    }
}
