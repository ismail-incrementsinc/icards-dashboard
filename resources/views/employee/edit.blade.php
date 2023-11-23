<form id="edit-form">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Employee name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$employee->name}}">
        <span class="text-danger" id="name_error"></span>
    </div>
    <div class="form-group">
        <label for="designation">Designation</label>
        <input type="text" class="form-control" id="designation" name="designation" value="{{$employee->info->designation}}">
        <span class="text-danger" id="designation_error"></span>
    </div>
    <div class="form-group">
        <label for="company">Company</label>
        <input type="text" class="form-control" id="company" name="company" value="{{$employee->info->company}}">
        <span class="text-danger" id="company_error"></span>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{$employee->email}}">
        <span class="text-danger" id="email_error"></span>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{$employee->info->phone}}">
        <span class="text-danger" id="phone_error"></span>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="{{$employee->info->address}}">
        <span class="text-danger" id="address_error"></span>
    </div>
    <div class="form-group">
        <label for="dob">Date of birth</label>
        <input type="date" class="form-control" id="dob" name="dob" value="{{$employee->info->dob}}">
        <span class="text-danger" id="dob_error"></span>
    </div>
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="form-group">
                <div class="upload-photo">
                    <div style="border-bottom: 1px solid #ddd">
                        <span style="color: #000; font-weight: 700">Upload employee photo</span>
                        <label for="image" class="d-flex "> <span class="mr-auto"></span>  <i class="fa-solid fa-arrow-up-from-bracket"></i> </label>
                        <input type="file"  class="mt-2 d-none" id="image" accept=".jpg,.jpeg,.png">
                    </div>
                    <span class="text-danger" id="image_error"></span>
                    <br>
                    @if(isset($employee->image))
                        <img id="imagePreview"  class="img-thumbnail" src="{{$employee->image}}"  alt="technology_icon" />
                    @else
                        <img id="imagePreview" style="display: none" class="img-thumbnail" src=""  alt="technology_icon" />
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-check form-check-inline" style="margin-bottom: 20px;">
        <input class="form-check-input" {{$employee->is_sub_admin ? 'checked' : ''}} type="checkbox" name="is_sub_admin" id="is_sub_admin" value="true">
        <label class="form-check-label" for="is_sub_admin">Set as sub-admin</label>
    </div>
    <button type="submit" id="updateBtn" class="addButton btn btn-block" style="background: #2E9A57; color: white"><i class="fa fa-save"></i>&nbsp; Update</button>
</form>

<script>
    let photo;
    $('#image').on('change',function(e){
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onloadend =() =>{
            photo = reader.result;
            $('#imagePreview').attr('src',photo);
            document.getElementById("imagePreview").style.display = "block";
        }
        reader.readAsDataURL(file);
    });

    $(document).on('click','#updateBtn',function (event) {
        event.preventDefault();
        var form = $('#edit-form')[0];
        var formData = new FormData(form);
        formData.append('image',photo)

        // Set header if need any otherwise remove setup part
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('employee.update',$employee->info->id)}}",// your request url
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                toastr.options ={ "closeButton" : true, "progressBar" : true }
                toastr.success("Employee Updated successfully");

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


