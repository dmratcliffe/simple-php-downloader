var breadcrumbs = [];
var prevent_tr_click = false;
var cur_path_json;

$(document).ready(function(){
    files_json = $(".file-json").html();
    files_json = JSON.parse(files_json);

    //initial table
    update_table(files_json);

    //the .. folder
    $(document).on("click", "#up", function(data){
        breadcrumbs.pop(); //the last breadcrumb is where we currently are, pop it first...
        update_table(breadcrumbs.pop());
    });

    //the download function
    $(document).on("click", ".icon", function (data){
        curTar = data.currentTarget;
        curId = curTar.id;
        fpath = $(curTar.innerHTML).html(); //TODO find a better way

        downloadpath = "./assets/php/dwn.php?path=" + fpath;
        if(fpath){
            window.open(downloadpath);
        }
        //TODO this isn't a great way of blocking a click...
        prevent_tr_click = true;
        setTimeout(() => {
            prevent_tr_click = false;
        }, 10);
 
    });

    //the navigation function
    $(document).on("click", "tbody tr", function(data){
        if(prevent_tr_click)
            return;
        curTar = data.currentTarget;
        curId = curTar.id;
        new_folder_index = curId.substring(0, curId.length - 2);
        if(curId.includes("f")){
            update_table(cur_path_json.items[new_folder_index]);
        }
    });
});

function update_table(fjson){
    cur_path_json = fjson;
    breadcrumbs.push(fjson);
    set_path(fjson.path);

    table = $(".ftable");
    table.html("");

    //if we're at the root
    if (breadcrumbs.length > 1) {
        folder = "<tr class='fldr' id='up'><td><center><i class='icon fas fa-folder'></i></center></td><td class='item-name'>..</td></tr>";
        table.append(folder);
    }

    //TODO sorting functionality

    //get the items of the folder we've been given
    items = fjson.items;
    //create the folders
    $.each(items, function(index, value){
        value.id = index;
        if(value.type == "folder"){
            table.append(create_folder(value));
        }
    });
    //create the files
    $.each(items, function(index, value){
        if(value.type == "file"){
            table.append(create_file(value));
        }
    });

}

function set_path(path){
    $(".cur-path").html(path);
}

function create_folder(item){
    //self explanatory
    name = item.name;
    id = item.id;
    //this path will be inside the icon element, it's what we will use to download the file
    path = item.path;

    folder = "<tr class='fldr' id='" + id + " f'><td><center><i class='icon fas fa-folder'><div style='display: none' id='path'>" + path + "</div></i></center></td><td class='item-name'>" + name + "</td></tr>";
    return folder;
}

function create_file(item){
    name = item.name;
    ext = name.split(".");
    ext = ext[ext.length -1];
    path = item.path;

    file = "<tr id=''><td><center><i class='icon fas fa-file-alt " + ext + "'><div style='display: none' id='path'>" + path + "</div></i></center></td><td class='item-name'>" + name + "</td></tr>";

    return file;

}