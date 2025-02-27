# Docker Topics
## Everything run in image and create image : https://hub.docker.com/
## We Can create own image to run it any Operating System

## Install the mysql server in docker [https://hub.docker.com/_/mysql]
1. Download Image : docker pull mysql or  docker pull mysql:[tag]
2. Run MYSQL : docker run --name=[mysql] -e MYSQL_ROOT_PASSWORD=[root] -d mysql:[tag]
     -  -e for env. variable & -d : deatached mode (background run)
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


## Composer YML : 
- Its will create automationc downloading , create container etc.
- filename must be : docker-compose.yml
- Start Container : docker-compose up
- Stop Container : docker-compose down
- Check Logs : docker-compose logs
- Start in Background : docker-compose up -d
```yaml
version: '3.8'
services:
  # MySQL service
  mysql:
    image: mysql:5.7
    container_name: mysql
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: my_database
      MYSQL_USER: user
      MYSQL_PASSWORD: password
    volumes:
      - mysql-data:/var/lib/mysql
    ports:
      - "3306:3306"

  # First application
  app1:
    image: my-app1-image
    container_name: app1
    depends_on:
      - mysql
    environment:
      DB_HOST: mysql
      DB_PORT: 3306
      DB_DATABASE: my_database
      DB_USER: user
      DB_PASSWORD: password
    networks:
      - app-network

  # Second application
  app2:
    image: my-app2-image
    container_name: app2
    depends_on:
      - mysql
    environment:
      DB_HOST: mysql
      DB_PORT: 3306
      DB_DATABASE: my_database
      DB_USER: user
      DB_PASSWORD: password
    networks:
      - app-network

networks:
  app-network:
    driver: bridge

volumes:
  mysql-data:
    driver: local
```
