<h1 class="page-title">
    Tickets - Création du ticket
</h1>
<div class="container">
    <?= $this->Form->create($ticket) ?>
        <div class="container">
            <div class="grid-1">
                <h2>Sujet</h2>
            </div>
            <div class="grid-11">
                <?= $this->Form->input('subjects', ['class' => 'form', 'label' => false]); ?>
            </div>

            <div class="grid-1">
                <h2>Contenu</h2>
            </div>
            <div class="grid-11">
                <?= $this->Form->input('content', ['class' => 'form', 'id' => 'emoji', 'label' => false]); ?>
                <?= $this->Recaptcha->display() ?>
                <div class="g-recaptcha" data-sitekey="6LdEgg4TAAAAAJ6Mdo3X49Bp9QT6dO4aYTmN3XVS"></div>
            </div>

            <div class="grid-1">
                <h2>Privé?</h2>
            </div>
            <div class="grid-11">
                <?= $this->Form->input('public', ['label' => false, 'options' => ['0' => 'Non', '1' => 'Oui'], 'class' => 'form'])?>
            </div>

            <div class="grid-1"></div>
            <div class="grid-11">
                <input type="checkbox" name="mail"> Recevoir une copie de votre contenu sur votre boîte mail.
            </div>
            .
    <?= $this->Form->button(__('Ajouté'), ['class' => 'btn btn-success sendButton right']) ?>
    <?= $this->Form->end() ?>
</div>
