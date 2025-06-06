Sure! Here's a concise **Express.js Cheatsheet** in Markdown format (`expressjs.md`) for quick reference:

````markdown
# Express.js Cheatsheet

---

## Setup & Basics

```js
const express = require('express');
const app = express();
const PORT = 3000;

app.listen(PORT, () => {
  console.log(`Server running at http://localhost:${PORT}`);
});
````

---

## Routing

### Simple Route

```js
app.get('/', (req, res) => {
  res.send('Hello World');
});
```

### Route with Params

```js
app.get('/user/:id', (req, res) => {
  const userId = req.params.id;
  res.send(`User ID: ${userId}`);
});
```

### Query Params

```js
app.get('/search', (req, res) => {
  const term = req.query.term;
  res.send(`Searching for: ${term}`);
});
```

### All HTTP Methods for a route

```js
app.route('/book')
  .get((req, res) => res.send('Get a book'))
  .post((req, res) => res.send('Add a book'))
  .put((req, res) => res.send('Update a book'));
```

### Catch-All Route

```js
app.get('*', (req, res) => {
  res.status(404).send('Page not found');
});
```

---

## Middleware

### Built-in Middleware

```js
app.use(express.json()); // Parse JSON bodies
app.use(express.urlencoded({ extended: true })); // Parse URL-encoded bodies
app.use(express.static('public')); // Serve static files
```

### Custom Middleware

```js
app.use((req, res, next) => {
  console.log(`${req.method} ${req.url}`);
  next(); // Call next middleware/route handler
});
```

---

## Template Engines (EJS example)

### Setup EJS

```js
app.set('view engine', 'ejs');
app.set('views', './views');
```

### Render a view with data

```js
app.get('/', (req, res) => {
  res.render('index', { name: 'Sajid' });
});
```

### In `views/index.ejs`

```html
<h1>Hello, <%= name %>!</h1>
```

---

## Handling POST Data

```js
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.post('/submit', (req, res) => {
  const data = req.body;
  res.send(`Received data: ${JSON.stringify(data)}`);
});
```

---

## Sending Responses

```js
res.send('text');
res.json({ key: 'value' });
res.status(404).send('Not found');
res.redirect('/home');
```

---

## Route Parameters & Query

```js
app.get('/users/:id', (req, res) => {
  console.log(req.params.id); // route param
  console.log(req.query.page); // query string param
});
```

---

## Error Handling Middleware

```js
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).send('Something broke!');
});
```

---

## Serving Static Files

```js
app.use(express.static('public'));
```

---

## Environment Variables

```js
require('dotenv').config();
console.log(process.env.MY_SECRET);
```

---

## Example: Full Basic Server

```js
const express = require('express');
const app = express();

app.use(express.json());

app.get('/', (req, res) => res.send('Hello Express!'));

app.listen(3000, () => console.log('Server running on port 3000'));
```

---

## Useful Packages

* `cors` — Enable Cross-Origin Resource Sharing
* `morgan` — HTTP request logger
* `helmet` — Security headers
* `express-validator` — Validation and sanitization

---

# End of Cheatsheet

```

---

If you want, I can generate a downloadable `.md` file for you!
```
