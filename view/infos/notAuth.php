<?php if (isset($_SESSION['notification'])) : ?>
    <div id="notification" class="alert alert-<?= $_SESSION['notification']['type']?>">
        <div > 
            <?= $_SESSION['notification']['message'] ?>
            <?php unset($_SESSION['notification']); ?>
        </div>
    </div>
<?php endif ; ?>