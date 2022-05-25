<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Model\Coutrys;
use App\Model\Roles;
use App\User;
use App\Traits\traitUploadImage;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    use traitUploadImage;
    private $user;
    private $role;
    private $country;
    public function __construct(User $user, Coutrys $country, Roles $role)
    {
        $this->user = $user;
        $this->role = $role;
        $this->country = $country;
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
        $listUser = $this->user->where('deleted_at', 0)->latest()->paginate(6);
        return view('admin.user.list', compact('title', 'key', 'listUser'));
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
        $country = $this->country->where('deleted_at', 0)->get();
        $role = $this->role->where('deleted_at', 0)->get();

        return view('admin.user.add', compact('title', 'key', 'role', 'country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password = $request->password;
        if (!empty($password)) {
            $password = bcrypt($request->password);
        }
        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => $password,
            'country_id' => $request->country_id,
        ]);
        $avart = $this->uploadAvatar($request, 'avatar', 'user', $user->id);
        if (!empty($avart)) {
            $updateAvatar = $this->user->find($user->id)->update([
                'avatar' => $avart['avatar_name'],
                'avatar_path' => $avart['avatar_path']

            ]);
        }
        foreach ($request->roles as $roleId) {
            $user->roles()->attach($roleId);
        }

        Toastr::success("Bạn đã thành công tài khoản " . $user->name);
        return redirect('admin/user/index/');
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
    public function editUser($id)
    {
        $title = "Home";
        $key = "Edit";
        $user = $this->user->findOrFail($id);
        $countrys = $this->country->where('deleted_at', 0)->get();
        $roles = $this->role->where('deleted_at', 0)->get();

        return view('admin.user.edit', compact('key', 'title', 'user', 'countrys', 'roles'));
    }

    public function updateUser(Request $request, $id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $password = $request->password;
        if (!empty($password)) {
            $password = bcrypt($request->password);
        } else {
            $password = Auth::user()->password;
        }
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => $password,
            'country_id' => $request->country_id,
            'updated_at' => Carbon::now(),
        ];

        if (is_dir('upload/user/' . $id)) {
            $avart = $this->uploadAvatar($request, 'avatar', 'user', $id);
            if (!empty($avart)) {
                $data['avatar'] = $avart['avatar_name'];
                $data['avatar_path'] = $avart['avatar_path'];
                unlink(Auth::user()->avatar_path);
            }
        } else {
            mkdir('upload/user/' . $id);
        }
        $this->user->find($id)->update($data);
        $user =  $this->user->find($id);
        if (!empty($request->roles)) {
            foreach ($request->roles as $role) {
                $roleId[] = $role;
            }
            $user->roles()->sync($roleId);
        } else {
            $user->roles()->sync(0);
        }



        Toastr::success("Bạn cập nhật thành công  ");
        return redirect('admin/user/index/');
    }

    public function edit($id)
    {
        if (auth::check()) {
            $title = "Home";
            $key = "Profile";
            $user = $this->user->find($id);
            $country = $this->country->where('deleted_at', 0)->get();
            $checkidCountry = $user->country;

            return view('admin.user.profile', compact('key', 'title', 'user', 'country', 'checkidCountry'));
        }
        return redirect()->to('admin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $password = $request->password;
        if (!empty($password)) {
            $password = bcrypt($request->password);
        } else {
            $password = Auth::user()->password;
        }
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => $password,
            'country_id' => $request->country_id,
            'updated_at' => Carbon::now()
        ];

        if (is_dir('upload/user/' . $id)) {
            $avart = $this->uploadAvatar($request, 'avatar', 'user', $id);
            if (!empty($avart)) {
                $data['avatar'] = $avart['avatar_name'];
                $data['avatar_path'] = $avart['avatar_path'];
                unlink(Auth::user()->avatar_path);
            }
        } else {
            mkdir('upload/user/' . $id);
        }
        $this->user->find($id)->update($data);
        Toastr::success("Bạn cập nhật thành công thông tin tài khoản " . Auth::user()->name);
        return redirect('admin/user/profile/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete =  $this->deleted('user', $id);
        return redirect('admin/user/index/');
    }
}