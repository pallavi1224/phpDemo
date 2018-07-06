<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <title>Task!</title>
</head>

<body>
    <div class="container">
        <p class="text-right m-3"><i class="fas fa-sign-out-alt fa-3x" onclick="logout()"></i></p>
        <div id="result" class="m-5">

        </div>
        <div class="m-5 p-3">
            <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">First</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Second</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Third</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="container">
                <form class="m-3" id="form_data" enctype="multipart/form-data">
                    <div class="col-md-5 offset-md-3">
                        <h3 class="text-success text-center">Add Personal Details</h3>
                        <div class="form-group">
                            <label for="First Name">First Name</label>
                            <input type="text" name="f_name" id="f_name" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="First Name">First Name</label>
                            <input type="text" name="l_name" id="l_name" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="Email address">Email address</label>
                            <input type="text" name="email" id="email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Profile Picture</label>
                            <input type="file" name="upload_images" class="form-control-file" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <button type="submit" id="add" class="bn btn-primary">Add Info</button>
                    </div>
                </form>
                <div id="records_table">

                </div>

                <div id="down_pdf" style="display:none">

                </div>

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Info</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
            </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <input type="hidden" id="info_id" class="form-control">
                                        <label for="recipient-name" class="col-form-label">First Name:</label>
                                        <input type="text" class="form-control" id="fname">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Last Name:</label>
                                        <input class="form-control" id="lname" />
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Email:</label>
                                        <input type="email" class="form-control" id="eemail" />
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="update">Update</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Info</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <input type="hidden" id="info_id1" class="form-control">
                                    </div>
                                    <p>
                                        Are you sure you want to delete the records then press on delete else press close
                                    </p>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="delete">Delete</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="container">
                <div class="text-center">
                    <h3 class="text-success text-center">Add Salary Details</h3>
                    <form class="m-3">
                        <div class="col-md-5 offset-md-3">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Person</label>
                                <select class="form-control" id="info_sal_id">
                                   <option value="">Select Name</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="First Name">Enter Salary</label>
                                <input type="text" name="salary" id="salary" class="form-control" />
                            </div>
                            <button type="button" id="salary_add" class="bn btn-primary">Add Salary</button>
                        </div>
                    </form>
                    <div id="sal_table">

                    </div>
                    <div id="print_sal" style="display:none">

                    </div>
                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Info</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <input type="hidden" id="sal_id1" class="form-control">
                                        </div>
                                        <p>
                                            Are you sure you want to delete the records then press on delete else press close
                                        </p>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="delete_sal">Delete</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <div class="container">
                <div class="col-md-5 offset-md-3">
                    <div class="card">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="select_all" value="option1">
                            <label class="form-check-label">Select All checkboxes</label>
                        </div>
                        <div class="card-body" id="mySelect">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="main.js"></script>

<script>
    $(document).ready(function() {
        $('#select_all').on('click', function() {
            if (this.checked) {
                $('input[type=checkbox]').each(function() {
                    this.checked = true;
                });
            } else {
                $('input[type=checkbox]').each(function() {
                    this.checked = false;
                });
            }
        });

        $('input[type=checkbox]').on('click', function() {
            if ($('input[type=checkbox]:checked').length == $('input[type=checkbox]').length) {
                $('#select_all').prop('checked', true);
            } else {
                $('#select_all').prop('checked', false);
            }
        });
    });

    function logout() {
        $.ajax({
            url: 'logout.php',
            method: 'POST',
            success: function() {
                window.location = "index.html";
            }
        })
    }
</script>