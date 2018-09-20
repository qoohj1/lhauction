<?php
/**
 * 首頁背景模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Indexbg_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'curio_indexbg';
        $this->fields = 'id, pic';
    }


    /**
     * 查询菜单数据
     * @return [type] [description]
     */
    public function search() {
        $query = $this->db->order_by('id asc')->get($this->table);
        $list = $query->result_array();
        return array(
            'status'    => 0,
            'list'       => $list
        );
        // return $list;
    }



}
