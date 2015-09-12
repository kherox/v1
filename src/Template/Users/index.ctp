<h1 class="page-title">
    Tout les membres
</h1>

<div class="container">
    <ul class='users'>
        <?php foreach ($users as $user): ?>
            <li class="user grid-m-12">
                <div class="avatar">
                    <div class="grid-12 grid-m-6">
                        <?php
                        $alt = 'Photo de profil à'. $user->username;
                            if(!empty($user->avatar)){
                                echo $this->Html->image('upload/avatars/'. $user->avatar, ['width' => '120', 'alt' => $alt]);

                            }else{
                                echo $this->Html->image('upload/avatars/avatar_default.png', ['width' => '120', 'alt' => $alt]);
                            }
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
                        <div class="grid-4 grid-m-4">
                            <div class="user-stats-info">
                                <i class="fa fa-ticket"></i>
                                <span>2</span>
                            </div>
                        </div>
                        <div class="grid-4 grid-m-4">
                            <div class="user-stats-info">
                                <i class="fa fa-comment-o"></i>
                                <span>2</span>
                            </div>
                        </div>
                        <div class="grid-4 grid-m-4">
                            <div class="user-stats-info">
                                <i class="fa fa-commenting-o"></i>
                                <span>95</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
