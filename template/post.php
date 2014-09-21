<h1><?php echo $post['title']; ?></h1>
<div><?php echo $post['content']; ?></div>
<div id="post_info">Publicerad <?php echo date('Y m d H:i', $post['timestamp']); ?> av <?php echo model::factory('user')->get_username_by_id($post['author']); ?></div>

