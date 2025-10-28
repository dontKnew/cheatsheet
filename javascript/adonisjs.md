# Adonisjs

## Installation 
- WebStarterKit :  npm init adonisjs@latest -- -K=web 
- WebStarterKit+Myssql :  npm init adonisjs@latest -- -K=web --db=mysql
- VS Code Syntax Highliter : Edge templates syntax highlighter
- npm run dev : it will start your server

## Basic 
- Config File
-import config from '@adonisjs/core/services/config'
```
config.get('app.appKey')
config.get('app.http.cookie')
```
- In Edge Tempalte Views
```
@if(config.has('app.appUrl'))
  <a href="{{ config('app.appUrl') }}"> Home </a>
@else
  <a href="/"> Home </a>
@end
```
- Change config at runtime
```
import env from '#start/env'
import config from '@adonisjs/core/services/config'

const HOST = env.get('HOST')
const PORT = env.get('PORT')

config.set('app.appUrl', `http://${HOST}:${PORT}`)
```
- Read Env Variable : 
```
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
```
#file : start/view.ts
import env from '#start/env'
import edge from 'edge.js'
edge.global('env', env)
```





