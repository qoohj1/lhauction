<?php
/**
 * 往届拍卖会模型
 *
 * @author qoohj <qoohj@qq.com>
 *
 */
class Auction_past_model extends MY_Model {

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
    public function search($aid, $page=1, $size=2) {
        $limitStart = ($page - 1) * $size;
        if(!empty($aid)){
          $query = $this->db->where('parent_id', $aid)->order_by('id asc, sort desc')->get($this->table);
        }else{
          $query = $this->db->where('parent_id !=', '0')->get($this->table);
        }
        $list = $query->result_array();
        $picArr = array();
        foreach ($list as $k1=>&$v) {
          $id = $v['id'];
          $items = $this->db->where('clazz_id', $id)->order_by('id asc, sort desc')->get($this->table2)->result_array();
          foreach ($items as $k2=>&$item) {
            $pics = explode(',', $item['pic']);
            foreach ($pics as $k3=>$p) {
              array_push($picArr, $p);
              $item['img'] = $picArr;
              $v['img'] = $item['img'];
            }
          }
          if($k1 == 1){
            // var_dump($picArr);
          }
          $v['img'] = $picArr;
          // var_dump($v['img']);
          $picArr = array();
          // var_dump($v);
        }

        // var_dump($list);
        // $pageQuery = $this->db->query('select count(1) as num from ' . $this->table);
        // $pageResult = $pageQuery->result_array();
        // $num = $pageResult[0]['num'];
        // $rtn = array(
        //     'total' => $num,
        //     'size'  => $size,
        //     'page'  => $page,
        //     'list'  => $list
        // );
        // return $rtn;

        return $list;
    }



}
