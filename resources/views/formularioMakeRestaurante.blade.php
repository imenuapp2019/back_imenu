@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action = "{{ action('RestauranteController@create')}}" class="needs-validation" novalidate>
            @csrf
            <div class="form-group">
                    <div class="form-check">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label for="add">Address:</label>
                        <input type="text" class="form-control" id="add" placeholder="Enter address" name="address" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label for="ltt">Latitude:</label>
                        <input type="text" class="form-control" id="ltt" placeholder="Enter latitude" name="latitude" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label for="lgt">Longitude:</label>
                        <input type="text" class="form-control" id="lgt" placeholder="Enter longitude" name="longitude" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label for="pn">Phone number:</label>
                        <input type="text" class="form-control" id="pn" placeholder="Enter Phone number" name="phone_number" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                </div>
                <div class="container">
                    <div class="form-group">
                        <label for="banner">Banner:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" accept=".jpg,.png,.jpeg,.gif" class="custom-file-input" id="banner">
                                <label class="custom-file-label" for="banner">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label for="ft">Food type:</label>
                        <select class="form-control" id="ft" name="tipo_id">
                            <option value="1">Japonesa</option>
                            <option value="2">Chino</option>
                            <option value="3">Italiana</option>
                            <option value="4">Vegana</option>
                            <option value="5">Arabe</option>
                        </select>
                    </div>
                </div>
                <button type="submit" value="submit" class="btn btn-primary">Sent</button>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    debugger
    $(".banner").change(function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

    });
</script>
