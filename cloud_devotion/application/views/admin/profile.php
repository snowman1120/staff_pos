<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user-circle"></i> プロフィール
        <small>情報変更 </small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->

            <div class="col-md-12">

                <div class="box">
                <?php
                $error = $this->session->flashdata('error');
                if($error)
                {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if($success)
                {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

                <?php
                $noMatch = $this->session->flashdata('nomatch');
                if($noMatch)
                {
                    ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('nomatch'); ?>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
                <form action="<?php echo admin_url() ?>profile" method="post" id="editProfile" role="form">
                    <input type="hidden" name="mode" value="save">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="admin_name">管理者名</label>
                                    <input type="text" class="form-control" id="admin_name" name="admin_name" value="<?php echo set_value('admin_name', $admin['admin_name']); ?>" maxlength="128" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="admin_email">メールアドレス</label>
                                    <input type="text" class="form-control" id="admin_email" name="admin_email" value="<?php echo set_value('admin_email', $admin['admin_email']); ?>">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="old_password">現在のパスワード：</label>
                                    <input type="password" class="form-control" id="old_password" placeholder="パスワード" name="old_password" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_password">新しいパスワード：</label>
                                    <input type="password" class="form-control" id="new_password" placeholder="" name="new_password" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_password_confirm">新しいパスワード（確認）：</label>
                                    <input type="password" class="form-control" id="new_password_confirm" placeholder="" name="new_password_confirm" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="保存" />
                    </div>
                </form>
                </div>

            </div>
        </div>    
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>