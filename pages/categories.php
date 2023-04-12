<?php

ob_start();
// php
$title = "categories";
$errors = [];

if (isset($_POST['add_categorie'])) {
    $nom = e($_POST['nom']);
    $categorie = $pdo->prepare("INSERT INTO categories SET nom = :nom");
    $categorie->execute(
        [
            'nom' => $nom
        ]
    );
    if ($categorie) {
        $_SESSION['flash']['info'] = 'Bien ajouter';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!';
    }
    header('location: categories');
    exit();
}
if (isset($_POST['update_categorie'])) {
    $categorie_id = (int)$_POST['categorie_id'];
    $nom = e($_POST['nom']);
    $categorie = $pdo->prepare("UPDATE categories SET nom = :nom WHERE id = :categorie_id ");
    $categorie->execute(
        [
            'nom' => $nom,
            'categorie_id' => $categorie_id
        ]
    );
    // dd($_POST);
    // exit();
    if ($categorie) {
        $_SESSION['flash']['info'] = 'Bien modifier';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!';
    }
    header('location: categories');
    exit();
}

if (isset($_POST['delete_categorie'])) {
    $categorie_id = (int)($_POST['categorie_id']);
    $categorie = $pdo->prepare("UPDATE categories SET deleted_at = NOW() WHERE id = :categorie_id ");
    $categorie->execute(
        [
            'categorie_id' => $categorie_id
        ]
    );
    // dd($_POST);
    // exit();
    if ($categorie) {
        $_SESSION['flash']['info'] = 'Bien supprimer';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!';
    }
    header('location: categories');
    exit();
}
$search = '';
if (isset($_POST['search_categorie'])) {
    $categorie = e($_POST['categorie']);
    $search = "AND nom lIKE '%" . $categorie . "%'";
    // dd($_POST);
    // exit();
}
$categories = $pdo->query("SELECT * FROM categories WHERE deleted_at IS NULL $search ORDER BY id DESC")->fetchAll();

// dd($categories);



$content_php = ob_get_clean();


ob_start(); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="pag"> Liste des categories</li>
    </ol>
</nav>
<form method="POST" class="d-flex py-2 col-6 mx-auto">
    <div class="input-group mb-3 me-2">
        <input type="text" class="form-control" placeholder="Search" name="categorie" value="<?= isset($_POST['categorie']) ? e($_POST['categorie']) : '' ?>" width="10" aria-label="search" aria-describedby="button-addon2">
        <button class="btn btn-outline-dark" type="submit" name="search_categorie" id="button-addon2"><i class="bi bi-search"></i></button>
    </div>
</form>

<div class="card">
    <div class="card-header">
        <h5 class="fw-bold">
            Liste des categories
        </h5>
    </div>
    <!-- card-header -->
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus-lg"></i>
            Ajouter une categorie
        </button>
        <?php if (isset($_POST['search_categorie']) and !empty($_POST['categorie'])) : ?>
            <div id="search-message" class="text-danger fw-bold text-center">
                <h5>La liste des categories est filtré par le mot
                    (<?= e($_POST['categorie']) ?>)
                </h5>
            </div>
        <?php endif ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un categorie</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="post">
                        <div class="modal-body">
                            <label for="name" class="form-label">Nom:</label><br>
                            <input type="text" class="form-control" placeholder="Ex: Phone" id="name" name="nom">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i>
                                Fermer
                            </button>
                            <button type="submit" name="add_categorie" class="btn btn-success">
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $key => $c) : ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><i class="bi bi-<?= $c['icon'] ?>"></i> <?= ucwords($c['nom']) ?></td>
                        <td>
                            <button type="button" class="btn btn-dark fw-bold-sm" data-bs-toggle="modal" data-bs-target="#update_categorie_<?= $c['id'] ?>">
                                <i class="bi bi-wrench-adjustable-circle"></i>
                                Modifier
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="update_categorie_<?= $c['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Modifier categorie</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form method="post">
                                            <div class="modal-body">
                                                <label for="name" class="form-label">Nom:</label><br>
                                                <input type="text" class="form-control" placeholder="Categorie:" id="nom" name="nom" value="<?= ucwords($c['nom']) ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-lg"></i>
                                                    Fermer
                                                </button>
                                                <input type="hidden" name="categorie_id" value="<?= ($c['id']) ?>">
                                                <button type="submit" name="update_categorie" class="btn btn-success">
                                                    <i class="bi bi-wrench-adjustable-circle"></i>
                                                    Modifier
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- modal -->
                            <button type="button" class="btn btn-danger fw-bold-sm" data-bs-toggle="modal" data-bs-target="#delete_categorie_<?= $c['id'] ?>">
                                <i class="bi bi-trash3"></i>
                                supprimer
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="delete_categorie_<?= $c['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Supprimer categorie</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form method="post">
                                            <div class="modal-body">
                                                <h5 class="text-danger fw-bold"> Voulez vous vraimenet supprimer la categorie <?= ucwords($c['nom']) ?> ?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-lg"></i>
                                                    Fermer
                                                </button>
                                                <input type="hidden" name="categorie_id" value="<?= ($c['id']) ?>">
                                                <button type="submit" name="delete_categorie" class="btn btn-danger">
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