<?php
	require('../src/config.php');
    require('../src/dbconnect.php');
?>

<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

<?php include "includes/admin_sidebar.php"; ?>



<?php

if(isset($_GET["delete"])){
 $del_id = $GET["delete"];
 $sql_query = "DELETE FROM products WHERE id = {$del_id}";
 $delete_id_query = mysqli_query($conn,  $sql_query);
}

?>


    <div id="content-wrapper">
        <div class="container-fluid">
            <h1>Product Management System</h1>
            <hr>

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>


                
            
                    <tr>
                        <td>1</td>
                        <td>Sample Prodcut Title</td>
                        <td>Sample Description</td>
                        <td>Price</td>
                        <td>Stock</td>
                        <td>Image</td>
                      
                       
                        <td>
                            <div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Actions
                                </button>
                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <a class='dropdown-item' data-toggle='modal' data-target='#edit_modal' href='#'>Edit</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' href='#'>Delete</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' data-toggle='modal' data-target='#add_modal'>Add</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <div id="edit_modal" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="product">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" class="form-control" name="id">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Product Title</label>
                                            <input type="text" class="form-control" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" name="description">
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="file" class="form-control" name="price">
                                        </div>
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="text" class="form-control" name="stock">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="text" class="form-control" name="image">
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="id" value="">
                                            <input type="submit" class="btn btn-primary" name="edit_product" value="Edit Product">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
            </table>

            <div id="add_modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="product">
                            <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" class="form-control" name="id">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Product Title</label>
                                            <input type="text" class="form-control" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" name="description">
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="file" class="form-control" name="price">
                                        </div>
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="text" class="form-control" name="stock">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="text" class="form-control" name="image">
                                        </div>

                                <div class="form-group">
                                    <input type="hidden" name="id" value="">
                                    <input type="submit" class="btn btn-primary" name="add_product" value="Add Product">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
          


            <?php include "includes/admin_footer.php"; ?>