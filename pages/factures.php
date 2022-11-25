<?php

ob_start();
// php
$title = "Factures";

$content_php = ob_get_clean();

ob_start(); ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Liste factures</li>
    </ol>
</nav>

<h4 class="fw-bold mb-3">Liste factures</h4>

<div class="card">
    <div class="card-header">
        <h6 class="fw-bold">
            Liste factures
        </h6>
    </div>
    <!-- card-header -->
    <div class="card-body">

        <table class="table table-sm table-bordered">
            <thead>
                <tr class="table-light">
                    <th>Id</th>
                    <th>Num</th>
                    <th>Date facture</th>
                    <th>Client</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>FA01</td>
                    <td>25/11/2022</td>
                    <td>Mohammed Alami</td>
                    <td>
                        <a href="facture_afficher" class="btn btn-link btn-sm">Afficher</a>
                        <a href="" class="btn btn-link btn-sm">Modifier</a>
                        <a href="" class="btn btn-link btn-sm">Annuler</a>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>C02</td>
                    <td>26/11/2022</td>
                    <td>Drisse El Alaoui</td>
                    <td>
                        <a href="facture_afficher" class="btn btn-link btn-sm">Afficher</a>
                        <a href="" class="btn btn-link btn-sm">Modifier</a>
                        <a href="" class="btn btn-link btn-sm">Annuler</a>
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>C03</td>
                    <td>27/11/2022</td>
                    <td>Maryam Atid</td>
                    <td>
                        <a href="facture_afficher" class="btn btn-link btn-sm">Afficher</a>
                        <a href="" class="btn btn-link btn-sm">Modifier</a>
                        <a href="" class="btn btn-link btn-sm">Annuler</a>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
    <!-- card-body -->
</div>
<!-- card -->



<?php $content_html = ob_get_clean(); ?>