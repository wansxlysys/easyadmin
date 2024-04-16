EasyAdmin基于ThinkPHP5.1后台管理基础框架
===============

ThinkPHP5.1对底层架构做了进一步的改进，减少依赖，其主要特性包括：

 + 采用容器统一管理对象
 + 支持Facade
 + 注解路由支持

> EasyAdmin的运行环境要求PHP7.4及以上。

## 安装

使用git安装

~~~
git clone https://gitee.com/wansxlysys/easyadmin.git
~~~

启动服务

~~~
cd easyadmin
php think run
~~~

然后就可以在浏览器中访问

~~~
http://localhost:8000
~~~

## 版本计划
- [x] 前端图片上传模块（重构）
- [x] 前端文件上传模块（重构）
- [x] jump跳转页面设计