<div>


    <div wire:ignore class="form-group row">
        <label class="col-md-3 col-form-label" for="message" value="Compose message" />
        <div class="col-md-9">
            <textarea wire:model="message" class="form-control required" name="message"
                id="message"></textarea>
            {{-- <x-error-message :value="__('message')" /> --}}
        </div>
    </div>

    <div>{{ $message }}</div>


    <script>
        window.addEventListener("load", (e)=>{

        ClassicEditor
            .create(document.querySelector('#message'), {
                plugins: [ Essentials, Paragraph, Bold, Italic ],
                toolbar: [ 'bold', 'italic' ]
            })
            .then(editor => {
                console.log(editor);
                //editor.model.document.on('change:data', () => {
                  //  @this.set('message', editor.getData());
                  //console.log('Hi');
                //})
            })
            .catch(error => {
                console.error(error.stack);
            });
        });
    </script>

    # optional if you want fire the event when submit button is clicked
    {{-- <script>
     ClassicEditor
            .create(document.querySelector('#message'))
            .then(editor => {
                document.querySelector("#submit").addEventListener("click", () => {
                    const textareaValue = $("#message").data("message");
                    eval(textareaValue).set("message", editor.getData());
                    // @this.set('message', editor.getData());
                });
            })
            .catch(error => {
                console.error(error);
            });

    </script> --}}


</div>
