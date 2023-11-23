<form id="create-form" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="form-group">
                <div class="upload-photo">
                    <div style="border-bottom: 1px solid #ddd">
                        <span style="color: #000; font-weight: 700">Upload excel file</span>
                        <label for="file" class="d-flex "> <span class="mr-auto"></span>  <i class="fa-solid fa-arrow-up-from-bracket"></i> </label>
                        <input type="file"  class="mt-2 d-none" id="file" accept=".xls,.xlsx">
                    </div>
                    <span class="text-danger" id="image_error"></span>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" id="addBtn" class="addButton btn btn-block" style="background: #2E9A57; color: white"><i class="fa fa-save"></i>&nbsp; Upload</button>
</form>

<script>
    let excelFile;
    $('#file').on('change',function(e){
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onloadend =() =>{
            excelFile = reader.result;
            console.log(excelFile);
        }
        reader.readAsDataURL(file);
    });

    $(document).on('click','#addBtn',function (event) {
        event.preventDefault();
        var form = $('#create-form')[0];
        var formData = new FormData(form);
        formData.append('xlsx_file',excelFile)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('employee.upload')}}",// your request url
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                toastr.options ={ "closeButton" : true, "progressBar" : true }
                toastr.success("File uploaded successfully");

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


