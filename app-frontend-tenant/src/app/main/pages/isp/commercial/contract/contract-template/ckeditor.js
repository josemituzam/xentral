//import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor.js';
//import * as ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import ClassicEditorBase from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
//import * as DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';
import PageBreak from '@ckeditor/ckeditor5-page-break/src/pagebreak';
export default class Editor extends ClassicEditorBase { }


Editor.builtinPlugins = [
    PageBreak,
];