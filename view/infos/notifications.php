<?php if (isset($message['contenu']) && $message['contenu'] != null) : ?>
    <div id="notification" class="alert alert-<?= $message['type'] ?>" role="alert">
        <div class="row">
            <div class="col-10"><?= $message['contenu'] ?></div>
            <div class="col-2"><button id="btn-fermer" class="btn btn-info btn-sm">Fermer</button></div>
        </div>
    </div>
<?php endif ; ?>