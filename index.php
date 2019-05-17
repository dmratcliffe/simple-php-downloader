<?php
    include('assets/php/auth.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        File Downloader
    </title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>
    <div class="file-json" style='display: none;'>
        <?php
                if(isauth){
                    //todo: recursive file search
                }
            ?>
    </div>
    <div class="login" <?php if(!isauth) { echo "style='display: none;'"; } ?>>
        <div class="portal">
            <center>
                File Server
                <h1>Login</h1>
                <form mehtod="post">
                    <input type="text" class="text-in" name="passphrase">
                    <br>
                    <input type="submit" class="btn" value="login">
                </form>
            </center>

        </div>
    </div>
    <div class="files" <?php if(isauth) { echo "style='display: none;'"; } ?>>
        woop
    </div>
</body>

</html>