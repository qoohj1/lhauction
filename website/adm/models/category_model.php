<?php
/**
 * 系统菜单模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Category_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'app_category';
        $this->fields = 'id, status, name_en, name_tc';
        $this->loginInfo = $this->session->userdata('loginInfo');
    }


    /**
     * 查询菜单数据
     * @return [type] [description]
     */
    public function search() {
        $query = $this->db->order_by('id asc')->get($this->table);
        $list = $query->result_array();
        $status = ['hide', 'show'];
        foreach($list as &$item) {
          if(isset($item['status'])){
            $item['status'] = $status[$item['status']];
          }else{
            $item['status'] = '';
          }
        }
        return array(
            'status'    => 0,
            'msg'       => '操作成功！',
            'data'      => array_values($list)
        );
    }

    /**
     * 添加菜单
     * @param [type] $params [description]
     */
    public function add($params) {
        $msg = '';
        if($params['status']=='') $msg = '狀態不可為空！';
        if($params['name_en']=='') $msg = '英文名不可為空！';
        if($params['name_tc']=='') $msg = '中文名不可為空！';
        if($msg != '') {
            return array(
                'status'    => -1,
                'msg'       => $msg
            );
        }
        $data = array(
            'status'          => $params['status'],
            'name_en'     => $params['name_en'],
            'name_tc'          => $params['name_tc']
        );
        $this->db->insert($this->table, $data);
        return array(
            'status'    => 0,
            'msg'       => '操作成功！'
        );

    }


    /**
     * 更新菜单信息
     * @param  [type] $params [description]
     * @param  [type] $where  [description]
     * @return [type]         [description]
     */
    public function update($params, $where) {
        $data = array(
            'status'          => $params['status'],
            'name_en'     => $params['name_en'],
            'name_tc'          => $params['name_tc']
        );
        $this->db->where($where)->update($this->table, $data);
        return array(
            'status'    => 0,
            'msg'       => '操作成功！'
        );
    }


    /**
     * 删除菜单
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id) {

        $this->db->delete($this->table, array('id'=> $id));
        return array(
            'status'    => 0,
            'msg'       => '操作成功！'
        );
    }


    /**
     * 根据菜单ID查询菜单信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getMenuById($id) {

        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . ' where `id`=' . $id);
        $result = $query->result_array();
        return array(
            'status'    => 0,
            'msg'       => '操作成功！',
            'data'      => $result[0]
        );

    }


}
