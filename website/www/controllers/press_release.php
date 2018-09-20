<?php
/**
 * 媒体报导控制器
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Press_release extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->init_head_foot();
    }


    public function index() {
      $id = $this->get_request('id');
      $page = $this->get_request('page');
      $this->load->model('press_release_model');
      if(empty($id)){
        $id = $this->press_release_model->getid();
        $this->load->helper('url');
        redirect($this->data['base_url'].$this->uri->segment(1).'/'.$this->uri->segment(2).'?id='.$id);
      }
      $this->data['submenu'] = $this->press_release_model->search();
      $this->data['searchNews'] = $this->press_release_model->searchNews($id, $page);
      // $total_nums=$data['searchNews']['total']; //这里得到从数据库中的总页数
      // $data['query']=$data[0]; //把查询结果放到$data['query']中
      // var_dump($this->data['searchNews']);
      $this->load->library('pagination');
      $config['page_query_string'] = true;
      $config['use_page_numbers'] = TRUE;
      $config['query_string_segment'] = 'page';
      $config['base_url'] = $this->config->item('base_url').'/'.$this->uri->segment(1).'/'.$this->uri->segment(2).'/?id='.$id;
      $config['total_rows'] = $this->data['searchNews']['total'];//总共多少条数据
      $config['per_page'] = $this->data['searchNews']['size'];//每页显示几条数据
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
      // var_dump($this->data['searchNews']);
      $this->showPage('press_release_index', $this->data);
    }


    public function detail() {
      $id = $this->get_request('id');
      $this->load->model('press_release_model');
      $this->data['submenu'] = $this->press_release_model->search();
      $this->data['pressDetail'] = $this->press_release_model->searchDetail($id);
      $this->showPage('press_release_detail', $this->data);
    }

    public function get() {
        $actionxm = $this->get_request('actionxm');
        $result = array();
        switch($actionxm) {
          case 'getPage':
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
