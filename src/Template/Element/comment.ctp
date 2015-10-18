<div class="post-comments">
	<div class="post-list">
		<?php
        foreach ($ticket->comments as $comment):
		?>
			<div class="container">
				<div class="grid-1">
					<?php
						foreach($users as $user){
							if($comment->user_id == $user->id){
								echo
                                $this->Html->link(
									$this->Html->image($this->gravatar($user->mail), ['width' => '55']),
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
				</div>
				<div class="grid-11">
					<h4 class="media-heading">
						<?php
						foreach($users as $user){
							if($comment->user_id == $user->id){
								echo $user->username;
							}
						}
						?>
						|
						<small>
							<?=h($comment->modified->format('d/m/Y G:i:s')) ?>
						</small>

						<small style="display: inline-block">
							<?php
	                        if($comment->user_id == $this->request->session()->read('Auth.User.id') ||
							   $this->request->session()->read('Auth.User.role') == 'admin'):
							?>
								<?= $this->Html->link(__('Éditer'), [
									'controller' => 'Tickets',
									'action' => 'editComment',
									$comment->id
								],
								['class' => 'btn-small btn-warning']) ?>

								<?= $this->Form->postLink(__('Supprimer'), [
									'controller' => 'Tickets',
									'action' => 'deleteComment',
									$comment->id
								],
								[
									'class' => 'btn-small btn-danger',
									'confirm' => __('Voulez vous vraiment supprimer ce commentaire?')
								]) ?>
							<?php endif; ?>
						</small>
					</h4>
					<p>
						<?= nl2br($client->toImage($comment['content'])); ?>
					</p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<?php
    if(!empty($this->request->session()->read('Auth.User'))){ ?>

		<?= $this->Form->create('Comments') ?>
			<div class="form-group" style="margin-top: 30px;">
				<?php echo $this->Form->input('user_id', ['type' => 'hidden']); ?>
				<?php
		            echo $this->Form->input('content', ['placeholder' => 'Votre commentaire...', 'type' => 'textarea', 'class' => 'form emoji', 'label' => false]);
				?>
			</div>
		<?= $this->Form->button(__('Ajouter le commentaire'), ['class' => 'btn btn-success sendButton', 'id' => 'sendButton']) ?>
		<?= $this->Form->end(); ?>

	<?php }else{ ?>

		<div class="post-label">
			<div id="flash-message" class="flash-message flash-info">
				<button type="button" class="close"><i class="fa fa-times"></i></button>
				<strong>Attention!</strong> Vous devez être connecté pour envoyer un commentaire.
				<?= $this->Html->link(__('Se connecter'),['controller' => 'Users', 'action' => 'login']) ?>
			</div>
		</div>

	<?php } ?>
</div>
