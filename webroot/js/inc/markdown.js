var myEditor = new MTE(document.getElementById('markdown-editor'), {
    tabSize: '    ',
    shortcut: true,

    buttons: {
        rule: false,
        undo: false,
        redo: false
    }
});

var editor = new MTE(document.getElementById('editor'),{
    tabSize: '    ',
    shortcut: true,

    buttons: {
        rule: false,
        undo: false,
        redo: false
    }
});