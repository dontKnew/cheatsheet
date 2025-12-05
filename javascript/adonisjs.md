# Adonisjs V6

## Table of Contents
1. [Installation](#installation)
2. [Basic](#basic)
3. [Routing](#routing)
4. [Debugging](#debugging)
5. [GlobalHelper](#global-helper)
6. [Edge Template Engine](#edge-template-engine)

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
- @pushTo : it will push multiple times, with different js if you wrote, it usesfull for that!
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
@@pushTo('js')
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
v. Components  : re-usable code
- no support, css, js : check it..
- Filename to tagName conversion
```ts
form/input.edge : 	@form.input
tool_tip.edge :	@toolTip
checkout_form/input.edge :	@checkoutForm.input
modal/index.edge :	@modal
```
```ts
//file: components/button.edge
<button type="{{ type || 'submit' }}"> {{ text }} </button>

// use it anywhere in edge file :
<form>
  @!component('components/button', { text: 'Login' })
  @!component('components/button', { text: 'Cancel', type: 'reset' })
</form>

// output :
<form>
  <button type="submit"> Login </button>
  <button type="reset"> Cancel </button>
</form>
```
vi. Slots
- slots use with components, for render title data
```ts
// main slot : use for render the rest of data in specific area in components or inlucde
// file : card.edge
<div {{ attributes }}>
  <div class="card_header">
    {{ title }}
  </div>

  <div class="card_contents">
    {{{ await $slots.main() }}}
  </div>
</div>

// using the card components
@card({ title: 'Quick start' })
  <p> Start building your next project in minutes </p>
@end

// output:
<div>
  <div class="card_header">
    Quick start
  </div>
  <div class="card_contents">
    <p> Start building your next project in minutes </p>
  </div>
</div>
```
- using slot another way without main
```ts
// file : card.edge
<div>
  <div class="card_header">
    {{{ await $slots.header() }}}
  </div>
  <div class="card_contents">
    {{{ await $slots.content() }}}
  </div>
</div>

// file : using the card components
@card()
  @slot('header')
    <strong> Quick start </strong>
  @end  
  @slot('content')
    <p> I am a card </p>
  @end
@end
```
vii. Layout

# Test Run
- create test inside the test folder..
- node ace test : run all test
- node ace test --folderName 
