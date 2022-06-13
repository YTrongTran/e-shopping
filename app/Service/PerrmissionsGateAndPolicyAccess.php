<?php

namespace App\Service;

use Illuminate\Support\Facades\Gate;

class PerrmissionsGateAndPolicyAccess
{


    public function setDefineGateAndPolicyAccess()
    {
        $this->defineCountryPolicies();
        $this->defineBlogPolicies();
        $this->defineCategoryPolicies();
        $this->defineMenuPolicies();
        $this->defineProductPolicies();
        $this->defineSliderPolicies();
        $this->defineSettingPolicies();
        $this->defineBrandPolicies();


        $this->defineUserPolicies();
        $this->defineRolePolicies();
        $this->definePermissionPolicies();
    }

    public function defineCountryPolicies()
    {
        Gate::define('country-list', 'App\Policies\CountryPolicy@view');
        Gate::define('country-add', 'App\Policies\CountryPolicy@create');
        Gate::define('country-edit', 'App\Policies\CountryPolicy@update');
        Gate::define('country-delete', 'App\Policies\CountryPolicy@delete');
    }

    public function defineBlogPolicies()
    {
        Gate::define('blog-list', 'App\Policies\BlogPolicy@view');
        Gate::define('blog-add', 'App\Policies\BlogPolicy@create');
        Gate::define('blog-edit', 'App\Policies\BlogPolicy@update');
        Gate::define('blog-delete', 'App\Policies\BlogPolicy@delete');
    }

    public function defineCategoryPolicies()
    {
        Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
    }
    public function defineMenuPolicies()
    {
        Gate::define('menu-list', 'App\Policies\MenuPolicy@view');
        Gate::define('menu-add', 'App\Policies\MenuPolicy@create');
        Gate::define('menu-edit', 'App\Policies\MenuPolicy@update');
        Gate::define('menu-delete', 'App\Policies\MenuPolicy@delete');
    }

    public function defineProductPolicies()
    {
        Gate::define('product-list', 'App\Policies\ProductPolicy@view');
        Gate::define('product-add', 'App\Policies\ProductPolicy@create');
        Gate::define('product-edit', 'App\Policies\ProductPolicy@update');
        Gate::define('product-delete', 'App\Policies\ProductPolicy@delete');
    }
    public function defineSliderPolicies()
    {
        Gate::define('slider-list', 'App\Policies\SliderPolicy@view');
        Gate::define('slider-add', 'App\Policies\SliderPolicy@create');
        Gate::define('slider-edit', 'App\Policies\SliderPolicy@update');
        Gate::define('slider-delete', 'App\Policies\SliderPolicy@delete');
    }
    public function defineSettingPolicies()
    {
        Gate::define('setting-list', 'App\Policies\SettingPolicy@view');
        Gate::define('setting-add', 'App\Policies\SettingPolicy@create');
        Gate::define('setting-edit', 'App\Policies\SettingPolicy@update');
        Gate::define('setting-delete', 'App\Policies\SettingPolicy@delete');
    }
    public function defineBrandPolicies()
    {
        Gate::define('brand-list', 'App\Policies\Brand@view');
        Gate::define('brand-add', 'App\Policies\Brand@create');
        Gate::define('brand-edit', 'App\Policies\Brand@update');
        Gate::define('brand-delete', 'App\Policies\Brand@delete');
    }



    public function defineUserPolicies()
    {
        Gate::define('user-list', 'App\Policies\UserPolicy@view');
        Gate::define('user-add', 'App\Policies\UserPolicy@create');
        Gate::define('user-edit', 'App\Policies\UserPolicy@update');
        Gate::define('user-delete', 'App\Policies\UserPolicy@delete');
    }
    public function defineRolePolicies()
    {
        Gate::define('role-list', 'App\Policies\RolePolicy@view');
        Gate::define('role-add', 'App\Policies\RolePolicy@create');
        Gate::define('role-edit', 'App\Policies\RolePolicy@update');
        Gate::define('role-delete', 'App\Policies\RolePolicy@delete');
    }
    public function definePermissionPolicies()
    {
        Gate::define('permission-list', 'App\Policies\PermissionPolicy@view');
        Gate::define('permission-add', 'App\Policies\PermissionPolicy@create');
        Gate::define('permission-edit', 'App\Policies\PermissionPolicy@update');
        Gate::define('permission-delete', 'App\Policies\PermissionPolicy@delete');
    }
}