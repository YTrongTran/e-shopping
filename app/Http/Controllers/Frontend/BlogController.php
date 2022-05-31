<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Blog;
use App\Model\BlogCmt;
use App\Model\Rate;
use App\Traits\traiList;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use traiList;
    private $blog;
    private $rate;
    private $blogcmt;
    public function __construct(Blog $blog, Rate $rate, BlogCmt $blogcmt)
    {
        $this->blog = $blog;
        $this->blogcmt = $blogcmt;
        $this->rate = $rate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = $this->category();
        $blogs = $this->blog->where('deleted_at', 0)->latest()->paginate(3);

        return view('frontend.blog.list', compact('categorys', 'blogs'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id, Request $request)
    {
        $blogId = $this->blog->findOrFail($id);
        $categorys = $this->category();

        $next = $blogId->where('id', '>', $id)->where('deleted_at', 0)->min('id');
        $previous = $blogId->where('id', '<',  $id)->where('deleted_at', 0)->max('id');


        if ($request->ajax()) {
            $value =  $request->value;
            if (!empty($value)) {
                $rates = $this->rate->create([
                    'rate' => $value,
                    'user_id' => auth()->user()->id,
                    'blog_id' => $id,
                ]);
            }
        }

        $listRate = $this->rate->where('blog_id', $id)->avg('rate');
        $gpa = round($listRate);

        $countBlogcmt = $this->blogcmt->where('blog_id', $id)->count('cmt');

        return view('frontend.blog.single', compact('blogId', 'categorys', 'previous', 'next', 'gpa', 'countBlogcmt'));
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