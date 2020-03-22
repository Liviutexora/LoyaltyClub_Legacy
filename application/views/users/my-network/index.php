<?php $this->load->view("layouts_after_login/header") ?>
<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
        <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
            <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0"><?=$this->lang->line('User Section Menu Label My Network')?></h5>
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
    <div class="card-body px-0 pt-0  myNetwork">
        <div class="dashboard-data-table">
        <table class="table table-sm table-dashboard fs--1 data-table border-bottom" width="100%" data-options='{"responsive":true,"pagingType":"simple","lengthChange":false,"searching":false,"pageLength":11}'>
            <thead class="bg-200 text-900">
            <tr>
                <th class="no-sort pr-1 align-middle data-table-row-bulk-select">
               
                </th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('User Section Label My Network Level')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('User Section Label My Network Users')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('User Section Label My Network Incomes')?></th>
                <th class="sort pr-1 align-middle text-center"><?=$this->lang->line('User Section Label My Network Qualified')?></th>
                <th class="sort pr-1 align-middle text-right"><?=$this->lang->line('User Section Label My Network Revenue')?></th>
               
            </tr>
            </thead>
            <tbody id="purchases">
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <span class="ml-1 fas fa-check level-with-users-span"></span>
                </td>
                <th class="align-middle">0</th>
                <td class="align-middle"><?=$this->current_user['nume']?></td>
                <td class="align-middle"><?=$totalAmount?> kr</td>
                <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success"><?=$this->lang->line('User Section Label My Network Qualified')?><span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                </td>
                <td class="align-middle text-right"><?=$totalAmount?> kr</td>
               
            </tr>
            <?php foreach($levels as $levelNr=>$levelDetails){ ?>
            
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <?php if($levelDetails['nr'] > 0) {?>
                    <span class="ml-1 fas fa-check level-with-users-span"></span>
                <?php } else { ?>
                    <span class="ml-1 fas fa-times level-without-users-span"></span>
                <?php } ?>
               
                </td>
                <th class="align-middle"><?=$this->lang->line("User Section Label My Network Level")?> <?=$levelNr?></th>
                <td class="align-middle">
                <div class="accordion" id="myNetworkUsers">
                    <button class="btn btn-link text-center" type="button" data-toggle="collapse" data-target="#displayLevelUsers<?=$levelNr?>" aria-expanded="true" aria-controls="collapseOne">
                    <?=$levelDetails['nr']?>
                    </button>
                    <div id="displayLevelUsers<?=$levelNr?>" class="collapse" aria-labelledby="displayLevelUsers<?=$levelNr?>" data-parent="#myNetworkUsers">
                    <div class="card-my-network-container">
                        <div class="card-body card-my-network">
                            <?=$levelDetails['users']?>
                        </div>
                    <div>
                    </div>
                </div>
                </td>
                <td class="align-middle"><?=$levelDetails['totalprofit']?> kr</td>
                <td class="align-middle text-center fs-0">
                    <?php if($totalAmount<500):?>
                    <span class="badge badge rounded-capsule badge-soft-warning"><?=$this->lang->line('User Section Label My Network Unqualified')?><span class="ml-1 fas fa-stream" data-fa-transform="shrink-2"></span></span>
                    <?php elseif($totalAmount<2100 && $levelNr>3):?> 
                    <span class="badge badge rounded-capsule badge-soft-warning"><?=$this->lang->line('User Section Label My Network Unqualified')?><span class="ml-1 fas fa-stream" data-fa-transform="shrink-2"></span></span>
                    <?php elseif($totalAmount<4900 && $levelNr>7):?>
                    <span class="badge badge rounded-capsule badge-soft-warning"><?=$this->lang->line('User Section Label My Network Unqualified')?><span class="ml-1 fas fa-stream" data-fa-transform="shrink-2"></span></span>							
                    <?php else: ?>
                    <span class="badge badge rounded-capsule badge-soft-success"><?=$this->lang->line('User Section Label My Network Qualified')?><span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                    <?php endif; ?>
                </td>
                <td class="align-middle text-right"><?=$levelDetails['totalprofit']?> kr</td>
                <td class="align-middle white-space-nowrap">
               
                </td>
            </tr>
            <?php } ?>

            </tbody>
        </table>
        </div>
    </div>
    </div>
<?php $this->load->view("layouts_after_login/footer") ?>