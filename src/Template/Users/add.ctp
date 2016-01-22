<h1 class="page-title">
    Espace Membre - S'inscrire
</h1>
<div class="container">
    <?= $this->Form->create($user) ?>

        <?= $this->Form->input('username', ['class' => 'form']); ?>

        <?= $this->Form->input('mail', ['class' => 'form']); ?>

        <?= $this->Form->input('website', ['class' => 'form']); ?>

        <?= $this->Form->input('password', ['class' => 'form']); ?>

        <?php if($this->config('Site.debug') == true): ?>
            <?= $this->Recaptcha->display() ?>
            <div class="g-recaptcha" data-sitekey="6LdEgg4TAAAAAJ6Mdo3X49Bp9QT6dO4aYTmN3XVS"></div>
        <?php endif; ?>
    <br>

    <?= $this->Form->button(__('Ajouté'), ['class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end() ?>
</div>
