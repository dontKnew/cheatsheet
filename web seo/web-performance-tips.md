== Check PHP/MYSQL/NGINX/APACHE speed test.. == 
1. curl -s -o /dev/null -w "%{time_starttransfer} s -> TTFB, %{time_total} s -> Total\n" https://yourdomain.com
- If TTFB (Time to First Byte) is low (~0.1s) but Total Time is high (~2s) → Check frontend issues.
- If TTFB is high (>0.5s) → Check PHP/MySQL performance.
== Server Side Compression ==
- Enable the gzip compress for CSS, IMAGE, DOCS, ETC
- nginx server
 	gzip on;
 	gzip_comp_level 6; # 9 for best
 	gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;


=> PHP Library thats can help for

Minify - a PHP library for minifying HTML, CSS, and JavaScript code.
Cache Lite - a PHP caching library that can help you reduce database queries and improve page load time.
Twig - a PHP template engine that can help you optimize your website's HTML structure and improve its performance.
OpCache - a PHP extension that can improve PHP performance by caching and reusing compiled script bytecode.
Blackfire - a PHP profiling tool that can help you identify performance bottlenecks and optimize your PHP code.

QUICK TIPS --
1.  $("img").lazyload({
        effect: "fadeIn",
        bind: "event",
        delay: 0
    });

2. enable lightouse in chrome deve tol go to web store and install lighthouse
=> improve LCP 
	1. cache enable : whenenver user visit the website some image/text cache store the user system thats helpful for load website fast
	2. Font-Display:swap; anywhere in the css @font {} add line of swap method
	3. Defer : use keyword inside of script tag
	4. minified html/csss/js 
	5. make sure give the width and height of your image

=> IMPROVE CLS
	2. lazy attribute in <img src, alt, lazy/>
	1. use fonts thats are similar to system fonts
	2. use system fonts to begin with by adding in @font {Font-Display:swap;}
	3. self host your fonts but hosting service speed must be good
	4. optimize your images in jpeg or png formats 
	5. use webp formate of image
	6. give your image proper size width and heigth inside of image tag 
	-> Identify which element is change position while loading website
		1. inspect the tool in performance tab
		2. tick the Web Vitals  right side
		3. click the reload icon left side
		4. check LONG TASK
			- here you can see FCP, LCP AND Layout shift (CLS) 
			- now you have to fixed the element will not chnange position if while loading OK!

=> #fontawesome cross error in with htaccess
	<FilesMatch "\.(ttf|otf|eot|woff|woff2)$">
	   <IfModule mod_headers.c>
	      Header set Access-Control-Allow-Origin "https://hiremyescort.com"
	   </IfModule>
	</FilesMatch>
=> enable cache

# Enable caching for static files

<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpeg "access plus 1 month"
    ExpiresByType image/png "access plus 1 month"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType text/javascript "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType application/x-font-ttf "access plus 1 month"
    ExpiresByType font/opentype "access plus 1 month"
    ExpiresByType application/font-woff "access plus 1 month"
    ExpiresByType application/vnd.ms-fontobject "access plus 1 month"
</IfModule>
This code enables caching for the following types of static files:
JPEG images
PNG images
CSS files
JavaScript files
TTF fonts
OpenType fonts
WOFF fonts
EOT fonts
