<?php

namespace App\Services;

use Illuminate\Support\Facades\Request;

class UploadService
{
    public function upload(string $file,string $path):string
    {
        $file = Request::file($file);
        $new = $file->hashName();
        $file->move($path,$new);
        $result_file = $path.$new;
        return $result_file;
    }
}