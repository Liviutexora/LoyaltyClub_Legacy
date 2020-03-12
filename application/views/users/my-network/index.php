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
    <div class="card-body px-0 pt-0">
        <div class="dashboard-data-table">
        <table class="table table-sm table-dashboard fs--1 data-table border-bottom" data-options='{"responsive":false,"pagingType":"simple","lengthChange":false,"searching":false,"pageLength":10,"columnDefs":[{"targets":[0,6],"orderable":false}],"language":{"info":"_START_ to _END_ Items of _TOTAL_ — <a href=\"#!\" class=\"font-weight-semi-bold\"> view all <span class=\"fas fa-angle-right\" data-fa-transform=\"down-1\"></span> </a>"}}'>
            <thead class="bg-200 text-900">
            <tr>
                <th class="no-sort pr-1 align-middle data-table-row-bulk-select">
               
                </th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('User Section Label My Network Level')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('User Section Label My Network Users')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('User Section Label My Network Incomes')?></th>
                <th class="sort pr-1 align-middle text-center"><?=$this->lang->line('User Section Label My Network Qualified')?></th>
                <th class="sort pr-1 align-middle text-right"><?=$this->lang->line('User Section Label My Network Revenue')?></th>
                <th class="no-sort pr-1 align-middle data-table-row-action"></th>
            </tr>
            </thead>
            <tbody id="purchases">
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-0" disabled="disabled" checked="checked"/>
                    <label class="custom-control-label" for="checkbox-0"></label>
                </div>
                </td>
                <th class="align-middle">Level 1</th>
                <td class="align-middle">200</td>
                <td class="align-middle">100 K=kr</td>
                <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                </td>
                <td class="align-middle text-right">99 kr</td>
                <td class="align-middle white-space-nowrap">
               
                </td>
            </tr>
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-0" disabled="disabled" />
                    <label class="custom-control-label" for="checkbox-0"></label>
                </div>
                </td>
                <th class="align-middle">Level 2</th>
                <td class="align-middle">0</td>
                <td class="align-middle">100 K=kr</td>
                <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-secondary">Blocked<span class="ml-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>
                </td>
                <td class="align-middle text-right">99 kr</td>
                <td class="align-middle white-space-nowrap">
               
                </td>
            </tr>
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-0" disabled="disabled" checked="checked" />
                    <label class="custom-control-label" for="checkbox-0"></label>
                </div>
                </td>
                <th class="align-middle">Level 3</th>
                <td class="align-middle">200</td>
                <td class="align-middle">100 K=kr</td>
                <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-warning">Pending<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span> <span class="ml-1 fas fa-stream" data-fa-transform="shrink-2"></span></span>
                </td>
                <td class="align-middle text-right">99 kr</td>
                <td class="align-middle white-space-nowrap">
               
                </td>
            </tr>
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-0" disabled="disabled" checked="checked"/>
                    <label class="custom-control-label" for="checkbox-0"></label>
                </div>
                </td>
                <th class="align-middle">Level 4</th>
                <td class="align-middle">200</td>
                <td class="align-middle">100 K=kr</td>
                <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                </td>
                <td class="align-middle text-right">99 kr</td>
                <td class="align-middle white-space-nowrap">
               
                </td>
            </tr>
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-0" disabled="disabled" checked="checked"/>
                    <label class="custom-control-label" for="checkbox-0"></label>
                </div>
                </td>
                <th class="align-middle">Level 5</th>
                <td class="align-middle">200</td>
                <td class="align-middle">100 K=kr</td>
                <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                </td>
                <td class="align-middle text-right">99 kr</td>
                <td class="align-middle white-space-nowrap">
               
                </td>
            </tr>
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-0" disabled="disabled" checked="checked"/>
                    <label class="custom-control-label" for="checkbox-0"></label>
                </div>
                </td>
                <th class="align-middle">Level 6</th>
                <td class="align-middle">200</td>
                <td class="align-middle">100 K=kr</td>
                <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                </td>
                <td class="align-middle text-right">99 kr</td>
                <td class="align-middle white-space-nowrap">
               
                </td>
            </tr>
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-0" disabled="disabled" checked="checked" />
                    <label class="custom-control-label" for="checkbox-0"></label>
                </div>
                </td>
                <th class="align-middle">Level 7</th>
                <td class="align-middle">200</td>
                <td class="align-middle">100 K=kr</td>
                <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                </td>
                <td class="align-middle text-right">99 kr</td>
                <td class="align-middle white-space-nowrap">
               
                </td>
            </tr>
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-0" disabled="disabled" checked="checked"/>
                    <label class="custom-control-label" for="checkbox-0"></label>
                </div>
                </td>
                <th class="align-middle">Level 8</th>
                <td class="align-middle">200</td>
                <td class="align-middle">100 K=kr</td>
                <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                </td>
                <td class="align-middle text-right">99 kr</td>
                <td class="align-middle white-space-nowrap">
               
                </td>
            </tr>
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-0" disabled="disabled" checked="checked"/>
                    <label class="custom-control-label" for="checkbox-0"></label>
                </div>
                </td>
                <th class="align-middle">Level 9</th>
                <td class="align-middle">200</td>
                <td class="align-middle">100 K=kr</td>
                <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                </td>
                <td class="align-middle text-right">99 kr</td>
                <td class="align-middle white-space-nowrap">
               
                </td>
            </tr>
            <tr class="btn-reveal-trigger">
                <td class="align-middle">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-0" disabled="disabled" checked="checked"/>
                    <label class="custom-control-label" for="checkbox-0"></label>
                </div>
                </td>
                <th class="align-middle">Level 10</th>
                <td class="align-middle">200</td>
                <td class="align-middle">100 K=kr</td>
                <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                </td>
                <td class="align-middle text-right">99 kr</td>
                <td class="align-middle white-space-nowrap">
               
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>
<?php $this->load->view("layouts_after_login/footer") ?>