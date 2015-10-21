<h1 class="page-title">
	Commentaire - Édition du commentaire
</h1>

<div class="container">
	<div class="posts">
		<div class="post">
			<?= $this->Form->create($comment) ?>
			<div class="post-content" style="border: none!important;">
				<?= $this->Form->textarea('content', ['id' => 'emoji', 'class' => 'form']); ?>
			</div>
			<?= $this->Form->button(__('Édité'), ['class' => 'btn btn-success pull-right']) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>
