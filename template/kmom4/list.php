<div id="form">
    <form action=":::url:/kmom4/:::" method="get">
        <label for="title">Titel</label>
        <input type="text" name="title" id="title" value="<?php echo ((isset($_GET['title'])) ? $_GET['title'] : ''); ?>"/>
        <label for="year_min">Lägsta år</label>
        <input type="text" name="year_min" id="year_min" value="<?php echo ((isset($_GET['year_min'])) ? $_GET['year_min'] : ''); ?>" />
        <label for="year_max">Högsta År</label>
        <input type="text" name="year_max" id="year_max" value="<?php echo ((isset($_GET['year_max'])) ? $_GET['year_max'] : ''); ?>" />
        <button type="submit">Sök</button>
    </form>
</div>
<div id="list">
    <table>
        <thead>
            <tr>
                <th>Poster</th>
                <th>Titel</th>
                <th>Årtal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($movies as $m){ ?>
            
            <tr>
                <td><a href=":::file:<?php echo $m['poster']; ?>:::"><img src=":::file:<?php echo $m['poster']; ?>:::" style="width: 150px" /></a></td>
                <td><?php echo $m['name']; ?></td>
                <td><?php echo $m['year']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>