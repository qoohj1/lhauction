<?php
/**
 * 图录内容模型
 *
 * @author linzequan <lowkey361@gmail.com>
 *
 */
class Pic_content_model extends MY_Model {

    private $table = 'curio_pic_content';
    private $fields = 'id, title_en, title_tc, clazz_id, pic, num, prize_en, prize_tc, size_en, size_tc, standard_en, standard_tc, descript_en, descript_tc, sort, create_time, update_time, pdf';

    public function __construct() {
        parent::__construct();
        $this->loginInfo = $this->session->userdata('loginInfo');
    }


    /**
     * 获取图录
     * @param  integer $page     [description]
     * @param  integer $size     [description]
     * @param  integer $clazz_id [description]
     * @return [type]            [description]
     */
    public function getList($page=1, $size=20, $keyword, $clazz_id=0) {
        $limitStart = ($page - 1) * $size;
        if($keyword) {
            $where = ' where title_tc like \'%'. $keyword .'%\' or title_en like \'%'. $keyword .'%\' ';
        } else if($clazz_id > 0) {
            $where = ' where clazz_id = ' . $clazz_id;
        } else {
            $where = ' where 1=1 ';
        }
        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . $where . ' order by create_time desc,sort desc, id asc limit ' . $limitStart . ', ' . $size);
        $result = $query->result_array();
        $this->load->model('pic_clazz_model');
        $CI = &get_instance();
        foreach($result as &$item) {
            if($item['clazz_id'] && $clazz_info = $CI->pic_clazz_model->getClazzById($item['clazz_id'])) {
                $item['clazz_name_en'] = $clazz_info['data']['name_en'];
                $item['clazz_name_tc'] = $clazz_info['data']['name_tc'];
            } else {
                $item['clazz_name_en'] = '';
                $item['clazz_name_tc'] = '';
            }
            if($item['create_time']) {
                $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
            } else {
                $item['create_time'] = '';
            }
            if($item['update_time']) {
                $item['update_time'] = date('Y-m-d H:i:s', $item['update_time']);
            } else {
                $item['update_time'] = '';
            }
        }

        $pageQuery = $this->db->query('select count(1) as num from ' . $this->table.$where);
        $pageResult = $pageQuery->result_array();
        // var_dump($pageResult);
        $num = $pageResult[0]['num'];
        $rtn = array(
            'total' => $num,
            'size'  => $size,
            'page'  => $page,
            'list'  => $result
        );
        return $rtn;
    }


    /**
     * 新增/更新图录
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function add($nid, $data) {
        if($nid == 0) {
            $data['sort'] = (int)$data['sort'];
            $data['create_time'] = time();
            $this->db->insert($this->table, $data);
            $result['status'] = 0;
            $result['msg'] = '新增数据成功';
            return $result;
        } else {
            $data['update_time'] = time();
            $this->db->where('id', $nid)->update($this->table, $data);
            $result['status'] = 0;
            $result['msg'] = '更新数据成功';
            return $result;
        }
    }


    /**
     * 删除图录
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id) {
        $this->db->where('id', $id)->delete($this->table);
        $result['status'] = 0;
        $result['msg'] = '删除成功';
        return $result;
    }


    /**
     * 导入Exel数据
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function addExl($data) {
        $this->db->insert_batch($this->table, $data);
        $result['status'] = 0;
        $result['msg'] = '导入成功';
        return $result;
    }


    /**
     * 获取图录详情
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDetail($id) {
        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . ' where id="' . $id . '"');
        $result = $query->result_array();
        return $result[0];
    }
}
