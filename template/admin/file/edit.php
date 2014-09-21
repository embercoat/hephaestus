<form action="/admin/file/new_file" method="post" enctype="multipart/form-data">
    <fieldset>
        <input type="hidden" name="idpost" id="idpost" value="new" />
        <label for="title">Titel</label>
        <input type="text" name="title" id="title" />
        <label for="file">Fil</label>
        <input type="file" name="file" id="file" />
        <button type="submit">Spara</button>
    </fieldset>
</form>
<?php echo ((isset($data['idfile'])) ? '<p>Kod för att länka hit: [[[file:'.$data['idfile'].']]]</p>' : ''); ?>
