## Botble CMS Docs : https://docs.botble.com/
## ADD SEO META & PARAM LINKS  https://docs.botble.com/cms/slug-field.html
```
//src/Providers/BlogServiceProvider in boot function

SeoHelper::registerModule([Post::class, Category::class, Tag::class]);
SlugHelper::registerModule(Post::class, 'Blog Posts');
```
## Sitemap Generator or Add Sitemap        
        1. Register Keys in src/[Name]ServiceProvider
        2. Create Siteamp Rendering Listener
        3. Generate Pages Urls & Generate New Sitemap  
```
## src/Listeners
<?php
namespace Botble\Portfolio\Listeners;

use Botble\Portfolio\Models\Pages;
use Botble\Portfolio\Models\Service;
use Botble\Portfolio\Models\ServiceCategory;
use Botble\Portfolio\Services\HelperService;
use Botble\Theme\Events\RenderingSiteMapEvent;
use Botble\Theme\Facades\SiteMapManager;

class RenderingSiteMapListener
{
    public function handle(RenderingSiteMapEvent $event): void
    {
        $sitemap  = new SiteMapManager();
        $categories = (new ServiceCategory())->orderByRaw('sorting IS NULL, sorting ASC')->get();
        foreach($categories as $category){
                if($category->url==$event->key){
                    $services = (new Service())->where('category_id', $category->id)->get();   
                    foreach ($services as $service) {
                        $pages = Pages::where('service_id', $service->id)
                                ->with(['state' => function ($query) {
                                    $query->orderBy('order', 'desc'); // Sort states when eager loading
                                }])
                                ->get();
                        foreach ($pages as $page) {
                            if(($page->page_url == (new HelperService)->homePageRoute())){
                                continue;
                            }
                            $sitemap::add(url($page->page_url), $page->created_at, "0.8", 'monthly');
                        }
                    }
            }
            $sitemap::addSitemap(url($category->url).".xml", $category->updated_at); 
        }

        if("pages"==$event->key){
            $sitemap::add(url((new HelperService)->homePageRoute()), date('Y-m-d H:m'), "1.0", 'daily');
        }
    }
}
## src/Providers/[Name]ServiceProvider
public function boot(){
// sitemap 
        $this->app['events']->listen(ThemeRoutingBeforeEvent::class, function () {
            $categories = (new ServiceCategory())->orderByRaw('sorting IS NULL, sorting ASC')->get();
            foreach($categories as $category){
                SiteMapManager::registerKey([
                    $category->url,
                ]);
            }
        });
}

## src/HookServiceProvider
namespace Botble\Portfolio\Providers;
use Botble\Theme\Events\RenderingSiteMapEvent;
use Botble\Portfolio\Listeners\RenderingSiteMapListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        RenderingSiteMapEvent::class => [
            RenderingSiteMapListener::class,
        ],
    ];
    
}

```

## add shortcode in new theme/config.php 
```
$theme->composer(['index', 'page', 'post'], function(View $view) {
        $view->withShortcodes();
    });
```

## New Crud Operation
        php artisan cms:plugin:make:curd plugin_name curd_name

## Botble Plugin Structure 
        - Providers/
