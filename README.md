# EasyAdmin 后台管理系统

## 📚 项目简介

EasyAdmin 是基于 Layui 和 ThinkPHP5.1 框架开发的一套高效、灵活的后台管理系统。采用 RBAC权限模型，支持大文件上分片上传，提供完善的系统管理功能和优雅的 UI 界面。

> **运行环境要求**：PHP 7.4 及以上版本

## 🎯 核心功能
- 权限管理
- 菜单管理
- 操作日志
- 登录日志
- 字典管理
- 系统设置
- 文件上传

## 📦 安装

使用git下载

~~~
git clone https://gitee.com/wansxlysys/easyadmin.git
~~~

启动服务

1. 导入`data/database/easyadmin.sql`
2. 复制`.env.dev`为`.env`并修改数据库连接配置
3. 快速启动

~~~
cd easyadmin
php think run
~~~

然后就可以在浏览器中访问

~~~
http://localhost:8000
~~~

## 🔐 默认账户

| 账户类型 | 用户名 | 密码    | 说明 |
|---------|--------|-------|------|
| 超级管理员 | admin | admin | 拥有所有权限 |

---

## 📂 项目结构

```
easyadmin/
├── application/          # 应用目录
│   ├── admin/           # 后台管理模块
│   │   ├── controller/  # 控制器层
│   │   ├── service/     # 业务逻辑层
│   │   ├── repository/  # 数据访问层
│   │   ├── validate/    # 验证器
│   │   ├── helper/      # 辅助类
│   │   ├── format/      # 格式化类
│   │   ├── behavior/    # 行为扩展
│   │   └── view/        # 视图模板
│   ├── common/          # 公共模块
│   │   ├── controller/  # 基础控制器
│   │   ├── util/        # 工具类
│   │   ├── taglib/      # 模板标签
│   │   └── ...
│   └── index/           # 前台模块
│
├── config/              # 配置文件目录
├── public/              # 公共资源目录
│   ├── static/          # 静态资源（CSS/JS/图片）
│   └── upload/          # 上传文件目录
├── runtime/             # 运行时目录
├── extend/              # 扩展类库目录
└── thinkphp/            # ThinkPHP 核心框架
```

---

### 📊 表结构

| 表名 | 说明 |
|------|------|
| `system_manager` | 管理员表 |
| `system_manager_role` | 角色表 |
| `system_menu` | 菜单权限表 |
| `system_oper_log` | 操作日志表 |
| `system_login_log` | 登录日志表 |
| `system_setting` | 系统配置表 |
| `system_dict_type` | 字典类型表 |
| `system_dict_data` | 字典数据表 |
| `system_upload` | 文件上传表 |

---

## 🛠️ 使用框架

| 框架名称     | 版本     | 开源地址  |
|----------|--------|-------|
| ThinkPHP | 5.1    | https://github.com/layui/layui |
| layCascader | 1.7.6  | https://gitee.com/yixiacoco/lay_cascader |
| xmSelect | 1.2.4  | https://gitee.com/maplemei/xm-select |
| clipboard | 2.0.11 | https://github.com/zenorocha/clipboard.js |
| echarts | 5.4.1  | https://github.com/apache/echarts |
| Font-Awesome | 6.4.2  | https://github.com/FortAwesome/Font-Awesome |
| Layui    | 2.13.3 | https://github.com/top-think/framework |
| moment | 2.29.4 | https://github.com/moment/moment |
| spark-md5 | 3.0.2  | https://github.com/satazor/js-spark-md5 |
| split | 1.6.5  | https://github.com/satazor/js-spark-md5 |
| ueditor-plus | 2.0.0  | https://gitee.com/modstart-lib/ueditor-plus |
| zTree | 3.5.42 | https://github.com/zTree/zTree_v3 |
---

## 🤝 参与贡献

欢迎提交 Issue 和 Pull Request 帮助项目成长！

---

## 👀 项目预览
![登录](https://gitee.com/wansxlysys/images/raw/master/easyadmin/login.png)

![控制台](https://gitee.com/wansxlysys/images/raw/master/easyadmin/dashboard.png)

![UI组件](https://gitee.com/wansxlysys/images/raw/master/easyadmin/components.png)

![管理员](https://gitee.com/wansxlysys/images/raw/master/easyadmin/manager.png)

![操作日志](https://gitee.com/wansxlysys/images/raw/master/easyadmin/oper.png)

![文件上传](https://gitee.com/wansxlysys/images/raw/master/easyadmin/upload.png)