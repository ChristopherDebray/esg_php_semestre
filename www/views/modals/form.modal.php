<?php foreach ($errors as $error):?>
<li><?=$error ?></li>
<?php endforeach;?>

<form
    method="<?= $config["config"]["method"]??"GET";?>"
    action="<?= $config["config"]["action"]??"";?>"
    class="<?= $config["config"]["class"]??"";?>"
    id="<?= $config["config"]["id"]??"";?>"
>

    <?php foreach ($config["inputs"] as $name=>$attr):?>
        <?php if(!in_array($attr['type'], ["checkbox", "radio", "select"])): ?>
            <input
                type="<?= $attr['type']??'text';?>"
                placeholder="<?= $attr['placeholder']??'';?>"
                name="<?= $name ;?>"
                class="<?= $attr['class']??'';?>"
                id="<?= $attr['id']??'';?>"
                <?= (!empty($attr['required']))?"required='required'":"";?>
            >
        <?php else: ?>
            <?php if($attr['type'] === "radio"): ?>
                <?php foreach ($attr["options"] as $name=>$options):?>
                    <label for="<?= $options['value'] ?>"><?= $options['label']??$options['value'] ?></label>
                    <input
                        type="<?= $attr['type'];?>"
                        name="<?= $attr['group'] ;?>"
                        class="<?= $options['class']??'';?>"
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
                        class="<?= $options['class']??'';?>"
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

    <input type="submit" name="submit" value="<?= $config["config"]["submit"]??"Confirmer";?>">
    <input type="reset" value="<?= $config["config"]["cancel"]??"Annuler";?>">
</form>