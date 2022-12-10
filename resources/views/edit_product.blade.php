<h1>Edit Product</h1>
<div class="row">
    <div class="col-6">
        <br>
        <div class="general_err"></div>
        <form method="post" id="add_product_form">
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="{{$product->product_name}}" required>
                <div class="product_name_err"></div>
            </div>
            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="number" step=".02" class="form-control" id="product_price" name="product_price" value="{{$product->product_price}}"
                    required>
                <div class="product_price_err"></div>
            </div>
            <div class="mb-3">
                <label for="product_desccription" class="form-label">Product Description</label><br>
                <textarea name="product_desccription" id="product_desccription" class="form-control" rows="3" required>{{$product->product_desccription}}</textarea>
                <div class="product_desccription_err"></div>
            </div>
            <div class="mb-3">
                <label for="product_images" class="form-label">Images</label>
                <input type="file" class="form-control" id="product_images" name="product_images[]" multiple>
                <div class="product_images_err"></div>
            </div>
            <input type="submit" class="btn btn-primary submit_btn" value="Submit">
        </form>
        <br>
        <button class="btn btn-danger" onclick="cancel_edit()">Cancel</button>
    </div>
</div>
