<?php
/**
 * 新聞菜单模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Press_release_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'curio_clazz';
        $this->table2 = 'curio_content';
        // $this->fields = 'id, name_en, name_tc, parent_id, sort';
    }


    /**
     * 查询新聞稿子菜單
     * @return [type] [description]
     */
    public function search() {
        $query = $this->db->where('parent_id', 1)->order_by('sort desc, id desc')->get($this->table);
        $list = $query->result_array();
        return $list;
    }

    /**
     * 获取新聞稿子菜單id
     * @return [type] [description]
     */
    public function getid() {
        $query = $this->db->where('parent_id', 1)->order_by('sort desc, id desc')->limit(1)->get($this->table);
        $arr = $query->row();
        return $arr->id;
    }
    /**
     * 查询新聞稿子菜單数据
     * @return [type] [description]
     */
    public function searchNews($id, $page=1, $size=10) {
        if($page==0){
          $page = 1;
        }
        $limitStart = ($page - 1) * $size;
        if(!empty($id)){
          $query = $this->db->where('clazz_id', $id)->order_by('create_time desc')->limit($size, $limitStart)->get($this->table2);
          $num = $this->db->where('clazz_id', $id)->count_all_results($this->table2);
        }else{
          $query = $this->db->where('parent_id', 1)->order_by('sort desc, id asc')->limit(1)->get($this->table);
          $arr = $query->row();
          $query = $this->db->where('clazz_id', $arr->id)->order_by('create_time desc')->limit($size, $limitStart)->get($this->table2);
          $num = $this->db->where('clazz_id', $arr->id)->count_all_results($this->table2);
          // var_dump($query);
        }
        $list = $query->result_array();
        $rtn = array(
            'total' => $num,
            'size'  => $size,
            'page'  => $page,
            'list'  => $list
        );
        // var_dump($rtn);
        return $rtn;
        // return $list;
    }

    /**
     * 查询新聞稿数据
     * @return [type] [description]
     */
    public function searchDetail($id) {
        if(!empty($id)){
          $query = $this->db->where('id', $id)->order_by('id asc')->get($this->table2);
          $list = $query->row();
          if(count($list->pic)>0){
            $list->pic = explode(',', $list->pic);
          }
        }else{
          $list = array();
        }
        return $list;
    }



}
