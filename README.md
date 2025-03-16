## 使用laravel 写的 rustdesk-server-api

#### 使用说明

1. 克隆项目
2. 安装依赖 `composer install`
3. 配置全局变量 复制项目 .env.example 到 .env 文件中

```dotenv
# mysql 数据库配置
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rustdesk-server-api
DB_USERNAME=root
DB_PASSWORD=

# sqlite
DB_CONNECTION=sqlite
# 在文件夹 database 下的位置
DB_DATABASE=database.sqlite 
```
4. 配置APP_KEY `php artisan key:generate`

5. 执行数据库迁移和填充数据

``` bash
# 数据库迁移
php artisan migrate

# 填充数据 (默认账号:jason 默认密码:123456)
php artisan db:seed
```

5. 本地测试 `php artisan serve`

#### 配置 nginx

```config
server {
    server_name  <example.com>;
    root /path/to/rustdesk-server-api;
    index index.php;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        # fastcgi_pass 127.0.0.1:9000;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}

```
