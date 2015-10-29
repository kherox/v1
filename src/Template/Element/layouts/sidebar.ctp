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
            <?= $this->request->session()->read('Auth.User.username') ?>
        </p>
    </div>
    <div class="sidebar-menu">
        <?php $profile_id = $this->request->session()->read('Auth.User.id'); ?>
        <a href="<?= $this->Url->build('/', true); ?>users/profile/<?= $profile_id; ?>">
            <i class="fa fa-user"></i>
            Mon compte
        </a>
        <a href="<?= $this->Url->build('/', true); ?>Tickets/me">
            <i class="fa fa-ticket"></i>
            Mes tickets
        </a>
    </div>

    <div class="sidebar-footer sidebar-footer-animation">
        <?php if(!empty($this->request->session()->read('Auth.User.role'))): ?>
            <div class="grid-6 ">
                <a href="<?= $this->Url->build('/', true); ?>logout" class="a">
                    <div class="a-admin">
                        <i class="fa fa-power-off"></i>
                        Déconnexion
                    </div>
                </a>
            </div>

            <div class="grid-6">
                <a href="<?= $this->Url->build('/', true); ?>admin/" class="a">
                    <div class="a-admin">
                        <i class="fa fa-cog"></i>
                        Admin
                    </div>
                </a>
            </div>
        <?php else: ?>
            <div class="grid-12">
                <a href="<?= $this->Url->build('/', true); ?>logout" class="a">
                    <div class="a-admin">
                        <i class="fa fa-power-off"></i>
                        Déconnexion
                    </div>
                </a>
            </div>
        <?php endif; ?>

    </div>
</div>
