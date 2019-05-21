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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>
    <div class="file-json" style='display: none;'>
        <?php
            if($isauth){
                //todo: recursive file search
            }
        ?>
    </div>
    <div class="login" <?php if($isauth) { echo "style='display: none;'"; } ?>>
        <div class="portal">
            <center>
                file server
                <h1>enter passphrase</h1>
                <form method="post" action="./assets/php/auth.php">
                    <input type="password" class="text-in" name="passphrase" type="password">
                    <br>
                    <input type="submit" class="btn" value="login">
                </form>
            </center>

        </div>
    </div>
    <div class="files" <?php if(!$isauth) { echo "style='display: none;'"; } ?>>
        <div class="cur-path">
        /this/is/your/current/path
        </div>
        <table>
            <table>
                <tbody class="files">
                    <tr id="fldr" class="fldr">
                        <td>
                            <center><i class="icon fas fa-folder"></i></center>
                        </td>
                        <td>Example Name</td>
                    </tr>
                    <tr id="fl">
                        <td>
                            <center><i class="icon fas fa-file-alt"></i></center>
                        </td>
                        <td class="item-name">Example Name</td>
                    </tr>
                    <tr id="fl">
                        <td>
                            <center><i class="icon fas fa-file-alt css"></i></center>
                        </td>
                        <td class="item-name">style.css</td>
                    </tr>
                    <tr id="fl">
                        <td>
                            <center><i class="icon fas fa-file-alt js"></i></center>
                        </td>
                        <td class="item-name">script.js</td>
                    </tr>
                    <tr id="fl">
                        <td>
                            <center><i class="icon fas fa-file-alt html"></i></center>
                        </td>
                        <td class="item-name">page.html</td>
                    </tr>

                </tbody>
            </table>
        </table>
    </div>
</body>

</html>