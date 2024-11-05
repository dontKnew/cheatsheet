## Botble CMS Docs : https://docs.botble.com/
## ADD SEO META & PARAM LINKS  https://docs.botble.com/cms/slug-field.html
```
//src/Providers/BlogServiceProvider in boot function

SeoHelper::registerModule([Post::class, Category::class, Tag::class]);
SlugHelper::registerModule(Post::class, 'Blog Posts');
```
    