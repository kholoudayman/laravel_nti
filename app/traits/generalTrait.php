<?php

namespace App\traits;

trait generalTrait{

    public function uploadPhoto($image, $folder)
    {
        $filename = time(). '.' . $image->extension();
        $image->move(public_path('images/'.$folder, $filename));
        return $filename;
    }
}