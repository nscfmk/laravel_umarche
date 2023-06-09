<?php

namespace App\Services;
use InterventionImage;
use Illuminate\Support\Facades\Storage;

class ImageService

{

    /**
     * アップロードする画像を受け取って、命名、画像のリサイズ、、Storageフォルダへの保存を行う処理
     *
     * @param  $imageFile アップロードする画像
     * @param  $folderName　保存先のstorageディレクトリのフォルダ名
     * @return 保存した画像の名前
     */
    public static function upload($imageFile, $folderName){

        if(is_array($imageFile)){
            $file = $imageFile['image'];
        }else{
            $file =$imageFile;
        }
        $fileName = uniqid(rand() . '_');
        $extension = $file->extension();
        $fileNameToStore = $fileName . '.' . $extension;

        $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();
        Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage);


        return $fileNameToStore;
    }
}