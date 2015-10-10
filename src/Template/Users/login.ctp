<div class="container" style="margin-top: 30px;">
        <div class="login">
            <?= $this->Flash->render('auth') ?>

            <?= $this->Form->create() ?>
                <div class="center">
                    <i class="fa fa-user fa-5x"></i>
                </div>

                <div class="grid-6">
                    <?= $this->Form->input('username', ['class' => 'form', 'placeholder' => 'Votre prénom']); ?>
                </div>
                <div class="grid-6">
                    <?= $this->Form->input('password', ['class' => 'form', 'placeholder' => 'Votre mot de passe']); ?>
                </div>

                <div class="grid-12 center">
                    <?= $this->Form->button(__('Se connecter'), ['class' => 'btn btn-success right']) ?>
                    <?= $this->Html->link('Mot de passe oublié', ['controller' => 'Users','action' => 'forgot_password'], ['class' => 'right btn btn-danger']);?>
                    <?= $this->Html->link("S'inscrire", ['controller' => 'Users','action' => 'add'], ['class' => 'right btn btn-info']);?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
