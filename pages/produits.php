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

$produits = $db->query("SELECT * FROM produits ORDER BY id DESC")->fetchAll();
$categories = $db->query("SELECT id,nom FROM categories ORDER BY id DESC")->fetchAll();
$couleurs = $db->query("SELECT id,nom FROM couleurs ORDER BY id DESC")->fetchAll();

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
                                            <?php foreach ($categories as $key => $m) : ?>

                                                <option value="<?= $m['id'] ?>"><?= $m['nom'] ?></option>
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
                                            <?php foreach ($couleurs as $key => $m) : ?>
                                                <option value="<?= $m['id'] ?>"><?= $m['nom'] ?></option>
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
                <?php foreach ($produits as $key => $m) : ?>
                    <tr>
                        <td><?= $m['id'] ?></td>
                        <td>
                            <img src="images/produits/<?= $m['image'] ?>" width="30" alt="">
                        </td>
                        <td><?= $m['reference'] ?></td>
                        <td><?= $m['designation'] ?></td>
                        <td><?=_number_format($m['prix']) ?> DH</td>
                        <td>
                            <a href="commande_afficher" class="btn btn-primary btn-sm">Afficher</a>
                            <a href="" class="btn btn-dark btn-sm">Modifier</a>
                            <a href="" class="btn btn-danger btn-sm">Supprimer</a>
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