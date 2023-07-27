<?php
session_start();
include 'assets/checks.php';
include 'assets/config.php';
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <!-- META -->
    <title>
        <?php echo $title ?>
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico" />

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/tailwind.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>

<body>
    <img src="./assets/img/wotlk-bg.jpg" class="bg_img">
    <video autoplay muted loop id="myVideo">
        <source src="./assets/img/wotlk-bg.mp4" type="video/mp4">
    </video>
    <div class="grid h-screen place-items-center">
        <div class="flex justify-center">
            <div class="rounded-lg shadow-lg bg-white max-w-sm dark:bg-slate-800">
                <div class="p-6">
                    <div class="flex justify-center"><img src="./assets/img/wotlk-logo.png"></div>
                    <div class="flex justify-center">
                        <h5 class="text-gray-900 text-xl font-medium mb-2 dark:text-white">
                            <?php totalCh(); ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
</body>

</html>