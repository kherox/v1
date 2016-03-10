<h2>Utilisateurs</h2>
<div class="ui grid">
    <?php foreach ($users as $user): ?>
        <div class="two wide column">
            <div style="text-align: center">
                <div class="avatar" id="gravatar">
                    <?php
                    $alt = 'Photo de profil à '. $user->username;
                    echo $this->Html->link(
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

                <div style="text-align: center">
                    <?php if($user->role == 'admin'):?>
                        <a style="color: #DE1515;" href="<?= $this->Url->build('/', true); ?>users/view/<?= $user->id ?>">
                            <?= h($user->username) ?>
                        </a>
                    <?php elseif($this->request->session()->read('Auth.User.username') == $user->username): ?>
                        <a style="color: #5D5D5D;" href="<?= $this->Url->build('/', true); ?>users/view/<?= $user->id ?>">
                            <?= h($user->username) ?>
                        </a>
                    <?php else: ?>
                        <a href="<?= $this->Url->build('/', true); ?>users/view/<?= $user->id ?>">
                            <?= h($user->username) ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
