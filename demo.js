//    function pdf_data() {
//        var date=new Date();
//        var for_date=date.getDate()+"/"+(date.getMonth()+1)+"/"+date.getFullYear();
//        $.ajax({
//            url: 'get_data.php',
//            method: 'POST',
//            success: function(result) {
//                var data = JSON.parse(result);
//                var trHTML = "<table id='example' class='table table-striped table-bordered' style='width:100%'><thead><tr><th>First Name</th><th>Last Name</th><th>Email</th></tr></thead><tbody>";
//                $.each(data, function(i, item) {
//                    trHTML += "<tr><td>" + data[i].f_name + "</td><td>" + data[i].l_name + "</td><td>" + data[i].email + "</td><td>";
//                });
//                trHTML += "</tbody></table>";
//                $('#down_pdf').append(trHTML);
//                var doc = new jsPDF();
//                var specialElementHandlers = {
//                    '#down': function(element, renderer) {
//                        return true;
//                    }
//                };
//
//                doc.fromHTML($('#down_pdf').html(), 15, 15, {
//                    'width': 170,
//                    'elementHandlers': specialElementHandlers
//                });
//                doc.save('sample-file '+for_date+'.pdf');
//            }
//        })
//    }

var table = jQuery("#remark_table_1").DataTable(
  {
      "bPaginate": true,
      "bDestroy": true,
      "sPaginationType": "full_numbers",
      "bProcessing" : true,
      "bServerSide": true,
      "sAjaxSource":"index.php?option=com_notifint&task=examsettings.get_co_scholastic_remarks&format1=raw",
       fnServerParams : function(aoData){
                          },
      "columns": [                       { 
                        "orderable": false,
                        "data": "countserial" 
                       },
                       { "data": "remark" },
                       { "data": "originatility" },
                       { 
                          "orderable": false,
                          "bSearchable" : true,
                          "data" : {},
                          "render" : function(data, type, full, meta){
                                  return '<img style="cursor:pointer;width:30px;height:30px;margin-left:10px;" src="images/prisms/edit.png" onclick=edit_remark("'+data.remark_id+'","remark") class="edit_button" />'
                                  +'<img style="cursor:pointer;width:30px;height:30px" src="images/prisms/del.png" onclick="delete_remark('+data.remark_id+')" />'
                          }
                        }
                     
                  ]
  });

$rc_count2;
        $total_rec2;
        $output = array(
                "sEcho" => intval($_REQUEST['sEcho']),
                "iTotalRecords" =>intval(10),
                "iTotalDisplayRecords" =>intval(10),
                "aaData" => array()
        );
        $model = $this->getModel('examsettings');
        $output['aaData']= $model->get_co_scholastic_remarks($rc_count2,$total_rec2);
        $output['iTotalRecords'] = $rc_count2;
        $output['iTotalDisplayRecords'] = $total_rec2;