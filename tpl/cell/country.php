<?php
use GDO\Country\Country;
use GDO\Country\GDO_Country;

$field instanceof GDO_Country;
?>
<?php if ($country instanceof Country) : ?>
<img
 class="gdo-country"
 alt="<?= $country->displayName(); ?>"
 src="GDO/Country/img/<?= $country->getID(); ?>.png" />
<?= $country->displayName(); ?>
<?php else : ?>
<img
 class="gdo-country"
 alt="<?= t('unknown_country'); ?>"
 src="GDO/Country/img/zz.png" />
<?php if ($choice) { ?>
<?= t('unknown_country'); ?>
<?php }?>
<?php endif;?>
