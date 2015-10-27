<header>
        <div class="menu" style="background:<?= $this->request->session()->read('SiteWeb.background_menu') ?>!important">
            <div class="container">
                <div class="logo grid-2 grid-m-6">
                    <a href="<?= $this->url(); ?>">
                        <?= $this->Html->image('oranticket.png', ['width' => '190']); ?>
                    </a>
                </div>

                <div class="nav-center grid-10 grid-m-6">
                    <div class="right">
                        <nav>
                            <ul>
                                <li>
                                    <a href="<?= $this->url(); ?>tickets/">
                                        <i class="fa fa-ticket"></i>
                                    </a>
                                </li>
                                <?php if(!empty($this->request->session()->read('Auth.User'))): ?>
                                    <li>
                                        <a href="<?= $this->url(); ?>tickets/add">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" id="sidebar--trigger" class="sidebar-trigger">
                                            <i class="fa fa-user"></i>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="<?= $this->url(); ?>Users/login">
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
