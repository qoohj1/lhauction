<?php
/**
 * 应用基础控制器
 *
 * @author linzequan <lowkey361@gmail.com>
 *
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->resource_url = $this->config->item('base_url') . 'www/views/static/';
    }


    /**
     * 显示页面，自动加上头部和尾部
     * @param  [type] $page [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */

    public function showPage($page, $data) {
        $this->load->view('include/index_header', $data);
        $this->load->view($page, $data);
        $this->load->view('include/index_footer', $data);
    }


    public function https_request($url, $data=null) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if(!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }


    /**
     * 检查用户登录
     * @return [type] [description]
     */
    public function checkLogin() {
        if(!$this->session->userdata('userinfo')) {
            header('Location:' . $this->config->item('base_url') . 'user/login');
        }
    }


    /**
     * 获取用户请求ip地址
     * @return [type] [description]
     */
    public function getIP() {
        $ip = '0.0.0.0';
        if(isset($_SERVER['HTTP_X_REAL_IP'])) {
            // nginx 代理模式下，获取客户端真实ip
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        } elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
            // 客户端的ip
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // 浏览当前页面的用户计算机的网关
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if(false!==$pos) unset($arr[$pos]);
            $ip = trim($arr[0]);
        } elseif(isset($_SERVER['REMOTE_ADDR'])) {
            // 浏览当前页面的用户计算机的ip地址
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }


    /**
     * 标准化请求输出
     *
     * @param boolean $success 操作是否成功
     * @param integer $error 操作错误编码
     * @param mixed $data 操作错误提示或结果数据输出
     * @return string {success:false, error:0, data:''}
     */
    public function output_result($success=false, $error=0, $data='') {
        if(is_array($success)==true) {
            echo json_encode($success);
        } else {
            echo json_encode(array('success'=>$success, 'error'=>$error, 'data'=>$data));
        }
        exit;
    }


    public function get_request($key, $default='') {
        return get_value($_REQUEST, $key, $default);
    }

    // 初始化头部脚部

    public function init_head_foot(){
      $data['resource_url'] = $this->resource_url;
      $data['base_url'] = $this->config->item('base_url');
      $this->data = $data;
      $this->lang->load('headfoot');
      $this->data['home'] = lang('hf_home');
      $this->data['css'] = lang('hf_css');
      $this->data['title'] = lang('hf_title');
      $this->data['og_description'] = lang('hf_og_description');
      $this->data['description'] = lang('hf_description');
      $this->data['placeholder'] = lang('hf_placeholder');
      $this->data['navi1'] = lang('hf_navi1');
      $this->data['navi2'] = lang('hf_navi2');
      $this->data['navi3'] = lang('hf_navi3');
      $this->data['navi4'] = lang('hf_navi4');
      $this->data['navi5'] = lang('hf_navi5');
      $this->data['navi6'] = lang('hf_navi6');
      $this->data['subnavi1'] = lang('hf_subnavi1');
      $this->data['subnavi2'] = lang('hf_subnavi2');
      $this->data['subnavi3'] = lang('hf_subnavi3');
      $this->data['subnavi4'] = lang('hf_subnavi4');
      $this->data['subnavi5'] = lang('hf_subnavi5');
      $this->data['subnavi6'] = lang('hf_subnavi6');
      $this->data['subnavi7'] = lang('hf_subnavi7');
      $this->data['subnavi8'] = lang('hf_subnavi8');
      $this->data['subnavi9'] = lang('hf_subnavi9');
      $this->data['contact'] = lang('hf_contact');
      $this->data['sitemap'] = lang('hf_sitemap');
      $this->data['terms'] = lang('hf_terms');
      $this->data['privacy'] = lang('hf_privacy');
      $this->data['notice'] = lang('hf_notice');
      $this->data['copyright'] = lang('hf_copyright');
      $this->data['curNav'] = $this->uri->segment(2);
      $this->data['curLang'] = $this->uri->segment(1);
      $this->load->model('category_model');
      $this->data['categorylist'] = $this->category_model->search();
      $my_lang = $this->uri->segment(1);
      $this->load->helper('url');
      if($my_lang != 'en' && $my_lang != 'tc'){
        redirect($this->data['base_url'].'tc/'.$this->uri->segment(1));
      }

    }
}
