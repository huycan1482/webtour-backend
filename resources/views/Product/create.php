<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2>Insert Product Form</h2>

        <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger">
                <p><?php echo $errorMsg; ?></p>
            </div>
        <?php endif; ?>

        <form action="#" method="POST">
            <div class="form-group">
                <label for="text">Name:</label>
                <input value="" type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                <span id="errorName" style="font-size: 14px; color: red;"></span>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Image: </label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="stock">Stock: </label>
                <input type="number" class="form-control" id="stock" placeholder="Enter stock" name="stock" min=0>
                <span id="errorStock" style="font-size: 14px; color: red;"></span>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="is_active" id="is_active"> Is Active</label>
            </div>
            <button type="submit" id="btnCreate" class="btn btn-default" name="btnCreate">Create</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        var name = $('#name').val(); //set gia tri cho #name val('Dev Master')
        console.log('Tên ' + name);

        $('#btnCreate').click(function() {
            var flag = true;
            var name = $('#name').val();
            var stock = $('#stock').val();

            if (name == '') {
                $('#errorName').text('Tên không được để trống');
                flag = false;
            } else if (name != '') {
                $('#errorName').text(''); 
            }

            if (stock == ''){
                $('#errorStock').text('Không để trống số lượng');
                flag = false;
            } else if (isNaN(stock) || stock <= 0) {
                $('#errorStock').text('Sai định dạng số');
                flag = false;
            } else if (stock != '') {
                $('#errorStock').text('');
            }

            if(!flag) {
                // event.preventDefault();
                return false;
            }
        });
    });
    </script>

</body>
</html>
