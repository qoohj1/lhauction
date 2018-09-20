<?php
/**
 * 图录模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Pic_content_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'curio_pic_content';
        $this->fields = 'id, title_en, title_tc, clazz_id, pic, num, prize_en, prize_tc, descript_en, descript_tc, sort';
    }


    /**
     * 查询首页图录数据
     * @return [type] [description]
     */
    public function search($id) {
        $query = $this->db->where('clazz_id', $id)->order_by('create_time desc,sort desc, id asc')->limit(4)->get($this->table);
        $list = $query->result_array();
        return $list;
    }




}
