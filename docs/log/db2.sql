-- linzequan 20171129
-- 添加轮播图表
create table `curio_banner` (
    `id` int not null auto_increment comment '自增id',
    `url_en` varchar(512) comment '链接英文',
    `url_tc` varchar(512) comment '链接繁体',
    `pic` varchar(255) default '' comment '图片',
    `sort` int(8) default 0 comment '排序。数值越大，越靠前',
    primary key(`id`)
) engine = myisam character set utf8 collate utf8_general_ci comment = '首页轮播图';

-- linzequan 20171129
-- 添加站内通知表
create table `curio_notice` (
    `id` int not null auto_increment comment '自增id',
    `content_en` varchar(512) comment '站内通知英文',
    `content_tc` varchar(512) comment '站内通知繁体',
    `url_en` varchar(512) comment '跳转链接英文',
    `url_tc` varchar(512) comment '跳转链接繁体',
    `sort` int(8) default 0 comment '排序。数值越大，越靠前',
    primary key (`id`)
) engine = myisam character set utf8 collate utf8_general_ci comment = '站内通知表';


-- linzequan 20171202
-- 添加默认菜单栏
INSERT INTO `sys_menu` VALUES (1,0,'輪播圖管理','/adm/banner',5,'banner',1511833978,1512146899,1,1),(2,0,'首頁背景圖管理','/adm/indexbg',5,'bg',1511833978,1512146899,1,1),(3,0,'靜態頁面管理','/adm/staticpage',5,'static',1511833938,1512183433,1,1),(4,0,'產品分类','/adm/pic_clazz',5,'pic_clazz',1511834061,1512148977,1,1),(5,0,'產品管理','/adm/pic_content',5,'pic_content',1511834167,1512149375,1,1),
(6,0,'新聞分类','/adm/clazz',5,'class',1511833914,1512183403,1,1),(7,0,'新聞管理','/adm/content',5,'news',1511833938,1512183433,1,1),(8,0,'站內通知','/adm/notice',5,'notice',1511834186,NULL,1,NULL);

-- qoohj 20180307
-- 添加菜单栏批量上传
INSERT INTO `sys_menu` VALUES (9,0,'批量上傳圖片','/adm/addpics',5,'addpics',1511833914,1512183403,1,1);

-- qoohj 20180307
-- 添加索取图录表
create table `curio_cata_request` (
    `id` int not null auto_increment comment '自增id',
    `name` varchar(255) comment '名称',
    `email` varchar(255) comment '邮箱',
    `phone` varchar(255) comment '联系方式',
    `category` varchar(255) comment '类别',
    primary key(`id`)
) engine = myisam character set utf8 collate utf8_general_ci comment = '索取图录表';


-- qoohj 20180327
-- 添加首页背景图片表
create table `curio_indexbg` (
    `id` int not null auto_increment comment '自增id',
    `pic` varchar(512) comment '背景图',
    primary key(`id`)
) engine = myisam character set utf8 collate utf8_general_ci comment = '首页背景图表';
INSERT INTO `curio_indexbg` VALUES (1,''),(2,'');
