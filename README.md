# simple-php-downloader
A self hosted website which allows downloading files from your webserver

# the risks involved
by installing this script on a public webserver all of your files only become as safe as your password.
You should make sure it's strong or you only expose this file when you need to download files from your server.

*Currently the script has no form of kicking a user off for entering new passwords, and when a user logs in their password hash is saved for 24hrs in a cookie.* 
**Use long safe passwords.**

# the reason this exists
I needed something to quickly download folder while useing code-server.
By default code-server lets you download individual files but this didn't work so well for larger files.
Looking around most file managers require a lot of backend or don't have folder downloading for some reason.

This aims to fill the hole of downloading files and folders from a website, nothing more. (No uploading ect.)

# setup
Create a file in /assets/php named 'settings.php'
The format should be like:
'''php
<?php
    $master_password = "ushldchngths";
    $dir = "/the/dir/to/scan/on/your/server";
    $do_not_scan = array(
        "/path/you/dont/want/indexed",
        "/djkalid/another/one"
    );
?>
'''
The settings should be pretty self explanatory.

You'll also need to make sure that the temp directory in the /assets/php folder is chmod'd to give php rwx. this is for the zipping of the directories. 