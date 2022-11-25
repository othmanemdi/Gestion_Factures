<?php

ob_start();
// php
$title = "Clients";

$content_php = ob_get_clean();


ob_start(); ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Liste clients</li>
    </ol>
</nav>

<h4 class="fw-bold mb-3">Liste clients</h4>

<div class="card">
    <div class="card-header">
        <h6 class="fw-bold">
            Liste Clients
        </h6>
    </div>
    <!-- card-header -->
    <div class="card-body">

        <button type="button" class="btn btn-primary mb-3 fw-bold" data-bs-toggle="modal" data-bs-target="#add_client">
            Ajouter
        </button>

        <div class="modal fade" id="add_client" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">
                            Ajouter client
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
                    <th>Nom</th>
                    <!-- <th>Téléphone</th>
            <th>Email</th>
            <th>Ville</th>
            <th>Adresse</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>C01</td>
                    <td>Mohammed Alami</td>
                    <td>

                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#show_client_1">
                            Afficher
                        </button>

                        <div class="modal fade" id="show_client_1" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            Afficher
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <dl class="row">
                                            <dt class="col-sm-3">Nom:</dt>
                                            <dd class="col-sm-9">Mohammed Alami</dd>

                                            <dt class="col-sm-3">Numéro:</dt>
                                            <dd class="col-sm-9">C01</dd>

                                            <dt class="col-sm-3">Email:</dt>
                                            <dd class="col-sm-9">mohammed.alami@gmail.com</dd>

                                            <dt class="col-sm-3">Téléphone:</dt>
                                            <dd class="col-sm-9">06 80 65 43 38</dd>

                                            <dt class="col-sm-3">Ville:</dt>
                                            <dd class="col-sm-9">Rabat</dd>

                                            <dt class="col-sm-3">Adresse:</dt>
                                            <dd class="col-sm-9">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae ducimus nostrum.
                                            </dd>
                                        </dl>

                                    </div>
                                    <!-- modal-body -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                                    </div>
                                    <!-- modal-footer -->


                                </div>
                                <!-- modal-content -->
                            </div>
                            <!-- modal-dialog -->
                        </div>
                        <!-- modal -->

                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#update_client_1">
                            Modifier
                        </button>

                        <div class="modal fade" id="update_client_1" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            Modifier
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="nom" class="form-label">Nom:</label>
                                                        <input type="text" class="form-control" id="nom" placeholder="Nom:" value="mohammed alami">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="num" class="form-label">Numéro:</label>
                                                        <input type="number" class="form-control" id="num" placeholder="Numéro:" value="1">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email:</label>
                                                        <input type="email" class="form-control" id="email" placeholder="Email:" value="mohammed.alami@gmail.com">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="ville" class="form-label">Ville:</label>
                                                        <input type="text" class="form-control" id="ville" placeholder="Ville:" value="Rabat">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="tele" class="form-label">Téléphone:</label>
                                                        <input type="number" class="form-control" id="tele" placeholder="Téléphone:" value="0680654338">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="adresse" class="form-label">Adresse:</label>
                                                        <textarea type="number" class="form-control" id="tele" placeholder="Adresse:">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae ducimus nostrum.
                                </textarea>
                                                        <input type="hidden" value="1">
                                                    </div>
                                                </div>
                                                <!-- col -->
                                            </div>
                                            <!-- row -->
                                        </div>
                                        <!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-success">
                                                Modifier
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

                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#delete_client_1">
                            Supprimer
                        </button>

                        <div class="modal fade" id="delete_client_1" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            Supprimer
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">

                                            <h5 class="text-danger fw-bold">
                                                Voulez vous vraiment supprimer cette ligne ?
                                            </h5>

                                        </div>
                                        <!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-danger">
                                                Supprimer
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
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>C02</td>
                    <td>Drisse El Alaoui</td>

                    <td>

                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#show_client_2">
                            Afficher
                        </button>

                        <div class="modal fade" id="show_client_2" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            Afficher
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <dl class="row">
                                            <dt class="col-sm-3">Nom:</dt>
                                            <dd class="col-sm-9">Mohammed Alami</dd>

                                            <dt class="col-sm-3">Numéro:</dt>
                                            <dd class="col-sm-9">C01</dd>

                                            <dt class="col-sm-3">Email:</dt>
                                            <dd class="col-sm-9">mohammed.alami@gmail.com</dd>

                                            <dt class="col-sm-3">Téléphone:</dt>
                                            <dd class="col-sm-9">06 80 65 43 38</dd>

                                            <dt class="col-sm-3">Ville:</dt>
                                            <dd class="col-sm-9">Rabat</dd>

                                            <dt class="col-sm-3">Adresse:</dt>
                                            <dd class="col-sm-9">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae ducimus nostrum.
                                            </dd>
                                        </dl>

                                    </div>
                                    <!-- modal-body -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                                    </div>
                                    <!-- modal-footer -->


                                </div>
                                <!-- modal-content -->
                            </div>
                            <!-- modal-dialog -->
                        </div>
                        <!-- modal -->

                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#update_client_2">
                            Modifier
                        </button>

                        <div class="modal fade" id="update_client_2" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            Modifier
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="nom" class="form-label">Nom:</label>
                                                        <input type="text" class="form-control" id="nom" placeholder="Nom:" value="mohammed alami">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="num" class="form-label">Numéro:</label>
                                                        <input type="number" class="form-control" id="num" placeholder="Numéro:" value="1">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email:</label>
                                                        <input type="email" class="form-control" id="email" placeholder="Email:" value="mohammed.alami@gmail.com">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="ville" class="form-label">Ville:</label>
                                                        <input type="text" class="form-control" id="ville" placeholder="Ville:" value="Rabat">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="tele" class="form-label">Téléphone:</label>
                                                        <input type="number" class="form-control" id="tele" placeholder="Téléphone:" value="0680654338">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="adresse" class="form-label">Adresse:</label>
                                                        <textarea type="number" class="form-control" id="tele" placeholder="Adresse:">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae ducimus nostrum.
                                </textarea>
                                                        <input type="hidden" value="1">
                                                    </div>
                                                </div>
                                                <!-- col -->
                                            </div>
                                            <!-- row -->
                                        </div>
                                        <!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-success">
                                                Modifier
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

                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#delete_client_2">
                            Supprimer
                        </button>

                        <div class="modal fade" id="delete_client_2" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            Supprimer
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">

                                            <h5 class="text-danger fw-bold">
                                                Voulez vous vraiment supprimer cette ligne ?
                                            </h5>

                                        </div>
                                        <!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-danger">
                                                Supprimer
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
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>C03</td>
                    <td>Maryam Atid</td>
                    <td>

                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#show_client_3">
                            Afficher
                        </button>

                        <div class="modal fade" id="show_client_3" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            Afficher
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <dl class="row">
                                            <dt class="col-sm-3">Nom:</dt>
                                            <dd class="col-sm-9">Mohammed Alami</dd>

                                            <dt class="col-sm-3">Numéro:</dt>
                                            <dd class="col-sm-9">C01</dd>

                                            <dt class="col-sm-3">Email:</dt>
                                            <dd class="col-sm-9">mohammed.alami@gmail.com</dd>

                                            <dt class="col-sm-3">Téléphone:</dt>
                                            <dd class="col-sm-9">06 80 65 43 38</dd>

                                            <dt class="col-sm-3">Ville:</dt>
                                            <dd class="col-sm-9">Rabat</dd>

                                            <dt class="col-sm-3">Adresse:</dt>
                                            <dd class="col-sm-9">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae ducimus nostrum.
                                            </dd>
                                        </dl>

                                    </div>
                                    <!-- modal-body -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                                    </div>
                                    <!-- modal-footer -->


                                </div>
                                <!-- modal-content -->
                            </div>
                            <!-- modal-dialog -->
                        </div>
                        <!-- modal -->

                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#update_client_3">
                            Modifier
                        </button>

                        <div class="modal fade" id="update_client_3" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            Modifier
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="nom" class="form-label">Nom:</label>
                                                        <input type="text" class="form-control" id="nom" placeholder="Nom:" value="mohammed alami">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="num" class="form-label">Numéro:</label>
                                                        <input type="number" class="form-control" id="num" placeholder="Numéro:" value="1">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email:</label>
                                                        <input type="email" class="form-control" id="email" placeholder="Email:" value="mohammed.alami@gmail.com">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="ville" class="form-label">Ville:</label>
                                                        <input type="text" class="form-control" id="ville" placeholder="Ville:" value="Rabat">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="tele" class="form-label">Téléphone:</label>
                                                        <input type="number" class="form-control" id="tele" placeholder="Téléphone:" value="0680654338">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="adresse" class="form-label">Adresse:</label>
                                                        <textarea type="number" class="form-control" id="tele" placeholder="Adresse:">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae ducimus nostrum.
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <!-- col -->
                                            </div>
                                            <!-- row -->
                                        </div>
                                        <!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-success">
                                                Modifier
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

                        <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#delete_client_3">
                            Supprimer
                        </button>

                        <div class="modal fade" id="delete_client_3" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            Supprimer
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">

                                            <h5 class="text-danger fw-bold">
                                                Voulez vous vraiment supprimer cette ligne ?
                                            </h5>

                                        </div>
                                        <!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-danger">
                                                Supprimer
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
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
    <!-- card-body -->
</div>
<!-- card -->

<?php $content_html = ob_get_clean(); ?>