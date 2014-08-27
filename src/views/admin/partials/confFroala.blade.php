@section('stylesheets')
	@parent
	{{asmoyoAsset('plugin/froala_editor/css/froala_editor.min.css', 'admin')}}
@stop

@section('javascripts')
	@parent
	{{asmoyoAsset('plugin/froala_editor/js/froala_editor.min.js', 'admin')}}

	<script>
		var froala_defaults = {
			buttons: ["bold", "italic", "underline", "strikeThrough", "fontFamily", "fontSize", "color", "formatBlock", "blockStyle", "align", "insertOrderedList", "insertUnorderedList", "outdent", "indent", "selectAll", "createLink", "insertImage", "insertVideo", "table", "undo", "redo", "html", "insertCode"],
			imageUploadURL: "{{route('admin.media.storeFroala')}}",
			imagesLoadURL: "{{route('admin.media.getForFroala')}}",
			height: 400,
			inlineMode: false,
			customButtons: {
	            insertCode: {
	                title: 'Insert Code',
	                icon: {
	                    type: 'font',
	                    value: 'fa fa-dollar' // Font Awesome icon class fa fa-*
	                },
	                callback: function (editor) {
	                    editor.saveSelection();

	                    var codeModal = $("<div>").addClass("froala-modal").appendTo("body");
	                    var wrapper = $("<div>").addClass("f-modal-wrapper").appendTo(codeModal);
	                    $("<h4>").append('<span data-text="true">Insert Code</span>')
	                        .append($('<i class="fa fa-times" title="Cancel">')
	                        .click(function () {
	                            codeModal.remove();
	                        }))
	                        .appendTo(wrapper);

	                    var dialog = "<textarea id='code_area' style='height: 211px; width: 538px;' /><br/><label>Language:</label><select id='code_lang'><option>CSharp</option><option>VB</option><option>JScript</option><option>Sql</option><option>XML</option><option>CSS</option><option>Java</option><option>Delphi</option></select> <input type='button' name='insert' id='insert_btn' value='Insert' /><br/>";
	                    $(dialog).appendTo(wrapper);

	                    $("#code_area").text(editor.text());

	                    if (!editor.selectionInEditor()) {
	                        editor.$element.focus();
	                    }

	                    $('#insert_btn').click(function () {
	                        var lang = $("#code_lang").val();
	                        var code = $("#code_area").val();
	                        code = code.replace(/\s+$/, ""); // rtrim
	                        code = $('<span/>').text(code).html(); // encode        

	                        var htmlCode = "<pre language='" + lang + "' name='code'>" + code + "</pre></div>";
	                        var codeBlock = "<div align='left' dir='ltr'>" + htmlCode + "</div><br/>";

	                        editor.restoreSelection();
	                        editor.insertHTML(codeBlock);
	                        editor.saveUndoStep();

	                        codeModal.remove();
	                    });
	                }
	            }
	        }
		};

	    $(function() {
	        $('.froala_editor').editable( jQuery.extend(froala_defaults, {}) );
	        // $('.froala_editor_inline').editable( jQuery.extend(froala_defaults, {inlineMode:true}) );
	    });
	</script>
@stop