<?php

ob_start();
// php
$title = "Dossier clients";
$search = '';

if (isset($_POST['search_dossier_client'])) {
    $dossier_client = e($_POST['dossier_client']);
    $search = " AND nom lIKE '%" . $dossier_client . "%' ";
}

$clients = $pdo->query("SELECT * FROM clients WHERE deleted_at IS NULL $search ORDER BY id DESC")->fetchAll();

$content_php = ob_get_clean();


ob_start(); ?>



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard">Tableu de bord</a>
        </li>
        <li class="breadcrumb-item active" aria-current="pnum">Dossier clients</li>
    </ol>
</nav>

<h4 class="fw-bold mb-3">Dossier client</h4>

<form method="POST" class="d-flex py-2 col-6 mx-auto">
    <div class="input-group mb-3 me-2">
        <input type="text" class="form-control" placeholder="Search:" name="dossier_client" value="<?= isset($_POST['dossier_client']) ? e($_POST['dossier_client']) : '' ?>">

        <button class="btn btn-outline-dark" type="submit" name="search_dossier_client" id="button-addon2">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>

<div class="row">
    <?php foreach ($clients as $key => $c) : ?>

        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= ucwords($c['nom']) ?> <span class="h6 text-muted">
                            C:<?= add_zero($c['num']) ?>
                        </span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?php
                        $client_id = $c['id'];
                        $total_commande = $pdo->query("SELECT count(id) As total_client_commande FROM commandes WHERE client_id = $client_id LIMIT 1")->fetch()['total_client_commande'] ?? 0;

                        ?>

                        <?= $total_commande ?> commandes</h6>
                    <a href="dossier_client_details&client_id=<?= $client_id ?>" class="card-link">Détails</a>
                </div>
                <!-- card-body -->
            </div>
            <!-- card -->
        </div>
        <!-- col -->
    <?php endforeach ?>
</div>
<!-- row -->





<?php $content_html = ob_get_clean(); ?>