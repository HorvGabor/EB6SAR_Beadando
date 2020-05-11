<?php require_once PROTECTED_DIR.'userManager.php'; ?>
<?php require_once PROTECTED_DIR.'database.php'; ?>
<?php $game=0; ?>
<?php $url=url('details', ['id' => $game['id']]); ?>
<?php if(IsUserLoggedIn() && $_SESSION['permission'] = 1) : ?>
    <div class="game">
    <a href="<?php echo $url; ?>">
        <?php if($game['cover']) : ?>
            <img src="<?php echo asset("/img/upload/{$game['cover']}")?>">
        <?php else : ?>
            <img src="https://via.placeholder.com/300" alt="<?php echo $game['title']; ?>">
        <?php endif; ?>
    </a>
    <p class="game-title" title="<?php echo $game['title']; ?>">
        <a href="<?php echo $url; ?>">
            <?php echo $game['title']; ?>
        </a>
    </p>
    <p class="game-meta">
        <?php echo $game['publisher']; ?> (<?php echo $game['release_date']; ?>)
    </p>
</div>
<?php endif ?>