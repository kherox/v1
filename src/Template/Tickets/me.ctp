<h1 class="page-title">
    Mes tickets<span class="label label-info"><?= $ticketss ?></span>
</h1>

<div class="container">
    <table class="table">
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
                    <?= h($ticket->public == '0') ? '<span class="label label-success">Non</span>' : '<span class="label label-danger">Oui</span>' ?>
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
</div>