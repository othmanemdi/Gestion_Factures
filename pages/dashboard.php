<?php

ob_start();
// php
$title = "Tableau de bord";

$total_produits = $pdo->query("SELECT count(id) As total_produits from produits LIMIT 1")->fetch()['total_produits'];

$total_clients = $pdo->query("SELECT count(id) As total_clients from commandes where status_id != 4 GROUP BY client_id LIMIT 1")->fetch()['total_clients'];

$total_commandes = $pdo->query("SELECT count(id) As total_commandes from commandes where status_id != 4 LIMIT 1")->fetch()['total_commandes'];

$total_factures = 0;

$content_php = ob_get_clean();

ob_start(); ?>

<h4 class="fw-bold mb-3">Tableau de bord page</h4>

<div class="row">
    <div class="col-md-3">
        <div class="card card-body">
            <h5>Total Produits</h5>
            <h6 class="text-end">
                <?= $total_produits ?> Produits
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->

    <div class="col-md-3">
        <div class="card card-body">
            <h5>Total Clients</h5>
            <h6 class="text-end">
                <?= $total_clients ?> Clients
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->


    <div class="col-md-3">
        <div class="card card-body">
            <h5>Total Commandes</h5>
            <h6 class="text-end">
                <?= $total_commandes ?> Commandes
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->

    <div class="col-md-3">
        <div class="card card-body">
            <h5>Total Factures</h5>
            <h6 class="text-end">
                <?= $total_factures ?> Factures
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->
</div>
<!-- row -->


<?php $content_html = ob_get_clean(); ?>