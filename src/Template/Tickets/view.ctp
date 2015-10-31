<div class="container">
	<div class="posts">
		<div class="post">
			<div class="post-title" id="post-title">
				<h1><?= h($ticket->subjects) ?>

					<?php
					if($ticket->label == 0): ?>
						<?php
						if($ticket->user_id == $this->request->session()->read('Auth.User.id') ||
							$this->request->session()->read('Auth.User.role') == 'admin'):

							if($ticket->label == 0){
								echo $this->Form->postLink(__('<i class="fa fa-star-o right star-hover"></i>'),
									['controller' => 'Tickets',
										'action' => 'label', 'id' => 'post-title',
										$ticket->id
									],
									[
										'title' => 'Rendre votre ticket résolu',
										'escape' => false,
										'id' => 'post-title',
										'confirm' => __('Êtes-vous sûr que votre ticket est résolu?')
									]);

							} else{
								echo '<i class="fa fa-star right"></i>';
							} ?>
						<?php endif ?>
					<?php endif?>
				</h1>

			</div>

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
				<p><?= nl2br($client->toImage($html)); ?></p>
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

						<a href="#" id="report_btn" class="btn btn-danger">Signaler</a>
					</div>
				<?php endif; ?>
			</div>

			<div id="group_report">
				<?= $this->Form->create(null, [
					'url' => ['controller' => 'Tickets', 'action' => 'report', $ticket->id]
				]);
				?>
				<div class="form-group" id="">
					<?php
					echo $this->Form->input('report',
						[
							'id'         => 'report',
							'class'      => 'form',
							'label'      => false,
							'rows'       => '6',
							'placeholder'=> 'Votre message...'
						]
					); ?>
				</div>
				<?= $this->Form->button(__('Signaler'), ['class' => 'btn btn-success sendButton', 'id' => 'sendButton', 'onClick' => 'post_comment()']) ?>
				<?= $this->Form->end(); ?>
			</div>

			<?= $this->element('comment'); ?>
		</div>
	</div>
</div>
