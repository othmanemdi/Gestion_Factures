<?php

ob_start();
// php
$title = "Dossier clients";
$search = '';

$clients = $pdo->query("SELECT * FROM clients WHERE deleted_at IS NULL $search ORDER BY id DESC")->fetchAll();


$content_php = ob_get_clean();


ob_start(); ?>



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item active" aria-current="pnum">Dossier clients</li>
    </ol>
</nav>

<h4 class="fw-bold mb-3">Dossier client</h4>



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