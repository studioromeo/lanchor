<?php
    $presenter = new Anchor\Core\Pagination\Presenter($paginator);
?>

<?php if ($paginator->getLastPage() > 1): ?>
    <aside class="paging">
        <?php echo $presenter->render(); ?>
    </aside>
<?php endif; ?>
