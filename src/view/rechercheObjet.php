<?php
require_once __DIR__ . '/../model/modelBDD.php';

$page = isset($_GET['num']) ? max(1, (int)$_GET['num']) : 1;
$parPage = 9;
$objets = get_objets_disponibles($page, $parPage);
$total = get_nb_objets_disponibles();
$nbPages = ceil($total / $parPage);
?>

<h1 style="text-align:center; margin: 32px 0 36px 0; font-size:2em; font-weight:700;">
    Objets Recyclables Disponibles
</h1>
<div class="objets-grid">
    <?php foreach ($objets as $obj): ?>
        <div class="objet-card">
            <img src="<?= htmlspecialchars($obj['lien_photo']) ?>" alt="<?= htmlspecialchars($obj['nom_obj_recycl']) ?>" />
            <div class="objet-info">
                <strong><?= htmlspecialchars($obj['nom_obj_recycl']) ?></strong>
                <p><?= htmlspecialchars($obj['loca_obj_recycl']) ?></p>
                <span class="etat"><?= htmlspecialchars($obj['nom_etat_obj']) ?></span>
                <span class="categorie"><?= htmlspecialchars($obj['nom_cat_obj']) ?></span>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="pagination">
    <?php for($i = 1; $i <= $nbPages; $i++): ?>
        <a href="?page=rechercheObjet&num=<?= $i ?>" class="pagination-btn<?= ($page == $i ? ' active' : '') ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</div>

