### httrack https://bootstrapdemos.wrappixel.com/ample/dist/main/ -O cloned_website --robots=0 "+*.html" "+*.css" "+*.js" "+*.jpg" "+*.jpeg" "+*.png" "+*.gif" "+*.svg" "+*.ico" "+*.woff*" "+*.ttf" "+*.otf" "+*.eot"
## Server Monitering
	1. get resources used by username 
 		- ps -u[username] -o %cpu,%mem | awk '{cpu+=$1; mem+=$2} END {print "CPU Usage: " cpu "%, Memory Usage: " mem "%"}'
   		- htop -u [username]
 	2. 
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
  	

	4. Disable Root Login
		i. nano /etc/ssh/sshd_config
		ii. change permitRootLogin = yes to permitRootLogin = no
  	5. check folders ownernship
   		i. ls -l 
     		ii. ls -ld 
        6. give permission to user for execution of file for website run
		i. sudo chmod +x /home/digitechsolution 
  	7. set default bash command all user (root required)
   		- sudo nano /etc/default/useradd 
     		- change from SHELL=/bin/sh  to SHELL=/bin/bash
       8. 
	
## Basic Linux Commands : 
       1. Move File : sudo mv file/foldernName localtionofMoveFile/opt/lampp/htdocs 
       2.  sudo chmod -R 777 filedirectory/file.php // -R : may be used for subfolder and file permissioin 
	     	7 is for all permissions read, write and execute.
		6 is used for read and write.
		5 is used for read and execute.
		4 is used for read only
##  Permission
  ### 1 to 7 Numeric Values and Their Meanings (owner group other)
	0: No permissions (---)
	1: Execute only (--x)
	2: Write only (-w-)
	3: Write and execute (-wx)
	4: Read only (r--)
	5: Read and execute (r-x)
	6: Read and write (rw-)
	7: Read, write, and execute (rwx)
   ### Website Direcotry Permission 
	1. www-data By default nginx/apache 
	2. www-data is group, not user 
	3. if run website, give permission to www-data
	3. if directory does not have group/owner -> www-data, then it will include in *other*
	4. www-data group should give permission read and exection thats number 5
	5. you can set 750 , thats mean owner has full control and group has read and execution which can be www-data
 	6. and 0 for others does not have permission
   
1.1. Software Installation in Linux 
    1. Xampp Installtion : sudo dpkg -i xampp-linux-x64-8.1.2-0-installer.run
    2. visual studio :  sudo dpkg -i visual.deb.
    3. Kazam Screen recorder for kali . 
        Super+Ctrl+R: Start recording
        Super+Ctrl+P: Pause recording, press again for resuming the recording
        Super+Ctrl+F: Finish recording
        Super+Ctrl+Q: Quit recording
    3. NODE-JS via tar.xz file
        => sudo apt update
        => sudo apt install xz-utils // its allow for install .xz file
        => Extract file from tar.xz 
            sudo tar -xvf name_of_file
        => Extracted folder files copy to computer root folder 
            sudo cp -r directory_name/{bin,include,lib,share} /usr/
            sudo cp -r heroku/{bin,lib,node_modules} /usr/
        =>  check installed or not : node - v and npm -v

    3.1.1 npm ERR!can not add insert something : 
         => dpkg -i --force-overwrite nodejs_17.6.0-deb-1nodesource1_amd64.deb
         => Remove Node js  from kali linux   
            “remove nodejs in kali linux completely” nod
            sudo rm -rf /usr/local/lib/node* && sudo rm -rf /usr/local/include/node* && sudo rm -rf /usr/local/bin/node*
        
        =>  Install stable version of node js
            sudo npm install -g n
            sudo n stable // node js will install stable version , you can check also stable version in node js website
            
            Note : if not updated stable  version node js and npm version 
            run command : hash -r  (for bash, zsh, ash, dash, and ksh)
            re-back command : rehash   (for csh and tcsh)


     4. install xamp server"
	    => download xampp server for linux 
	    => sudo ./xampp-linux-x64-8.1.2-0-installer.run
	    =>  Start xamp after installed : sudo /opt/lampp/lampp start XAMPP            
	    4.1 Open Pannel Xampp Server Icon
		sudo /opt/lampp/manager-linux-x64.run 
	    4.2 xampp server help  run command:
		 sudo /opt/lampp/lampp yourActionBelow 

		    start         Start XAMPP (Apache, MySQL and eventually others)
		    startapache   Start only Apache
		    startmysql    Start only MySQL
		    startftp      Start only ProFTPD

		    stop          Stop XAMPP (Apache, MySQL and eventually others)
		    stopapache    Stop only Apache
		    stopmysql     Stop only MySQL
		    stopftp       Stop only PeiroFTPD

		    reload        Reload XAMPP (Apache, MySQL and eventually others)
		    reloadapache  Reload only Apache
		    reloadmysql   Reload only MySQL
		    reloadftp     Reload only ProFTPD

		    restart       Stop and start XAMPP
		    security      Check XAMPP's security
		    
		    enablessl     Enable SSL support for Apache
		    disablessl    Disable SSL support for Apache

		    backup        Make backup file of your XAMPP config, log and data fies

		    oci8          Enable the oci8 extenssion

		    panel         Starts graphical XAMPP control panel

	5. install angular:sudo npm install -g @angular/cli
	6. install git :  sudo apt-get install git
    
