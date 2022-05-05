<?php $this->load->view("layouts_after_login/header") ?>
<div class="row no-gutters">
    <div class="col-lg-12">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0"><?=$this->lang->line("Company Section Company Details Label Edit Company Details")?></h5>
            </div>
            <div class="card-body bg-light">
                <div id="save-result"></div>
                <form action="<?=site_url('company-details')?>" method="post" id="edit-company-details-form" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="companyName"><?=$this->lang->line("Company Section Company Details Label Company Name")?></label>
                            <input class="form-control" value="<?=$companyDetails['companyName']?>" required="required" id="companyName" name="companyName" type="text">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="addedBy"><?=$this->lang->line("Company Section Company Details Label Contact Name")?></label>
                            <input class="form-control" value="<?=$companyDetails['addedBy']?>" disabled="disabled" id="addedBy" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="description"><?=$this->lang->line("Company Section Company Details Label Description")?></label>
                            <textarea class="form-control" id="description" required="required" rows="3" name="description" maxlength="300"><?=$companyDetails['description']?></textarea>
                            <div class="description-nr-chars-container"><?=$this->lang->line("Company Description Nr. Chars Label")?> <span class="current_nr_chars"><?=strlen($companyDetails['description'])?></span>/<span class="max_nr_chars">300</span></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cui"><?=$this->lang->line("Company Section Company Details Label Company CUI")?></label>
                            <input class="form-control" value="<?=$companyDetails['cui']?>" id="cui" name="cui" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nr_orc"><?=$this->lang->line("Company Section Company Details Label Company Nr. ORC")?></label>
                            <input class="form-control" value="<?=$companyDetails['nr_orc']?>" id="nr_orc" name="nr_orc" type="text">
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="iban"><?=$this->lang->line("Company Section Company Details Label Company IBAN")?></label>
                            <input class="form-control" value="<?=$companyDetails['iban']?>" id="iban" name="iban" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bank"><?=$this->lang->line("Company Section Company Details Label Company Bank")?></label>
                            <input class="form-control" value="<?=$companyDetails['bank']?>" id="bank" name="bank" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone"><?=$this->lang->line("Company Section Company Details Label Company Phone")?></label>
                            <input class="form-control" value="<?=$companyDetails['phone']?>" pattern="^[0-9]*" id="phone" name="phone" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website"><?=$this->lang->line("Company Section Company Details Label Company Website")?></label>
                            <input class="form-control" value="<?=$companyDetails['website']?>" id="website" name="website"  type="url">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="google_maps_url"><?=$this->lang->line("Company Section Company Details Label Google Maps Url")?></label>
                            <input class="form-control" value="<?=$companyDetails['google_maps_url']?>" id="google_maps_url" name="google_maps_url"  type="url">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="main-activity-domain"><?=$this->lang->line("Company Section Company Details Label Company Main Activity Domain")?></label>
                            <select class="form-control" id="main-activity-domain" name="main-activity-domain" required>
                                    <option></option>
                                <?php foreach ($allActivities as $activity) { ?>
                                    <option value="<?=$activity['id']?>" <?=($activity['id'] == $mainActivityDomain ? "selected='selected'": "")?>><?=ucwords($activity['titlu_eng'])?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="activity-domain"><?=$this->lang->line("Company Section Company Details Label Company Additionals Activity Domains")?></label>
                            <select multiple class="form-control" id="activity-domain" name="activity-domain[]" size="8">
                                <?php foreach ($allActivities as $activity) { ?>
                                        <option value="<?=$activity['id']?>" <?=(in_array($activity['id'],$companyActivitiesIds) ? "selected='selected'": "")?>><?=ucwords($activity['titlu_eng'])?></option>
                                <?php } ?>
                            </select>
                            <p><?=$this->lang->line('To Select Multiple Values Label Multiselect')?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card-header col-md-12">
                        <h5 class="mb-0"><?=$this->lang->line("Company Section Company Details Label Edit Company Details Address")?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="country"><?=$this->lang->line("Company Section Company Details Label Company Country")?></label>
                            <select class="form-control" id="country" name="country">
                                <?php foreach ($getAllCountries as $country) { ?>
                                    <option value="<?=$country['id']?>"><?=$country['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="district"><?=$this->lang->line("Company Section Company Details Label Company District")?></label>
                            <select multiple class="form-control" id="district" name="district[]" required="required">
                                <?php foreach ($getAllCountryZones as $countryZone) { ?>
                                    <option value="<?=$countryZone['id']?>" <?=(in_array($countryZone['id'],$companyCountryZonesIds) ? "selected='selected'": "")?>><?=$countryZone['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="locality"><?=$this->lang->line("Company Section Company Details Label Company Locality")?></label>
                            <input class="form-control" value="<?=$companyDetails['locality']?>" required="required" id="locality" name="locality" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="street"><?=$this->lang->line("Company Section Company Details Label Company Street")?></label>
                            <input class="form-control" value="<?=$companyDetails['street']?>" id="street" name="street" type="text">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank"><?=$this->lang->line("Company Section Company Details Label Company Number")?></label>
                            <input class="form-control" value="<?=$companyDetails['number']?>" pattern="^[0-9]*" id="number" name="number" type="text">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bank"><?=$this->lang->line("Company Section Company Details Label Company Postal Code")?></label>
                            <input class="form-control" value="<?=$companyDetails['postal_code']?>" id="postal_code" name="postal_code" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary" onclick="submit_form('#edit-company-details-form', '#save-result')" type="submit"><?=$this->lang->line('User Section Profile Label Profile Update Info')?> </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("layouts_after_login/footer",array("jsFiles" => array('company.js'))) ?>