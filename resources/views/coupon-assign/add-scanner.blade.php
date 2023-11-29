<form id="scanner-form">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        <span class="text-danger" id="name_error"></span>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        <span class="text-danger" id="email_error"></span>
    </div>
    <div class="form-group">
        <label for="organization">Organization</label>
        <input type="text" class="form-control" id="organization" name="organization" placeholder="Enter  organization">
        <span class="text-danger" id="organization_error"></span>
    </div>
    <div class="form-group">
        <label for="note">Note</label>
        <input type="text" class="form-control" id="note" name="note" placeholder="Enter notes">
        <span class="text-danger" id="not_error"></span>
    </div>
    <button type="submit" id="addBtn" class="addButton btn btn-block" style="background: #2E9A57; color: white"><i class="fa fa-save"></i>&nbsp; Save</button>
</form>

<script>

    $(document).on('click','#addBtn',function (event) {
        event.preventDefault();
        var form = $('#scanner-form')[0];
        var formData = new FormData(form);

        // Set header if need any otherwise remove setup part
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            }
        });
        $.ajax({
            url: "{{route('scanner-store')}}",// your request url
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                toastr.options ={ "closeButton" : true, "progressBar" : true }
                toastr.success("Scanner created successfully");

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


