<?php
/**
 * 拍卖会目录菜单模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Pic_clazz_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'curio_pic_clazz';
        $this->fields = 'id, name_en, name_tc, parent_id, pic, sort';
    }


    /**
     * 查询首页拍卖会目录数据
     * @return [type] [description]
     */
    public function search() {
        $query = $this->db->where('parent_id !=', 0)->order_by('sort desc, id asc')->limit(3)->get($this->table);
        $list = $query->result_array();
        return $list;
    }




}
