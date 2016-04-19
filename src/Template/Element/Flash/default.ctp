<?php
$class = '';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>

<div class="ui <?=trim($class)?> message">
    <i class="close icon"></i>
    <p>
        <?= h($message) ?>
    </p>
</div>