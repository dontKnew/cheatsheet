
## Mail Server Setup : https://inguide.in/install-and-configure-mailcow-best-self-hosted-mail-server/

## Upload to Server
	1. scp -P 22 phpmyadmin.zip root@193.201.161.241:/var/www/html
	ii. mysqldump -u user_name -p db_name > database_new_file_name.sql


## Hostinger Snapshort features
1. after setup configuratio software etc in server operatingsystem then create one snapshot 
2. if feature any setting will occrupt not working , you can use restore snapshot  , go back to time config of  sanpshot created


## add ssh key in hostinger vps
- generate : ssh-keygen -f .ssh/vps_key -t rsa -b 4096
- get key go to .ssh folder  & open file  'vps_key.pub
- Go to vps hostinger settings -> SSH KEY -> ADD New -> Name : myvpsssh, Value : {vps_key.pub text..}
Error :   WARNING: REMOTE HOST IDENTIFICATION HAS CHANGED!
- go to .ssh folder and open hots_known file and remove generate line for vps or server ip...

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


## Point Domain to Main VPS Server  & host multiple site
	- After that ip and domain will open same page	
	- verify the installation cmd : apache2 -v, mysql , php -v 
	- verify apceh running :  service apache2 status 
	- Verify Web Server Ports (80 and 443) are Open and Allowed through Firewall : ufw status verbose
	i. Domain Provider DNS config
		 Type	 Host/Name Value
		- A	  @ 	   vps ip4/6 server
		- A       @ 	   vps ip4/6 server
		- AAAA	   @		vps ipv6 sever
		- AAAA	   wwww		vps ipv6 sever'
	ii. nano /etc/apache2/sites-available/{your_domain}.conf		
	<VirtualHost *:80>
	    ServerName www.domain.com
	    ServerAdmin contact@domain.com
	    DocumentRoot /var/www/DomainfolderName
	    ErrorLog ${APACHE_LOG_DIR}/error.log
	    CustomLog ${APACHE_LOG_DIR}/access.log combined
	</VirtualHost>
	ii. enable virtual host : cd /etc/apache2/sites-available/
	   a2ensite your_domain.conf & for disabled : a2dissite 000-default.conf
	iii. service apache2 restart
	iv. upload index.html file in var/www/domainFolderName
		- 	- After that ip and domain will open same page	

	- https - work virtual host , other will not
	- debug error set in .htaccess file :
		php_flag display_startup_errors on
		php_flag display_errors on

## install ssl certifictate for domain or all domain
	- pacagek install : apt install certbot python3-certbot-apache
	- get cerification : certbot --apache
	- status of certi : systemctl status certbot.timer
	- certificate auto renewal & then check auto renewal working or not : certbot renew --dry-run

## Easy : https://github.com/geekyshow1/GeekyShowsNotes/blob/main/Disable_Dir_Browsing_Apache.md
	- nano /etc/apache2/apache2.conf
		<Directory /var/www/>
        Options FollowSymLinks #removed indexes..
        AllowOverride None
        Require all granted
</Directory>
	- cd /etc/apache2/sites-available/domain.conf add above data
<Directory /var/www/html>
        Options FollowSymLinks #removed indexes..
        AllowOverride None
        Require all granted
</Directory>
	- cmd : service apache2 restart

## MYSQL
	-apt update && upgarde then apt install mysql-server
	- set password securely cmd : mysql_secure_installation
	- Login as Root User : mysql -u root -p
	- exit from mysql : exit

## Deploy PHP Project
	- debug error : erro_reporting(E_ALL);ini_set('display_errors',1);
	- ele go to var/logs/apache2/error_log withroot user 

## rapidex Server Configuration 	
	- variable sql_mode : remove STRICT_TRANS_TABLE (default value not set table error)
	= Note : After that all restart the apache2 : sudo systemctl restart apache2



i. 80 : for https & 443 for http
	
sudo nginx -t : after changed check any erorr

