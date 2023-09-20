<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <!-- Подключаем Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Create a Reservation</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('reservations.store') }}" method="POST" id="reservationForm">
                        @csrf

                        <div class="form-group">
                            <label for="make">Select make: </label>
                            <select name="make" id="make" class="form-control" required>
                                <option> Select make </option>
                                @foreach ($makes as $make)
                                <option value="{{ $make->id }}">{{ $make->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="model">Select model:</label>
                            <select name="model" id="model" class="form-control" disabled required></select>
                        </div>

                        <div class="form-group">
                            <label for="color">Select color:</label>
                            <select name="color" id="color" class="form-control" disabled required></select>
                        </div>

                        <div class="form-group">
                            <label for="full_name">Full name:</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" disabled required>
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">End date:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Подключаем Bootstrap JS и зависимости -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<script>
   $(document).ready(function() {

$('#make').on('change', function() {
    const make = $(this).val();
    fetchOptions(`/models/${make}`, '#model', 'Select model');
});

$('#model').on('change', function() {
    const make = $('#make').val();
    const model = $(this).val();
    fetchOptions(`/colors/${make}/${model}`, '#color', 'Select color');
});

$('#color').on('change', function() {
    toggleDisabledBasedOnValue($(this), '#full_name');
});

$('#full_name').on('input', function() {
    toggleDisabledBasedOnValue($(this), '#start_date, #end_date');
});

$('#reservationForm').on('submit', function(event) {
    const startDate = new Date($('#start_date').val());
    const endDate = new Date($('#end_date').val());

    if (endDate < startDate) {
        alert('End date cannot be before start date!');
        event.preventDefault();
    }
});

function fetchOptions(url, targetSelector, defaultOption) {
    $.get(url, function(data) {
        const key = Object.keys(data)[0];
        const $target = $(targetSelector);
        $target.empty().append(`<option value="">${defaultOption}</option>`);

        if (Array.isArray(data[key]) && data[key].length) {
            $target.prop('disabled', false);
            data[key].forEach(item => {
                $target.append(`<option value="${item}">${item}</option>`);
            });
        } else {
            $target.prop('disabled', true);
        }
    });
}

function toggleDisabledBasedOnValue($source, targetSelector) {
    if ($source.val()) {
        $(targetSelector).prop('disabled', false);
    } else {
        $(targetSelector).prop('disabled', true);
    }
}
});

</script>