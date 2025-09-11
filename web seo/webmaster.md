# Website SEO & Performance Tips

## Google Search Console Question and Answer
### Crawled - currently not indexed
Google will Not Re-Crawled in future and never indexing, because of 
  - **Low Quality of content**
  - **NoIndexing Tag**
  - **Page Performance**
  - **Low CTR**
  - **High Bounce Rates**

### Discovered – currently not indexed
The page was found by google, thats not crawled yet, Typeically sitemap submission after discover the pages
  - **Low Crawl Budget** : Google prioritizes important pages and may delay crawling others, especially on large websites with many URLs
  - **Server Overload** : While crawling if server was busy, Google will skip thats page url
  - **Similer Page or Duplicate Content**
  - **Low Quality Contents**
  - **Page Recently Added**

## Lighthouse Issue Solution
### Avoid an excessive DOM size
  1. Total DOM Elements Issue 
    - Total DOM Elements SHould be less than 1500
    - Dom elements like div, span, input and all type of tags
    - Count Total DOM Elements - Open Browser Console & hit document.getElementsByTagName('*').length
  2. Max Child Elements Issue
     - Each Parent can contain 60 childs, else error
     - Ex .  <u><li> </li><li></li>... 60 </ul>
  3. Max DOM Depth
     - Browser Engine Allow Elements Nested Deeply 16, for better performance
     ```
    <html> <!-- Depth 1 -->
    <body> <!-- Depth 2 -->
      <div> <!-- Depth 3 -->
        <section> <!-- Depth 4 -->
          <div> <!-- Depth 5 -->
            <form> <!-- Depth 6 -->
              <div> <!-- Depth 7 -->
                <div> <!-- Depth 8 -->
                  <input> <!-- Depth 9 -->
     ```
     - In this example, the <input> field is at depth level 9 thats fine, and allow us 16 safe limit

  
