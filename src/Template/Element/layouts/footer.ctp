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

    <?= $this->Html->script([
        'https://code.jquery.com/jquery-2.1.4.min.js',
        'https://rawgit.com/nathco/jQuery.scrollSpeed/master/jQuery.scrollSpeed.js',
        'https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js',
        'http://yuku-t.com/jquery-overlay/jquery.overlay.js',
        'http://yuku-t.com/jquery-textcomplete/media/javascripts/jquery.textcomplete.js',
        '//cdn.jsdelivr.net/emojione/1.5.0/lib/js/emojione.min.js',
        'app.js'
    ]); ?>

    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

</body>
</html>
