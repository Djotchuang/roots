<div class="container">
    <?php foreach ($profiles as $profile) : ?>
        <div class="page-contents page-container" id="page-content">
            <div class="padding">
                <div class="row container d-flex justify-content-center">
                    <div class="card card-bordered" id="chat-card" data-id="<?= $profile['id'] ?>">
                        <div class="card-header" class="d-flex">
                            <div id="chat-avatar"></div>
                            <div id="chat-id"></div>
                            <h4 class="mr-auto card-title"><strong class="chat-box-title"></strong></h4>
                            <button class="close-Btn">close</button>
                        </div>
                        <div class="ps-container ps-theme-default ps-active-y" id="msg-content" style="overflow-y: scroll !important; height:400px !important;">
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
        <div class="col-lg-3 text-xs-center profile">
            <img src="<?= $profile['avatar']; ?>" class="m-x-auto img-fluid img-thumbnail avatar avatar-image" alt="avatar">
            <?php if ($this->session->userdata('user_id') == $profile['id']) : ?>
                <?= form_open_multipart('users/upload') ?>
                <label class="upload-file">
                    <input type="file" name="userfile" size="20" id="insert_image" class="form-group btn btn-primary">
                </label>
                </form>
            <?php else : ?>
                <button name="<?= $profile['username']; ?>" id="msg_btn" class="btn btn-primary">
                    Send <span><?php echo ucfirst($profile['username']); ?></span> a message
                </button>
            <?php endif; ?>
        </div>

        <div class="col-lg-9">
            <?php foreach ($profiles as $profile) : ?>
                <br>
                <div class="about">
                    <div class="card-body text-center">
                        <h4 class="">Karl Djotchuang Tamo</h4>
                        <p class="">Software Engineer | Knowledge Miner | Data Scientist</p>
                        <p>Molyko, Buea - Cameroon</p>
                        <p>Interests: Football, Sports, Politics</p>
                        <p>Contact details: roots@gmail.com | (237) 677777777</p>
                    </div>
                </div>

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#timeline" data-toggle="tab" class="nav-link active">Timeline</a>
                    </li>
                    <?php if ($this->session->userdata('user_id') == $profile['id']) : ?>
                        <li class="nav-item">
                            <a href="" data-target="#messages" data-toggle="tab" class="nav-link" id="nav-link">Messages and Notifications</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" role="button" href="#" aria-haspopup="true" aria-expanded="false">
                                More
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="" data-target="#edit" data-toggle="tab">Edit Profile</a>
                                <a class="dropdown-item" href="" data-target="#activity" data-toggle="tab">Recent Activities</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content p-b-3">

                    <div class="tab-pane active" id="timeline">
                        <div class="row">
                            <div class="col-md-12">


                                <!-- <div class="post-div2">
                                    <?php foreach ($posts as $post) : ?>
                                        <div class="row post">
                                            <div class="col-md-5">
                                                <a href="<?php echo site_url('posts/' . $post['slug']); ?>">
                                                    <img class="post-thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
                                                </a>
                                            </div>

                                            <div class="col-md-7 post-content" id="post-<?= $post['pid'] ?>">
                                                <div class="post-top mb-2 d-flex justify-content-between">
                                                    <h5>
                                                        <a class="btn btn-full post-btn" href="<?php echo site_url('/countries/posts/' . $post['country_id']); ?>">
                                                            <?php echo $post['cname']; ?>
                                                        </a>
                                                    </h5>
                                                    <h5 class="ml-auto">
                                                        <a class="btn btn-full post-btn" href="<?php echo site_url('/categories/posts/' . $post['category_id']); ?>"> <?= $post['ca_name']; ?> </a>
                                                    </h5>
                                                </div>
                                                <a href="<?php echo site_url('/posts/' . $post['slug']); ?>">
                                                    <h4 class="post-title"><?php echo ucfirst($post['title']); ?></h4>
                                                </a>
                                                <p><?php echo word_limiter($post['body'], 20); ?></p>
                                                <hr class="separator">
                                                <div class="meta-data d-flex justify-content-between check">
                                                    <button class="like" id="lik-<?= $post['pid'] ?>" data-pid="<?= $post['pid'] ?>" data-id="<?= $post['id'] ?>">
                                                        <ion-icon name="thumbs-up-outline"></ion-icon>
                                                        <p class="mr-auto upvotes" id="upvotes-<?= $post['pid'] ?>"></p>
                                                    </button>
                                                    <button class="dislike" id="dis-<?= $post['pid'] ?>" data-pid="<?= $post['pid'] ?>" data-id="<?= $post['id'] ?>">
                                                        <ion-icon name="thumbs-down-outline"></ion-icon>
                                                        <p class="mr-auto downvotes" id="downvotes-<?= $post['pid'] ?>"></p>
                                                    </button>
                                                    <?php if ($this->session->userdata('logged_in')) : ?>
                                                        <button class="pin-post" id="pin-<?= $post['pid'] ?>" data-pid="<?= $post['pid'] ?>" data-id="<?= $post['id'] ?>" data-title="<?= $post['title'] ?>" data-slug="<?= $post['slug'] ?>">
                                                            <ion-icon name="eyedrop-outline"></ion-icon>
                                                            <p>Pin</p>
                                                        </button>
                                                    <?php endif; ?>
                                                    <div class="index-comment" data-id="<?= $post['pid']; ?>">
                                                        <ion-icon name="chatbubbles-outline"></ion-icon>
                                                        <p class="mr-auto" id="count-<?= $post['pid'] ?>"></p>
                                                    </div>
                                                    <div>
                                                        <p class="pull-right"><?php echo time_elapsed_string(strtotime($post['created_at'])); ?></p>
                                                    </div>
                                                </div>

                                                <div class="comment-details index-comment-details">
                                                    <div class="all-comments" id="comments-<?= $post['pid']; ?>">
                                                    </div>
                                                    <?php if ($this->session->userdata('logged_in')) : ?>
                                                        <?= form_open('comments/index_create/' . $post['pid']) ?>
                                                        <div class="form-group index-comment2">
                                                            <textarea name="body" class="md-textarea form-control index-comment-body" placeholder="comment"></textarea>
                                                            <button class=" index-comment-postbtn btn float-right" type="submit">post</button>
                                                        </div>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>
                                                <hr class="separator">

                                            </div>
                                            <div class="post-content post-creator">
                                                <span class="d-flex nviews">
                                                    <small class="d-flex">
                                                        <p>100</p>
                                                        <p>&nbsp;views</p>
                                                    </small>
                                                </span>
                                                <div class="meta-data d-flex">
                                                    <small>Posted by
                                                        <?php if ($this->session->userdata('logged_in')) : ?>
                                                            <a href="<?= base_url(); ?>users/fetch_user/<?= $post['id']; ?>">
                                                                <img src="<?php echo $post['avatar']; ?>" class="post-avatar avatar-image" alt="user profile image">
                                                                <?php echo ucfirst($post['username']); ?>
                                                            </a>
                                                        <?php else : ?>
                                                            <a href="<?= base_url(); ?>users/login">
                                                                <img src="<?php echo $post['avatar']; ?>" class="post-avatar avatar-image" alt="user profile image">
                                                                <?php echo ellipsize($post['username'], 10); ?>
                                                            </a>
                                                        <?php endif; ?>
                                                    </small>
                                                    <?php if ($this->session->userdata('user_id') == $post['id']) : ?>
                                                        <div class="chat-btn ml-auto">
                                                            <p>&nbsp;&nbsp;&nbsp;</p>
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="ml-auto user-trigger" data-id="<?= $post['id'] ?>" data-name="<?= $post['username'] ?>" data-avatar="<?= $post['avatar'] ?>">
                                                            <ion-icon class="m-1" name="mail-outline"></ion-icon>
                                                            <p>Chat with <strong class="chat-btn-txt"><?= ellipsize($post['username'], 10) ?></strong></p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="separator"><br>
                                    <?php endforeach; ?>
                                    <div class="pagination-links">
                                        <?php echo $this->pagination->create_links(); ?>
                                    </div>
                                </div> -->

                            </div>
                        </div>
                    </div>

                    <?php if ($this->session->userdata('user_id') == $profile['id']) : ?>
                        <div class="tab-pane" id="messages">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <?php foreach ($notifications as $notification) : ?>
                                                    <?php if ($this->session->userdata('user_id') == $notification['reciever_id']) : ?>
                                                        <td class="d-flex">
                                                            <!--<span class="pull-xs-right font-weight-bold"><?= $notification['time'] ?></span>--> &nbsp; <?= $notification['message'] ?>&nbsp;<strong><?= $notification['sender_name'] ?></strong>
                                                            <button class="ml-auto show-chat-box" data-id="<?= $notification['sender_id'] ?>" data-name="<?= $notification['sender_name'] ?>">view</button>
                                                            <button class="pull-right delete-not" data-id="<?= $notification['n_id'] ?>">delete</button>
                                                        </td>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="edit">
                            <h5 class="m-y-2">Edit Profile</h5>
                            <?= form_open('users/update'); ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label form-control-label">Name</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" name="name" value="<?= $profile['name'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label form-control-label">Email</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="email" name="email" value="<?= $profile['email'] ?>" required>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label form-control-label">Occupation</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" name="occupation" value="<?= $profile['occupation'] ?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label form-control-label">Address</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" name="address" value="<?= $profile['address'] ?>" placeholder="Street">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label form-control-label"></label>
                                <div class="col-lg-4 address-info">
                                    <input class="form-control" type="text" name="country" value="<?= $profile['country'] ?>" placeholder="Country">
                                </div>
                                <div class="col-lg-3 address-info">
                                    <input class="form-control" type="text" name="city" value="<?= $profile['city'] ?>" placeholder="City">
                                </div>
                                <div class="col-lg-3 address-info">
                                    <input class="form-control" type="text" name="state" value="<?= $profile['state'] ?>" placeholder="State">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label form-control-label">About Me</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" type="text" name="aboutme" placeholder="Write something you want others to see." value="<?= $profile['aboutme'] ?>"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label form-control-label">Hobbies</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" name="hobbies" placeholder="What are your hobbies? Separate them with commas" value="<?= $profile['hobbies'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label form-control-label">Username</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" name="username" value="<?= $profile['username']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label form-control-label">New Password</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="password" name="password" id="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label form-control-label"></label>
                                <div class="col-lg-10">
                                    <input type="reset" class="btn btn-danger" value="Cancel">
                                    <input type="submit" class="btn btn-primary" value="Save Changes">
                                </div>
                            </div>
                            </form>
                        </div>
                    <?php endif; ?>

                    <div class="tab-pane" id="activity">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="m-y-2">Recent Activities</h5>
                                <?php foreach ($activities as $activity) : ?>
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php if ($this->session->userdata('user_id') == $activity['id']) : ?>
                                                        <span class="pull-xs-right recent-activity">
                                                            <?= 'You ' . $activity['activity'] . ' ' . time_elapsed_string(strtotime($activity['created_at'])); ?></span>
                                                    <?php else : ?>
                                                        <span class="pull-xs-right recent-activity">
                                                            <?= $activity['username'] . ' ' . $activity['activity'] . ' ' . time_elapsed_string(strtotime($activity['created_at'])); ?></span>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


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
                                <div class="btns d-flex" style="width:350px;">
                                    <button class="btn btn btn-success crop_image"> Crop & Insert Image</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Submit and Close</button>
                                </div>
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