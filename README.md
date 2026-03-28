# EasyAdmin 后台管理系统

## 项目简介

EasyAdmin 是基于 ThinkPHP5.1 框架开发的一套高效、灵活的后台管理系统。采用 RBAC（基于角色的访问控制）权限模型，提供完善的系统管理功能和优雅的 UI 界面。

> **运行环境要求**：PHP 7.4 及以上版本

### 基础特性
- ✅ 依赖注入容器（支持循环依赖）
- ✅ RBAC 权限控制体系
- ✅ 自定义主题颜色配置
- ✅ 响应式布局设计

### 文件管理
- ✅ 文件上传管理（支持多种文件类型）
- ✅ 大文件秒传功能
- ✅ 大文件切片上传
- ✅ 文件检测与重命名
- ✅ 文件列表管理

### 系统监控
- ✅ 完善的操作日志记录
- ✅ 详细的登录日志追踪
- ✅ 系统信息查看
- ✅ 实时监控面板

### 数据管理
- ✅ 字典类型管理
- ✅ 字典数据维护
- ✅ 系统配置管理
- ✅ 菜单权限管理

### 用户管理
- ✅ 管理员账户管理
- ✅ 角色权限分配
- ✅ 个人资料维护
- ✅ 头像上传功能

## 安装

使用git下载

~~~
git clone https://gitee.com/wansxlysys/easyadmin.git
~~~

启动服务

1. 导入data/database/easyadmin.sql
2. 复制.env.local修改数据库配置
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

## 🎯 核心功能说明

### 1. RBAC 权限管理

系统采用标准的 RBAC 三级模型：

```
用户 → 角色 → 菜单/权限
```

- **菜单管理**：支持多级菜单嵌套，灵活配置菜单层级关系
- **角色管理**：可创建多个角色，为角色分配不同权限
- **管理员管理**：管理员可分配多个角色，继承角色所有权限

### 2. 文件上传系统

#### 支持的上传方式

| 上传类型 | 说明 | 路由 |
|---------|------|------|
| 图片上传 | 支持常见图片格式 | `/admin/SystemUpload/image` |
| 文件上传 | 支持文档、压缩包等 | `/admin/SystemUpload/file` |
| 大文件上传 | 自动启用切片上传 | 同上 |

#### 文件检测功能

- 文件重复检测（MD5 秒传）
- 文件格式验证
- 文件大小限制
- 文件重命名

### 3. 系统日志

#### 操作日志

- 自动记录所有后台操作
- 记录内容包括：操作人、操作时间、IP 地址、请求参数
- 支持日志查询和详情查看
- 支持一键清空日志

#### 登录日志

- 记录所有登录行为（成功/失败）
- 记录登录 IP 和地理位置
- 支持异常登录监控

### 4. 字典管理

支持两级数据结构：

```
字典类型 → 字典数据
```

- **字典类型**：定义字典分类（如：性别、状态、类型等）
- **字典数据**：具体的键值对数据
- 字典数据可在系统中全局调用

### 5. 系统设置

- 动态配置系统参数
- 支持配置项分组管理
- 配置值支持多种数据类型
- 配置即时生效

---

## 📊 数据库表说明

### 核心数据表

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
