<table>
    <thead>
        <tr>
            <th style="width:50px;">ID</th>
            <th style="width:200px;">Titel</th>
            <th style="width:200px;">Skribent</th>
            <th style="width:200px;">Mods</th>
    </thead>
    <tbody>
    <?php
    foreach($posts as $p) { ?>
        <tr>
            <td><?php echo $p['idpost']; ?></td>
            <td><?php echo $p['title']; ?></td>
            <td><?php echo model::factory('user')->get_username_by_id($p['author']); ?></td>
            <td><a href=":::url:/admin/post/edit/<?php echo $p['idpost']; ?>:::">Ändra</a> <a href="/admin/post/delete/<?php echo $p['idpost']; ?>">Radera</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>