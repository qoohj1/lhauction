<?php
/**
 * 产品菜单模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Catalogue_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'curio_pic_clazz';
        $this->table2 = 'curio_pic_content';
        // $fields = 'id, title_en, title_tc, clazz_id, pic, num, prize_en, prize_tc, size_en, size_tc, standard_en, standard_tc, descript_en, descript_tc, sort';
    }


    /**
     * 查询菜单数据
     * @return [type] [description]
     */
    public function search($cid, $page=1, $size=20) {
        if($page==0){
          $page = 1;
        }
        $limitStart = ($page - 1) * $size;
        if(!empty($cid)){
          $query = $this->db->where('clazz_id', $cid)->order_by('create_time desc,id asc, sort desc')->limit($size, $limitStart)->get($this->table2);
          $num = $this->db->where('clazz_id', $cid)->count_all_results($this->table2);
        }else{
          $query = $this->db->where('parent_id', 2)->order_by('sort desc, id asc')->limit(1)->get($this->table);
          $arr = $query->row();
        //   var_dump($arr);
          $query = $this->db->where('clazz_id', $arr->id)->limit($size, $limitStart)->get($this->table2);
          $num = $this->db->where('clazz_id', $arr->id)->count_all_results($this->table2);
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
    }


    /**
     * 获取新聞稿子菜單id
     * @return [type] [description]
     */
    public function getcid() {
        // $query = $this->db->where('parent_id', 0)->order_by('sort desc, id desc')->limit(1)->get($this->table);
        // $arr = $query->row();
        // $id = $arr->id;
        // $query = $this->db->where('parent_id', $id)->order_by('sort desc, id asc')->limit(1)->get($this->table);
        // $arr = $query->row();
        // $id = $arr->id;
        // if(!isset($id)){
          $query = $this->db->where('parent_id !=', 0)->order_by('sort desc, id asc')->limit(1)->get($this->table);
          $arr = $query->row();
          $parent_id = $arr->parent_id;
          $query = $this->db->where('parent_id', $parent_id)->order_by('sort desc, id asc')->limit(1)->get($this->table);
          $arr = $query->row();
          $id = $arr->id;
        // }
        return $id;
    }


    /**
     * 查询父菜单数据
     * @return [type] [description]
     */
    public function searchParent($cid) {
        $query = $this->db->where('id', $cid)->get($this->table);
        $list = $query->row();
        // foreach ($list as $k=>&$v) {
        //
        // }
        return $list;
    }

    /**
     * 获取父菜单数据
     * @return [type] [description]
     */
    public function getParent($cid) {
        $query = $this->db->where('id', $cid)->get($this->table);
        $result['data'] = $query->row();
        $result['status'] = 0;
        $result['msg'] = '成功';
        // foreach ($list as $k=>&$v) {
        //
        // }
        return $result;
    }

    /**
     * 查询子菜单详情
     * @return [type] [description]
     */
    public function searchDetail($id) {
        $query = $this->db->where('id', $id)->get($this->table2);
        $list = $query->row();
        if(count($list->pic)>0){
          $list->pic = explode(',', $list->pic);
        }
        return $list;
    }

    /**
     * 查询該数据是第一条还是最后一条
     * @return [type] [description]
     */
    public function firstLast($id, $cid) {
        $array1 = array('id' => $id-1, 'clazz_id' => $cid);
        $array2 = array('id' => $id+1, 'clazz_id' => $cid);
        $query1 = $this->db->where($array1)->get($this->table2);
        $pre = $query1->row();
        $query2 = $this->db->where($array2)->get($this->table2);
        $next = $query2->row();
        if(empty($pre)){
            $pre = false;
        }else{
            $pre = true;
        }
        if(empty($next)){
            $next = false;
        }else{
            $next = true;
        }
        $list = array(
            'pre' => $pre,
            'next' => $next
        );
        return $list;
    }

    /**
     * 查询其他相关项目
     * @return [type] [description]
     */
    public function otheritem($id, $cid) {
        $array = array('id !=' => $id, 'clazz_id' => $cid);
        $query = $this->db->where($array)->order_by('rand()')->limit(5)->get($this->table2);
        $list = $query->result_array();
        shuffle($list);
        // $list = array(
        //     'pre' => $pre,
        //     'next' => $next
        // );
        return $list;
    }

    /**
     * 搜索
     * @return [type] [description]
     */
    public function searchText($text) {
        if(!empty($text)){
          $query = $this->db->like('num', $text)->or_like('title_en', $text)->or_like('title_tc', $text)->order_by('sort desc, id asc')->get($this->table2);
          $list = $query->result_array();
          foreach ($list as $k => &$v) {
            $query = $this->db->where('id', $v['clazz_id'])->get($this->table);
            $list2 = $query->row();
            $v['clazz'] = $list2;
          }
        }else{
          $list = '';
        }
        return $list;
    }


}
