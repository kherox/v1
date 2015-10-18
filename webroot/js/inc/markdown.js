var myEditor = new MTE(document.getElementById('markdown-editor'), {
    tabSize: '    ',
    shortcut: true,
    keydown: function(e, base) {
        console.log('Updated! (keydown:' + e.keyCode + ')');
    },
    click: function(e, base, type) {
        console.log('Updated! (click:' + type + ')');
    },
    ready: function() {
        console.log('Ready!');
    },
    cut: function(selection) {
        console.log(selection);
    },
    copy: function(selection) {
        console.log(selection);
    },
    paste: function(selection) {
        console.log(selection);
    }
});

// Custom Drop
myEditor.button('paint-brush', {
    title: 'Example Drop',
    click: function(e, base) {
        base.drop('color', function(drop) {
            var colors = ['#5FB0E6', '#86CDEA', '#86BAA3', '#706D45'], color;
            drop.innerHTML = "";
            for (var i in colors) {
                color = document.createElement('span');
                color.className = 'color';
                color.title = colors[i];
                color.style.backgroundColor = colors[i];
                color.onclick = function() {
                    base.grip.wrap('<span style="color:' + this.title + ';">', '</span>');
                    base.close(true);
                };
                drop.appendChild(color);
            }
        });
    }
});
// Toolbar Separator
myEditor.separator({position: 4});