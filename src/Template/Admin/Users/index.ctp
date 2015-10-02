<div class="box-header">
    <h3 class="box-title">Utilisateurs</h3>
</div>

<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <tbody>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Date de création</th>
                <th>Adresse IP</th>
                <th>Adresse mail</th>
                <th>Supprimé?</th>
                <th>role</th>
                <th>Action</th>
            </tr>

            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $user->created ?></td>
                    <td><?= $user->last_ip ?></td>
                    <td><?= $user->mail ?></td>
                    <td><span class="label label-danger">Oui</span></td>
                    <td><?= $user->role ?></td>

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