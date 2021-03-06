<?php
use GDO\Country\Country;
use GDO\Country\GDO_Country;
$field instanceof GDO_Country;
?>
<md-input-container class="md-block md-float md-icon-left<?= $field->classError(); ?>" flex>
  <label><?= $field->displayLabel(); ?></label>
  <md-select
   ng-controller="GDOSelectCtrl"
   ng-model="selection"
   <?php if ($field->multiple) { ?>
   multiple
   ng-init='init(<?= $field->getVar(); ?>)'
   ng-change="multiValueSelected('#gwfsel_<?= $field->name; ?>')">
   <?php } else { ?>
   ng-init="selection='<?= $field->getValue(); ?>'"
   ng-change="valueSelected('#gwfsel_<?= $field->name; ?>')">
   <?php } ?>
    <?php if ($field->emptyLabel) : ?>
      <md-option value="<?= $field->emptyValue; ?>">
        <img
         class="gdo-country"
         src="/theme/default/img/country/zz.png" />
        <?= $field->emptyLabel; ?>
      </md-option>
    <?php endif; ?>
    <?php foreach ($field->choices as $value => $country) : $country instanceof Country; ?>
      <md-option value="<?= htmlspecialchars($value); ?>">
        <?= $country->renderChoice(); ?>
      </md-option>
    <?php endforeach; ?>
  </md-select>
  <input
   class="n"
   type="hidden"
   id="gwfsel_<?= $field->name; ?>"
   value="<?= $field->getValue(); ?>"
   name="form[<?= $field->name?>]" />
  <div class="gdo-error"><?= $field->error; ?></div>
</md-input-container>
