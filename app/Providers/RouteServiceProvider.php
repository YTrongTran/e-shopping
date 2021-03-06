<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        //admin
        $this->mapWebRoutes();
        $this->mapAdminUserRoutes();
        $this->mapAdminCountryRoutes();
        $this->mapAdminBlogRoutes();
        $this->mapAdminCategoryRoutes();
        $this->mapAdminProductsRoutes();
        $this->mapAdminRoleRoutes();
        $this->mapAdminPermissionRoutes();
        $this->mapAdminMenuRoutes();
        $this->mapAdminSliderRoutes();
        $this->mapAdminSettingRoutes();
        $this->mapAdminBrandRoutes();
        $this->mapAdminManagerOrderRoutes();

        //frontend
        $this->mapCategoryRoutes();
        $this->mapProductRoutes();
        $this->mapBlogRoutes();
        $this->mapLoginRoutes();
        $this->mapMemberRoutes();
        $this->mapCartRoutes();
        $this->mapCheckoutRoutes();

        //ajax
        $this->mapAjaxRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
    protected function mapAdminUserRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/user/user.php'));
    }
    protected function mapAdminCountryRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/country/country.php'));
    }
    protected function mapAdminBlogRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/blog/blog.php'));
    }
    protected function mapAdminCategoryRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/category/category.php'));
    }
    protected function mapAdminProductsRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/product/product.php'));
    }

    protected function mapAdminRoleRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/role/role.php'));
    }
    protected function mapAdminPermissionRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/permission/permission.php'));
    }
    protected function mapAdminMenuRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/menu/menu.php'));
    }
    protected function mapAdminSliderRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/slider/slider.php'));
    }
    protected function mapAdminSettingRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/brand/brand.php'));
    }
    protected function mapAdminBrandRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/setting/setting.php'));
    }
    protected function mapAdminManagerOrderRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/manager_order/manager_order.php'));
    }



    //frontend
    protected function mapCategoryRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend/category.php'));
    }
    protected function mapProductRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend/products.php'));
    }
    protected function mapBlogRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend/blog.php'));
    }
    protected function mapLoginRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend/login.php'));
    }
    protected function mapMemberRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend/member.php'));
    }
    protected function mapCartRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend/cart.php'));
    }
    protected function mapCheckoutRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend/checkout.php'));
    }

    //ajax
    protected function mapAjaxRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend/ajax.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}