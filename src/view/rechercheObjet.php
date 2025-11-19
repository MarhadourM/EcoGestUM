<?php
require_once __DIR__ . '/../model/modelBDD.php';

$search = $_GET['search'] ?? '';
$etat = $_GET['etat'] ?? '';
$categorie = $_GET['categorie'] ?? '';
$page = isset($_GET['num']) ? max(1, (int)$_GET['num']) : 1;
$parPage = 9;

$total = get_nb_objets_disponibles($search, $etat, $categorie);
$nbPages = max(1, ceil($total / $parPage));

if ($page > $nbPages) $page = $nbPages;
$objets = get_objets_disponibles($page, $parPage, $search, $etat, $categorie);


?>

<h1 style="text-align:center; margin: 32px 0 36px 0; font-size:2em; font-weight:700;">
    Objets Recyclables Disponibles
</h1>
<form method="get" class="search-filter-bar" style="margin: 0 auto 30px auto; display: flex; gap:16px; justify-content:center;">
    <input type="hidden" name="page" value="rechercheObjet" />
    <input type="text" name="search" placeholder="Rechercher…" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" class="search-box" />

    <select name="etat" class="etat-select">
        <option value="">Tous états</option>
        <?php
        $pdo = get_bdd();
        $etats = $pdo->query("SELECT id_etat_obj, nom_etat_obj FROM etat_objet")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($etats as $etat)
            echo '<option value="'.$etat['id_etat_obj'].'" '.(isset($_GET['etat']) && $_GET['etat'] == $etat['id_etat_obj'] ? 'selected' : '').'>'.htmlspecialchars($etat['nom_etat_obj']).'</option>';
        ?>
    </select>
    <select name="categorie" class="categorie-select">
        <option value="">Toutes catégories</option>
        <?php
        $cats = $pdo->query("SELECT id_cat_obj, nom_cat_obj FROM categorie_objet")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cats as $cat)
            echo '<option value="'.$cat['id_cat_obj'].'" '.(isset($_GET['categorie']) && $_GET['categorie'] == $cat['id_cat_obj'] ? 'selected' : '').'>'.htmlspecialchars($cat['nom_cat_obj']).'</option>';
        ?>
    </select>

    <button type="submit" class="search-btn">Filtrer</button>
</form>

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

