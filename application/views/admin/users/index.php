<?php $this->load->view("layouts_after_login/header") ?>
<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
        <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
            <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0"><?=$this->lang->line('Admin Section Menu Label Customers')?></h5>
        </div>
        <div class="col-6 col-sm-auto ml-auto text-right pl-0">
            <div class="d-none" id="purchases-actions">
            <div class="input-group input-group-sm">
                <select class="custom-select cus" aria-label="Bulk actions">
                <option selected="">Bulk actions</option>
                <option value="Refund">Refund</option>
                <option value="Delete">Delete</option>
                <option value="Archive">Archive</option>
                </select>
                <button class="btn btn-falcon-default btn-sm ml-2" type="button">Apply</button>
            </div>
            </div>
            
        </div>
        </div>
    </div>
    <div class="card-body px-0 pt-0  card-datables">
       
        <div class="dashboard-data-table">
        <p class="search-by-label"><?=$this->lang->line("Search by")?>:</p>
        <table class="search-table table table-sm table-dashboard fs--1 datatable-table">
            <thead class="bg-200 text-900">
            <tr>
                <td input-placeholder="<?=$this->lang->line('Admin Section Users Label User Name')?>"></td>                                
                <td input-placeholder="<?=$this->lang->line('Admin Section Users Label User Reference')?>"></td>
                <td input-placeholder="<?=$this->lang->line('Admin Section Users Label User Email')?>"></td>
                <td input-placeholder="<?=$this->lang->line('Admin Section Users Label User Phone')?>"></td>
                <td input-placeholder="<?=$this->lang->line('Admin Section Users Label User IBAN')?>"></td>
                <td input-placeholder="<?=$this->lang->line('Admin Section Users Label User Address')?>"></td>
                <td input-placeholder="<?=$this->lang->line('Admin Section Users Label User Status')?>"></td>
            </tr>
            </thead>
        </table>
        <table class="table table-sm table-dashboard fs--1 datatable-table users-table border-bottom" width="100%" data-language-label='{"Datatables Label Display" : "<?=$this->lang->line('Datatables Label Display')?>","Datatables Label Per Page" : "<?=$this->lang->line('Datatables Label Per Page')?>","Datatables Label No Data" : "<?=$this->lang->line('Datatables Label No Data')?>","Datatables Label Page" : "<?=$this->lang->line('Datatables Label Page')?>","Datatables Label Of" : "<?=$this->lang->line('Datatables Label Of')?>","Datatables Label No Records Available" : "<?=$this->lang->line('Datatables Label No Records Available')?>","Datatables Label Total Records" : "<?=$this->lang->line('Datatables Label Total Records')?>","Datatables Label Next" : "<?=$this->lang->line('Datatables Label Next')?>","Datatables Label Previous" : "<?=$this->lang->line('Datatables Label Previous')?>" }' data-options='{"responsive":false,"pagingType":"simple","lengthChange":false,"searching":false,"pageLength":11}'>
            <thead class="bg-200 text-900">
            <tr>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Admin Section Users Label User Name')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Admin Section Users Label User Reference')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Admin Section Users Label User Email')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Admin Section Users Label User Phone')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Admin Section Users Label User IBAN')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Admin Section Users Label User Address')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Admin Section Users Label User Status')?></th>
                <th class="no-sort pr-1 align-middle"></th>
            </tr>
            
            </thead>
            <tbody id="purchases">

            </tbody>
        </table>
        </div>
    </div>
