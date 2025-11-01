# Adonisjs V6

## Installation 
- WebStarterKit :  npm init adonisjs@latest -- -K=web 
- WebStarterKit+Myssql :  npm init adonisjs@latest  -- -K=web --db=mysql
- VS Code Syntax Highliter : Edge templates syntax highlighter
- npm run dev : it will start your server


## Basic 
- Config File
-import config from '@adonisjs/core/services/config'
```ts
config.get('app.appKey')
config.get('app.http.cookie')
```
- In Edge Tempalte Views
```ts
@if(config.has('app.appUrl'))
  <a href="{{ config('app.appUrl') }}"> Home </a>
@else
  <a href="/"> Home </a>
@end
```
- Change config at runtime
```ts
import env from '#start/env'
import config from '@adonisjs/core/services/config'

const HOST = env.get('HOST')
const PORT = env.get('PORT')

config.set('app.appUrl', `http://${HOST}:${PORT}`)
```
- Read Env Variable : 
```ts
1. process.env.NODE_ENV
Or 
2. --
import env from '#start/env'
env.get('NODE_ENV')
env.get('HOST')
env.get('PORT')

// Returns 3333 when PORT is undefined
env.get('PORT', 3333)
```
- Share Env Varible in Edge/Html View
```ts
#file : start/view.ts
import env from '#start/env'
import edge from 'edge.js'
edge.global('env', env)
```

## Routing 
```ts
import router from '@adonisjs/core/services/router'

router.get('/', () => {
  return 'Hello world from the home page.'
})
router.get('/posts/:id', ({ params }) => {
  return `This is post with id ${params.id}`
})
// optional paramsmeter
router.get('/posts/:id?', ({ params }) => { 
  return `This is post with id ${params.id}`
})


// wildcard or Any :  
router.get('/docs/:category/*', ({ params }) => {
  console.log(params.category)
  console.log(params['*'])
})
// path : /docs/api/sql/orm   : api is cateogry  & patterns ['sql', 'orm']
// path2 : /docs/http/context   : http is cateogry  & patterns ['context']

```
## Debugging
- use dd() function anywhere in code except views/edge file
- @dd() , you can use in views/edge file,   

## Views/Edge
- Components like cell in ci4
- slots use with components, for render titel data

## Global Helper 
### import use in middleware/controller etc.
### For Resources/View Files Edges
```ts
//1. Make file : start/edge.ts
import edge from 'edge.js'
import env from '#start/env'
edge.global('base_url', env.get('APP_URL'))

// 2. register helper : start/kerne.ts
//at the bottom or top, dos not matter
import './edge.js'
```

## Edge Template Engine
i. include
```ts
@include('partials/some-file')
@includeIf(post.comments.length, 'partials/comments')
```
ii. Inline String
```ts
Hello
@let(username = 'virk')~
 {{ username }}
// output
Hello virk
```
iii. comments : {{-- Your Code that not display in browser --}}
iv. stacks : use to push content from components 
- @pushOnceTo: mean that it will not render again if you use it two or more times in different components..
```ts
// Main app.edge
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @stack('js')
  </head>
  <body>
    <main>
      @!dialog()
    </main>
  </body>
</html>
// compontents/modal.edge
<dialog x-data="alpineModal">
</dialog>
@pushOnceTo('js')
  <script>
    Alpine.data('alpineModal', function () {
      return {
        show() {},
        hide() {},
      }
    })
  </script>
@end

// Output :
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script>
      Alpine.data('alpineModal', function () {
        return {
          show() {},
          hide() {},
        }
      })
    </script>
  </head>
  <body>
    <main>
      <dialog x-data="alpineModal">
      </dialog>
    </main>
  </body>
</html>
```



