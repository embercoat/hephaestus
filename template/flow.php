<?php
foreach($posts as $p){
?>
<div class="post">
<h1><a href="/post/<?php echo model::factory('renderer')->url_safe($p['idpost'].':'.strtolower($p['title'])); ?>"><?php echo $p['title']; ?></a></h1>
<div class="post_body">
<?php echo substr($p['content'], 0, 500).((strlen($p['content']) >= 500) ? '....' : ''); ?>
</div>
<div class="post_footer">Postad <?php echo date('Y m d H:i', $p['timestamp']); ?> av <?php echo model::factory('user')->get_username_by_id($p['author']); ?></div>
</div>
<?php } ?>