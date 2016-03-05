<div class="ui menu">
    <div class="ui container">
        <a class="item header" style="padding: 0px 36px;font-size: 18px;" href="<?= $this->Url->build('/', true); ?>">Ticki</a >
        <a class="item" href="<?= $this->Url->build('/', true); ?>tickets/">Tickets</a>

        <div class="right menu">
            <?php if(empty($this->request->session()->read('Auth.User'))): ?>
                <div class="item">
                    <a href="<?= $this->Url->build('/', true); ?>connexion" class="ui primary button">Connexion</a>
                </div>
            <?php else: ?>
                <div class="item">
                    <a href="<?= $this->Url->build('/', true); ?>tickets/add" class="ui primary button">Ajouter un ticket</a>
                </div>

                <div class="ui inline dropdown item">
                    <div class="text">
                        <img class="ui avatar image" src="http://i.skyrock.net/7537/80537537/pics/3068945789_1_3_B1ZByw9w.jpg">
                        <?= $this->request->session()->read('Auth.User.username'); ?>
                    </div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <?php $profile_id = $this->request->session()->read('Auth.User.id'); ?>
                        <a class="item" href="<?= $this->Url->build('/', true); ?>users/profile/<?= $profile_id; ?>">Mon compte</a>
                        <a class="item" href="<?= $this->Url->build('/', true); ?>Tickets/me">Mes tickets</a>
                        <a class="item" href="<?= $this->Url->build('/', true); ?>deconnexion">Déconnexion</a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>