<?php
/**
 * 多语言钩子
 *
 * @author linzequan <lowkey361@gmail.com>
 *
 */
class LangClass extends MY_Controller {


    public function set_lang() {

        // 从Uri中分解出当前的语言，如 '', 'sc' 或 'ch'
        $my_lang = $this->uri->segment(1);

        // 默认语言为繁体tc
        if($my_lang == 'en' || $my_lang == 'tc') {
            // 动态设置当前语言为en或ch
            $this->config->set_item('language', $my_lang);
            // 为方便，配置做后缀的当前语言，如'', '_sc', '_ch'
            $this->config->set_item('post_lang', '_' . $my_lang);
        }
        $this->load->helper('language');
    }

}
