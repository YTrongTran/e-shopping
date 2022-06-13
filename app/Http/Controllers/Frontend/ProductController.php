<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Products;
use App\Traits\traiList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use traiList;
    private $product;
    public function __construct(Products $product)
    {
        // $this->category = $category;
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
        $categorys = $this->category();
        $brands = $this->brand();
        $products = $this->product->where(['status' => 0, 'deleted_at' => 0])->latest()->paginate(6);
        return view('frontend.product.list', compact('products', 'categorys', 'menus', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {
        $productId = $this->product->findOrFail($id);
        $categorys = $this->category();
        $related_products =  $this->product->where('products.category_id', $productId->category_id)->whereNotIn('products.id', [$id])->get();

        return view('frontend.product.list-details', compact('categorys', 'productId', 'related_products'));
    }
    public function search(Request $request)
    {
        $menus = $this->menu();
        $categorys = $this->category();
        $brands = $this->brand();


        if ($request->name == "" && $request->price == "" && $request->category == "" && $request->brand == "" && $request->sale == "") {
            $products = $this->product->where('deleted_at', 0)->latest()->paginate(10);
        } else {
            if ($request->price != "") {
                $arrayPrice = explode('-', $request->price);
                $priceCurrent = current($arrayPrice);
                $priceEnd = end($arrayPrice);
                $products = $this->product->where('deleted_at', 0)->whereBetween('price', [(int) $priceCurrent, (int) $priceEnd])->latest()->paginate(10);
            } elseif ($request->name != "") {
                $name = $request->name;
                $products = $this->product->where('deleted_at', 0)->where('name', 'like', '%' . $name . '%')->latest()->paginate(10);
            } elseif ($request->category != "") {
                $category = $request->category;
                $products = $this->product->join('categories', 'categories.id', '=', 'products.category_id')->where([
                    'products.deleted_at' => 0,
                    'products.category_id' => $category
                ])->select('products.*')->latest()->paginate(10);
            } elseif ($request->brand != "") {
                $brand = $request->brand;
                $products = $this->product->join('brands', 'brands.id', '=', 'products.brand_id')->where([
                    'products.deleted_at' => 0,
                    'products.brand_id' => $brand
                ])->select('products.*')->latest()->paginate(10);
            } elseif ($request->sale != "") {
                $sale = $request->sale;
                if ($sale == 0) {
                    $products = $this->product->where([
                        'deleted_at' => 0,
                        'sale' => $sale
                    ])->select('products.*')->latest()->paginate(10);
                } else {
                    $products = $this->product->where('deleted_at', 0)->where('sale', '>', $sale)->select('products.*')->latest()->paginate(10);
                }
            }
        }

        return view('frontend.product.list', compact('products', 'categorys', 'menus', 'brands'));
    }
}