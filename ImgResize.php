<?php

class ImgResize{

    protected $resizeWidth = 100;
    protected $resizeHeight = 100;
    protected $uploadPath = "uploads/thumb/"; // thumbnail path
    protected $mainPath = "uploads/";


	public  function make($file_name){

        $fileName = $_FILES[($file_name)]['tmp_name'];

		$sourceProperties = getimagesize($fileName);
       
        $uploadPath = $this->uploadPath;
        $fileExt = pathinfo($_FILES[($file_name)]['name'], PATHINFO_EXTENSION);
        $resizeFileName = time().'.'.$fileExt;
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];

        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = $this->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath.$resizeFileName);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = $this->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath.$resizeFileName);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = $this->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath.$resizeFileName);
                break;
 
            default:
                
                break;
        }

        if(move_uploaded_file($fileName, $this->mainPath. $resizeFileName)){

            
			return $resizeFileName;
        }
        

        return false;

	}


    public function resizeImage($resourceType,$image_width,$image_height) {

            $resizeWidth = $this->resizeWidth;
            $resizeHeight = $this->resizeHeight;

            $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
            imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
            return $imageLayer;
    }

}
