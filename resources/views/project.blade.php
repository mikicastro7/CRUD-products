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
                        <button type="button" class="edit-product-button btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

<script>


    $('.delete-btn').on('click', function(e){
        let productId = $(this).parent().parent().get(0).id;

        $.ajax({
            method: "DELETE",
            url: "/product_delete/" + productId,
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
            }
        }).fail(function (response){
            let errors = "";
            for (const key in response.responseJSON.errors) {
                errors += response.responseJSON.errors[key] + " ";
            }
            toastr.error(errors);
        }).done(function (response){
            toastr.success(response.message);
            $(".table #" + productId).remove();
        })
    });

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
                errors += response.responseJSON.errors[key] + " ";
            };
            toastr.error(errors);
        }).done(function (response) {
            toastr.success(response.message);
            const addRow = $("<tr id=" + response.product.id + "></tr>");
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
            addRow.append('<td><button type="button" class="delete-btn btn btn-danger"><i class="fas fa-trash"></i></button> <button type="button" class="edit-btn btn btn-warning" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button></td>');
            $("tbody").append(addRow);

            $('#name').val("");
            $('#description').val("");
            $('#price').val("");
        })
    });

    $('table').delegate('.edit-btn', 'click', function(e){
        const name = $(this).parent().siblings().eq(1).text();
        const description = $(this).parent().siblings().eq(2).text();
        const price =  $(this).parent().siblings().eq(3).text();

        $("#name-modal").val(name);
        $("#description-modal").val(description);
        $("#price-modal").val(price);
    })
</script>
