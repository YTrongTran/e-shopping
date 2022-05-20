<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Blog;
use App\Traits\traitUploadImage;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    use traitUploadImage;
    private $blog;
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
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
        $listBlog = $this->blog->where('deleted_at', 0)->latest()->paginate(6);

        return view('admin.blog.list', compact('title', 'key', 'listBlog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Home';
        $key = 'List';


        return view('admin.blog.add', compact('title', 'key'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = $this->blog->create([
            'name' => $request->name,
            'display_name' => Str::slug($request->name),
            'description' => $request->desc,
            'user_id' => Auth::user()->id,
        ]);
        if (is_dir('upload/blog/' . Auth::user()->id)) {
            $avatar = $this->uploadAvatarBlog($request, 'image', 'blog', Auth::user()->id, $blog->id);
            if (!empty($avatar)) {
                //cập nhật
                $this->blog->find($blog->id)->update([
                    'image_blog' => $avatar['avatar_name'],
                    'image_path' => $avatar['avatar_path']
                ]);
            }
        } else {
            mkdir('upload/blog/' . Auth::user()->id);
        }
        Toastr::success('Bạn đã thêm thành công');
        return redirect('admin/blog/index');
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
        $blog = $this->blog->findOrFail($id);
        return view('admin.blog.edit', compact('title', 'key', 'blog'));
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
        $blog = $this->blog->find($id);
        $data = [
            'name' => $request->name,
            'display_name' => Str::slug($request->name),
            'description' => $request->desc,
            'user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ];
        if (is_dir('upload/blog/' . Auth::user()->id)) {
            $avatar = $this->uploadAvatarBlog($request, 'image', 'blog', Auth::user()->id, $id);
            if (!empty($avatar)) {
                $data['image_blog'] = $avatar['avatar_name'];
                $data['image_path'] = $avatar['avatar_path'];
                unlink($blog['image_path']);
            }
        } else {
            mkdir('upload/blog/' . Auth::user()->id);
        }
        if ($blog->update($data)) {
            Toastr::success('Bạn đã cập nhật thành công');
            return redirect('admin/blog/index');
        } else {
            Toastr::error('Bạn đã cập nhật thất bại !!! ');
        }
        return redirect('admin/blog/edit/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete =  $this->deleted('blog', $id);
        return redirect('/admin/blog/index');
    }
}