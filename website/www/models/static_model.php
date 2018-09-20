<?php
/**
 * 静态内容模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Static_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'curio_static';
        $this->fields = 'id, name_en, name_tc, pic, content_en, content_tc';
    }


    /**
     * 查询最新動態
     * @return [type] [description]
     */
    public function latest() {
        $query = $this->db->where('id', 1)->get($this->table);
        $row = $query->row();
        return $row;
    }

    /**
     * 查询參與拍賣
     * @return [type] [description]
     */
    public function buy() {
        $query = $this->db->where('id', 2)->get($this->table);
        $row = $query->row();
        return $row;
    }
    /**
     * 查询委託拍賣
     * @return [type] [description]
     */
    public function sell() {
        $query = $this->db->where('id', 3)->get($this->table);
        $row = $query->row();
        return $row;
    }
    /**
     * 查询參與拍賣
     * @return [type] [description]
     */
    public function about() {
        $query = $this->db->where('id', 4)->get($this->table);
        $row = $query->row();
        if(count($row->pic)>0){
          $row->pic = explode(',', $row->pic);
        }

        return $row;
    }
    /**
     * 查询委託拍賣
     * @return [type] [description]
     */
    public function contact() {
        $query = $this->db->where('id', 5)->get($this->table);
        $row = $query->row();
        return $row;
    }
    /**
     * 查询條款及細則
     * @return [type] [description]
     */
    public function tandc() {
        $query = $this->db->where('id', 6)->get($this->table);
        $row = $query->row();
        return $row;
    }
    /**
     * 查询個人隱私
     * @return [type] [description]
     */
    public function privacy() {
        $query = $this->db->where('id', 7)->get($this->table);
        $row = $query->row();
        return $row;
    }
    /**
     * 查询注解
     * @return [type] [description]
     */
    public function glossary() {
        $query = $this->db->where('id', 8)->get($this->table);
        $row = $query->row();
        return $row;
    }

    /**
    * 查询競投者通知書
    * @return [type] [description]
    */
    public function nandb() {
        $query = $this->db->where('id', 8)->get($this->table);
        $row = $query->row();
        return $row;
    }


}
