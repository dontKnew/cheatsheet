What is Nodejs ?
=> Nodejs is a javascript runtime built on chorme v8 javascript engine
=> Nodejs allow you to run javascript on the server
=> Nodejs provides library of various javascript modules which help to develop web application
=> Developed by Ryan Dahl in 2009
=> Nodejs is not a framework or language
=> can be used frontend or backend develop web application
=>  Node. js is a server-side scripting language based on the Google Chrome V8 engine.
=> Fast and highly scalable and efficient.

1. Basic Commands
=> .break : sometiems you get stuck this get you out
=> .clear : alias for .break
=> .editor : Enter editor mode (Ctrl+D to finish, Ctrl+C to cancel).
=> .exit : Exit the REPL  (Read-Eval-Print-Loop : run js file on terminal through node js) 
=> .help : print this help message
=> .load : Load JS from a file intot he REPL session e.g. load./file/to/load.js
=> .save : save all evaluated terminal commands in this REPL session to file e.g. .save/file/to/save.js

2. npm init :  created a file named package.json 
{
  "name": "nodejs",
  "version": "1.0.0",
  "description": "",
  "main": "index.js",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  "keywords": [],
  "author": "",
  "license": "ISC"
}
	2.1 npm init -y : mean that previous created same previous init(package.json) 

