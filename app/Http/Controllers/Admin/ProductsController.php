<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recursive;
use App\Http\Controllers\Controller;
use App\Model\Brands;
use App\Model\Category;
use App\Model\Products;
use App\Model\Products_Image;
use App\Model\Tags;
use App\Traits\traitUploadImage;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    use traitUploadImage;
    private $product;
    private $tag;
    private $brand;
    private $categorys;
    private $product_image;
    public function __construct(Products $product, Category $categorys, Products_Image $product_image, Tags $tag, Brands $brand)
    {
        $this->product = $product;
        $this->tag = $tag;
        $this->brand = $brand;
        $this->categorys = $categorys;
        $this->product_image = $product_image;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Home';
        $key = 'List';
        $listProducts = $this->product->where('deleted_at', 0)->latest()->paginate(6);
        return view('admin.product.list', compact('title', 'key', 'listProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Home';
        $key = 'Add';
        $categorys = $this->getCategory($parentId = '');
        $brands = $this->brand->where('deleted_at', 0)->get();
        return view('admin.product.add', compact('title', 'key', 'categorys', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->sale == 0) {
            $sale = $request->sale;
        } else {
            $sale = trim($request->number_sale);
        }

        $product = $this->product->create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'sale' => $sale,
            'brand_id' => $request->brand_id,
        ]);
        //x??? l?? ???nh ?????i di???n
        $product = $this->product->find($product->id);
        $image_array = $this->uploadAvatarBlog($request, 'feature_image', 'products', Auth::user()->id, $product->id);
        if (!empty($image_array)) {
            $product->update([
                'feature_image_name' => $image_array['avatar_name'],
                'feature_image_path' => $image_array['avatar_path']
            ]);
        }
        // x??? l?? ???nh chi ti???t
        if ($request->hasFile('image_array')) {
            if (count($request->image_array) <= 3) {
                foreach ($request->image_array as $item) {
                    $namImage = $item->getclientOriginalName();
                    $extenImage = $item->getclientOriginalExtension();
                    $imageArray = $this->uploadAvatarArray($item, $namImage, $extenImage, 'productdetails', Auth::user()->id, $product->id);
                    if (!empty($imageArray)) {
                        $product_image =  $this->product_image->create([
                            'image_name' => $imageArray['avatar_name'],
                            'image_path' => $imageArray['avatar_path'],
                            'product_id' => $product->id
                        ]);
                    }
                }
            } else {
                Toastr::warning('Vui l??ng ch?? ?? ???nh ch??? ch???n ???????c 3 ???nh tr??? xu???ng !!!');
            }
        }

        //th??m tags
        $tagsArray = $request->tags_array;
        if (!empty($tagsArray)) {
            foreach ($tagsArray as $tag) {
                $tags = $this->tag->firstOrCreate([
                    'name' => $tag
                ]);
                $tagId[] =  $tags->id;
            }

            $product->tags()->attach($tagId);
        }

        Toastr::success('B???n ???? th??m s???n ph???m th??nh c??ng !!!');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Home';
        $key = 'Edit';
        $product = $this->product->findOrFail($id);
        $categorys = $this->getCategory($product->category_id);
        $brands = $this->brand->where('deleted_at', 0)->get();
        return view('admin.product.edit', compact('title', 'key', 'categorys', 'product', 'brands'));
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
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $product = $this->product->find($id);

        if ($request->sale == 0) {
            $sale = $request->sale;
        } else {
            $sale = trim($request->number_sale);
        }

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'sale' => $sale,
            'brand_id' => $request->brand_id,
            'updated_at' => Carbon::now()
        ];
        //x??? l?? ???nh ?????i di???n
        $image_array = $this->uploadAvatarBlog($request, 'feature_image', 'products', Auth::user()->id, $product->id);
        if (!empty($image_array)) {

            $data['feature_image_name']  = $image_array['avatar_name'];
            $data['feature_image_path']  = $image_array['avatar_path'];
            unlink($product->feature_image_path);
        }
        $product->update($data);
        // x??? l?? ???nh chi ti???t
        if ($request->hasFile('image_array')) {
            if (count($request->image_array) <= 3) {
                $array1 = $this->product_image->where('product_id', $id)->get();
                foreach ($array1 as $key) {
                    unlink($key['image_path']);
                }

                $this->product_image->where('product_id', $id)->delete();

                foreach ($request->image_array as $item) {
                    $namImage = $item->getclientOriginalName();
                    $extenImage = $item->getclientOriginalExtension();
                    $imageArray = $this->uploadAvatarArray($item, $namImage, $extenImage, 'productdetails', Auth::user()->id, $product->id);

                    if (!empty($imageArray)) {
                        $product->product()->updateOrCreate([
                            'image_name' => $imageArray['avatar_name'],
                            'image_path' => $imageArray['avatar_path']
                        ]);
                    }
                }
            } else {
                Toastr::warning('Vui l??ng ch?? ?? ???nh ch??? ch???n ???????c 3 ???nh tr??? xu???ng !!!');
            }
        }


        //th??m tags
        $tagsArray = $request->tags_array;
        if (!empty($tagsArray)) {
            foreach ($tagsArray as $tag) {
                $tags = $this->tag->firstOrCreate([
                    'name' => $tag
                ]);
                $tagId[] =  $tags->id;
            }
            $product->tags()->sync($tagId);
        }

        Toastr::success('B???n ???? c???p nh???t s???n ph???m th??nh c??ng !!!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleted('product', $id);
        return redirect()->route('product.index');
    }
    public function getCategory($parentId)
    {
        $dataCategorys = $this->categorys->where('deleted_at', 0)->get();
        $object = new Recursive($dataCategorys);
        $data = $object->setRecursive($parentId);
        return $data;
    }
}