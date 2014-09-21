<h1><?php echo $page['title']; ?></h1>
<div><?php echo $page['content']; ?></div>
<div id="page_info">Senast ändrad <?php echo date('Y m d H:i', $page['timestamp']); ?> av <?php echo model::factory('user')->get_username_by_id($page['author']); ?></div>

