<style type="text/css">
    .column {
        max-width: 450px;
    }
</style>

<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2>inscription</h2>
        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create($user) ?>
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
                        <i class="at icon"></i>
                        <?= $this->Form->input(
                            'mail', [
                            'templates' => [
                                'inputContainer' => '{{content}}'
                            ],
                            'label' => false,
                            'placeholder' => 'Votre e-mail'
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
                <?= $this->Form->button(__("S'inscrire"), ['class' => 'ui fluid large teal submit button']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>

        <div class="ui message" style="margin-bottom: 30px">
            Vous êtes déjà inscrit? <?= $this->Html->link("Se connecter", ['controller' => 'Users','action' => 'login'], []);?>
        </div>
    </div>
</div>




