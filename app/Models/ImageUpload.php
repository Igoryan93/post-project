<?php
namespace App\Models;
use Intervention\Image\ImageManager;

class ImageUpload {
    private $queryBuilder;

    public function __construct(QueryBuilder $queryBuilder, ImageManager $imageManager){
        $this->queryBuilder = $queryBuilder;
        $this->imageManager = $imageManager;
    }

    public function upload($id, $uploadFile, $uploadDir) {
        $uploadImg = md5($uploadDir) . '.jpg';

        if(!empty($uploadFile)) {
            $image = $this->imageManager->make($uploadFile);
            $image->orientate()->fit(600, 600, function ($img) {
                $img->aspectRatio();
            });
            $image->save('img/' . $uploadImg);

            $this->queryBuilder->update('users', $id, ['image' => $uploadImg]);
            return true;
        } else {
            return false;
        }
    }

}