<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Model\Blog;
use App\Model\Category;
use App\Model\Menu;
use App\Model\Products;
use App\Model\Setting;
use App\Model\Slider;
use App\Traits\traiList;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use traiList;
    private $product;
    private $slider;
    private $category;
    private $menu;
    private $blog;

    public function __construct(Products $product, Slider $slider, Category $category, Menu $menu, Blog $blog)
    {
        $this->product = $product;
        $this->slider = $slider;
        $this->category = $category;
        $this->menu = $menu;
        $this->blog = $blog;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menu();
        $sliders = $this->slider();
        $categorys = $this->category();
        $products = $this->product->where(['status' => 0, 'deleted_at' => 0])->latest()->take(6)->get();

        return view('frontend.home', compact('products', 'sliders', 'categorys', 'menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}