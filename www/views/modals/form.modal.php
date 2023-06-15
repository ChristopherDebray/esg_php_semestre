<script src="../vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script defer>
    <?php foreach ($config["inputs"] as $name=>$attr):?>
        <?php if($attr['type'] === 'wysiwyg'): ?>
        tinymce.init({
            selector: '#<?= $attr['id'] ?>',
            plugins: 'typography advlist autolink lists link image charmap print preview anchor image media',
            toolbar: 'undo redo spellcheckdialog  | blocks fontfamily fontsizeinput | bold italic underline forecolor backcolor | link image media | align lineheight checklist bullist numlist | indent outdent | removeformat typography',
            // language: 'fr_FR',
        });
        <?php endif; ?>
    <?php endforeach; ?>
</script>
<section class="container">
    <?php if($errors): ?>
        <ul>
            <?php foreach ($errors as $error):?>
            <li class="text--danger"><?=$error ?></li>
            <?php endforeach;?>
        </ul>
    <?php endif; ?>

    <form
        method="<?= $config["config"]["method"]??"GET";?>"
        action="<?= $config["config"]["action"]??"";?>"
        class="<?= $config["config"]["class"]??"";?>"
        id="<?= $config["config"]["id"]??"";?>"
    >
        <div class="form-group">
        <?php foreach ($config["inputs"] as $name=>$attr):?>
            <?php if(!in_array($attr['type'], ["checkbox", "radio", "select"])): ?>
                <?php if($attr['type'] !== "wysiwyg"): ?>
                    <input
                        type="<?= $attr['type']??'text';?>"
                        placeholder="<?= $attr['placeholder']??'';?>"
                        name="<?= $name ;?>"
                        class="<?= $attr['class']??'form-control';?>"
                        id="<?= $attr['id']??'';?>"
                        <?= (!empty($attr['required']))?"required='required'":"";?>
                    >
                <?php else: ?>
                    <textarea id="<?= $attr['id'] ?>" name="<?= $name ;?>">Hello, World!</textarea>
                <?php endif; ?>
            <?php else: ?>
                <?php if($attr['type'] === "radio"): ?>
                    <?php foreach ($attr["options"] as $name=>$options):?>
                        <label for="<?= $options['value'] ?>"><?= $options['label']??$options['value'] ?></label>
                        <input
                            type="<?= $attr['type'];?>"
                            name="<?= $attr['group'] ;?>"
                            class="<?= $options['class']??'form-control';?>"
                            id="<?= $options['id']??'';?>"
                            value="<?= $options['value'] ?>"
                        >
                    <?php endforeach;?>
                <?php endif; ?>

                <?php if($attr['type'] === "checkbox"): ?>
                    <?php foreach ($attr["options"] as $name=>$options):?>
                        <label for="<?= $options['name'] ?>"><?= $options['label']??$options['value'] ?></label>
                        <input
                            type="<?= $attr['type'];?>"
                            name="<?= $options['name'] ;?>"
                            class="<?= $options['class']??'form-control';?>"
                            id="<?= $options['id']??'';?>"
                            value="<?= $options['value'] ?>"
                        >
                    <?php endforeach;?>
                <?php endif; ?>

                <?php if($attr['type'] === "select"): ?>
                    <select name="<?= $attr['group'] ?>" id="<?= $attr['id'] ?>">
                        <option value=""></option>
                    <?php foreach ($attr["options"] as $name=>$options):?>
                        <option value="<?= $options['label'] ?>"><?= $options['value'] ?></option>
                    <?php endforeach;?>
                    </select>
                <?php endif; ?>
            <?php endif; ?>
            <br>
        <?php endforeach;?>
        </div>

        <input type="submit" name="submit" class="form-control button button--info" value="<?= $config["config"]["submit"]??"Confirmer";?>">
        <input type="reset" class="form-control button button--danger" value="<?= $config["config"]["cancel"]??"Annuler";?>">
    </form>
</section>