<div class="ui items">
	<div class="item">
		<a class="ui tiny image">
			<?php
			foreach($users as $user){
				if($ticket->user_id == $user->id){
					echo
						$this->Html->image($this->gravatar($user->mail), ['width' => '65']);
				}
			}
			?>
		</a>
		<div class="middle aligned content">
			<div class="header">
				<?php
				if($ticket->label == 0): ?>
					<?php
					if($ticket->user_id == $this->request->session()->read('Auth.User.id') ||
						$this->request->session()->read('Auth.User.role') == 'admin'):

						if($ticket->label == 0){
							echo $this->Form->postLink(__('<i class="favorite icon"></i>'),
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
							echo '<i class="favorite icon"></i>';
						} ?>
					<?php endif ?>
				<?php endif?>

				<?= h($ticket->subjects) ?>
			</div>
		</div>
	</div>
</div>

<p><?= nl2br($client->toImage($html)); ?></p>

<?php
if($ticket->user_id == $this->request->session()->read('Auth.User.id') ||
	$this->request->session()->read('Auth.User.role') == 'admin'):
	?>
	<div style="margin-top: 20px;">
		<?=
		$this->Html->link(__('Éditer'), [
			'controller' => 'Tickets',
			'action' => 'edit',
			$ticket->id
		],[
			'class' => 'positive ui button'
		]); ?>

		<?=
		$this->Form->postLink(__('Supprimer'), [
			'controller' => 'Tickets',
			'action' => 'delete',
			$ticket->id
		], [
			'class' => 'negative ui button',
			'confirm' => __('Voulez vous vraiment supprimer ce ticket? '. "\n" . $ticket->subjects)
		]); ?>

		<a href="#" id="report_btn" class="negative ui button">Signaler</a>
	</div>
<?php endif; ?>


<?= $this->element('comment'); ?>
