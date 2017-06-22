<?php

    namespace App\Http\Controllers\Www;

    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;

    class ImageController extends Controller
    {

        public function getUserOrigineImage($imageName)
        {
            return \Image::make(storage_path() . '/app' . '/user/original/' . $imageName)->response();
        }
        public function getStudentOrigineImage($imageName)
        {
            return \Image::make(storage_path() . '/app' . '/students/original/' . $imageName)->response();
        }

        public function getImageWithSize($model,$width, $height, $imageName)
        {
            $newPath=$model.'/resize/'.$width.'x'.$height.$imageName;
            if(! \Storage::exists($newPath)){
                return \Image::make(storage_path().'/app/'.$model.'/original/'.$imageName)->fit($width, $height)->save(storage_path().'/app/'.$newPath)->response();
            }
            return \Image::make(storage_path().'/app/'.$newPath)->response();
        }
    }
