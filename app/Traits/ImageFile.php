<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageFile 
{

    public function uploadImage($request,$folder)
    {
        $image = $request->file('image_file'); 
        $name = $image->hashName();
        $image->store($folder);//مسار المجلد الذي يتم تخزين الصوره فيه
        $request->merge(['image'=>$name]);//دمج قيمة$nameفي$image
        return $request;
    }

    public function updateImage( $request , $oldImage , $folder)
    {
        if($request->hasFile('image_file'))
        {
            Storage::disk('public')->delete( $folder .'/'.$oldImage);
            $image = $request->file('image_file');
            $name = $image->hashName();
            $image->store($folder);
            $request->merge(['image'=>$name]);
        }
        return $request ;
    }

    public function deleteImage($nameImage , $folder)
    {
        $path = $folder . '/' . $nameImage;
        if(Storage::disk('public')->exists($path))
        {
            Storage::delete($path);
        }
        return 1;
    }

}