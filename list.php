<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Street List</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h1 class="text-center pt-2">STREET LIST</h1>
    <div class=" float-right mt-3 mb-3 mr-5 col-7">
        <div>
            <div class="form-row">
                <div class="col-4 mr-3">
                    <label for="name" class="form-row"><b>Name:</b>
                        <input type="text" name="nameSearch" class="form-control" placeholder="Name">
                    </label>
                </div>
                <div class="col-4">
                    <label for="district" class="form-row"><b>District:</b>
                        <select name="districtSearch" id="district" class="form-control">
                        </select>
                    </label>
                </div>
                <div class="col-2 mt-4 ml-3">
                    <input type="button" class="btn btn-secondary col-12 form-row" value="Search" id="search">
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered" id="table">
        <thead class="thead-dark text-center">
        <tr>
            <th scope="col" class="col-1">Name</th>
            <th scope="col">District</th>
            <th scope="col" class="col-2">Founding</th>
            <th scope="col" class="col-5">Description</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody id="list">

        </tbody>
    </table>
    <div class="text-center mb-4">
        <a href="form.php">
            <button class="btn btn-primary col-2">Add Street</button>
        </a>
        <a href="list.php">
            <button class="btn btn-info col-2">Refresh</button>
        </a>
    </div>
</div>
</body>
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        function loadData() {
            $.ajax({
                url: 'http://localhost/assignment/API/getStreets.php',
                method: 'GET',
                success: function (data) {
                    let streets = JSON.parse(data);
                    let contentHTML = '';
                    if (streets == "No Result Found!") {
                        contentHTML += `<tr><td class="text-center" colspan="5"><h4>No Result Found!</h4></td></tr>`
                    } else {
                        streets.forEach(element => {
                            contentHTML += `<tr><td class="text-center">${element.name}</td>
                                        <td class="text-center">${element.district}</td>
                                        <td class="text-center">${element.founding}</td>
                                        <td>${element.description}</td>
                                        <td class="text-center">${element.status}</td></tr>`;
                        });
                    }
                    $('#list').html(contentHTML);
                },
                error: function () {
                    alert('Must Handle error!');
                }
            });
        }

        loadData();
        $('#form').submit(function () {
            loadData();
        })
    });
</script>
<script>
    $(document).ready(function () {
        $.ajax({
            url: 'http://localhost/assignment/API/getDistricts.php',
            method: 'GET',
            success: function (data) {
                let streets = JSON.parse(data);
                let contentHTML = '<option>All Districts</option>';
                streets.forEach(element => {
                    contentHTML += `<option>${element.name}</option>`
                });
                $('#district').html(contentHTML);
            },
            error: function () {
                alert('Must Handle error!');
            }
        });
    })
</script>
<script>
    $('#search').click(function () {
        $('#list').html('');
        const inputName = $('input[name=nameSearch]');
        const inputDistrict = $('select[name=districtSearch]');
        let data = {
            nameSearch: inputName.val(),
            districtSearch: inputDistrict.val()
        }
        $.ajax({
            url: 'http://localhost/assignment/API/searchStreets.php',
            method: 'POST',
            data: JSON.stringify(data),
            success: function (data) {
                let streets = JSON.parse(data);
                let contentHTML = '';
                if (streets.length > 0) {
                    streets.forEach(element => {
                        contentHTML += `<tr><td class="text-center">${element.name}</td>
                                        <td class="text-center">${element.district}</td>
                                        <td class="text-center">${element.founding}</td>
                                        <td>${element.description}</td>
                                        <td class="text-center">${element.status}</td></tr>`
                    });
                } else {
                    contentHTML += `<tr><td class="text-center" colspan="5"><h4>No Result Found</h4></td></tr>`
                }
                $('#list').html(contentHTML);
            },
            error: function () {
                alert("Must handle error.");
            }
        });
    });
</script>
</html>