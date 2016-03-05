<div class="ui inverted footer vertical segment center">
    <div class="ui stackable center aligned page grid">
        <div class="four column row">

            <div class="column">
                <h5 class="ui inverted header">Courses</h5>
                <div class="ui inverted link list">
                    <a class="item">Registration</a>
                    <a class="item">Course Calendar</a>
                    <a class="item">Professors</a>
                </div>
            </div>
            <div class="column">
                <h5 class="ui inverted header">Library</h5>
                <div class="ui inverted link list">
                    <a class="item">A-Z</a>
                    <a class="item">Most Popular</a>
                    <a class="item">Recently Changed</a>
                </div>
            </div>
            <div class="column">
                <h5 class="ui inverted header">Community</h5>
                <div class="ui inverted link list">
                    <a class="item">BBS</a>
                    <a class="item">Careers</a>
                    <a class="item">Privacy Policy</a>
                </div>
            </div>

            <div class="column">
                <h5 class="ui inverted header">Designed By</h5>
                <addr>
                    <a class="item" href="http://scripteden.com"><img src="images/scripteden-logo-g.png" alt="Logo" style="height:20px"></a>  <br>
                    <a href="http://scripteden.com/downloads/bootstrap/">Bootstrap Templates</a>           <br>
                    <a href="http://scripteden.com/downloads/semantic-ui/">Semantic UI Templates</a>
                </addr>


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
