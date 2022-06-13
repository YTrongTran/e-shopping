<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Slider;
use App\Traits\traitUploadImage;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    use traitUploadImage;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title  = 'Home';
        $key = 'List';
        $sliders = $this->slider->where(['status' => 0, 'deleted_at' => 0])->latest()->paginate(10);

        return view('admin.slider.list', compact('title', 'key', 'sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title  = 'Home';
        $key = 'Add';

        return view('admin.slider.add', compact('title', 'key'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = $this->slider->create([
            'name' => $request->name,
            'description' => Str::slug($request->desc),
            'status' => $request->status,
        ]);
        $image = $this->uploadAvatarBlog($request, 'slider_image', 'slider', auth()->user()->id, $slider->id);
        if (!empty($image)) {
            $slider->update([
                'name_image' => $image['avatar_name'],
                'name_image_path' => $image['avatar_path'],
            ]);
        }
        Toastr::success('Bạn đã thêm thành công');
        return redirect()->route('slider.index');
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
        $title  = 'Home';
        $key = 'Edit';
        $slider = $this->slider->findOrFail($id);
        return view('admin.slider.edit', compact('title', 'key', 'slider'));
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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $slider = $this->slider->find($id);
        $data = [
            'name' => $request->name,
            'description' => Str::slug($request->desc),
            'status' => $request->status,
            'updated_at' => Carbon::now()
        ];
        if (is_dir('upload/slider/' . auth()->user()->id . '/')) {
            $image = $this->uploadAvatarBlog($request, 'slider_image', 'slider', auth()->user()->id, $slider->id);
            if (!empty($image)) {

                $data['name_image'] = $image['avatar_name'];
                $data['name_image_path'] = $image['avatar_path'];

                unlink($slider->name_image_path);
            }
        } else {
            mkdir('upload/slider/' . auth()->user()->id . '/');
        }
        $slider->update($data);
        Toastr::success('Bạn đã cập nhật thành công');
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->deleted('slider', $id);
        return redirect()->route('slider.index');
    }
}