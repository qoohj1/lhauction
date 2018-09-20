<?php
/**
 * indexbg模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Indexbg_model extends MY_Model {

    private $table = 'curio_indexbg';
    private $fields = 'id, pic';

    public function __construct() {
        parent::__construct();
    }


    /**
     * 获取背景
     * @return [type]        [description]
     */
    public function getBg() {
        $where = ' where 1=1 ';
        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . $where . 'order by id asc');
        $result = $query->result_array();
        return $result;
    }


    /**
     * 更新背景
     * @param  [type] $id   [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function updateBg($id, $data) {
        $this->db->where('id', $id)->update($this->table, $data);
        $result['status'] = 0;
        $result['msg'] = '更新数据成功';
        return $result;
    }


    /**
     * 获取背景详情
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDetail($id) {
        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . ' where id="' . $id . '"');
        $result = $query->result_array();
        return $result[0];
    }
}
