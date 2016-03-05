<?= $this->element('layouts/header'); ?>
    <div class="ui container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
<?= $this->element('layouts/footer'); ?>
