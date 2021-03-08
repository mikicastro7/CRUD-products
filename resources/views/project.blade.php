@include('head')
<body>
    <div class="container">
        <h1 class="text-center p-3">Products project</h1>
        <main>
            <form id="add-product">
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
                    <tr id={{$product->id}}>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->updated_at}}</td>
                        <td>
                            <button type="button" class="delete-btn btn btn-danger"><i class="fas fa-trash"></i></button>
                            <button type="button" class="edit-btn btn btn-warning" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add-product">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="name-modal">Name</label>
                                    <input id="name-modal" type="text" class="form-control" placeholder="Product name">
                                </div>
                                <div class="form-group col-12">
                                    <label for="price-modal">Price</label>
                                    <input id="price-modal" type="number" class="form-control" placeholder="Product price">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description-modal">Description</label>
                                <textarea id="description-modal" class="form-control" rows="3"
                                    placeholder="description"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="edit-product-btn btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
