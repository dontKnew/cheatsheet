# Nginx and PHP Configuration Guide

## Error Handling
### 504 Timeout
To fix the 504 timeout error, add the following lines inside the `http` block in your Nginx configuration file `/etc/nginx/nginx.conf`:

```nginx
http {
    proxy_connect_timeout       600;
    proxy_send_timeout          600;
    proxy_read_timeout          600;
    send_timeout                600;
}
```

## 1. Setup with PHP and Nginx

### 1.1 Nginx Configuration

#### Install Nginx
```bash
apt install nginx
```

#### Manage Nginx Service
```bash
sudo service nginx start
sudo service nginx stop
sudo service nginx restart
```

### 1.2 Configure PHP-FPM
#### Install PHP-FPM and MySQL
```bash
sudo apt-get install php-fpm php-mysql
```

#### Manage PHP-FPM Service
```bash
sudo systemctl restart php7.4-fpm
sudo systemctl status php{version}-fpm
```
> **Note:** Command line and server browser configurations are different.

#### Nginx Site Configuration
Edit the file `/etc/nginx/sites-available/default`:

```nginx
server {
    listen 80 default_server;
    listen [::]:80 default_server;
    root /var/www/html;
    
    # Add index.php to the list if you are using PHP
    index index.php index.html index.htm index.nginx-debian.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Pass PHP scripts to FastCGI server
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
        # Additional FastCGI settings if needed
    }
}
```

#### Restart Nginx
```bash
sudo service nginx restart
```

## 2. MySQL Configuration

### Install MySQL
```bash
apt install mysql-server
```

#### Manage MySQL Service
```bash
sudo service mysql status
sudo service mysql restart
sudo service mysql stop
```

### Secure MySQL & set root password
```bash
mysql_secure_installation
#if root password not set, you can use alter command to set password
```


### Access MySQL Command Line
```bash
sudo mysql
```
Now you can change the password of root or see the database using the command line.

### PHPMYAdmin
- Install phpMyAdmin from the website and download it.
> **Note:** Make sure `mysql-server` is running.
