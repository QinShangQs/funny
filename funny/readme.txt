
http://www.h5inav.com/index.php/home/funny/play/name/rural

http://m.xiancheling.com/index.php/home/rural

<VirtualHost *:80>
DocumentRoot "D:\WWW\funny\funny"
ServerName a.funny.tunnel.qydev.com
ServerAlias b.funny.tunnel.qydev.com
  <Directory "D:\WWW\funny\funny">
    Options Indexes FollowSymLinks ExecCGI
    AllowOverride None
    Require all granted
  </Directory>
   <IfModule mod_rewrite.c>
         RewriteEngine On
         RewriteCond %{REQUEST_URI} !^/(.*)(_res|ico|css|js|gif|image|png|fsqa|static|.php)(.*)$
         RewriteRule (.*) /index.php/$1 [L]
  </IfModule>
</VirtualHost>