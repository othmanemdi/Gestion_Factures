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


<div class="row mt-3">
    <div class="col-md-12">
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
                    labels: ['Janvier', 'Férvier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août'],
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
</div>


<?php $content_html = ob_get_clean(); ?>