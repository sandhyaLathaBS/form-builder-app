<div class="form-group">
    <label for="<?= str_replace(' ', '', strtolower(@$details['Qtn_details']->label)) ?>">
        <?= @$details['Qtn_details']->label ?>
    </label>
    <input <?php if (@$details['Qtn_details']->required == 1) echo "required"; ?> class="form-control" type="tel"
        id="<?= str_replace(' ', '', strtolower(@$details['Qtn_details']->label)) ?>" name="tel[]">
</div>