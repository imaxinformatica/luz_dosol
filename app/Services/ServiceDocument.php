<?php
 
namespace App\Services;

use Image;

class ServiceDocument
{
    public function saveImage($file, $name)
    {
        $originalPath = public_path().'/uploads/document/';
        $originalImage = $file;

        $fileName = getNameFile($file, $name);
        $fileName =  $fileName.".".pathinfo($originalImage->getClientOriginalName(),PATHINFO_EXTENSION);
        $attachment = "uploads/document/{$fileName}";
        $originalImage->move('uploads/document', $fileName);

        return $fileName;
    }
}