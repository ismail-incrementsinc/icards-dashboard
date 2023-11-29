<form id="edit-form">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$assign_users->name}}">
        <span class="text-danger" id="name_error"></span>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{$assign_users->email}}">
        <span class="text-danger" id="email_error"></span>
    </div>
    <div class="form-group">
        <label for="organization">Organization</label>
        <input type="text" class="form-control" id="organization" name="organization" value="{{$assign_users->organization}}">
        <span class="text-danger" id="organization_error"></span>
    </div>
    <div class="form-group">
        <label for="collected_by">Collected By</label>
        <select class="form-control" name="collected_by" id="collected_by" onChange="CollectedUser()">
            <option value="">Select one</option>
            <option value="SELF" {{$assign_users->collected_by == 'SELF' ? 'selected' : ''}}>Self</option>
            <option value="OTHERS" {{$assign_users->collected_by == 'OTHERS' ? 'selected' : ''}}>Other</option>
        </select>
        <span class="text-danger" id="collected_by_error"></span>
    </div>
    <div class="form-group" id="assign_to">
        <label for="assign_to">Assigned To</label>
        <select class="form-control" name="assign_to" id="assign_to">
            <option value="">Select user</option>
            @foreach($users as $user)
                <option {{optional($assign_users->assign_to)->id == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        <span class="text-danger" id="assign_to_error"></span>
    </div>
    <div class="form-group">
        <label for="category">Coupon Type</label>
        <select class="form-control" name="category" id="category">
            <option value="">Select one</option>
            @forelse($categories as $category)
            <option value="{{$category->id}}" {{$assign_users->category->id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
            @empty
                <option value="" >No category</option>
            @endforelse
        </select>
        <span class="text-danger" id="category_error"></span>
    </div>
    <div class="form-group">
        <label for="number_of_coupon">Number of coupon</label>
        <input type="text" class="form-control" id="number_of_coupon" name="number_of_coupon" value="{{$assign_users->number_of_coupon}}">
        <span class="text-danger" id="number_of_coupon_error"></span>
    </div>
    <div class="form-group">
        <label for="note">Note</label>
        <input type="text" class="form-control" id="note" name="note" value="{{$assign_users->note}}">
        <span class="text-danger" id="note_error"></span>
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
            url: "{{route('coupon-assign.update',$assign_users->id)}}",// your request url
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                toastr.options ={ "closeButton" : true, "progressBar" : true }
                toastr.success("Assign coupon Updated successfully");

                setTimeout(function() {
                    location.reload();
                }, 2000);
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

    function CollectedUser(){
        let collected_by = document.getElementById('collected_by').value;
        let assigned_to = document.getElementById('assigned_to');
        if(collected_by === 'SELF'){
            assigned_to.style.display = "none";
        }else if(collected_by === 'OTHERS'){
            assigned_to.style.display = "block";
        }
    }

</script>


