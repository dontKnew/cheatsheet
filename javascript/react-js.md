### React-Js ^18.2.0

1. Requirements for setup in laptop/computer 
- install node js for window <a href="https://nodejs.org/dist/v18.16.1/node-v18.16.1-x64.msi"> click here </a>
- run command in terminal ```npx create-react-app projectName```
- go to project run cmd ```npm start```
- Now you successfully run react js project
- React application in a web browser. By default, it runs on http://localhost:3000.
- check this project for practically : <a href="https://github.com/dontKnew/react-toutrial">Toutrial Project</a> & <a href="https://www.w3schools.com/react/"> Online Learn & Test</a>

2. Hooks
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
    - its runs each time when component is __mounted__(inserted into the DOM, the component is said to be mounted & remove then its said unmounted component) and __re-render__ 
    - when useState change : then useEffect called  in same
    ```jsx 
    import React, { useState, useEffect } from 'react';

    export const Example = ()=>{
        const [data, setData] = useState([]);
        const [useEffectData, setUseEffectData] = useState();

        // Example 1- It runs each time when component is mounted and re-render
        useEffect(() => {
            console.log("useEffect Called");
        })

        // Example 2- It runs once when the component is mounted ([] means no dependencies)
        useEffect(() => {
            console.log("useEffect Called");
        })

        
    // Example 3 - It runs when the component is mounted and whenever dependence changes.
    useEffect(() => {
        console.log("useEffect Called");
    }, [useEffectData])

        
    // Example 4 - The cleanup function (the function you return from useEffect) runs when the component unmounts or when the dependencies in the dependency array change. Since count is in the dependency array, whenever count changes, the cleanup function is called before the new effect runs.
    useEffect(() => {
        console.log("useEffect Called");
        return () => {
        console.log("Component will unmount !!");
        }
    }, [])
        return (
            <h1>hello use effect </h1>
        );
    }
    ```
- useMemo : this is like useEffect, but its store in cache & get the result from cache
    ```jsx 
    import {useMemo, useState} from 'react';
    export const App = ()=> {
        const [count, setCount] = useState(0)
        const handleIncreaseCount = () => {
            console.log("Increase Count Function");
            setCount(count + 1)
        }
        // Ex 1. : call the useMemo when specific state change..
        const isCountTen = useMemo(() => {
            console.log("isCountTen Called");
            if (count === 10) {
                return "Yes"
                }
            return "No"
        }, [count]) // define useState
        return (
            <h1>is {count} equal to 10 ? --- {isCountTen}</h1>
            <button onClick={handleIncreaseCount}>Increase Count</button>
            );
    }
    ```
- useMemo : this is like useEffect, but its store in cache & get the result from cache in second time
    ```jsx 
    import {useMemo, useState} from 'react';
    export const App = ()=> {
        const [count, setCount] = useState(0)
        const handleIncreaseCount = () => {
            console.log("Increase Count Function");
            setCount(count + 1)
        }
        // Ex 1. : call the useMemo when specific state change..
        const isCountTen = useMemo(() => {
            console.log("isCountTen Called");
            if (count === 10) {
                return "Yes"
                }
            return "No"
        }, [count]) // define useState
        return (
            <h1>is {count} equal to 10 ? --- {isCountTen}</h1>
            <button onClick={handleIncreaseCount}>Increase Count</button>
            );
    }
    ```
- useCallback : this is similer to useMemo 
    - The React useCallback Hook returns a memoized callback function & useMemo is  memoized value .
    -  useCallback is to prevent a component from re-rendering unless its props have changed.      
    ```jsx
    //App.jsx
    import React, { useState, useCallback } from "react";
    import Name from "./Name";

    const App = () => {
    const [inputValue, setInputValue] = useState("");
    const [name, setName] = useState("");

    // Define a memoized callback function using useCallback
    const handleInputChange = useCallback((e) => {
        setInputValue(e.target.value);
    }, []); // Empty dependency array means the function will not be recreated unless a dependency changes

    const handleButtonClick = useCallback(() => {
        setName(inputValue);
    }, [inputValue]); // Include inputValue as a dependency since the function depends on it

    console.log("parent render");
    return (
        <div>
        <h1>Parent Component</h1>
        <label>
            Enter Name:{" "}
            <input type="text" value={inputValue} onChange={handleInputChange} />
        </label>
        <button onClick={handleButtonClick}>Set Name</button>
        <Name name={name} />
        </div>
    );
    };

    export default App;
    
    //Name.jsx
    import { memo } from "react";
    const Name = ({ name }) => {
    console.log("child render");
    return (
        <>
        <h2>My Name</h2>
            {name}
        </>
    );
    };
    export default memo(Name);
    ```  
