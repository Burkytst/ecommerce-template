<?php
	require('../../src/config.php');
    require('../../src/dbconnect.php');

	$sql = "SELECT * FROM products";
	$stmt = $dbconnect->query($sql);
	$products = $stmt->fetchAll();

?>

<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

<?php include "includes/admin_sidebar.php"; ?>


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
                        <th>
                                    <button class='btn btn-primary' data-toggle='modal' data-target='#add_modal'>Add Product</button>
                                                    </th>
                    </tr>
                </thead>
                <tbody>


                <?php foreach($products as $product) { ?>
            
                    <tr>
                        <td><?=$product['id']?></td>
                        <td><?=$product['title']?></td>
                        <td><?=$product['description']?></td>
                        <td><?=$product['price']?></td>
                        <td><?=$product['stock']?></td>
                        <td><?=$product['img_url']?></td>
                      
                       
                        <td>
                            <div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Actions
                                </button>
                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <a class='dropdown-item' data-toggle='modal' data-target="#edit_modal<?=$product['id']?>">Edit</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' data-toggle='modal' data-target="#delete_modal<?=$product['id']?>">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <div id="delete_modal<?=$product['id']?>" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="id">Are you sure?</label>
                                            <input type="hidden" class="form-control" readonly name="id" value="<?=$product['id']?>">
                                            <input type="hidden" name="form_type" value="delete">

                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" name="delete_product" value="yes">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">no </button>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="edit_modal<?=$product['id']?>" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" class="form-control" readonly name="id" value="<?=$product['id']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Product Title</label>
                                            <input type="text" class="form-control" name="title" value="<?=$product['title']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" name="description" value="<?=$product['description']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" name="price" value="<?=$product['price']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="text" class="form-control" name="stock" value="<?=$product['stock']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>

                                        <div class="form-group">
                                        <input type="hidden" name="form_type" value="edit">
                                            <input type="submit" class="btn btn-primary" name="edit_product" value="Edit Product">
                                            
                                        </div>
                                        <div class="form-group">
                                            <div id="formInfo<?=$product['id']?>" class=" hide alert"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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
                                            <label for="title">Product Title</label>
                                            <input type="text" class="form-control" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" name="description">
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" name="price">
                                        </div>
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="text" class="form-control" name="stock">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>

                                <div class="form-group">
                                    <input type="hidden" name="form_type" value="add">
                                    <input type="submit" class="btn btn-primary" name="add_product" value="Add Product">
                                </div>
                                <div class="form-group">
                                            <div id="formInfoAdd" class=" hide alert"></div>
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
          
<script>
    if(window !==undefined){
        window.addEventListener('submit',function(e){
            if(e.submitter.name === "edit_product"){
                e.preventDefault();
                let _body = new FormData(e.target);
               
                if (_body.get("title") == ""){
                document.getElementById("formInfo"+_body.get("id")).classList.add("alert-danger");
                        document.getElementById("formInfo"+_body.get("id")).innerText="Please type product title in the form";
                        document.getElementById("formInfo"+_body.get("id")).classList.remove("hide","alert-success");
                    return;
                }
                if (_body.get("description") == ""){
                document.getElementById("formInfo"+_body.get("id")).classList.add("alert-danger");
                        document.getElementById("formInfo"+_body.get("id")).innerText="Please type description in the form";
                        document.getElementById("formInfo"+_body.get("id")).classList.remove("hide","alert-success");
                    return;
                }
                if (_body.get("price") == ""){
                document.getElementById("formInfo"+_body.get("id")).classList.add("alert-danger");
                        document.getElementById("formInfo"+_body.get("id")).innerText="Please type product price in the form";
                        document.getElementById("formInfo"+_body.get("id")).classList.remove("hide","alert-success");
                    return;
                }
                if (_body.get("stock") == ""){
                document.getElementById("formInfo"+_body.get("id")).classList.add("alert-danger");
                        document.getElementById("formInfo"+_body.get("id")).innerText="Please type stock in the form";
                        document.getElementById("formInfo"+_body.get("id")).classList.remove("hide","alert-success");
                    return;
                }
                fetch('productsDb.php', {
                    method: 'POST',
                    body: _body,
                }).then(function (response) {
                    if (response.ok) {
                        return response.json();
                    }
                    return Promise.reject(response);
                }).then(function (data) {
                    if(data!==0){
                        document.getElementById("formInfo"+data).classList.add("alert-success");
                        document.getElementById("formInfo"+data).innerText="Updated";
                        document.getElementById("formInfo"+data).classList.remove("hide","alert-danger");
                    }else{
                        document.getElementById("formInfo"+data).classList.add("alert-danger");
                        document.getElementById("formInfo"+data).innerText="Error";
                        document.getElementById("formInfo"+data).classList.remove("hide","alert-success");
                    }
                }).catch(function (error) {
                    console.warn(error);
                });

                window.addEventListener("click",function(event){
                    event.preventDefault();
                if(event.target.classList.contains("fade") || event.target.classList.value==""){
                    location.reload(true)
                }
                })

                


            }
            if(e.submitter.name==="delete_product"){
                e.preventDefault();
                fetch('productsDb.php', {
                    method: 'POST',
                    body: new FormData(e.target),
                }).then(function (response) {
                    if (response.ok) {
                        return response.json();
                    }
                    return Promise.reject(response);
                }).then(function (data) {
                    if(data!==0){
                        location.reload(true)
                    }
                }).catch(function (error) {
                    console.warn(error);
                });
                
            }
            if(e.submitter.name==="add_product"){
                e.preventDefault();
                let _body = new FormData(e.target);
                
                if (_body.get("title") == ""){
                document.getElementById("formInfoAdd").classList.add("alert-danger");
                        document.getElementById("formInfoAdd").innerText="Please type product title in the form";
                        document.getElementById("formInfoAdd").classList.remove("hide","alert-success");
                    return;
                }
                if (_body.get("description") == ""){
                document.getElementById("formInfoAdd").classList.add("alert-danger");
                        document.getElementById("formInfoAdd").innerText="Please type description in the form";
                        document.getElementById("formInfoAdd").classList.remove("hide","alert-success");
                    return;
                }
                if (_body.get("price") == ""){
                document.getElementById("formInfoAdd").classList.add("alert-danger");
                        document.getElementById("formInfoAdd").innerText="Please type product price in the form";
                        document.getElementById("formInfoAdd").classList.remove("hide","alert-success");
                    return;
                }
                if (_body.get("stock") == ""){
                document.getElementById("formInfoAdd").classList.add("alert-danger");
                        document.getElementById("formInfoAdd").innerText="Please type stock in the form";
                        document.getElementById("formInfoAdd").classList.remove("hide","alert-success");
                    return;
                }
                fetch('productsDb.php', {
                    method: 'POST',
                    body: _body,
                }).then(function (response) {
                    if (response.ok) {
                        return response.json();
                    }
                    return Promise.reject(response);
                }).then(function (data) {
                    if(data!==0){
                        location.reload(true)
                    }
                }).catch(function (error) {
                    console.warn(error);
                });
                
            }
		
	})
//modal close



    }


</script>

            <?php include "includes/admin_footer.php"; ?>