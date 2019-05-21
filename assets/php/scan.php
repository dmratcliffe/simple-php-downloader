<?php
    function rec_search($dir){
        $files = array();
        if(file_exists($dir)){
            $dirlisting = scandir($dir);
            foreach($dirlisting as $file){

                //skip hiddent and special paths
                if(!$file || $file[0] == '.'){
                    continue;
                }

                //info about the file
                $parent = $dir;
                $filename = $file;
                $filepath = "$parent/$filename";
                $filetype = "file";

                $fileinfo = array(
                    "name" => $filename,
                    "type" => $filetype,
                    "path" => $filepath,
                    "parent" => $parent
                );

                //a folder we will need more information
                if(is_dir($filepath)){
                    //change the filetype
                    $filetype = "folder";
                    $fileinfo['type'] = $filetype;
                    //fetch the items in the folder
                    $fileinfo["items"] = rec_search($filepath);
                }

                $files[] = $fileinfo;
            }
        }
        return $files;
    }
?>