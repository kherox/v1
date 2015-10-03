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
                <td><span class="label label-danger"><?= $ticket->label ?></span></td>

                <td>
                    <a href="#">
                        <i style="color: rgb(233, 109, 109);font-size: 16px;" class="fa fa-trash-o"></i>
                    </a>
                    <a href="#">
                        <i style="font-size: 16px;"  class="fa fa-pencil-square-o"></i>
                    </a>

                    <a href="#">
                        <i style="font-size: 16px;"  class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>