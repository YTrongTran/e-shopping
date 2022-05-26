<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recursive;
use App\Http\Controllers\Controller;
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
    private $categorys;
    private $product_image;
    public function __construct(Products $product, Category $categorys, Products_Image $product_image, Tags $tag)
    {
        $this->product = $product;
        $this->tag = $tag;
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
        return view('admin.product.add', compact('title', 'key', 'categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = $this->product->create([
            'name' => $request->name,
            'price' => $request->price,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->name)
        ]);
        //xử lý ảnh đại diện
        $product = $this->product->find($product->id);
        $image_array = $this->uploadAvatarBlog($request, 'feature_image', 'products', Auth::user()->id, $product->id);
        if (!empty($image_array)) {
            $product->update([
                'feature_image_name' => $image_array['avatar_name'],
                'feature_image_path' => $image_array['avatar_path']
            ]);
        }
        // xử lý ảnh chi tiết
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
                Toastr::warning('Vui lòng chú ý ảnh chỉ chọn được 3 ảnh trở xuống !!!');
            }
        }

        //thêm tags
        $tagsArray = $request->tags_array;

        foreach ($tagsArray as $tag) {
            $tags = $this->tag->firstOrCreate([
                'name' => $tag
            ]);
            $tagId[] =  $tags->id;
        }

        $product->tags()->attach($tagId);

        Toastr::success('Bạn đã thêm sản phẩm thành công !!!');
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

        return view('admin.product.edit', compact('title', 'key', 'categorys', 'product'));
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
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->name),
            'updated_at' => Carbon::now()
        ];
        //xử lý ảnh đại diện
        $image_array = $this->uploadAvatarBlog($request, 'feature_image', 'products', Auth::user()->id, $product->id);
        if (!empty($image_array)) {

            $data['feature_image_name']  = $image_array['avatar_name'];
            $data['feature_image_path']  = $image_array['avatar_path'];
            unlink($product->feature_image_path);
        }
        $product->update($data);
        // xử lý ảnh chi tiết
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
                Toastr::warning('Vui lòng chú ý ảnh chỉ chọn được 3 ảnh trở xuống !!!');
            }
        }


        //thêm tags
        $tagsArray = $request->tags_array;
        foreach ($tagsArray as $tag) {
            $tags = $this->tag->firstOrCreate([
                'name' => $tag
            ]);
            $tagId[] =  $tags->id;
        }

        $product->tags()->sync($tagId);

        Toastr::success('Bạn đã cập nhật sản phẩm thành công !!!');
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