<?php
session_start();
include("_header.html");
?>
<h2>Account Settings</h2>
<?php
if(isset($_SESSION["user"])){
    if (isset($_FILES["imagen"])) {


        $target_dir = "uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION));
        $target_file = $target_dir . basename($_SESSION["user"] . ".jpg");


        $uploadOk = 1;
        // Check if image file is a actual image or fake image
        if($_FILES["imagen"]["tmp_name"] != ""){
            $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        } else{
            $check = false;
        }
        if($check !== false) {
            $error =  "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;

            // Check file size
             if ($_FILES["imagen"]["size"] > 5000000) {
                $error =  "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                $error =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            else if ($uploadOk == 0) {
                $error =  "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                //corta la imagen en un cuadrado y reduce su tamaño a 1000x1000 para no gastar almacenamiento
                $im1 = imagecreatefromstring(file_get_contents($_FILES["imagen"]["tmp_name"]));
                $size = min(imagesx($im1), imagesy($im1));
                $im2 = imagescale(imagecrop($im1, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]),1000,1000);

                if ($im2 !== FALSE) {
                    $uploadOk = imagejpeg($im2, $target_file);
                    imagedestroy($im2);
                }
                imagedestroy($im1);

                if ($uploadOk) {
                    $error =  "The file ". basename( $_FILES["imagen"]["name"]). " has been uploaded.";
                    header("location:ajustesCuenta.php");
                } else {
                    $error =  "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $error = "File is not an image.";
            $uploadOk = 0;
        }
    }

    include("_imageUpload.html");

} else{
    include("_sessionExpired.html");
}



include("_footer.html");
?>