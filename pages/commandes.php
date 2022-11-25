<?php

ob_start();
// php
$title = "Commandes";

$content_php = ob_get_clean();


ob_start(); ?>



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Liste commandes</li>
    </ol>
</nav>

<h4 class="fw-bold mb-3">Liste commandes</h4>

<div class="card">
    <div class="card-header">
        <h6 class="fw-bold">
            Liste commandes
        </h6>
    </div>
    <!-- card-header -->
    <div class="card-body">


        <button type="button" class="btn btn-primary mb-3 fw-bold" data-bs-toggle="modal" data-bs-target="#add_commande">
            Ajouter une commande
        </button>

        <div class="modal fade" id="add_commande" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">
                            Ajouter commande
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom:</label>
                                        <input type="text" class="form-control" id="nom" placeholder="Nom:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="num" class="form-label">Numéro:</label>
                                        <input type="number" class="form-control" id="num" placeholder="Numéro:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ville" class="form-label">Ville:</label>
                                        <input type="text" class="form-control" id="ville" placeholder="Ville:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tele" class="form-label">Téléphone:</label>
                                        <input type="number" class="form-control" id="tele" placeholder="Téléphone:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="adresse" class="form-label">Adresse:</label>
                                        <textarea type="number" class="form-control" id="tele" placeholder="Adresse:"></textarea>
                                    </div>
                                </div>
                                <!-- col -->
                            </div>
                            <!-- row -->
                        </div>
                        <!-- modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">
                                Ajouter
                            </button>
                        </div>
                        <!-- modal-footer -->

                    </form>

                </div>
                <!-- modal-content -->
            </div>
            <!-- modal-dialog -->
        </div>
        <!-- modal -->

        <table class="table table-sm table-bordered">
            <thead>
                <tr class="table-light">
                    <th>Id</th>
                    <th>Num</th>
                    <th>Date commande</th>
                    <th>Client</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>BC01</td>
                    <td>25/11/2022</td>
                    <td>Mohammed Alami</td>
                    <td>
                        <a href="commande_afficher" class="btn btn-link btn-sm">Afficher</a>
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
                        <a href="commande_afficher" class="btn btn-link btn-sm">Afficher</a>
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
                        <a href="commande_afficher" class="btn btn-link btn-sm">Afficher</a>
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