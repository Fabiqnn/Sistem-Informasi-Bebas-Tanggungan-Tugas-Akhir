<?php
    $baseDir = "../uploaded-file/form-ta/";

    if (isset($_GET['file'])) {
        $fileName = $_GET['file'];

        $filePath = $baseDir . $fileName;

        if (file_exists($filePath)) {
            
            $mimeType = mime_content_type($filePath);

            header("Content-type: " . $mimeType);
            header("Content-disposition: attachment; filename=\"$fileName\"");

            readfile("../uploaded-file/form-ta/" .$fileName);
        } else {
            echo "File Tidak Ditemukan ";
            echo $filePath;
        }
    } else {
        echo "File Tidak Diinisiasikan";
    }
?>