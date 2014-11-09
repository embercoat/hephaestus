<form action=":::url:/admin/movie/<?php echo ((isset($data['movie_id'])) ? 'edit/'.$data['movie_id'] : 'new_movie'); ?>:::" method="post" enctype="multipart/form-data">
    <fieldset>
        <input type="hidden" name="movie_id" id="idpost" value="<?php echo ((isset($data['movie_id'])) ? $data['movie_id'] : 'new'); ?>" />
        <label for="title">Namn</label>
        <input type="text" name="name" id="name" value="<?php echo ((isset($data['name'])) ? $data['name'] : ''); ?>"/>
        <label for="title">År</label>
        <input type="text" name="year" id="year" value="<?php echo ((isset($data['year'])) ? $data['year'] : date('Y')); ?>"/>
        <label for="body">Beskrivning</label>
        <textarea rows="10" cols="50" id="description" name="description"><?php echo ((isset($data['description'])) ? $data['description'] : ''); ?></textarea>
        <?php
        var_dump($data);
        ?>
        <p style="float: left; clear: both;">Nuvarande Poster<br ><a href=":::file:<?php echo $data['poster']; ?>:::"><img src=":::file:<?php echo $data['poster']; ?>:::" style="height: 200px;" /></a></p>
        <label for="poster">Poster</label>
        <input type="file" name="poster" id="poster" /><button type="submit">Spara</button>
    </fieldset>
</form>
<?php

var_dump($data);