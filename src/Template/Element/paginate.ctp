<!--
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
-->
<div class="pagination-container">
    <ul class="pagination">
        <?php if ($this->Paginator->hasPrev()): ?>
        <?= $this->Paginator->prev('«'); ?>
        <?php endif; ?>
        <?= $this->Paginator->numbers(['modulus' => 5]); ?>
        <?php if ($this->Paginator->hasNext()): ?>
        <?= $this->Paginator->next('»'); ?>
        <?php endif; ?>
    </ul>
</div>