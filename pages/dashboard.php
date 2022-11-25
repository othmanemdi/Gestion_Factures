<?php

ob_start();
// php
$title = "Tableau de bord";

$content_php = ob_get_clean();


ob_start(); ?>



<h4 class="fw-bold mb-3">Tableau de bord page</h4>

<div class="row">
    <div class="col-md-3">
        <div class="card card-body">
            <h5>Total Produits</h5>
            <h6 class="text-end">
                3 Produits
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->

    <div class="col-md-3">
        <div class="card card-body">
            <h5>Total Clients</h5>
            <h6 class="text-end">
                3 Clients
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->


    <div class="col-md-3">
        <div class="card card-body">
            <h5>Total Commandes</h5>
            <h6 class="text-end">
                3 Commandes
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->

    <div class="col-md-3">
        <div class="card card-body">
            <h5>Total Factures</h5>
            <h6 class="text-end">
                3 Factures
            </h6>
        </div>
        <!-- card -->
    </div>
    <!-- col -->
</div>
<!-- row -->


<?php $content_html = ob_get_clean(); ?>