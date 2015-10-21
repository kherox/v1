<div class="container">
    <ul class='users'>
        <?php foreach ($users as $user): ?>
            <li class="user grid-m-12">
                <div class="avatar">
                    <div style="margin-top: 35px;" class="grid-12 grid-m-6">
                        <?php
                            $alt = 'Photo de profil à '. $user->username;

                            echo
                            $this->Html->link(
                                $this->Html->image($this->gravatar($user->mail), ['width' => '85', 'alt' => $alt]),
                                [
                                    'controller' => 'Users',
                                    'action'     => 'view',
                                    $user->id
                                ],
                                ['escape' => false]
                            );
                        ?>
                    </div>
                </div>
                
                <div class="user-stats">
                    <div class="grid-12 grid-m-6">
                        <div class="grid-12">
                            <?php
                            if($this->request->session()->read('Auth.User.username') == $user->username): ?>
                                <a style="color: #5D5D5D;" href="<?= $this->url(); ?>users/view/<?= $user->id ?>"><?= h($user->username) ?></a>
                            <?php else: ?>
                                <a href="<?= $this->url(); ?>users/view/<?= $user->id ?>"><?= h($user->username) ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
