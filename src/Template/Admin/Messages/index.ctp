<div class="box-header">
    <h3 class="box-title">Messages</h3>
    <span class="label label-primary"><?= $messagess ?></span>
</div>

<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Date de création</th>
            <th>De</th>
            <th>Envoyé à</th>
            <th>Action</th>
        </tr>

        <?php foreach ($messages as $message): ?>
            <tr>
                <td><?= $message->id ?></td>
                <td><?= $message->title ?></td>
                <td><?= $message->date ?></td>
                <td><?= $message->id_expediteur ?></td>
                <td><?= $message->id_destinataire ?></td>

                <td><?= $message->comment_count ?></td>
                <td>
                    <?= h($message->label == '0') ? '<span class="label label-danger">Non</span>' : '<span class="label label-success">Oui</span>' ?>
                </td>

                <td>
                    <a
                        class="btn-small btn-success"
                        target="_blank"
                        style="padding: 3px 8px;margin-right: 3px;"
                        href="
                            <?= $this->url(); ?>Messages/view/<?= $message->id ?>
                        ">
                        Regardé
                    </a>

                    <a
                        class="btn-small btn-warning"
                        target="_blank"
                        style="padding: 3px 8px;margin-right: 3px;"
                        href="
                            <?= $this->url(); ?>Tickets/edit/<?= $message->id ?>
                        ">
                        Édité
                    </a>

                    <a
                        class="btn-small btn-danger"
                        target="_blank"
                        style="padding: 3px 8px;margin-right: 3px;"
                        confirm="<?= "Voulez vous vraiment supprimer ce ticket" . $message->subjects ?>"
                        href="
                            <?= $this->url(); ?>Tickets/delete/<?= $message->id ?>
                        ">
                        Supprimé
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>