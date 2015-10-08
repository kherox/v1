<div class="sidebar" id="sidebar">
    <a id="sidebar--trigger" class="sidebar-trigger">
        <i class="fa fa-close sidebar-close" id="sidebar-close"></i>
    </a>
    <div class="sidebar-avatar">
        <?=
                $this->Html->image($this->gravatar(
                    $this->request->session()->read('Auth.User.mail')
                ));
        ?>
        <p class="sidebar-name">
            <?=
            $this->request->session()->read('Auth.User.username')
            ?>
        </p>
    </div>
    <div class="sidebar-menu">
        <?php $profile_id = $this->request->session()->read('Auth.User.id'); ?>
            <a href="<?= $this->url(); ?>users/login">
                <i class="fa fa-user"></i>
                Se connecter
            </a>
            <a href="<?= $this->url(); ?>users/profile/<?= $profile_id; ?>">
                <i class="fa fa-user"></i>
                Mon compte
            </a>
        <a href="<?= $this->url(); ?>Tickets/">
            <i class="fa fa-ticket"></i>
            Mes tickets
        </a>
    </div>

    <div class="sidebar-footer sidebar-footer-animation">

        <div class="grid-6 a-deco">
            <i class="fa fa-power-off"></i>

            <a href="<?= $this->url(); ?>logout" class="a-deco">
                Déconnexion
            </a>
        </div>
        <div class="grid-6 a-admin">
            <i class="fa fa-cog"></i>

            <a href="<?= $this->url(); ?>admin/" class="a-plus">
                Admin
            </a>
        </div>

    </div>
</div>