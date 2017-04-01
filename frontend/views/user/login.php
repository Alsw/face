<?php

use yii\helper\Html;

$this->title = 'login';
?>
<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="index.html"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">Login</li>
            </ul>
        </div>
        <div class="services">
            <div class="col-sm-5 login_left">
                <form id="login-form" action="/index.php?r=user/login" method="post" role='form'>
                    <div class="form-item form-type-textfield form-item-name">
                        <label for="edit-name">Username <span class="form-required" title="This field is required.">*</span></label>
                        <input type="text" id="edit-name" name="name" value="" size="60" maxlength="60" class="form-text required">
                    </div>
                    <div class="form-item form-type-password form-item-pass">
                        <label for="edit-pass">Password <span class="form-required" title="This field is required.">*</span></label>
                        <input type="password" id="edit-pass" name="pass" size="60" maxlength="128" class="form-text required">
                    </div>
                    <div class="form-actions">
                        <input type="submit" id="edit-submit" name="op" value="Log in" class="btn_1 submit">
                    </div>
                </form>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>