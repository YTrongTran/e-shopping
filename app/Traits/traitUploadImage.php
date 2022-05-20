<?php

namespace App\Traits;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Str;


/**
 *
 */
trait traitUploadImage
{

    public function uploadAvatar($request, $name, $folder, $id)
    {
        if ($request->hasFile($name)) {
            $file = $request->$name;
            $namImage = $file->getclientOriginalName();
            $extenImage = $file->getclientOriginalExtension();
            $hashFile =  Str::random('15') . '.' . $extenImage;
            $file->move('upload/' . $folder . '/' . $id, $hashFile);
            $data = [
                'avatar_name' => $namImage,
                'avatar_path' => 'upload/' . $folder . '/' . $id . '/' . $hashFile,
            ];
            return $data;
        }
        return null;
    }
    public function deleted($model, $id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $delete = $this->$model->find($id)->update(
            [
                'deleted_at' => 1,
                'updated_at' => Carbon::now()
            ]

        );
        Toastr::success('Thông báo', 'Bạn đã xoá thành công ' . $id . '  !!!');
        return $delete;
    }
}