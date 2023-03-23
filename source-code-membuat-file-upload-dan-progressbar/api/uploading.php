<?php

// panggil lib upload
require '../lib/upload/class.upload.php';

//path upload jika sudah selesai
$path_upload = '../foto/';

//deklarasi variable untuk validasi 
$filename = @$_FILES['file']['name'];
$filesize = @$_FILES['file']['size'];
$filetmp  = @$_FILES['file']['tmp_name'];
$filetype = array("jpg", "JPG", "jpeg", "JPEG", "png", "PNG", "gif", "GIF", "bmp", "BMP");

// pecah $filename menjadi array 
@list($txt, $ext) = explode(".", $filename);

//cek jika extensi file sama yang terdapat dalam array
if(in_array($ext, $filetype))
{
    //pernyataan ukuran file yang harus di upload
    if($filesize <= 10000000) //10000000 = 10MB
    {
    	// initialize class
        $image = new Upload($_FILES['file']); 
        
        //file original
        $image->file_new_name_body = substr(sha1(time()), 0, 16).'_O';
        $image->image_convert = 'png';
        $image->process($path_upload);
        $image->processed;

        //untuk output langsung di halaman
        $imagename_1 = $image->file_dst_name; 
                        
        //image resized 200x200 untuk large_foto
        $image->file_new_name_body = substr(sha1(time()), 0, 16).'_P';
        $image->image_resize = true;
        $image->image_convert = 'png';
        $image->image_ratio_x = true;
        $image->image_x = 200;
        $image->image_y = 200;
        $image->process($path_upload);
        $image->processed;

        //untuk output langsung di halaman
        $imagename_2 = $image->file_dst_name; 
        
        //image resized 100 x 100 untuk small_foto
        $image->file_new_name_body = substr(sha1(time()), 0, 16).'_R';
        $image->image_resize = true;
        $image->image_convert = 'png';
        $image->image_x = 100;
        $image->image_y = 100;
        $image->process($path_upload);

		//untuk output langsung di halaman
        $imagename_3 = $image->file_dst_name; 

        if($image->processed) 
        {
            //data json uploding
            $data = [
                'foto_ori'  => $imagename_1,
                'foto_200'  => $imagename_2,
                'foto_100'  => $imagename_3,
            ];
            
            $image->clean();
        } 
        else 
        {
            $data['error'] = true;
        } 
    }
    else
    {
        $data['attempt'] = true; //error ukurun file
    }
}
else
{
    $data['invalid'] = true; //error file tidak valid 
}

echo json_encode($data);

?>