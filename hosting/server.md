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


##  Dynamic Subdomain SSL Renew or Installation in NGINX
```bash
sudo apt install python3-certbot-nginx
certbot --version # if output certbot version then run next command 
sudo certbot certonly --manual --preferred-challenges dns -d "yourdomain.com" -d "*.yourdomain.com" --no-bootstrap --agree-tos --email sajid.phpmaster@gmail.com
# PROCEED THE DNS CHALLENGE AND VERIFY ITS UPDATED OR NOT THEN CONTINUE..
# NOW YOU HAVE DISPLAY FULLCHAIN AND PUBLIC KEY NOW GO TO CONFIG IN NGINX.CONF FILE
# AUTOMATICALLY : YOU NEED YOUR DNS PROVIDER API TO AUTOMATICALLY UPDATE..
```

##  SSL Renew or Installation in NGINX
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


