# shcms

一个基于laravel5.2的cms程序，官网在：[github.io](https://shellus.github.io/shcms)

## 特色
 - 抽象tag和category为meta表, 使用Eloquent ORM的global scope特性来自动维护meta表的type字段，
 meta和article的关系为多对多（即一篇文章可以属于多个标签和分类，一个分类或分类也可以被绑定到多个文章）
 - 使用`zizaco/entrust`库作权限管理，权限定义可参考`<root>/database/seeds/UsersSeeder.php`
 - 充分使用现代框架的特性，migrate and seed
 - 可部署于国内流行的应用引擎，如BAE等。
 - 随处可见的最佳实践，例如根目录的`helpers.php`中书写的全局函数使用composer autoload来加载。
 - 使用`App\\SiteConfigLoadProvider`加载数据库配置，例如网站标题(site_title)，既可以在<root>/config/system.php中定义，也可在数据库中定义。
 - 规范的异常定义和处理。定义了`App\\Exceptions\DeniedPermissionException`来管理权限不足时的异常。并在App\\Exceptions\Handler中进行相应的权限不足时的模板渲染
 - 使用`App\\ModelTrait\\ModelHelperTrait`进行方便的条件筛选，你可以使用User::autoWithAll() -> get();来自动使用get参数中的参数作为sql的where参数。
 当默认的“时间范围”“等于”“限制返回数量”“自定义和随机排序”不能满足你的要求时，你还可以自定义修改App\\ModelTrait\\ModelHelperTrait来实现你自己的过滤。
 使用这个技巧，你可以不用再在控制器中书写冗长的where语句了。
 

## 使用方法

```bash

git clone git@github.com:shellus/shcms.git
cd shcms

cp .env.example .env
#edit .env change database connect info

composer install

php artisan migrate
php artisan db:seed

```

## 文档

暂无

## 待办

商品模块

## 开源协议

shcms is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
