<form action="/admin/post/<?php echo ((isset($data['idpost'])) ? 'edit/'.$data['idpost'] : 'new_post'); ?>" method="post">
    <fieldset>
        <input type="hidden" name="idpost" id="idpost" value="<?php echo ((isset($data['idpost'])) ? $data['idpost'] : 'new'); ?>" />
        <label for="title">Titel</label>
        <input type="text" name="title" id="title" <?php echo ((isset($data['title'])) ? 'value="'.$data['title'].'"' : ''); ?>/>
        <label for="body">Text</label>
        <textarea rows="10" cols="50" id="body" name="body"><?php echo ((isset($data['content'])) ? $data['content'] : ''); ?></textarea>
        <button type="submit">Spara</button>
    </fieldset>
</form>
<?php echo ((isset($data['idpost'])) ? '<p>Kod för att länka hit: [[[post:'.$data['idpost'].']]]</p>' : ''); ?>
