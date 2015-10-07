<footer class="footer">
    <div class="container">
        <div class="grid-8">
            <h2>Soutenir OranTicket</h2>
            <p>
                - Vous avez une idée, aucune idée nest bête. Proposé là sur le chan General <a href="https://discord.gg/0TXt7JbSm9fnbttA">Discord</a> de OranTicket.<br>
                - Vous souhaitez améliorer le code de OranTicket ou ajouter des fonctionnalités,
                voici le <a href="https://github.com/OranTicket">dépôt Github</a>
            <p>
        </div>
        <div class="grid-4">
            <h2>OranTicket</h2>
            <p>
                Dès que vous rencontrez un souci, poster un ticket et des personnes y répondons.
            </p>
        </div>
    </div>
    <p class="center">Gratuit et Open-source par <a href="gynidark.github.io">Gynidark</a></p>
</footer>

    <?=
    // LIB
    $this->Html->script([
        'src/jquery.js',
        'src/sidebar.js',
        'src/scrollspeed.js',
        'src/overlay.js',
        'src/textcomplete.js',
        'src/emojione.js'
    ]); ?>

    <?=
    // FILE
    $this->Html->script([
        'inc/global.js',
        'inc/emojione.js',
        'inc/comment.js',
        'inc/profile.js',
        'inc/modal.js',
    ]); ?>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

</body>
</html>
