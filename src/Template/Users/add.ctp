<h1 class="page-title">
    Espace Membre - S'inscrire
</h1>
<div class="container">
    <?= $this->Form->create($user) ?>
        <?php
            echo $this->Form->input('username', ['class' => 'form']);
            echo $this->Form->input('mail', ['class' => 'form']);
        ?>

        <?php
            echo $this->Form->input('website', ['class' => 'form']);
            echo $this->Form->input('password', ['class' => 'form']);

        ?>
    <br>
    <?= $this->Form->button(__('Ajouté'), ['class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end() ?>
</div>
