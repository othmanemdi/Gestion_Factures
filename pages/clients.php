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

    $client = $pdo->prepare("INSERT INTO clients SET nom = :nom, num = :num,email = :email,ville = :ville, telephone = :telephone, adresse = :adresse ");

    $client->execute(
        [
            'nom' => $nom, 'num' => $num, 'email' => $email, 'ville' => $ville, 'telephone' => $telephone, 'adresse' => $adresse
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
    $telephone = (int)$_POST['telephone'];
    $email = e($_POST['email']);
    $ville = e($_POST['ville']);
    $adresse = e($_POST['adresse']);
    $client_id = (int)$_POST['client_id'];

    // $client = $pdo->query("UPDATE clients SET nom = '$nom', num = $num, email = '$email',ville = '$ville',telephone = $telephone, adresse = '$adresse' WHERE id = $client_id");

    $client = $pdo->prepare("UPDATE clients SET nom = :nom,
    num = :num,
    email = :email,
    ville = :ville,
    telephone = :telephone,
    adresse = :adresse,
    updated_at = NOW()
    WHERE id = :id");

    $client->execute(
        [
            'nom' => $nom,
            'num' => $num,
            'email' => $email,
            'ville' => $ville,
            'telephone' => $telephone,
            'adresse' => $adresse,
            'id' => $client_id
        ]
    );

    if ($client) {
        $_SESSION['flash']['info'] = 'Bien modifier';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location:clients');
    exit();
}

if (isset($_POST['supprimer_client'])) {

    $client_id = (int) $_POST['client_id'];

    // $client = $pdo->query("UPDATE clients SET deleted_at = NOW() WHERE id = $client_id");

    $commande = $pdo->prepare("SELECT count(id) As count_order FROM commandes WHERE client_id = :client_id LIMIT 1");

    $commande->execute(
        [
            'client_id' => $client_id
        ]
    );

    $check_if_client_has_an_order = $commande->fetch();

    if (!$check_if_client_has_an_order) {

        $client = $pdo->prepare("UPDATE clients SET deleted_at = NOW() WHERE id = :client_id");

        $client->execute(
            [
                'client_id' => $client_id
            ]
        );
        if ($client) {
            $_SESSION['flash']['info'] = 'Bien supprimer';
        } else {
            $_SESSION['flash']['danger'] = 'Error !!!';
        }
    } else {
        $_SESSION['flash']['danger'] = "Error client has " . $check_if_client_has_an_order['count_order'] . " order(s) !!!";
    }

    header('Location: clients');
    exit();
}

// Delete client and his orders
/*if (isset($_POST['supprimer_client_2'])) {

    $client_id = (int) $_POST['client_id'];

    $client = $pdo->prepare("UPDATE clients SET deleted_at = NOW() WHERE id = :client_id");

    $client->execute(
        [
            'client_id' => $client_id
        ]
    );

    $client = $pdo->prepare("UPDATE commandes SET deleted_at = NOW() WHERE client_id = :client_id");

    $client->execute(
        [
            'client_id' => $client_id
        ]
    );
    if ($client) {
        $_SESSION['flash']['info'] = 'Bien supprimer';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }


    header('Location: clients');
    exit();
}*/

$search = '';

if (isset($_POST['rechercher_client'])) {
    $c = e($_POST['c']);
    $search =  " AND nom LIKE '%" . $c . "%'";
}

$clients = $pdo->query("SELECT * FROM clients WHERE deleted_at IS NULL $search ORDER BY id DESC")->fetchAll();

$content_php = ob_get_clean();

ob_start(); ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item active" aria-current="pnum">Liste clients</li>
    </ol>
</nav>

<div>

    <form method="post" class="d-flex py-2   col-6 mx-auto">
        <div class="input-group">
            <input type="text" class="form-control me-2 rounded-pill" placeholder="Rechercher:" name="c" value="<?= isset($_POST['c']) ? e($_POST['c']) : '' ?>">
            <button class="btn btn-outline-secondary visually-hidden" type="submit" name="rechercher_client">Rechercher</button>
        </div>
    </form>
</div>
<h4 class="fw-bold mb-3">Liste clients</h4>

<div class="card">
    <div class="card-header">
        <h6 class="fw-bold">
            Liste Clients
        </h6>
    </div>
    <!-- card-header -->
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-primary mb-3 fw-bold" data-bs-toggle="modal" data-bs-target="#add_client">
                Ajouter
            </button>

            <?php if (isset($_POST['rechercher_client']) and !empty($_POST['c'])) : ?>
                <div id="search-message" class="text-danger fw-bold text-center">
                    <h4>La liste des clients est filtr?? par le mot
                        (<?= e($_POST['c']) ?>)
                    </h4>
                </div>
            <?php endif ?>


        </div>
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
                                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="num" class="form-label">Num??ro:</label>
                                        <input type="number" class="form-control" name="num" id="num" placeholder="Num??ro:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ville" class="form-label">Ville:</label>
                                        <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tele" class="form-label">T??l??phone:</label>
                                        <input type="number" class="form-control" name="telephone" id="tele" placeholder="T??l??phone:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="adresse" class="form-label">Adresse:</label>
                                        <textarea type="number" class="form-control" name="adresse" id="adresse" placeholder="Adresse:"></textarea>
                                    </div>
                                </div>
                                <!-- col -->
                            </div>
                            <!-- row -->
                        </div>
                        <!-- modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" name="ajouter_client" class="btn btn-primary">Ajouter</button>
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
                <tr class="table-dark <!-- light -->">
                    <th>Id</th>
                    <th>Num</th>
                    <th>Nom</th>
                    <th>T??l??phone</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th>Adresse</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($clients as $key => $c) : ?>
                <tr>
                    <td>
                        <?= $c['id'] ?>
                    </td>
                    <td>
                        C:<?= add_zero($c['num']) ?>
                    </td>
                    <td>
                        <?= ucwords($c['nom']) ?>
                    </td>
                    <td>
                        <?= $c['telephone'] ?>
                    </td>
                    <td>
                        <?= $c['email'] ?>
                    </td>
                    <td>
                        <?= ucwords($c['ville']) ?>
                    </td>
                    <td>
                        <?= ucwords($c['adresse']) ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#show_client<?= $c['id'] ?>">
                            Afficher
                        </button>

                        <div class="modal fade" id="show_client<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
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
                                            <dd class="col-sm-9"><?= ucwords($c['nom']) ?></dd>

                                            <dt class="col-sm-3">Num??ro:</dt>
                                            <dd class="col-sm-9">C:<?= add_zero($c['num']) ?></dd>

                                            <dt class="col-sm-3">Email:</dt>
                                            <dd class="col-sm-9"><?= $c['email'] ?></dd>

                                            <dt class="col-sm-3">T??l??phone:</dt>
                                            <dd class="col-sm-9"><?= $c['telephone'] ?></dd>

                                            <dt class="col-sm-3">Ville:</dt>
                                            <dd class="col-sm-9"><?= ucwords($c['ville']) ?></dd>

                                            <dt class="col-sm-3">Adresse:</dt>
                                            <dd class="col-sm-9">
                                                <?= ucwords($c['adresse']) ?>
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

                        <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#update_client_<?= $c['id'] ?>">
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
                                                        <label for="num" class="form-label">Num??ro:</label>
                                                        <input type="number" class="form-control" name="num" id="num" placeholder="Num??ro:" value="<?= $c['num'] ?>">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="nom" class="form-label">Nom:</label>
                                                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom:" value="<?= $c['nom'] ?>">
                                                    </div>
                                                </div>
                                                <!-- col -->


                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email:</label>
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email:" value="<?= $c['email'] ?>">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="ville" class="form-label">Ville:</label>
                                                        <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville:" value="<?= $c['ville'] ?>">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="tele" class="form-label">T??l??phone:</label>
                                                        <input type="number" class="form-control" name="telephone" id="tele" placeholder="T??l??phone:" value="<?= $c['telephone'] ?>">
                                                    </div>
                                                </div>
                                                <!-- col -->
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="adresse" class="form-label">Adresse:</label>
                                                        <textarea type="number" class="form-control" name="adresse" id="adresse" placeholder="Adresse:"><?= $c['adresse'] ?>
                                                        </textarea>


                                                    </div>
                                                </div>
                                                <!-- col -->
                                            </div>
                                            <!-- row -->
                                            <input type="hidden" name="client_id" value="<?= $c['id'] ?>">
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
                        <!-- modal -->

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_client<?= $c['id'] ?>">
                            Supprimer
                        </button>

                        <div class="modal fade" id="delete_client<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
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
                                                Voulez vous vraiment supprimer <?= $c['nom'] ?> ?
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
                        <!-- modal -->
                    </td>
                </tr>


            <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div>
<!-- card-body -->
</div>
<!-- card -->



<?php $content_html = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    setTimeout(function() {
        document.getElementById('search-message').style.display = 'none'
    }, 5000)
</script>

<?php $content_js = ob_get_clean(); ?>