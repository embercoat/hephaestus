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
    foreach($files as $f) { ?>
        <tr>
            <td><?php echo $f['idfile']; ?></td>
            <td><?php echo $f['name']; ?></td>
            <td><?php echo model::factory('user')->get_username_by_id($f['author']); ?></td>
            <td><a href=":::url:/admin/file/delete/<?php echo $f['idfile']; ?>:::">Radera</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>