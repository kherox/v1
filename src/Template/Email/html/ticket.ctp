<style>
    header{}

    h1{

        text-align: center;
        font-family: sans-serif;
        font-weight: 100;
        color: #3E3E3E;
        font-size: 42px;
        text-transform: uppercase;
    }

    .content{

        background-color: rgb(232, 232, 232);
        padding: 10%;
        border: solid 1px #D6D6D6;
        border-bottom: 5px solid #D6D6D6;
    }

    h2{
        text-align: center;
        font-family: sans-serif;
        font-weight: 500;
        color: #9A9A9A;
    }

    span{
        color: #FA6514;
    }

    p{
        font-family: sans-serif;
        font-weight: 500;
        color: #3A3A3A;
    }
</style>

<div class="content">
    <header>
        <h1>Oran<span>Ticket</span></h1>
    </header>
    <h2><?= $subject ?></h2>
    <p>
        <?= $content ?>
    </p>
</div>