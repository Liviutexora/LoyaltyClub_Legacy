<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-3">
                <div class="row text-left justify-content-between align-items-center mb-2">
                    <div class="col-auto">
                        <h5 id="modalLabel"> <?=$this->lang->line("Register Register")?></h5>
                    </div>
                </div>
                <div class="card theme-wizard" data-controller="#wizard-controller" data-error-modal="#error-modal">
                    <div class="card-header bg-light pt-3 pb-2">
                        <ul class="nav justify-content-between nav-wizard">
                            <li class="nav-item"><a class="nav-link active font-weight-semi-bold" href="#bootstrap-wizard-tab1" data-toggle="tab"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-lock"></span></span></span><span class="d-none d-md-block mt-1 fs--1"><?=$this->lang->line("Register Account")?></span></a></li>
                            <li class="nav-item"><a class="nav-link font-weight-semi-bold" href="#bootstrap-wizard-tab2" data-toggle="tab"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-user"></span></span></span><span class="d-none d-md-block mt-1 fs--1"><?=$this->lang->line("Register Account Info")?></span></a></li>
                            <li class="nav-item"><a class="nav-link font-weight-semi-bold" href="#bootstrap-wizard-tab3" data-toggle="tab"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-thumbs-up"></span></span></span><span class="d-none d-md-block mt-1 fs--1"><?=$this->lang->line("Register Done")?></span></a></li>
                        </ul>
                    </div>
                    <div class="card-body py-4">
                        <div class="tab-content">
                            <div class="tab-pane active px-sm-3 px-md-5" id="bootstrap-wizard-tab1">
                                <form class="needs-validation" id="first-step-form" novalidate>
                                    <div class="form-group">
                                        <label for="account_type"><?=$this->lang->line('Register Account Type')?></label>
                                        <select class="form-control custom-select" id="account_type_input" name="account_type" required="required">
                                            <option value=""><?=$this->lang->line("Register Select account ...")?></option>
                                            <option value="private"><?=$this->lang->line('Register Account Type Private')?></option>
                                            <option value="company"><?=$this->lang->line('Register Account Type Company')?></option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane px-sm-3 px-md-5" id="bootstrap-wizard-tab2">
                                <div class="company_details">
                                    <form class="needs-validation" action="<?=site_url('register')?>" id="last-step-form-company" data-options='{"rules":{"confirmPassword":{"equalTo":"#wizard-password"}},"messages":{"confirmPassword":{"equalTo":"<?=$this->lang->line("Register Passwords didn&#39;t match")?>"},"terms":{"required":"You must accept terms and privacy policy"}}}' novalidate>
                                        <div id="save_result"></div>
                                        <div class="form-group">
                                            <label for="wizard-name"><?=$this->lang->line("Register Company Name")?> <span class="required-sign-label">*</span>:</label>
                                            <input class="form-control" type="text" name="name" placeholder="<?=$this->lang->line("Register Placeholder Company Name")?>" required="required" id="wizard-name" />
                                        </div>
                                        <div class="form-group">
                                            <label for="wizard-email"><?=$this->lang->line("Register Private Email")?> <span class="required-sign-label">*</span>:</label>
                                            <input class="form-control" type="email" name="email" placeholder="<?=$this->lang->line("Register Placeholder Email Address")?>" required="required" id="wizard-email" />
                                        </div>
                                        <div class="form-group">
                                            <label for="phone"><?=$this->lang->line("User Section Profile Label Phone")?> <span class="required-sign-label">*</span>:</label>
                                            <input class="form-control" placeholder="<?=$this->lang->line("User Section Profile Label Phone")?>" id="phone" pattern="^[0-9]*" required="required"  name="phone" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="wizard-name"><?=$this->lang->line("Register Company Organization Number")?> <span class="required-sign-label">*</span>:</label>
                                            <input class="form-control" type="text" name="cui" placeholder="<?=$this->lang->line("Register Placeholder Organization Number")?>" required="required" id="wizard-name" />
                                        </div>
                                        <div class="form-row">
                                            <div class="col-6">
                                                <div class="form-gorup">
                                                    <label for="wizard-password"><?=$this->lang->line("Register Password")?> <span class="required-sign-label">*</span>:</label>
                                                    <input class="form-control" type="password" name="password" placeholder="<?=$this->lang->line("Register Placeholder Password")?>" required="required" id="wizard-password" />
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="wizard-confirm-password"><?=$this->lang->line("Register Confirm Password")?> <span class="required-sign-label">*</span>:</label>
                                                    <input class="form-control" type="password" name="confirmPassword" placeholder="<?=$this->lang->line("Register Placeholder Confirm Password")?>" id="wizard-confirm-password" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-12">
                                                    <div class="form-row">
                                                        <div class="col-12">
                                                            <label for="wizard-name" class="pull-left"><?=$this->lang->line("Register Sponsor")?> <span class='fas fa-info-circle' data-toggle="tooltip" data-placement="top" title="<?=$this->lang->line("Registration Sponsor Info")?>"></span></label>
                                                            <input class="form-control pull-left" type="text" name="sponsor" placeholder="<?=$this->lang->line("Register Placeholder Sponsor")?>" id="wizard-sponsor" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="wizard-checkbox-company" type="checkbox" name="terms" required="required" />
                                            <label class="custom-control-label" for="wizard-checkbox-company"><?=$this->lang->line("Register Terms Label Company")?></label>
                                        </div>
                                    </form>
                                </div>
                                <div class="private_details hidde">
                                    <form class="needs-validation" action="<?=site_url('register')?>" id="last-step-form-private" data-options='{"rules":{"confirmPassword":{"equalTo":"#wizard-password-private"}},"messages":{"confirmPassword":{"equalTo":"<?=$this->lang->line("Register Passwords didn&#39;t match")?>"},"terms":{"required":"You must accept terms and privacy policy"}}}' novalidate>
                                        <div id="save_result"></div>
                                        <div class="form-group">
                                            <label for="wizard-name"><?=$this->lang->line("Register Private Name")?> <span class="required-sign-label">*</span>:</label>
                                            <input class="form-control" type="text" name="name" placeholder="<?=$this->lang->line("Register Placeholder Username")?>" required="required" id="wizard-name" />
                                        </div>
                                        <div class="form-group">
                                            <label for="wizard-email"><?=$this->lang->line("Register Private Email")?> <span class="required-sign-label">*</span>:</label>
                                            <input class="form-control" type="email" name="email" placeholder="<?=$this->lang->line("Register Placeholder Email Address")?>" required="required" id="wizard-email" />
                                        </div>
                                        <div class="form-group">
                                            <label for="phone"><?=$this->lang->line("User Section Profile Label Phone")?> <span class="required-sign-label">*</span>:</label>
                                            <input class="form-control" placeholder="<?=$this->lang->line("User Section Profile Label Phone")?>" id="phone" required="required" pattern="^[0-9]*" name="phone" type="text">
                                        </div>
                                        <div class="form-row">
                                            <div class="col-6">
                                                <div class="form-gorup">
                                                    <label for="wizard-password"><?=$this->lang->line("Register Password")?> <span class="required-sign-label">*</span>:</label>
                                                    <input class="form-control" type="password" name="password" placeholder="<?=$this->lang->line("Register Placeholder Password")?>" required="required" id="wizard-password-private" />
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="wizard-confirm-password"><?=$this->lang->line("Register Confirm Password")?> <span class="required-sign-label">*</span>:</label>
                                                    <input class="form-control" type="password" name="confirmPassword" placeholder="<?=$this->lang->line("Register Placeholder Confirm Password")?>" id="wizard-confirm-password-private" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-12">
                                                    <div class="form-row">
                                                        <div class="col-12">
                                                            <label for="wizard-name" class="pull-left"><?=$this->lang->line("Register Sponsor")?> <span class='fas fa-info-circle' data-toggle="tooltip" data-placement="top" title="<?=$this->lang->line("Registration Sponsor Info")?>"></span></label>
                                                            <input class="form-control pull-left" type="text" name="sponsor" placeholder="<?=$this->lang->line("Register Placeholder Sponsor")?>" id="wizard-sponsor" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="wizard-checkbox-private" type="checkbox" name="terms" required="required" />
                                            <label class="custom-control-label" for="wizard-checkbox-private"><?=$this->lang->line("Register Terms Label Private")?></label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane px-sm-3 px-md-5" id="bootstrap-wizard-tab3">
                                    <h4 class="mb-1"><?=$this->lang->line("Your account is all set!")?></h4>
                                    <p><?=$this->lang->line("Now you can access to your account")?></p><a class="btn btn-primary px-5 my-3" href="<?=site_url("/")?>"><?=$this->lang->line("Go to Home Page")?></a>
                                <input type="hidden" id="csrf" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer card-footer-register bg-light" id="wizard-controller">
                        <div class="px-sm-3 px-md-5">
                            <ul class="pager wizard list-inline mb-0">
                                <li class="previous">
                                    <button class="btn btn-link pl-0" type="button" style="display: none;"><span class="fas fa-chevron-left mr-2" data-fa-transform="shrink-3"></span><?=$this->lang->line('Registration Prev')?></button>
                                </li>
                                <li class="next"><a class="btn btn-primary px-5 px-sm-6" href="#"><?=$this->lang->line('Registration Next')?><span class="fas fa-chevron-right ml-2" data-fa-transform="shrink-3"> </span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>