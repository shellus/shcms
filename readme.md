# shcms

一个基于laravel5.3最佳实践的cms程序，使用众多现代web开发特性。

## 在线DEMO

香港1M带宽

http://shcms.endaosi.com/

## 特色

- 权限管理
- 云平台友好
  
## 运行环境

- PHP5.5以上，推荐使用PHP7
- nginx或其他Web Server，root目录绑定到public文件夹并设置伪静态到index.php
- MySQL或兼容MySQL的其他数据库，推荐MySQL5.6
- redis 缓存服务器
- spinx 搜索引擎

## 使用方法

`git clone git@github.com:shellus/shcms.git`

`cd shcms`

编辑`.env`文件，修改数据库连接信息
edit `.env` file, change database connect info

`chmod -R 777 storage public/uploads`

`composer install`

`cp .env.example .env`

`php artisan key:generate`

`php artisan migrate`

`php artisan db:seed`

`bower install`


## 问题

## 待办

- 首页显示 - 最热文章（凭用户阅读文章时间排序）
- 首页显示 - 收藏夹系统
