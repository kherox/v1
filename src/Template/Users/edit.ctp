<h1 class="page-title">
    Espace Membre - Éditer mon compte
</h1>
<div class="container">
    <?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>
            <div class="grid-12">
                <?php
                    echo $this->Form->input('username', ['class' => 'form']);
                    echo $this->Form->input('password', ['class' => 'form', 'style' => "margin-bottom: 10px"]);
                ?>
            </div>
            <div class="gird-2">
                <?php
                if(!empty($user->avatar)){
                    echo $this->Html->image('upload/avatars/'. $user->avatar, ['width' => '100']);
                }else{
                    echo $this->Html->image('upload/avatars/avatar_default.png', ['width' => '100']);
                }
                ?>
            </div>
            <div class="grid-10">
                <?= $this->Form->input('avatar_file', ['type' => 'file', 'class' => 'form']); ?>
            </div>
            <div class="grid-12">
                <?php
                    echo $this->Form->input('website', ['class' => 'form']);
                    echo $this->Form->input('mail', ['class' => 'form']);
                ?>
            </div>
    <br>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end() ?>
</div>
