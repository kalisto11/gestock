<?php if (isset($notification->contenu) && $notification->contenu != null) : ?>
    <div id="notification" class="alert alert-<?= $notification->type ?>" role="alert">
        <div class="row">
            <div class="col-10"><?= $notification->contenu ?></div>
            <div class="col-2"><button id="btn-fermer" class="btn btn-info btn-sm">Fermer</button></div>
        </div>
    </div>
<?php endif ; ?>