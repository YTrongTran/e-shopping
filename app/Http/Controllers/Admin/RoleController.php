<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use App\Model\Roles;
use App\Traits\traitUploadImage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use traitUploadImage;
    private $role;
    private $permission;

    public function __construct(Roles $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
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
        $listRole = $this->role->where('deleted_at', 0)->latest()->paginate(6);
        return view('admin.role.list', compact('title', 'key', 'listRole'));
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
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('title', 'key', 'permissionsParent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = $this->role->create([
            'name' =>  ucfirst($request->name),
            'display_name' =>  ucfirst($request->display_name),
        ]);

        $role->permissions()->attach($request->childs);


        Toastr::success('Bạn đã thêm thành công vai trò người dùng !!!');
        return redirect('admin/role/index');
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
        $role = $this->role->findOrFail($id);
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        $permissionCheck = $role->permissions;
        return view('admin.role.edit', compact('title', 'key', 'role', 'permissionsParent', 'permissionCheck'));
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
        $role = $this->role->find($id);
        $role->update([
            'name' =>  ucfirst($request->name),
            'display_name' =>  ucfirst($request->display_name),
        ]);
        $role->permissions()->sync($request->childs);
        Toastr::success('Bạn đã cập nhật thành công vai trò người dùng !!!');
        return redirect('admin/role/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleted('role', $id);
        return redirect('admin/role/index');
    }
}