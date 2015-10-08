<h1 class="page-title">
    Tout les tickets
</h1>
<div class="container">
<?php
foreach ($tickets as $ticket): ?>
    <ul class="tickets">
        <li class="ticket">
            <div class="container">
                <div class="ticket-title grid-9 grid-m-7">
                    <?=
                        $this->Html->link(
                            $ticket->subjects,
                            ['action' => 'view', $ticket->id]
                        );
                    ?>

                    <div class="ticket-title-icon">
                        <i class="fa fa-comments-o fa-2x"></i><span><?= h($ticket->comment_count) ?></span>
                        <?= h($ticket->label == '0') ? '<i class="fa fa-star-o fa-2x"></i>' : '<i class="fa fa-star fa-2x"></i>' ?>
                    </div>
                </div>
                <div class="ticket-info grid-3 grid-m-5">
                    <div class="author right">
                        <?php
                        foreach($users as $user){
                            if($ticket->user_id == $user->id){
                                echo
                                $this->Html->link(
                                    $this->Html->image($this->gravatar($user->mail), ['width' => '65']),
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
                        <span class="name">
                            <?php
                                foreach($users as $user){
                                    if($ticket->user_id == $user->id){
                                        echo $user->username;
                                    }
                                }
                            ?>
                        </span>
                        <span class="date"><?= h($ticket->created->format('d/m/Y G:i:s')) ?></span>
                    </div>
                </div>
            </div>
        </li>
    </ul>
<?php endforeach; ?>
<?= $this->element('paginate', [], ['cache' => ['config' => 'paginate']]); ?>
</div>
