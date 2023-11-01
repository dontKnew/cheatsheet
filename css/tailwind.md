# Tailwinds
## Responsive Layout
    sm	640px	@media (min-width: 640px) { ... }
    md	768px	@media (min-width: 768px) { ... }
    lg	1024px	@media (min-width: 1024px) { ... }
    xl	1280px	@media (min-width: 1280px) { ... }
    2xl	1536px	@media (min-width: 1536px) { ... }
    - Example : <img class="w-16 md:w-32 lg:w-48" src="..." />
i. Columns 1 to 12 & columns-auto 
    - class 'break-after-column' => this is break the page or sheet after that column will not comes
```html
<div class="columns-2 md:columns-3 gap-8 ">
      <div class="w-100 bg-red-500 break-after-column">Red </div> 
      <div class="w-100 bg-red-500">Red </div>
      <div class="w-100  bg-red-500">Red </div>
      <div class="w-100  bg-red-500">Red </div>
      <div class="w-100  bg-red-500">Red </div>
      <div class="w-100  bg-red-500">Red </div>
  </div>
```
ii. GRID 
  - <div class="grid gap-4 grid-cols-3 grid-rows-3"></div>
  - grid has 12 columns
  - col-span-2 : get 2 cols 
  - col-start-2 : skip 1 col 
  - col-end-7 : get 6 columsn
  ```html
  <div class="grid gap-4 grid-cols-3 grid-rows-3">
      <div class="...">01</div>
      <div class="...">02</div>
      <div class="...">03</div>
      <div class="col-span-2 ...">04</div>
      <div class="...">05</div>
      <div class="...">06</div>
      <div class="col-span-2 ...">07</div>
  </div>
  ```
  - Ex : get the full columns <div class="grid grid-cols-6 gap-4"><div class="col-start-1 col-end-7 ...">04</div></div>
  - grid template rows : div will place row wise mean down way first 4 then 2nd column will take 5 row
  ```html
  <!-- output : https://tailwindcss.com/docs/grid-template-rows#basic-usage -->
  <div class="grid grid-rows-4 grid-flow-col gap-4">
    <div>01</div>
    <div>09</div>
  </div>
  ```
  - grid rows start/end like grid col ,, it will work as row wise mean down way  4 then up 5
  ```html
  <div class="grid grid-rows-3 grid-flow-col gap-4">
    <div class="row-span-3 ...">01</div>
    <div class="col-span-2 ...">02</div>
    <div class="row-span-2 col-span-2 ...">03</div>
  </div>
  ```
  - grid-flow-row-dense : output https://tailwindcss.com/docs/grid-auto-flow 
  ```html
  <div class="grid grid-flow-row-dense grid-cols-3 grid-rows-3 ...">
    <div class="col-span-2">01</div>
    <div class="col-span-2">02</div>
    <div>03</div>
    <div>04</div>
    <div>05</div>
  </div>
  ```
  - gap-1 like gap:1rem, gap-x-1 like column-gap:1rem, gap-y-1rem like row-gap:1rem
  
iii. contents
  - inside div of contents act like children of class "flex-container" like flex-1 div 04, div 01  
  ```html
  <div class="flex flex-container ...">
    <div class="flex-1 ...">01</div>
    <div class="contents">
      <div class="flex-1 ...">02</div>
      <div class="flex-1 ...">03</div>
    </div>
    <div class="flex-1 ...">04</div>
  </div
  ```

iv. alignements of div
 - justify-content : use with flex and grid which has class justify-between, justify-around, justify-streacth etc. https://tailwindcss.com/docs/justify-content
 
 - justify-items : grid items are aligned along their inline axis.
    Ex . justify-items-end, justify-items-start, justify-items-center, justify-items-stretch
  
  - justify self : individual grid item is aligned along its inline axis.
    Ex . justify-self-auto	, justify-self-start, justify-self-end, justify-self-center, justify-self-stretch

  - Align Content : how rows are positioned in multi-row flex and grid containers.
    Ex. 		content-center, content-start, content-end, content-between, content-around, content-evenly, content-stretch 
  
  - Align Items :  how flex and grid items are positioned along a container's cross
    Ex. 		items-start, items-end, items-center, items-baseline, items-stretach

  - Align Self : how an individual flex or grid item is positioned along its container's cross axis.
    Ex. self-start, self-end, self-center, self-stretch, self-baseline
   For More Alignements learn here... https://tailwindcss.com/docs/place-content


