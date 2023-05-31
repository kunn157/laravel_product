<?php

namespace App\Services\Upload;


class UploadService
{
         /**
     *  create, update img product
     *
     * @param $request
     *
     * @return $path
     */
    public function uploadImg($request){
        if($request->hasFile('avatar')){
            $path =substr($request->file('avatar')
            ->storeAs('public/upload/product', $request->sku . '.' . 'jpg'), strlen('public/'));
        }
        return $path;
    }
}

