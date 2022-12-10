<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <!-- As a link -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Shopping</a>
        </div>
    </nav>

    <div class="container">
        <div class="product_list_block">
            <h1>Products</h1>
            <a href="javascript:" class="btn btn-primary add_product_btn">Add Product</a>
            <div class="row">
                <div class="col-12 prod_list">

                </div>
            </div>
        </div>

        <div class="add_product_block">
            <h1>Add Product</h1>
            <div class="row">
                <div class="col-6">
                    <br>
                    <div class="general_err"></div>
                    <form method="post" id="add_product_form">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                            <div class="product_name_err"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="number" step=".02" class="form-control" id="product_price"
                                name="product_price" required>
                            <div class="product_price_err"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_desccription" class="form-label">Product Description</label><br>
                            <textarea name="product_desccription" id="product_desccription" class="form-control" rows="3" required></textarea>
                            <div class="product_desccription_err"></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_images" class="form-label">Images</label>
                            <input type="file" class="form-control" id="product_images" name="product_images[]"
                                multiple required>
                            <div class="product_images_err"></div>
                        </div>
                        <button type="submit" class="btn btn-primary submit_btn">Submit</button>
                        <a class="btn btn-danger cancel_btn">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

        <div class="edit_product_block">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        loadProducts();

        $(".product_list_block").show();
        $(".add_product_block").hide();

        $(".add_product_btn").click(function() {
            $(".product_list_block").hide();
            $(".add_product_block").show();
        });

        $(".cancel_btn").click(function() {
            $(".product_list_block").show();
            $(".add_product_block").hide();
        });

        function loadProducts(){
            $.ajax({
                url: "{{ url('get_products') }}",
                type: 'GET',
                success: function(data) {
                    $(".prod_list").html(data.html);
                }
            });
        }

        $("#add_product_form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ url('save_product') }}",
                type:'POST',
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.status == false){
                        let errors = data.errors;
                        if (typeof errors.product_name !== 'undefined') {
                            $(".product_name_err").html('<div class="alert alert-danger" role="alert">'+errors.product_name[0]+'</div>');
                        }
                        if (typeof errors.product_price !== 'undefined') {
                            $(".product_price_err").html('<div class="alert alert-danger" role="alert">'+errors.product_price[0]+'</div>');
                        }
                        if (typeof errors.product_desccription !== 'undefined') {
                            $(".product_desccription_err").html('<div class="alert alert-danger" role="alert">'+errors.product_desccription[0]+'</div>');
                        }
                        if (typeof errors.product_images !== 'undefined') {
                            $(".product_images_err").html('<div class="alert alert-danger" role="alert">'+errors.product_images[0]+'</div>');
                        }
                        if (typeof errors.general !== 'undefined') {
                            $(".general_err").html('<div class="alert alert-danger" role="alert">'+errors.general+'</div>');
                        }
                    }
                    else{
                        $("#product_name").val('');
                        $("#product_price").val('');
                        $("#product_desccription").val('');
                        $("#product_images").val('');
                        $(".product_list_block").show();
                        $(".add_product_block").hide();
                        loadProducts();
                    }
                }
            });
        });

        function deleteProduct(product_id){
            $.ajax({
                url: "{{ url('delete_product') }}"+"/"+product_id,
                type: 'DELETE',
                data: {_token:'{{csrf_token()}}'},
                success: function(data) {
                    $(".product_list_block").show();
                    $(".add_product_block").hide();
                    loadProducts();
                }
            });
        }

        function editProduct(product_id){
            $.ajax({
                url: "{{ url('edit_product') }}"+"/"+product_id,
                type: 'GET',
                success: function(data) {
                    $(".product_list_block").hide();
                    $(".add_product_block").hide();
                    $(".edit_product_block").show();
                    $(".edit_product_block").html(data.html);
                }
            });
        }

        function cancel_edit(){
            $(".product_list_block").show();
            $(".add_product_block").hide();
            $(".edit_product_block").hide();
            loadProducts();
        }
    </script>
</body>

</html>
