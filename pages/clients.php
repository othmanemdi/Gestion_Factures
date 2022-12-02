<?php

ob_start();
// php
$title = "Clients";

if (isset($_POST['ajouter_client'])) {

    $nom = $_POST['nom'];
    $numero = (int)$_POST['numero'];
    $email = $_POST['email'];
    $ville = $_POST['ville'];
    $tele = (int)$_POST['tele'];
    $adresse = $_POST['adresse'];

    $client = $db->prepare("INSERT INTO clients SET 
            nom = :nom,
            numero = :numero,
            email = :email,
            ville = :ville,
            tele = :tele,
            adresse = :adresse


        ");

    $client->execute(
        [
            'nom' => $nom,
            'numero' => $numero,
            'email' => $email,
            'ville' => $ville,
            'tele' => $tele,
            'adresse' => $adresse
        ]
    );
    if ($client) {
        $_SESSION['flash']['info'] = 'Bien ajouter';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: clients');
    exit();
}


if (isset($_POST['modifier_client'])) {

    $nom = $_POST['nom'];
    $numero = (int)$_POST['numero'];
    $email = $_POST['email'];
    $ville = $_POST['ville'];
    $tele = (int)$_POST['tele'];
    $adresse = $_POST['adresse'];
    $client_id = (int) $_POST['client_id'];

    $client = $db->query("UPDATE clients SET 

    nom = '$nom', 
    numero = $numero, 
    email = '$email', 
    ville = '$ville', 
    tele = $tele,
    adresse = '$adresse'

    WHERE id = $client_id");

    if ($client) {
        $_SESSION['flash']['info'] = 'Bien modifier';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: clients');
    exit();
}



if (isset($_POST['supprimer_client'])) {

    $client_id = (int) $_POST['client_id'];

    $client = $db->query("UPDATE clients SET deleted_at = NOW() WHERE id = $client_id");

    if ($client) {
        $_SESSION['flash']['info'] = 'Bien supprimer';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: clients');
    exit();
}

// $req = "SELECT * FROM clients WHERE  deleted_c IS NULL";

// $clients = $db->query($req)->fetchAll();




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
                                        <textarea type="number" class="form-control" id="adrss" placeholder="Adresse:"></textarea>
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
                <?php foreach ($clients as $key => $c) : ?>
                    <tr>
                        <td>
                            <?= $c['id'] ?>
                        </td>
                        <td>
                            <?= $c['numero'] ?>
                        </td>
                        <td>
                            <?= $c['nom'] ?>
                        </td>
                        <td>

                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#show_client_<?= $c['id'] ?>">
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
                                                <dd class="col-sm-9"><?= $s['nom'] ?></dd>

                                                <dt class="col-sm-3">Numéro:</dt>
                                                <dd class="col-sm-9"><?= $s['numero'] ?></dd>

                                                <dt class="col-sm-3">Email:</dt>
                                                <dd class="col-sm-9"><?= $s['email'] ?></dd>

                                                <dt class="col-sm-3">Téléphone:</dt>
                                                <dd class="col-sm-9"><?= $s['tele'] ?></dd>

                                                <dt class="col-sm-3">Ville:</dt>
                                                <dd class="col-sm-9"><?= $s['ville'] ?></dd>

                                                <dt class="col-sm-3">Adresse:</dt>
                                                <dd class="col-sm-9"><?= $s['adresse'] ?></dd>
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

                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#update_client_<?= $c['id'] ?>">
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
                                                            <input type="text" class="form-control" id="nom" placeholder="Nom:" value="<?= $c['nom'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="num" class="form-label">Numéro:</label>
                                                            <input type="number" class="form-control" id="num" placeholder="Numéro:" value="<?= $c['numero'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email:</label>
                                                            <input type="email" class="form-control" id="email" placeholder="Email:" value="<?= $c['email'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="ville" class="form-label">Ville:</label>
                                                            <input type="text" class="form-control" id="ville" placeholder="Ville:" value="<?= $c['ville'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="tele" class="form-label">Téléphone:</label>
                                                            <input type="number" class="form-control" id="tele" placeholder="Téléphone:" value="<?= $c['tele'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="adresse" class="form-label">Adresse:</label>
                                                            <textarea type="number" class="form-control" id="tele" placeholder="Adresse:">
                                                        <?= $s['adresse'] ?>
                                                        </textarea>
                                                            <input type="hidden" value="<?= $c['id'] ?>">
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

                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#delete_client_<?= $c['id'] ?>">
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
                <?php endforeach ?>



            </tbody>
        </table>

    </div>
    <!-- card-body -->
</div>
<!-- card -->

<?php $content_html = ob_get_clean(); ?>