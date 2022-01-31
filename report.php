
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Submit Report</li>
        </ol>
    </div><!--/.row-->

    <!-- <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Reservation</h1>
        </div>
    </div>/.row -->

    

    <div class="row">
      
   <form method="GET" action="report_script.php" id="report_date">
   
                            <div class="form-group col-lg-12">
                                    <label>Chose Date To Send Report</label>
                                    <input type="text" class="form-control " placeholder="mm/dd/yyyy" id="check_in_date" data-error="Select Check In Date" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                        </div>
                    </div>


                    <div class="form-group col-lg-12">
                    <button type="submit" class="btn btn-lg btn-success pull-right" style="border-radius:0%">Submit</button>
                    </div>
                   
                </div>
            </form>

<div id="mytable"></div>

            <script>
            //Report Script
           var report_form = document.getElementById('report_date');
           report_form.addEventListener('submit', function(e){
            e.preventDefault();
            var date = document.getElementById('check_in_date');
            var date_to_check = date.value;
              

            
         
              $.post('ajax.php', 
              
              {
                date_to_check:date_to_check,
                report:''    
              },

              function(data, status){

                  var table = document.getElementById('mytable');
table.innerHTML = data;
                  console.log(data);
              }
              
              );

            }
              
              );

            </script>
      
    </div>

    <div class="row">
        <div class="col-sm-12" style="position:absolute; bottom:0">
            <p class="back-link">Developed By Gabriel Okhai - 07066421428</p>
        </div>
    </div>

</div>    <!--/.main-->


<!-- Booking Confirmation-->
<div id="bookingConfirm" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><b>Room Booking</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert bg-success alert-dismissable" role="alert"><em class="fa fa-lg fa-check-circle">&nbsp;</em>Room Successfully Booked</div>
                        <table class="table table-striped table-bordered table-responsive">
                            <!-- <thead>
                            <tr>
                                <th>Name</th>
                                <th>Detail</th>
                            </tr>
                            </thead> -->
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
                                <td><b>Room No</b></td>
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
                                <td><b>Total Amount</b></td>
                                <td id="getTotalPrice"></td>
                            </tr>
                            <tr>
                                <td><b>Payment Status</b></td>
                                <td id="getPaymentStaus"></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" style="border-radius:60px;" href="index.php?reservation"><i class="fa fa-check-circle"></i></a>
            </div>
        </div>

    </div>
</div>


