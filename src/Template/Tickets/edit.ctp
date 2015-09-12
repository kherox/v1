<h1 class="page-title">
    Tickets - Édition du ticket
</h1>
<div class="container">
    <div class="posts">
        <div class="post">
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
                </div>

                <div class="grid-1">
                </div>
                <div class="grid-11">
                    <input type="checkbox"> Recevoir une copie de votre contenu sur votre boîte mail.
                </div>
            </div>
            <?= $this->Form->button(__('Édité'), ['class' => 'btn btn-success sendButton right']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
