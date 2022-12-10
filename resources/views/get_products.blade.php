<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $index=>$product)
            <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$product->product_name}}</td>
                <td>{{$product->product_price}}</td>
                <td>{{$product->product_desccription}}</td>
                <td><a href="javascript:" onclick="editProduct('{{$product->id}}')">Edit</a> <a href="javascript:" onclick="deleteProduct('{{$product->id}}')">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
