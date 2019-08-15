<?php

namespace App\Services;
use Image;

class ServiceBanner
{
    public function saveImage($file, $name)
    {
        $originalPath = public_path().'/uploads/banner/original/';
        $thumbnailPath = public_path().'/uploads/banner/thumbnail/';
        $originalImage = $file;
        $fileName = getNameFile($file, $name);

        $image = Image::make($originalImage);
        $image->save($originalPath.$fileName);
        
        $image->resize(150, null, function ($constraint) { $constraint->aspectRatio(); });
        $image->save($thumbnailPath.$fileName);

        return $fileName;
    }
}