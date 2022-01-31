<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Manage Users</li>
        </ol>
    </div><!--/.row-->

    <br>

    <div class="row">
        <div class="col-lg-12">
            <div id="success"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Users
                    <button class="btn btn-secondary pull-right" style="border-radius:0%" data-toggle="modal" data-target="#addRoom">Add Rooms</button>
                </div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Failed To Delete User!
                            </div>";
                    }
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; User Deleted Successfully  !
                            </div>";
                    }
                    ?>

<?php
                    if (isset($_GET['error_adding_user'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Failed To Add User!
                            </div>";
                    }
                    if (isset($_GET['new_user_added'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; User Added Successfully  !
                            </div>";
                    }
                    ?>


                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"
                           id="rooms">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $room_query = "SELECT * FROM user";
                        $rooms_result = mysqli_query($connection, $room_query);
                        if (mysqli_num_rows($rooms_result) > 0) {
                            while ($user = mysqli_fetch_assoc($rooms_result)) { ?>
                                <tr>
                                    <td><?php echo $user['name'] ?></td>
                                    <td><?php echo $user['username'] ?></td>
                                    <td>
                                        
                                    <?php echo $user['email'] ?>

                                
                                        <?php
                                        if($user['role_id']==1){

                                            echo("<td>Administrator </td>");
                                        }else{
                                            echo("<td>Staff </td>");
                                        }
                                        ?>
                                  
            
                                    <td>


                                        <button title="Edit User Password" user_id="<?php echo($user['id']); ?>" style="border-radius:60px;" data-toggle="modal"
                                                data-target="#editRoom" 
                                                id="userEdit" class="btn btn-info userEdit"><i class="fa fa-pencil"></i></button>
                                        
                                       

                                        <a href="ajax.php?delete_user=<?php echo $user['id']; ?>"
                                           class="btn btn-danger" style="border-radius:60px;" onclick="return confirm('Are you Sure You want to delete ?')"><i
                                                    class="fa fa-trash" alt="delete"></i></a>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo "No Rooms";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Room Modal -->
    <div id="addRoom" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New User</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="adduser" action="ajax.php" method="POST" data-toggle="validator" role="form">
                                <div class="response"></div>
                                <div class="form-group">
                                    <label>Account Type</label>
                                    <select class="form-control" name="role_id" id="account_type" required
                                            data-error="Select Account Type">
                                        <option selected disabled>Select Account Type</option>
                                        <option value="1">Manager</option>
                                        <option value="2">Other  Staff</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" placeholder="Enter Name Of Staff"  name="name" id="name"
                                           data-error="Enter Name" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" placeholder="Enter Username" name="username" id="username"
                                           data-error="Enter Username" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="email" placeholder="Enter Email" id="email"
                                           data-error="Enter Email" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" name="password" type="password" placeholder="Enter Password" id="password"
                                           data-error="Enter Password" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <label>Comfirm Password</label>
                                    <input class="form-control" name="comfirm_password" type="password" placeholder="Enter Password" id="password"
                                           data-error="Comfirm Password" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <button type="submit" class="btn btn-success pull-right" id="btn_adduser">Add User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--Edit Room Modal -->
    <div id="editRoom" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div id="msg" style="color:green; font-weight:bolder; text-align:center; padding-top:5px"> </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit User</h4> 
                </div> 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form  data-toggle="validator" role="form">
                                <div class="edit_response"></div>
                                <div class="form-group col-lg-6">
                                    <label>Enter Password</label>
                                    <input class="form-control" id="pass1" type="password" name="">
                                    <div class="help-block with-errors"></div>
                                </div>


                                <div class="form-group col-lg-6">
                                    <label>Comfirm Password</label>
                                    <input class="form-control" id="pass2" type="password" name="">
                                    <div class="help-block with-errors"></div>
                                </div>

                             <div id="pass_err" style="color:red; font-weight:bold"> </div>
                               
                                <button class="btn btn-success pull-right" id="change_password">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!---customer details-->
    <div id="cutomerDetailsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>Customer's Detail</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">
                                <!-- <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Detail</th>
                                </tr>
                                </thead> -->
                                <tbody>
                                <tr>
                                    <td><b>Customer Name</b></td>
                                    <td id="customer_name"></td>
                                </tr>
                                <tr>
                                    <td><b>Contact Number</b></td>
                                    <td id="customer_contact_no"></td>
                                </tr>
                                <tr>
                                    <td><b>Email</b></td>
                                    <td id="customer_email"></td>
                                </tr>
                                <tr>
                                    <td><b>ID Card Type</b></td>
                                    <td id="customer_id_card_type"></td>
                                </tr>
                                <tr>
                                    <td><b>ID Card Number</b></td>
                                    <td id="customer_id_card_number"></td>
                                </tr>
                                <tr>
                                    <td><b>Address</b></td>
                                    <td id="customer_address"></td>
                                </tr>
                                <tr>
                                    <td><b>Remaining Amount</b></td>
                                    <td id="remaining_price"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---customer details ends here-->

    <!-- Check In Modal -->
    <div id="checkIn" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>Room - Check In</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">
                                
                                <tbody>
                                <tr>
                                    <td><b>Customer Name</b></td>
                                    <td id="getCustomerName"></td>
                                </tr>
                                <tr>
                                    <td><b>Room Type</b></td>
                                    <td id="getRoomType"></td>
                                </tr>
                                <tr>
                                    <td><b>Room Number</b></td>
                                    <td id="getRoomNo"></td>
                                </tr>
                                <tr>
                                    <td><b>Check In</b></td>
                                    <td id="getCheckIn"></td>
                                </tr>
                                <tr>
                                    <td><b>Check Out</b></td>
                                    <td id="getCheckOut"></td>
                                </tr>
                                <tr>
                                    <td><b>Total Price</b></td>
                                    <td id="getTotalPrice"></td>
                                </tr>
                                </tbody>
                            </table>
                            <form role="form" id="advancePayment">
                                <div class="payment-response"></div>
                                <div class="form-group col-lg-12">
                                    <label>Advance Payment</label>
                                    <input type="number" class="form-control" id="advance_payment"
                                           placeholder="Please Enter Amounts Here..">
                                </div>
                                <input type="hidden" id="getBookingID" value="">
                                <button type="submit" class="btn btn-primary pull-right">Payment & Check In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Check Out Modal-->
    <div id="checkOut" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>Room- Check Out</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">
                                
                                <tbody>
                                <tr>
                                    <td><b>Customer Name</b></td>
                                    <td id="getCustomerName_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Room Type</b></td>
                                    <td id="getRoomType_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Room Number</b></td>
                                    <td id="getRoomNo_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Check In</b></td>
                                    <td id="getCheckIn_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Check Out</b></td>
                                    <td id="getCheckOut_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Total Amount</b></td>
                                    <td id="getTotalPrice_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Remaining Amount</b></td>
                                    <td id="getRemainingPrice_n"></td>
                                </tr>
                                </tbody>
                            </table>
                            <form role="form" id="checkOutRoom_n" data-toggle="validator">
                                <div class="checkout-response"></div>
                                <div class="form-group col-lg-12">
                                    <label><b>Remaining Payment</b></label>
                                    <input type="text" class="form-control" id="remaining_amount"
                                           placeholder="Remaining Payment" required
                                           data-error="Please Enter Remaining Amount">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" id="getBookingId_n" value="">
                                <button type="submit" class="btn btn-primary pull-right">Proceed Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
        <p class="back-link">Developed By Gabriel Okhai - 07066421428</p>
        </div>
    </div>

</div>    <!--/.main-->



