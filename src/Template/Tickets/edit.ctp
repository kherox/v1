<style type="text/css">
    .column {
        max-width: 450px;
    }
</style>

<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2>Ajout d'un ticket</h2>
        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create($ticket) ?>
        <div class="ui large form">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left input">
                        <?= $this->Form->input(
                            'subjects', [
                            'templates' => [
                                'inputContainer' => '{{content}}'
                            ],
                            'label' => false,
                            'placeholder' => 'Votre sujet'
                        ]); ?>
                    </div>
                </div>

                <div class="field">
                    <div class="ui left input">

                        <?= $this->Form->input(
                            'content', [
                            'templates' => [
                                'inputContainer' => '{{content}}'
                            ],
                            'placeholder' => 'Votre contenu',
                            'spellcheck' => 'false',
                            'label'      => false,
                            'rows'       => '10'
                        ]); ?>
                    </div>
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <?= $this->Form->input('public', ['label' => false, 'options' => ['0' => 'Non', '1' => 'Oui'], 'class' => 'form'])?>
                    </div>

                </div>

                <?= $this->Form->button(__("Modifier le ticket"), ['class' => 'ui fluid large teal submit button']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
