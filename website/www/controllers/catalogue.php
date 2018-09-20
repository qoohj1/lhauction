<?php
/**
 * 产品目录控制器
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Catalogue extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->init_head_foot();
    }


    public function index() {
      $cid = $this->get_request('cid');
      $page = $this->get_request('page');
      $this->load->model('catalogue_model');
      if(empty($cid)){
        $cid = $this->catalogue_model->getcid();
        if($cid){
            $this->load->helper('url');
            redirect($this->data['base_url'].$this->uri->segment(1).'/'.$this->uri->segment(2).'?cid='.$cid);
        }else{
            // header("location: ".);            
        }
      }
      $this->data['catalogue'] = $this->catalogue_model->search($cid, $page);
      $this->load->model('notice_model');
      $this->data['notice'] = $this->notice_model->search();
      $this->data['catalogueParent'] = $this->catalogue_model->searchParent($cid);
      $this->load->library('pagination');
      $config['page_query_string'] = true;
      $config['use_page_numbers'] = TRUE;
      $config['query_string_segment'] = 'page';
      $config['base_url'] = $this->config->item('base_url').'/'.$this->uri->segment(1).'/'.$this->uri->segment(2).'/?cid='.$cid;
      $config['total_rows'] = $this->data['catalogue']['total'];//总共多少条数据
      $config['per_page'] = $this->data['catalogue']['size'];//每页显示几条数据
      $config['full_tag_open'] = '<p>';
      $config['full_tag_close'] = '</p>';
      $config['first_link'] = '<img src='.$this->resource_url.'img/page/first.png>';
      $config['first_tag_open'] = '<li>';//“第一页”链接的打开标签。
      $config['first_tag_close'] = '</li>';//“第一页”链接的关闭标签。
      $config['last_link'] = '<img src='.$this->resource_url.'img/page/last.png>';//你希望在分页的右边显示“最后一页”链接的名字。
      $config['last_tag_open'] = '<li>';//“最后一页”链接的打开标签。
      $config['last_tag_close'] = '</li>';//“最后一页”链接的关闭标签。
      $config['next_link'] = '<img src='.$this->resource_url.'img/page/next.png>';//你希望在分页中显示“下一页”链接的名字。
      $config['next_tag_open'] = '<li>';//“下一页”链接的打开标签。
      $config['next_tag_close'] = '</li>';//“下一页”链接的关闭标签。
      $config['prev_link'] = '<img src='.$this->resource_url.'img/page/pre.png>';//你希望在分页中显示“上一页”链接的名字。
      $config['prev_tag_open'] = '<li>';//“上一页”链接的打开标签。
      $config['prev_tag_close'] = '</li>';//“上一页”链接的关闭标签。
      $config['cur_tag_open'] = '<li class="current">';//“当前页”链接的打开标签。
      $config['cur_tag_close'] = '</li>';//“当前页”链接的关闭标签。
      $config['num_tag_open'] = '<li>';//“数字”链接的打开标签。
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);


      $this->showPage('catalogue_index', $this->data);

    }

    public function detail() {
      $id = $this->get_request('id');
      $this->load->model('catalogue_model');
      $this->data['catalogueDetail'] = $this->catalogue_model->searchDetail($id);
      $cid = $this->data['catalogueDetail']->clazz_id;
      $this->data['catalogueParent'] = $this->catalogue_model->searchParent($cid);
      $this->data['firstLast'] = $this->catalogue_model->firstLast($id, $cid);
      $this->data['otheritem'] = $this->catalogue_model->otheritem($id, $cid);
      $this->showPage('catalogue_detail', $this->data);
    }

    public function search() {
      $text = $this->input->post('searchText');
      $this->load->model('catalogue_model');
      $this->data['searchResult'] = $this->catalogue_model->searchText($text);
      $this->data['text'] = $text;
      $this->showPage('catalogue_search', $this->data);
    }


    public function get() {
        $this->load->model('catalogue_model');
        $actionxm = $this->get_request('actionxm');
        $id = $this->get_request('id');
        $result = array();
        switch($actionxm) {
          // case 'getaid':
          //     $result = $this->catalogue_model->getParent($id);
          //     break;
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
