<?php

ob_start();
// php
$title = "Tableau de bord";

$total_produits = $pdo->query("SELECT count(id) As total_produits from produits LIMIT 1")->fetch()['total_produits'] ?? 0;

$total_clients = $pdo->query("SELECT count(id) As total_clients from commandes where status_id != 4 GROUP BY client_id LIMIT 1")->fetch()['total_clients'] ?? 0;

$total_commandes = $pdo->query("SELECT count(id) As total_commandes from commandes where status_id != 4 LIMIT 1")->fetch()['total_commandes'] ?? 0;




$result = $pdo->query("SELECT 
    MONTH(cv.date_commande) AS mois,
    -- SUM(DISTINCT CASE WHEN cv.coupon_active=1 THEN cv.coupon_montant ELSE 0 END) As coupon_montant,
    -- sum((cp.prix / 100) * cp.quantite) AS prix_total_sans_coupon,
    sum((cp.prix / 100) * cp.quantite) - SUM(DISTINCT  CASE WHEN cv.coupon_active=1 THEN cv.coupon_montant ELSE 0 END) AS prix_total_avec_coupon   
    -- FROM commande_produits_view cp
    -- LEFT JOIN commandes_view cv ON cv.id = cp.commande_id
    FROM commandes_view cv
    LEFT JOIN commande_produits_view cp ON cp.commande_id = cv.id
    WHERE cv.status_id = 3
GROUP BY MONTH(cv.date_commande)
ORDER BY MONTH(cv.date_commande) DESC
")->fetchAll();

$result2 = $pdo->query("SELECT 
    MONTH(cv.date_commande) AS mois,
    SUM(CASE WHEN cv.coupon_active = 1 THEN cv.coupon_montant ELSE 0 END) As coupon_montant
    FROM commandes_view cv
    -- LEFT JOIN commande_produits_view cp ON cp.commande_id = cv.id
    WHERE cv.status_id = 3
GROUP BY MONTH(cv.date_commande)
ORDER BY MONTH(cv.date_commande) DESC
")->fetchAll();

$statistique_mensuel = [];

foreach (_get_months_short() as $mois_num => $mois_nom) {
    $statistique_mensuel[$mois_num]['mois'] = $mois_nom;
    foreach ($result as $r) {

        if ($mois_num == $r['mois']) {
            $statistique_mensuel[$mois_num]['prix_total'] = $r['prix_total_avec_coupon'];
            break;
        } else {
            $statistique_mensuel[$mois_num]['prix_total'] = 0;
        }
    }
}
// dd($statistique_mensuel);
// exit;
// dd($result);
// dd($result2);
// exit;
// dd($statistique_mensuel);
// exit;
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


<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>
                    Statistique mensuelle
                </h5>
            </div>
            <div class="card-body" weight="200" height="200">
                <canvas id="myChart"></canvas>
            </div>
        </div>


        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php foreach (_get_months_short() as $key => $value) :
                                    echo "'" . $value . "',";
                                endforeach ?>],
                    datasets: [{
                        label: 'Statistique monsuelle',
                        data: [50000, 65000, 78000, 90000, 75000, 45000, 95000, 1000],
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>
                    Statistique par catégories
                </h5>
            </div>
            <div class="card-body" weight="200" height="200">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>


</div>
<BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR>

<?php $content_html = ob_get_clean(); ?>