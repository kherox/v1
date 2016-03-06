<div class="ui inverted vertical footer segment" style="margin-top: 20px;">
    <div class="ui container">
        <div class="ui stackable inverted divided equal height stackable grid">
            <div class="three wide column">
                <h4 class="ui inverted header">A propos</h4>
                <div class="ui inverted link list">
                    <a href="#" class="item">CGU</a>
                    <a href="#" class="item">Contact</a>
                </div>
            </div>
            <div class="three wide column">
                <h4 class="ui inverted header">Services</h4>
                <div class="ui inverted link list">
                    <a href="#" class="item">FAQ</a>
                </div>
            </div>
            <div class="seven wide column">
                <h4 class="ui inverted header">Pourquoi?</h4>
                <p>Ticki à était réalisé afin d'apprendre CakePHP 3 mais aussi servir de base pour les débutants. Coté design, c'est Semantic-UI.</p>
            </div>
        </div>
    </div>
</div>

    <?=
    // LIB
    $this->Html->script([
        'src/jquery.js',
        'https://cdn.socket.io/socket.io-1.4.3.js',
        'https://www.google.com/recaptcha/api.js',
        'https://cdn.socket.io/socket.io-1.3.7.js',
        'src/markdown-library.js',
        'src/scrollspeed.js',
        'src/overlay.js',
        'src/textcomplete.js',
        'src/emojione.js',
        'src/mte.js',
        'src/highlight.js',
        'http://semantic-ui.com/dist/semantic.min.js'
    ]); ?>

    <?=
    // FILE
    $this->Html->script([
        'inc/app.js',
        'inc/global.js',
        'inc/emojione.js',
        'inc/sidebar.js',
        'inc/comment.js',
        'inc/profile.js',
        'inc/semantic.js',
        'inc/modal.js',
        'inc/socket.js',
        'inc/markdown.js'
    ]); ?>

    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.8.0/highlight.min.js"></script>
    <script>
        hljs.configure({useBR: true});
        hljs.initHighlightingOnLoad();</script>
</body>
</html>
