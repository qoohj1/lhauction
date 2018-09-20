<?php
/**
 * 联系方式模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Contact_model extends MY_Model {


    public function __construct() {
        parent::__construct();
        $this->table = 'curio_cata_request';
        $this->fields = 'id, name, email, phone, category';
        // $this->loginInfo = $this->session->userdata('loginInfo');
    }

    /**
     * 索取图录
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function cataRequest($data) {

          $this->db->insert($this->table, $data);
          return array(
              'status'    => 0,
              'msg'       => '操作成功！'
          );
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
        if($clazz_id > 0) {
            $where = ' where clazz_id = ' . $clazz_id;
        } else if($keyword) {
            $where = ' where title_tc like \'%'. $keyword .'%\' or title_en like \'%'. $keyword .'%\' ';
        } else {
            $where = ' where 1=1 ';
        }
        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . $where . ' order by sort desc, id asc limit ' . $limitStart . ', ' . $size);
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

        $pageQuery = $this->db->query('select count(1) as num from ' . $this->table);
        $pageResult = $pageQuery->result_array();
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

}
