<?php

ob_start();
// php
$title = "Clients";

if (isset($_POST['ajouter_client'])) {

    $nom = e($_POST['nom']);
    $num = (int)$_POST['num'];
    $email = e($_POST['email']);
    $ville = e($_POST['ville']);
    $telephone = e($_POST['telephone']);
    $adresse = e($_POST['adresse']);

    $client = $pdo->prepare("INSERT INTO clients SET 
            nom = :nom,
            num = :num,
            email = :email,
            ville = :ville,
            telephone = :telephone,
            adresse = :adresse
        ");

    $client->execute(
        [
            'nom' => $nom,
            'num' => $num,
            'email' => $email,
            'ville' => $ville,
            'telephone' => $telephone,
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

    $nom = e($_POST['nom']);
    $num = (int)$_POST['num'];
    $email = e($_POST['email']);
    $ville = e($_POST['ville']);
    $telephone = e($_POST['telephone']);
    $adresse = e($_POST['adresse']);
    $client_id = (int)$_POST['client_id'];

    $client = $pdo->query("UPDATE clients SET 
    nom = '$nom', 
    num = $num, 
    email = '$email', 
    ville = '$ville', 
    telephone = '$telephone',
    adresse = '$adresse',
    updated_at = NOW() 
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

    $client = $pdo->query("UPDATE clients SET deleted_at = NOW() WHERE id = $client_id");

    if ($client) {
        $_SESSION['flash']['info'] = 'Bien supprimer';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: clients');
    exit();
}

$req = "SELECT * FROM clients WHERE deleted_at IS NULL ORDER BY id DESC";

$clients = $pdo->query($req)->fetchAll();

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
                                        <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="num" class="form-label">Numéro:</label>
                                        <input type="number" name="num" class="form-control" id="num" placeholder="Numéro:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ville" class="form-label">Ville:</label>
                                        <input type="text" name="ville" class="form-control" id="ville" placeholder="Ville:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telephone" class="form-label">Téléphone:</label>
                                        <input type="number" name="telephone" class="form-control" id="telephone" placeholder="Téléphone:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="adresse" class="form-label">Adresse:</label>
                                        <textarea type="number" name="adresse" class="form-control" id="adrss" placeholder="Adresse:"></textarea>
                                    </div>
                                </div>
                                <!-- col -->
                            </div>
                            <!-- row -->
                        </div>
                        <!-- modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" name="ajouter_client" class="btn btn-primary">
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

        <table class="table table-sm table-bordered">
            <thead>
                <tr class="table-light">
                    <th>Id</th>
                    <th>Num</th>
                    <th>Nom</th>
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
                            C:<?= add_zero($c['num']); ?>
                        </td>
                        <td>
                            <?= ucwords($c['nom']) ?>
                        </td>
                        <td>

                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#show_client_<?= $c['id'] ?>">
                                Afficher
                            </button>

                            <div class="modal fade" id="show_client_<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
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
                                                <dd class="col-sm-9">
                                                    <?= ucwords($c['nom']) ?>
                                                </dd>

                                                <dt class="col-sm-3">Numéro:</dt>
                                                <dd class="col-sm-9">
                                                    C:<?= add_zero($c['num']); ?>
                                                </dd>

                                                <dt class="col-sm-3">Email:</dt>
                                                <dd class="col-sm-9"><?= $c['email'] ?></dd>

                                                <dt class="col-sm-3">Téléphone:</dt>
                                                <dd class="col-sm-9"><?= $c['telephone'] ?></dd>

                                                <dt class="col-sm-3">Ville:</dt>
                                                <dd class="col-sm-9"><?= ucwords($c['ville']) ?></dd>

                                                <dt class="col-sm-3">Adresse:</dt>
                                                <dd class="col-sm-9"><?= ucwords($c['adresse']) ?></dd>
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

                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#update_client_<?= $c['id'] ?>">
                                Modifier
                            </button>

                            <div class="modal fade" id="update_client_<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
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
                                                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom:" value="<?= $c['nom'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="num" class="form-label">Numéro:</label>
                                                            <input type="number" class="form-control" id="num" name="num" placeholder="Numéro:" value="<?= $c['num'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email:</label>
                                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email:" value="<?= $c['email'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="ville" class="form-label">Ville:</label>
                                                            <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville:" value="<?= $c['ville'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="telephone" class="form-label">Téléphone:</label>
                                                            <input type="number" class="form-control" id="telephone" name="telephone" placeholder="Téléphone:" value="<?= $c['telephone'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="adresse" class="form-label">Adresse:</label>
                                                            <textarea type="number" class="form-control" id="adresse" name="adresse" placeholder="Adresse:"><?= $c['adresse'] ?></textarea>

                                                            <input type="hidden" name="client_id" value="<?= $c['id'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->
                                                </div>
                                                <!-- row -->
                                            </div>
                                            <!-- modal-body -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit" name="modifier_client" class="btn btn-success">
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

                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#delete_client_<?= $c['id'] ?>">
                                Supprimer
                            </button>

                            <div class="modal fade" id="delete_client_<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
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
                                                <input type="hidden" name="client_id" value="<?= $c['id'] ?>">
                                                <button type="submit" name="supprimer_client" class="btn btn-danger">
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