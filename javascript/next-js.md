# NEXT JS (13/14) / REACT JS
## Table of Contents
1. [Introduction](#Introduction)
2. [React Concept](#react-concept)
3. [Basic](#basci)
   - [Pass Data to Child  Components] (#pass-data-to-child-component)
   - [Pass Data From Child to Parent Component](#pass-data-from-child-to-parent-component)
4. [Routes](#routes)
5. (External Library)(#external-library)
   - [MySQL Database](mysql-database)
6. [Nextjs API](#nextjs-api)
7. [Global State](#global-state)



## External Library
### MYSQL Database
- install below library & use it 
```
npm install mysql2
```



## Introduction (13/14)
- Next.js is a framework for building web applications.
- With Next.js, you can build user interfaces using React components. Then, Next.js provides additional structure, features, and optimizations for your application.
- Next.js can help you build interactive, dynamic, and fast web applications.
- all components are __server side rendering__ by default, and you check console.log('hello in terminal, not in browser console log')
  
### Installation
- npx create-next-app@latest 
- if you will ask elint ? used "yes" : its help to indentify the errors :)
- Learn Carefully __Project Strucutre__ from here <a href="https://nextjs.org/docs/getting-started/project-structure"> click here </a>

## React Concept 
- <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/react-js.md"> Custom Hook </a>
- <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/react-js.md"> Conditional Render </a>
- <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/react-js.md"> List & Keys </a>
- <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/react-js.md"> SSR & PHP </a>
- <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/react-js.md"> List & Keys </a>
- <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/react-js.md"> FontAwesome </a>
- <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/react-js.md"> Boostrap </a>
- <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/react-js.md"> Form </a>
- <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/react-js.md"> Envrionment Variable </a>
- <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/react-js.md"> Library For React Js </a>


## BASIC
### Pass Data to Child Component
- <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/react-js.md"> Props </a>
### Pass Data from Child to Parent Component
```jsx
export default function Page() {
  const [userData, setUserData] = useState([]);
  const handleUserData = (data) => {
    setUserData((prevData) => [...prevData, data]);
  };

  return (
    <>
      <User name="Sajid" onData={handleUserData} />
      <User name="Kamina" onData={handleUserData} />
      <User name="Krishna" onData={handleUserData} />
      <div>
        <h2>User Data Received:</h2>
        <ul>
          {userData.map((data, index) => (
            <li key={index}>{data}</li>
          ))}
        </ul>
      </div>
    </>
  );
}

function User(props) {
  const handleButtonClick = () => {
    props.onData(`from Child Component ${props.name}`);
  };

  return (
    <div>
      <h1>Hello {props.name}</h1>
      <button onClick={handleButtonClick}>Send Data to Page</button>
    </div>
  );
}
```

### Client/Server Side Rendering
```jsx
'use client' // remove it then it will server sider renddering
export default function Home() {
  const noti= (hello) =>{
    alert(`Hello ${hello}`);
  }
  return (
    <>
      <button onClick={()=>{noti("Krishna")}}> click me</button>
    </>
  );
}
```

## Routes
- Basic Folder File Base Routing can be used like home/page.js & about/page.js in src or app directory of root project, Now you can access the localhsot:3000/home or localhost:3000/about page
- __Dynamic Routes__ : you should use folder name Ex.  student_list/`[student_details]`
```jsx
//folder : student_list/[student]/page.js  
"use client"
export default function Student({ params }) {
    console.warn(params.student) 
    return (
      <div>
        <h1>Hello, Student {params.student}</h1>
      </div>
    );
  }
```
- __Optional Routes__ : you should use folder name Ex.  student_list/[[student_details]]
```jsx
//folder : student_list/[[student_details]]/page.js  
// 1. hit : domain.com/student_list/sajid  2. hit domain.com/student_list - its working
export default function Student({ params }) {
    console.warn(params.student) 
    return (
      <div>
        <h1>Hello, Student {params.student}</h1>
      </div>
    );
  }
```
- __Cache All Routes__ : Get The All Segment after route "student-list/student/2020/marksheet" after student we can get theall segement using create folder [...student] instead of [student]
```jsx
//folder : student_list/[...student]/page.js & its explode by "/"
"use client"
export default function Student({ params }) {
    console.warn(params.student) // use this params and fetch data from database then display the data...
    return (
      <div>
        <h1>Hello, Student Year {params.student[0]} & CBSE {params.student[1]}</h1>
      </div>
    );
  }
```
- __Route Group__ : remove specific path from url , 
```jsx
//folder : (student)/rahul/page.js & (student)/krishan/page.js
"use client"
export default function Rahul() {
    return (
      <div>
        <h1>Hello, Rahul Year</h1>
      </div>
    );
  }
  /// now you hit like domain.com/rahul or domain.com/krishan
```

- __Parallel Routes__ : Parallel Routing allows you to simultaneously or conditionally render one or more pages or component in the same layout
  ```jsx
    // colorbox/@left/page.js & colorbox/@right/page.js
    // colorbox/layout.js
    export default function ColorBoxLayout({children, left, right}){
      const isSidebar = false;
      return (
        <section>
          {children} // ifyou hide this, it will empty displayed
          {isSidebar ? left : right} // you can also display only left or right
        </section>
      )
    }
    // colorbox/page.js
    export default function colorBox(){
      return <><h1> Colorbox layout left and right </h1></>
    }
  ```


### Custom Routes
  - <a href="https://github.com/vercel/next.js/discussions/9081">check </a>

### Link & Navigation 
```jsx
import Link from "next/link"
import { useRouter } from "next/navigation"; // in client component
export default function Menu(){
    const router = useRouter();
    const goToContact = ()=>{
        router.push("/contact")
    }
    const id = 2; // dynamic ...
    return (
        <>
        <Link href="/">Home <br /></Link>
        <Link href="/about">About<br /></Link>
        <Link href="/contact">Contact<br /></Link>
        <Link href={`/blog/${id}`}>Blog Page<br /></Link>
        <button onClick={goToContact}>Click To Contact</button> 
        </>
    )
}
```
## Layout
- __Common Layout__
  - its get the all component/routes code as children/props (any name)
  - if you dont create layout.js file in inside of folder , it will take as default layout in from root app or src
  ```jsx
  export const metadata = {
    title: 'Create Next App',
    description: 'Generated by create next app',
  }
  export default function RootLayout({ children }) {
    return (
      <html lang="en">
        <body >{children}</body>
      </html>
    )
  }
  ```
- __Admin Layout__
```jsx
    // admin/header/page.js & admin/footer/page.js
    // admin/layout.js
    //import header & footer in layout.js
    export default function AdminLayout({children}){
      return (
        <section>
          <Header />
          {children} // if you hide this, it will empty displayed
          <Footer />
        </section>
      )
    }
    // colorbox/page.js
    export default function colorBox(){
      return <><h1> Colorbox layout left and right </h1></>
    }
  ```

## 404 Page
- For Global Used 404 Page create not-found.js file in src or app directory: 
```jsx
// name spell must be same : not-found.js 
export default function NotFound(){
    return(
        <>
        <h1> 404 Not Found</h1>
        </>
    )
}
```
-- For Specific Admin or other sub folder page  create 
```jsx
// folder structure : admin/[...not-found]/page.js
export default function NotFound(){
    return(
        <>
        <h1> Admin Page Not Found</h1>
        </>
    )
}
```

## Private Folder
- Private folders can be created by prefixing a folder with an underscore: *_folderName* & This is  indicates the folder should not be considered by the routing system
- Import Alias @
```json
//jsconfig.json
{
  "compilerOptions": {
    "baseUrl": "src/",
    "paths": {
      "@/styles/*": ["styles/*"],
      "@/components/*": ["components/*"]
    }
  }
}
```
```jsx
// pages/index.js
import Button from '@/components/button'
import '@/styles/styles.css'
import Helper from 'utils/helper'
 
export default function HomePage() {
  return (
    <Helper>
      <h1>Hello World</h1>
      <Button />
    </Helper>
  )
}
``` 
## Component type
- __Client component__
  - You can use event, use hook, use state and interactive userterface
  - __console_log()__ function work in browser console
  - To Make Client Side Render , you can use "use client" keyword in the top of component file
  - Example of Client Side Rendering & function
  ```jsx
  'use client'
  export default function Api() {
    const noti= (hello) =>{
      alert(`Hello ${hello}`);
    }
    return (
      <>
      <Menu></Menu>
        <button onClick={()=>{noti("About Me")}}> click me</button>
      </>
    );
  }
  ```
- __Server component__
  - You can not use event, use hook, use state and interactive userterface
  - you can just render the data
  - __console_log()__ function work will not in browser console & it will show in terminal 
  - by default all server sider component  
  - Ex. Server Side Rendering
  ```jsx 
    async function getData() {
    const res = await fetch('https://dummyjson.com/products/1')
    if (!res.ok) {
      throw new Error('Failed to fetch data')
    }
    return res.json()
  }
  export default async function Page() {
    const data = await getData()
    console.warn(data);
    return (
      <h1> {data.title}</h1>
    )
  }```

- __Use Server & Clinet Component together__ 
  - create external client component with top line "user client" and import to server component, it will work!
- Fore more information <a href="https://nextjs.org/docs/app/building-your-application/rendering/composition-patterns"> click here </a>

## CSS
- __moudle css__  specific css code for componnent & useful when project to big
```css
// file : mycss.module.css
.main {
    color:red;
}
#title {
  color:blue;
}
```
```css
// file : custom.module.css
.main {
    color:green;
}
#title {
  color:yellow;
}

.extract_class {
  color:orange;
}
```
```jsx
import mycss from './mycss.module.css'
import custom from './custom.module.css'
export default function Home() {
  const {extract_class} = custom;
  return (
    <>
      <h3 id={mycss.title}></h3>
      <h1 class={mycss.main}> Home Page</h1>

      <h3 id={custom.title}></h3>
      <h1 class={custom.main}> Home Page</h1>
      <h5 className={extract_class}><h5>
    </>
  );
}
```
- globals.css is for all component , you can simply import from './globals.css' in [layout.js root] folder & and use the css code
- inline css : 
```jsx
const divStyle = {
    backgroundColor: 'lightblue',
    color: 'black',
    padding: '10px',
  };

  return (
    <div style={divStyle}>
      <p>This is a paragraph with inline styles.</p>
    </div>
  );
```

## SEO 
### Optimzing
- __Images__ : you can use quality, blur etc with next/image ,, <a href="https://nextjs.org/docs/app/building-your-application/optimizing/images"> click here for learn more </a>

```jsx
'use client'
import Image from 'next/image'
import Profile from "../../public/images/me.jpg"

export default function Page() {
  return (
    <>

      <h3>Local Image With Next JS Image Component</h3>      
      <Image src={Profile}  /> <br /> 

      <h3>Other Domain With Next JS Image Component & its required config in next.config.js file </h3>      
      <Image src="https://img.freepik.com/free-vector/cute-boy-standing-position-showing-thumb_96037-450.jpg" width={200} height={200} /> <br />

      <h3>Local Image with default html img tag </h3>      
      <img src={Profile.src} />

      <h3>Domain Image with default html img tag </h3>      
      <img src="https://img.freepik.com/free-vector/cute-boy-standing-position-showing-thumb_96037-450.jpg"></img>

    </>
  )
}
```

```js
//file: next.config.js
 module.exports = {
  images: {
    remotePatterns: [
      {
        protocol: 'https',
        hostname: 'img.freepik.com',
        port: '',
        pathname: '/**',
      },
    ],
  },
}
```



### MetaData
- static metadata
```jsx
import { Metadata } from 'next'
export const metadata: Metadata = {
  title: '...',
  description: '...',
}
export default function Page() {}
```
- dynamic metadata you can use funtion of next js  generateMetaTag({title:"", description:""})

### Static Assets
- you can put your all assets like css, js image, sitemap robotsx.txt file in the public folder then you can simply use them in your project via next js __<Image> Component__ or __<img>__ , __<Script> Component__ or <script> tag etc.
```jsx
import Image from 'next/image'
export function Avatar() {
  return <Image src="@public/me.png" alt="me" width="64" height="64" />
}
```




### Redirecting...
- Component
```jsx
import { redirect } from "next/navigation"
export default function Page() {
  let isLogin = false;
  if(!isLogin){
      redirect("/"); // if user not logged, redirect to home page
  }
  return (
    <>
      <h1> User Page </h1>
    </>
  )
}
```
- if page does or removed paged then redirect all traffic from remvoed page to next page 
```js
// file : next.config.js
 module.exports = {
  redirects:async()=>{
    return [
      {
        source:"/user",
        destination:"/",
        permanent:false 
      }
      
    ]
  }
}
//  Wildcard, path matching For here : https://nextjs.org/docs/app/api-reference/next-config-js/redirects
```

## External Library2
### Google Font
- Go to <a href="https://fonts.google.com/"> click here </a>, get the font link add in root layout.js file
- CSS Variable & Normal Apply & NEXT JS Feature Font Exmaple : 
```jsx
// file : page.js
'use client'
import { Hind_Siliguri } from "next/font/google"
const hind_font = Hind_Siliguri({
  weight: '500',
  subsets: ['latin'],
  display: 'swap',
})
 
export default function Page() {
  return (
    <>

      <h3>Without google font </h3>      
      <h3 className="site-font">Google Hind Font </h3>      
      <h3 className={hind_font.className}>Next JS Feature Hind Fonts </h3>
      <h4 className="lilita-one">Google Lilita Font</h4>

      <h4 className="site-font-var">Google Hind Font with css variable</h4>
      <h4 className="lilita-one-font-var">Google Lilita Font cSS variable </h4>
    </>
  )
}
```
```jsx
// file : layout.js
import { Hind_Siliguri, Lilita_One } from 'next/font/google'
import  './globals.css';
export const metadata = {
  title: 'PHP Master .com',
  description: 'Generated by create next app',
}
const hind_font = Hind_Siliguri({
  subsets: ['latin'],
  variable: '--hind-font', // variable for use in css code 
  display: 'swap',
  weight:"500"
})
 
const lilita_One = Lilita_One({
  subsets: ['latin'],
  variable: '--lilita-font', // variable for use in css code 
  display: 'swap',
  weight:"400"
})
export default function RootLayout({ children }) {
  return (
    <html lang="en" className={`${hind_font.variable} ${lilita_One.variable}`}>
      <head>
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@600&display=swap" rel="stylesheet" />
      </head>
      <body >{children}</body>
    </html>
  )
}

```
```css
// glboal.css : you can use here body & html for apply in root of project  
.site-font {
    font-family: 'Hind Siliguri', sans-serif;
}
.lilita-one{
    font-family: 'Lilita One', cursive;
}

.site-font-var {
    font-family: var(--hind-font);
}
.lilita-one-var{
    font-family: var(--lilita-font);
}
h1 {
    color:blue;
}
```

## Script 
-  commponent of next js that can apply current component js code
```jsx
import Script from 'next/script'
export default function DashboardLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <>
      <section>{children}</section>
      <Script src="https://example.com/script.js" />
    </>
  )
}
```

### Pure HTML Code Generator
- with next js you can generate the pure html code 
```js
//file : next.config.js
 module.exports = {
  output:"export"
}
```
- After above configuration in next.config.js file, simply you can genereate the static html code page :)
- run command : npm run build ; see the output in __out__ folder


## Envrionment Variable
- you can access env variable anywhere in next js component without import anything
- may be env variable like your system envrionment variable
```js
// Fixed file Name : .env.local
API_KEY = "1212SDKLAJLKSXMK327"
```
```jsx
export default function Page() {
  return (
    <>
      <h1> Home Page </h1>
      <h5>Your API Key : {process.env.API_KEY}</h5>
    </>
  )
}
// you can see all env variable which is in your system just put : console.log(process.env)
```

## Rendering HTML Text Content
i. dangerouslySetInnerHTML
```jsx
	<div className={'blog-body mt-10'} dangerouslySetInnerHTML={{ __html: post.body }}  />
```

## Data Fetching
- You can Make GET, POST, DELETE  AND UPDATE
- __Server Component__
  ```jsx
    async function getData(praam) {
    const res = await fetch('https://api.example.com/...')

    if (!res.ok) {
      throw new Error('Failed to fetch data')
    }
  
    return res.json()
  }
  
  export default async function Page() {
    const data = await getData()
    return <main></main>
  }
  ```
- __Dynamic Fetching__
```jsx
    async function getData(id) {
    const res = await fetch('https://api.example.com/...'+id)

    if (!res.ok) {
      throw new Error('Failed to fetch data')
    }
  
    return res.json()
  }
  
  export default async function Page({param}) {
    const data = await getData(param.id)
    return <main></main>
  }
  ```

## Nextjs API
- you can create api in next js & connect database using npm package of mysqli, mongo etc
- create you new folder __"api"_ inside of src directory
- They are server-side only bundles and won't increase your client-side bundle size.
- routing like folder directory and filenmae will route.jsx instead of page.js
- all api write in folder __src/api/*__
- you can create api in next ,, then use that api to perform the action CRUD operation through fetch() Js method

### Create __GET__  Request
```jsx
// src/api/product/route.jsx
import { NextResponse } from 'next/server'
export async function GET(req) {
  // get the data from database &  send data with get request

  console.log(req); // view the all request headers...
  const requestHeaders = new Headers(req.headers);
  
  // URL Query Params domain.com/?name=sajid
  const {searchParams} = new URL({req.url}); // {"name":"sajid"}
  const name = searchParams.get('name');

  // cookies
  const cook1 = req.cookies; // cookies() or  return array information..
  
  return NextResponse.json({ message: 'Hello from Next.js!' })
}
```
### Create __POST__ Request
```jsx
// src/api/product/route.jsx
import { NextResponse } from 'next/server'
export async function POST(req) {
  // get the post request and perform the action like crud or response the data msg

  console.log(req); // view the all request headers...
  const requestHeaders = new Headers(req.headers);
  
  // URL Query Params domain.com/?name=sajid
  const {searchParams} = new URL({req.url}); // {"name":"sajid"}
  const name = searchParams.get('name');

  // cookies
  const cook1 = req.cookies; // cookies() or  return array information..

  // get Body Request
  const res = await req.json() 
  const formData = await req.formData()
  console.log(formData.get("key_name"));
  
  return NextResponse.json({ message: 'Hello from Next.js!' },{status:200});
}
```
### __Dynamic Request URL__
```jsx
// src/api/product/[id]/route.jsx
import { NextResponse } from 'next/server'
export default async function GET(req, context) {
  // get the dynamic request id & fetch in database &  response status
  
  // get the id 
  console.log(context); // {params{id:'2'}}
  console.log(context.params.id); // 2

  const requestHeaders = new Headers(req.headers);
  
  return NextResponse.json({ message: 'Hello from Next.js!' })
}
// OR
export default async function GET(req, {params}) {
  console.log(params.id); 
  const requestHeaders = new Headers(req.headers);
  
  return NextResponse.json({ message: 'Hello from Next.js!' })
}
```
- We can create more like DELETE, UPDATE etc reqeust... like that above...

- __Security__
  - create own api : bought api for get the original server data
  - then make request to created own api ,,, now i have hide the original api url & key secrete etc...


## CRUD Operation
  - there is two way 
    - i. create api in next js with npm db library & use that api in next js application using the fetch() method
    - ii. install the mysql/mongoDB etc library with npm & use in directly in next js application like php language
  - you can create crud operation in next js without using the external programming backend language
  - you are doing the job like __full stack developer :)__
  
## Middleware : will run each of http request
- middleware will run before request complete ...
- use for protect the page like admin dashboard can not access without valid login token
Example One:
```jsx
//src/middleware.js : filename must be same
import { NextResponse } from 'next/server'
 
export function middleware(request) {
  var isLogged = false; // if false redirect to admin login page
  if(!isLogged){
    return NextResponse.redirect(new URL('/admin', request.url))   
  }
}

export const config = {
  matcher: ['/admin/dashboard', '/admin/profile'] // /admin/:path* match all  admin inside the path
}
```
Example Two : different route name and response folder name different , in this case : 
```jsx
import { NextResponse } from 'next/server'

export function middleware(request) {
  if (request.nextUrl.pathname.startsWith('/admin')) {
    return NextResponse.rewrite(new URL('/admin-construct', request.url))
  }
}
```

Example Three : You Can get incoming Cookies & set , delete etc.
```jsx
import { NextResponse } from 'next/server'

export function middleware(request) {
  // Assume a "Cookie:nextjs=fast" header to be present on the incoming request
  // Getting cookies from the request using the `RequestCookies` API
  let cookie = request.cookies.get('nextjs')
  console.log(cookie) // => { name: 'nextjs', value: 'fast', Path: '/' }
  const allCookies = request.cookies.getAll()
  console.log(allCookies) // => [{ name: 'nextjs', value: 'fast' }]
 
  request.cookies.has('nextjs') // => true
  request.cookies.delete('nextjs')
  request.cookies.has('nextjs') // => false
 
  // Setting cookies on the response using the `ResponseCookies` API
  const response = NextResponse.next()
  response.cookies.set('vercel', 'fast')
  response.cookies.set({
    name: 'vercel',
    value: 'fast',
    path: '/',
  })
  cookie = response.cookies.get('vercel')
  console.log(cookie) // => { name: 'vercel', value: 'fast', Path: '/' }
  // The outgoing response will have a `Set-Cookie:vercel=fast;path=/test` header.
 
  return response
}
``` 
Example Four : Procced the function if user authenticated
```jsx
import { NextResponse } from 'next/server'
import { isAuthenticated } from '@lib/auth' // your library determine user authentication or not
 
// Limit the middleware to paths starting with `/api/`
export const config = {
  matcher: '/api/:function*',
}
export function middleware(request) {
  // Call our authentication function to check the request
  if (!isAuthenticated(request)) {
    return new NextResponse(
      JSON.stringify({ success: false, message: 'authentication failed' }),
      { status: 401, headers: { 'content-type': 'application/json' } }
    )
  }
}
```

## Global State
### Zustand 
- Zustand is lightweight state management library for React/Nextjs
- Zustand **support persist data store**  with Middleware
- Zustand is alternative of Redux
- Zustand is client side **"use client"** is mandatory
```bash
npm install zustand
```
#### Example One : GlobalState Without Persist
```jsx
// useGlboalState.jsx
"use client";
import { create } from "zustand";
export const useGlobalState = create((set) => ({
  cartAddress: null,
  isLoggedIn: false,
  user: null,

  setCartAddress: (cartAddress) => set({ cartAddress }),
  clearCartAddress: () => set({ cartAddress: null }),

  setLoggedIn: (user) => set({ isLoggedIn: true, user }),
  clearAuth: () => set({ isLoggedIn: false, user: null }),
}));
```
- Usages Example : 
```jsx
//1.  AuthClass.jx : Not Never used this.state 
import { useGlobalState } from "@/store/useGlobalState";
class AuthClass {
	 logout() {
	  const state = useGlobalState.getState();
	  state.clearAuth(); / 
	  state.clearCartAddress();
	}
}

//2. ClientComponents.jsx : Bad Version
"use client";
import { useGlobalState } from "@/store/useGlobalState";
const state = useGlobalState();  // it will listen all state, performance issue
const checkout = () =>{
   state.setCartAddress({name:"Sajid", Pincode:110037})
   if(state.isLoggedIn){
		// Update UI
   }
}

//3. ClientComponents.jsx : Excellent Version
"use client";
import { useGlobalState } from "@/store/useGlobalState";
const { setCartAddress, isLoggedIn } = useGlobalState();
const checkout = () => {
  setCartAddress({ name: "Sajid", pincode: 110037 });
  if (isLoggedIn) {
    // Update UI
  }
};
```

### Example Two 


