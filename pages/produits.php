<?php

ob_start();
// php
$title = "Produits";
// $uploadOk = true;
$errors = [];

if (isset($_POST['add_product'])) {

    $image_name = $_FILES["image"]["name"];
    $image_type = $_FILES["image"]["type"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_error = $_FILES["image"]["error"];
    $image_size = $_FILES["image"]["size"];

    $target_dir = "images/produits/";
    $target_file = $target_dir . basename($image_name);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $extention_autoriser = ['jpg', 'jpeg', 'png'];

    if (!in_array($imageFileType, $extention_autoriser)) {

        $errors[] = "Ce fichier n'est pas autorisé ";
        // echo "Ce fichier n'est pas autorisé ";
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        // $uploadOk = false;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        // echo " Sorry, file already exists.";
        $errors[] = "Sorry, file already exists.";

        // $uploadOk = false;
    }

    // Check file size
    if ($image_size > 500000) {
        $errors[] = "Sorry, your file is too large.";

        // echo "Sorry, your file is too large.";
        // $uploadOk = false;
    }

    // if ($uploadOk == true) {
    //     move_uploaded_file($image_tmp_name, $target_file);
    //     echo "The file " . htmlspecialchars(basename($image_name)) . " has been uploaded.";
    // } else {
    //     echo "Sorry, there was an error uploading your file.";
    // }

    // $text = 'Hind';

    // $text .= ' OHC';
    // $text = ' ZZZ';

    // echo $text;
    // exit();
    if (empty($errors)) {
        move_uploaded_file($image_tmp_name, $target_file);
        $_SESSION['flash']['info'] = 'Bien ajouter';
    } else {
        $error_message = '';
        foreach ($errors as $key => $e) {
            $error_message  .= $e;
            $error_message  .= "<br>";
        }
        $_SESSION['flash']['danger'] = $error_message;
    }





    $reference = e($_POST['reference']);
    $designation = e($_POST['designation']);
    $prix = set_price($_POST['prix_u']);
    $categorie_id = (int)$_POST['categorie_id'];
    $couleur_id = (int)$_POST['couleur_id'];

    $produit = $pdo->prepare("INSERT INTO produits SET image = :image, reference = :reference, designation = :designation,prix = :prix,categorie_id = :categorie_id, couleur_id = :couleur_id ");

    $produit->execute(
        [
            'image' => $image_name, 'reference' => $reference, 'designation' => $designation, 'prix' => $prix, 'categorie_id' => $categorie_id, 'couleur_id' => $couleur_id
        ]
    );

    if ($produit) {
        $_SESSION['flash']['info'] = 'Bien ajouter';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: produits');
    exit();
}

// $produits = $pdo->query("SELECT
// p.*,
// c.nom As categorie_nom,
// cl.nom As couleur_nom
// FROM produits p
// INNER JOIN categories c ON c.id = p.categorie_id
// INNER JOIN couleurs cl ON cl.id = p.couleur_id
// WHERE p.deleted_at IS NULL
// ORDER BY p.id;")->fetchAll();

$categories = $pdo->query("SELECT * FROM categories WHERE deleted_at IS NULL")->fetchAll();
$couleurs = $pdo->query("SELECT * FROM couleurs WHERE deleted_at IS NULL")->fetchAll();
$produits = $pdo->query("SELECT * FROM produits_view")->fetchAll();


$content_php = ob_get_clean();

ob_start(); ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Liste produits</li>
    </ol>
</nav>

<h4 class="fw-bold mb-3">Liste produits</h4>

<div class="card">
    <div class="card-header">
        <h6 class="fw-bold">
            Liste produits
        </h6>
    </div>
    <!-- card-header -->
    <div class="card-body">


        <button type="button" class="btn btn-primary mb-3 fw-bold" data-bs-toggle="modal" data-bs-target="#add_produit">
            Ajouter un produits
        </button>

        <div class="modal fade" id="add_produit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">
                            Ajouter produits
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="reference" class="form-label">Référence:</label>
                                        <input type="text" class="form-control" id="reference" name="reference" placeholder="Référence:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="designation" class="form-label">Désignation:</label>
                                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Désignation:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="prix_u" class="form-label">Prix U:</label>
                                        <input type="number" class="form-control" id="prix_u" name="prix_u" placeholder="Prix U:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="categorie_id" class="form-label">
                                            Catégories:
                                        </label>

                                        <select name="categorie_id" class="form-select">
                                            <?php foreach ($categories as $key => $c) : ?>
                                                <option value="<?= $c['id'] ?>">
                                                    <?= ucwords($c['nom']) ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- col -->



                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="couleur_id" class="form-label">
                                            Couleurs:
                                        </label>

                                        <select name="couleur_id" class="form-select">
                                            <?php foreach ($couleurs as $key => $c) : ?>
                                                <option value="<?= $c['id'] ?>">
                                                    <?= ucwords($c['nom']) ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>

                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="Photo" class="form-label">Photo:</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                <!-- col -->
                            </div>
                            <!-- row -->
                        </div>
                        <!-- modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" name="add_product" class="btn btn-primary">
                                Ajouter
                            </button>
                        </div>
                        <!-- modal-footer -->
                    </form>

                </div>
                <!-- modal-content -->
            </div>
            <!-- modal-dialog -->
        </div>
        <!-- modal -->

        <table class="table table-sm table-bordered">
            <thead>
                <tr class="table-light">
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Référence</th>
                    <th>Désignation</th>
                    <th>Catégorie</th>
                    <th>Prix U</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $key => $p) : ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td>
                            <img src="images/produits/<?= $p['image'] ?>" width="30" alt="">
                        </td>
                        <td><?= ucwords($p['reference'], '-') ?></td>
                        <td><?= ucwords($p['designation']) ?> - <?= ucwords($p['couleur_nom']) ?></td>
                        <td><?= ucwords($p['categorie_nom']) ?></td>
                        <td><?= $p['prix_decimale'] ?> DH</td>
                        <td>
                            <a href="" class="btn btn-link btn-sm">Afficher</a>
                            <a href="" class="btn btn-link btn-sm">Modifier</a>
                            <a href="" class="btn btn-link btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach ?>


            </tbody>
        </table>

    </div>
    <!-- card-body -->
</div>
<!-- card -->

<?php $content_html = ob_get_clean(); ?>