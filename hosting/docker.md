# Docker Topics

## Install the mysql server in docker [https://hub.docker.com/_/mysql]
1. Download Image : docker pull mysql or  docker pull mysql:[tag]
2. Run MYSQL : docker run --name=[mysql] -e MYSQL_ROOT_PASSWORD=[root] -d mysql:[tag]
     -  -e for env. variable
     -  -d : deatached mode (background run)
     
     -  Access MYSQL Server Outside of Docker Container By Port Binding :  - p outsideContainerPort:insideMYSQLPort
         : docker run --name=[mysql] -e MYSQL_ROOT_PASSWORD=[root] -d -p 3306:3306 mysql:[tag]
        1. You need to set port on run command , otherwise remove and add container again    !
        2. By Port Binding You access mysql server in your computer or outside of docker
        
     -  Save MYSQL Database on Stop Container or Restart or newly create new container mysql
          1. For Linux : docker run --name=[mysql] -e MYSQL_ROOT_PASSWORD=[root] -v  /local/user/path:/var/lib/mysql -d mysql:[tag]
          2. For Window : docker run --name=[mysql] -e MYSQL_ROOT_PASSWORD=[root] -v /c/Users/Aman/Desktop:/var/lib/mysql -d mysql:[tag]
3. check running mysql container : docker ps -a
4. Access MYSQL Server : docker exec -it [mysql] mysql -u root -p
5. Stop MYSQL Container : docker [mysql] stop
6. Start MYSQL Container : docker [mysql] start 

