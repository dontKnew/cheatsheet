# Table of Contents
1. [Server Monitoring](#server-monitering)
   - [CPU High Alert To Mail](#cpu-high-alert-to-mail)
   - [Cloudflare Configuration](#cloudflare)
   - [Limit CPU Usage on PID](#limit-cpu-on-pid)
2. [UFW Firewall](#ufw-enable)
3. [PHP](#php--mysql)
   - [PHP FPM Installation](#install-php-fpm-version)
   - [MYSQL Installation](#mysql)
   - [PHP FPM PER SITE CONFIG](#php-fpm-per-site-config)
4. [NGNINX](#nginx)
    - [Nginx installation](#nginx-installation) 	
    - [Dynamic SubDomain SSL](##dynamic-subdomain-ssl-renew-or-installation-in-nginx)
    - [Install SSL ](#ssl-renew-or-installation-in-nginx)
    - [Block Bots](#block-bots)
5. [Linux Roles/Permissions](#role-management)
6. [Basic Linxu Command](#basic-linux-commands).
	- [Permission](#permission)
 	- etc.
7. [Server Security](#server-security)
8. <a href="redis-cache.md">Redis Cache PHP</a>
9. [Websocket Setup in VPS](#websocket-setup-in-vps-nginx)
10. [NodejDeployment](#nodejsdeployment)
11. [Reset File/FolderPermissinos By PHP](#ResetFile/FolderPermissinosByPHP)

## Server Web Optimization 
	### GZIP Compression
 ```shell
#/etc/nginx/nginx.conf  > in http block
	 gzip on; 
	 gzip_vary on;
	 gzip_proxied any;
	 gzip_comp_level 6;
	 gzip_buffers 16 8k;
	 gzip_http_version 1.1;
	 gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;
	 gzip_min_length 1000;
```
	### PHP FPM PER SITE CONFIG
 		- check table of content
 

## PHP & MYSQL
### Install PHP FPM Version
	i. sudo add-apt-repository ppa:ondrej/php ( if need)
 	ii. sudo apt update
  	iii. sudo apt install php8.3-fpm
   	iv. sudo apt install php8.3-cli php8.3-common php8.3-json php8.3-opcache php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-redis
### MYSQL
	1. Installation
	- sudo apt update
 	- sudo apt install mysql-server -y
  	- sudo mysql_secure_installation # it will prompt new password for enter if you did not login as root user
	2. Set MYSQL Password with logged Root User
 	- sudo mysql
  	- SELECT user, authentication_string, plugin, host FROM mysql.user;  #If u see auth_socket for root user, thats why not ask for pass
   	- ALTER USER 'root'@'localhost' IDENTIFIED WITH caching_sha2_password BY 'YourPasswordBro';  FLUSH PRIVILEGES; #Change PasswordNow 
### PHP-FPM Per Site Config
	i. create file /etc/php/8.3/fpm/pool.d/site_name.conf
 	ii. add below code in site_name.conf :
  ```
	[site_name] #filename
	user = www-data
	group = www-data
	listen = /run/php/php8.3-fpm-site_name.sock #filename
	
	pm = dynamic
	pm.max_children = 30 # number of process thats can handle the child
	pm.start_servers = 8 # on start : start the worker
	pm.min_spare_servers = 6 
	pm.max_spare_servers = 8
	pm.max_requests = 500
	pm.process_idle_timeout = 10s # if worker busy, then one request wait seconds 
	
	listen.owner = www-data
	listen.group = www-data
	listen.mode = 0660
```
	ii. Config in Nginx Conf for PHP
```
  	location ~ \.php$ {
        try_files $uri =404;
        include fastcgi_params;
        fastcgi_pass unix:/run/php/php8.3-fpm-site_name.sock; # filename
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
```
	iii. now restart the nginx & php-fpm : systemctl restart nginx && systemctl restart php8.3-fpm
	iv. now Done

	

## Server Security
### Change SSH Port 
	1. Ex. change ssh port to 3333
 	2. check 3333 already in used or not : sudo netstat -tuln | grep :3333
  	3. if in used, use another port
 	4. open file :  sudo nano /etc/ssh/sshd_config
  	5. Find Line = #Port 22 & and remove hashtag from starting & replace to Port 3333  
   	6. Allow 3333 Port in Firewall 
    		- UFW : sudo ufw allow 2222/tcp
      		- iptables 
			- sudo apt install iptables-persistent
			- sudo iptables -A INPUT -p tcp --dport 3333 -j ACCEPT
   			- sudo netfilter-persistent save
      			- sudo systemctl enable netfilter-persistent
 	7. sudo systemctl daemon-reload
  	8. sudo systemctl restart sshd
 	9. verify port allow : sudo netstat -tuln | grep :3333
### Allow SSH Key Authencation Only
	1. Set Below Config  in /etc/ssh/sshd_config
	- PasswordAuthentication no # denied even correct pass
	- PermitRootLogin  prohibit-password # permit with key only
	- ChallengeResponseAuthentication no # off to ask password prompt
	- AuthenticationMethods publickey # allow with only ssh public key
 	2. sudo systemctl restart sshd
### Fail2ban 
	1. Install 
	- sudo apt update
	- sudo apt install fail2ban
 	2. Create Jail
	- /etc/fail2ban/jail.d/sshd.local
```bash
[sshd]
enabled        = true
port           = 3333
filter         = sshd
logpath        = /var/log/fail2ban-auth.log
maxretry       = 4
bantime        = 7200          # ban for 2 hour (in seconds)
findtime       = 600           # look back 10 minutes for failures ( count maxtry)
```
	3. sudo systemctl restart fail2ban
	4. sudo systemctl enable fail2ban
 	5. sudo fail2ban-client status sshd ## check status of banned ip...

 	

### Disable SSH Root Login
	i. nano /etc/ssh/sshd_config
	ii. change permitRootLogin = yes to permitRootLogin = no

## Server Monitering..
#### CPU High Alert to Mail
	1. Create Scripts given below 
 	2. Give File Permission  : chmod +x filename.py
  	3. run script : python3 filename.py or filename
    4. use systemd or cronjob to listen scripts continuously to send alert
```py
#!/usr/bin/env python3
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
import time
import logging
import os

# ====== CONFIG ======
SMTP_SERVER = "smtp.gmail.com"
SMTP_PORT = 587
SMTP_USER = ""
SMTP_PASS = ""  # Gmail App Password
TO_EMAIL = ""
FROM_EMAIL = ""

MAX_CPU_ALERT = 50  # percentage threshold
MAX_CPU_ALERT_STAYED_SECONDS = 30  # how long it must stay above threshold
CHECK_INTERVAL = 5  # seconds between checks
LOG_FILE = "/root/send_email.log"
# ====================

# ===== Logging Setup =====
os.makedirs(os.path.dirname(LOG_FILE), exist_ok=True)
logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s [%(levelname)s] %(message)s",
    handlers=[
        logging.FileHandler(LOG_FILE),
        logging.StreamHandler()  # This ensures logs also appear in systemd/journalctl
    ]
)
# =========================


def send_email(cpu_usage):
    """Send a styled HTML email when CPU usage exceeds threshold."""
    html_content = f"""
    <html>
    <body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
        <div style="max-width: 500px; background: white; border-radius: 8px; padding: 20px; border: 1px solid #ddd;">
            <h2 style="color: #d9534f; text-align: center;">⚠ High CPU Usage Alert</h2>
            <p style="font-size: 14px; color: #333;">
                The CPU usage on your server has been above <b>{MAX_CPU_ALERT}%</b>
                for the last {MAX_CPU_ALERT_STAYED_SECONDS} seconds.
            </p>
            <p style="font-size: 16px; font-weight: bold; color: #d9534f; text-align: center;">
                Current Usage: {cpu_usage:.2f}%
            </p>
            <hr style="border: none; border-top: 1px solid #eee; margin: 15px 0;">
            <p style="font-size: 12px; color: #888; text-align: center;">
                This is an automated alert from your monitoring system.
            </p>
        </div>
    </body>
    </html>
    """

    msg = MIMEMultipart("alternative")
    msg['Subject'] = "⚠ High CPU Usage Alert"
    msg['From'] = FROM_EMAIL
    msg['To'] = TO_EMAIL
    msg.attach(MIMEText(html_content, "html"))

    try:
        with smtplib.SMTP(SMTP_SERVER, SMTP_PORT) as server:
            server.starttls()
            server.login(SMTP_USER, SMTP_PASS)
            server.sendmail(FROM_EMAIL, TO_EMAIL, msg.as_string())
        logging.info(f"✅ Alert email sent. CPU usage: {cpu_usage:.2f}%")
    except Exception as e:
        logging.error(f"❌ Failed to send email: {e}")


def get_cpu_usage():
    """Get idle and total CPU times from /proc/stat."""
    with open("/proc/stat", "r") as f:
        fields = f.readline().strip().split()[1:]
        fields = list(map(int, fields))
    idle_time = fields[3]
    total_time = sum(fields)
    return idle_time, total_time


# ===== Main Monitoring Loop =====
high_cpu_start = None
prev_idle, prev_total = get_cpu_usage()

logging.info("🚀 CPU monitoring started.")

while True:
    time.sleep(CHECK_INTERVAL)

    idle, total = get_cpu_usage()
    idle_delta = idle - prev_idle
    total_delta = total - prev_total
    cpu_usage = 100.0 * (1.0 - idle_delta / total_delta) if total_delta > 0 else 0.0

    prev_idle, prev_total = idle, total
    logging.info(f"CPU Usage: {cpu_usage:.2f}%")

    if cpu_usage > MAX_CPU_ALERT:
        if high_cpu_start is None:
            high_cpu_start = time.time()
            logging.warning(f"⚠ CPU usage above {MAX_CPU_ALERT}%, monitoring for {MAX_CPU_ALERT_STAYED_SECONDS}s...")
        elif time.time() - high_cpu_start >= MAX_CPU_ALERT_STAYED_SECONDS:
            send_email(cpu_usage)
            high_cpu_start = None  # Reset so we don't spam
    else:
        high_cpu_start = None
```
 	

#### Cloudflare
	1. Dashbord > Under Attack : no one bots can crawled  the site even google
 	2. Security>Bots > Bot Flight Mode : verified bots can crawl the page
  	3. 
#### Limit CPU on PID 
	i. sudo apt-get install cpulimit
 	ii. sudo nano /usr/local/bin/limit_mysql_cpu.sh
```sh
#!/bin/bash
service_PID=$(pgrep mysqld) # change this line of to get PID of process that you wnat to limit that
sudo cpulimit -p $MYSQL_PID -l 50 &
```
	iii. sudo chmod +x /usr/local/bin/limit_mysql_cpu.sh
 	vi. sudo nano /etc/systemd/system/limit_mysql_cpu.service : for restart automatically 
  ```sh
[Unit]
Description=Limit MySQL CPU Usage
After=mysql.service

[Service]
ExecStart=/usr/local/bin/limit_mysql_cpu.sh
Type=oneshot
RemainAfterExit=yes

[Install]
WantedBy=multi-user.target
```
	v. sudo systemctl daemon-reload
	vi. sudo systemctl enable limit_mysql_cpu.service
 	v. sudo systemctl status limit_mysql_cpu.service 
  	vi. sudo systemctl restart limit_mysql_cpu.service
   	v. reboot server and check its start auto or not...

## Role Management
	1. Run sudo user as root user : sudo -i
		 back to current sudo user : logout from root user
	2. user
		i. create user : useradd username 
  		   	- create user with directory : useradd -m username 
			- group name + directory :   sudo useradd -m -g www-data newusername
       		
		ii. create sudo user : useradd rekha && useradd -aG sudo rekha
		iii. delete user : userdel rekha
			- along directory : userdel -r rekha
		iv. change password : passwd rekha	
		v. change password for own : passwd
		v. transfer ownership folder to user :  chown -R username:group folderName
  		v. newly created file/folder set parent group[www-data] : sudo chmod g+s /path/to/your/directory
  	
	3. group
		i. create group : groupadd website
		ii. add user to group : usermod -aG website rekha1, rekha2, rekha3
  	
  	5. check folders ownernship
   		i. ls -l 
     		ii. ls -ld 
        6. give permission to user for execution of file for website run
		i. sudo chmod +x /home/digitechsolution 
  	7. set default bash command all user (root required)
   		- sudo nano /etc/default/useradd 
     		- change from SHELL=/bin/sh  to SHELL=/bin/bash

## Basic Linux Commands : 
       1. Move File : sudo mv file/foldernName localtionofMoveFile/opt/lampp/htdocs 
       2.  sudo chmod -R 777 filedirectory/file.php // -R : may be used for subfolder and file permissioin 
	     	7 is for all permissions read, write and execute.
		6 is used for read and write.
		5 is used for read and execute.
		4 is used for read only
###  Permission
  #### 1 to 7 Numeric Values and Their Meanings (owner group other)
	0: No permissions (---)
	1: Execute only (--x)
	2: Write only (-w-)
	3: Write and execute (-wx)
	4: Read only (r--)
	5: Read and execute (r-x)
	6: Read and write (rw-)
	7: Read, write, and execute (rwx)
   #### Website Direcotry Permission 
	1. www-data By default nginx/apache 
	2. www-data is group, not user 
	3. if run website, give permission to www-data
	3. if directory does not have group/owner -> www-data, then it will include in *other*
	4. www-data group should give permission read and exection thats number 5
	5. you can set 750 , thats mean owner has full control and group has read and execution which can be www-data
 	6. and 0 for others does not have permission

## Server Monitering
	1. get resources used by username 
 		- ps -u[username] -o %cpu,%mem | awk '{cpu+=$1; mem+=$2} END {print "CPU Usage: " cpu "%, Memory Usage: " mem "%"}'
   		- htop -u [username]
## UFW Enable
#### Method One 
	i. apt install ufw
 	ii. ufw allow 22/tcp
  	iii. ufw enable  (*if you get logout and cant login try Method Two*)
   	iv.  success enable 
    	v. Now Run WEb Server firewall status like http, https 
#### Method Two : if logout while ufw enable and cant login again through ssh  
	- ping ip -> if not response mean ufw firewall blocked 
 	0. reset server firewall 
 	1. apt install ufw
	2. ufw allow 22/tcp
	3. nano /etc/ufw/ufw.conf -> enable -> yes
	4. do not run enable ufw yet
	4. reboot vps server
	5. login again and ufw status if not enable , run command for  enable :  ufw status enable
	6. now success enable
	7. Now Run WEb Server firewall status like http, https 
 
## Allow All linux Users to run software command like node, composer
	i. setup : which <software >
 		- Ex. which node // output : /run/user/0/fnm_multishells/7030_1731325824849/bin/node
 	ii. move thats path to /usr/local/bin , Ex . mv /run/user/0/fnm_multishells/7030_1731325824849/bin/node /usr/local/bin
  	iii. now all user can access nodejs
	

## Mail Server Setup : https://inguide.in/install-and-configure-mailcow-best-self-hosted-mail-server/

## Upload to Server
	1. scp -P 22 phpmyadmin.zip root@193.201.161.241:/var/www/html
	ii. mysqldump -u user_name -p db_name > database_new_file_name.sql


## NGINX
### Block Bots
```
1. FIle :  /etc/nginx/nginx.cn
httpd {
map $http_user_agent $block_bots {
    default                          0;
    "~*SiteCheckerBotCrawler/1.0"    1;
    "~*MJ12bot"                      1;
    "~*AhrefsBot"                    1;
    "~*Barkrowler/0.9"		     1;
    "~*DataForSeoBot/1.0"	     1;
}
2. Add below line site level...
server {
...
location / {
	if ($block_bots) {
	    return 403;
	}
}
...
}
```
### NGINX SETUP
	1. Install
	- sudo apt update
 	- sudo apt install nginx -y
  	- sudo systemctl enable nginx
   	- sudo systemctl start nginx
    	- sudo systemctl status nginx
     	2. Allow Firewall
	 i. UFW : sudo ufw allow 'Nginx Full'
	 ii. iptables 
 		- sudo iptables -I INPUT -p tcp --dport 80 -j ACCEPT
		- sudo iptables -I INPUT -p tcp --dport 443 -j ACCEPT
  		- sudo netfilter-persistent save # save changes, install it if not found

###  Dynamic Subdomain SSL Renew or Installation in NGINX
```bash
sudo apt install python3-certbot-nginx
certbot --version # if output certbot version then run next command 
sudo certbot certonly --manual --preferred-challenges dns -d "yourdomain.com" -d "*.yourdomain.com" --no-bootstrap --agree-tos --email sajid.phpmaster@gmail.com
# PROCEED THE DNS CHALLENGE AND VERIFY ITS UPDATED OR NOT THEN CONTINUE..
# NOW YOU HAVE DISPLAY FULLCHAIN AND PUBLIC KEY NOW GO TO CONFIG IN NGINX.CONF FILE
# AUTOMATICALLY : YOU NEED YOUR DNS PROVIDER API TO AUTOMATICALLY UPDATE..
```
###  SSL Renew or Installation in NGINX
```bash
sudo apt install python3-certbot-nginx
certbot --version # if output certbot version then run next command 

sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

#RUN THIS COMMAND TO RENEW AUTOM
sudo systemctl status certbot.timer
```

## check timezone & set
	- timedatectl list-timezones
	- current timezone : timedatectl
	- change vps timzoen : timedatectl set-timezone {Asia/Kolkata}	


## Switch PHP Version
	- install php version   sudo apt install php7.3
	- enable with apache server : sudo apt install libapache2-mod-php7.3  
	- enable 7.3 php version : sudo a2enmod php7.3
	- disabled current php versin : sudo a2dismod php8.1
	- sudo systemctl restart apache2

## rapidex Server Configuration 	
	- variable sql_mode : remove STRICT_TRANS_TABLE (default value not set table error)
	= Note : After that all restart the apache2 : sudo systemctl restart apache2
## Security 
	1. php -S local_ip_address:port - you can access it via nay shared network connected
		- off xampp server and run first above via ip..
	2. by default xamppp server : 0.0.0.0 which is can access by localhost, local ip network and via 127.0.0.1 
	3. DDoods attack
		- add cloudfare  & add extra security layer..

## Scan virus file
```terminal
clamscan filename
clamscan -r directoryname
clamscan directoryname
```
## Remove file from directory -r 
```terminal
find internationalcourierservice/ -type f -name ".htaccess" -exec rm -f {} \;
```

### Httrack : Download Website
```bash
httrack https://bootstrapdemos.wrappixel.com/ample/dist/main/ -O cloned_website --robots=0 "+*.html" "+*.css" "+*.js" "+*.jpg" "+*.jpeg" "+*.png" "+*.gif" "+*.svg" "+*.ico" "+*.woff*" "+*.ttf" "+*.otf" "+*.eot"
```

# Websocket Setup in VPS Nginx
- Setup websocket server like link : wss://hook.courierdunia.in:1111
- Point subdomain to server ip in dns
- create nginx site with ssl & restart nginx : service nginx restart
```bash
server {
    listen 443 ssl;
    server_name hook.courierdunia.in;
    ssl_certificate /etc/letsencrypt/live/hook.courierdunia.in/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/hook.courierdunia.in/privkey.pem;


    location / {
        proxy_pass http://127.0.0.1:1111;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "Upgrade";
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;

        # Increase timeout settings if necessary
        proxy_connect_timeout 60s;
        proxy_send_timeout 60s;
        proxy_read_timeout 60s;
    }
}
```
- Allow port 6069
```bash
sudo apt install iptables-persistent

# Allow incoming traffic to port 6069 from localhost only (for reverse proxy)
iptables -A INPUT -p tcp -s 127.0.0.1 --dport 1111 -j ACCEPT

# Drop all other incoming traffic to 1111 for security
iptables -A INPUT -p tcp --dport 1111 -j DROP

sudo netfilter-persistent save
sudo systemctl enable netfilter-persistent
```
- Now You can start websocket server  & you can connect it
- It will Works!
- Now Stop Server & create automation for start websocket
- create file  /etc/systemd/system/yoursitename.service
```
[Unit]
Description=Websocket Server

[Service]
ExecStart=/usr/bin/php8.3 /home/courierdunia/main/admin/source/spark start:websocket
Restart=always
User=root
Group=root
StandardOutput=append:/var/log/websocket_cd.log
StandardError=append:/var/log/websocket_cd_error.log

[Install]
WantedBy=multi-user.target
```
- sudo systemctl daemon-reload
- systemctl enable courierdunia.service # for auto start in reboot system

## NodejsDeployment
- npm install -g pm2
- pm2 start "npm run dev -- --host 0.0.0.0 --port 5173" --name myAppName
- AutoRestart on Reboot : pm2 save && pm2 startup
- stop app : pm2 stop appName/NumericId
- delete app : pm2 delete appName/NumericId
- view running app : pm2 list
- stop all app : pm2 stop all
- delete all app : pm2 delete all
- moinitor : pm2 monitor
- remove AutoStart : pm2 unstartup systemd
- for more info :  http://pm2.io/
  
## Reset File/FolderPermissinos By PHP
```
<?php
$path = "/home/globalkingexpress";
$userGroup = "globalkingexpress:www-data";      // main project owner
$writableGroup = "www-data:www-data"; // webserver-writable dirs

// set secure ownership & base permissions
shell_exec("chown -R {$userGroup} " . escapeshellarg($path));
shell_exec("chmod -R 750 " . escapeshellarg($path));

$writable_path = [
    // "$path/assets/images/banner/dynamic",
];

foreach ($writable_path as $dir) {
    if (is_dir($dir)) {
        shell_exec("chown -R {$writableGroup} " . escapeshellarg($dir));
        shell_exec("chmod -R 770 " . escapeshellarg($dir));
    }
}
```
