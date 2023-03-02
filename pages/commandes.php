<?php

ob_start();
// php
$title = "Commandes";


if (isset($_POST['add_order'])) {

    $num = (int)$_POST['num'];
    $date_commande = e($_POST['date_commande']);
    $client_id = (int)$_POST['client_id'];
    $status_id = (int)$_POST['status_id'];

    $commande = $pdo->prepare("INSERT INTO commandes SET num = :num, date_commande = :date_commande, client_id = :client_id, status_id = :status_id");

    $commande->execute(
        [
            'num' => $num, 'date_commande' => $date_commande, 'client_id' => $client_id, 'status_id' => $status_id
        ]
    );

    if ($commande) {
        $_SESSION['flash']['info'] = 'Bien ajouter';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: commandes');
    exit();
}

if (isset($_POST['update_order'])) {

    $commande_id = (int)$_POST['commande_id'];
    $num = (int)$_POST['num'];
    $date_commande = e($_POST['date_commande']);
    $client_id = (int)$_POST['client_id'];
    $status_id = (int)$_POST['status_id'];

    $commande = $pdo->prepare("UPDATE commandes SET num = :num, date_commande = :date_commande, client_id = :client_id, status_id = :status_id WHERE id = :commande_id");

    $commande->execute(
        [
            'num' => $num, 'date_commande' => $date_commande, 'client_id' => $client_id, 'status_id' => $status_id, 'commande_id' => $commande_id
        ]
    );

    if ($commande) {
        $_SESSION['flash']['info'] = 'Bien modifier';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: commandes');
    exit();
}


if (isset($_POST['cancel_order'])) {

    $commande_id = (int)$_POST['commande_id'];

    $commande = $pdo->prepare("UPDATE commandes SET status_id = :status_id WHERE id = :commande_id");

    $commande->execute(
        [
            'status_id' => 4, 'commande_id' => $commande_id
        ]
    );

    if ($commande) {
        $_SESSION['flash']['info'] = 'Bien annuler';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: commandes');
    exit();
}

$last_order_num = $pdo->query("SELECT max(num) As last_num FROM commandes_view limit 1")->fetch()['last_num'] + 1;

$commandes = $pdo->query("SELECT * FROM commandes_view ORDER BY date_commande DESC")->fetchAll();

$clients = $pdo->query("SELECT * FROM clients WHERE deleted_at IS NULL")->fetchAll();
$status = $pdo->query("SELECT * FROM status WHERE deleted_at IS NULL")->fetchAll();


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
                            Ajouter produits
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="num" class="form-label">Numéro:</label>
                                        <input type="number" class="form-control" id="num" name="num" placeholder="Numéro:" value="<?= $last_order_num ?>">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_commande" class="form-label">Date commande:</label>
                                        <input type="date" class="form-control" id="date_commande" name="date_commande" value="<?= date('Y-m-d') ?>">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="client_id" class="form-label">
                                            Clients:
                                        </label>

                                        <select name="client_id" class="form-select">
                                            <?php foreach ($clients as $key => $c) : ?>
                                                <option value="<?= $c['id'] ?>">
                                                    <?= ucwords($c['nom']) ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status_id" class="form-label">
                                            Status:
                                        </label>

                                        <select name="status_id" class="form-select">
                                            <?php foreach ($status as $key => $s) : ?>
                                                <option value="<?= $s['id'] ?>">
                                                    <?= ucwords($s['nom']) ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- col -->

                            </div>
                            <!-- row -->
                        </div>
                        <!-- modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" name="add_order" class="btn btn-primary">
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
                    <th>Num</th>
                    <th>Date commande</th>
                    <th>Num client</th>
                    <th>Nom client</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $key => $c) : ?>

                    <?php

                    switch ($c['status_color']) {
                        case 'danger':
                            $class = "table-danger text-danger fw-bold";
                            break;

                        case 'success':
                            $class = "text-success fw-bold";
                            break;

                        case 'warning':
                            $class = "text-warning fw-bold";
                            break;

                        default:
                            $class = "";
                            break;
                    }
                    ?>

                    <tr class="<?= $class  ?>">
                        <td><?= $c['commande_num'] ?></td>
                        <td><?= $c['date_commande_format'] ?></td>
                        <td>
                            C:<?= add_zero($c['client_num'], 3) ?>
                        </td>
                        <td>
                            <?= ucwords($c['client_nom']) ?>
                        </td>
                        <td>
                            <span class="badge bg-<?= $c['status_color'] ?>">
                                <?= ucwords($c['status_nom']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="order_details&id=<?= $c['id'] ?>" class="btn btn-link btn-sm">Show</a>


                            <a href="commande_afficher&id=<?= $c['id'] ?>" class="btn btn-link btn-sm">Afficher</a>

                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#update_order_<?= $c['id'] ?>">
                                Modifier
                            </button>

                            <div class="modal fade" id="update_order_<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">
                                                Modifier la commande
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="num" class="form-label">Numéro:</label>
                                                            <input type="number" class="form-control" id="num" name="num" placeholder="Numéro:" value="<?= $c['num'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="date_commande" class="form-label">Date commande:</label>
                                                            <input type="date" class="form-control" id="date_commande" name="date_commande" value="<?= $c['date_commande'] ?>">
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="client_id" class="form-label">
                                                                Clients:
                                                            </label>

                                                            <select name="client_id" class="form-select">
                                                                <?php foreach ($clients as $key => $cl) : ?>
                                                                    <option <?= $cl['id'] == $c['client_id'] ? 'selected' : '' ?> value="<?= $cl['id'] ?>">
                                                                        <?= ucwords($cl['nom']) ?>
                                                                    </option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="status_id" class="form-label">
                                                                Status:
                                                            </label>

                                                            <select name="status_id" class="form-select">
                                                                <?php foreach ($status as $key => $s) : ?>
                                                                    <option <?= $s['id'] == $c['status_id'] ? 'selected' : '' ?> value="<?= $s['id'] ?>">
                                                                        <?= ucwords($s['nom']) ?>
                                                                    </option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- col -->

                                                </div>
                                                <!-- row -->
                                            </div>
                                            <!-- modal-body -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                <input type="hidden" name="commande_id" value="<?= $c['id'] ?>">
                                                <button type="submit" name="update_order" class="btn btn-primary">
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

                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#cancel_order_<?= $c['id'] ?>">
                                Annuler
                            </button>

                            <div class="modal fade" id="cancel_order_<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">
                                                Annuler la commande
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">

                                                <h5 class="text-danger fw-bold">
                                                    Voulez-vous vraiment annuler la commande N° <?= $c['commande_num'] ?>
                                                </h5>
                                            </div>
                                            <!-- modal-body -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                <input type="hidden" name="commande_id" value="<?= $c['id'] ?>">
                                                <button type="submit" name="cancel_order" class="btn btn-danger">
                                                    Annuler
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