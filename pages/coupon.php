<?php

ob_start();
// php
$title = "Coupon";

if (isset($_POST['ajouter_coupon'])) {

    $code = e(strtolower($_POST['code']));
    $montant = (float)$_POST['montant'];
    $status = (int)$_POST['status'] ? 1 : 0;

    $coupon = $pdo->prepare("INSERT INTO coupons SET code = :code, montant = :montant, status = :status");

    $coupon->execute(
        [
            'code' => $code, 'montant' => $montant, 'status' => $status
        ]
    );

    if ($coupon) {
        $_SESSION['flash']['info'] = 'Bien ajouter';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location: coupon');
    exit();
}

if (isset($_POST['modifier_coupon'])) {

    $code = e(strtolower($_POST['code']));
    $montant = (float)$_POST['montant'];
    $status = (int)$_POST['status'] ? 1 : 0;

    $coupon_id = (int)$_POST['coupon_id'];

    $coupon = $pdo->prepare("UPDATE coupons SET
    code = :code,
    montant = :montant,
    status = :status,
    updated_at = NOW()
    WHERE id = :id");

    $coupon->execute(
        [
            'code' => $code, 'montant' => $montant, 'status' => $status, 'id' => $coupon_id
        ]
    );

    if ($coupon) {
        $_SESSION['flash']['info'] = 'Bien modifier';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!!';
    }

    header('Location:coupon');
    exit();
}

if (isset($_POST['supprimer_coupon'])) {

    $coupon_id = (int)$_POST['coupon_id'];


    $commande = $pdo->prepare("SELECT id FROM coupons WHERE id = :coupon_id LIMIT 1");

    $commande->execute(
        [
            'coupon_id' => $coupon_id
        ]
    );

    $coupon_info = $commande->fetch();

    if ($coupon_info) {

        $coupon = $pdo->prepare("UPDATE coupons SET deleted_at = NOW() WHERE id = :coupon_id");

        $coupon->execute(
            [
                'coupon_id' => $coupon_id
            ]
        );
        if ($coupon) {
            $_SESSION['flash']['info'] = 'Bien supprimer';
        } else {
            $_SESSION['flash']['danger'] = 'Error !!!';
        }
    } else {
        $_SESSION['flash']['danger'] = "Error coupon introuvable";
    }

    header('Location: coupon');
    exit();
}

$coupons = $pdo->query("SELECT * FROM coupons WHERE deleted_at IS NULL ORDER BY id DESC")->fetchAll();

$content_php = ob_get_clean();

ob_start(); ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableu de bord</a></li>
        <li class="breadcrumb-item active" aria-current="pnum">Liste coupons</li>
    </ol>
</nav>

<h4 class="fw-bold mb-3">Liste coupons code</h4>

<div class="card">
    <div class="card-header">
        <h6 class="fw-bold">
            Liste coupons code
        </h6>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-primary mb-3 fw-bold" data-bs-toggle="modal" data-bs-target="#add_coupon">
                Ajouter
            </button>

        </div>
        <div class="modal fade" id="add_coupon" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">
                            Ajouter un coupon
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">

                            <div class="row">


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Code:</label>
                                        <input type="text" class="form-control" name="code" id="code" placeholder="Code:">
                                    </div>
                                </div>
                                <!-- col -->

                                <div class=" col-md-6">
                                    <div class="mb-3">
                                        <label for="montant" class="form-label">Montant:</label>
                                        <input type="number" class="form-control" name="montant" id="montant" placeholder="Montant:">
                                    </div>
                                </div>
                                <!-- col -->

                                <!-- <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status:</label>

                                        <select name="status" id="status" class="form-select">
                                            <option value="0">Expire</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div> -->
                                <!-- col -->

                                <div class="col-md-12">

                                    <div class="form-check ">
                                        <input class="form-check-input" value="0" type="radio" name="status" id="expire" checked>
                                        <label class="form-check-label" for="expire">
                                            Expire
                                        </label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" value="1" type="radio" name="status" id="active">
                                        <label class="form-check-label" for="active">
                                            Active
                                        </label>
                                    </div>

                                </div>
                                <!-- col -->

                            </div>
                            <!-- row -->
                        </div>
                        <!-- modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" name="ajouter_coupon" class="btn btn-primary">Ajouter</button>
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
                <tr class="table-dark">
                    <th>Id</th>
                    <th>Code</th>
                    <th>Montant</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($coupons as $key => $c) : ?>
                <tr>
                    <td>
                        <?= $c['id'] ?>
                    </td>
                    <td>
                        <?= strtoupper($c['code']) ?>
                    </td>
                    <td>
                        <?= _number_format($c['montant']) ?>
                    </td>
                    <td>

                        <span class="badge text-bg-<?= $c['status'] ? 'success' : 'danger' ?>"><?= $c['status'] ? 'Active' : 'Expire' ?></span>
                    </td>

                    <td>

                        <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#update_coupon_<?= $c['id'] ?>">
                            Modifier
                        </button>

                        <div class="modal fade" id="update_coupon_<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
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
                                                        <label for="code" class="form-label">Code:</label>
                                                        <input type="text" class="form-control" name="code" id="code" placeholder="Code:" value="<?= $c['code'] ?>">
                                                    </div>
                                                </div>
                                                <!-- col -->

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="montant" class="form-label">Montant:</label>
                                                        <input type="number" class="form-control" name="montant" id="montant" placeholder="Montant:" value="<?= $c['montant'] ?>">
                                                    </div>
                                                </div>
                                                <!-- col -->


                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status:</label>

                                                        <select name="status" id="status" class="form-select">
                                                            <option value="0" <?= !$c['status'] ? 'selected' : '' ?>>
                                                                Expire
                                                            </option>
                                                            <option value="1" <?= $c['status'] ? 'selected' : '' ?>>
                                                                Active
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- col -->

                                            </div>
                                            <!-- row -->
                                            <input type="hidden" name="coupon_id" value="<?= $c['id'] ?>">
                                        </div>

                                        <!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" name="modifier_coupon" class="btn btn-success">
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

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_coupon<?= $c['id'] ?>">
                            Supprimer
                        </button>

                        <div class="modal fade" id="delete_coupon<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
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
                                                Voulez vous vraiment supprimer <?= strtoupper($c['code']) ?> ?
                                            </h5>

                                        </div>
                                        <!-- modal-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <input type="hidden" name="coupon_id" value="<?= $c['id'] ?>">
                                            <button type="submit" name="supprimer_coupon" class="btn btn-danger">
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

<?php $content_js = ob_get_clean(); ?>