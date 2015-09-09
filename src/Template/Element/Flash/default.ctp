<?php
$class = '';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div id="flash-message" class="flash-message flash flash-<?=trim($class)?> fadeInDown animated">
  <button type="button" class="close"><i class="fa fa-times"></i></button><strong><?= h($class) ?></strong> <?= h($message) ?>
</div>
