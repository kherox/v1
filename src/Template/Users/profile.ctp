
<div class="ui grid" style="margin-top: 20px;">
    <div class="four wide column">
        <h2 class="ui header">
            <?php
          
            $this->Html->image($this->gravatar($user['mail']), ['class' => 'ui circular image', 'width' => '85', 'alt' => 'Photo de profil à '. $user['username']]);
            ?>
            <div class="content">
                <?= $user['username'] ?> <i class="france flag"></i>
                <div class="sub header"><?= $user['role']; ?></div>
            </div>
        </h2>
    </div>
    <div class="twelve wide column">
        <div class="ui relaxed grid">
            <div class="three column row">
                <div class="column center">
                    <div class="ui olive small statistic">
                        <div class="value">
                            <?= $comments_count ?>
                        </div>
                        <div class="label">
                            Commentaires
                        </div>
                    </div>
                </div>
                <div class="column center">
                    <div class="ui purple small statistic">
                        <div class="value">
                            <?= $tickets_count; ?>
                        </div>
                        <div class="label">
                            Tickets
                        </div>
                    </div>
                </div>
                <div class="column center">
                    <div class="ui teal small statistic">
                        <div class="value">
                            4
                        </div>
                        <div class="label">
                            Tickets résolus
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ui column centered grid">
    <div class="center" style="margin-top: 30px;">
        <?=
        // EDITION DU COMPTE
        $this->Html->link(__('Éditer mon compte'), [
            'controller' => 'Users',
            'action' => 'edit',
            $user['id']
        ],
            [
                'class' => 'ui button olive',
                'style' => 'margin-top: 14px;margin-bottom: 10px;'
            ]);
        ?>
        <?php
        // IF ADMIN
        if($this->request->session()->read('Auth.User.role') == 'admin'):
            ?>
            <?= $this->Html->link(__('Administration'), [
            'controller' => 'Admin',
            'action' => 'Users'],
            [
                'class' => 'ui button blue',
                'style' => 'margin-top: 14px;text-align:center;margin-bottom: 10px;'
            ]);
            ?>
        <?php endif; ?>
        <?=
        // SUPPRESSION DU COMPTE
        $this->Html->link(__('Supprimer mon compte'), [
            'controller' => 'Users',
            'action' => 'delete'
        ],
            [
                'class' => 'ui button grey',
                'style' => 'margin-top: 14px;margin-bottom: 10px;'
            ]);
        ?>
        <?=
        // DECONNEXION
        $this->Html->link(__('Déconnexion'), [
            'controller' => 'Users',
            'action' => 'logout'],
            [
                'class' => 'ui button red',
                'style' => 'margin-top: 14px;text-align:center;margin-bottom: 10px;'
            ]);
        ?>
    </div>
</div>

<div class="container">
    <h2 style="margin-top: 50px;">Mes tickets </h2>
    <table class="ui fixed single line celled table">
        <thead>
        <tr>
            <th>Sujet</th>
            <th>Statut</th>
            <th>Privé</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><a href="#"><?= $ticket->subjects ?></a></td>
                <td>
                    <?= h($ticket->label == '0') ? '<span class="label label-success">Ouvert</span>' : '<span class="label label-danger">Fermé</span>' ?>
                </td>
                <td>
                    <?= h($ticket->public == '0') ? '<span class="label label-success"><i class="unlock alternate icon"></i> Non</span>' : '<span class="label label-danger"><i class="lock icon"></i> Oui</span>' ?>
                </td>
                <td><?= $this->time($ticket->created) ?></td>
                <td class="action">
                    <?= $this->Html->link(__('Regarder'), ['controller' => 'Tickets', 'action' => 'view', $ticket->id], ['class' => 'btn btn-info']) ?>
                    <?php
                    if($ticket->user_id == $this->request->session()->read('Auth.User.id') || $this->request->session()->read('Auth.User.role') == 'admin'):
                        ?>
                        <?= $this->Html->link(__('Éditer'), ['controller' => 'Tickets', 'action' => 'edit', $ticket->id], ['class' => 'btn btn-warning']) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Tickets', 'action' => 'delete', $ticket->id], ['class' => 'btn btn-danger', 'confirm' => __('Voulez vous vraiment supprimer ce ticket? '. "\n" . $ticket->subjects)]) ?>
                    <?php endif?>
                </td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>

    <?= $this->element('paginate'); ?>
</div>

