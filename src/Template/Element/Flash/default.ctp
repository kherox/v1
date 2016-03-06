<?php
$class = '';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>

<div class="ui message <?=trim($class)?>">
    <p><?= h($message) ?></p>
</div>