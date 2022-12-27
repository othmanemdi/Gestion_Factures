<?php

ob_start();
// php
$title = "Commandes";

if (!isset($_GET['id'])) {
    $_SESSION['flash']['danger'] = 'Commande id introuvable';
    header('Location: commandes');
    exit();
}

$commande_id = (int)$_GET['id'];

if ($commande_id <= 0) {
    $_SESSION['flash']['danger'] = 'Commande id invalide';
    header('Location: commandes');
    exit();
}


if (isset($_POST['product_add'])) {

    $produit_id = (int)$_POST['produit_id'];
    $quantite = (int)$_POST['quantite'];

    if ($quantite <= 0) {
        $_SESSION['flash']['danger'] = 'Error quantité !!!';
    }


    $req = $pdo->prepare("INSERT INTO commande_produit SET
     commande_id = :commande_id,
      produit_id = :produit_id,
      quantite = :quantite");

    $req->execute(
        [
            'commande_id' => $commande_id,
            'produit_id' => $produit_id,
            'quantite' => $quantite
        ]
    );

    if ($req) {
        $_SESSION['flash']['info'] = 'Bien ajouter';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: commande_afficher&id=' . $commande_id);
    exit();
}





$commande = $pdo->prepare("SELECT id FROM commandes WHERE id = :commande_id limit 1");

$commande->execute(
    [
        'commande_id' => $commande_id
    ]
);

if (!$commande->fetch()) {
    $_SESSION['flash']['danger'] = 'Id introuvable dans la base de données';
    header('Location: commandes');
    exit();
}

$commande = $pdo->query("SELECT * FROM commandes_view WHERE id = $commande_id LIMIT 1")->fetch();




$commande_produits_req = $pdo->prepare("SELECT * FROM commande_produits_view WHERE commande_id = :commande_id ORDER BY id DESC");

$commande_produits_req->execute(
    [
        'commande_id' => $commande_id
    ]
);

$commande_produits = $commande_produits_req->fetchAll();


$produits = $pdo->query("SELECT id,reference FROM produits ORDER BY id DESC")->fetchAll();

$qt_total = $prix_total = 0;

$content_php = ob_get_clean();


ob_start(); ?>



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item"><a href="dashboard">Liste commandes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Détails de commande</li>
    </ol>
</nav>

<h4 class="fw-bold mb-3">Détails de la commande N° <?= $commande['commande_num'] ?></h4>




<div class="card">
    <div class="card-header">
        <h6 class="fw-bold">
            Détails de la commande N° <?= $commande['commande_num'] ?>
        </h6>
    </div>
    <!-- card-header -->
    <div class="card-body">

        <dl class="row">
            <dt class="col-sm-3">Numéro de commande</dt>
            <dd class="col-sm-9"><?= $commande['commande_num'] ?></dd>

            <dt class="col-sm-3">Date de commande</dt>
            <dd class="col-sm-9"><?= $commande['date_commande_format'] ?></dd>


            <dt class="col-sm-3">Client</dt>
            <dd class="col-sm-9"><?= ucwords($commande['client_nom']) ?></dd>


        </dl>

        <button type="button" class="btn btn-outline-dark mb-3 fw-bold" data-bs-toggle="modal" data-bs-target="#add_product">
            Ajouter un produits
        </button>

        <div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Associer un produit
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="produit_id" class="form-label">Produits</label>
                                        <select name="produit_id" id="produit_id" class="form-control">
                                            <?php foreach ($produits as $key => $p) : ?>
                                                <option value="<?= $p['id'] ?>"><?= ucwords($p['reference'], '-') ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <!-- mb-3 -->
                                </div>
                                <!-- col -->

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="quantite" class="form-label">Quantité</label>
                                        <input type="number" class="form-control" name="quantite" id="quantite" placeholder="Quantité:" value="1">
                                    </div>
                                    <!-- mb-3 -->
                                </div>
                                <!-- col -->
                            </div>
                            <!-- row -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" name="product_add" class="btn btn-primary">Associer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <button type="button" class="btn btn-outline-dark mb-3 fw-bold">
            PDF
        </button>

        <button type="button" class="btn btn-outline-dark mb-3 fw-bold">
            Excel
        </button>


        <table class="table table-sm table-bordered">
            <thead>
                <tr class="table-light">
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Référence</th>
                    <th>Désignation</th>
                    <th>Prix U</th>
                    <th>Quantité</th>
                    <th>Prix Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commande_produits as $key => $p) : ?>

                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td>
                            <img src="images/produits/<?= $p['image'] ?>" width="30" alt="">
                        </td>
                        <td><?= ucwords($p['reference'], '-') ?></td>
                        <td><?= ucwords($p['designation']) ?> - <?= ucwords($p['couleur_nom']) ?> <?= ucwords($p['categorie_nom']) ?></td>
                        <td><?= $p['prix_decimale'] ?> DH</td>
                        <td><?= $p['quantite'] ?></td>
                        <td><?= $p['prix_total'] ?> DH</td>
                        <td>
                            <a href="" class="btn btn-link btn-sm">Modifier</a>
                        </td>
                    </tr>

                    <?php
                    $qt_total += $p['quantite'];
                    $prix_total += get_price($p['prix'], $p['quantite']);

                    ?>
                <?php endforeach ?>


            </tbody>
        </table>

        <div class="d-flex flex-row-reverse">
            <div>
                <table class="table table-bordered">
                    <tr>
                        <th>Quantité total:</th>
                        <td><?= $qt_total ?> Quantité<?= $qt_total > 1 ? 's' : '' ?></td>
                    </tr>

                    <tr>
                        <th>Prix total:</th>
                        <td><?= _number_format($prix_total) ?> DH</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
    <!-- card-body -->
</div>
<!-- card -->



<?php $content_html = ob_get_clean(); ?>