- Custom Hooks: When you have component logic that needs to be used by multiple components
    - Custom Hooks start with __"use"__. Example: useFetch.
    - for better use.. create folder "hook" name and write all hooks in there folder..
    ```jsx
    //Example One : https://www.w3schools.com/react/react_customhooks.asp
    //useFetch.js
    import { useState, useEffect } from "react";
    const useFetch = (url) => {
    const [data, setData] = useState(null);

    useEffect(() => {
        fetch(url)
        .then((res) => res.json())
        .then((data) => setData(data));
    }, [url]);

    return [data];
    };

    export default useFetch;

    //use of created hook App.jsx
    import useFetch from "./useFetch";
    const Home = () => {
    const [data] = useFetch("https://jsonplaceholder.typicode.com/todos");

    return (
        <>
        {data &&
            data.map((item) => {
            return <p key={item.id}>{item.title}</p>;
            })}
        </>
    );
    };

    // Example Two :
    // useCustomCounter.jsx 
    import { useState } from 'react'
        export const useCustomCounter = () => {
        const [count, setCount] = useState(0)
        const handleIncrement = () => {
            setCount(count + 1)
        }
        return {
            count, handleIncrement
        }
    }
    // App.jsx
    import { useCustomCounter } from "useCustomCounter"
    export const LearnCustomHook = () => {
    const { count, handleIncrement } = useCustomCounter()
    return (
        <>
        <h1>Count: {count}</h1>
        <button onClick={handleIncrement}>Inc</button>
        </>
    )
    }
    ```

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
3. Props : sharing data in between component you can pass __data to child components__ using props, allowing them to __render dynamic content__ based on the values provided and you can pass also array object any data type __parent to child data pass__

    ```jsx
    import React from 'react';
    // function Greeting({name, name2}) {...} 
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
3. Life State Up : pass data from __child to parent__
    - you need to use event... 
    ```jsx
    // LiftingStateUp.jsx (child component)
    export const LiftingStateUp = (props) => {
        const handleClick = (e) => {
            e.preventDefault()
            let dt = "I am from Child Data"
            props.myClick(dt)
        }
        return (
            <>
            <button onClick={handleClick}>Click 1</button>
            </>
        )
    }

    //ParentLiftingStateUp.jsx
        export const ParentLiftingStateUp = (props) => {
            const getData = (data) => {
                console.log(`this is data from child component ${data}`);
            }
        return (
            <>
                  <LearnLiftingStateUp myClick={getData} />
            </>
        )
    }
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

10. CSS <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/next-js.md#11-css">click here </a>
11. Images 
    ```jsx
    import Pic from '/images/pic.png'  /* public/images/pic.png - folder of react js*/
    import SupaPic from '../assets/images/supapic.png' /* src/assets/images/supaic.png */
    export const LearnUseOfImage = () => {
    return (
        <>
        <h1>Images</h1>
        <img src={Pic} alt="" width="400px" />
        <br />
        <img src={SupaPic} alt="" width="300px" />
        </>
    )
    }
    ```
12. Form 
    ```jsx
    import { useState } from "react"
    export const LearnForm = () => {
    const [firstName, setFirstName] = useState('')
    const [lastName, setLastName] = useState('')
    const handleFirstName = (e) => {
        setFirstName(e.target.value)
    }
    const handleLastName = (e) => {
        setLastName(e.target.value)
    }

    // const [formData, setFormData] = useState({
    //   firstName: '',
    //   lastName: '',
    // })
    // const handleChange = (e) => {
    //   setFormData({ ...formData, [e.target.name]: e.target.value })
    // }

    // Handle Form on Submit
    // const handleFormSubmit = (e) => {
    //   e.preventDefault()
    //   console.log("Submit Button Clicked", formData);
    // }
    return (
        <>
        {/* Handle element one by one */}
        <form action="">
            First Name: <input type="text" name="firstName" value={firstName} onChange={handleFirstName} /> <br /><br />
            Last Name: <input type="text" name="lastName" value={lastName} onChange={handleLastName} /> <br /><br />
        </form>

        {/* Handle all elements at once */}
        {/* <form action="" onSubmit={handleFormSubmit}>
            First Name: <input type="text" name="firstName" value={formData.firstName} onChange={handleChange} /> <br /><br />
            Last Name: <input type="text" name="lastName" value={formData.lastName} onChange={handleChange} /> <br /><br />
            <button type="submit">Submit</button>
        </form> */}
        </>
    )
    }
    ```
13. envrionment variable for <a href="https://github.com/dontKnew/cheatsheet/blob/master/javascript/next-js.md#14-envrionment-variable"> click here </a>

14. Library for react js 
    - material ui (https://mui.com/material-ui/ & material ui can learn from geeky shows)
    - form library (https://react-hook-form.com/)
    - redux toolkit (learn from geeky shows, its old but, no updating verion yet..)
    - react router v6 watch from geekyshows...
    

