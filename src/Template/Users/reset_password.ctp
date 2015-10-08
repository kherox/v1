<div class="container">
    <?= $this->Form->create($user) ?>
            <div class="grid-6">
                <?= $this->Form->input(
                    'password',
                    [
                        'label' => false,
                        'class' => 'form',
                        'placeholder' => __("Password"),
                        'required' => 'required',
                        'value' => '',
                        'error' => false
                    ]
                ) ?>
            </div>
            <div class="grid-6">
                <?= $this->Form->input(
                    'password_confirm',
                    [
                        'type' => 'password',
                        'label' => false,
                        'class' => 'form',
                        'placeholder' => __("Password (Confirmation)"),
                        'required' => 'required',
                        'value' => '',
                        'error' => false
                    ]
                ) ?>
            </div>
            <?= $this->Form->button(__('Envoyer'), ['class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end(); ?>
</div>
