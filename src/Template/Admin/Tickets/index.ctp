<div class="box-header">
    <h3 class="box-title">Tickets</h3>
    <span class="label label-primary"><?= $ticketss ?></span>
</div>

<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Sujet</th>
            <th>Date de création</th>
            <th>N commentaires</th>
            <th>Résolu?</th>
            <th>Action</th>
        </tr>

        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?= $ticket->id ?></td>
                <td><?= $ticket->subjects ?></td>
                <td><?= $ticket->created ?></td>
                <td><?= $ticket->comment_count ?></td>
                <td>
                    <?= h($ticket->label == '0') ? '<span class="label label-danger">Non</span>' : '<span class="label label-success">Oui</span>' ?>
                </td>

                <td>


                    <a
                        class="btn-small btn-success"
                        style="padding: 3px 8px;margin-right: 3px;"
                        href="
                            <?= $this->url(); ?>Tickets/view/<?= $ticket->id ?>
                        ">

                        Regardé
                    </a>

                    <?= $this->Html->link(__('Éditer'), [
                        'controller' => 'Tickets',
                        'action' => 'edit',
                        $ticket->id
                    ],
                    [
                        'class' => 'btn-small btn-warning',
                        'confirm' => __('Voulez vous vraiment éditer ce commentaire?'. $ticket->id),
                        'style' => 'padding: 3px 8px;'
                    ]); ?>

                    <?= $this->Form->postLink(__('Supprimer'), [
                        'controller' => 'Tickets',
                        'action' => 'delete',
                        $ticket->id
                    ],
                    [
                        'class' => 'btn-small btn-danger',
                        'confirm' => __('Voulez vous vraiment supprimer ce commentaire?'. $ticket->id),
                        'style' => 'padding: 3px 8px;'
                    ]); ?>

                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>