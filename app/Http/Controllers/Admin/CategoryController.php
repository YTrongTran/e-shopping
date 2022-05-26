<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recursive;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Traits\traitUploadImage;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use traitUploadImage;
    private $category;
    private $html;

    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->html = '';
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
        $listCategory = $this->category->where('deleted_at', 0)->latest()->paginate(6);
        return view('admin.category.list', compact('key', 'title', 'listCategory'));
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
        $categorySelect = $this->getRecursive($parentId = '');
        return view('admin.category.add', compact('key', 'title', 'categorySelect'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = $this->category->create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
        ]);
        Toastr::success('Bạn đã thêm thành công: ' . $category->name);
        return redirect('admin/category/index');
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
        $category = $this->category->findOrFail($id);
        $categorySelect = $this->getRecursive($category->parent_id);
        return view('admin.category.edit', compact('key', 'title', 'categorySelect', 'category'));
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
        $category = $this->category->find($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'updated_at' => Carbon::now()
        ]);
        $category = $this->category->find($id);
        Toastr::success('Bạn đã cập nhật thành công: ' . $category->name);
        return redirect('admin/category/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleted('category', $id);
        return redirect('admin/category/index');
    }
    public function getRecursive($parentId)
    {
        $data =  $this->category->where('deleted_at', 0)->get();
        $categoryRecursive = new Recursive($data);
        $htmlselect = $categoryRecursive->setRecursive($parentId);
        return  $htmlselect;
    }
}