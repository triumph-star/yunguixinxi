
# 创建数据库
CREATE DATABASE `yungui`;

# 选择数据
USE `yungui`;

# 文章表
CREATE TABLE `article`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `cid` INT UNSIGNED NOT NULL COMMENT '栏目ID',
  `title` VARCHAR(80) NOT NULL COMMENT '标题',
  `author` VARCHAR(15) NOT NULL COMMENT '作者',
  `cover` VARCHAR(255) NOT NULL COMMENT '封面图',
  `show` ENUM('yes','no') DEFAULT 'yes' NOT NULL COMMENT '是否发布',
  `views` INT UNSIGNED DEFAULT 0 NOT NULL COMMENT '点击量',
  `time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT '创建时间',
  `content` TEXT NOT NULL COMMENT '内容',
  `keywords` VARCHAR(150) NOT NULL COMMENT '关键字',
  `description` VARCHAR(255) NOT NULL COMMENT '内容简介'
)DEFAULT CHARSET=utf8;

# 栏目表
CREATE TABLE `category`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `pid` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级ID',
  `name` VARCHAR(15) NOT NULL  COMMENT '名称',
  `sort` INT NOT NULL DEFAULT 0 COMMENT '排序'
)DEFAULT CHARSET=utf8;

# 管理员表
CREATE TABLE `admin`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(10) NOT NULL UNIQUE COMMENT '用户名',
  `password` CHAR(32) NOT NULL COMMENT '密码',
  `salt` CHAR(6) NOT NULL COMMENT '密钥'
)DEFAULT CHARSET=utf8;

#用户表
CREATE TABLE `users`(
  `usrId` INT UNSIGNED UNIQUE AUTO_INCREMENT,
  `usrName` VARCHAR(30) NOT NULL  COMMENT '用户名',
  `usrPwd` CHAR(32) NOT NULL COMMENT '密码',
  `usrNum` int UNSIGNED PRIMARY KEY COMMENT '学号',
  `usrPro` varchar(32) NOT NULL COMMENT '专业',
  `userClass` varchar(30) NOT NULL COMMENT '班级',
  `usrAge` varchar(3) NOT NULL COMMENT '年龄',
  `usrBirthday` date COMMENT '生日',
  `usrEmail` varchar(36) NOT NULL COMMENT '电子邮件',
  `usrIdcard` varchar(18) NOT NULL COMMENT '身份证号码',
  `usrTel` char(11) NOT NULL COMMENT '用户电话'
)DEFAULT CHARSET=utf8;
insert into users values('','陈凯旋',MD5('000000'),'18163536','计算机应用技术','计应1801','22','1997-09-27','2335455172@qq.com','341222199709274412','19965120848');
insert into users values('','陈凯',MD5('000000'),'18163537','计算机应用技术','计应1801','22','1997-09-27','2335455172@qq.com','341222199709274412','19965120848');

#成绩表 
CREATE TABLE `score`(
`sid` int UNSIGNED AUTO_INCREMENT UNIQUE,
`course` varchar(40) NOT NULL COMMENT '课程名称',
`term` varchar(12) NOT NULL COMMENT '学期',
`academic_year` varchar(6) NOT NULL COMMENT '学年',
`score` int UNSIGNED not NULL COMMENT '成绩',
`student_id` int UNSIGNED,
PRIMARY KEY(course,term,academic_year)
)DEFAULT CHARSET=utf8;

Alter table score add constraint S_id foreign key(student_id) references users(usrnum) ON DELETE CASCADE ON UPDATE CASCADE;


# 添加管理员数据
#INSERT INTO `admin` VALUES('', 'admin', MD5(CONCAT(MD5('123456'),'itCAst')), 'itCAst');
INSERT INTO `admin` VALUES('', 'admin', MD5('000000'),'salt');

#添加用户成绩
INSERT INTO `score` VALUES('','c语言','第一学期','大一',18163536,95);

# 添加默认栏目数据
INSERT INTO `category` VALUES 
(1, 0, '校历', 0),
(2, 0, '课表', 1),
(3, 0, '考试安排', 2),
(4, 0, '素养分', 3),
(5, 0, '等级考试', 4),
(6, 3, 'JavaScript', 0),
(7, 3, 'HTML', 1),
(8, 3, 'CSS', 2),
(9, 2, '计应1801', 0),
(10, 2, '计应1802', 0),
(11, 2, '数媒1801', 0),
(12, 2, '物联1801', 0),
(16, 4, '学期素养', 0),
(13, 1, '第一学期', 0),
(14, 1, '第二学期', 0),
(15, 5, '新闻', 0);

# 添加默认文章数据
INSERT INTO `article` VALUES
(3, 6, '十年饮冰,难凉热血', '陈凯旋', '', 'yes', '0', now(),'','',''),
(4, 6, '人生若只如初见，何事悲风秋画扇', '陈凯旋', '', 'yes', '0', now(),'','',''),
(5, 6, '人生没有捷径', '陈凯旋', '', 'yes', '0', now(),'','',''),
(6, 6, '心如死灰，年级未免太轻;放浪游戏，年级未免太老', '陈凯旋', '', 'yes', '0', now(),'','','');

