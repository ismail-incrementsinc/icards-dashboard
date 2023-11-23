<form id="create-form">
    @csrf
    <div class="form-group">
        <label for="name">Category name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name">
        <span class="text-danger" id="name_error"></span>
    </div>
    <div class="form-group">
        <label for="bg_color">Background color</label>
        <input type="color" class="form-control" id="bg_color" name="bg_color">
        <span class="text-danger" id="bg_color_error"></span>
    </div>
    <div class="form-group">
        <label for="text_color">Text color</label>
        <input type="color" class="form-control" id="text_color" name="text_color">
        <span class="text-danger" id="text_color_error"></span>
    </div>
    <div class="form-group">
        <label for="qr_color">QR color</label>
        <input type="color" class="form-control" id="qr_color" name="qr_color">
        <span class="text-danger" id="qr_color_error"></span>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" name="description">
        <span class="text-danger" id="description_error"></span>
    </div>
    <button type="submit" id="addBtn" class="addButton btn btn-block" style="background: #2E9A57; color: white"><i class="fa fa-save"></i>&nbsp; Save</button>
</form>

<script>

    $(document).on('click','#addBtn',function (event) {
        event.preventDefault();
        var form = $('#create-form')[0];
        var formData = new FormData(form);

        // Set header if need any otherwise remove setup part
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            }
        });
        $.ajax({
            url: "{{route('category.store')}}",// your request url
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                toastr.options ={ "closeButton" : true, "progressBar" : true }
                toastr.success("Category created successfully");

                setTimeout(function() {
                    location.reload();
                }, 3000);
            },
            error: function (data) {
                var errorMessage = '<div class="card bg-danger">\n' +
                    '<div class="card-body text-center p-5">\n' +
                    '<span class="text-white">';
                $.each(data.responseJSON.errors, function(key, value) {
                    errorMessage += ('' + value + '<br>');
                    $("#" + key + "_error").text(value[0]);
                });
                errorMessage += '</span>\n' +
                    '</div>\n' +
                    '</div>';

            }
        });

    });

</script>


