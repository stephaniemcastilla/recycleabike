<?php

class BikesController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Ensure User Is Logged In
        //Auth::checkAuthentication();
    }

    public function index()
    {
        $this->View->render('bikes/index', array(
          'type' => 'bikes',
          'bikes' => BikesModel::getAllBikes()
        ));
    }

    public function type($type)
    {
        $this->View->render('bikes/index', array(
          'type' => $type,
          'bikes' => BikesModel::getBikesByType($type)
        ));
    }
    
    public function create()
    {
        $rab_id = "1";//date('Y', Request::post('date_in')) & date('m', Request::post('date_in')) & date('d', Request::post('date_in')) ;
        $target_file = "";
        
        if(isset($_POST["photo"])){
          $image_tmp = $_FILES["photo"]["tmp_name"];
          $target_dir = "uploads/";
          $target_file = $target_dir . 'image_' . date("Y-m-d-H.i.s"). '.jpg';
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
              $check = getimagesize($image_tmp);
                
              if($check !== false) {
                  echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
              } else {
                  echo "File is not an image.";
                  $uploadOk = 0;
              }
          }
        
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
              $width=600;

              // Fix Width & Heigh (Auto calculate)

              $size=GetimageSize($image_tmp);
              $height=round($width*$size[1]/$size[0]);
              $images_orig = ImageCreateFromJPEG($image_tmp);
              $photoX = ImagesX($images_orig);
              $photoY = ImagesY($images_orig);
              $images_fin = ImageCreateTrueColor($width, $height);
              ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);            
            
              if (ImageJPEG($images_fin,$target_file)) {
                  ImageDestroy($images_orig);
                  ImageDestroy($images_fin);
                  echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
              } else {
                  echo "Sorry, there was an error uploading your file.";
              }
          }
        }
        BikesModel::createBike($rab_id, Request::post('make'), Request::post('model'), Request::post('color'), Request::post('price'), Request::post('serial'), $target_file, Request::post('source'), Request::post('status'), Request::post('mechanic'), Request::post('date_in'), Request::post('date_out'));
        Redirect::to('bikes');
    }

    public function view($id)
    {
        $this->View->render('bikes/view', array(
            'bike' => BikesModel::getBikeByID($id),
            'repairs' => RepairsModel::getRepairsByBike($id),
            'hours' => HoursModel::getAllHours(),
            'people' => PeopleModel::getAllPeople()
        ));
    }
  
    public function edit($id)
    {
        $this->View->render('bikes/edit', array(
            'bike' => BikesModel::getBikeByID($id)
        ));
    }

    public function update()
    {
        
        if($_FILES["photo"]["tmp_name"]){
          function compress_image($src, $dest , $quality) 
          {
              $info = getimagesize($src);

              if ($info['mime'] == 'image/jpeg') 
              {
                  $image = imagecreatefromjpeg($src);
              }
              elseif ($info['mime'] == 'image/gif') 
              {
                  $image = imagecreatefromgif($src);
              }
              elseif ($info['mime'] == 'image/png') 
              {
                  $image = imagecreatefrompng($src);
              }
              else
              {
                  die('Unknown image file format');
              }

              //compress and save file to jpg
              imagejpeg($image, $dest, $quality);

              //return destination file
              return $dest;
          }

          $compressed = compress_image($_FILES["photo"]["tmp_name"], 'image.jpg', 50); 

          $target_dir = "uploads/";
          $target_file = $target_dir . 'image_' . date("Y-m-d-H.i.s"). '.jpg';
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
              $check = getimagesize($_FILES["photo"]["tmp_name"]);
              if($check !== false) {
                  echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
              } else {
                  echo "File is not an image.";
                  $uploadOk = 0;
              }
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
              if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                  echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
              } else {
                  echo "Sorry, there was an error uploading your file.";
              }
          }
          
        }
        
        BikesModel::updateBike(Request::post('id'), Request::post('id'), Request::post('make'), Request::post('model'), Request::post('color'), Request::post('price'), Request::post('serial'), $target_file, Request::post('source'), Request::post('status'), Request::post('mechanic'), Request::post('date_in'), Request::post('date_out'));
        Redirect::to('bikes');
    }

    public function delete($id)
    {
        BikesModel::deleteBike($id);
        Redirect::to('bikes');
    }
}
