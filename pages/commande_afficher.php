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

if (isset($_POST['product_update'])) {


    $commande_produit_id = (int)$_POST['commande_produit_id'];
    $quantite = (int)$_POST['quantite'];

    if ($quantite <= 0) {
        $_SESSION['flash']['danger'] = 'Error quantité !!!';
    }


    $req = $pdo->prepare("UPDATE commande_produit SET
      quantite = :quantite
      WHERE id = :commande_produit_id
      ");

    $req->execute(
        [
            'quantite' => $quantite,
            'commande_produit_id' => $commande_produit_id,
        ]
    );

    if ($req) {
        $_SESSION['flash']['info'] = 'Bien modifer';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: commande_afficher&id=' . $commande_id);
    exit();
}



$commande = $pdo->prepare("SELECT * FROM commandes_view WHERE id = :commande_id limit 1");

$commande->execute(
    [
        'commande_id' => $commande_id
    ]
);

$commande = $commande->fetch();
if (!$commande) {
    $_SESSION['flash']['danger'] = 'Id introuvable dans la base de données';
    header('Location: commandes');
    exit();
}


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




<div class="card <?= $commande['status_id'] == 4 ? 'border-danger' : '' ?>">
    <div class="card-header">
        <h6 class="fw-bold">
            Détails de la commande N° <?= $commande['commande_num'] ?>
        </h6>
    </div>
    <!-- card-header -->
    <div class="card-body">

        <dl class="row">
            <dt class="col-sm-3">Numéro de commande:</dt>
            <dd class="col-sm-9"><?= $commande['commande_num'] ?></dd>

            <dt class="col-sm-3">Date de commande:</dt>
            <dd class="col-sm-9"><?= $commande['date_commande_format'] ?></dd>


            <dt class="col-sm-3">Client:</dt>
            <dd class="col-sm-9"><?= ucwords($commande['client_nom']) ?></dd>


            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9">
                <span class="badge bg-<?= $commande['status_color'] ?>">
                    <?= ucwords($commande['status_nom']) ?>
                </span>
            </dd>



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
                                        <select name="produit_id" id="produit_id" class="form-select">
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

                            <img data-bs-toggle="modal" data-bs-target="#show_image<?= $p['id'] ?>" src="images/produits/<?= $p['image'] ?>" width="30" alt="" style="cursor:pointer">

                            <div class="modal fade" id="show_image<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">
                                                <?= ucwords($p['designation']) ?> - <?= ucwords($p['couleur_nom']) ?>

                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">

                                            <img width="400" src="images/produits/<?= $p['image'] ?>" alt="" class='img-fluid'>

                                        </div>
                                        <!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                        <!-- modal-footer -->


                                    </div>
                                    <!-- modal-content -->
                                </div>
                                <!-- modal-dialog -->
                            </div>
                            <!-- modal -->
                        </td>
                        <td><?= ucwords($p['reference'], '-') ?></td>
                        <td><?= ucwords($p['designation']) ?> - <?= ucwords($p['couleur_nom']) ?> <?= ucwords($p['categorie_nom']) ?></td>
                        <td><?= $p['prix_decimale'] ?> DH</td>
                        <td><?= $p['quantite'] ?></td>
                        <td><?= $p['prix_total'] ?> DH</td>
                        <td>


                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#update_product_<?= $p['id'] ?>">
                                Modifier
                            </button>

                            <div class="modal fade" id="update_product_<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">
                                                Modifier la quantité
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="quantite" class="form-label">Quantité</label>
                                                    <input type="number" class="form-control" name="quantite" id="quantite" placeholder="Quantité:" value="<?= $p['quantite'] ?>">
                                                </div>
                                                <!-- mb-3 -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                <input type="hidden" name="commande_produit_id" value="<?= $p['id'] ?>">
                                                <button type="submit" name="product_update" class="btn btn-success">Modifier</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

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

                    <?php if ($commande['coupon_montant'] != 0) : ?>
                        <tr>
                            <th>Remise:</th>
                            <td>
                                <?= strtoupper($commande['coupon_code']) ?>:
                                (-<?= _number_format($commande['coupon_montant']) ?> DH)
                            </td>
                        </tr>
                    <?php endif ?>

                    <tr>
                        <th>Prix total:</th>
                        <td><?= _number_format($prix_total - $commande['coupon_montant']) ?> DH</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
    <!-- card-body -->
</div>
<!-- card -->



<?php $content_html = ob_get_clean(); ?>