3. Module Wrapper : Before the module's code is executed, node js will auto wrap it with a below function that look likes following: 
(function(exports, require, module, __filename, __dirname){// Module or node js code actually live in here});
=> exports - A refernce to the module.exports that is shorter to type
=> requrie - Used to import modules
=> module - A refernce to the current module , console.log(module) / 
=> __dirname - Return the directory name of current module console.log(__dirname)
=> __filename - return the current file name

4. Path :  The path module provides utilites for working with file and directory paths, it can be access using const = path  require('path')
=> const path= require('path'); // require to access all below path;
	4.1 basename()- return the last portion of current path/folderName/directoryName 
		console.log(path.basename('C:/xampp/htdocs/NodeJS')) // return NodeJS
		console.log(path.basename(__filename, '.js')) // return only file name without extension
	4.2 path.dirname('C:/xampp/htdocs/NodeJS') return directory C:/xampp/htdocs
	4.3 path.extname('index.js') return extension of file .js, if there is no extension in file, string will be return null or ''
	4.4 path.join('sajid/','hello//', 'index.js') return sajid/hello/index.js
	5.5 path.normalize('C:/\/xampp///sajid/docs') return C:\xampp\sajid\docs
		5.5.1 C:\xampp\sajid\docs
	5.6 path.parse(__filename) 
return : 
{
  root: 'C:\\',
  dir: 'C:\\xampp\\htdocs\\NodeJS',
  base: 'index.js',
  ext: '.js',
  name: 'index'
}
		5.6.1 path.parse(__filename).base return last folder or filename 

	5.7 path.isAbsolute() : check path is valid or not 
path.isAbsolute('//server')// ture
path.isAbsolute('//\//server/server')// ture
path.isAbsolute('.')// false
path.isAbsolute('bar\\baz')// false
path.isAbsolute('C:/search/sajid')// ture
path.isAbsolute('search/sajid')// false


6. File System : The fs module enables interacting with the file system in a way modeled on standard POSIX (Portable Operating System Interface) function
=> npm init and update package.json file with "type":"module" for use keyword import 
=> Asynchronous : Its allows the program to be executed immediately  
=> Synchronous :   Where the synchronous code will block further execution of the remaining code until it finishes 
=> {recursive:true} : path is not reqiure to be there and error message will not appear..
	6.1 Promise Based API: ths fs/promises API provides asynchronous file system methods that return promies
	=> const fs = require ('fs/promises');
	=> import * as fs from 'fs/promises' will be use below said all function/method...
		6.1.1 mkdir(path,[options);
			try {
 				 await fs.mkdir('C:\\xampp\\htdocs\\NodeJS\\SAJID', {recursive:true});
				 console.log("directory created");
			}catch(error){
				  console.log(error);

			 }
		6.1.2 readir(path,[option]) // read  direcotry the contain 
		6.1.3 rmdir(path,[option]) // remove directory
		6.1.4 writeFile() - writes data to a file, replacing the file if it already exits
			Syntax : writeFile(fileName/directoryfile, dataTExt, [options])
		6.1.5 readFile(path,[option]) - read file entire contains of file
		6.1.6 appendFile(path, data, [option])- append data to file , if file does not exits it will create an file
		6.1.7 copyFile(getfileCopyDatapath,PasteDatapath, [option]); // copy a file to another folder file
		6.1.8 stat(path, [option]) - used to get file information
			const stats = await fs.stat('C:\\xampp\\htdocs\\NodeJS');
			stats.isDirectory()//  return true
			stats.isFile()// return false  because in nodejs folder we did not file path with file
			
	6.2 Callback API : The callback APIs all operation asynchronously, without blocking the event loop, then invoke a callback function upon completion or error;
	=> const fs = require('fs');
	=> import * as fs from 'fs';
		6.2.1  fs.mkdir();
		fs.mkdir('C:\\xampp\\htdocs\\NodeJS', {recursive:true}, function(){
			if(error) throw error;
			 console.log("directory created");
		}) or 

		fs.mkdir('C:\\xampp\\htdocs\\NodeJS', {recursive:true}, ()=>{
			if(error) throw error;
			 console.log("directory created");
		})

	=> Now All Method will be called above said Promise Based API, as per above said first Callback syntax 

	6.3 Sync API : blocking the event if any error occured
	=> const fs = require('fs');
	=> import * as fs from 'fs';
	=> Everything is same like tha Promise Based API
	=> But After all method name you have to "Synx" keyword" Example : readFileSync(path,[option]), mkdirSync(path,[option]), writeFileSync("filename","fileText") etc.	

7. Operating System : this os module provides operating system related utility method and properites
=> cosnt os = require('os');
=> import os from 'os';
	7.1 platform();Return a string identfying the operating system. Will be return the possible Value : aix, darwin, freebsd, linux, openbsd, sunos, and; 'win32' for window	
		=> console.log(os.platform()); return win32
	7.2 arch() - Returns the operating system CPU architecture for which the NODE.js binary was complied.
		=> Might be return output will be : arm, arm64, ia32, mips, ppe, pp64, s390, s390x, x32, x64
	7.3 cpus() = Return an array of objects containing informatoion about each logocal CPU core
	7.4 hostname()- return an hostname of the operating system as stirng (mean that name of computer/laptop);
	7.5 homedir() - return current home directory; C:\Users\Sajid Ali
	7.6 networkInterfaces() - return the an object containing netowrk interface that have been assigned a netwrok address
	7.7 freemem() - return the amount of free system memeory in byts as an integer
		=> 2 bytes = 8 bit
		=> 1024 bytes =  1kilobytes (KB)
		=> 1024kilobyte = 1megabyte (MB)
		=> 1024megabyte = 1gigbyate (GB)
		=> 1024gigabyte 1terabyte(TB)
		=> next Petabyte (PB), Exabyte(GB), Zettabyte(ZB), Yottabyte(YB)
	7.8 totalmem() - return the amount of totalsystem memeory in byts as an integer

8. URL : The module provides utilites for URL resolutions and parsing 
=> const url = require('url');
=> import url from 'url';
=> const myUrl = new URL('https://www.something.com'/p/a/t/h?query=string#hash');
	8.1 hash -  gets and sets the fragment portion of the URL 
		console.log(myUrl.hash); return #hash
	8.2 host - return www.something.come
	8.3 hostname - return www.something.com
	8.4 href - whole href
	8.5 pathname - return /p/a/t/h
	8.6 prot - localhost:3000; return 3000
	8.7 protocol - 
	8.8 toString() - return  string data with serialized URL like href method
	8.9 toJSON() - return  json formate url data with serialized URL like href method
	8.10 search - return ?query=string // which search query string 
	8.11 searchParams - return URLSearchParams { 'query' => 'string' }

9. Event :  like javascript event onclick mouseover etc
=> const eventEmit = require('events');
=> import eventEmit from 'events';
	8.1 on() - 
		Example: emitEvent.on('event',()=>{console.warn('AN Event occured !');});/*Trigger Event*/ emitEvent.emit('event');
	8.2 once()- if you use this event, event trigger will once time only...

10. DNS (Domain Name System) module use it to look up IP address of host names;
=> const dns = require('dns');
=> import dns from 'dns';
	10.1 lookup() - return the name of hostname with ip address.
	Example :  dns.lookup('localhost', (error, address, family)=>{  if(error) throw error;  console.log(address); console.log(family); }); // return ip address 127.0.0.1, ip address family is 4
	10.2 resolve() -  gettong the resources records into an array of hostname
		Syntax : resolve(hostname, rrtype, callback)
		dns.resolve('geekyshows.com', (error, records)=>{if(error) throw error;  console.log(records); }); return [ '216.239.32.21', '216.239.36.21', '216.239.38.21', '216.239.34.21' ]

11. Create server :  creating server like localhost:2000, 127.0.0.1:1000 something like that.
=> import http from 'http';
=> const http = require('http');
=> http.createServer() - method includes request and response parameters which is  supplied by node js
	11.1 nodemon npm package  : Its allow to auto complie your code no need to stop server and start again
		=> npm install --save-dev nodemon  // install only locally for  project
		=> npm install -g nodemon  // install globally in computer for use anytime anywhere with any project
		=> you can generate a package.json file using npm init command.
		=> thereafter add nodemon filename.js in package.json file under script object; "scripts": {"test": "nodemon index","prod":"ndoe index"},
Example : 
const server = http.createServer((req, res)=>{ res.end("Hello I am from server");});
server.listen(500, 'localhost',()=>{console.log('server is listening to ther prot 500  ');})
runn command : npm test

=> const PORT = process.env.PORT || 4000; // get server port if does not exits, get default our port 2000
=> You can setehader for which server is responsing text or html or php under http.createServer((res, req)=>{res.setHeader('Content-Type','text/plain');})
=>  const server = http.createServer((req, res)=>{ console.log("data " + req.url)}); url if route your url localhost:4000/about, return /about,  => this is default by browser chrome icon favicon.ico 
=>  try return all method of req and res, const server = http.createServer((req, res)=>{ console.log(req, res)});
	11.2 req.method() // return POST or GET or PATCH or PUT or DELETE	=>
		=> res.statusCode = 202; // set 200 code instead of deafult "200"
		=> RES.statusMessage = "good";  set good message instead "OK" 
		=> get reqquest url only if( req.url != 'favicon.ico'){ console.log(req.url);
		=> check result in network tab : res.writeHead(202, "GOOD", {'Content-Type':'text/html'})res.end("<h1> I am from server </h1>");

	11.3 Route Http :
const server = http.createServer((req, res)=>{ 
    res.writeHead(202, "GOOD", {'Content-Type':'text/html'})
    // res.end("<h1> I am from server </h1>");
    if(req.url==='/about'){
        res.end("<h1> Hello About </h1>");
    }else if(req.url === '/contact') {
        res.end("<h1> Hello Contact Page </h1>");
    }else if(req.url==='/'){
        res.end('<h1> Home Page </h1>');
    }
});
		11.3.1 Now with file with page
Example : 
if(req.url ==='/about'){
        fs.readFile('./public/about.html', (error, data)=>{
            if(error) throw error;
            res.end(data);
        })
    }else{
        res.end('Not Found Page');
  }