 # INSTALL
## 配置nginx
## Create virtual host

Rederence `docs/nginx.conf`. Here is the virtual host configure for me:

```
server{
        listen       80;
        server_name test.curio.com;

        access_log /Users/huangjiang640/testabc/logs/dev.curio.com.access.log;
        error_log  /Users/huangjiang640/testabc/logs/dev.curio.com.error.log;

        root /Users/huangjiang640/testabc/website;
        index  index.php index.html index.htm;

	client_max_body_size 20m;

        large_client_header_buffers 4 16k;
        client_body_buffer_size 128k;
        proxy_connect_timeout 600;
        proxy_read_timeout 600;
        proxy_send_timeout 600;
        proxy_buffer_size 64k;
        proxy_buffers   4 32k;
        proxy_busy_buffers_size 64k;
        proxy_temp_file_write_size 64k;

        location / {
            if (!-e $request_filename) {
                rewrite ^/(.*)$ /index.php?$1 last;
                break;
            }
        }

        location /adm/ {
            if (!-e $request_filename) {
                rewrite ^/(.*)$ /adm/index.php?$1 last;
                break;
            }
        }

        location ~ \.php$ {
            root           /Users/huangjiang640/testabc/website;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME /Users/huangjiang640/testabc/website$fastcgi_script_name;
            include        fastcgi_params;
        }
}

```
## 开启php－fpm
- php-fpm -D

## 配置mysql
- source docs/db/init.sql

## 配置数据库
- 路径：website/adm/config/database.php
- $db['default']['hostname'] = 'localhost:3306';
- $db['default']['username'] = 'root';
- $db['default']['password'] = '';
- $db['default']['database'] = 'curio';

## 配置服务器ip
- website/adm/config/config.php
- $config[‘base_url’] = ‘’
- website/www/config/config.php
- $config[‘base_url’] = ‘’

## 配置api及请求域名／ip路径
- website/adm/views/static/js/common.js
- website/www/views/static/js/common.js
- 修改 apiServer／resServer域名／ip
