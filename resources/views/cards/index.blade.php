@extends('layouts.master')
@section('common-title')
    Cards
@endsection
@section('card')
    menu-open
@endsection
@section('card-item')
    active
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-card-heading">
                                        <h2>Company Card</h2>
                                        <p>Your company card will shown below. Please be sure you enter your right domain in here, so that everyone find & connect with you easily.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-card-heading-button">
                                        <p>Set as default business card</p>
                                    </div>
                                </div>
                            </div>
                            <div class="input-card-body">
                                <form id="create-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="domain">Enter your domain</label>
                                                <input type="text" name="domain" class="form-control" id="domain" aria-describedby="domain" placeholder="Enter your domain">
                                                @error('domain')
                                                <small id="domain_error" class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="front_side">Front side</label>
                                                <input type="file" class="form-control" name="front_side" id="front_side" accept=".jpg,.png" aria-describedby="front_side">

                                                <br>
                                                <img id="front_side_preview" style="display: none" class="img-thumbnail" src=""  alt="technology_icon" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="back_side">Back side</label>
                                                <input type="file" class="form-control" name="back_side" id="back_side" accept=".jpg,.png" aria-describedby="back_side">

                                                <br>
                                                <img id="back_side_preview" style="display: none" class="img-thumbnail" src=""  alt="technology_icon" />
                                            </div>
                                        </div>
                                    </div><!-- /.row -->

                                    <div class="submit-btn">
                                        <button type="submit" id="addCard" class="custom-btn">Save card</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@push('script')
<script>
    let front_side;
    let back_side;
    $('#front_side').on('change',function(e){
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onloadend =() =>{
            front_side = reader.result;
            $('#front_side_preview').attr('src',front_side);
            document.getElementById("front_side_preview").style.display = "block";
        }
        reader.readAsDataURL(file);
    });

    $('#back_side').on('change',function(e){
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onloadend =() =>{
            back_side = reader.result;
            $('#back_side_preview').attr('src',back_side);
            document.getElementById("back_side_preview").style.display = "block";
        }
        reader.readAsDataURL(file);
    });

    $(document).on('click','#addCard',function (event) {
        event.preventDefault();
        let form = $('#create-form')[0];
        let formData = new FormData(form);
        formData.append('front_side',front_side);
        formData.append('back_side',back_side);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            }
        });
        $.ajax({
            url: "{{route('card.store')}}",// your request url
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                toastr.options ={ "closeButton" : true, "progressBar" : true }
                toastr.success("Card created successfully");

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
@endpush
