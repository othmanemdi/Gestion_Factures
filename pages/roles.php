<?php

ob_start();
// php
$title = "roles";
$errors = [];

$couleurs = $pdo->query("SELECT * FROM couleurs WHERE deleted_at IS NULL")->fetchALL();

if (isset($_POST['add_role'])) {
    $nom = e($_POST['nom']);
    $color = e($_POST['color']);
    $role = $pdo->prepare("INSERT INTO roles SET nom = :nom, color = :color");
    $role->execute(
        [
            'nom' => $nom,
            'color' => $color
        ]
    );
    if ($role) {
        $_SESSION['flash']['info'] = 'Bien ajouter';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!';
    }
    header('location: roles');
    exit();
}
if (isset($_POST['update_role'])) {
    $role_id = (int)$_POST['role_id'];
    $nom = e($_POST['nom']);
    $color = e($_POST['color']);
    $role = $pdo->prepare("UPDATE roles SET nom = :nom, color = :color WHERE id = :role_id ");
    $role->execute(
        [
            'nom' => $nom,
            'color' => $color,
            'role_id' => $role_id
        ]
    );
    // dd($_POST);
    // exit();
    if ($role) {
        $_SESSION['flash']['info'] = 'Bien modifier';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!';
    }
    header('location: roles');
    exit();
}

if (isset($_POST['delete_role'])) {
    $role_id = (int)($_POST['role_id']);
    $role = $pdo->prepare("UPDATE roles SET deleted_at = NOW() WHERE id = :role_id ");
    $role->execute(
        [
            'role_id' => $role_id
        ]
    );
    // dd($_POST);
    // exit();
    if ($role) {
        $_SESSION['flash']['info'] = 'Bien supprimer';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!';
    }
    header('location: roles');
    exit();
}
$search = '';
if (isset($_POST['search_role'])) {
    $role = e($_POST['role']);
    $search = "AND nom lIKE '%" . $role . "%'";
    // dd($_POST);
    // exit();
}
$roles = $pdo->query("SELECT * FROM roles WHERE deleted_at IS NULL $search ORDER BY id DESC")->fetchAll();

// dd($roles);



$content_php = ob_get_clean();


ob_start(); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="pag"> Liste des roles</li>
    </ol>
</nav>
<form method="POST" class="d-flex py-2 col-6 mx-auto">
    <div class="input-group mb-3 me-2">
        <input type="text" class="form-control" placeholder="Search" name="role" value="<?= isset($_POST['role']) ? e($_POST['role']) : '' ?>" width="10" aria-label="search" aria-describedby="button-addon2">
        <button class="btn btn-outline-dark" type="submit" name="search_role" id="button-addon2"><i class="bi bi-search"></i></button>
    </div>
</form>

<div class="card">
    <div class="card-header">
        <h5 class="fw-bold">
            Liste des roles
        </h5>
    </div>
    <!-- card-header -->
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus-lg fw-bold"></i>
            Ajouter
        </button>
        <?php if (isset($_POST['search_role']) and !empty($_POST['role'])) : ?>
            <div id="search-message" class="text-danger fw-bold text-center">
                <h5>La liste des roles est filtré par le mot
                    (<?= e($_POST['role']) ?>)
                </h5>
            </div>
        <?php endif ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un role</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom:</label><br>
                                        <input type="text" class="form-control" placeholder="Ex: Phone" id="name" name="nom">
                                    </div>
                                    <!-- mb-3 -->
                                </div>
                                <!-- col -->

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="color" class="form-label">Couleurs:</label><br>
                                        <select name="color" id="color" class="form-select">
                                            <?php foreach ($couleurs as $key => $value) : ?>
                                                <option value="<?= $value['nom'] ?>"><?= ucfirst($value['nom']) ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <!-- mb-3 -->
                                </div>
                                <!-- col -->

                            </div>
                            <!-- row -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i>
                                Fermer
                            </button>
                            <button type="submit" name="add_role" class="btn btn-success">
                                <i class="bi bi-check-lg"></i>
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->
        <table class="table table-sm table-bordered mt-3">
            <thead>
                <tr class="table-light ">
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Couleur</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $key => $c) : ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= ucwords($c['nom']) ?></td>
                        <td>
                            <i class="bi bi-circle-fill" style="color:<?= $c['color'] ?>"></i> <?= ucfirst($c['color']) ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-dark btn-sm fw-bold-sm" data-bs-toggle="modal" data-bs-target="#update_role_<?= $c['id'] ?>">
                                <i class="bi bi-wrench-adjustable-circle"></i>
                                Modifier
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="update_role_<?= $c['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Modifier role</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form method="post">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nom:</label><br>
                                                            <input type="text" class="form-control" placeholder="role:" id="nom" name="nom" value="<?= ucwords($c['nom']) ?>">
                                                        </div>
                                                        <!-- mb-3 -->
                                                    </div>
                                                    <!-- col -->

                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="color" class="form-label">Couleurs:</label><br>
                                                            <select name="color" id="color" class="form-select">
                                                                <?php foreach ($couleurs as $key => $value) : ?>
                                                                    <option <?= $value['nom'] == $c['color'] ? 'selected' : ''  ?> value="<?= $value['nom'] ?>"><?= ucfirst($value['nom']) ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                        <!-- mb-3 -->
                                                    </div>
                                                    <!-- col -->

                                                </div>
                                                <!-- row -->
                                            </div>
                                            <!-- modal-body -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-lg"></i>
                                                    Fermer
                                                </button>
                                                <input type="hidden" name="role_id" value="<?= ($c['id']) ?>">
                                                <button type="submit" name="update_role" class="btn btn-success">
                                                    <i class="bi bi-wrench-adjustable-circle"></i>
                                                    Modifier
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- modal -->
                            <button type="button" class="btn btn-danger btn-sm fw-bold-sm" data-bs-toggle="modal" data-bs-target="#delete_role_<?= $c['id'] ?>">
                                <i class="bi bi-trash3"></i>
                                supprimer
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="delete_role_<?= $c['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Supprimer role</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form method="post">
                                            <div class="modal-body">
                                                <h5 class="text-danger fw-bold"> Voulez vous vraimenet supprimer la role <?= ucwords($c['nom']) ?> ?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-lg"></i>
                                                    Fermer
                                                </button>
                                                <input type="hidden" name="role_id" value="<?= ($c['id']) ?>">
                                                <button type="submit" name="delete_role" class="btn btn-danger">
                                                    <i class="bi bi-trash3"></i>
                                                    supprimer
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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