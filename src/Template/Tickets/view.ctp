<div class="container">
	<div class="posts">
		<div class="post">
			<div class="post-title">
				<h1><?= h($ticket->subjects) ?>
					<?php
                    if($ticket->label == 0){ ?>
					<?php
                        if($ticket->user_id == $this->request->session()->read('Auth.User.id') ||
					$this->request->session()->read('Auth.User.role') == 'admin'):
					?>
					<?= h($ticket->label == 0) ?
					$this->Form->postLink(__('<i class="fa fa-star-o right star-hover"></i>'),
						['controller' => 'Tickets',
						'action' => 'label',
						$ticket->id
					],
					[
						'title' => 'Rendre votre ticket résolu',
						'escape' => false,
						'confirm' => __('Êtes-vous sûr que votre ticket est résolu?')
					]) : '<i class="fa fa-star right"></i>'
					?>

					<?php endif; ?>
					<?php } ?>
				</h1>

			</div>
			<?php
            if($ticket->label == 1):
			?>
				<div class="post-label">
					<div id="flash-message" class="flash-message flash-success">
						<button type="button" class="close"><i class="fa fa-times"></i></button>
						<strong>Succéss!</strong> Ce ticket est fermé, le ticket est résolu.
					</div>
				</div>
			<?php endif; ?>


			<div class="post-author">

				<?php
                    foreach($users as $user){
                        if($ticket->user_id == $user->id){
							echo
							$this->Html->link(
								$this->Html->image($this->gravatar($user->mail), ['width' => '65']),
								[
									'controller' => 'Users',
									'action'     => 'view',
									$user->id
								],
								['escape' => false]
							);
						}
					}
				?>
                <span>
                <?php
                    foreach($users as $user){
                        if($ticket->user_id == $user->id){
                            echo $user->username;
                        }
                    }
                ?>
                </span>
			</div>

			<div class="post-content">
				<p><?= nl2br($client->toImage($ticket->content)); ?></p>
				<?php
                if($ticket->user_id == $this->request->session()->read('Auth.User.id') ||
				   $this->request->session()->read('Auth.User.role') == 'admin'):
				?>
					<div class="right">
						<?= $this->Html->link(__('Éditer'), ['controller' => 'Tickets', 'action' => 'edit', $ticket->id],
						['class' => 'btn btn-warning']) ?>

						<?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Tickets', 'action' => 'delete',
							$ticket->id], ['class' => 'btn btn-danger', 'confirm' => __('Voulez vous vraiment supprimer ce
						ticket? '. "\n" . $ticket->subjects)]) ?>

						<?=
							$this->Form->postLink(__('Report'),
								['controller' => 'Tickets',
									'action' => 'report',
									$ticket->id
								],
								[
									'title' => 'Signalé ce ticket',
									'escape' => false,
									'confirm' => __('Voulez vous vraiment signalé ce ticket?'),
									'class' => 'btn btn-danger'
								])
						?>
					</div>
				<?php endif; ?>
			</div>

			<?= $this->element('comment'); ?>
		</div>
	</div>
</div>