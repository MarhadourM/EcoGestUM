<?php
require_once __DIR__ . '/../model/modelBDD.php';


// Gestion réservation : POST + form caché
if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
    isset($_POST['action'], $_POST['id_obj_recycl']) && 
    $_POST['action'] === 'reserver' && 
    !empty($_POST['id_obj_recycl'])) {

    $idObj = (int)$_POST['id_obj_recycl'];
    $idUt = $_SESSION['id_ut'] ?? null;
    if ($idUt) {
        reserver_objet($idObj, $idUt);
        header('Location: rechercheObjet.php?success=1');
        exit;
    }
}

$search = $_GET['search'] ?? '';
$etat = $_GET['etat'] ?? '';
$categorie = $_GET['categorie'] ?? '';
$page = isset($_GET['num']) ? max(1, (int)$_GET['num']) : 1;
$parPage = 9;

$total = get_nb_objets_disponibles($search, $etat, $categorie);
$nbPages = max(1, ceil($total / $parPage));
if ($page > $nbPages) $page = $nbPages;

$objets = get_objets_disponibles($page, $parPage, $search, $etat, $categorie);
$pdo = get_bdd();
?>

<h1 style="text-align:center; margin: 32px 0 36px 0; font-size:2em; font-weight:700;">
    Objets Recyclables Disponibles
</h1>
<form method="get" class="search-filter-bar" style="margin: 0 auto 30px auto; display: flex; gap:16px; justify-content:center;">
    <input type="hidden" name="page" value="rechercheObjet" />
    <input type="text" name="search" placeholder="Rechercher…" value="<?= htmlspecialchars($search) ?>" class="search-box" />

    <select name="etat" class="etat-select">
        <option value="">Tous états</option>
        <?php
        $etats = $pdo->query("SELECT id_etat_obj, nom_etat_obj FROM etat_objet")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($etats as $e)
            echo '<option value="'.$e['id_etat_obj'].'"'.($etat == $e['id_etat_obj'] ? ' selected' : '').'>'.htmlspecialchars($e['nom_etat_obj']).'</option>';
        ?>
    </select>
    <select name="categorie" class="categorie-select">
        <option value="">Toutes catégories</option>
        <?php
        $cats = $pdo->query("SELECT id_cat_obj, nom_cat_obj FROM categorie_objet")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cats as $cat)
            echo '<option value="'.$cat['id_cat_obj'].'"'.($categorie == $cat['id_cat_obj'] ? ' selected' : '').'>'.htmlspecialchars($cat['nom_cat_obj']).'</option>';
        ?>
    </select>
    <button type="submit" class="search-btn">Filtrer</button>
</form>

<?php if (isset($_GET['success'])): ?>
    <div class="message-success">Réservation effectuée avec succès !</div>
<?php endif; ?>
<?php if (isset($_GET['error'])): ?>
    <div class="message-error">Réservation impossible : déjà réservé ou erreur.</div>
<?php endif; ?>

<div class="objets-grid">
<?php foreach ($objets as $obj): ?>
    <div class="objet-card"
        data-nom="<?= htmlspecialchars($obj['nom_obj_recycl']) ?>"
        data-desc="<?= htmlspecialchars($obj['desc_obj_recycl']) ?>"
        data-cat="<?= htmlspecialchars($obj['nom_cat_obj']) ?>"
        data-etat="<?= htmlspecialchars($obj['nom_etat_obj']) ?>"
        data-lieu="<?= htmlspecialchars($obj['loca_obj_recycl']) ?>"
        data-photo="<?= htmlspecialchars($obj['lien_photo']) ?>"
        data-id="<?= $obj['id_obj_recycl'] ?>">
        <?php
        $photo = $obj['lien_photo'];
        // Si URL absolue (photo existante du web), laisse tel quel
        if (strpos($photo, 'http') === 0) {
            $photoSrc = $photo;
        } else {
            $photoSrc = getenv('BASE_URL').'src/assets/imgCache/'.htmlspecialchars($photo);
        }
        ?>
        <img src="<?= $photoSrc ?>" alt="<?= htmlspecialchars($obj['nom_obj_recycl']) ?>" />
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
        <a href="?page=rechercheObjet&num=<?= $i ?>&search=<?= urlencode($search) ?>&etat=<?= urlencode($etat) ?>&categorie=<?= urlencode($categorie) ?>"
           class="pagination-btn<?= ($page == $i ? ' active' : '') ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</div>

<!-- POPUP et OVERLAY (form caché pour réservation) -->
<?php require_once __DIR__ . '/Templates/popupObjet.php'; ?>

<!-- INCLUSION DU JS -->
<script src="<?php echo getenv('BASE_URL'); ?>src/assets/js/popupObjet.js"></script>
