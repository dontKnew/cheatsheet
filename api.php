1. HEADERS 
    => API  : when we call the api its, required headers before proceeding our api function
        i. headers: {'Authorization': '[your API key]'}
            - header('HTTP/1.0 401 Unauthorized'); // return 401 code page page is Unauthorized
        
        ii. header('Content-type: application/json');
            - header('Content-Type: text/html; charset=utf-8'); ?> 
                => use this in html code <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            - header('Content-Type: text/plain; charset=utf-8');
            - header('Content-Type: application/json; charset=utf-8');

        iii. FILE HEADERS
                header('Content-Type: application/pdf');
                header('Content-Type: image/jpeg');
                header('Content-Type: image/png');
                header('Content-Type: image/gif');
        iv. header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
                header('Access-Control-Allow-Methods: *');

        v. header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
            header("Access-Control-Allow-Headers: HeaderName");
            or header("Access-Control-Allow-Headers: *"); 
        
        vi. header("Access-Control-Max-Age:delta-seconds) //  
            header("Access-Control-Max-Age:600) // Cache results of a preflight request for 10 minutes:
            - Default value delta-seconds is 5 seconds
        vii. header("Access-Control-Allow-Credentials:true) // true : mean you are allowing credentials like
                - Credentials are cookies, authorization headers, or TLS client certificates.

              




 


        iii. header('Access-Control-Allow-Origin: *'); // instead of using *, you can pass url for which website can be access this api

    => Access Headers in PHP
        $headers = apache_request_headers(); $headers['Authorization'];

    => getallheaders () // fetch all request http headers   
            Ex : php $headers = getallheaders (); 
                foreach ($headers as $key => $value) { echo "$key: $value"; echo "<BR>"; } ?> 