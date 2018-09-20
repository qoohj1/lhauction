<?php
/**
 * static静态页面模型
 *
 * @author huangjiang <qoohj@qq.com>
 *
 */
class Static_model extends MY_Model {

    private $table = 'curio_static';
    private $fields = 'id, pic, name_en, name_tc, content_en, content_tc, descript_en, descript_tc';

    public function __construct() {
        parent::__construct();
    }


    /**
     * 获取靜態頁面欄目
     * @return [type]        [description]
     */
    public function getStatic() {
        $where = ' where 1=1 ';
        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . $where);
        $result = $query->result_array();
        $rtn = array(
            'list'  => $result
        );
        return $rtn;
    }

    /**
     * 新增/更新文章
     * @param [type] $nid    [description]
     * @param [type] $params [description]
     */
    public function update($nid, $params) {
        // $params['update_time'] = time();
        // $params['update_userid'] = $this->loginInfo['id'];
        $this->db->where('id', $nid)->update($this->table, $params);
        $result['status'] = 0;
        $result['msg'] = '更新成功！';
        return $result;
    }


    /**
     * 更新广告
     * @param  [type] $id   [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function updateAds($id, $data) {
        $this->db->where('id', $id)->update($this->table, $data);
        $result['status'] = 0;
        $result['msg'] = '更新数据成功';
        return $result;
    }


    /**
     * 删除
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
    public function deleteItem($id) {
        $this->db->where('id', $id)->delete($this->table);
        $result['status'] = 0;
        $result['msg'] = '删除成功';
        return $result;
    }


    /**
     * 新增广告
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function addAds($data) {
        $msg = '';
        if($data['url_en']=='') $msg = '链接（en）不可为空！';
        if($data['url_tc']=='') $msg = '链接（tc）不可为空！';
        if($data['pic']=='') $msg = '图片不可为空！';

        if($msg != '') {
            return array(
                'status'    => -1,
                'msg'       => $msg
            );
        }

        $data['sort'] = (int)$data['sort'];
        $this->db->insert($this->table, $data);
        $result['status'] = 0;
        $result['msg'] = '新增数据成功';
        return $result;
    }


    /**
     * 获取广告详情
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDetail($id) {
        $query = $this->db->query('select ' . $this->fields . ' from ' . $this->table . ' where id="' . $id . '"');
        $result = $query->result_array();
        return $result[0];
    }
}
