<?php
/**
 * 内容资讯控制器
 *
 * @author linzequan <lowkey361@gmail.com>
 *
 */
class Content extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
        $this->load->model('clazz_model');
        $this->load->model('content_model');
        $data['resource_url'] = $this->resource_url;
        $data['admin_info'] = $this->session->userdata('loginInfo');
        $data['base_url'] = $this->config->item('base_url');
        $data['current_menu'] = 'news';
        $data['current_menu_text'] = '新聞管理';
        $data['sub_menu'] = array();
        $data['menu_list'] = $this->getMenuList();
        $this->data = $data;
    }


    public function index() {
        $this->data['clazz'] = $this->clazz_model->search();
        $this->data['clazz'] = $this->data['clazz']['data'];
        $this->showPage('content_index', $this->data);
    }


    public function add($nid=0) {
        $this->data['nid'] = $nid;
        if($nid > 0) {
            // 更新
            $this->data['info'] = $this->content_model->getDetail($nid);
            $this->load->view('include/_header', $this->data);
            $this->load->view('content_update', $this->data);
            $this->load->view('include/_footer', $this->data);
        } else {
            // 新增
            $this->load->view('include/_header', $this->data);
            $this->load->view('content_add', $this->data);
            $this->load->view('include/_footer', $this->data);
        }
    }


    public function get() {
        $actionxm = $this->get_request('actionxm');
        $result = array();
        switch($actionxm) {
            case 'getList':
                $page = $this->get_request('page');
                $size = $this->get_request('size');
                $keyword = $this->get_request('keyword');
                $clazz_id = $this->get_request('clazz_id');
                $result = $this->content_model->getList($page, $size, $keyword, $clazz_id);
                break;
        }
        echo json_encode($result);
    }

    public function post() {
        $actionxm = $this->get_request('actionxm');
        $result = array();
        switch($actionxm) {
            case 'upload_photo':
                if(!empty($_FILES)) {
                    $fileParts = pathinfo($_FILES['uploadfile']['name']);
                    $tempFile = $_FILES['uploadfile']['tmp_name'];
                    $targetFolder = '/public/content/img/';
                    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
                    if(!is_dir($targetPath)) mkdir($targetPath, 0777, true);
                    $now = time();
                    $fileName = $now . '_org.' . $fileParts['extension'];
                    $compressFileName = $now . '.' . $fileParts['extension'];
                    $targetFile = rtrim($targetPath, '/') . '/' . $fileName;
                    $compressTargetFile = rtrim($targetPath, '/') . '/' . $compressFileName;
                    $fileTypes = array('jpg', 'jpeg', 'gif', 'png');
                    if(in_array(strtolower($fileParts['extension']), $fileTypes)) {
                        move_uploaded_file($tempFile, $targetFile);
                        // 开始压缩图片
                        // $this->compressImage($targetFile, $compressTargetFile);
                        $result = array('status'=> 0, 'name'=> 'http://' . $_SERVER['HTTP_HOST'] . $targetFolder . $fileName);
                    } else {
                        $result = array('status'=> -1, 'msg'=> '文件格式不正确');
                    }
                }
                break;
            case 'upload_album':
                if(!empty($_FILES)) {
                    $fileParts = pathinfo($_FILES['uploadfile']['name']);
                    $tempFile = $_FILES['uploadfile']['tmp_name'];
                    $targetFolder = '/public/content/album/';
                    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
                    if(!is_dir($targetPath)) mkdir($targetPath, 0777, true);
                    $now = time() . myrandom(8);
                    $fileName = $now . '_org.' . $fileParts['extension'];
                    $compressFileName = $now . '.' . $fileParts['extension'];
                    $targetFile = rtrim($targetPath, '/') . '/' . $fileName;
                    $compressTargetFile = rtrim($targetPath, '/') . '/' . $compressFileName;
                    $fileTypes = array('jpg', 'jpeg', 'gif', 'png');
                    if(in_array(strtolower($fileParts['extension']), $fileTypes)) {
                        move_uploaded_file($tempFile, $targetFile);
                        // 开始压缩图片
                        $this->compressImage($targetFile, $compressTargetFile);
                        $result = array('status'=> 0, 'name'=> 'http://' . $_SERVER['HTTP_HOST'] . $targetFolder . $compressFileName);
                    } else {
                        $result = array('status'=> -1, 'msg'=> '文件格式不正确');
                    }
                }
                break;
            case 'upload_contentImg':
                if(!empty($_FILES)) {
                    $fileParts = pathinfo($_FILES['file']['name']);
                    $tempFile = $_FILES['file']['tmp_name'];
                    $targetFolder = '/public/content/img_contents/';
                    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
                    if(!is_dir($targetPath)) mkdir($targetPath, 0777, true);
                    $now = time();
                    $fileName = $now . '_org.' . $fileParts['extension'];
                    $compressFileName = $now . '.' . $fileParts['extension'];
                    $targetFile = rtrim($targetPath, '/') . '/' . $fileName;
                    $compressTargetFile = rtrim($targetPath, '/') . '/' . $compressFileName;
                    $fileTypes = array('jpg', 'jpeg', 'gif', 'png');
                    if(in_array(strtolower($fileParts['extension']), $fileTypes)) {
                        move_uploaded_file($tempFile, $targetFile);
                        // 开始压缩图片
                        $this->compressImage($targetFile, $compressTargetFile);
                        $result = array('status'=> 0, 'name'=> 'http://' . $_SERVER['HTTP_HOST'] . $targetFolder . $compressFileName);
                    } else {
                        $result = array('status'=> -1, 'msg'=> '文件格式不正确');
                    }
                }
                break;
            case 'uploadPdf':
                if(!empty($_FILES)) {
                    // 判断文件大小
                    if($_FILES['uploadfile']['size'] > 1024*1024*100 || $_FILES['uploadfile']['error'] != UPLOAD_ERR_OK) {
                        $result = array('status'=> -1, 'msg'=> '文件不可超过100M！');
                    } else {
                        $fileParts = pathinfo($_FILES['uploadfile']['name']);
                        $tempFile = $_FILES['uploadfile']['tmp_name'];
                        $targetFolder = '/public/pdf/content';
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
            case 'add':
                $params = $this->get_request('params');
                $nid = $this->get_request('nid');
                $result = $this->content_model->add($nid, $params);
                break;
            case 'delete':
                $id = $this->get_request('id');
                $result = $this->content_model->delete($id);
                break;
        }
        echo json_encode($result);
    }
}
