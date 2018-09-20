<?php
/**
 * 新闻资讯模型
 *
 * @author linzequan <lowkey361@gmail.com>
 *
 */
class Content_model extends MY_Model {

    private $table = 'curio_content';
    private $fields = 'id, title_en, title_tc, clazz_id, pic, descript_en, descript_tc, content_en, content_tc, author_en, author_tc, create_time, update_time, create_userid, update_userid, pdf_tc, pdf_en';

    public function __construct() {
        parent::__construct();
        $this->loginInfo = $this->session->userdata('loginInfo');
    }



    /**
     * 新增/更新文章
     * @param [type] $nid    [description]
     * @param [type] $params [description]
     */
    public function add($nid, $params) {
        if($nid == 0) {
            $params['create_time'] = time();
            $params['create_userid'] = $this->loginInfo['id'];
            $this->db->insert($this->table, $params);
            $result['status'] = 0;
            $result['msg'] = '保存成功！';
            return $result;
        } else {
            $params['update_time'] = time();
            $params['update_userid'] = $this->loginInfo['id'];
            $this->db->where('id', $nid)->update($this->table, $params);
            $result['status'] = 0;
            $result['msg'] = '更新成功！';
            return $result;
        }
    }


    /**
     * 分页获取文章数据
     * @param  integer $page    [description]
     * @param  integer $size    [description]
     * @param  integer $clazzId [description]
     * @param  string  $keyword [description]
     * @return [type]           [description]
     */
    public function getList($page=1, $size=20,$keyword='',$clazzId=0) {
        $result = array();
        if($keyword!='') {
            $where = ' where title_tc like \'%'. $keyword .'%\' or title_en like \'%'. $keyword .'%\' ';
        } else {
            $where = ' where 1=1 ';
        }
        if($clazzId!=0) {
            $where .= ' and clazz_id=' . $clazzId;
        }
        $limitStart = ($page - 1) * $size;
        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . $where . ' order by create_time desc limit ' . $limitStart . ', ' . $size);
        $result = $query->result_array();

        $this->load->model('clazz_model');
        $this->load->model('admin_model');
        $CI = &get_instance();
        foreach($result as &$item) {
            if($item['clazz_id'] && $clazz_info = $CI->clazz_model->getClazzById($item['clazz_id'])) {
                $item['clazz_name_en'] = $clazz_info['data']['name_en'];
                $item['clazz_name_tc'] = $clazz_info['data']['name_tc'];
            } else {
                $item['clazz_name_en'] = '';
                $item['clazz_name_tc'] = '';
            }
            if($item['create_userid'] && $userinfo = $CI->admin_model->getAdminById($item['create_userid'])) {
                $item['create_user'] = $userinfo['data']['username'];
            } else {
                $item['create_user'] = '';
            }
            if($item['update_userid'] && $userinfo = $CI->admin_model->getAdminById($item['update_userid'])) {
                $item['update_user'] = $userinfo['data']['username'];
            } else {
                $item['update_user'] = '';
            }
            if($item['create_time']) {
                $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
            } else {
                $item['create_time'] = '';
            }
            if($item['update_time']) {
                $item['update_time'] = date('Y-m-d H:i:s', $item['update_time']);
            } else {
                $item['update_time'] = '';
            }
        }

        $pageQuery = $this->db->query('select count(1) as num from ' . $this->table . $where);
        $pageResult = $pageQuery->result_array();
        $num = $pageResult[0]['num'];
        $rtn = array(
            'total' => $num,
            'size'  => $size,
            'page'  => $page,
            'list'  => $result
        );
        return $rtn;
    }


    /**
     * 删除文章
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id) {
        $this->db->where('id', $id)->delete($this->table);
        $result['status'] = 0;
        $result['msg'] = '删除成功';
        return $result;
    }


    /**
     * 通过id获取新闻资讯详情
     * @param  [type] $nid [description]
     * @return [type]      [description]
     */
    public function getDetail($nid) {
        if($nid <= 0) {
            return false;
        }
        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . ' where id="' . $nid . '"');
        $result = $query->result_array();
        return $result[0];
    }
}
