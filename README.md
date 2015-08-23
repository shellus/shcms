# shcms

###一个基于laravel的cms系统。
 
- 完成了文章、分类、标签、图片、头像功能。 

- 其中标签和分类是多对多关系。 

- 标签、分类、网站配置等信息均在options表中。
 
 
## 安装步骤
```bash

git clone https://github.com/shellus/shcms.git 

cd shcms 

chmod -R 777 storage 

vim .env #编辑数据库连接信息

php artisan migrate

php artisan db:seed ＃导入基本配置，例如网站标题

```
### 待办
1. 升级laravel到5.1。
1. 将分类改为一对多关系。
2. 增加位置系统，即首页推荐位、精品文章位等。
3. 增加商品功能。
    
