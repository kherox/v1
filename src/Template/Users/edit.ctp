<h1 class="page-title">
    Espace Membre - Éditer mon compte
</h1>
<div class="container">
    <?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>
            <div class="grid-12">
                <?= $this->Form->input('username', ['class' => 'form']); ?>
                <?= $this->Form->input('password', ['class' => 'form', 'style' => "margin-bottom: 10px"]); ?>
            </div>

            <div class="grid-12">
                <?= $this->Form->input('website', ['class' => 'form']); ?>
                <?= $this->Form->input('mail', ['class' => 'form']); ?>
            </div>
    <br>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end() ?>
</div>
