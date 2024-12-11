<?php
    session_start();

    $role = $_SESSION['role'];

    $baseDirTA = "../uploaded-file/form-ta/";
    $baseDirProdi = "../uploaded-file/form-prodi/";
    $baseDirPustaka = "../uploaded-file/form-pustaka/";



    if ($role === "Admin TA") {
        if (isset($_GET['file'])) {
            $fileName = $_GET['file'];
    
            $filePath = $baseDirTA . $fileName;
    
            if (file_exists($filePath)) {
                
                $mimeType = mime_content_type($filePath);
    
                header("Content-type: " . $mimeType);
                header("Content-disposition: attachment; filename=\"$fileName\"");
    
                readfile("../uploaded-file/form-ta/" .$fileName);
            } else {
                echo "File Tidak Ditemukan ";
                echo $filePath;
                echo $role;
            }
        } else {
            echo "File Tidak Diinisiasikan";
        } 
    } else if ($role ==="Admin Prodi") {
        if (isset($_GET['file'])) {
            $fileName = $_GET['file'];
    
            $filePath = $baseDirProdi . $fileName;
    
            if (file_exists($filePath)) {
                
                $mimeType = mime_content_type($filePath);
    
                header("Content-type: " . $mimeType);
                header("Content-disposition: attachment; filename=\"$fileName\"");
    
                readfile("../uploaded-file/form-prodi/" .$fileName);
            } else {
                echo "File Tidak Ditemukan ";
                echo $filePath;
                echo $role;
            }
        } else {
            echo "File Tidak Diinisiasikan";
        } 
    } else if ($role === "Admin Pustaka") {
        if (isset($_GET['file'])) {
            $fileName = $_GET['file'];
    
            $filePath = $baseDirPustaka . $fileName;
    
            if (file_exists($filePath)) {
                
                $mimeType = mime_content_type($filePath);
    
                header("Content-type: " . $mimeType);
                header("Content-disposition: attachment; filename=\"$fileName\"");
    
                readfile("../uploaded-file/form-pustaka/" .$fileName);
            } else {
                echo "File Tidak Ditemukan ";
                echo $filePath;
                echo $role;
            }
        } else {
            echo "File Tidak Diinisiasikan";
        } 
    }
    


    
?>