@include('head')
<body>
    <div class="container">
        <h1 class="text-center p-3">Products project</h1>
        <main>
            <form action="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control" placeholder="Product name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price">Price</label>
                        <input id="price" type="number" class="form-control" placeholder="Product price">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" rows="1" placeholder="description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </form>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->updated_at}}</td>
                        <td>
                            <button type="button" class="btn btn-warning"><i class="fas fa-trash"></i></button>
                            <button type="button" class="btn btn-danger"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </main>
    </div>
</body>

<script>
</script>
