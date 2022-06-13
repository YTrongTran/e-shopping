<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = [];
        if (session()->has('card')) {
            $carts = session()->get('card');
        }

        return view('frontend.cart.list', compact('carts'));
    }

    public function addquantitycart(Request $request)
    {

        if ($request->ajax()) {
            $id = $request->id;
            $quantity_product = $request->quantity_product;

            if ($request->session()->has('card')) {
                $cart = $request->session()->get('card');
                foreach ($cart as $key => $value) {
                    if ($id == $value['id']) {
                        //cập nhật quantity
                        if ($value['quantity'] < $quantity_product) {

                            $cart[$key]['quantity'] = $value['quantity'] + 1;
                        } else {
                            $error = "Sản phẩm trong kho hiện tại không vui lòng không được cập nhật số lượng lên nữa";
                        }
                    }
                }

                $request->session()->put('card', $cart);
                return $cart;
            }
        }
    }
    public function upquantitycart(Request $request)
    {

        if ($request->ajax()) {
            $id = $request->id;

            $check = $request->check;

            if ($request->session()->has('card')) {
                $upcart = $request->session()->get('card');
                foreach ($upcart as $key => $value) {
                    if ($id == $value['id']) {
                        if ($check == 0) {
                            $value['quantity'] -= 1;
                        } else {
                            $value['quantity'] = 1;
                        }
                    }
                    $upcart[$key]['quantity'] = $value['quantity'];
                    if ($upcart[$key]['quantity'] < 1) {
                        unset($upcart[$key]);
                    }
                }

                $request->session()->put('card', $upcart);
                return $upcart;
            }
        }
    }
    public function deletedcart(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            if ($request->session()->has('card')) {
                $deltedcart = $request->session()->get('card');
                foreach ($deltedcart as $key => $value) {
                    if ($id == $value['id']) {
                        unset($deltedcart[$key]);
                    }
                }
                $request->session()->put('card', $deltedcart);
                return $deltedcart;
            }
        }
    }
}