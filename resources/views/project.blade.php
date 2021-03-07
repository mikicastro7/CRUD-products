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
    $("#add-product button").on("click", function (e) {
        e.preventDefault();
        const name = $('#name').val();
        const description = $('#description').val();
        const price = $('#price').val();
        $.ajax({
                method: "POST",
                url: "/",
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    name,
                    description,
                    price
                }
            }).fail(function (response){
                let errors = "";
                for (const key in response.responseJSON.errors) {
                    errors += response.responseJSON.errors[key] + " "
                }
                toastr.error(errors);
            }).done(function (response) {
                toastr.success(response.message)
                const addRow = $("<tr></tr>");
                const formatedObject = {
                    id : response.product.id,
                    name : response.product.name,
                    description : response.product.description === null ? "" : response.product.description,
                    price : parseInt(response.product.price).toFixed(4),
                    created_at : response.product.created_at.split("T").join(" ").slice(0,19),
                    updated_at : response.product.updated_at.split("T").join(" ").slice(0,19)
                }
                for (const key in formatedObject) {
                    addRow.append("<td>" + formatedObject[key] + "</td>");
                }
                addRow.append('<td><button type="button" class="btn btn-warning"><i class="fas fa-trash"></i></button><button type="button" class="btn btn-danger"><i class="fas fa-edit"></i></button></td>')
                $("tbody").append(addRow);

                $('#name').val("");
                $('#description').val("");
                $('#price').val("");
            })
    });
</script>
