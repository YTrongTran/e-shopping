<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Model\Coutrys;
use App\User;
use App\Traits\traitUploadImage;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    use traitUploadImage;
    private $user;
    private $country;
    public function __construct(User $user, Coutrys $country)
    {
        $this->user = $user;
        $this->country = $country;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store(UserRequest $request)
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
        $title = "Home";
        $key = "Profile";
        $user = $this->user->find($id);
        $country = $this->country->where('deleted_at', 0)->get();
        $checkidCountry = $user->country;

        if (auth::check()) {
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
            'country_id' => 1,
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
        //
    }
}