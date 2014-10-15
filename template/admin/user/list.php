<table>
    <thead>
        <tr>
            <th style="width:50px;">ID</th>
            <th style="width:200px;">Namn</th>
            <th style="width:200px;">Användarnamn</th>
    </thead>
    <tbody>
    <?php
    foreach($users as $row){ ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['fname'].' '.$row['lname']; ?></td>
            <td><?php echo $row['username']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>