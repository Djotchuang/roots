<div class="container" id="profile-container">
    <div class="row m-y-2">
        <div class="col-lg-8 push-lg-4">
        <?php foreach ($profiles as $profile): ?>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active" id="nav-link">Profile</a>
                </li>
                <?php if ($this->session->userdata('user_id') == $profile['id']): ?>
                <li class="nav-item">
                    <a href="" data-target="#messages" data-toggle="tab" class="nav-link" id="nav-link">Messages</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link" id="nav-link">Edit</a>
                </li>
            <?php endif; ?>
            </ul>
            <div class="tab-content p-b-3">
                <div class="tab-pane active" id="profile">
                    <h3 class="m-y-2"><strong><?=$profile['username']."'s"?> &nbsp; Profile</strong></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-bold"><strong>About</strong></h6>
                            <p>
                             <?=$profile['aboutme'];?>
                            </p>
                            <h6><strong>Hobbies</strong></h6>
                            <p>
                            <?=$profile['hobbies'];?>
                            </p>
                        </div>
                        <div class="col-md-12">
                            <h4 class="m-t-2"><span class="fa fa-clock-o ion-clock pull-xs-right"></span> Recent Activity</h4>
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                <?php if ($this->session->userdata('user_id') == $profile['id']): ?>
                <div class="tab-pane" id="messages">
                    <h4 class="m-y-2">Recent Messages &amp; Notifications</h4>
                    <div class="alert alert-info alert-dismissable">
                        <a class="panel-close close" data-dismiss="alert">×</a> This is an <strong>.alert</strong>. Use this to show important messages to the user.
                    </div>
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr>
                                <td>
                                   <span class="pull-xs-right font-weight-bold">3 hrs ago</span> Here is your a link to the latest summary report from the..
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="pull-xs-right font-weight-bold">Yesterday</span> There has been a request on your account since that was..
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="pull-xs-right font-weight-bold">9/10</span> Porttitor vitae ultrices quis, dapibus id dolor. Morbi venenatis lacinia rhoncus.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="pull-xs-right font-weight-bold">9/4</span> Vestibulum tincidunt ullamcorper eros eget luctus.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="edit">
                <?='<p class="alert alert-danger">' . validation_errors() . '</p>';?>
                    <h4 class="m-y-2">Edit Profile</h4>
                   <?=form_open('users/update');?>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Name</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="name" value="<?=$profile['name']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" name="email" value="<?=$profile['email']?>" required>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Occupation</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="occupation" value="<?=$profile['occupation']?>">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Address</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="address" value="<?=$profile['address']?>" placeholder="Street">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-3">
                                <input class="form-control" type="text" name="country" value="<?=$profile['country']?>" placeholder="Country">
                            </div>
                            <div class="col-lg-3">
                                <input class="form-control" type="text" name="city" value="<?=$profile['city']?>" placeholder="City">
                            </div>
                            <div class="col-lg-3">
                                <input class="form-control" type="text" name="state" value="<?=$profile['state']?>" placeholder="State">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">About Me</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="aboutme" placeholder="Write something you want others to see." value="<?=$profile['aboutme']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Hobbies</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="hobbies" placeholder="Write something you want others to see." value="<?=$profile['hobbies']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Time Zone</label>
                            <div class="col-lg-9">
                                <select id="user_time_zone" name="timezone" class="form-control" size="0" value="<?=$profile['timezone']?>">
                                    <option value="Hawaii">(GMT-10:00) Hawaii</option>
                                    <option value="Alaska">(GMT-09:00) Alaska</option>
                                    <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                    <option value="Arizona">(GMT-07:00) Arizona</option>
                                    <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                    <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                    <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                    <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Username</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="username" value="<?=$profile['username']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">New Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" name="password" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
              <?php endif;?>
            </div>
        </div>
        <div class="col-lg-4 pull-lg-8 text-xs-center">
            <img id="user-avatar" src="<?=$profile['avatar'];?>" id="avatar" class="m-x-auto img-fluid img-thumbnail" alt="avatar">
           <?php if ($this->session->userdata('user_id') == $profile['id']): ?>
            <?=form_open_multipart('users/upload')?>
            <label class="custom-file">
                <input type="file" name="userfile" size="20" id="insert_image" class=" form-group btn btn-primary">
            </label>
          </form>
          <?else : ?>
          <button name="<?=$profile['username'];?>" id="msg_btn" style="margin-top: .8em; font-size: .9em" class="btn btn-primary">Send <span style="font-weight:bold; font-size: 1.2em;"><?=$profile['username'];?></span> a Message <ion-icon style="font-size:1.2em !important; margin-bottom:-.2em !important" name="mail-outline"></ion-icon> </button>
          <?php endif;?>
        </div>
        <?php endforeach;?>

        <div class="modal" id="insertimageModal">
          <div class="modal-dialog" role="document">
           <div class="modal-content">
            <div class="modal-header">
             <h5 class="modal-title">Crop and Insert Image</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
              </button>
            </div>
           <div class="modal-body">
               <div class="row">
                   <div class="col-md-8 text-center">
                       <div id="image_demo" style="width:350px; margin-top:30px"></div>
                       <button class="btn btn btn-success crop_image"> Crop & Insert Image</button>
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Submit and Close</button>
                       </div>
                   </div>
               </div>
          </div>
          <div class="modal-footer">
           
         </div>
        </div>
       </div>
      </div>
    </div>
</div>
