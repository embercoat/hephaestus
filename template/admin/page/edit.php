<form action=":::url:/admin/page/<?php echo ((isset($data['idpage'])) ? 'edit/'.$data['idpage'] : 'new_page'); ?>:::" method="post">
    <fieldset>
        <input type="hidden" name="idpage" id="idpage" value="<?php echo ((isset($data['idpage'])) ? $data['idpage'] : 'new'); ?>" />
        <label for="title">Titel</label>
        <input type="text" name="title" id="title" <?php echo ((isset($data['title'])) ? 'value="'.$data['title'].'"' : ''); ?>/>
        <label for="show_in_menu">Visa i meny?</label>
        <input type="checkbox" name="show_in_menu" id="show_in_menu" <?php echo ((isset($data['show_in_menu']) && $data['show_in_menu'] == 1) ? 'checked="checked"' : ''); ?> value="1" />
        <label for="body">Text</label>
        <textarea rows="10" cols="50" id="body" name="body"><?php echo ((isset($data['content'])) ? $data['content'] : ''); ?></textarea>
        <button type="submit" id="save">Spara</button>
    </fieldset>
</form>
<?php echo ((isset($data['idpage'])) ? '<p>Kod för att länka hit: [[[page:'.$data['idpage'].']]]</p>' : ''); ?>
<script type="text/javascript">
    shortcut.add("Ctrl+S", function(){
        $('#save').click();
    });
</script>