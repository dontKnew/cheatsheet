=> SETUP
1.Tailwind CLI or without postcss:

	i. npm init -y or npm init
	ii. npm install -D tailwindcss  And 
		 create file : tailwind.config.js : 
			module.exports = {
			  corePlugins: {
			    preflight: false, // if this true, then  you can not use h1, h2, h3, tag size unit and ol, ul, list etc.
			  },
			  content: ["./src/**/*.{html,js}"], // thats identify the content of file html extension 
			  					and javascript all index html file should be inside of src folder
			  theme: {
			    extend: {},
			  },
			  plugins: [],
			}
			or 
			npx tailwindcss init  : will create above saidcode.

	iii. create file css file inside of ./src/input.css and add below code OK!  
			@tailwind base;
			@tailwind components;
			@tailwind utilities;

	iv. add script in package.json :
		"build": "tailwindcss build -i ./src/input.css -o ./public/output.css",
	        "watch" :"tailwindcss build -i ./src/input.css -o ./public/output.css --watch" // no need to again npm run build command

	v. Ready to used
		-> src/index.html : <link rel="stylesheet" href="../public/output.css">
			<h2 class="bg-red-500 text-white">helllo</h2>
		        <h2 class="bg-blue-500 text-white">helllo</h2>
		-> npm run build : this command is run only one time to build tailwind css code
		-> npm run watch : this command will read all index.html tailwind css classes while using tailwind classes 
	
	
2.TAILWIND with postcss plugin usedfull with framework like angular, react, dart etc.

	i. npm init or npm init -y // -y : will use your old npm init information
	ii. npm install -D tailwindcss postcss autoprefixer
	iii. npx tailwindcss init 	// will create all tailwind.config.js file
	like above said method...
// learn later..

3. PRODUCTION
	- npx tailwindcss build -i ./public/css/input.css -o ./public/css/style.css --watch --minify



			