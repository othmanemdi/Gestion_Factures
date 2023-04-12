<?php

ob_start();
// php
$title = "couleurs";
$errors = [];
$class_input_validation_name = $class_text_validation_name = "";
$open_modal = false;

// if (isset($_GET['modal_classe_id']))
//     $open_modal = true;

if (isset($_POST['add_couleur'])) {
    $nom = e($_POST['nom']);
    // Old School
    // $req = $pdo->prepare("SELECT count(id) AS ids FROM couleurs WHERE nom = :nom LIMIT 1");
    // $req->execute(['nom' => $nom]);
    // $check_color = $req->fetch()['ids'];

    // if (empty($nom) or !preg_match('/^[a-zA-Z +]+$/', $nom) or strlen($nom) < 3 or $check_color > 0) {

    $req = $pdo->prepare("SELECT id FROM couleurs WHERE nom = :nom LIMIT 1");
    $req->execute(['nom' => $nom]);
    $check_color = $req->rowCount();

    if (empty($nom) or !preg_match('/^[a-zA-Z +]+$/', $nom) or strlen($nom) < 3 or $check_color == 1) {

        if (empty($nom)) {
            $errors['nom'] = "Veuillez saisir ce champs";
        } else {
            if (!preg_match('/^[a-zA-Z +]+$/', $nom)) {
                $errors['nom'] = "Seule les caractaires autorisé";
            } else {
                if (strlen($nom) < 3) {
                    $errors['nom'] = "Entrer plus que 3 caractaire";
                }
            }
        }

        if ($check_color)
            $errors['nom'] = $nom . " existant";

        $class_input_validation_name = "is-invalid";
        $class_text_validation_name = "invalid-feedback";
    } else {
        $class_input_validation_name = "is-valid";
        $class_text_validation_name = "valid-feedback";
    }
    if (empty($errors)) {
        $open_modal = true;

        $couleur = $pdo->prepare("INSERT INTO couleurs SET nom = :nom");
        $couleur->execute(
            [
                'nom' => $nom
            ]
        );
        if ($couleur) {
            $_SESSION['flash']['info'] = 'Bien ajouter';
        } else {
            $_SESSION['flash']['danger'] = 'Error !!';
        }
        header('location: couleurs');
        exit();
    } else {
        // header('location: couleurs&modal_classe_id=1');
        $open_modal = true;
    }
}
if (isset($_POST['update_couleur'])) {
    $couleur_id = (int)$_POST['couleur_id'];
    $nom = e($_POST['nom']);
    $couleur = $pdo->prepare("UPDATE couleurs SET nom = :nom WHERE id = :couleur_id ");
    $couleur->execute(
        [
            'nom' => $nom,
            'couleur_id' => $couleur_id
        ]
    );
    // dd($_POST);
    // exit();
    if ($couleur) {
        $_SESSION['flash']['info'] = 'Bien modifier';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!';
    }
    header('location: couleurs');
    exit();
}

if (isset($_POST['delete_couleur'])) {
    $couleur_id = (int)($_POST['couleur_id']);
    $couleur = $pdo->prepare("UPDATE couleurs SET deleted_at = NOW() WHERE id = :couleur_id ");
    $couleur->execute(
        [
            'couleur_id' => $couleur_id
        ]
    );
    // dd($_POST);
    // exit();
    if ($couleur) {
        $_SESSION['flash']['info'] = 'Bien supprimer';
    } else {
        $_SESSION['flash']['danger'] = 'Error !!';
    }
    header('location: couleurs');
    exit();
}
$search = '';
if (isset($_POST['search_couleur'])) {
    $couleur = e($_POST['couleur']);
    $search = "AND nom lIKE '%" . $couleur . "%'";
    // dd($_POST);
    // exit();
}
$couleurs = $pdo->query("SELECT * FROM couleurs WHERE deleted_at IS NULL $search ORDER BY id DESC")->fetchAll();

// dd($couleurs);



$content_php = ob_get_clean();


ob_start(); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="pag"> Liste des couleurs</li>
    </ol>
</nav>
<form method="POST" class="d-flex py-2 col-6 mx-auto">
    <div class="input-group mb-3 me-2">
        <input type="text" class="form-control" placeholder="Search" name="couleur" value="<?= isset($_POST['couleur']) ? e($_POST['couleur']) : '' ?>" width="10" aria-label="search" aria-describedby="button-addon2">
        <button class="btn btn-outline-dark" type="submit" name="search_couleur" id="button-addon2"><i class="bi bi-search"></i></button>
    </div>
</form>

