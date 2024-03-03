<?php
include 'config.php';


function downloadSignaturePhotos($imageUrls, $folderName) {
    
    if (!is_dir($folderName)) {
        mkdir($folderName);
    }

   
    foreach ($imageUrls as $imageUrl) {
        $fileName = basename($imageUrl);
        $filePath = $folderName . '/' . $fileName;
        file_put_contents($filePath, file_get_contents($imageUrl));
    }

  
    $zipFile = $folderName . '.zip';
    $zip = new ZipArchive();
    if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folderName),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folderName) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
    }

    
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $zipFile);
    header('Content-Length: ' . filesize($zipFile));
    readfile($zipFile);

    
    unlink($zipFile);
}


$sql = "SELECT signature FROM households";
$result = $conn->query($sql);

$imageUrls = array();
while ($row = $result->fetch_assoc()) {
    if (!empty($row['signature'])) {
        $imageUrls[] = $row['signature'];
    }
}


downloadSignaturePhotos($imageUrls, 'signature_photos');
