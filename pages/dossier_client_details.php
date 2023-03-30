<?php

ob_start();
// php
$title = "Dossier clients";

if (!isset($_GET['client_id'])) {
    $_SESSION['flash']['danger'] = 'Error id !!!';
    header('Location: dossier_clients');
    exit();
}


$client_id = (int)$_GET['client_id'];

if ($client_id <= 0) {
    $_SESSION['flash']['danger'] = 'Error id !!!';
    header('Location: dossier_clients');
    exit();
}


$client_details = $pdo->query("SELECT * FROM clients WHERE deleted_at IS NULL AND id = $client_id LIMIT 1");

if ($client_details->rowCount() == 0) {
    $_SESSION['flash']['danger'] = 'Client intouvable';
    header('Location: dossier_clients');
    exit();
} else {
    $c = $client_details->fetch();
}


$commandes_client = $pdo->query("SELECT * FROM commandes_view where client_id = $client_id ORDER BY date_commande DESC")->fetchAll();

$total_commande = $pdo->query("SELECT count(id) As total_client_commande FROM commandes WHERE client_id = $client_id LIMIT 1")->fetch()['total_client_commande'] ?? 0;






$total_produis = $pdo->query("SELECT sum(cp.quantite) AS total_produits FROM 
commande_produit cp 
LEFT JOIN commandes c ON c.id = cp.commande_id
LEFT JOIN clients cl ON cl.id = c.client_id
WHERE cl.id = $client_id
LIMIT 1
")->fetch()['total_produits'];


$total_prix = $pdo->query("SELECT sum((cp.prix / 100) * cp.quantite ) AS total_prix FROM 
commande_produits_view cp 
LEFT JOIN commandes c ON c.id = cp.commande_id
LEFT JOIN clients cl ON cl.id = c.client_id
WHERE cl.id = $client_id
LIMIT 1
")->fetch()['total_prix'];

$content_php = ob_get_clean();


ob_start(); ?>



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item"><a href="dashboard">Dossier clients</a></li>
        <li class="breadcrumb-item active" aria-current="pnum">Détails dossier client</li>
    </ol>
</nav>

<h4 class="fw-bold mb-3">Détails dossier client</h4>



<div class="row">


    <div class="col-md-3">
        <div class="card card-body">
            <h5>Total Commandes</h5>
            <h6 class="text-end">
                <?= $total_commande ?> commande<?= $total_commande > 1 ? 's' : '' ?>
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->

    <div class="col-md-3">
        <div class="card card-body">
            <h5>Total Produits</h5>
            <h6 class="text-end">
                <?= $total_produis ?> Produits
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->



    <div class="col-md-3">
        <div class="card card-body">
            <h5>Prix total</h5>
            <h6 class="text-end">
                <?= _number_format($total_prix) ?> DH
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->

    <div class="col-md-3">
        <div class="card card-body">
            <h5>Total Factures</h5>
            <h6 class="text-end">
                0 Factures
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->
</div>
<!-- row -->

<div class="row  mt-3">
    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Renseignements personnels
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nom:</dt>
                    <dd class="col-sm-9"><?= ucwords($c['nom']) ?></dd>

                    <dt class="col-sm-3">Numéro:</dt>
                    <dd class="col-sm-9">C:<?= add_zero($c['num']) ?></dd>

                    <dt class="col-sm-3">Email:</dt>
                    <dd class="col-sm-9"><?= $c['email'] ?></dd>

                    <dt class="col-sm-3">Téléphone:</dt>
                    <dd class="col-sm-9"><?= $c['telephone'] ?></dd>

                    <dt class="col-sm-3">Ville:</dt>
                    <dd class="col-sm-9"><?= ucwords($c['ville']) ?></dd>

                    <dt class="col-sm-3">Adresse:</dt>
                    <dd class="col-sm-9">
                        <?= ucwords($c['adresse']) ?>
                    </dd>
                </dl>
            </div>
        </div>
        <!-- card -->
    </div>
    <!-- col -->

    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Liste des commandes
            </div>
            <!-- card-header -->
            <div class="card-body">
                <div class="list-group">
                    <?php foreach ($commandes_client as $key => $c) : ?>

                        <?php

                        switch ($c['status_color']) {
                            case 'danger':
                                $class = "text-danger fw-bold";
                                break;

                            case 'success':
                                $class = "text-success fw-bold";
                                break;

                            case 'warning':
                                $class = "text-warning fw-bold";
                                break;

                            default:
                                $class = "";
                                break;
                        }
                        ?>

                        <a href="commande_afficher&id=<?= $c['id'] ?>" class="list-group-item list-group-item-action <?= $class  ?>">
                            Commande N° <?= $c['commande_num'] ?>
                            sur la date du <?= $c['date_commande_format'] ?>
                            <span class="badge bg-<?= $c['status_color'] ?>">
                                <?= ucwords($c['status_nom']) ?>
                            </span>
                        </a>
                    <?php endforeach ?>

                </div>
            </div>
            <!-- card-body -->
        </div>
        <!-- card -->
    </div>
    <!-- col -->
</div>
<!-- row -->






<?php $content_html = ob_get_clean(); ?>