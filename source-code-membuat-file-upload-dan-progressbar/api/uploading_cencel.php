<?php

$filename = $_POST['file'];

foreach ($filename as $key => $value) 
{
	if(file_exists('../foto/' . $value)) {
        // hapus file dalam folder
        unlink('../foto/' . $value); 
        // respons
        $respons = [
            'path' 		=> 'foto/' . $value,
            'message' 	=> 'Anda Berhasil Menghapus',
            'error' 	=> false,
            'success' 	=> true
        ];
    } else {
        // respons
        $respons = [
            'path' 		=> 'foto/' . $value,
            'message' 	=> 'Maaf File Tidak Ditemukan',
            'error' 	=> true,
            'success' 	=> false
        ];
    }
}
echo json_encode($respons);

?>