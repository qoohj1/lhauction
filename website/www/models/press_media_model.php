<?php
/**
 * 媒體報導菜单模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Press_media_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'curio_content';
        $this->table2 = 'curio_clazz';
        // $this->fields = 'id, name_en, name_tc, parent_id, sort';
    }

    /**
     * 查询媒體報導數據
     * @return [type] [description]
     */
    public function getMedia($id) {
        $array = array('id' => $id, 'clazz_id' => 2);
        $query = $this->db->where($array)->get($this->table);
        $list = $query->row();
        return $list;
    }

    /**
     * 查询媒體報導數據
     * @return [type] [description]
     */
    public function search() {
        $query = $this->db->where('clazz_id', 2)->order_by('create_time desc,id asc')->get($this->table);
        $list = $query->result_array();
        return $list;
    }

    /**
     * 查询媒體報導子菜單数据
     * @return [type] [description]
     */
    public function searchNews($id) {
        if(!empty($id)){
          $query = $this->db->where('clazz_id', $id)->order_by('id asc')->get($this->table2);
        }else{
          $query = $this->db->where('parent_id', 1)->order_by('sort desc, id asc')->limit(1)->get($this->table);
          $arr = $query->row();
          $query = $this->db->where('clazz_id', $arr->id)->get($this->table2);
        }
        $list = $query->result_array();
        return $list;
    }




}
