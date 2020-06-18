<?php $this->load->view("layouts_after_login/header") ?>
<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
        <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
            <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0"><?=(isset($documentationType) &&  $documentationType == "documentation"  ? $this->lang->line('Admin Section Page Name Documentation') : $this->lang->line('Admin Section Page Name Terms and Conditions'))?></h5>
        </div>
        
        </div>
    </div>
    
    <div class="card-body px-0 pt-0  card-datables">
   
        <div class="dashboard-data-table">
        <a class="btn btn-warning mr-1 mb-1 float-right" target="_blank" href="<?=site_url('add-page/'.$documentationType.'/'.$userType.'')?>" role="button"><?=$this->lang->line('Admin Section Documentation Page Label Add Page')?></a>
        <p class="search-by-label"><?=$this->lang->line("Search by")?>:</p>
        <table class="search-table table table-sm table-dashboard fs--1 datatable-table">
            <tbody class="bg-200 text-900">
            <tr>
                <td input-placeholder="<?=$this->lang->line('Admin Section Company Label Company Name')?>"></td>                                
                <td input-placeholder="<?=$this->lang->line('Admin Section Company Label Company Status')?>"></td>


            </tr>
            </tbody>
        </table>
        <table class="table table-sm table-dashboard fs--1 datatable-table documentation-table border-bottom" width="100%" data-language-label='{"Datatables Label Display" : "<?=$this->lang->line('Datatables Label Display')?>","Datatables Label Per Page" : "<?=$this->lang->line('Datatables Label Per Page')?>","Datatables Label No Data" : "<?=$this->lang->line('Datatables Label No Data')?>","Datatables Label Page" : "<?=$this->lang->line('Datatables Label Page')?>","Datatables Label Of" : "<?=$this->lang->line('Datatables Label Of')?>","Datatables Label No Records Available" : "<?=$this->lang->line('Datatables Label No Records Available')?>","Datatables Label Total Records" : "<?=$this->lang->line('Datatables Label Total Records')?>","Datatables Label Next" : "<?=$this->lang->line('Datatables Label Next')?>","Datatables Label Previous" : "<?=$this->lang->line('Datatables Label Previous')?>" }' data-options='{"responsive":false,"pagingType":"simple","lengthChange":false,"searching":false,"pageLength":11}'>
            <thead class="bg-200 text-900">
            <tr>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Admin Section Company Label Company Name')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Admin Section Company Label Company Status')?></th>
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
            if($('.documentation-table').length){
                
                languageLabels = $('.documentation-table').attr("data-language-label");
                languageLabels = JSON.parse(languageLabels);
            }
            var search_columns = new Array(0,1,2,3,4,5,6,7,8,9,10);
	        var date_columns = new Array(-1,-2);
            $('.search-table tr td').each(function (index, element) {
                //datepicker class
                 var inputType = 'text';
                 if (jQuery.inArray(index, date_columns) !== -1) {
                      inputType = 'date';
                 }
      
                  if (jQuery.inArray(index, search_columns) !== -1) {
                      $(this).append('<input class="form-control" placeholder="'+$(this).attr("input-placeholder")+'"  type="'+inputType+'"/>');
                  }
            });
            
            //datatables
            companiesTable = $('.documentation-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "responsive":false,
                "order": [[ 0, "desc" ]],
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": url+"pages-data-tables/<?=$documentationType?>/<?=$userType?>",
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
                    { "data": "title" },
                    { "data": 'status' },
                    { "data": 'actions' }
                   
                ]
            });
          
            $(document).on('keyup change','.search-table input', function () {
                companiesTable
                    .column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
            });
           
            $(document).on('click','#delete-page',function(event) {
                content = $(this).attr("lang-content");
                yes = $(this).attr("lang-yes");
                no = $(this).attr("lang-no");
                url = $(this).attr("url");
                id = $(this).attr("pageId");
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
            $(document).on('click','#change-page-status',function(event) {
                content = $(this).attr("lang-content");
                yes = $(this).attr("lang-yes");
                no = $(this).attr("lang-no");
                url = $(this).attr("url");
                id = $(this).attr("pageId");
                status = $(this).attr("pagestatus");
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
                                                    status: status
                            
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