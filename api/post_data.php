<?php


include "config.php";
    //file upload path
        $targetDir = "uploads/";
        $fileName = basename($_FILES["foto_siswa"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            //allow certain file format
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if(in_array($fileType, $allowTypes)){
                //upload file to serve
                if(move_uploaded_file($_FILES["foto_siswa"]["tmp_name"], $targetFilePath)){
                    //insert image file name info database
                    $insert = mysqli_query($kon, "INSERT INTO tbl_mahasiswa (
                        `kd`, `npm`, `nama_mahasiswa`, `jenis_kelamin`, `jurusan`, `foto_mahasiswa`) 
                        VALUES (
                            '',
                            '$_POST[npm]',
                            '$_POST[nama_mahasiswa]',
                            '$_POST[jenis_kelamin]',
                            '$_POST[jurusan]',
                            '$fileName')");

if($insert){
    $result = json_encode(array('error'=>false, 'msg'=>'Data Berhasil Disimpan'));
}else{
    $result = json_encode(array('error'=>true, 'msg'=>'Data Gagal Disimpan'));
}

echo $result;
                }else{
                    $result = json_encode(array('error'=>true, 'msg'=> 'Data Gagal Disimpan'));
                    echo $result;
                }
            }


