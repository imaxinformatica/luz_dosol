<?php

namespace App\Services;
use Image;
class ServiceProduct
{
    public function saveImage($file, $name)
    {
        $originalPath = public_path().'/uploads/products/original/';
        $thumbnailPath = public_path().'/uploads/products/thumbnail/';
        $originalImage = $file;
        $fileName = getNameFile($file, $name);

        $image = Image::make($originalImage);
        $image->save($originalPath.$fileName);
        
        $image->resize(150, null, function ($constraint) { $constraint->aspectRatio(); });
        $image->save($thumbnailPath.$fileName);

        return $fileName;
    }

}