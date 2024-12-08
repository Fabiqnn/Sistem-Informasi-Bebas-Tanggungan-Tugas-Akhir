<?php
    if(isset($_POST['submit'])) {
        $files = array(
            'laporan-ta' => $_FILES['laporan-ta'],
            'program-ta' => $_FILES['program-ta'],
            'publikasi' => $_FILES['publikasi']
        );

        $allowedExtention = array("pdf", "zip", "rar");
        
        foreach ($files as $key => $file) {
            $fileNameParts = explode('.', $file['name']);
            $fileExtention = strtolower(end($fileNameParts));
            $fileSize = $file['size'];
            $fileTmp = $file['tmp_name'];

            if (in_array($fileExtention, $allowedExtention)) {
                if ($fileSize < 50000000) {
                    $fileNameNew = uniqid('', true). "." . $fileExtention;
                    move_uploaded_file($fileTmp, "../uploaded-file/form-ta".$fileNameNew);
                    
                } else {
                    echo "Ukuran File $key Terlalu Besar";
                    exit();
                }
            } else {
                echo "Tipe File $key Tidak Diizinkan";
                exit();
            }
        }
    }
?>