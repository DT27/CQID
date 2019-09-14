# CQID

业余无线电台操作技术能力模拟考试平台

### 1.技术相关

前端基于[Bootstrap v4.3.1](https://getbootstrap.com/docs/4.3/getting-started/introduction/)

后端：PHP

数据库：MySQL

用户密码使用RSA算法加密，前端加密工具：[JSEncrypt v3.0.0-rc.1](https://github.com/travist/jsencrypt)

前端分页：[jQuery Bootstrap Pagination v1.4.2](https://github.com/josecebe/twbs-pagination)

### 2.目录结构

api--------前端与后端交互接口

bin--------后端依赖文件

css--------CSS样式文件

images----图片资源

inc--------前端公共文件

js---------JS脚本文件

source----考试题库

### 3.`.env`配置文件说明

`priv_key`RSA私钥

`pub_key`RSA公钥

`mysql_host`数据库地址，默认`localhost`

`mysql_port`数据库端口号，默认`3306`

`mysql_database`数据库名

`mysql_user`数据库登录用户名

`mysql_password`数据库登录密码
