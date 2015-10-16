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
            <th title="Nombre de commentaire">N commentaires</th>
            <th>Résolu?</th>
            <th>Signalé</th>
            <th>Action</th>
        </tr>

        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?= $ticket->id ?></td>
                <td><?= $ticket->subjects ?></td>
                <td><?= $this->time($ticket->created) ?></td>
                <td><?= $ticket->comment_count ?></td>
                <td>
                    <?= h($ticket->label == '0') ? '<span class="label label-danger">Non</span>' : '<span class="label label-success">Oui</span>' ?>
                </td>
                <td>
                    <?= h($ticket->report == '0') ? '<span class="label label-danger">Non</span>' : '<span class="label label-success">Oui</span>' ?>
                </td>

                <td>
                    <a
                        class="btn-small btn-success"
                        target="_blank"
                        style="padding: 3px 8px;margin-right: 3px;"
                        href="
                            <?= $this->url(); ?>Tickets/view/<?= $ticket->id ?>
                        ">
                        Regardé
                    </a>

                    <a
                        class="btn-small btn-warning"
                        target="_blank"
                        style="padding: 3px 8px;margin-right: 3px;"
                        href="
                            <?= $this->url(); ?>Tickets/edit/<?= $ticket->id ?>
                        ">
                        Édité
                    </a>

                    <a
                        class="btn-small btn-danger"
                        target="_blank"
                        style="padding: 3px 8px;margin-right: 3px;"
                        confirm="<?= "Voulez vous vraiment supprimer ce ticket" . $ticket->subjects ?>"
                        href="
                            <?= $this->url(); ?>Tickets/delete/<?= $ticket->id ?>
                        ">
                        Supprimé
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>