<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Products;
use App\Model\Slider;
use App\Traits\traiList;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use traiList;
    private $category;
    private $product;
    public function __construct(Category $category, Products $product)
    {

        $this->category = $category;
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menu();
        return view('frontend.product.category.list', compact('sliders', 'menus'));
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
    public function show($slug, $id)
    {
        $menus = $this->menu();
        $categorys = $this->category();
        $products = $this->product->join('categories', function ($join) use ($id) {
            $join->on('products.category_id', '=', 'categories.id')
                ->where('categories.parent_id', '=', $id);
        })->select('products.id', 'products.name', 'products.price', 'products.feature_image_path', 'products.content', 'products.slug', 'products.deleted_at')
            ->get();

        return view('frontend.product.category.list', compact('categorys', 'products', 'menus'));
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