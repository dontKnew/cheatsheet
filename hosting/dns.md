#DNS

## DNS Configuration
  I. create test.domain.com 
	type : A, name : test,  value : ipv4(shared ip)

  II. mail received domain
	type : MX  name : @, value : mail.domain.com or smtp.gmail.com or another mail_server_address

  III. Point Main Domain to hosting panel
		 Type	 Host/Name Value
		- A	  @ 	   ip4/6 server
		- A       @ 	   ip4/6 server
		- AAAA	   @		ipv6 sever (in vps mandatory)
		- AAAA	   wwww		ipv6 sever'(in vps mandatory)
		- A	   www	    ipv6 - for www.domain.com site 
  	

## Transfer domain dns setting to another service provider or hosting provider
	- remove nameserver in domain provider
	- update service/hosting provider nameserver to domain provider 
	- now you can manage dns setting from service/hosting provider
