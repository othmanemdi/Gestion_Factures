<?php

ob_start();
// php
$title = "Order Details";

$command_id = $_GET['id'];

$order_info = $pdo->query("SELECT 
c.*,
cl.num AS client_num,
cl.nom AS client_nom,
cl.email AS client_email,
cl.ville AS client_ville,
cl.adresse AS client_adresse,
cl.telephone AS client_telephone,
s.nom AS status_nom,
s.color AS status_color
FROM commandes c
LEFT JOIN clients cl ON cl.id = c.client_id
LEFT JOIN status s ON s.id = c.status_id
WHERE c.id = $command_id
LIMIT 1")->fetch();

$num_commande = "BC:" . add_zero($order_info['num'], 4) . "-" . _date_format_year($order_info['date_commande']) . "/C:" . $order_info['client_num'];
$date_commande = _date_format($order_info['date_commande']);

$status_color = $order_info['status_color'];
$status_nom = ucwords($order_info['status_nom']);

$client_num = $order_info['client_num'];
$client_nom =  ucwords($order_info['client_nom']);
$client_email =  strtolower($order_info['client_email']);
$client_ville =  strtoupper($order_info['client_ville']);
$client_telephone = $order_info['client_telephone'];
$client_adresse =  ucwords($order_info['client_adresse']) . " " . $client_ville;

$products = $pdo->query("SELECT 
cp.*,
p.image,
p.reference,
p.designation,
p.prix
FROM commande_produit cp
LEFT JOIN produits p ON p.id = cp.produit_id 
WHERE cp.commande_id = $command_id
")->fetchAll();

$quantite_total_commande = $prix_total_commande = 0;

$content_php = ob_get_clean();

ob_start(); ?>

<h3>
    Détails de la commande numéro <?= $num_commande ?>
</h3>

<div class="card mt-2 border border-<?= $status_color ?>">

    <div class="card-header">
        <h6 class="fw-bold">
            Détails de la commande <?= $num_commande ?>
        </h6>
    </div>
    <!-- card-header -->

    <div class="card-body">
        <div class="row">
            <div class="col">
                <dl class="row">
                    <dt class="col-md-5">
                        Numéro de commande:
                    </dt>
                    <dd class="col-md-7">
                        <?= $num_commande ?>
                    </dd>

                    <dt class="col-md-5">
                        Date de commande:
                    </dt>
                    <dd class="col-md-7">
                        <?= $date_commande ?>
                    </dd>

                    <dt class="col-md-5">Status:</dt>
                    <dd class="col-md-7">
                        <span class="badge bg-<?= $status_color ?>">
                            <?= $status_nom  ?>
                        </span>
                    </dd>

                </dl>
            </div>
            <!-- col -->

            <div class="col">
                <dl class="row">
                    <dt class="col-md-5">
                        Client:
                    </dt>
                    <dd class="col-md-7">
                        <?= $client_nom ?>
                    </dd>

                    <dt class="col-md-5">
                        Email:
                    </dt>
                    <dd class="col-md-7">
                        <?= $client_email ?>
                    </dd>


                    <dt class="col-md-5">
                        Téléphone:
                    </dt>
                    <dd class="col-md-7">
                        <?= $client_telephone ?>
                    </dd>

                    <dt class="col-md-5">
                        Adresse:
                    </dt>
                    <dd class="col-md-7">
                        <?= $client_adresse ?>
                    </dd>


                </dl>
            </div>
            <!-- col -->
        </div>
        <!-- row1 -->



        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Img</th>
                        <th>Référence</th>
                        <th>Désignation</th>
                        <th>Quantité</th>
                        <th>Prix U</th>
                        <th>Prix Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($products as $key => $p) : ?>
                        <?php
                        $prix = get_price($p['prix']);
                        $quantite = $p['quantite'];
                        $prix_total = $prix * $quantite;
                        $quantite_total_commande += $quantite;
                        $prix_total_commande += $prix_total;
                        ?>
                        <tr>
                            <td>
                                <?= $p['id'] ?>
                            </td>
                            <td>
                                <img width="30" src="images/produits/<?= $p['image'] ?>" alt="">
                            </td>
                            <td>
                                <?= strtoupper($p['reference']) ?>
                            </td>
                            <td>
                                <?= strtoupper($p['designation']) ?>
                            </td>
                            <td>
                                <?= $quantite ?>
                            </td>
                            <td>
                                <?= _number_format($prix) ?> DH
                            </td>
                            <td>
                                <?= _number_format($prix_total) ?> DH
                            </td>
                            <td></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total:</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                            <?= $quantite_total_commande ?>
                        </th>
                        <th></th>
                        <th>
                            <?= _number_format($prix_total_commande) ?> DH
                        </th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- card-body -->
</div>

<!-- card -->


<?php $content_html = ob_get_clean(); ?>