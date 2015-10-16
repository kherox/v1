<div class="box-header">
    <h3 class="box-title">Utilisateurs</h3>
    <span class="label label-primary"><?= $userss ?></span>
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
                <th>role</th>
                <th>Action</th>
            </tr>

            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $this->time($user->created) ?></td>
                    <td><?= $user->last_ip ?></td>
                    <td><?= $user->mail ?></td>
                    <td>
                        <?= h(empty($user->role)) ? '<span class="label label-danger">Aucun</span>' : '<span class="label label-success">'. $user->role .'</span>' ?>
                    </td>

                    <td>
                        <a
                            class="btn-small btn-success"
                            target="_blank"
                            style="padding: 3px 8px;margin-right: 3px;"
                            href="
                            <?= $this->url(); ?>Users/view/<?= $user->id ?>
                        ">
                            Regardé
                        </a>

                        <a
                            class="btn-small btn-warning"
                            target="_blank"
                            style="padding: 3px 8px;margin-right: 3px;"
                            href="
                            <?= $this->url(); ?>Users/edit/<?= $user->id ?>
                        ">
                            Édité
                        </a>

                        <?php if(!$user->is_deleted): ?>
                            <a
                                class="btn-small btn-danger"
                                target="_blank"
                                style="padding: 3px 8px;margin-right: 3px;"
                                confirm="Voulez vous vraiment désactiver ce compte?"
                                href="
                                    <?= $this->url(); ?>Users/delete/<?= $user->id ?>
                                ">
                                Désactivé
                            </a>
                        <?php else: ?>
                            <a
                                class="btn-small btn-info"
                                target="_blank"
                                style="padding: 3px 12px;margin-right: 3px;"
                                confirm="Voulez vous vraiment réactivé ce compte?"
                                href="
                                    <?= $this->url(); ?>Users/active/<?= $user->id ?>
                                ">
                                Réactivé
                            </a>
                        <?php endif?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>