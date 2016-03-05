<style type="text/css">
    .column {
        max-width: 450px;
    }
</style>

<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2>Connexion</h2>
        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create() ?>
            <div class="ui large form">
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <?= $this->Form->input(
                                'username', [
                                    'templates' => [
                                        'inputContainer' => '{{content}}'
                                    ],
                                'label' => false,
                                'placeholder' => 'Votre prénom'
                            ]); ?>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <?= $this->Form->input(
                                'password', [
                                'templates' => [
                                    'inputContainer' => '{{content}}'],
                                'label' => false,
                                'class' => 'form',
                                'placeholder' => 'Votre mot de passe'
                            ]); ?>
                        </div>
                    </div>
                    <?= $this->Form->button(__('Se connecter'), ['class' => 'ui fluid large teal submit button']) ?>
                    <?= $this->Html->link('Mot de passe oublié', ['controller' => 'Users','action' => 'forgot_password'], ['class' => 'ui fluid large negative submit button', 'style' => 'margin-top: 10px']);?>
                </div>
            </div>
        <?= $this->Form->end() ?>

        <div class="ui message" style="margin-bottom: 30px">
            Vous êtes nouveau? <?= $this->Html->link("S'inscrire", ['controller' => 'Users','action' => 'add'], []);?>
        </div>
    </div>
</div>