<form id="create-form">
    @csrf
    <div class="form-group">
        <label for="name">Coupon name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter coupon name">
        <span class="text-danger" id="name_error"></span>
    </div>
    <div class="form-group">
        <label for="item">Item name</label>
        <input type="text" class="form-control" id="item" name="item" placeholder="Enter item name">
        <span class="text-danger" id="item_error"></span>
    </div>
    <div class="form-group">
        <label for="quantity">Item Quantity</label>
        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter item quantity">
        <span class="text-danger" id="quantity_error"></span>
    </div>
    <div class="form-group">
        <label for="coupon_quantity">Coupon Quantity</label>
        <input type="text" class="form-control" id="coupon_quantity" name="coupon_quantity" placeholder="Enter coupon quantity">
        <span class="text-danger" id="coupon_quantity_error"></span>
    </div>
    <div class="form-group">
        <label for="category">Coupon Category</label>
        <select name="category" id="category" class="form-control">
            <option value="">Select category</option>
            <option value="VIP">VIP</option>
            <option value="ORGANIZATION">ORGANIZATION</option>
            <option value="MANAGER">MANAGER</option>
            <option value="REGULAR">REGULAR</option>
        </select>
        <span class="text-danger" id="category_error"></span>
    </div>
    <div class="form-group">
        <label for="size">Item size</label>
        <input type="text" class="form-control" id="size" name="size" placeholder="Enter item size">
        <span class="text-danger" id="size_error"></span>
    </div>
    <div class="form-group">
        <label for="start_date">Pick starting date</label>
        <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Enter start date">
        <span class="text-danger" id="start_date_error"></span>
    </div>
    <div class="form-group">
        <label for="end_date">Pick end date</label>
        <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Enter end date">
        <span class="text-danger" id="end_date_error"></span>
    </div>
    <div class="form-group">
        <label for="start_time">Start time</label>
        <input type="time" class="form-control" id="start_time" name="start_time">
        <span class="text-danger" id="start_time_error"></span>
    </div>
    <div class="form-group">
        <label for="end_time">End time</label>
        <input type="time" class="form-control" id="end_time" name="end_time">
        <span class="text-danger" id="end_time_error"></span>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
        <span class="text-danger" id="description_error"></span>
    </div>
    <div class="form-group">
        <label for="notes">Notes</label>
        <input type="text" class="form-control" id="notes" name="notes" placeholder="Enter notes">
        <span class="text-danger" id="notes_error"></span>
    </div>
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="form-group">
                <div class="upload-photo">
                    <div style="border-bottom: 1px solid #ddd">
                        <span style="color: #000; font-weight: 700">Upload employee photo</span>
                        <label for="logo" class="d-flex "> <span class="mr-auto"></span>  <i class="fa-solid fa-arrow-up-from-bracket"></i> </label>
                        <input type="file"  class="mt-2 d-none" id="logo" accept=".jpg,.jpeg,.png">
                    </div>
                    <span class="text-danger" id="logo_error"></span>
                    <br>
                    <img id="imagePreview" style="display: none" class="img-thumbnail" src=""  alt="technology_icon" />
                </div>
            </div>
        </div>
    </div>
    <button type="submit" id="addBtn" class="addButton btn btn-block" style="background: #2E9A57; color: white"><i class="fa fa-save"></i>&nbsp; Save</button>
</form>

<script>
    let photo;
    $('#logo').on('change',function(e){
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onloadend =() =>{
            photo = reader.result;
            $('#imagePreview').attr('src',photo);
            document.getElementById("imagePreview").style.display = "block";
        }
        reader.readAsDataURL(file);
    });

    $(document).on('click','#addBtn',function (event) {
        event.preventDefault();
        var form = $('#create-form')[0];
        var formData = new FormData(form);
        formData.append('logo',photo)

        // Set header if need any otherwise remove setup part
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            }
        });
        $.ajax({
            url: "{{route('coupon.store')}}",// your request url
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                toastr.options ={ "closeButton" : true, "progressBar" : true }
                toastr.success("Coupon created successfully");

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


