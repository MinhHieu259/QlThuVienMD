@push('js')
    <script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>

    <script type="text/javascript"
            src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script>
        $('#colorPicker').colorpicker().on('change', function(event) {
            $('#colorPicker .fa-square').css('color', event.color.toString());
        })
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#note'))
        $('form').submit(function() {
        @this.set('state.note', $('#note').val());
        })
    </script>
@endpush
