<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Product</h1>
    <div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Type</th>
                <th>Product Brand</th>
                <th>Product Price</th>
                <th>Product Ingredient</th>
                <th>Product Stock</th>
                <th>Edit</th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->product_type }}</td>
                <td>{{ $product->product_brand }}</td>
                <td>{{ $product->product_price }}</td>
                <td>{{ $product->product_ingredient }}</td>
                <td>{{ $product->product_stock }}</td>
                <td>
                    <a href="{{route('products.edit', ['product' => $product])}}">Edit</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>