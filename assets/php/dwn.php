<?php
    include('auth.php');

    if($isauth && $path){
       download($path);
    }else{
        echo "error";
    }

    //most of this code is just a hodgepodge of stack overflow because I suffered a lot zipping files... 
    //(Found out later that I hadn't installed the right version of the zip extension...)


    function download($path){
        $has_zip = 0;
        if(is_dir($path)){
            $path = zip($path);
            $has_zip = 1;
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/force-download');
        header("Content-Disposition: attachment; filename=\"" . basename($path) . "\";");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        ob_clean();
        flush();
        readfile($path); //showing the path to the server where the file is to be download
        
        if($has_zip){
            register_shutdown_function('unlink', $path);
            ignore_user_abort(true);
            if (connection_aborted()) {
                unlink($path);
            }
            unlink($path);
        }
    }

    function zip($path){
        $folder_name = basename($path);
        $zip_path = "./temp/$folder_name.zip";

        $dir = $path;
        $zip_file = $zip_path;

        // Get real path for our folder
        $rootPath = realpath($dir);

        // Initialize archive object
        $zip = new ZipArchive();
        $res = $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();

        return $zip_path;
    }
?>