Quick reference
				
## Custom Style
  i. use default value in tailwind css class
  ```html
    :root{
      --my-color:green
    }
  <h1 class="bg-[--my-color]"> Hello </h1> 
  <div class="bg-[url('/what_a_rush.png')]">
  <div class="before:content-['hello\_world']">
  ```
  ii. box-border  : if you set box-border class thats mean a div width 100px and height 100px including padding and margin which you will set..  or thats opposite 'box-content'


## tailwind.config.js
i. To remove all browser default style like padding, margin, border etc use corePlugins.preflight = true
```js
// corePlugins.preflight:false
module.exports = {
  corePlugins: {
    preflight: false, 
  }
}
```
ii. add default container style 
  - theme.container.padding = '2rem', theme.container.margin = '2rem' etc.
  - add by responsive theme.container.padding.DEFAULT = '2rem', theme.container.padding.md = '3rem'
  - <div class="container bg-red-500 text-light ">...</div>


### TABLE 
- output like a table  elements...
```html

<div class="table w-full ...">
  <div class="table-header-group ...">
    <div class="table-row">
      <div class="table-cell text-left ...">Song</div>
      <div class="table-cell text-left ...">Artist</div>
      <div class="table-cell text-left ...">Year</div>
    </div>
  </div>
  <div class="table-row-group">
    <div class="table-row">
      <div class="table-cell ...">The Sliding Mr. Bones (Next Stop, Pottersville)</div>
      <div class="table-cell ...">Malcolm Lockyer</div>
      <div class="table-cell ...">1961</div>
    </div>
    <div class="table-row">
      <div class="table-cell ...">Witchy Woman</div>
      <div class="table-cell ...">The Eagles</div>
      <div class="table-cell ...">1972</div>
    </div>
    <div class="table-row">
      <div class="table-cell ...">Shining Star</div>
      <div class="table-cell ...">Earth, Wind, and Fire</div>
      <div class="table-cell ...">1975</div>
    </div>
  </div>
</div>
```

## Helper Classes
i. hidden : use for hide a elements
ii. float-right, float-none, float-left 
iii. clear-right, clear-left, clear-both, clear-none : useful for remove float interactive on elements , learn more https://tailwindcss.com/docs/clear
vi. object-fit, object-cover, object-none, object-scale-down
v. Object Position : usefull for images position ... learn more Object Position
vi. overflow-scroll, overlfow-visible, overflow-y-scroll etc. learn more https://tailwindcss.com/docs/overflow
vii. static, fixed, absolute, relative, sticky, right-0, top-0, left-0, bottom-0, for more .. https://tailwindcss.com/docs/top-right-bottom-left
viii.  visible, invisible, collapse 
ix. z-index=> z-0, z-10 to z-50 and z-auto 

x. margin, padding : px-20, py-20, p-20, pr-20, pl-20 
xi. spacing :  controlling the space between child elements.
  Ex. space-x-4, space-y-4 -> give space margin between the div container of child
xii. width, height max-width, max-height : w-20, h-20, max-w-20, max-h-20
xii. font family : font-sans, font-serif, font-mono etc..
xiii font-size : text-xs, text-sm, text-lg, text-xl, text-2xl, text-3xl, class="text-sm/[17px]
xiv.  contents : <a class="text-blue-600 after:content-['-'] ..."  or before..


## @apply 
```css
.btn {
  @apply text-base font-medium rounded-lg p-3;
}

.btn--primary {
  @apply bg-sky-500 text-white;
}

.btn--secondary {
  @apply bg-slate-100 text-slate-900;
}

```