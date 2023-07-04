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
    </body>
    </html>
  ```
