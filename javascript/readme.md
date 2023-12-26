# Export & Import in Pure JavaScript & HTML File

This guide demonstrates how to export and import modules in pure JavaScript and HTML files without using a module bundler like Webpack.

## File Structure
- `helper.js`: Contains the `Helper` class that will be exported.
- `custom.js`: JavaScript file that imports and uses the `Helper` class.
- `index.html`: HTML file that includes the JavaScript code.

## Steps
1. Create a file named `helper.js` and define the `Helper` class within it:
   ```javascript
   export class Helper {
     test() {
       console.warn("hello world");
     }
   }
   ```
2. custom.js
   ```javascript
     import { Helper } from './helper.js';
    const helper = new Helper();
    helper.test();
   ```
4. index.html file
     ```html
       <!DOCTYPE html>
       <html>
       <head>
         <title>My HTML Page</title>
       </head>
       <body>
         <script src="custom.js" type="module"></script>
        <!-- Output Console : hello world  -->
       </body>
       </html>
     ```
Note : if you use static keyword in class method then you can not created instance you must direct call class.methodname Helper.get()



## References
``js
    function includeHTML() {
  var z, i, elmnt, file, xhttp;
  /* Loop through a collection of all HTML elements: */
  z = document.getElementsByTagName("*");
  for (i = 0; i < z.length; i++) {
    elmnt = z[i];
    /*search for elements with a certain atrribute:*/
    file = elmnt.getAttribute("w3-include-html");
    if (file) {
      /* Make an HTTP request using the attribute value as the file name: */
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          if (this.status == 200) {elmnt.innerHTML = this.responseText;}
          if (this.status == 404) {console.warn("could not inlcude file");}
            /* Remove the attribute, and call this function once more: */
          elmnt.removeAttribute("w3-include-html");
          includeHTML();
        }
      }
      xhttp.open("GET", file, true);
      xhttp.send();
      /* Exit the function: */
      return;
    }
  }
}

includeHTML();
        <div w3-include-html="include/c1.html"></div>
``

``js
function copyLink(link) {
        var tempInput = document.createElement("input");
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("Link has been copied");
    }
``

``js
// stop marquee slider on hover
  var slider = document.getElementById('slider_marquee');
    slider.addEventListener('mouseover', function() {
      this.stop();
    });
    slider.addEventListener('mouseout', function() {
      this.start();
    });

``

``js
// selected attribute
  <select>
    <option id="apple">Apple</option>
    <option id="orange">Orange</option>
    <option id="pineapple" selected>Pineapple</option> // Pre-selected
    <option id="banana">Banana</option>
  </select>
<script>
function myFunction() {
  document.getElementById("orange").selected = "true";
}
``

