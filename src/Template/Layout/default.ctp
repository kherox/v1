<?= $this->element('layouts/header'); ?>
        <div id="page-wrapper">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
<?= $this->element('layouts/footer'); ?>
