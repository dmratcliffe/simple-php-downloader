<?php
    function rec_search($dir){
        global $do_not_scan;
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
                $fullpath = "$parent/$filename";
                $filetype = "file";

                //do not scan list
                if(in_array($fullpath, $do_not_scan)){
                    continue;
                }

                $fileinfo = array(
                    "name" => $filename,
                    "type" => $filetype,
                    "path" => $fullpath,
                    "parent" => $parent
                );

                //a folder we will need more information
                if(is_dir($fullpath)){
                    //change the filetype
                    $filetype = "folder";
                    $fileinfo['type'] = $filetype;
                    //fetch the items in the folder
                    $fileinfo["items"] = rec_search($fullpath);
                }

                $files[] = $fileinfo;
            }
        }
        return $files;
    }
?>