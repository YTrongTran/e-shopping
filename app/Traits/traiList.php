<?php

namespace App\Traits;

use App\Model\Category;
use App\Model\Menu;
use App\Model\Slider;

trait traiList
{

    public function menu()
    {
        return  $menus = Menu::where([
            'parent_id' => 0,
            'deleted_at' => 0
        ])->get();
    }

    public function slider()
    {
        return $sliders = Slider::where([
            'status' => 0,
            'deleted_at' => 0
        ])->latest()->get();
    }
    public function category()
    {
        return $categorys = Category::where([
            'parent_id' => 0,
            'deleted_at' => 0
        ])->latest()->get();
    }
}