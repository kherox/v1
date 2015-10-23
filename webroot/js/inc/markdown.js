var myEditor = new MTE(document.getElementById('markdown-editor'), {
    tabSize: '    ',
    shortcut: true,

    buttons: {
        rule: false,
        undo: false,
        redo: false
    },
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

myEditor.separator({position: 4});