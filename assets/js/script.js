var history = [];
var prevent_tr_click = false;

$(document).ready(function(){
    files_json = $(".file-json").html();
    files_json = JSON.parse(files_json);

    update_table(files_json);

    $(document).on("click", ".icon", function (data){
        curTar = data.currentTarget;
        curId = curTar.id;
        fpath = $(curTar.innerHTML).html(); //TODO find a better way

        downloadpath = "./php/dwn.php?path=" + fpath;
        if(fpath){
            window.open(downloadpath);
        }
        prevent_tr_click = true;
        setTimeout(() => {
            prevent_tr_click = false;
        }, 10);

    });
});

function update_table(fjson){
    //history.push(fjson);
    console.log(fjson);
    set_path(fjson.parent);

    table = $(".ftable");
    table.html("");

    //if we're at the root
    if (history.length > 1) {
        folder = "<tr class='fldr' id='up'><td><center><i class='icon fas fa-folder'></i></center></td><td class='item-name'>..</td></tr>";
        table.append(folder);
    }

    items = fjson.items;
    $.each(items, function(index, value){
        value.id = index;
        if(value.type == "folder"){
            table.append(create_folder(value));
        }
    });
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