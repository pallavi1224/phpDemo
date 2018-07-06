$(document).ready(function () {
    get_data();
    get_sal_data();
    get_dropdown();
    set_all_checkbox();
});

function get_dropdown() {
    $.ajax({
        url: 'get_dropdown.php',
        method: 'POST',
        success: function (result) {
            $('#info_sal_id').append(result);
        }
    });
}


$("#form_data").submit(function (e) {
    e.preventDefault();
    var f_name = $('#f_name').val();
    var l_name = $('#l_name').val();
    var email = $('#email').val();
    var filter = /^[a-zA-Z0-9#.,;:'()\/&\-"!]+( [a-zA-Z0-9#.,;:'()\/&\-"!]+)*$/;
    if (f_name == '') {
        alert("Please Enter First Name");
        return;
    } else if (l_name == '') {
        alert("Please Enter Last Name");
        return;
    } else if (email == '') {
        alert("Please Enter Email");
        return;
    } else if (filter.test(email)) {
        alert("enter the correct email Address");
        return;
    }
    var formData = new FormData(this);
    $.ajax({
        url: 'add.php',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {
            var data = JSON.parse(result);
            get_data();
            if (data.success == 1) {
                $('#result').html(`<div class='alert alert-primary' role='alert'>
                                            Record Added Successfully</div>`);
            } else if (data.error == 1) {
                $('#result').html(`<div class='alert alert-primary' role='alert'>
                                            Record Not Added </div>`);
            }
        }
    });
})

function get_data() {
    $.ajax({
        url: 'get_data.php',
        method: 'POST',
        success: function (result) {
            var data = JSON.parse(result);
            if (data.error == 1) {
                trHTML = `<div><h3>No Records Found</h3></div>`;
            } else {
                var trHTML = `<div>
                                <i class='far fa-file-pdf fa-3x' onclick='pdf_data()'>&nbsp;</i>
                                <i class='far fa-file-excel fa-3x' onclick='excel_data()'>&nbsp;</i>
                               </div>
                               <table id='example' class='table table-striped table-bordered'>
                                   <thead>
                                       <tr>
                                         <th>ID</th>
                                         <th>First Name</th>
                                         <th>Last Name</th>
                                         <th>Email</th>
                                         <th>Profile</th>
                                         <th>Update</th>
                                         <th>Delete</th>
                                      </tr>
                                  </thead>
                                <tbody>`;
                $.each(data, function (i, item) {
                    trHTML += `<tr>
                                  <td> ${(i + 1)} </td>
                                   <td> ${data[i].f_name} </td>
                                   <td> ${data[i].l_name} </td> 
                                   <td> ${data[i].email} </td>
                                   <td><img src='${data[i].profile}' height='50' width='50'></td>
                                   <td> 
                                        <button type='button' class='btn btn-warning' 
                                          onclick='update_data(" ${data[i].id} ")'>Edit</button>
                                   </td>
                                   <td><button type='button' class='btn btn-danger' 
                                          onclick='delete_data(" ${data[i].id} ")'>Delete</button>
                                   </td>
                              </tr>`;
                });
                trHTML += "</tbody></table>";
            }
            $('#records_table').html(trHTML);
            $('#example').DataTable({});
        }
    })
}
//            $('#example').DataTable({
//                    "bPaginate": true,
//                      "bDestroy": true,
//                      "sPaginationType": "full_numbers",
//                      "bProcessing": true,
//                      "bServerSide": true,
//                      "sAjaxSource": "paginantion.php",
//                "columns": [{
//                        "data": "id"
//                    },
//                    {
//                        "data": "f_name"
//                    },
//                    {
//                        "data": "l_name"
//                    },
//                    {
//                        "data": "email"
//                    },
//                ]//,
////                "columnDefs": [{
////                        "targets": 2,
////                        "render": function(data, type, row) {
////                            return row.f_name;
////                        }
////                    },
////                    {
////                        "targets": 3,
////                        "render": function(data, type, row) {
////                            return row.l_name;
////                        },
////
////                    },
////                ]
//            });


function update_data(id) {
    $('#myModal').modal('show');
    $('#info_id').val(id);
    $.ajax({
        url: 'per_person.php',
        data: 'id=' + id,
        method: 'POST',
        success: function (result) {
            var data = JSON.parse(result);
            console.log(data);
            $('#info_id').val(data.id);
            $('#fname').val(data.f_name);
            $('#lname').val(data.l_name);
            $('#eemail').val(data.email);
        }
    });
}

function delete_data(id) {
    $('#myModal1').modal('show');
    $('#info_id1').val(id);
}

var update = document.getElementById("update");
update.addEventListener("click", update_info);

function update_info() {
    var id = $('#info_id').val();
    var f_name = $('#f_name').val();
    var l_name = $('#l_name').val();
    var email = $('#email').val();
    if (f_name == '') {
        alert("Please Enter First Name");
        return;
    } else if (l_name == '') {
        alert("Please Enter Last Name");
        return;
    } else if (email == '') {
        alert("Please Enter Email");
        return;
    }
    $.ajax({
        url: 'update_person.php',
        data: 'id=' + id + '&f_name=' + f_name + '&l_name=' + l_name + '&email=' + email,
        method: 'POST',
        success: function (result) {
            var data = JSON.parse(result);
            get_data();
            if (data.success == 1) {
                $('#myModal').modal('hide');
                $('#result').html(`<div class='alert alert-primary' role='alert'>
                                        Record Updated Successfully</div>`);
            } else if (data.error == 1) {
                $('#result').html(`<div class='alert alert-primary' role='alert'>
                                        Record Not Updated </div>`);
            }
        }
    });
}

var delete_dta = document.getElementById("delete");
delete_dta.addEventListener("click", delete_info);

function delete_info() {
    var id = $('#info_id1').val();
    $.ajax({
        url: 'delete_person.php',
        data: 'id=' + id,
        method: 'POST',
        success: function (result) {
            var data = JSON.parse(result);
            get_data();
            if (data.success == 1) {
                $('#myModal1').modal('hide');
                $('#result').html(`<div class='alert alert-primary' role='alert'>
                                             Record deleted Successfully</div>`);
            } else if (data.error == 1) {
                $('#result').html(`<div class='alert alert-primary' role='alert'>
                                             Record Not Deleted </div>`);
            }
        }
    });
}

function pdf_data() {
    var date = new Date();
    var for_date = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
    $.ajax({
        url: 'get_data.php',
        method: 'POST',
        success: function (result) {
            var data = JSON.parse(result);
            var trHTML = `<table id='example' class='table table-striped table-bordered'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                            <tbody>`;
            $.each(data, function (i, item) {
                trHTML += `<tr>
                                  <td> ${(i + 1)} </td>
                                   <td> ${data[i].f_name} </td>
                                   <td> ${data[i].l_name} </td> 
                                   <td> ${data[i].email} </td>
                               </tr>`;
            });
            trHTML += "</tbody></table>";
            $('#down_pdf').append(trHTML);
            var url = 'http://server/folder/file.ext';
            var myWindow = window.open("url", "Download", "width=1000,height=1000");
            myWindow.document.write(trHTML);
            myWindow.print();
        }
    })
}

function excel_data() {
    var date = new Date();
    var for_date = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
    $.ajax({
        url: 'get_data.php',
        method: 'POST',
        success: function (result) {
            var data = JSON.parse(result);
            var trHTML = `<table id='example' class='table table-striped table-bordered'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                            <tbody>`;
            $.each(data, function (i, item) {
                trHTML += `<tr>
                                  <td> ${(i + 1)} </td>
                                   <td> ${data[i].f_name} </td>
                                   <td> ${data[i].l_name} </td> 
                                   <td> ${data[i].email} </td>
                               </tr>`;
            });
            trHTML += "</tbody></table>";
            $('#down_pdf').html(trHTML);
            var link = document.createElement('a');
            link.id = 'LinkDownloadExcel';
            link.href = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#down_pdf').html());
            link.download = 'basic_info_' + for_date + '.xls';
            document.body.appendChild(link);
            link.click();
        }
    })
}

function get_sal_data() {
    $.ajax({
        url: 'get_sal_data.php',
        method: 'POST',
        success: function (result) {
            var data = JSON.parse(result);
            if (data.error == 1) {
                trHTML = `<div><h3>No Records Found</h3></div>`;
            } else {
                var trHTML = `<div>
                                <i class='far fa-file-pdf fa-3x' onclick='pdf_sal_data()'>&nbsp;</i>
                                <i class='far fa-file-excel fa-3x' onclick='excel_sal_data()'>&nbsp;</i>
                              </div>
                             <table id='example_sal' class='table table-striped table-bordered'>
                                 <thead>
                                       <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>salary</th>
                                        <th>Delete</th>
                                       </tr>
                                 </thead>
                            <tbody>`;
                $.each(data, function (i, item) {
                    trHTML += `<tr>
                                  <td> ${(i + 1)} </td>
                                  <td> ${data[i].f_name} </td>
                                  <td> ${data[i].l_name} </td>
                                  <td> ${data[i].email} </td>
                                  <td> ${data[i].amount} </td>
                                  <td>
                                       <button type='button' class='btn btn-danger' onclick='delete_sal_data(" ${data[i].sal_id} ")'>Delete</button>
                                  </td></tr>`;
                });
                trHTML += "</tbody></table>";
            }
            $('#sal_table').html(trHTML);
        }
    })
}

var salary_add = document.getElementById("salary_add");
salary_add.addEventListener("click", add_salary);

function add_salary() {
    var salary = $('#salary').val();
    var info_id = $("#info_sal_id option").filter(":selected").val();
    if (salary == '') {
        alert("Please Enter Salary");
        return;
    }
    $.ajax({
        url: 'post_sal.php',
        data: 'salary=' + salary + '&info_id=' + info_id,
        method: 'POST',
        success: function (result) {
            var data = JSON.parse(result);
            get_sal_data();
            if (data.success == 2) {
                $('#result').html(`<div class='alert alert-primary' role='alert'>
                                         Alredy Exist want to add delete the first</div>`);
            } else if (data.success == 1) {
                $('#result').html(`<div class='alert alert-primary' role='alert'>
                                            Record Added Successfully</div>`);
            } else if (data.error == 1) {
                $('#result').html(`<div class='alert alert-primary' role='alert'>
                                            Record Not Added </div>`);
            }
        }
    });
}

function delete_sal_data(id) {
    $('#myModal2').modal('show');
    $('#sal_id1').val(id);
}

var delete_sal = document.getElementById("delete_sal");
delete_sal.addEventListener("click", delete_sal_info);

function delete_sal_info() {
    var id = $('#sal_id1').val();
    $.ajax({
        url: 'delete_sal_person.php',
        data: 'id=' + id,
        method: 'POST',
        success: function (result) {
            var data = JSON.parse(result);
            get_sal_data();
            if (data.success == 1) {
                $('#myModal2').modal('hide');
                $('#result').html(`<div class='alert alert-primary' role='alert'>
                                                Record deleted Successfully</div>`);
            } else if (data.error == 1) {
                $('#result').html(`<div class='alert alert-primary' role='alert'>
                                                Record Not Deleted </div>`);
            }
        }
    });
}

function pdf_sal_data() {
    var date = new Date();
    var for_date = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
    $.ajax({
        url: 'get_sal_data.php',
        method: 'POST',
        success: function (result) {
            var data = JSON.parse(result);
            var trHTML = `<table id='example' class='table table-striped table-bordered'>
                               <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Salary</th>
                                   </tr>
                               </thead>
                               <tbody>`;
            $.each(data, function (i, item) {
                trHTML += `<tr>
                    <td> ${(i + 1)} </td>
                    <td> ${data[i].f_name} </td>
                    <td> ${data[i].l_name} </td>
                    <td> ${data[i].email} </td>
                    <td> ${data[i].amount} </td>
                    </tr>`;
            });
            trHTML += "</tbody></table>";
            $('#print_sal').append(trHTML);
            var myWindow = window.open("url", "Download", "width=1000,height=1000");
            myWindow.document.write(trHTML);
            myWindow.print();
        }
    })
}

function excel_sal_data() {
    var date = new Date();
    var for_date = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
    $.ajax({
        url: 'get_sal_data.php',
        method: 'POST',
        success: function (result) {
            var data = JSON.parse(result);
            var trHTML = `<table id='example' class='table table-striped table-bordered'>
                               <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Salary</th>
                                   </tr>
                               </thead>
                               <tbody>`;
            $.each(data, function (i, item) {
                trHTML += `<tr>
                                    <td> ${(i + 1)} </td>
                                    <td> ${data[i].f_name} </td>
                                    <td> ${data[i].l_name} </td>
                                    <td> ${data[i].email} </td>
                                    <td> ${data[i].amount} </td>
                                </tr>`;
            });
            trHTML += "</tbody></table>";
            $('#print_sal').html(trHTML);
            var link = document.createElement('a');
            link.id = 'LinkDownloadExcel';
            link.href = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#print_sal').html());
            link.download = 'salary_info_' + for_date + '.xls';
            document.body.appendChild(link);
            link.click();

        }
    })
}

function set_all_checkbox() {
    $.ajax({
        url: 'select_check.php',
        method: 'POST',
        success: function (result) {
             var data = JSON.parse(result);
              trHTML = `<ul class="list-group list-group-flush">`;
             $.each(data, function (i, item) {
               trHTML += `<li class='list-group-item'>
                            <input class='form-check-input' type='checkbox' name='${data[i].id}'>
                                <label class='form-check-label'>
                                    ${data[i].f_name}
                                </label>
                            <button type='button' class='btn btn-primary btn-sm float-right'>Send</button>
                          </li>`;
            });
            trHTML += '</ul>'
            $('#mySelect').html(trHTML);
        }
    })
}