<?php
/**
 * 公告菜单模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Notice_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'curio_notice';
        // $this->fields = 'id, url_en, url_tc, pic, sort';
    }


    /**
     * 查询菜单数据
     * @return [type] [description]
     */
    public function search() {
        $query = $this->db->order_by('id asc, sort desc')->get($this->table);
        $list = $query->result_array();
        return $list;
    }



}
