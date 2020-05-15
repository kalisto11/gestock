<?php if (isset($_SESSION['notification'])) : ?>
    <div id="notifwelcome" class="alert alert-<?= $_SESSION['notification']['type']?>">
        <div > 
            <?= $_SESSION['notification']['message'] ?>
            <?php unset($_SESSION['notification']); ?>
        </div>
    </div>
<?php endif ; ?>