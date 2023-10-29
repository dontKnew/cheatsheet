### React JS Toutrial
1. Requirements for setup in laptop/computer 
- install node js for window <a href="https://nodejs.org/dist/v18.16.1/node-v18.16.1-x64.msi"> click here </a>
- run command in terminal ```npx create-react-app projectName```
- go to project run cmd ```npm start```
- Now you successfully run react js project
- React application in a web browser. By default, it runs on http://localhost:3000.

2. Hook
- useState : its return current update value example below : 
    ```jsx
    import React, { useState } from 'react';

    function Counter() {
    const [count, setCount] = useState(0); // setCount for update the value and count for get the current value

    const increment = () => {
        setCount(count + 1);
        // setCount for update the value
    };

    return (
        {/*when click button, it return current states updated vlaue :)*/}
        <div>
        <p>Count: {count}</p> 
        {/*count for get the current value*/}
        <button onClick={increment}>Increment</button> 
        </div>
    );
    }
    ```

- useEffect : used to perform __side effects__ in functional components. Side effects refer to any code that interacts with the outside world, such as fetching data from an API, subscribing to events, manipulating the DOM, or setting up timers. __and__ It is similar to the __lifecycle methods__ in class components.
    ```jsx 
    import React, { useState, useEffect } from 'react';

    function Example() {
    const [data, setData] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
        try {
            const response = await fetch('https://api.example.com/data');
            const jsonData = await response.json();
            setData(jsonData);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
        };

        fetchData();
    }, []); //// The empty dependency array ensures that this effect runs only once, on component mount

    return (
        <div>
        <h1>Data:</h1>
        <ul>
            {data.map(item => (
            <li key={item.id}>{item.name}</li>
            ))}
        </ul>
        </div>
    );
    }
    export default Example;
    ```
    - Its usefull for side effect function mean it will run on side way and when data fetched then its return data & display in browser
3. Routes : 
- To use react router in react application you need to install the react router library using the command ```npm install react-router-dom``` in root project folder of react application
    ```jsx 
    import React from 'react';
    import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
    import Home from './Home';
    import About from './About';
    import NotFound from './NotFound';

    function App() {
    return (
        <Router>
        <Switch>
        {/*The exact prop ensures that the / route is only matched exactly.*/}
            <Route exact path="/" element={Home} />
            <Route path="/about" element={About} />
            <Route element={NotFound} />
        </Switch>
        </Router>
    );
    }
    export default App;
    ```
- Navigation to Link  ```import { Link } from 'react-router-dom' ``` and used  ```<Link to="/">Home</Link>```

