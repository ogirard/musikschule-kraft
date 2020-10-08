module MusikschuleKraft.CodeEditor {
  var editor: AceAjax.Editor;

  export function Init(): void {
    editor = ace.edit("editor");
    editor.setShowPrintMargin(false);
    editor.setTheme("ace/theme/github");
    editor.getSession().setMode("ace/mode/json");
  }

  export function SynchronizeCode(): void {
    $('#mk-json').val(editor.getSession().getValue());
  }
}

// jQuery ready
$(MusikschuleKraft.CodeEditor.Init);
