<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Tickets - Création du ticket

            </h1>
        </div>
    </div>
    <?= $this->Form->create($ticket) ?>
        <div class="grid-12">
            <?= $this->Form->input('subjects', ['class' => 'form', 'required' => false]); ?>
            <?= $this->Form->input('content', ['class' => 'form', 'id' => 'emoji']); ?>
        </div>

    <br>
    <?= $this->Form->button(__('Ajouté'), ['class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end() ?>
</div>
