<?php

ob_start();
// php
$title = "Produits";
if (isset($_POST['produit_add_btn'])) {

    $reference = ucfirst(strtolower($_POST['reference']));
    $categorie_id = (int)$_POST['categorie_id'];
    $couleur_id = (int)$_POST['couleur_id'];
    $prix = $_POST['prix'];
    $designation = ucfirst($_POST['designation']);
    $image_name =  basename($_FILES["images_produits"]["name"]);

    $produit = $db->prepare("INSERT INTO produits SET 
        reference = :reference,
        prix = :prix,
        categorie_id = :categorie_id,
        couleur_id = :couleur_id,
        designation = :designation,
        image = :image
");
    $produit->execute(
        [
            'reference' => $reference,
            'prix' => $prix,
            'categorie_id' => $categorie_id,
            'couleur_id' => $couleur_id,
            'designation' => $designation,
            'image' => $image_name
        ]
    );
    $_SESSION['flash']['success'] = "Bien ajouter";

    header('Location: produits');
    exit();
}


if (isset($_POST['produit_update_btn'])) {


    $reference = ucfirst(strtolower($_POST['reference']));
    $prix = $_POST['prix'];
    $designation = ucfirst(strtolower($_POST['designation']));
    $produit_id = (int) $_POST['produit_id'];


    $produit = $db->prepare("UPDATE produits  SET 
    designation = :designation,prix = :prix,reference = :reference,
    updated_at = NOW() WHERE id = $produit_id
");
    $produit->execute(
        [
            'reference' => $reference,
            'prix' => $prix,
            'designation' => $designation

        ]
    );

    $_SESSION['flash']['success'] = 'Bien modifie';
    header('Location: produits');
    die();
}






if (isset($_POST['produit_delete_btn'])) {
    $produit_id = (int) $_POST['produit_id'];
    $produit = $db->prepare("UPDATE produits SET deleted_at = NOW() WHERE id = :produit_id");

    $produit->execute(
        [
            'produit_id' => $produit_id
        ]
    );

    $_SESSION['flash']['success'] = "Bien supprimer";
    header('Location: produits');
    die();
}

$search = '';

if (isset($_POST['rechercher_produit'])) {
    $p = e($_POST['p']);
    $search =  " AND designation LIKE '%" . $p . "%'";
}


$produits = $db->query("SELECT * FROM produits WHERE deleted_at IS NULL $search ORDER BY id DESC")->fetchAll();
$categories = $db->query("SELECT id,nom FROM categories WHERE deleted_at IS NULL ORDER BY id DESC")->fetchAll();
$couleurs = $db->query("SELECT id,nom FROM couleurs WHERE deleted_at IS NULL ORDER BY id DESC")->fetchAll();

$content_php = ob_get_clean();

ob_start(); ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Liste produits</li>
    </ol>
</nav>
<div>

    <form method="post" class="d-flex py-2   col-6 mx-auto">
        <div class="input-group">
            <input type="text" class="form-control me-2 rounded-pill" placeholder="Rechercher:" name="p" value="<?= isset($_POST['p']) ? e($_POST['p']) : '' ?>">
            <button class="btn btn-outline-secondary visually-hidden" type="submit" name="rechercher_produit">Rechercher</button>
        </div>
    </form>
</div>
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
        <?php if (isset($_POST['rechercher_produit']) and !empty($_POST['p'])) : ?>
            <div id="search-message" class="text-danger fw-bold text-center">
                <h4>La liste des produits est filtré par le mot
                    (<?= e($_POST['p']) ?>)
                </h4>
            </div>
        <?php endif ?>
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
                                        <input type="text" class="form-control" name="reference" id="reference" placeholder="Référence:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="designation" class="form-label">Désignation:</label>
                                        <input type="text" class="form-control" name="designation" id="designation" placeholder="Désignation:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="prix" class="form-label">Prix U:</label>
                                        <input type="number" class="form-control" id="prix" name="prix" placeholder="Prix U:">
                                    </div>
                                </div>
                                <!-- col -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="categorie_id" class="form-label">Catégorie:</label>

                                        <select name="categorie_id" id="categorie_id" class="form-select" aria-label="Default select example">
                                            <?php foreach ($categories as $key => $p) : ?>

                                                <option value="<?= $p['id'] ?>"><?= $p['nom'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <!-- mb-3 -->
                                </div>
                                <!-- col -->



                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="couleur_id" class="form-label">Couleur:</label>

                                        <select name="couleur_id" id="couleur_id" class="form-select" aria-label="Default select example">
                                            <?php foreach ($couleurs as $key => $p) : ?>
                                                <option value="<?= $p['id'] ?>"><?= $p['nom'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <!-- mb-3 -->
                                </div>
                                <!-- col -->

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="Photo" class="form-label">Photo:</label>
                                        <input type="file" name="images_produits" id="images_produits" class="form-control">
                                    </div>
                                </div>
                                <!-- col -->
                            </div>
                            <!-- row -->
                        </div>
                        <!-- modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button name="produit_add_btn" type="submit" class="btn btn-primary">
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
                <tr class="table-dark">
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Référence</th>
                    <th>Désignation</th>
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
                        <td><?= $p['reference'] ?></td>
                        <td><?= $p['designation'] ?></td>
                        <td><?= _number_format($p['prix']) ?> DH</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#brand_show_<?= $p['id'] ?>">
                                Afficher
                            </button>

                            <div class="modal fade" id="brand_show_<?= $p['id'] ?>" tabindex="-1" aria-labelledby="brand_show_<?= $p['id'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="brand_show_<?= $p['id'] ?>Label">

                                                Produit info

                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="images/produits/<?= $p['image'] ?>"width="400" alt="">

                                                </div>

                                                <div class="col-md-6">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <b>Id:</b> <?= $p['id'] ?>
                                                        </li>

                                                        <li class="list-group-item">
                                                            <b>Référence:</b> <?= ucfirst($p['reference']) ?>
                                                        </li>


                                                        <li class="list-group-item">
                                                            <b>Prix:</b>
                                                            <span class="fw-bold">
                                                                <?= $p['prix'] ?> DH
                                                            </span>

                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Désignation:</b>
                                                            <p>
                                                                <?= $p['designation'] ?>
                                                            </p>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#brand_update_<?= $p['id'] ?>">
                                Modifier
                            </button>

                            <div class="modal fade" id="brand_update_<?= $p['id'] ?>" tabindex="-1" aria-labelledby="brand_update_<?= $p['id'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="brand_update_<?= $p['id'] ?>Label">
                                                    Modifier la produit
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="designation" class="form-label">Désignation:</label>
                                                            <input type="text" class="form-control" name="designation" id="designation" value="<?= $p['designation'] ?>" placeholder="Désignation:">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="prix" class="form-label">Prix U:</label>
                                                            <input type="number" class="form-control" id="prix" value="<?= $p['prix'] ?>" name="prix" placeholder="Prix U:">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="reference" class="form-label">Référence:</label>
                                                            <input type="text" class="form-control" name="reference" id="reference" value="<?= $p['reference'] ?>" placeholder="Référence:">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input name="produit_id" type="hidden" value="<?= $p['id'] ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                <button name="produit_update_btn" type="submit" class="btn btn-primary">
                                                    Modifier
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#brand_delete_<?= $p['id'] ?>">
                                Supprimer
                            </button>

                            <div class="modal fade" id="brand_delete_<?= $p['id'] ?>" tabindex="-1" aria-labelledby="brand_delete_<?= $p['id'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="brand_delete_<?= $p['id'] ?>Label">
                                                    Supprimer la produit
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <h5 class="text-danger">Voulez vous vraiment supprimer <?= $p['id'] ?> ?</h5>
                                                <input name="produit_id" type="hidden" value="<?= $p['id'] ?>">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                <button name="produit_delete_btn" type="submit" class="btn btn-danger">
                                                    Supprimer
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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