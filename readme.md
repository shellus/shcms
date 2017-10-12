# [项目关闭，不再维护]
# shcms

![image](http://cdn.endaosi.com/image/shcms-logo.png)

一个基于laravel5.4最佳实践的cms程序，使用众多现代web开发特性。

## 在线DEMO

http://shcms.endaosi.com/

## 特色

- 全文搜索
- 权限管理
- 云平台友好
- 非常多精致优雅的小细节
  
## 运行环境

- PHP5.5及以上，推荐使用PHP7.1
- nginx或其他Web Server，root目录绑定到public文件夹并设置伪静态到index.php
- MySQL或兼容MySQL的其他数据库，推荐MySQL5.7
- redis 缓存服务器
- spinx 搜索引擎(可选)

## 使用方法
> !!!如果你在安装过程中遇到任何问题，请不要犹豫，立即提出Issue。我会全力帮助你!!!

```bash
git clone git@github.com:shellus/shcms.git

cd shcms

chmod -R 777 storage public/uploads

composer install

bower install

cp .env.example .env
```
编辑`.env`文件：

1. 修改数据库连接信息 `DB_*`

2. 设置网站名称和副标题 `APP_NAME, APP_SUB_NAME`

3. 修改`APP_URL`，改为可访问到的url，否则邮件中和cli中无法获取正确的url。

4. 创建数据库`shcms`


生成app_key和填充数据库
```bash
php artisan key:generate

php artisan migrate

php artisan db:seed

```
添加cron条目
```bash
* * * * * php /path/to/shcms/artisan schedule:run
```
添加开机启动(开发环境可以手动运行 bin/queue-listener.bat )
```bash
php /path/to/shcms/artisan queue:listen --timeout 0
```
可选的优化
```bash
php artisan config:cache

php artisan route:cache

php artisan optimize
```

如果你需要支持文章阅读时长统计，那么你需要运行 `php artisan ws` 这将使用8080端口, 你可以使用 `supervisor` 来运行它

```bash
sudo apt install -y supervisor

sudo vim /etc/supervisor/conf.d/ws.conf
```

supervisor 推荐配置

```bash
[program:ws]
directory=path/to/shcms/
command=php artisan ws
user=www-data

[program:queue-default]
directory=path/to/shcms/
process_name=%(program_name)s_%(process_num)02d
command=php artisan queue:work --queue=default --sleep=3 --tries=1
autostart=true
autorestart=true
user=www-data
numprocs=1

[program:queue-high]
directory=path/to/shcms/
process_name=%(program_name)s_%(process_num)02d
command=php artisan queue:work --queue=high --sleep=3 --tries=1
autostart=true
autorestart=true
user=www-data
numprocs=4

```

然后使新的配置生效

```bash
sudo service supervisor restart
```
如果`websocket`运行不稳定，那么你可以使用`cron`在每天凌晨使用 `sudo supervisorctl restart ws` 重启它

## HTTPS

如果你部署SSL访问，那么需要对websocket做反向代理来实现wws://协议

nginx.conf:
```bash
upstream shcms.endaosi.com {
   server 127.0.0.1:8080;
}
map $http_upgrade $connection_upgrade {
    default upgrade;
    ''      close;
}
server {
        listen 80;
        listen              443 ssl;
        server_name shcms.endaosi.com;
        location  ^~  /websocket {
            proxy_pass http://shcms.endaosi.com;
    
            proxy_redirect    off;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header Host $host;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    
            proxy_http_version 1.1;
            proxy_set_header Upgrade $http_upgrade;
            proxy_set_header Connection "upgrade";
        }
```

编辑`.env`文件，修改数据库连接信息

`php artisan key:generate`

`php artisan migrate`

`php artisan db:seed`

`bower install`

## 待办

参见Issue列表


## 作者的话

有任何问题和疑问请在github建立Issue，我会尽快回复您

欢迎您使用、学习、参与本项目。
