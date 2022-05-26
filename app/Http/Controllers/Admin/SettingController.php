<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Setting;
use App\Traits\traitUploadImage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use traitUploadImage;
    private $setting;
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Home';
        $key  = 'List';
        $settings = $this->setting->where('deleted_at', 0)->latest()->paginate(10);
        return view('admin.setting.list', compact('title', 'key', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Home';
        $key  = 'Add';
        return view('admin.setting.add', compact('title', 'key'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $settings = $this->setting->create([
            'config_key' => trim($request->config_key),
            'config_value' => trim($request->config_value),
            'type' => $request->type,
        ]);
        Toastr::success('Bạn đã thêm thành công !!!');
        return redirect()->route('setting.index');
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
        $key  = 'Edit';
        $setting  = $this->setting->findOrFail($id);
        return view('admin.setting.edit', compact('title', 'key', 'setting'));
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
        $setting  = $this->setting->findOrFail($id);
        $setting->update([
            'config_key' => trim($request->config_key),
            'config_value' => trim($request->config_value),
            'type' => $request->type,
        ]);
        Toastr::success('Bạn đã cập nhật thành công !!!');
        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->deleted('setting', $id);
        return redirect()->route('setting.index');
    }
}