<?php

ob_start();
// php
$title = "Clients";

if (isset($_POST['ajouter_client'])) {

    $nom = e($_POST['nom']);
    $numero = (int)$_POST['numero'];


$client = $db->prepare("INSERT INTO clients SET 
            nom = :nom,
            numero = :numero
            
        ");

    $client->execute(
        [
            'nom' => $nom,
            'numero' => $numero
            
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
    $telepone = (int)$_POST['telepone'];
    $client_id = (int) $_POST['client_id'];

    $client = $db->query("UPDATE clients SET nom = '$nom', numero = $numero WHERE id = $client_id");

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

    $client = $db->query("UPDATE clients SET deleted_at = NOW() WHERE id = $client_id");
    
    if ($client) {
        $_SESSION['flash']['info'] = 'Bien supprimer';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: clients');
    exit();
}

$filter = '';

if (isset($_POST['rechercher_client'])) {
    $c = trim($_POST['c']);
    $filter =  " AND ";
    $filter .=  " ( ";
    $filter .= " nom LIKE '%" .  $c . "%'";

    $filter .=  " OR ";
    $filter .= " numero LIKE '%{$c}%'";

    $filter .=  " OR ";
    $filter .= " telepone LIKE '%" . trim($_POST['c']) . "%'";
    $filter .=  " ) ";
}

$clients = $db->query("SELECT * FROM clients WHERE deleted_at IS NULL $filter ")->fetchAll();

$content_php = ob_get_clean();


ob_start(); ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item active" aria-current="pnum">Liste clients</li>
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
    <div class="d-flex justify-content-between mb-3">
        <button type="button" class="btn btn-primary mb-3 fw-bold" data-bs-toggle="modal" data-bs-target="#add_client">
            Ajouter
        </button>

        <?php if (isset($_POST['c'])) : ?>
                <div class="me-5">
                    <h4>La liste des clients est filtré par le mot
                        <b>
                            (<?= trim($_POST['c']) ?>)
                        </b>
                    </h4>
                    
                </div>
            <?php endif ?>

            <div>


                <form method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Rechercher:" name="c" value="<?= isset($_POST['c']) ? trim($_POST['c']) : '' ?>">
                        <button class="btn btn-outline-secondary" type="submit" name="rechercher_client">Rechercher</button>
                    </div>
                </form>
            </div>
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
                                        <label for="num" class="form-label">Numéro:</label>
                                        <input type="number" class="form-control" name="numero" id="numero" placeholder="Numéro:">
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
                            <button type="submit" name="ajouter_client" class="btn btn-primary">Ajouter</button>
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
                    <th>Téléphone</th>
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
                                <?= $c['numero'] ?>
                            </td>
                            <td>
                                <?= $c['nom'] ?>
                            </td>
                            <td>
                                <?= $c['telepone'] ?>
                            </td>
                            <td>
                                <?= $c['email'] ?>
                            </td>
                            <td>
                                <?= $c['ville'] ?>
                            </td>
                            <td>
                                <?= $c['adresse'] ?>
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
                                            <dd class="col-sm-9"><?= $c['nom'] ?></dd>

                                            <dt class="col-sm-3">Numéro:</dt>
                                            <dd class="col-sm-9"><?= $c['numero'] ?></dd>

                                            <dt class="col-sm-3">Email:</dt>
                                            <dd class="col-sm-9"><?= $c['email'] ?></dd>

                                            <dt class="col-sm-3">Téléphone:</dt>
                                            <dd class="col-sm-9"><?= $c['telepone'] ?></dd>

                                            <dt class="col-sm-3">Ville:</dt>
                                            <dd class="col-sm-9"><?= $c['ville'] ?></dd>

                                            <dt class="col-sm-3">Adresse:</dt>
                                            <dd class="col-sm-9">
                                            <?= $c['adresse'] ?>
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

                        <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#update_client<?= $c['id'] ?>">
                            Modifier
                        </button>

                        <div class="modal fade" id="update_client<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
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
                                                        <input type="number" class="form-control" id="numero" placeholder="Numéro:" value="<?= $c['numero'] ?>">
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
                                                        <input type="number" class="form-control" id="tele" placeholder="Téléphone:" value="<?= $c['telepone'] ?>">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="adresse" class="form-label">Adresse:</label>
                                                        <textarea type="number" class="form-control" id="adresse" placeholder="Adresse:"><?= $c['adresse'] ?>
                                                        </textarea>
                                                        
                                                        
                                                    </div>
                                                </div>
                                                <!-- col -->
                                            </div>
                                            <!-- row -->
                                        </div>
                                        <input type="hidden" name="client_id" value="<?= $c['id'] ?>">
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