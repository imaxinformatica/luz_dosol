<?php

namespace App\Services;

use App\Premium;
use Image;

class ServicePremium
{
    public function saveImage($file, $name): string
    {
        $originalPath = public_path() . '/uploads/premium/original/';
        $thumbnailPath = public_path() . '/uploads/premium/thumbnail/';
        $originalImage = $file;
        $fileName = getNameFile($file, $name);

        $image = Image::make($originalImage);
        $image->save($originalPath . $fileName);

        $image->resize(150, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($thumbnailPath . $fileName);

        return $fileName;
    }

    public function findOrcreate(array $data, $graduation): void
    {
        if(isset($data['file'])){
            $data['file'] = $this->saveImage($data['file'], $data['name']);
        }
        if($graduation){
            $premium = Premium::where('graduation', $graduation)->first();
            if($premium){
                $premium->update($data);
            }else{
                Premium::create($data);
            }
        }
    }

    public function updatePremium(array $data): void
    {
        if(isset($data['file'])){
            $data['file'] = $this->saveImage($data['file'], $data['name']);
        }
        $premium = Premium::where('id', $data['premium_id'])->first();
        $premium->update($data);
    }

    public function deletePremium(Premium $premium): void
    {
        $premium->delete();
    }
}
