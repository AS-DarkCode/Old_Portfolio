<?php
require 'db_con.php';

session_start();

if (!isset($_SESSION['user_session'])) {
    header('Location: login.php');
    exit;
}
// echo"<pre>";
// print_r($_SESSION['name']);
// exit;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Welcome 🫶🏻 ";echo $_SESSION['name'] ?? 'ლ'; ?></title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>


    <div data-popover id="popover-default" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
        <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
            <h3 class="font-semibold text-gray-900 dark:text-white">ლ❤️‍🩹<?php echo $_SESSION['name'] ?? 'ლ';?>👨‍💻❣</h3>
        </div>
        <div class="px-3 py-2">
            <p>And here's some amazing content. It's very engaging. Right?</p>
        </div>
        <div data-popper-arrow></div>
    </div>

    <div data-popover id="popover-default2" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
        <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
            <h3 class="font-semibold text-gray-900 dark:text-white">Popover title</h3>
        </div>
        <div class="px-3 py-2">
            <p>Hello Ji</p>
        </div>
        <div data-popper-arrow></div>
    </div>

    <div data-popover id="popover-default3" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
        <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
            <h3 class="font-semibold text-gray-900 dark:text-white">Popover title</h3>
        </div>
        <div class="px-3 py-2">
            <p>Hello Ji Kese ho</p>
        </div>
        <div data-popper-arrow></div>
    </div>


    <section>
        <ul class="circles">
            <li> <button data-popover-target="popover-default" type="button" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Click
                    Me</button></li>

            <li> <button data-popover-target="popover-default2" type="button" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Click
                    Me</button></li>
            <li> <button data-popover-target="popover-default3" type="button" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Click
                    Me</button></li>

            <li>            <a href="https://wa.me/917900360024?text=hii! What's up?;."><button id="yesButton" type="button" onclick="showMessage('I\'m waiting on WhatsApp')">WhatsApp</button></a>
</li>
            <li>            <button id="noButton" onmouseover="moveButton()" style="color: black;">No Thanks</button>
</li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li>Hello</li>
            <li>Medam Ji</li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <form>
            <!-- <a href="https://wa.me/917900360024?text=hii! What's up?;."><button id="yesButton" type="button" onclick="showMessage('I\'m waiting on WhatsApp')">WhatsApp</button></a> -->
            <!-- <button id="noButton" onmouseover="moveButton()" style="color: black;">No Thanks</button> -->
        </form>
    </section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</html>