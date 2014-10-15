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
    foreach($pages as $p) { ?>
        <tr>
            <td><?php echo $p['idpage']; ?></td>
            <td><?php echo $p['title']; ?></td>
            <td><?php echo model::factory('user')->get_username_by_id($p['author']); ?></td>
            <td><a href=":::url:/admin/page/edit/<?php echo $p['idpage']; ?>:::">Ändra</a> <a href=":::url:/admin/page/delete/<?php echo $p['idpage']; ?>:::">Radera</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>