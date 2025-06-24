# MYSQL TABLE DATABASE 

## MYSQL RELATIONSHIP ON-ACTION ..
	i. CASCADE : Automatically delete/update the child rows when the parent is deleted/updated.
	ii. SET NULL :	Set the foreign key in the child table to NULL if the parent is deleted/updated.
	iii. SET DEFAULT :	Set the foreign key to its default value. (Used rarely; needs default set.)
	iv. RESTRICT : Prevent deletion/update if any child rows exist. (Fails with error.)
	v. NO ACTION :	Same as RESTRICT in most DBs. Delays check until end of transaction
 ### Example : 
```sql

Invoice Note Table : 
id (primary key)
invoice_no (unique key, index key)
invoice_name

Invoice Note Items Table  :
id (primary key )
invoice_note_no (unique key, index key)
invoice_no (set relationship on cascade  to table invoice_note.invoice_no on update and on delete )
invoice_note_name

1. ON DELETE CASCADE
– If you run
DELETE FROM invoice_note
WHERE invoice_no = 'INV-2025-001';
then all rows in invoice_note_items whose invoice_note_no = 'INV-2025-001' will be automatically deleted.
This keeps you from having “orphan” items that point to a non-existent invoice.

2. ON UPDATE CASCADE
– If you run
UPDATE invoice_note
SET invoice_no = 'INV-2025-XYZ'
WHERE invoice_no = 'INV-2025-001';
then every invoice_note_no in invoice_note_items that was 'INV-2025-001' will be changed to 'INV-2025-XYZ' for you.

This preserves referential integrity if you ever rename an invoice number.
```


## What is Socket 
=> make an connection between server and client by using host and port for exchange message or data between client and server
=> usefull in chat application and instance response message without page refresh.
### Example 
    server.php
        2.1 Created Connection
            $host="127.0.0.1";
            $port=8080;
            $socket=socket_create(AF_INET,SOCK_STREAM,0) or die('Not Created');
            $result=socket_bind($socket,$host,$port) or die('Not bind');
            $result=socket_listen($socket,3) or die('Not listen');
        2.2 read the code while sending message by client.php        
            do{
                $accept=socket_accept($socket) or die('Not accept');
                $msg=socket_read($accept,1024);
                $msg=trim($msg);
                echo $msg."\n";
            }while(true);
        2.3 Close connection
            socket_close($socket);
    client.php  
        3.1 create connection to server.php
            $host="127.0.0.1";
            $port=8080;
            $socket=socket_create(AF_INET,SOCK_STREAM,0) or die('Not Created');
            socket_connect($socket,$host,$port) or die('Not connect');
        3.3 write an message
            $msg= "Good Morning";
	        socket_write($socket,$msg,strlen($msg));
        3.4 close connection
            socket_close($socket);

     testing : i. open client.php file in browser ii. open server.php file in command prompt : php - f server.php
        => When you refersh a page,,, then message will go there server.php command prompt.. 
        