</div>
<?php $this->load->view("layouts_after_login/footer") ?>
<script>
$(document).ready(function(){
            if($('.users-table').length){
                
                languageLabels = $('.users-table').attr("data-language-label");
                languageLabels = JSON.parse(languageLabels);
            }
            var search_columns = new Array(0,1,2,3,4,5,6,7);
	        var date_columns = new Array(-1,-2);
            $('.search-table tr td').each(function (index, element) {
                //datepicker class
                 var inputType = 'text';
                 if (jQuery.inArray(index, date_columns) !== -1) {
                      inputType = 'date';
                 }
      
                  if (jQuery.inArray(index, search_columns) !== -1) {
                      $(this).append('<input class="form-control col-sm-12" placeholder="'+$(this).attr("input-placeholder")+'" type="'+inputType+'"/>');
                  }
            });
            
            //datatables
            usersTable = $('.users-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "responsive":false,
                "order": [[ 0, "desc" ]],
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": url+"users-data-tables",
                    "type": "POST"
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ 0 ], //first column / numbering column
                    "orderable": true, //set not orderable
                }
                ],
                "bSort": true,
                "sDom": 'lrtip',
                "pageLength": 10,
                "lengthMenu": [[5,10, 25, 50], [5, 10, 25, 50]],
                "language": {
                    "lengthMenu": ""+languageLabels['Datatables Label Display']+" _MENU_ "+languageLabels['Datatables Label Per Page']+"",
                    "zeroRecords": ""+languageLabels['Datatables Label No Data']+"",
                    "info": ""+languageLabels['Datatables Label Page']+" _PAGE_ "+languageLabels['Datatables Label Of']+" _PAGES_",
                    "infoEmpty": ""+languageLabels['Datatables Label No Records Available']+"",
                    "infoFiltered": "("+languageLabels["Datatables Label Total Records"]+" _MAX_)",
                    "oPaginate": {
                          "sNext": ""+languageLabels['Datatables Label Next']+"",
                          "sPrevious": ""+languageLabels['Datatables Label Previous']+""
                       }
                },
                "columns": [
                    { "data": "userName" },
                    { "data": 'referrerName' },
                    { "data": 'email' },
                    { "data": 'phone' },
                    { "data": 'iban' },
                    { "data": 'address' },
                    { "data": 'status' },
                    { "data": 'actions' }
                   
                ]
            });
          
            $(document).on('keyup change','.search-table input', function () {
                usersTable
                    .column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
            });
            $(document).on('#general-modal','hidden.bs.modal', function (e) {
                tickets_table.ajax.reload();
            });
            $(document).on('click','#delete-user',function(event) {
                content = $(this).attr("lang-content");
                yes = $(this).attr("lang-yes");
                no = $(this).attr("lang-no");
                url = $(this).attr("url");
                id = $(this).attr("userId");
                var dialog = bootbox.dialog({
                        message: content,
                        closeButton: false,
                        buttons: {
                                noclose: {
                                        label: yes,
                                        className: "btn-success",
                                        callback: function () {
                                            $(".loading-div").css("display","block");
                                            $.ajax({
                                                type: "POST",
                                                url:  url,
                                                data: {
                                                    id: id
                            
                                                },
                                                error: function (xhr, textStatus, errorThrown) {
                                                    console.log('Error: ' + xhr.responseText);
                                                },
                                                success: function (data) {
                                                    dialog.find('.bootbox-body').prepend(data);
                                                  
                                                }
                                            });
                                        }
                                },
                                danger: {
                                        label: no,
                                        className: "btn-danger",
                                }
                        }
                });
            });
            $(document).on('click','#change-user-status',function(event) {
                content = $(this).attr("lang-content");
                yes = $(this).attr("lang-yes");
                no = $(this).attr("lang-no");
                url = $(this).attr("url");
                id = $(this).attr("userId");
                userStatus = $(this).attr("userStatus");
                var dialog = bootbox.dialog({
                        message: content,
                        closeButton: false,
                        buttons: {
                                noclose: {
                                        label: yes,
                                        className: "btn-success",
                                        callback: function () {
                                            $(".loading-div").css("display","block");
                                            $.ajax({
                                                type: "POST",
                                                url:  url,
                                                data: {
                                                    id: id,
                                                    userStatus: userStatus
                            
                                                },
                                                error: function (xhr, textStatus, errorThrown) {
                                                    console.log('Error: ' + xhr.responseText);
                                                },
                                                success: function (data) {
                                                    dialog.find('.bootbox-body').prepend(data);
                                                  
                                                }
                                            });
                                        }
                                },
                                danger: {
                                        label: no,
                                        className: "btn-danger",
                                }
                        }
                });
            });


            
        });
</script>