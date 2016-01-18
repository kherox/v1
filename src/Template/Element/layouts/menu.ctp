<header>
        <div class="menu" style="background:<?= $this->request->session()->read('SiteWeb.background_menu') ?>!important">
            <div class="container">
                <div class="logo grid-2 grid-m-6">
                    <a href="<?= $this->Url->build('/', true); ?>">
                        <?= $this->Html->image('logo.png', ['width' => '190', 'alt' => 'Logo OranTicket']); ?>
                    </a>
                </div>

                <div class="nav-center grid-10 grid-m-6">
                    <div class="right">
                        <nav>
                            <ul>
                                <li>
                                    <a href="<?= $this->Url->build('/', true); ?>tickets/">
                                        <i class="fa fa-ticket"></i> Tickets
                                    </a>
                                </li>
                                <?php if(!empty($this->request->session()->read('Auth.User'))): ?>
                                    <li>
                                        <a href="<?= $this->Url->build('/', true); ?>tickets/add">
                                            <i class="fa fa-plus"></i> Ajouter un ticket
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" id="sidebar--trigger" class="sidebar-trigger">
                                            <i class="fa fa-user"></i> <?= $this->request->session()->read('Auth.User.username'); ?>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="<?= $this->Url->build('/', true); ?>Users/login">
                                            <i class="fa fa-user"></i>
                                        </a>
                                        <div class="fond" id="notifications">

                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
