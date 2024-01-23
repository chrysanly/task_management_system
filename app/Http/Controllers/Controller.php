<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function baseUrl()
    {
        $baseUrl = env('APP_URL');
        if ($baseUrl == 'http://localhost') {
            return 'http://127.0.0.1:8000';
        }
        return env('APP_URL');
    }

    public function handleUpload($file, $storagePath)
    {
        $storagePath = '/' . $storagePath . '/';
        $destinationPath = public_path($storagePath);
        $newFileName = $this->slugId() . '-' . $file->getClientOriginalName() . '.' . $file->extension();
        $file->move($destinationPath, $newFileName);
        // file 
        $dataName  = $this->baseUrl() . $storagePath . $newFileName;
        return $dataName;
    }
    public function slugId()
    {
        $slug_id = new DateTime();
        $slug_id = $slug_id->getTimestamp();
        return $slug_id;
    }
}
