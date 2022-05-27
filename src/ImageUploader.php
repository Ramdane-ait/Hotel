<?php
namespace App;

use App\Model\Image;

class ImageUploader {

   
    public static function uploadImage(string $name){
        if (self::validate($name)){
            if ($_FILES[$name]["error"] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES[$name]["tmp_name"];
                $image= basename($_FILES[$name]['name']);
                return move_uploaded_file($tmp_name, "images_chambres/$image");
            } 
        } 
        return false;
        
    }
    public static function uploadImages(string $name){
        $images = [];
        $extension=array("jpeg","jpg","png","gif");
        
        if (!isset($_FILES[$name]["tmp_name"][1])){
            $file_name=$_FILES[$name]["name"][0];
            
            $ext=pathinfo($file_name,PATHINFO_EXTENSION);

            if(in_array($ext,$extension)) {
                if(!file_exists("images_chambres/".$file_name)) {
                    if (move_uploaded_file($file_tmp=$_FILES[$name]["tmp_name"][0],"images_chambres/".$file_name)){
                        $images[] = (new Image())->setName($file_name); 
                    } 
                }
                else {
                    $filename=basename($file_name,$ext);
                    $newFileName=$filename.time().".".$ext;
                    if (move_uploaded_file($file_tmp=$_FILES[$name]["tmp_name"][0],"images_chambres/".$newFileName)){
                        $images[] = (new Image())->setName($newFileName); 
                    } 
                }
            }
        } else {
           foreach($_FILES[$name]["tmp_name"] as $key=>$tmp_name) {
                $file_name=$_FILES[$name]["name"][$key];
                
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);

                if(in_array($ext,$extension)) {
                    if(!file_exists("images_chambres/".$file_name)) {
                        if (move_uploaded_file($file_tmp=$_FILES[$name]["tmp_name"][$key],"images_chambres/".$file_name)){
                            $images[] = (new Image())->setName($file_name); 
                        } 
                    }
                    else {
                        $filename=basename($file_name,$ext);
                        $newFileName=$filename.time().".".$ext;
                        if (move_uploaded_file($file_tmp=$_FILES[$name]["tmp_name"][$key],"images_chambres/".$newFileName)){
                            $images[] = (new Image())->setName($newFileName); 
                        } 
                    }
                }

            }    
        }
        
        return $images;
    }
    public static function validate($name){
        if ($_FILES[$name]['size'] > 1 && $_FILES[$name]['size'] < 5242880){
            if (in_array($_FILES[$name]['type'],['image/png','image/jpg','image/jpeg'])){
                if ($_FILES[$name]['error'] == UPLOAD_ERR_OK){
                    return true;
                }
            }
        } 
        return false;
    }
   

}