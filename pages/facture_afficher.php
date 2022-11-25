<?php

ob_start();
// php
$title = "Factures";

$content_php = ob_get_clean();


ob_start(); ?>



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item"><a href="dashboard">Liste factures</a></li>
        <li class="breadcrumb-item active" aria-current="page">Détails de facture</li>
    </ol>
</nav>

<h4 class="fw-bold mb-3">Détails de la facture N° FA01/2022</h4>





<div class="card">
    <div class="card-header">
        <h6 class="fw-bold">
            Détails de la facture N° FA01/2022
        </h6>
    </div>
    <!-- card-header -->
    <div class="card-body">

        <dl class="row">
            <dt class="col-sm-3">Numéro de facture</dt>
            <dd class="col-sm-9">FA01/2022</dd>

            <dt class="col-sm-3">Date de facture</dt>
            <dd class="col-sm-9">25/11/2022</dd>


            <dt class="col-sm-3">Client</dt>
            <dd class="col-sm-9">Mohammed Alami</dd>


        </dl>

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
                <tr>
                    <td>1</td>
                    <td>
                        <img src="images/produits/1.jpg" width="30" alt="">
                    </td>
                    <td>R-01</td>
                    <td>Iphone Pro Max Blue 255 SSD</td>
                    <td>13 000,00 DH</td>
                    <td>2</td>
                    <td>26 000,00 DH</td>
                    <td>
                        <a href="" class="btn btn-link btn-sm">Modifier</a>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>
                        <img src="images/produits/2.jpg" width="30" alt="">
                    </td>
                    <td>R-02</td>
                    <td>Iphone Pro Max Gold 255 SSD</td>
                    <td>13 000,00 DH</td>
                    <td>1</td>
                    <td>13 000,00 DH</td>
                    <td>
                        <a href="" class="btn btn-link btn-sm">Modifier</a>
                    </td>
                </tr>


                <tr>
                    <td>3</td>
                    <td>
                        <img src="images/produits/3.jpg" width="30" alt="">
                    </td>
                    <td>R-03</td>
                    <td>Imac Orange 255 SSD</td>
                    <td>24 000,00 DH</td>
                    <td>2</td>
                    <td>48 000,00 DH</td>
                    <td>
                        <a href="" class="btn btn-link btn-sm">Modifier</a>
                    </td>
                </tr>



            </tbody>
        </table>

    </div>
    <!-- card-body -->
</div>
<!-- card -->



<?php $content_html = ob_get_clean(); ?>