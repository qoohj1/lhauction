<?php
/**
 * 站内通知模型
 *
 * @author linzequan <lowkey361@gmail.com>
 *
 */
class Notice_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'curio_notice';
        $this->fields = 'id, content_en, content_tc, url_en, url_tc, sort';
        $this->loginInfo = $this->session->userdata('loginInfo');
    }


    /**
     * 查询菜单数据
     * @return [type] [description]
     */
    public function search($page=1, $size=20) {
        $limitStart = ($page - 1) * $size;
        $where = ' where 1=1 ';
        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . $where . ' order by `sort` desc, id desc limit ' . $limitStart . ', ' . $size);
        $result = $query->result_array();

        $pageQuery = $this->db->query('select count(1) as num from ' . $this->table);
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
     * 添加数据
     * @param [type] $params [description]
     */
    public function add($params) {
        $msg = '';
        if($params['content_en']=='') $msg = '内容（en）不可为空！';
        if($params['content_tc']=='') $msg = '内容（tc）不可为空！';
        if($params['url_en']=='') $msg = '链接（en）不可为空！';
        if($params['url_tc']=='') $msg = '链接（tc）不可为空！';

        if($msg != '') {
            return array(
                'status'    => -1,
                'msg'       => $msg
            );
        }

        $data = array(
            'content_en'    => $params['content_en'],
            'content_tc'    => $params['content_tc'],
            'url_en'        => $params['url_en'],
            'url_tc'        => $params['url_tc'],
            'sort'          => $params['sort']
        );
        $this->db->insert($this->table, $data);
        return array(
            'status'    => 0,
            'msg'       => '操作成功！'
        );
    }


    /**
     * 更新数据
     * @param  [type] $params [description]
     * @param  [type] $where  [description]
     * @return [type]         [description]
     */
    public function update($params, $where) {
        $msg = '';
        if($params['content_en']=='') $msg = '内容（en）不可为空！';
        if($params['content_tc']=='') $msg = '内容（tc）不可为空！';
        if($params['url_en']=='') $msg = '链接（en）不可为空！';
        if($params['url_tc']=='') $msg = '链接（tc）不可为空！';

        if($msg != '') {
            return array(
                'status'    => -1,
                'msg'       => $msg
            );
        }
        $data = array(
            'content_en'    => $params['content_en'],
            'content_tc'    => $params['content_tc'],
            'url_en'        => $params['url_en'],
            'url_tc'        => $params['url_tc'],
            'sort'          => $params['sort']
        );
        $this->db->where($where)->update($this->table, $data);
        return array(
            'status'    => 0,
            'msg'       => '操作成功！'
        );
    }


    public function delete($id) {
        $this->db->delete($this->table, array('id'=> $id));
        return array(
            'status'    => 0,
            'msg'       => '操作成功！'
        );
    }


    /**
     * 根据ID查询信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getInfoById($id) {
        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . ' where `id`=' . $id);
        $result = $query->result_array();
        return array(
            'status'    => 0,
            'msg'       => '操作成功！',
            'data'      => $result[0]
        );
    }
}
