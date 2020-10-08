/// <reference path="../bower_components/DefinitelyTyped/jquery/jquery.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular-route.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/ace/ace.d.ts" />
var MusikschuleKraft;
(function (MusikschuleKraft) {
    var CodeEditor;
    (function (CodeEditor) {
        var editor;
        function Init() {
            editor = ace.edit("editor");
            editor.setShowPrintMargin(false);
            editor.setTheme("ace/theme/github");
            editor.getSession().setMode("ace/mode/json");
        }
        CodeEditor.Init = Init;
        function SynchronizeCode() {
            $('#mk-json').val(editor.getSession().getValue());
        }
        CodeEditor.SynchronizeCode = SynchronizeCode;
    })(CodeEditor = MusikschuleKraft.CodeEditor || (MusikschuleKraft.CodeEditor = {}));
})(MusikschuleKraft || (MusikschuleKraft = {}));
// jQuery ready
$(MusikschuleKraft.CodeEditor.Init);
//# sourceMappingURL=mk-file-edit.js.map