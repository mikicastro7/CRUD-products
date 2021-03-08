<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
