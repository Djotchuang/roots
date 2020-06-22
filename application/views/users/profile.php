<div class="container">
<?php foreach ($profiles as $profile): ?>
<div class="page-contents page-container" id="page-content">
		<div class="padding">
			<div class="row container d-flex justify-content-center">
				<div class="card card-bordered" id="chat-card" data-id="<?=$profile['id']?>">
					<div class="card-header" class="d-flex">
						<div id="chat-avatar"></div>
						<div id="chat-id"></div>
						<h4 class="mr-auto card-title"><strong class="chat-box-title"></strong></h4>
						<button class="close-Btn">close</button>
					</div>
					<div class="ps-container ps-theme-default ps-active-y" id="msg-content" style="overflow-y: scroll !important; height:400px !important;">
						<!-- <div class="media media-meta-day">Today</div>
						<div class="media media-chat media-chat-reverse">
							<div class="media-body">
								<p>Long time no see! Tomorrow office. will be free on sunday.</p>
								<p class="meta"><time datetime="2018">00:06</time></p>
							</div>
						</div> -->
					</div>
					<div id="write" class="publisher bt-1 border-light">
						<img class="chatbox-avatar avatar-xs" src="<?php echo base_url('/assets/images/avatar/noimage.jpg'); ?>" alt="...">
						<input class="publisher-input" id="chat_area" type="text" placeholder="Write something">
						<span class="publisher-btn file-group text-info">
							<i class="fa fa-paperclip file-browser"></i> <input type="file">
						</span>
						<a class="publisher-btn text-info" href="#" data-abc="true"><i class="fa fa-smile"></i></a>
						<button class="publisher-btn text-info" data-abc="true" id="chat-sub"><i class="fa fa-paper-plane"></i></button>
					</div>
				</div>
			</div>
		</div>
    </div>
    <?php endforeach ?>
    <div class="row my-2">
        <div class="col-lg-8 push-lg-4">
            <?php foreach ($profiles as $profile): ?>
                <br>
                <?php if ($this->session->userdata('user_id') == $profile['id']): ?>
                    <h3 class="profile-heading"><strong>My Profile</strong></h3>
                <?php else: ?>
                    <h5 class="profile-heading"><strong><?=ucfirst($profile['username']);?>'s Profile</strong></h5>
                <?php endif;?>
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
                    <?php endif;?>
                </ul>
                <div class="tab-content p-b-3">
                    <div class="tab-pane active" id="profile">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>About</h5>
                                <p>
                                    <?=$profile['aboutme'];?>
                                </p>
                                <h5>Hobbies</h5>
                                <p>
                                    <?=$profile['hobbies'];?>
                                </p>
                                    <h5>Recent Activity</h5>
                                    <?php foreach ($activities as $activity) : ?>
                                      <tbody>
                                      <table class="table table-hover table-striped">
                                         <tr>
                                          <td>
                                          <?php if ($this->session->userdata('user_id') == $activity['id']): ?>
                                           <span class="pull-xs-right font-weight-bold recent-activity">
                                               <?= 'You ' .$activity['activity'] . ' ' .time_elapsed_string($activity['created_at'], true) ?></span>
                                           <?php else: ?>
                                           <span class="pull-xs-right font-weight-bold recent-activity">
                                               <?=$activity['username'] . ' ' .$activity['activity'] . ' ' . time_elapsed_string($activity['created_at'])?></span>
                                          </td>
                                         </tr>
                                         <?php endif ?>
                                         <?endforeach?>
                                      </tbody>
                                    </table>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <?php if ($this->session->userdata('user_id') == $profile['id']): ?>
                        <div class="tab-pane" id="messages">
                            <h5>Recent Messages &amp; Notifications</h5>
                            <!-- <div class="alert alert-info alert-dismissable">
                                <a class="panel-close close" data-dismiss="alert">×</a> This is an <strong>.alert</strong>. Use this to show important messages to the user.
                            </div> -->
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <tr>
                                        <?php foreach($notifications as $notification) : ?>
                                        <?php if($this->session->userdata('user_id') == $notification['reciever_id']) :?>
                                        <td class="d-flex">
                                            <span class="pull-xs-right font-weight-bold"><?=$notification['time']?></span> &nbsp; <?=$notification['message']?>&nbsp;<strong><?=$notification['sender_name']?></strong>
                                            <button class="ml-auto show-chat-box" data-id="<?=$notification['sender_id']?>" data-name="<?=$notification['sender_name']?>">View</button>
                                            <button class="pull-right delete-not" data-id="<?=$notification['n_id']?>">delete</button>
                                        </td>
                                        <?php endif ?>
                                        <?php endforeach ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="edit">
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
                                    <input type="reset" class="btn btn-danger" value="Cancel">
                                    <input type="submit" class="btn btn-primary" value="Save Changes">
                                </div>
                            </div>
                            </form>
                        </div>
                    <?php endif;?>
                </div>
        </div>
        <div class="col-lg-4 pull-lg-8 text-xs-center profile">
            <img src="<?=$profile['avatar'];?>" class="m-x-auto img-fluid img-thumbnail avatar avatar-image" alt="avatar">
            <?php if ($this->session->userdata('user_id') == $profile['id']): ?>
                <?=form_open_multipart('users/upload')?>
                <label class="upload-file">
                    <input type="file" name="userfile" size="20" id="insert_image" class="form-group btn btn-primary">
                </label>
                </form>
            <?php else: ?>
                <button name="<?=$profile['username'];?>" id="msg_btn" class="btn btn-primary">Send
                    <span><?=$profile['username'];?></span> a Message
                    <ion-icon name="mail-outline"></ion-icon>
                </button>
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
