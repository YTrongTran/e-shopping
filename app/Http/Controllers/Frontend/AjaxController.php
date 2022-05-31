<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\BlogCmt;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    private $blogcmt;
    public function __construct(BlogCmt $blogcmt)
    {

        $this->blogcmt = $blogcmt;
    }
    public function comment($blog_id, Request $request)
    {
        $message = $request->message;

        if (!empty($message)) {
            $blogcmt = $this->blogcmt->create([
                'cmt' => $message,
                'blog_id' => $blog_id,
                'user_id' => auth()->user()->id,
                'level' => $request->reply_id ? $request->reply_id : 0
            ]);
            $blogcmts = $this->blogcmt->where(['blog_id' => $blog_id, 'level' => 0])->get();

            $returnHTML = view('frontend.blog.list-comment', compact('blogcmts'))->render();
            return response()->json(['success' => true, 'html' => $returnHTML]);
        }
    }
}