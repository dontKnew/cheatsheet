## ADD SEO META & PARAM LINKS 
```
//src/Providers/BlogServiceProvider in boot function

SeoHelper::registerModule([Post::class, Category::class, Tag::class]);
SlugHelper::registerModule(Post::class, 'Blog Posts');
```
    
