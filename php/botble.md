## Botble CMS Docs : https://docs.botble.com/

## Topic for Botble  --
### Plugin Development
    0. Plugin Structure : [https://docs.botble.com/cms/plugin-structure.html]
    1. Plugin Creation
    2. Event Listener 
    3. Table Data Modification
    4. Form Creation
    5. Sitemap modification
    6. CRUD Generator
    7. Serial Number in Table
    8. Vue.js (Used)
    9. Display Plugin Data in Front Views [https://www.youtube.com/watch?v=5PC6mzssZ70]
    10. SEO Helper [https://www.youtube.com/watch?v=S0tlbt0K44c]
### Theme Development
    1. Add Shortcode in Views or Specific Page
    2. Shortcode Creation
    3. 
## END Topic for Botble  --
    
    
     - 
## ADD SEO META & PARAM LINKS  https://docs.botble.com/cms/slug-field.html
```php
//src/Providers/BlogServiceProvider in boot function
SeoHelper::registerModule([Post::class, Category::class, Tag::class]);
SlugHelper::registerModule(Post::class, 'Blog Posts');
```
## Sitemap Generator or Add Sitemap        
- Register Keys in src/[Name]ServiceProvider
- Create Siteamp Rendering Listener
- Generate Pages Urls & Generate New Sitemap  
```php
// src/Listeners
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
// src/Providers/[Name]ServiceProvider
public function boot(){
        $this->app['events']->listen(ThemeRoutingBeforeEvent::class, function () {
            $categories = (new ServiceCategory())->orderByRaw('sorting IS NULL, sorting ASC')->get();
            foreach($categories as $category){
                SiteMapManager::registerKey([
                    $category->url,
                ]);
            }
        });
}

// src/HookServiceProvider
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
```php
$theme->composer(['index', 'page', 'post'], function(View $view) {
        $view->withShortcodes();
    });
```

## New Crud Operation
```
php artisan cms:plugin:make:curd plugin_name curd_name
```

## Form Builder
```php
// Learn More Resouces : https://docs.botble.com/cms/form-builder-input-fields.html
//Select Builder
->add('csc', 'customSelect', [
            'label' => "CSC Type",
            'required' => true,
            'choices' => [
                 null => 'Select CSC Type',
                'country' => 'Country',
                'state' => 'State',
                'city' => 'City',
            ]
        ]
    )
// onOff Builder
->add('generate_pages', 'onOff', [
        'label' => "Want to Generate Pages ?",
        'required' => true,
        'selected' => 0,
    ])
```
## Serial Number Add in Table
```php
FormattedColumn::make('id')
    ->title('S.No.')
    ->getValueUsing(function (Column $column) {
        $index = request()->get('start', 0) + $this->tableIndex;
        $this->tableIndex++;
        return '<span class="badge text-dark">'.number_format($index).'</span>';
    }),
```
