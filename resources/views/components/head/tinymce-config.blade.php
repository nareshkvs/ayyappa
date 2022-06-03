
    <div>
        <div
            x-data="{ taValue: @entangle($attributes->wire('model')) }"
            x-init="
            tinymce.remove('#' + $refs.tinymceEditor.id);
            tinymce.init({
                selector: '#' + $refs.tinymceEditor.id,
                menubar: true,
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
                setup: function(editor) {
                    editor.on('change', function(e) {
                        taValue = editor.getContent();
                    })
                    editor.on('init change', function (e) {
                        if (taValue != null) {
                            editor.setContent(taValue)
                        }
                        editor.save();
                    })
                    function putCursorToEnd() {
                        editor.selection.select(editor.getBody(), true);
                        editor.selection.collapse(false);
                    }
                    //$watch('taValue', function (newValue) {
                    //    if (newValue !== editor.getContent()) {
                    //        editor.resetContent(newValue || '');
                    //        putCursorToEnd();
                    //    }
                    //});
                }
            })
        "
            wire:ignore
        >

            <div>
                <input
                    x-ref="tinymceEditor"
                    type="textarea"
                    {{ $attributes->whereDoesntStartWith('wire:model') }}
                >
            </div>
        </div>
    </div>