- Dynamic Routes define routes.js file  ``` <Route path="/user/:username" element={{UserHome}}>
    ```jsx
    import React from 'react';
    import { useParams } from 'react-router-dom';

    function UserProfile() {
    const { username } = useParams();
    return (
        <div>
        <h1>User Profile</h1>
        <p>Username: {username}</p>
        </div>
    );
    }

    export default UserProfile;
    ```
- Redirect to routes 
    - ``` import { useHistory } from 'react-router-dom' ``` & in inside component function based on the condition if login fail redirect to home page```history.push('/homeRouteName')```
    -  ``` import { Redirect } from 'react-router-dom'``` & in component function 
        ```jsx
        import React from 'react';
        import { Redirect } from 'react-router-dom';

        function Login() {
        const loginSuccessful = /* Your login logic to determine success or failure */;

        if (loginSuccessful) {
            // Redirect to a different route if login is successful
            return <Redirect to="/dashboard" />;
        } else {
            // Redirect to home page if login fails
            return <Redirect to="/" />;
        }
        }
        export default Login;
    ```
3. Props : sharing data in between component you can pass __data to child components__ using props, allowing them to __render dynamic content__ based on the values provided and you can pass also array object any data type

    ```jsx
    import React from 'react';

    function Greeting(props) {
    return <h1>Hello, {props.name}!</h1>;
    }

    function App() {
    return (
        <div>
        <Greeting name="Alice" />
        <Greeting name="Bob" />
        <Greeting name="Charlie" />
        </div>
    );
    }
    export default App;
    ```
4. Handling Event
    ```jsx
    import React, { useState } from 'react';

    function FormExample() {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log('Form submitted:', name, email);
        // Perform further actions with the form data
    };

    return (
        <form onSubmit={handleSubmit}>
        <label>
            Name:
            <input
            type="text"
            value={name}
            onChange={(e) => setName(e.target.value)}
            />
        </label>
        <br />
        <label>
            Email:
            <input
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            />
        </label>
        <br />
        <button type="submit">Submit</button>
        </form>
    );
    }
    export default FormExample;
    ```
5. Conditional Rendering : 
    - if Statement
    ```jsx
    import React from 'react';

    function IfExample({ condition }) {
        if (condition) {
            return <h1>Condition is true</h1>;
        } else {
            return <h1>Condition is false</h1>;
        }
    }
    export default IfExample;
    ```
    - Ternary operator:
    ```jsx
    import React from 'react';

    function TernaryExample({ isLoggedIn }) {
        return (
            <div>
            {isLoggedIn ? (
                <h1>Welcome, User!</h1>
            ) : (
                <button>Login</button>
            )}
            </div>
        );
    }
    export default TernaryExample;
    ```
    - etc.

6. List & Keys : render lists of items in React and the importance of using unique keys for efficient rendering and proper reconciliation. Understand how to map over arrays to dynamically generate components.
    ```jsx
    import React from 'react';

    function ListExample({ items }) {
        {/*you need to pass every unique list of array with key id key={item.id} */} 
        return (
            <ul>
            {items.map((item) => (
                <li key={item.id}>{item.name}</li>
            ))}
            </ul>
        );
    }

    function App() {
        const items = [
            { id: 1, name: 'Item 1' },
            { id: 2, name: 'Item 2' },
            { id: 3, name: 'Item 3' },
        ];

        return (
            <div>
            <h1>List Example</h1>
            <ListExample items={items} />
            </div>
        );
    }
    export default App;
    ```
7. SSR With PHP
- define as well same meta tag and title information in react js app using react-helmet library :)
```php
    <?php
    $routes = $_SERVER['REQUEST_URI'];
    switch($routes){
        case '/':
            $title = "Home Page - Server";
            $keywords = "Home Page Keywords - Server";
            $description = "Home page Description - Server";
            break;
        case '/contact':
            $title = "Contact Page - Server";
            $keywords = "Contact Page Keywords - Server";
            $description = "Contact page Description - Server";
            break;

        case '/about':
                $title = "About Page - Server";
                $keywords = "About Page Keywords - Server";
                $description = "About page Description - Server";
                break;
        case '/api':
            $title = "Api Page - Server";
            $keywords = "Api Page Keywords - Server";
            $description = "Api page Description - Server";
            break;
        default :
            $title  = "404 Erorr - Server";
            $keywords = "Page Not Found, Error - Server";
            $description = "Page Not Found Description - Server";
            break;
    }
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" href="" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <meta name="theme-color" content="#000000" />
        <meta name="keywords" content="<?=$keywords?>" />
        <meta name="description" content="<?=$description?>" />
        <link rel="apple-touch-icon" href="/logo192.png" />
        <title><?=$title?></title>
        <script defer="defer" src="/static/js/main.cace2cfd.js"></script>
        <link href="/static/css/main.0ba73d62.css" rel="stylesheet">
    </head>

    <body><noscript>You need to enable JavaScript to run this app.</noscript>
        <div id="root"></div>
    </body>

    </html>  
```
8. Used FontAwesome 
    - install package ```npm install @fortawesome/fontawesome-svg-core @fortawesome/free-solid-svg-icons @fortawesome/react-fontawesome ```
    ```jsx
    import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
    import { faUser, faEnvelope } from '@fortawesome/free-solid-svg-icons';

    function MyComponent() {
        return (
            <div>
            <FontAwesomeIcon icon={faUser} className="user-icon" style={{ color: 'blue' }} />
            <FontAwesomeIcon icon={faEnvelope} style={{ fontSize: '1.5rem' }} />
            </div>
        );
    }
    ```
9. Used Bootstrap
- install ```npm i bootstrap@5.3.0```  & import to file where you want to use 
```import "bootstrap/dist/css/bootstrap.min.css"; import "bootstrap/dist/js/bootstrap.min.js";```
- Used Boostrap Component & make sure you have added in app.js or index.js ```import 'bootstrap/dist/css/bootstrap.min.css';`
    ```jsx
    import React from 'react';
    import { Button } from 'react-bootstrap';

    function MyComponent() {
    return (
        <div>
        <Button variant="primary">Primary Button</Button>
        <Button variant="secondary">Secondary Button</Button>
        </div>
    );
    }

    export default MyComponent;
- __Note__ : You can use like this above method to used npm js library 

    ```