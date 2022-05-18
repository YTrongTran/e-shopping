<?php

namespace App\Traits;

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
}