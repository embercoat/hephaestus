<form action=":::url:/admin/settings/:::" method="post">
<button type="submit">Spara</button>
<table>
<thead>
    <tr>
        <th style="width: 200px;">Inställning</th>
        <th style="width: 200px;">Värde</th>
    </tr>
</thead>
<tbody>
    <?php foreach($settings as $s) {?>
    <tr>
        <td><?php echo !empty($s['name']) ? $s['name'] : $s['key']; ?></td>
        <td><input type="text" name="<?php echo $s['key']; ?>" value="<?php echo $s['value']; ?>" /></td>
    </td>
    <?php } ?>
</tbody>
</table>
<button type="submit">Spara</button>
</form>