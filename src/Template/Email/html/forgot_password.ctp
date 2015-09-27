<h2>Hey, <?= h($name) ?></h2>
<p>
    <?=
        $this->Html->link(
            __d('mail', 'here'),
            [
                'id' => $userID,
                'code' => $code,
                '_full' => true
            ],
            [
                'style' => 'color:#1ABC9C;text-decoration:none;'
            ]
        )
    ?>
</p>
