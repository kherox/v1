<div class="ui four cards">
    <?php foreach ($tickets as $ticket): ?>
        <div class="ui card">
            <div class="content">
                <?= h($ticket->label == '0') ? '<i class="right floated empty star icon"></i>' : '<i class="right floated star icon"></i>' ?>
                <?php
                if(!$ticket->public == 0){
                    echo'<i class="right floated lock icon"></i>';
                }
                ?>

                <div class="header">
                    <?= $ticket->subjects ?>
                </div>
                <div class="description">
                    <p></p>
                </div>
            </div>
            <div class="extra content">
            <span class="left floated like" style="margin-top: 4px;">
              <i class="unhide icon"></i>
                <?=
                $this->Html->link(
                    "Voir le ticket",
                    ['action' => 'view', $ticket->id]
                );
                ?>
            </span>
            <span class="right floated star">
              <div class="right floated author">
                  <?php
                  foreach($users as $user) {
                      if ($ticket->user_id == $user->id) {
                          echo
                          $this->Html->link(
                              $this->Html->image($this->gravatar($user->mail), ['width' => '65', 'class' => 'ui avatar image']),
                              [
                                  'controller' => 'Users',
                                  'action' => 'view',
                                  $user->id
                              ],
                              ['escape' => false]
                          );

                          echo $user->username;
                      }
                  }
                  ?>
              </div>
            </span>
            </div>
        </div>
    <?php endforeach; ?>
 </div>








<?php
/**
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

                    <?php
                        if(!$ticket->public == 0){
                            echo'<span class="label label-danger">Privée</span>';
                        }
                    ?>
                    <div class="ticket-title-icon">
                        <i class="fa fa-comments-o fa-2x"></i><span><?= h($ticket->comment_count) ?></span>
                        <?= h($ticket->label == '0') ? '<i class="fa fa-star-o fa-2x"></i>' : '<i style="color: #579A4D;" class="fa fa-star fa-2x"></i>' ?>
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

                        <span class="date" >
                            <?= $this->time($ticket->created) ?>
                        </span>
                    </div>
                </div>
            </div>
        </li>
    </ul>
<?php endforeach; ?>
<?= $this->element('paginate', [], ['cache' => ['config' => 'paginate']]); ?>
</div>
 **/?>
