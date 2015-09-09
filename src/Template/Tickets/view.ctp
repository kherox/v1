<div class="container">
    <div class="posts">
        <div class="post">
            <div class="post-title">
                <h1><?= h($ticket->subjects) ?>
                    <?php
                    if($ticket->label == 0){ ?>
                        <?php
                        if($ticket->user_id == $this->request->session()->read('Auth.User.id') || $this->request->session()->read('Auth.User.role') == 'admin'):
                        ?>
                            <?= h($ticket->label == 0) ?
                                $this->Form->postLink(__('<i class="fa fa-star-o right star-hover"></i>'),
                                ['controller' => 'Tickets',
                                    'action' => 'label',
                                    $ticket->id
                                ],
                                [
                                    'title' => 'Rendre votre ticket résolu',
                                    'escape' => false,
                                    'confirm' => __('Êtes-vous sûr que votre ticket est résolu?')
                                ]) : '<i class="fa fa-star right"></i>'
                            ?>

                        <?php
                        endif;
                        ?>
                    <?php } ?>
                </h1>

            </div>
            <?php
            if($ticket->label == 1):
            ?>
            <div class="post-label">
                <div id="flash-message" class="flash-message flash-success">
                    <button type="button" class="close"><i class="fa fa-times"></i></button><strong>Succéss!</strong> Ce ticket est fermé, le ticket est résolu.
                </div>
            </div>
            <?php endif; ?>

            <div class="post-author">
                <?php
                    if(!empty($user->avatar)){
                        echo $this->Html->image('upload/avatars/'. $user->avatar, ['width' => '65']);

                    }else{
                        echo $this->Html->image('upload/avatars/avatar_default.png',['width' => '65']);
                    }
                ?>
                <span>
                <?php
                    foreach($users as $user){
                        if($ticket->user_id == $user->id){
                            echo $user->username;
                        }
                    }
                ?>
                </span>
            </div>

            <div class="post-content">
                <p><?= nl2br(h($ticket->content)); ?></p>
                <?php
                if($ticket->user_id == $this->request->session()->read('Auth.User.id') || $this->request->session()->read('Auth.User.role') == 'admin'):
                ?>
                <div class="right">
                    <?= $this->Html->link(__('Éditer'), ['controller' => 'Tickets', 'action' => 'edit', $ticket->id], ['class' => 'btn btn-warning']) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Tickets', 'action' => 'delete', $ticket->id], ['class' => 'btn btn-danger', 'confirm' => __('Voulez vous vraiment supprimer ce ticket? '. "\n" . $ticket->subjects)]) ?>
                </div>
                <?php endif; ?>
            </div>


            <div class="post-comments">
                <div class="post-list">
                    <?php
                    foreach ($ticket->comments as $comment): ?>
                        <div class="container">
                            <div class="grid-1">
                                <?php
                                if(!empty($users->avatar)){
                                    echo $this->Html->image('upload/avatars/'. $ticket->user->avatar, ['class' => 'media-object', 'width' => '64']);

                                }else{
                                    echo $this->Html->image('upload/avatars/avatar_default.png', ['width' => '64']);
                                } ?>
                            </div>
                            <div class="grid-11">
                                <h4 class="media-heading"><?= $ticket->user->username; ?>
                                     | <small> 22/08/2015 22:13:54</small>
                                </h4>
                                <?= $comment['content']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>



                <?php
                if(!empty($this->request->session()->read('Auth.User'))){ ?>

                    <?= $this->Form->create('Comments') ?>
                        <div class="form-group" style="margin-top: 30px;">
                            <?php echo $this->Form->input('user_id', ['type' => 'hidden']); ?>
                            <?php
                                echo $this->Form->input('content', ['type' => 'textarea', 'id' => 'trumbowyg', 'label' => false]);
                            ?>
                        </div>
                    <?= $this->Form->button(__('Ajouter le commentaire'), ['class' => 'btn btn-success right', 'style' => 'margin-right: 25px;']) ?>
                    <?= $this->Form->end(); ?>

                <?php
                }else{
                ?>
                    <div class="post-label">
                        <div id="flash-message" class="flash-message flash-info">
                            <button type="button" class="close"><i class="fa fa-times"></i></button><strong>Attention!</strong> Vous devez être connecté pour envoyer un commentaire.
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
