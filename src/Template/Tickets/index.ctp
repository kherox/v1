
<div class="container">
    <?= $this->Html->link(__('Ajouter un ticket'), [
        'controller' => 'Tickets',
        'action' => 'add'],
        ['class' => 'right btn  btn-info', 'style' => 'margin-top: 14px;margin-bottom: 10px;']) ?>

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
                        <img src="http://perlbal.hi-pi.com/blog-images/55444/gd/1225116859/presentation-de-ma-star-prefere.jpg" alt="Photo de profil Gynidark" width="120">
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
<?= $this->element('paginate'); ?>
</div>
