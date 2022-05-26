<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recursive;
use App\Http\Controllers\Controller;
use App\Model\Permission;
use App\Traits\traitUploadImage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use traitUploadImage;
    private $permission;
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Home";
        $key = "List";
        $permissions = $this->permission->where('deleted_at', 0)->latest()->paginate(6);
        return view('admin.permission.list', compact('title', 'key', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Home";
        $key = "Add";
        $htmlPermission = $this->getPermission($parentId = '');
        return view('admin.permission.add', compact('title', 'key', 'htmlPermission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->parent_id == 0) {
            $permissions = $this->permission->create([
                'name' => ucfirst($request->name),
                'display_name' => ucfirst($request->name),
                'key_code' => '',
                'parent_id' => $request->parent_id,
            ]);
        } else {
            $listPermissions = $this->permission->where('parent_id', 0)->get();
            foreach ($listPermissions as $key => $value) {
                if (trim($value->id) === trim($request->parent_id)) {
                    $permissions = $this->permission->create([
                        'name' => ucfirst($request->name) . '-' . $value['name'],
                        'display_name' => ucfirst($request->name) . '-' . $value['name'],
                        'key_code' => ucfirst($request->name) . '-' . $value['name'],
                        'parent_id' => $request->parent_id,
                    ]);
                }
            }
        }
        Toastr::success('Bạn đã thêm thành công !!!');
        return redirect()->route('permission.index');
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
        $title = "Home";
        $key = "Add";
        $permission = $this->permission->findOrFail($id);
        $htmlPermission = $this->getPermission($permission->parent_id);
        return view('admin.permission.edit', compact('title', 'key', 'permission', 'htmlPermission'));
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
        $permissions = $this->permission->find($id);
        if ($request->parent_id == 0) {
            $permissions->update([
                'name' => ucfirst($request->name),
                'display_name' => ucfirst($request->name),
                'key_code' => '',
                'parent_id' => $request->parent_id,
            ]);
        } else {
            $listPermissions = $this->permission->where('parent_id', 0)->get();
            foreach ($listPermissions as $key => $value) {
                if (trim($value->id) === trim($request->parent_id)) {
                    $permissions->update([
                        'name' => ucfirst($request->name) . '-' . $value['name'],
                        'display_name' => ucfirst($request->name) . '-' . $value['name'],
                        'key_code' => ucfirst($request->name) . '-' . $value['name'],
                        'parent_id' => $request->parent_id,
                    ]);
                }
            }
        }
        Toastr::success('Bạn đã cập nhật thành công !!!');
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->deleted('permission', $id);
        return redirect()->back();
    }

    public function getPermission($parentId)
    {

        $permissions = $this->permission->where('deleted_at', 0)->get();
        $object = new Recursive($permissions);
        $data = $object->setPermission($parentId);
        return $data;
    }
}