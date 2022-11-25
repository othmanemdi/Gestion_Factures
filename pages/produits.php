<?php

ob_start();
// php
$title = "Produits";

$content_php = ob_get_clean();

ob_start(); ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Liste produits</li>
    </ol>
</nav>

<h4 class="fw-bold mb-3">Liste produits</h4>

<div class="card">
    <div class="card-header">
        <h6 class="fw-bold">
            Liste produits
        </h6>
    </div>
    <!-- card-header -->
    <div class="card-body">


        <button type="button" class="btn btn-primary mb-3 fw-bold" data-bs-toggle="modal" data-bs-target="#add_produit">
            Ajouter un produits
        </button>

        <div class="modal fade" id="add_produit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">
                            Ajouter produits
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="reference" class="form-label">Référence:</label>
                                        <input type="text" class="form-control" id="reference" placeholder="Référence:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="designation" class="form-label">Désignation:</label>
                                        <input type="text" class="form-control" id="designation" placeholder="Désignation:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="prix_u" class="form-label">Prix U:</label>
                                        <input type="number" class="form-control" id="prix_u" name="prix_u" placeholder="Prix U:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="Photo" class="form-label">Photo:</label>
                                        <input type="file" class="form-control">
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
                    <th>Photo</th>
                    <th>Référence</th>
                    <th>Désignation</th>
                    <th>Prix U</th>
                    <th>Action</th>
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
                    <td>
                        <a href="commande_afficher" class="btn btn-link btn-sm">Afficher</a>
                        <a href="" class="btn btn-link btn-sm">Modifier</a>
                        <a href="" class="btn btn-link btn-sm">Supprimer</a>
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
                    <td>
                        <a href="commande_afficher" class="btn btn-link btn-sm">Afficher</a>
                        <a href="" class="btn btn-link btn-sm">Modifier</a>
                        <a href="" class="btn btn-link btn-sm">Supprimer</a>
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
                    <td>
                        <a href="commande_afficher" class="btn btn-link btn-sm">Afficher</a>
                        <a href="" class="btn btn-link btn-sm">Modifier</a>
                        <a href="" class="btn btn-link btn-sm">Supprimer</a>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
    <!-- card-body -->
</div>
<!-- card -->

<?php $content_html = ob_get_clean(); ?>