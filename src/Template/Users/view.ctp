<div class="profil">
    <div class="profil-header">
        <div class="container">
            <div class="grid-4 center">
                <div class="grid-6 grid-m-5">
                    <img src="http://perlbal.hi-pi.com/blog-images/55444/gd/1225116859/presentation-de-ma-star-prefere.jpg" alt="Photo de profil Gynidark" width="110">
                </div>
                <div class="grid-6 grid-m-7">
                    <div class="profil-name">
                        <h2><?= $user->username; ?></h2>
                        <span><?= $user->role; ?></span>
                    </div>
                </div>
            </div>

            <div class="grid-8">
                <div class="grid-12">
                    <div class="profil-stats">

                        <div class="grid-3 grid-m-4">
                            <h2>4</h2>
                            <span>Commentaires</span>
                        </div>
                        <div class="grid-3 grid-m-4">
                            <h2><?= $tickets_count; ?></h2>
                            <span>Tickets</span>
                        </div>

                        <div class="grid-3 grid-m-4">
                            <h2>3</h2>
                            <span>Tickets résolus</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab">
    <div class="container">
        <ul class="tabs">
            <li class="active">
                <a href="#">A propos</a>
            </li>
            <li>
                <a href="#">Tickets</a>
            </li>
        </ul>
        <div id="container">
            <section>
                <p>
                <div class="grid-6">
                    <div class="grid-12 profil-about">
                        <div class="container">
                            <div class="grid-4 grid-m-4">
                                <span>Site web</span>
                            </div>
                            <div class="grid-8 grid-m-8">
                                <span><a href="#"><i class="fa fa-link"></i> <?= $user->website; ?></a></span>
                            </div>
                        </div>
                        <div class="container">
                            <div class="grid-4 grid-m-4">
                                <span>Adresse mail</span>
                            </div>
                            <div class="grid-8 grid-m-8">
                                <span><a href="#"><i class="fa fa-reply"></i>
                                <?= $user->mail; ?></a></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid-6">
                    <div class="profil-about">
                        <div class="container">
                            <div class="grid-6">
                                <?= $this->Html->link(__('Éditer mon compte'), [
                                'controller' => 'Users',
                                'action' => 'edit',
                                $user->id],
                                ['class' => 'btn btn-info large ', 'style' => 'margin-top: 14px;margin-bottom: 10px;']) ?>
                            </div>
                            <div class="grid-6">
                                <?= $this->Html->link(__('Déconnexion'), [
                                'controller' => 'Users',
                                'action' => 'logout'],
                                ['class' => 'btn btn-danger large', 'style' => 'margin-top: 14px;margin-bottom: 10px;']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                </p>
            </section>
            <section>
                <p>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Sujet</th>
                        <th>Statut</th>
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
                        <td><?= h($ticket->created->format('d/m/Y G:i:s')) ?></td>
                        <td class="action">
                            <?= $this->Html->link(__('Regarder'), ['controller' => 'Tickets', 'action' => 'view', $ticket->id], ['class' => 'btn-action btn-info']) ?>
                            <?php
                                        if($ticket->user_id == $this->request->session()->read('Auth.User.id') || $this->request->session()->read('Auth.User.role') == 'admin'):
                            ?>
                            <?= $this->Html->link(__('Éditer'), ['controller' => 'Tickets', 'action' => 'edit', $ticket->id], ['class' => 'btn-action btn-warning']) ?>
                            <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Tickets', 'action' => 'delete', $ticket->id], ['class' => 'btn-action btn-danger', 'confirm' => __('Voulez vous vraiment supprimer ce ticket? '. "\n" . $ticket->subjects)]) ?>
                            <?php endif?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </p>
            </section>
        </div>
    </div>
</div>
