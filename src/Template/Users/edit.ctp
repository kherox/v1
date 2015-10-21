<h1 class="page-title">
    Espace Membre
</h1>

<div class="container">
    <?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>
    <div class="grid-6">
        <h1 class="page-title">
            Éditer mon compte
        </h1>

        <div class="grid-12">
            <?= $this->Form->input('username', ['class' => 'form']); ?>
            <?= $this->Form->input('password', ['class' => 'form', 'style' => "margin-bottom: 10px"]); ?>
        </div>

        <div class="grid-12">
            <?= $this->Form->input('website', ['class' => 'form']); ?>
            <?= $this->Form->input('mail', ['class' => 'form']); ?>
        </div>
    </div>

    <div class="grid-6">
        <h1 class="page-title">
            Préférence Site web
        </h1>

        <span>Fond de OranTicket</span>
        <?= $this->Form->input('background_body', ['type' => 'color', 'class' => 'form', 'label' => false]); ?>

        <span>Fond du menu</span>
        <?= $this->Form->input('background_menu', ['type' => 'color', 'class' => 'form', 'label' => false]); ?>
    </div>
    
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end() ?>
</div>
