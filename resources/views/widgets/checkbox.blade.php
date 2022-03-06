<div class="form-group">
    <label
        for="<?= str_replace(' ', '', strtolower(@$details['Qtn_details']->label)) ?>"><?= @$details['Qtn_details']->label ?></label>
    <?php
    if ($details['choice'] == 1) {
        $i = 1;
        if (!empty($details['Qtn_details']->formQuestion_options)) {
            foreach ($details['Qtn_details']->formQuestion_options as $option) {
    ?>
    <div class="form-check">
        <input <?php if (@$details['Qtn_details']->required == 1) echo "required"; ?> class="form-check-input"
            type="checkbox" id="check<?= $i ?>" name="option[]" value="something">
        <label class="form-check-label"><?= $option['option'] ?></label>
    </div>
    <?php
                $i++;
            }
        }
    }
    ?>
</div>