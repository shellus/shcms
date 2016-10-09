# shcms

一个基于laravel5.3最佳实践的cms程序，使用众多现代web开发特性。

## 在线DEMO

香港1M带宽

http://shcms.endaosi.com/

## 特色

 - 权限管理
  - 云平台友好
  
  
## 使用方法

```bash

git clone git@github.com:shellus/shcms.git

cd shcms

composer install

cp .env.example .env

php artisan key:generate

#edit .env change database connect info

php artisan migrate

php artisan db:seed

bower install

```

一些依赖

> 要使用redis，执行 `composer require predis/predis` 
> 并修改 `.env` 文件中的`CACHE_DRIVER` `SESSION_DRIVER` `QUEUE_DRIVER` 值为`redis`

> 如果看到权限不足（permission denied）的提示，请执行 `chmod -R 777 storage/`

> 如果你使用本地文件系统储存上传文件，请执行 `chmod -R 777 public/uploads`

## 问题

## 待办

- 首页显示 - 最热文章（凭用户阅读文章时间排序）
- 首页显示 - 收藏夹系统
