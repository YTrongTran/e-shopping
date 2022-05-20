<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Coutrys;
use App\Traits\traitUploadImage;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CountryController extends Controller
{
    use traitUploadImage;
    private $country;
    public function __construct(Coutrys $country)
    {
        $this->country = $country;
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
        $listCountry = $this->country->where('deleted_at', 0)->latest()->paginate(6);

        return view('admin.country.list', compact('title', 'key', 'listCountry'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Home';
        $key = 'Add Country';

        return view('admin.country.add', compact('title', 'key'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = $this->country->create([
            'name' => $request->name
        ]);
        Toastr::success('Thông báo', 'Bạn đã thêm thành công ' . $country->name . ' !!!');
        return redirect('/admin/country/index');
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
        $key = 'Edit Country';
        $country = $this->country->findOrFail($id);

        return view('admin.country.edit', compact('title', 'key', 'country'));
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
        $country = $this->country->find($id)->update([
            'name' => $request->name,
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('Thông báo', 'Bạn đã cập nhật thành công  !!!');
        return redirect('/admin/country/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->deleted('country', $id);
        return redirect('/admin/country/index');
    }
}