<<<<<<< HEAD
Nest Js :  Web Basis framework
=> install nest js command : npm i -g @nestjs/cli
=> create new project : nest new projectName
=> NEST JS  RUN ON localhost:3000
1. NEST ROUTE
=> create route command : nest generate controll routeName
=>import { Controller, Get, Req, Request } from '@nestjs/common';// add routefile
//newRouteName file  under controller class
@Get() // localhost:3000/routefileName OUTPUT: [{"make":"honda1","mode":"accord"},{"make":"subaru2","mode":"outback"}]
    findAll(@Req() request:Request):{}{
        return [
            {make:'honda1',mode:'accord'},
            {make:'subaru2',mode:'outback'}
    ]
    };
  // @Get('love/showroute') // u can use also this like 
    @Get('showroute') // this case will be work like that localhost:3000/routefileName/showroute OUTPUT: hello I am under root
    showcase(@Req() request: Request) : string {
        return "hello I am under root";
    }

2. WILDCARD ROUTES : route : localhost:3000/personal/6, that last digit is called wildcard route
// route controller file
@Get(':id') // ':id' that semicolon is called as wildcard route.
    findOne(@Req() request:Request):{}{
        return [
            {id:1, make:'honda1',mode:'accord'},
    ] // localhost:3000/routefilename/1 output : [{id:1, make:'honda1',mode:'accord'}]

3. WEB API 
GET /cars => gets a list of cars
POST /cars => creates a new car based on the bundle of data you sent it
GET /cars/:id => gets one car based on the id you sent it as a wildcard
POST /cars/:id => updates a car based on a bundle of data to update a car
POST /cars/:id/delete => deletes a car
=> There are other HTTP verbs like PUT and DELETE, but since web pages only understand GET and POST, we are using these verbs for simplicity.
=> The GET and POST patterns we're showing above are called RESTful routes.

4. MAKING POST REQUEST
    @Post()
    async create(@Body() carParams){
        return 'I got your post request, You want to create a '+carParams.make;
    }
5. MAKE AN EDIT REQUEST
    @Post(':id')
    async update(@Body() carParams, @Param() params){
        return 'I got your post request, You want to edit a '+carParams.make + 'belonging to ' + params.id;
    }

6. setup database table in mysql or postgreSQL

6. typeORM : Object Relatioinal Mapping => An ORM is essentially a multilingual database communicator.
better understand image : https://api.sololearn.com/DownloadFile?id=4003
=> npm add @nestjs/typeorm mysql mysql - mysql (for pg it'll be pg respectively)

=======
Nest Js :  Web Basis framework
=> install nest js command : npm i -g @nestjs/cli
=> create new project : nest new projectName
=> NEST JS  RUN ON localhost:3000
1. NEST ROUTE
=> create route command : nest generate controll routeName
=>import { Controller, Get, Req, Request } from '@nestjs/common';// add routefile
//newRouteName file  under controller class
@Get() // localhost:3000/routefileName OUTPUT: [{"make":"honda1","mode":"accord"},{"make":"subaru2","mode":"outback"}]
    findAll(@Req() request:Request):{}{
        return [
            {make:'honda1',mode:'accord'},
            {make:'subaru2',mode:'outback'}
    ]
    };
  // @Get('love/showroute') // u can use also this like 
    @Get('showroute') // this case will be work like that localhost:3000/routefileName/showroute OUTPUT: hello I am under root
    showcase(@Req() request: Request) : string {
        return "hello I am under root";
    }

2. WILDCARD ROUTES : route : localhost:3000/personal/6, that last digit is called wildcard route
// route controller file
@Get(':id') // ':id' that semicolon is called as wildcard route.
    findOne(@Req() request:Request):{}{
        return [
            {id:1, make:'honda1',mode:'accord'},
    ] // localhost:3000/routefilename/1 output : [{id:1, make:'honda1',mode:'accord'}]

3. WEB API 
GET /cars => gets a list of cars
POST /cars => creates a new car based on the bundle of data you sent it
GET /cars/:id => gets one car based on the id you sent it as a wildcard
POST /cars/:id => updates a car based on a bundle of data to update a car
POST /cars/:id/delete => deletes a car
=> There are other HTTP verbs like PUT and DELETE, but since web pages only understand GET and POST, we are using these verbs for simplicity.
=> The GET and POST patterns we're showing above are called RESTful routes.

4. MAKING POST REQUEST
    @Post()
    async create(@Body() carParams){
        return 'I got your post request, You want to create a '+carParams.make;
    }
5. MAKE AN EDIT REQUEST
    @Post(':id')
    async update(@Body() carParams, @Param() params){
        return 'I got your post request, You want to edit a '+carParams.make + 'belonging to ' + params.id;
    }

6. setup database table in mysql or postgreSQL

6. typeORM : Object Relatioinal Mapping => An ORM is essentially a multilingual database communicator.
better understand image : https://api.sololearn.com/DownloadFile?id=4003
=> npm add @nestjs/typeorm mysql mysql - mysql (for pg it'll be pg respectively)

>>>>>>> cfd600b1137999584ea8e6a28fdb156549de1625
