## Redis Cache with PHP
	i. sudo apt install redis-server
 	ii. sudo systemctl start redis-server
	iii. sudo systemctl enable redis-server
 	iv. sudo systemctl status redis-server
  	v. Define Port & Password
   		- sudo nano /etc/redis/redis.conf
     		- search port : enter port whatever by default its used : 6379 
			- Make sure its allow in port 6379 in Firewall
	   		By UFW - sudo ufw allow 6379/tcp
       				- sudo ufw status
       				- sudo ufw reload
	   		BY IPtalble
				- sudo iptables -A INPUT -p tcp --dport 6379 -j ACCEPT
    				- sudo apt install iptables-persistent
				- sudo netfilter-persistent save
    				- sudo iptables -L : verify the rules exits 6379...


       		- search requirepass : enter password (optional) 
  	vi. Testing redis server in cli
   		- redis-cli
     		- PING  : output should PONG
  	vii. sudo apt install php8.3-redis
   	viii. enable extension in php.in  file : /etc/php/8.3/fpm/php.ini & /etc/php/8.3/cli/php.ini
    		- extension=redis.so
        xi. Verify Redis Extension installed or not
		-  php8.3 -i | grep extension_dir 
  			Output : extension_dir => /usr/lib/php/20230831 => /usr/lib/php/20230831
  		- cd /usr/lib/php/20230831 
    			Find the redis.so , then ok
	x. Testing Code : 
```php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$redis = new Redis();
try {
    // Connect to Redis server at localhost on default port 6379
    $redis->connect('127.0.0.1', 6379);

    // Authenticate with the Redis server if a password is set
    $redis->auth('your_redis_password'); 

    $redis->set('test_key', 'Hello Redis');
    echo "Stored value: " . $redis->get('test_key'); // Outputs: Hello Redis
} catch (RedisException $e) {
    echo "Couldn't connect to Redis: " . $e->getMessage();
}
```
	xi. Store Redis Data Permanently
		- nano /etc/redis/redis.conf
  		- Search & Change From appendonly no to  appendonly yes
    		- systemctl restart redis
      		- redis-cli 
			- CONFIG GET appendonly  : verify its enable & output "yes"
   			- SET mytestkey "persistent_data"  : set new key
      			- systemctl restart redis : restart or reboot the system
	 		- GET mytestkey : get your key data..
    			- FLUSHALL  : remove all keys from redis...
       			- DEL [key_name] : 
	  	- OUTSIDE CLI :
    			- redis-cli --scan --pattern "digitech*" :  List of Keys Pattenr Base
       			- redis-cli EVAL "for _,k in ipairs(redis.call('keys', ARGV[1])) do redis.call('del', k) end" 0 "digitech*" : Delete pattern base keys for large database


      		
   			
 

    		
   		


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


