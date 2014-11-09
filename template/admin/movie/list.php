<table>
    <thead>
        <tr>
            <th style="width:50px;">ID</th>
            <th style="width:200px;">Poster</th>
            <th style="width:200px;">Namn</th>
            <th style="width:200px;">År</th>
            <th style="width:200px;">Utdrag</th>
    </thead>
    <tbody>
    <?php
    foreach($movies as $movie) { ?>
        <tr>
            <td><?php echo $movie['movie_id']; ?></td>
            <td><a href=":::file:<?php echo $movie['poster']; ?>:::"><img src=":::file:<?php echo $movie['poster']; ?>:::" style="width: 150px;" /></a></td>
            <td><?php echo $movie['name']; ?></td>
            <td><?php echo $movie['year']; ?></td>
            <td><?php echo substr($movie['description'], 0, 200); ?></td>
            <td><a href=":::url:/admin/movie/edit/<?php echo $movie['movie_id']; ?>:::">Ändra</a> <a href=":::url:/admin/movie/delete/<?php echo $movie['movie_id']; ?>:::">Radera</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>