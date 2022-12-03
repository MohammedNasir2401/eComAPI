<?php

class FileUploader
{
    public function upload($file, $path = "files")
    {
        if ($file) {
            $path = $file->store('public/' . $path);
            $name = $file->getClientOriginalName();
            $filePath = "/storage/" . explode("public/", $path)[1];
            return $filePath;
        }
        // methods to s3 --> two methods and same functionality
        // $path = Storage::disk('s3')->putFile($path, $file);
        // $path = Storage::disk('s3')->put('/path', $file);
    }
}


