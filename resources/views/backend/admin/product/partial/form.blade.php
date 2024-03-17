<div class="row">

                        <div class="col-md-6 d-flex mb-3">
                        <label for="name" class="col-2 text-left col-form-label">Name:</label>
                        <input type="text" value="{{old("name")}}" name="name" class="form-control  col-10  name {{$errors->has("name")?"is-invalid":""}}" id="name" placeholder="Name">
                        </div>
                        <div class="col-md-6 d-flex mb-3">
                        <label for="description" class="col-2 text-left col-form-label">Description:</label>
                        <textarea name="description" class="form-control col-10 {{$errors->has("description")?"is-invalid":""}}" rows="1" id="description" placeholder="Description">{{old("description")}}</textarea>
                        </div>
                        <div class="col-md-6 d-flex mb-3">
                        <label for="price" class="col-2 text-left col-form-label">Price:</label>
                        <input type="number"  value="{{old("price")}}" name="price" class="form-control  col-10  {{$errors->has("name")?"is-invalid":""}}" id="price" placeholder="Price" step="any">
                        </div>
                        <div class="col-md-6 d-flex mb-3">
                        <label for="stock_quantity" class="col-2 text-left col-form-label">Stock Quantity:</label>
                        <input type="number"  value="{{old("stock_quantity")}}" name="stock_quantity" class="form-control  col-10  {{$errors->has("name")?"is-invalid":""}}" id="stock_quantity" placeholder="Stock Quantity" step="any">
                        </div>
                        <div class="col-md-6 d-flex mb-3">
                        <label for="category_id" class="col-2 text-left col-form-label">Category:</label>

                        <select name="category_id" id="category_id"  class="form-control  col-10 {{$errors->has("name")?"is-invalid":""}}">
                          <option value="" selected>Select Category</option>
                            <option value="1" >Cat 1</option>
                        </select>

                        </div>
                        <div class="col-md-6 d-flex mb-3">
                        <label for="image" class="col-2 text-left col-form-label">Image:</label>
                        <input  type="file" name="image" id="image formFileMultiple"  class=" col-10  {{$errors->has("name")?"is-invalid":""}}" multiple>
                        </div>
                        <div class="col-md-6 d-flex mb-3">
                        <label for="status" class="col-2 text-left col-form-label">Status:</label>
                        <input type="checkbox" name="status" class="form-control  col-10  status" id="status"
                             data-toggle="toggle"
                             data-on="active" data-off="inactive" {{old("status")=="on"?"checked":""}} data-onstyle="primary" data-offstyle="danger">
                        </div>
</div>
@include("backend.admin.includes.form_footer",['type'=>'create'])
