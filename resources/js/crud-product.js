let productId = 0;

$('.edit-product-btn').on('click', function (e) {
    const name = $('#name-modal').val();
    const description = $('#description-modal').val();
    const price = $('#price-modal').val();

    $.ajax({
        method: "PUT",
        url: "/product_edit/" + productId,
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            name,
            description,
            price
        }
    }).fail(function (response) {
        let errors = "";
        for (const key in response.responseJSON.errors) {
            errors += response.responseJSON.errors[key] + " ";
        };
        toastr.error(errors);
    }).done(function (response) {
        toastr.success(response.message);
        $("#editModal").modal('hide');

        const formatedObject = formatObject(response.product)
        $("table #" + productId).children().eq(1).text(response.product.name);
        $("table #" + productId).children().eq(2).text(response.product.description);
        $("table #" + productId).children().eq(3).text(parseInt(response.product.price).toFixed(4));
        $("table #" + productId).children().eq(5).text(response.product.updated_at.split("T").join(" ").slice(0, 19));
    })
})

const formatObject = function (productObject) {
    const objectFormated = {
        id: productObject.id,
        name: productObject.name,
        description: productObject.description === null ? "" : productObject.description,
        price: parseInt(productObject.price).toFixed(4),
        created_at: productObject.created_at.split("T").join(" ").slice(0, 19),
        updated_at: productObject.updated_at.split("T").join(" ").slice(0, 19)
    }
    return objectFormated;
}

$('.delete-btn').on('click', function (e) {
    let productId = $(this).parent().parent().get(0).id;

    $.ajax({
        method: "DELETE",
        url: "/product_delete/" + productId,
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
        }
    }).fail(function (response) {
        let errors = "";
        for (const key in response.responseJSON.errors) {
            errors += response.responseJSON.errors[key] + " ";
        }
        toastr.error(errors);
    }).done(function (response) {
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
    }).fail(function (response) {
        let errors = "";
        for (const key in response.responseJSON.errors) {
            errors += response.responseJSON.errors[key] + " ";
        };
        toastr.error(errors);
    }).done(function (response) {
        toastr.success(response.message);
        const addRow = $("<tr id=" + response.product.id + "></tr>");
        const formatedObject = {
            id: response.product.id,
            name: response.product.name,
            description: response.product.description === null ? "" : response.product.description,
            price: parseInt(response.product.price).toFixed(4),
            created_at: response.product.created_at.split("T").join(" ").slice(0, 19),
            updated_at: response.product.updated_at.split("T").join(" ").slice(0, 19)
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

$('table').delegate('.edit-btn', 'click', function (e) {
    productId = $(this).parent().parent().get(0).id
    const name = $(this).parent().siblings().eq(1).text();
    const description = $(this).parent().siblings().eq(2).text();
    const price = $(this).parent().siblings().eq(3).text();

    $("#name-modal").val(name);
    $("#description-modal").val(description);
    $("#price-modal").val(price);
})
