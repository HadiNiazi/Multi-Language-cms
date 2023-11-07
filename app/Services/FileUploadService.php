<?php


namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function md5;
use function microtime;

class FileUploadService
{
    public static function upload(UploadedFile $file, $path = 'files')
    {
        try{

            $name = md5(microtime()).'.'.$file->getClientOriginalExtension();

            $file->move($path,$name);
            $file->name = $name;
            return $name;

        }catch(Exception $exception){

            session()->flash('alert-danger','Something wrong with Image File');
            return null;

        }
    }

    public static function delete($filename, $path = null)
    {
        try{

            $imageNameWithPath = $path . $filename;

            if ( file_exists($imageNameWithPath) ){
                unlink($imageNameWithPath);
            }

            return true;

        }catch(Exception $exception){

            session()->flash('alert-danger','Something wrong during removing image');
            return null;

        }
    }
}
