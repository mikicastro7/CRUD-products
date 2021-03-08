(()=>{var t=0;$(".edit-product-btn").on("click",(function(a){var r=$("#name-modal").val(),n=$("#description-modal").val(),i=$("#price-modal").val();$.ajax({method:"PUT",url:"/product_edit/"+t,data:{_token:$("meta[name='csrf-token']").attr("content"),name:r,description:n,price:i}}).fail((function(t){var e="";for(var a in t.responseJSON.errors)e+=t.responseJSON.errors[a]+" ";toastr.error(e)})).done((function(a){toastr.success(a.message),$("#editModal").modal("hide");e(a.product);$("table #"+t).children().eq(1).text(a.product.name),$("table #"+t).children().eq(2).text(a.product.description),$("table #"+t).children().eq(3).text(parseInt(a.product.price).toFixed(4)),$("table #"+t).children().eq(5).text(a.product.updated_at.split("T").join(" ").slice(0,19))}))}));var e=function(t){return{id:t.id,name:t.name,description:null===t.description?"":t.description,price:parseInt(t.price).toFixed(4),created_at:t.created_at.split("T").join(" ").slice(0,19),updated_at:t.updated_at.split("T").join(" ").slice(0,19)}};$(".delete-btn").on("click",(function(t){var e=$(this).parent().parent().get(0).id;$.ajax({method:"DELETE",url:"/product_delete/"+e,data:{_token:$("meta[name='csrf-token']").attr("content")}}).fail((function(t){var e="";for(var a in t.responseJSON.errors)e+=t.responseJSON.errors[a]+" ";toastr.error(e)})).done((function(t){toastr.success(t.message),$(".table #"+e).remove()}))})),$("#add-product button").on("click",(function(t){t.preventDefault();var e=$("#name").val(),a=$("#description").val(),r=$("#price").val();$.ajax({method:"POST",url:"/",data:{_token:$("meta[name='csrf-token']").attr("content"),name:e,description:a,price:r}}).fail((function(t){var e="";for(var a in t.responseJSON.errors)e+=t.responseJSON.errors[a]+" ";toastr.error(e)})).done((function(t){toastr.success(t.message);var e=$("<tr id="+t.product.id+"></tr>"),a={id:t.product.id,name:t.product.name,description:null===t.product.description?"":t.product.description,price:parseInt(t.product.price).toFixed(4),created_at:t.product.created_at.split("T").join(" ").slice(0,19),updated_at:t.product.updated_at.split("T").join(" ").slice(0,19)};for(var r in a)e.append("<td>"+a[r]+"</td>");e.append('<td><button type="button" class="delete-btn btn btn-danger"><i class="fas fa-trash"></i></button> <button type="button" class="edit-btn btn btn-warning" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button></td>'),$("tbody").append(e),$("#name").val(""),$("#description").val(""),$("#price").val("")}))})),$("table").delegate(".edit-btn","click",(function(e){t=$(this).parent().parent().get(0).id;var a=$(this).parent().siblings().eq(1).text(),r=$(this).parent().siblings().eq(2).text(),n=$(this).parent().siblings().eq(3).text();$("#name-modal").val(a),$("#description-modal").val(r),$("#price-modal").val(n)}))})();
//# sourceMappingURL=crud-product.js.map