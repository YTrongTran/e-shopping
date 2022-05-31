<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recursive;
use App\Http\Controllers\Controller;
use App\Model\Menu;
use App\Traits\traitUploadImage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    use traitUploadImage;
    private $menu;
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
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
        $menus = $this->menu->where('deleted_at', 0)->latest()->paginate(10);
        return view('admin.menu.list', compact('title', 'key', 'menus'));
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
        $selectedMenu  = $this->getMenu($parentId = '');
        return view('admin.menu.add', compact('title', 'key', 'selectedMenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = $this->menu->create([
            'name' => ucfirst($request->name),
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
        ]);
        Toastr::success('Bạn đã thêm thành công !!!');
        return redirect()->route('menu.index');
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
        $menu = $this->menu->findOrFail($id);
        $selectedMenu  = $this->getMenu($menu->parent_id);
        return view('admin.menu.edit', compact('title', 'key', 'menu', 'selectedMenu'));
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
        $menu = $this->menu->find($id);
        $menu->update([
            'name' => ucfirst($request->name),
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
        ]);
        Toastr::success('Bạn đã cập nhật thành công !!!');
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete  = $this->deleted('menu', $id);
        return redirect()->route('menu.index');
    }


    public function getMenu($parentId)
    {
        $menus = $this->menu->where('deleted_at', 0)->get();
        $recursive = new Recursive($menus);
        $data = $recursive->setRecursive($parentId);
        return $data;
    }
}