<div class="post-comments">
    <div class="post-list">
        <?php
        foreach ($ticket->comments as $comment): ?>
            <div class="container" id="comments">
                <div class="grid-1">
                    <?php
                    foreach($users as $user){
                        if($comment->user_id == $user->id){
                            echo
                            $this->Html->link(
                                $this->Html->image(
                                    $this->gravatar($user->mail),
                                    ['width' => '55']
                                ),
                                [
                                    'controller' => 'Users',
                                    'action'     => 'view',
                                    $user->id
                                ],
                                ['escape' => false]
                            );
                        }
                    }
                    ?>
                </div>
                <div class="grid-11">
                    <h4 class="media-heading">
                        <?php
                        foreach($users as $user){
                            if($comment->user_id == $user->id){
                                echo $user->username;
                            }
                        }
                        ?>
                        |
                        <small>
                            <?=h($comment->modified->format('d/m/Y G:i:s')) ?>
                        </small>

                        <small style="display: inline-block">
                            <?php
                            if($comment->user_id == $this->request->session()->read('Auth.User.id') ||
                                $this->request->session()->read('Auth.User.role') == 'admin'):

                                    echo $this->Html->link(__('Éditer'), [
                                        'controller' => 'Tickets',
                                        'action' => 'editComment',
                                        $comment->id
                                    ], ['class' => 'btn-small btn-warning']);

                                    echo $this->Form->postLink(__('Supprimer'), [
                                        'controller' => 'Tickets',
                                        'action' => 'deleteComment',
                                        $comment->id
                                    ],
                                    [
                                        'class' => 'btn-small btn-danger',
                                        'confirm' => __('Voulez vous vraiment supprimer ce commentaire?')
                                    ])
                                ?>
                            <?php endif; ?>
                        </small>
                    </h4>

                    <p><?= $client->toImage($Parsedown->text(nl2br($comment['content']))); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    if(!empty($this->request->session()->read('Auth.User'))){ ?>
        <!-- SI JE SUIS CONNECTE -->
        <?= $this->Form->create('Comments') ?>
            <div class="form-group" style="margin-top: 30px;">
                <?php
                    echo $this->Form->input('user_id', ['type' => 'hidden']);
                    echo $this->Form->input('content',
                    [
                        'id'         => 'markdown-editor',
                        'class'      => 'markdown-editor form emoji',
                        'spellcheck' => 'false',
                        'label'      => false,
                        'rows'       => '6',
                        'placeholder'=> 'Votre message...'
                    ]
                ); ?>
            </div>
            <?= $this->Form->button(__('Ajouter le commentaire'), ['class' => 'btn btn-success sendButton', 'id' => 'sendButton', 'onClick' => 'post_comment()']) ?>
        <?= $this->Form->end(); ?>

    <?php }else{ ?>
        <!-- SI JE NE SUIS PAS CONNECTE -->
        <div class="post-label">
            <div id="flash-message" class="flash-message flash-error">
                <button type="button" class="close"><i class="fa fa-times"></i></button>
                <strong>Attention!</strong> Vous devez être connecté pour envoyer un commentaire.

                <?= $this->Html->link(
                    __('Se connecter'),[
                        'controller' => 'Users',
                        'action' => 'login'
                    ], ['style' => 'color: #fff; font-weight: 800'])
                ?>
            </div>
        </div>

    <?php } ?>
</div>
