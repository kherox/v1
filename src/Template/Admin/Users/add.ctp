<div class="box-header">
    <h3 class="box-title">Ajouter un utilisateur</h3>
</div>

<div class="box-body table-responsive no-padding">
        <?= $this->Form->create($user) ?>
                <?= $this->Form->input('username', ['class' => 'form-control']); ?>
                <?= $this->Form->input('mail', ['class' => 'form-control']); ?>

                <?= $this->Form->input('website', ['class' => 'form-control']); ?>
                <?= $this->Form->input('password', ['class' => 'form-control']); ?>
                <br>
                <?= $this->Form->button(__('Ajouté'), ['class' => 'btn btn-success pull-right']) ?>
        <?= $this->Form->end() ?>

</div>
