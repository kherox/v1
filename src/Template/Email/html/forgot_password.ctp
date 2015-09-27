<style>
    header{}
    h1{
        font-family: sans-serif;
        font-weight: 100;
        color: #3E3E3E;
        font-size: 42px;
        text-transform: uppercase;
    }
    .content{
        text-align: center;
        background-color: rgb(232, 232, 232);
        padding: 10%;
        border: solid 1px #D6D6D6;
        border-bottom: 5px solid #D6D6D6;
    }

    h2{
         font-family: sans-serif;
         font-weight: 500;
         color: #9A9A9A;
     }

    span{
        color: #FA6514;
    }

    .btn {
        display: inline-block;
        padding: 15px 50px;
        margin-bottom: -1px;
        margin-right: 15px;
        font-size: 14px;
        font-family: sans-serif;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 400;
        color: #fff !important;
        cursor: pointer;
        outline: none;
    }
    .btn-success{
        background-color: #5cb85c;
        border: solid 1px #5cb85c;
    }
</style>

<div class="content">
    <header>
        <h1>OranTicket</h1>
    </header>
    <h2>Hey, <span><?= h($name) ?></span></h2>
    <p>
        <?=
        $this->Html->link(
            __d('mail', 'Changer le mot de passe'),
            [
                '_name' => 'users-resetpassword',
                'id' => $userID,
                'code' => $code,
                '_full' => true
            ],
            [
                'class' => 'btn btn-success'
            ]
        )
        ?>
    </p>

</div>