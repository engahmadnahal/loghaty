<?php

namespace App\Http\Trait;

use Illuminate\Support\Facades\Storage;

trait CustomTrait
{

    /**
     *
     * @param file $file
     * @return string $fileName
     */
    public function uploadFile($file) : string{
        $fileName = time() . ".". $file->getClientOriginalExtension();
         $file->storePubliclyAs("upload/images",$fileName);
        return 'upload/images/'.$fileName;
    }
}
