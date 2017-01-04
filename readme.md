# shcms

![image](http://cdn.endaosi.com/image/shcms-logo.png)

一个基于laravel5.3最佳实践的cms程序，使用众多现代web开发特性。

## 在线DEMO

香港1M带宽

http://shcms.endaosi.com/

## 特色

- 全文搜索
- 权限管理
- 云平台友好
- 非常多精致优雅的小细节
  
## 运行环境

- PHP5.5及以上，推荐使用PHP7
- nginx或其他Web Server，root目录绑定到public文件夹并设置伪静态到index.php
- MySQL或兼容MySQL的其他数据库，推荐MySQL5.6
- redis 缓存服务器
- spinx 搜索引擎

## 使用方法

`git clone git@github.com:shellus/shcms.git`

`cd shcms`

`chmod -R 777 storage public/uploads`

`composer install`

`cp .env.example .env`

编辑`.env`文件，修改数据库连接信息

`php artisan key:generate`

`php artisan migrate`

`php artisan db:seed`

`bower install`

## 待办列表

- 首页显示 - 最热文章（凭用户阅读文章时间排序）
- 首页显示 - 收藏夹系统


## 作者的话

有任何问题和疑问请在github建立Issue，我会尽快回复您

欢迎您使用、学习、参与本项目。
