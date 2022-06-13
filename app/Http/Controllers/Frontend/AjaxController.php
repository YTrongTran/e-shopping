<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\BlogCmt;
use App\Model\Products;
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
    public function addtocart(Request $request)
    {
        $flag = true;
        if ($request->ajax()) {
            $id = $request->id;
            $name = $request->name;
            $image = $request->image;
            $price = $request->price;
            $quantity = $request->quantity;

            $data = [
                'id' => $id,
                'name' => $name,
                'image' => $image,
                'price' => $price,
                'quantity' => $quantity
            ];
            if ($request->session()->has('card')) {
                $card = $request->session()->get('card');
                foreach ($card  as $key => $value) {
                    if ($id === $value['id']) {

                        $card[$key]['quantity'] = $value['quantity'] + 1;
                        $request->session()->put('card', $card);
                        $flag = false;
                    }
                }
            }
            if ($flag) {
                $request->session()->push('card', $data);
            }
            $count =  count($request->session()->get('card'));

            $product = Products::find($id);
            $quantity = $product->quantity;
            $request->session()->put('quantity' . $id, $quantity);
            return response()->json(['code' => 200, 'count' => $count, 'messager' => "Bạn đã thêm sản phẩm thành công"], 200);
        }
    }
}