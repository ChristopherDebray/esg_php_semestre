
<section class="container">
    <?php if($errors): ?>
        <ul>
            <?php foreach ($errors as $error):?>
            <li class="text--danger"><?=$error ?></li>
            <?php endforeach;?>
        </ul>
    <?php endif; ?>
    <div class="row">
        <div class="col-3"></div>
        <form
            method="<?= $config["config"]["method"]??"GET";?>"
            action="<?= $config["config"]["action"]??"";?>"
            class="<?= $config["config"]["class"]??"";?>"
            id="<?= $config["config"]["id"]??"";?>"
        >
            <div class="form-group">
            <h1><?= $config["config"]["title"]??'' ?></h1>
            <?php foreach ($config["inputs"] as $name=>$attr):?>
                <?php if(!in_array($attr['type'], ["checkbox", "radio", "select"])): ?>
                    <input
                        type="<?= $attr['type']??'text';?>"
                        placeholder="<?= $attr['placeholder']??'';?>"
                        name="<?= $name ;?>"
                        class="<?= $attr['class']??'form-control';?>"
                        id="<?= $attr['id']??'';?>"
                        value="<?= $attr['value']??'';?>"
                        <?= (!empty($attr['required']))?"required='required'":"";?>
                    >
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
                        <select class='form-control' name="<?= $attr['name'] ?>" id="<?= $attr['id'] ?>">
                            <option value=<?= $attr['value'] ?>><?= $attr['label'] ?></option>
                        <?php foreach ($attr["options"] as $name=>$options):?>
                            <option value="<?= $options['value'] ?>"><?= $options['label'] ?></option>
                        <?php endforeach;?>
                        </select>
                    <?php endif; ?>
                <?php endif; ?>
                <br>
            <?php endforeach;?>
            </div>
    
            <input type="submit" name="submit" class="form-control button button--info" value="<?= $config["config"]["submit"]??"Confirmer";?>">
            <a class="form-control button button--danger" href="<?= $config["config"]["redirectIfCancel"] ?>"><?= $config["config"]["cancel"]??"Annuler";?></a>
        </form>
    </div>
</section>