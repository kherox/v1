<div class="ui grid">
    <div class="four column row">
        <div class="left floated column">
            <h2>Tickets</h2>
        </div>
        <div class="right floated column">
            <?=
            $this->Html->link(
                "Ajouter un ticket",
                ['controller' => 'Tickets', 'action' => 'add'],
                ['class' => 'ui button green right floated']
            );
            ?>
        </div>
    </div>
</div>

<div class="ui four cards">
    <?php foreach ($tickets as $ticket): ?>
        <div class="ui card grid-m-6">
            <div class="content">
                <?= h($ticket->label == '0') ? '<i style="color: #ffb70a!important;" class="right floated empty star icon"></i>' : '<i style="color: #ffb70a!important;" class="right floated star icon"></i>' ?>
                <?php
                if(!$ticket->public == 0){
                    echo'<i class="right floated lock icon"></i>';
                }
                ?>

                <div class="header">
                    <?= $ticket->subjects ?>
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
    <?= $this->element('paginate', [], ['cache' => ['config' => 'paginate']]); ?>
 </div>

