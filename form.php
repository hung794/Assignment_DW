<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Add Street</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        form {
            margin-left: 25%;
            margin-right: 25%;
            width: 50%;
        }

        label.error {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center pt-2">ADD STREET</h1>
    <form action="#" method="get" id="form" name="form">
        <div class="form-group">
            <label for="name" class="col-8"><b>Name:</b>
                <input name="name" id="name" type="text" class="form-control">
            </label>
        </div>
        <div class="form-group">
            <label for="district" class="col-6"><b>District:</b>
                <select name="district" id="district" class="form-control">
                </select>
            </label>
        </div>
        <div class="form-group">
            <label for="founding" class="col-5"><b>Founding:</b>
                <input name="founding" id="founding" type="date" class="form-control">
            </label>
        </div>
        <div class="form-group">
            <label for="description" class="col-12"><b>Description:</b>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </label>
        </div>
        <div class="form-group">
            <label for="status" class="col-5"><b>Status:</b>
                <select id="status" name="status" class="form-control">
                    <option>Being Used</option>
                    <option>Under Construction</option>
                    <option>Under Renovation</option>
                </select>
            </label>
        </div>
        <div class="text-center mb-3">
            <button type="submit" class="btn btn-primary col-3">Add</button>
            <a href="list.php">
                <button type="button" class="btn btn-info col-3">Street List</button>
            </a>
        </div>
    </form>
</div>
</body>
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script src="js/validation.js"></script>
<script>
    $(document).ready(function () {
        $("#form").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "name": {
                    required: true
                },
                "founding": {
                    required: true
                },
                "description": {
                    required: true
                },
                "status": {
                    required: true
                }
            },
            submitHandler: function () {
                const inputName = $('input[name=name]');
                const inputDistrict = $('select[name=district]');
                const inputFounding = $('input[name=founding]');
                const inputDescription = $('textarea[name=description]');
                const inputStatus = $('select[name=status]');

                let data = {
                    name: inputName.val(),
                    district: inputDistrict.val(),
                    founding: inputFounding.val(),
                    description: inputDescription.val(),
                    status: inputStatus.val()
                }
                $.ajax({
                    url: "http://localhost/assignment/API/addStreet.php",
                    method: "POST",
                    data: JSON.stringify(data),
                    success: function (response) {
                        alert(response.message)
                    },
                    error: function () {
                        alert("Add street error.");
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        function loadDistricts() {
            $.ajax({
                url: 'http://localhost/assignment/API/getDistricts.php',
                method: 'GET',
                success: function (data) {
                    let streets = JSON.parse(data);
                    let contentHTML = '';
                    streets.forEach(element => {
                        contentHTML += `<option>${element.name}</option>`
                    });
                    $('#district').html(contentHTML);
                },
                error: function () {
                    alert('Add district error!');
                }
            })
        }
        loadDistricts();
    });
</script>
</html>
