<div class="ui grid">
    <div class="row">
        <div class="column">
            <div class="ui huge message page grid center aligned">
                <h1 class="ui huge header">Ticki</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, laborum magnam minima nostrum possimus quaerat quasi sunt suscipit temporibus ullam. Eos, unde!</p>

                <?= $this->Html->link(__('Tout les tickets'), [
                    'controller' => 'Tickets',
                    'action' => 'index'
                ], ['class' => 'ui green button']);
                ?>
            </div>
        </div>
    </div>
</div>

<div class="ui divider"></div>

<!-- dernier tickets -->

<!-- réalisateur -->
