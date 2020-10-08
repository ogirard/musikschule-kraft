/// <reference path="../bower_components/DefinitelyTyped/jquery/jquery.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular-route.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/ace/ace.d.ts" />

module MusikschuleKraft.CodeEditor {
  var editor : AceAjax.Editor;

  export function Init() : void {
    editor = ace.edit("editor");
    editor.setShowPrintMargin(false);
    editor.setTheme("ace/theme/github");
    editor.getSession().setMode("ace/mode/json");
  }

  export function SynchronizeCode() : void {
    $('#mk-json').val(editor.getSession().getValue());
  }
}

// jQuery ready
$(MusikschuleKraft.CodeEditor.Init);
