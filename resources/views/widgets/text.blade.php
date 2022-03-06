<div class="form-group">
    <label for="<?= str_replace(' ', '', strtolower(@$details['Qtn_details']->label)) ?>">
        <?= @$details['Qtn_details']->label ?>
    </label>
    <input name="text[]" <?php if (@$details['Qtn_details']->required == 1) echo "required"; ?> type="text"
        class="form-control" id="<?= str_replace(' ', '', strtolower(@$details['Qtn_details']->label)) ?>">
</div>