<div class="ui comments">
    <h2>Commentaires</h2>
    <?php foreach ($ticket->comments as $comment): ?>
    <div class="comment">
        <a class="avatar">
            <?php
            foreach($users as $user){
                if($comment->user_id == $user->id){
                    echo
                        $this->Html->image(
                            $this->gravatar($user->mail),
                            ['width' => '55']
                        );
                }
            }
            ?>
        </a>

        <div class="content">
            <a class="author">
                <?php
                foreach($users as $user){
                    if($comment->user_id == $user->id){
                        echo $user->username;
                    }
                }
                ?>
            </a>
            <div class="metadata">
                <div class="date"><?=h($comment->modified->format('d/m/Y G:i:s')) ?></div>
            </div>
            <div class="text">
                <p><?= $client->toImage($Parsedown->text(nl2br($comment['content']))); ?></p>
            </div>

            <div class="actions">
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
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

    <?php
    if(!empty($this->request->session()->read('Auth.User'))){ ?>
        <!-- SI JE SUIS CONNECTE -->
        <?= $this->Form->create('Comments') ?>
            <div class="ui reply form">
                <?php
                    echo $this->Form->input('user_id', ['type' => 'hidden']);
                    echo $this->Form->input('content',
                    [
                        'id'         => 'markdown-editor',
                        'class'      => 'markdown-editor form emoji',
                        'spellcheck' => 'false',
                        'label'      => false,
                        'rows'       => '6',
                        'placeholder'=> 'Votre message...',
                        'style' => 'margin-bottom: 5px;width: 58%;display: block;'
                    ]
                ); ?>
            </div>
            <?= $this->Form->button(__('Ajouter le commentaire'), [
                'class' => 'ui primary submit button',
                'id' => 'sendButton',
                'onClick' => 'post_comment()'
            ]) ?>
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
