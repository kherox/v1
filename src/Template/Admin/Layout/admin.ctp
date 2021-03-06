<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard - Ticki</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?= $this->Html->css([
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'admin/bootstrap.css',
        'admin/adminLTE.css',
        'admin/skin.css'
    ]); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
            <span class="logo-lg">Ticki</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Déconnexion -->
                    <li>
                        <a href="<?= $this->Url->build('/', true); ?>Users/logout">
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <!-- Site web -->
                    <li>
                        <a target="_blank" href="<?= $this->Url->build('/', true); ?>">
                            <i class="fa fa-link"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?= $this->request->session()->read('Auth.User.username') ?></p>

                    <a href="#">
                        <i class="fa fa-circle text-success">
                        </i>
                        Connecté
                    </a>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li class="header">Menu</li>

                <li class="treeview">
                    <a href="<?= $this->Url->build('/', true); ?>admin/Tickets">
                        <i class="fa fa-ticket"></i>
                        <span>Tickets</span>

                    </a>
                </li>

                <li class="treeview">
                    <a href="<?= $this->Url->build('/', true); ?>admin/Users">
                        <i class="fa fa-user"></i>
                        <span>Utilisateurs</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <div class="row content">
            <div class="col-xs-12">
                <div class="box">
                    <?= $this->fetch('content'); ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2015 - par <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong>
    </footer>
</div>

<?=
$this->Html->script([
    'src/jquery.js',
    'admin/adminLTE.js',
    'admin/dashboard.js',
    'admin/bootstrap.js'
]); ?>

</body>
</html>
