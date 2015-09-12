<div class="container">
	<div class="posts">
		<div class="post">
			<?= $this->Form->create($comment) ?>
			<h2>Édition de votre commentaire</h2>
			<div class="post-content" style="border: none!important;">
				<?= $this->Form->textarea('content', ['id' => 'emoji', 'class' => 'form']); ?>
			</div>
			<?= $this->Form->button(__('Édité'), ['class' => 'btn btn-success pull-right']) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>