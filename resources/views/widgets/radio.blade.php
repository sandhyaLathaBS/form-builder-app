<div class="form-group">
    <label for="<?= str_replace(' ', '', strtolower(@$details['Qtn_details']->label)) ?>">
        <?= @$details['Qtn_details']->label ?>
    </label>
    <?php
    if ($details['choice'] == 1) {
        $i = 1;
        if (!empty($details['Qtn_details']->formQuestion_options)) {
            foreach ($details['Qtn_details']->formQuestion_options as $option) {
    ?>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="radio<?= $i ?>" name="optradio"
            value="<?= $option['option'] ?>">
        <?= $option['option'] ?>
        <label class="form-check-label" for="radio<?= $i ?>"></label>
    </div>
    <?php
                $i++;
            }
        }
    }
    ?>
</div>