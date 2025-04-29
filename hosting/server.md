# Table of Contents

1. [Install PHP FPM Version](#install-php-fpm-version)
2. [Server Monitoring](#server-monitering)
   - [Cloudflare Configuration](#cloudflare)
   - [Limit CPU Usage on PID](#limit-cpu-on-pid)
3. [UFW Firewall](#ufw-enable)
4. [Nginx](#nginx)
5. [Apache + PHP + MySQL Server](#install-apache--php--mysql)
6. [PHP](#php)
   - [1. Switch between multiple PHP Versions](#1-switch-between-multiple-php-versions)
   - [2. Check PHP Modules](#2-check-php-modules)
7. [NGNINX SSL](#ssl-nginx)
    - [Dynamic SubDomain SSL](##dynamic-subdomain-ssl-renew-or-installation-in-nginx)
    - [Install SSL ](#ssl-renew-or-installation-in-nginx)
8. [Role Management](#role-management)
9. [Basic Linxu Command](#basic-linux-commands).
	- [Permission](#permission)
 	- etc.
10. Server Security
	-  

## Redis Cache with PHP - <a href="redis-cache.md">View Docs </a>

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
## Install PHP FPM Version
	i. sudo add-apt-repository ppa:ondrej/php ( if need)
 	ii. sudo apt update
  	iii. sudo apt install php8.3-fpm
   	iv. sudo apt install php8.3-cli php8.3-common php8.3-json php8.3-opcache php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-redis
    	v. 

## Server Monitering..
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



## PHP-FPM installation 
	1. install extension : sudo apt install php8.2-[extensionName]
 		or : sudo apt install php8.2 php8.2-fpm php8.2-cli php8.2-mbstring php8.2-xml php8.2-zip
 	2. composer with different php version :  php8.2 /usr/local/bin/composer require hermawan/codeigniter4-datatables
  	3. php[version]-fpm package not found : 
   		- sudo add-apt-repository ppa:ondrej/php
     		- sudo apt update
       		- sudo apt install php[version] php[version]-fpm  		
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


## SSL NGINX 
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

## install apache & php & mysql 
	i. apt update
	ii. apt install apache2
	iii. enable firewarell
			- apt install ufw && ufw enable 
			-  fw status 
			more infor : https://github.com/geekyshow1/GeekyShowsNotes/blob/main/ufw_firewall_setup.md
	iv. ufw allow "Apache Full"
		-80 for https & 443 for http  enabled for check : ufw status
		**Important cmd for do not lose the ssh access : ufw ssh **
		- add 22 port in firewall for ssh access & if u changed ssh port you should change as well then add ufw ssh .. port..etc.
		- Check Server IP on Web Browser You will see Apache Default Page
	v. apt install mysql-server 
	vi. apt install php libapache2-mod-php php-mysql
		- The above command includes three packages:-
		php -  To Install PHP
		libapache2-mod-php - It is Used by apache to handle PHP files
		php-mysql - It is a PHP module that allows PHP to connect to MySQL 
	v. service apache2 restart
	- install extension using php version if u multiple php version : sudo apt install php7.3-curl


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


