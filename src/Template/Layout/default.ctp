<?= $this->element('layouts/header'); ?>
    <div id="page-wrapper">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
<?= $this->element('layouts/footer'); ?>
<?= ""//$this->element('layouts/footer', [], ['cache' => ['config' => 'footer']]); ?>
