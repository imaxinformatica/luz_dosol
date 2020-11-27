<?php

namespace App\Services;

use App\Product;
use Image;

class ServiceProduct
{
    public function saveImage($file, $name)
    {
        $originalPath = public_path() . '/uploads/products/original/';
        $thumbnailPath = public_path() . '/uploads/products/thumbnail/';
        $originalImage = $file;
        $fileName = getNameFile($file, $name);

        $image = Image::make($originalImage);
        $image->save($originalPath . $fileName);

        $image->resize(100, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($thumbnailPath . $fileName);

        return $fileName;
    }

    public static function createProduct(array $data, ServiceProduct $productService): void
    {
        $data['file'] = $productService->saveImage($data['file'], $data['name']);
        $data['price'] = convertMoneyBraziltoUSA($data['price']);
        $data['weight'] = convertMoneyBraziltoUSA($data['weight']);
        $data['volume'] = convertMoneyBraziltoUSA($data['volume']);
        Product::create($data);
    }
    
    public function updateProduct(array $data, Product $product): void
    {
        if (isset($data['file'])) {
            $data['file'] = $this->saveImage($data['file'], $data['name']);
        }
        $data['price'] = convertMoneyBraziltoUSA($data['price']);
        $data['weight'] = convertMoneyBraziltoUSA($data['weight']);
        $data['volume'] = convertMoneyBraziltoUSA($data['volume']);
        $product->update($data);
    }

}