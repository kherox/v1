<h1 class="page-title">
    Espace Membre - S'inscrire
</h1>
<div class="container">
    <?= $this->Form->create($user) ?>
        <?= $this->Form->input(
            'email',
            [
                'label' => false,
                'class' => 'form',
                'placeholder' => __("E-mail"),
                'required' => 'required',
                'error' => false
            ]
        ) ?>
        <?= $this->Form->button(__('Ajouté'), ['class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end(); ?>
</div>

