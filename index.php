<?php

// var_dump(dirname(__DIR__) . DIRECTORY_SEPARATOR);
// die();

if (isset($_GET['page'])) {
    $get_page = htmlspecialchars(trim($_GET['page']));
} else {
    // echo "Error";
    // die();
    $get_page = "home";
}

$pages_exp = explode('/', $get_page);

$page = $get_page;
$pages = scandir('pages/');
$directory = 'pages/';

// echo $page;
// die();

require_once "database/db.php";
require_once "helpers/functions.php";
$page_file = $page . ".php";

// $pages = $admin ? scandir('pages/admin/') : scandir('pages/');

if (in_array($page_file, $pages)) {
    require_once $directory . $page_file;
} else {
    require_once $directory . '404.php';
}

// echo $page_file;
// die();
echo $content_php ?? "";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php require_once "pages/body/head.php" ?>

    <?= $content_css ?? ""; ?>

    <?php require_once "pages/body/script.php" ?>
</head>

<body class="bg-light">
    <header>
        <?php require_once "pages/body/nav.php" ?>
    </header>


    <main class="container mt-4">
        <section>

            <?php if (isset($_SESSION['flash'])) : ?>
                <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                    <div class="alert alert-<?= $type; ?> mt-3">
                        <?= $message; ?>
                    </div>
                <?php endforeach; ?>
                <?php unset($_SESSION['flash']); ?>
            <?php endif; ?>
        </section>

        <section>
            <?= $content_html ?? "" ?>
        </section>
    </main>

    <footer>

    </footer>
    <?= $content_js ?? ""; ?>

    <?php require_once "pages/body/footer.php" ?>

</body>

</html>