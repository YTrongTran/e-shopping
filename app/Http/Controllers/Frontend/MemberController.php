<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Coutrys;
use App\Traits\traitUploadImage;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    use traitUploadImage;
    private $user;
    private $country;
    public function __construct(User $user, Coutrys $country)
    {
        $this->user = $user;
        $this->country = $country;
    }
    public function edit($id)
    {
        $users = $this->user->findOrFail($id);
        $countrys = $this->country->all();
        return view('frontend.memeber.profile', compact('users', 'countrys'));
    }
    public function update($id, Request $request)
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
                if (!empty(Auth::user()->avatar_path)) {
                    unlink(Auth::user()->avatar_path);
                }
            }
        } else {
            mkdir('upload/user/' . $id);
        }
        $this->user->find($id)->update($data);
        Toastr::success("Bạn cập nhật thành công thông tin tài khoản " . Auth::user()->name);
        return redirect()->back();
    }
}