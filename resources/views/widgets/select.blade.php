<div class="form-group">
    <label for="<?= str_replace(' ', '', strtolower(@$details['Qtn_details']->label)) ?>" class="form-label">
        <?= @$details['Qtn_details']->label ?></label>
    <select class="form-select" id="<?= str_replace(' ', '', strtolower(@$details['Qtn_details']->label)) ?>"
        name="select[]">
        <option value="">Please Choose</option>
        <?php
        if ($details['choice'] == 1) {
            $i = 1;
            if (!empty($details['Qtn_details']->formQuestion_options)) {
                foreach ($details['Qtn_details']->formQuestion_options as $option) {
        ?>
        <option value=" <?= $option['option'] ?>"> <?= $option['option'] ?></option>
        <?php
                    $i++;
                }
            }
        }
        ?>
    </select>
</div>