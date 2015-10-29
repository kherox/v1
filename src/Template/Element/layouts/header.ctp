<!DOCTYPE html>
<html ng-app>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= \Cake\Core\Configure::read('Site.name') ?> // <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'https://highlightjs.org/static/styles/monokai_sublime.css',
        //'https://highlightjs.org/static/styles/color-brewer.css',
        'src.min.css',
        'style.css'
    ]); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body style="background:<?= h($this->request->session()->read('SiteWeb.background_body')) ?>!important">
    <?= $this->element('layouts/menu'); ?>
    <?= ""// $this->element('layouts/menu', [], ['cache' => ['config' => 'menu']]); ?>
    <?= $this->element('layouts/sidebar'); ?>

    <?= ""//$this->element('layouts/sidebar', [], ['cache' => ['config' => 'sidebar']]); ?>
