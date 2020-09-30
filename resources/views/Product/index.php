<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <h2>List Products</h2>
        <a href="http://localhost:8080/mvc/?controller=product&action=create" class="btn btn-primary">Add Products</a>
        <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($data)):
                    foreach ($data as $key => $val): ?>
                <tr>
                    <td><?= $val['id']; ?></td>
                    <td><?= $val['name']; ?></td>
                    <td>
                        <button data-id="<?= $val['id']; ?>" type="button"
                            class="btn btn-outline-primary btnUpdate">Sửa</button>
                        <button data-id="<?= $val['id']; ?>" type="button"
                            class="btn btn-outline-danger btnDel">Xóa</button>
                    </td>
                </tr>
                <?php endforeach; endif;?>

            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('.btnDel').click(function() {
            let position = $(this); 

            var id_product = $(this).attr('data-id'); // lay gia tri cua thuoc tinh attr()
            // alert(id_product);
            //Tao ra 1 request ngam
            $result = confirm("Bạn có muốn xóa sản phẩm có mã " + id_product);

            if ($result) {
                $.ajax({
                    method: "GET",
                    url: "http://localhost:8080/mvc/?controller=product&action=delete",
                    data: {
                        id: id_product
                    },

                    dataType : 'json',

                    success: function(response) {

                        alert(response);

                        let objData = response;

                        if ( objData.status != undefined && objData.status == 1) {
                            // console.log(response);
                            position.closest('tr').remove();
                        }
                        
                    }
                });

                // location.reload();

            } else {
                alert('Hủy xóa thành công');
            }
        });
    });
    </script>
</body>

</html>