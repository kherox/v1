<!DOCTYPE html>
<html ng-app>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= \Cake\Core\Configure::read('Site.name') ?> // <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
    'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
    '//cdn.jsdelivr.net/emojione/1.5.0/assets/css/emojione.min.css',
    'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js',
    'style.css',
    'http://fonts.googleapis.com/css?family=Lato:400,300,700,900',
    ]); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

<?= $this->element('layouts/menu'); ?>