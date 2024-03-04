<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Create product</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>
                {{$error}}
            </li>
            @endforeach
        </ul>
        @endif
    </div>
    <form method="post" action="{{ route('products.store') }}">
        @csrf
        @method('post')
        <div>
            <label>Product Name :</label>
            <input type="text" name="product_name" placeholder="product name" /> <br>
            <label>Product Type:</label>
            <input type="text" name="product_type" placeholder="product type" /> <br>
            <label>Product Brand:</label>
            <input type="text" name="product_brand" placeholder="product brand" /> <br>
            <label>Product Price:</label>
            <input type="text" name="product_price" placeholder="product price" /> <br>
            <label>Product ingredient:</label>
            <input type="text" name="product_ingredient" placeholder="product ingredient" /> <br>
            <label>Product Stock:</label>
            <input type="number" name="product_stock" placeholder="product stock" /> <br>
            <input type="submit" value="Save Product">
        </div>
    </form>
</body>

</html>