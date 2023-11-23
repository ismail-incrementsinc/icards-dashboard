
<form id="edit-form">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value={{$assign_users->name}}>
        <span class="text-danger" id="name_error"></span>
    </div>
    <div class="form-group">
        <label for="organization">Organization</label>
        <input type="text" class="form-control" id="organization" name="organization" value={{$assign_users->user_information->company}}>
        <span class="text-danger" id="organization_error"></span>
    </div>
    <div class="form-group">
        <label for="note">Note</label>
        <input type="text" class="form-control" id="note" name="note" value={{$assign_users->note}}>
        <span class="text-danger" id="not_error"></span>
    </div>
    <button type="submit" id="updateBtn" class="addButton btn btn-block" style="background: #2E9A57; color: white"><i class="fa fa-save"></i>&nbsp; Update</button>
</form>

<script>

    $(document).on('click','#updateBtn',function (event) {
        event.preventDefault();
        var form = $('#edit-form')[0];
        var formData = new FormData(form);

        // Set header if need any otherwise remove setup part
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('scanner-update',$assign_users->user_information->id)}}",// your request url
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                toastr.options ={ "closeButton" : true, "progressBar" : true }
                toastr.success("Scanner Updated successfully");

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


