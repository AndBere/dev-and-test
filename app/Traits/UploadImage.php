<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadImage
{
    public function uploadImages($images, array $data = [], string $nameInput = 'images')
    {
        if($images == null or (is_array($images) and count(array_filter($images)) == 0)) { return []; } // or $images == '/storage/'.$this->getOriginal($name)
        $name = $this->data_array($data,'name',$nameInput);

        $this->if_diff_images($images, $this->old_images($name));

        $this->$name = $this->addImages($images,$data,$name);
    }

    public function getImage(string $name = 'image',string $imageDefault = '/img/png/no_image.png') : string // вывод картинки
    {
        $imageUrl = is_array($this->$name)
            ? $this->getImages(0,$name,$imageDefault)
            : $this->storage($this->$name,$imageDefault);

        return $imageUrl;
    }

    public function getImages($number = 0,string $name = 'images', string $imageDefault = '/storage/cover_images/noimage.png') : string // вывод картинки
    {
        $imageUrl = (isset($this->$name) and is_array($this->$name) and $this->$name != [])
            ? $this->storage($this->$name[$number],$imageDefault)
            : $this->getImage($name,$imageDefault);
// dd($imageUrl);
        return $imageUrl;
    }

    // Вспомогательные функции
    public function data_array($data,string $title,$default)
    {
        $data_array = array_key_exists($title,$data)
            ? $data[$title]
            : $default;

        return $data_array;
    }

    public function addImages($images,$data,$name)
    {
        $images = array_filter($images);
        for($i = 0; $i < count($images); $i++)
        {
            $imagesArray[] = in_array($images[$i], $this->old_images($name))
                ? $images[$i]
                : $this->image_array($images[$i],$data,$name);
        }
        $imagesArray = is_array($imagesArray)
            ? array_filter($imagesArray)
            : null;

        return $imagesArray; // json_encode($imagesArray);
    }

    public function image_array($image,$data,$name) : string
    {
        $type = $this->data_array($data,'type','base64');
        $extension = $this->data_array($data,'extension','jpg');
        $folder_name = $this->folder_name($data,$name);

        if($image != null)
        {

        }
        $data = $type == 'base64'
            ? str_replace(' ', '+', Str::after($image,';base64,'))
            : $image;

        $pathway = $folder_name . Str::random(10) . '.' . $extension;

        $type == 'base64'
            ? Storage::put("public/$pathway", base64_decode($data))
            : $data->storeAs("public/", $pathway);
        return $pathway;
    }

    public function folder_name($data,$name) : string
    {
        $date = now()->format('MY');
        $folder = $this->data_array($data,'folder',null);
        $folder_slash = $folder != null
            ? $folder . '/'
            : null;
        $folder_name = $name . '/' . $folder_slash . $date . '/';

        return $folder_name;
    }

    public function old_images($name) : array
    {
        $old_images = is_array($this->getOriginal($name))
            ? $this->getOriginal($name)
            : array($this->getOriginal($name));

        return $old_images;
    }

    public function if_diff_images(array $new_images, array $old_images)
    {
        if(count(array_diff($old_images,$new_images)) > 0)
        {
            foreach (array_diff($old_images,$new_images) as $imageDel)
            {
                $this->removeImage($imageDel);
            }
        }
    }

    public function removeImage($imageDel)
    {
        if($imageDel != null) { Storage::delete("public/" . $imageDel); }
    }


    public function storage($image,$imageDefault) : string
    {
        if($image == null) { return $imageDefault; }
        $imageUrl = Storage::exists('/public/'.$image)
            ? Storage::url($image)
            : $imageDefault;

        return  $imageUrl;
    }

}