<div class="card">
    <div class="card-header">
        <h5 class="fw-bold">
            Liste des couleurs
        </h5>
    </div>
    <!-- card-header -->
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_color_modal">
            <i class="bi bi-plus-lg"></i>
            Ajouter une couleur
        </button>
        <?php if (isset($_POST['search_couleur']) and !empty($_POST['couleur'])) : ?>
            <div id="search-message" class="text-danger fw-bold text-center">
                <h5>La liste des couleurs est filtré par le mot
                    (<?= e($_POST['couleur']) ?>)
                </h5>
            </div>
        <?php endif ?>
        <!-- Modal -->
        <div class="modal fade" id="add_color_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un couleur</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="post">
                        <div class="modal-body">
                            <label for="name" class="form-label">Nom:</label><br>

                            <input type="text" class="form-control <?= $class_input_validation_name ?>" name="nom" placeholder="Nom:" value="<?= $_POST['nom'] ?? "" ?>">

                            <div class="<?= $class_text_validation_name ?>">
                                <?= $errors['nom'] ?? "" ?>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i>
                                Fermer
                            </button>
                            <button type="submit" name="add_couleur" class="btn btn-success">
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
                <?php foreach ($couleurs as $key => $c) : ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><i class="bi bi-circle-fill fs-6" style="color:<?= $c['nom'] ?>"></i> <?= ucwords($c['nom']) ?></td>
                        <td>
                            <button type="button" class="btn btn-dark fw-bold-sm" data-bs-toggle="modal" data-bs-target="#update_couleur_<?= $c['id'] ?>">
                                <i class="bi bi-wrench-adjustable-circle"></i>
                                Modifier
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="update_couleur_<?= $c['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Modifier couleur</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form method="post">
                                            <div class="modal-body">
                                                <label for="name" class="form-label">Nom:</label><br>
                                                <input type="text" class="form-control" placeholder="couleur:" id="nom" name="nom" value="<?= ucwords($c['nom']) ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-lg"></i>
                                                    Fermer
                                                </button>
                                                <input type="hidden" name="couleur_id" value="<?= ($c['id']) ?>">
                                                <button type="submit" name="update_couleur" class="btn btn-success">
                                                    <i class="bi bi-wrench-adjustable-circle"></i>
                                                    Modifier
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- modal -->
                            <button type="button" class="btn btn-danger fw-bold-sm" data-bs-toggle="modal" data-bs-target="#delete_couleur_<?= $c['id'] ?>">
                                <i class="bi bi-trash3"></i>
                                supprimer
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="delete_couleur_<?= $c['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Supprimer couleur</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form method="post">
                                            <div class="modal-body">
                                                <h5 class="text-danger fw-bold"> Voulez vous vraimenet supprimer la couleur <?= ucwords($c['nom']) ?> ?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-lg"></i>
                                                    Fermer
                                                </button>
                                                <input type="hidden" name="couleur_id" value="<?= ($c['id']) ?>">
                                                <button type="submit" name="delete_couleur" class="btn btn-danger">
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



<script>
    <?php if ($open_modal) :  ?>
        const modal_adding_color = document.getElementById('add_color_modal');
        const myModal = new bootstrap.Modal('#add_color_modal')
        myModal.show(modal_adding_color)
    <?php endif ?>
</script>






<script>
    // const collor_add = document.getElementById('add_color_modal')
    // collor_add.addEventListener('shown.bs.modal', event => {
    //     show.bs.modal
    // })

    // const collor_add = new bootstrap.Modal('#add_color_modal', {
    //     keyboard: false
    // })
</script>


<!-- 
$new_stagiaire = $modale_id = 0;
$modale_open = $modal_classe_open = false;
if (isset($_GET['new_stagiaire'])) {
$modale_open = true;
$modale_id = 'link_stagiaire';
$new_stagiaire = (int)$_GET['new_stagiaire'];
}

if (isset($_GET['modal_classe_id'])) {
$classe_id = (int)$_GET['modal_classe_id'];
$modal_classe_open = true;
$modale_id = 'modal_classe_' . $classe_id;
} -->


<script>
    // alert(123)



    <?php /* if ($modale_open) : ?>
        const modalToggle = document.getElementById('<?= $modale_id ?>');
        const myModal = new bootstrap.Modal('#<?= $modale_id ?>')
        myModal.show(modalToggle)
    <?php endif ?>

    <?php if ($modal_classe_open) : ?>
        const modalToggle = document.getElementById('<?= $modale_id ?>');
        const myModal = new bootstrap.Modal('#<?= $modale_id ?>')
        myModal.show(modalToggle)
    <?php endif */ ?>
</script>



<?php $content_html = ob_get_clean(); ?>