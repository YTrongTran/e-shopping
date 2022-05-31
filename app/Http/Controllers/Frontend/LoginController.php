<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Coutrys;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country  = $this->country->where('deleted_at', 0)->get();
        return view('frontend.login.login', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $email = $request->email_register;
            $checkEmail = $this->user->where('email', $email)->first();
        }
        return response()->json([
            'code' => 200,
            'email' => $checkEmail
        ], 200);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => [0, 1],
            'status' => [0, 1],
            'deleted_at' => 0
        ];
        $remember = false;
        if ($request->remember_me) {
            $remember = true;
        }
        if (Auth::attempt($data, $remember)) {
            Toastr::success('Bạn đã đăng nhập thành công');
            return redirect()->route('frontend.member.edit', ['id' => auth()->user()->id]);
        }
        Toastr::error('Email hoặc Password không chính xác');
        return redirect()->back();
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        Toastr::info('Bạn đã đăng xuất thành công !!!');
        return redirect('/login/create');
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
        //
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
        //
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
