<div class="modal" id="chat_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php foreach ($profiles as $profile) : ?>
				<div class="modal-header">
					<h4 class="modal-title" id="dynamic-title"> Chatting with <?= $profile['username']; ?></h4>
				</div>
			<?php endforeach; ?>
			<div class="modal-body">
				<!-- Chat Box-->
				<div class="col-12 px-0">
					<div id="chat_box" class="px-4 py-5 chat-box bg-white">
						<!-- Sender Message-->
						<div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
							<div id="chat_area" class="media-body ml-3">
								<div class="bg-light rounded py-2 px-3 mb-2">
									<p class="text-small mb-0 text-muted">Test which is a new approach all solutions</p>
								</div>
								<p class="small text-muted">12:00 PM | Aug 13</p>
							</div>
						</div>
						<!-- Reciever Message-->
						<div class="media w-50 ml-auto mb-3">
							<div class="media-body">
								<div class="bg-primary rounded py-2 px-3 mb-2">
									<p class="text-small mb-0 text-white">Test which is a new approach to have all solutions</p>
								</div>
								<p class="small text-muted">12:00 PM | Aug 13</p>
							</div>
						</div>
						<!-- Typing area -->
						<form id="chat_form" class="bg-light">
							<div class="input-group">
								<input id="chat_msg_area" type="text" style="color:black;" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">

								<div class="input-group-append">
									<button id="button-addon2" type="submit" class="btn btn-primary">
										<ion-icon style="color:white !important; font-size:1.5em;" name="send-outline"></ion-icon>
									</button>
								</div>
							</div>
						</form>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

</div>
<script>
	CKEDITOR.replace('editor1');
</script>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<script>
	$(document).ready(function() {
		// Set flashdata to disappear after 3 seconds
		setTimeout(function() {
			$(".flash-data").remove();
		}, 3000); // 3 secs

		checkAvatar();
		$image_crop = $('#image_demo').croppie({
			enableExif: true,
			viewport: {
				width: 250,
				height: 250,
				type: 'square'
			},
			boundary: {
				width: 300,
				height: 300
			}
		});
		myUrl = 'users/upload/';
		$('#insert_image').on('change', function() {
			var reader = new FileReader();
			reader.onload = function(event) {
				$image_crop.croppie('bind', {
					url: event.target.result
				}).then(function() {
					console.log('jQuery bind complete');
				});
			}
			reader.readAsDataURL(this.files[0]);
			$('#insertimageModal').modal('show');
		});
		$('.crop_image').on('click', function(event) {
			$image_crop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function(response) {
				$.ajax({
					url: '<?= base_url() ?>users/upload',
					type: 'POST',
					data: {
						"image": response
					},

					error: function() {
						alert('Error Uploading Image. This may be due to a fault in your internet connection. Please try again later. Thanks');
					},

					success: function(data) {
						$('#insertimageModal').modal('hide');
						$('#insert_image').empty();
						alert('Thank you for Updating your Profile. Now Reload Web Page.');
					}
				});
			});
		});

		function checkAvatar() {
			var avatar_one = $('#user-avatar').attr('src');
			var avatar_two = $('#post-image-two').attr('src');
			var avatar_three = $('#post-image').attr('src');
			var attrib = $('#user-avatar');
			var attrib_two = $('#post-image-two');
			var attrib_three = $('#post-image');
			if (avatar_one == '') {
				attrib.attr('src', '<?= base_url() ?>/assets/images/posts/noimage.jpg')
			}

			if (avatar_two == '') {
				attrib_two.attr('src', '<?= base_url() ?>/assets/images/posts/noimage.jpg')
			}

			if (avatar_three == '') {
				attrib_three.attr('src', '<?= base_url() ?>/assets/images/posts/noimage.jpg')
			}
		}
		$('#input-form').on('click', function() {
			$('#search-submit').attr('disabled', false);
		});

		$('#msg_btn').on('click', function() {
			$('#chat_modal').modal('show');
			$('#button-addon2').attr('disabled', false);
		});
		$('#chat_form').on('submit', function() {
			var chat_msg = $('#chat_msg_area').val();
			if (chat_msg != '') {
				var reciever_name = $("#msg_btn").attr('name');
				$.ajax({
					url: "<?= base_url(); ?>" + "messages/send_message",
					type: 'post',
					data: {
						'message': chat_msg,
						'reciever_name': reciever_name
					},
					beforeSend: function() {
						$('#button-addon2').attr('disabled', 'disabled');
					},
					error: function() {
						alert(chat_msg);
					},
					success: function(data) {
						$('#button-addon2').attr('disabled', false);
						var html = '<div class="bg-light rounded py-2 px-3 mb-2">';
						html += '<p class="text-small mb-0 text-white">' + chat_msg + '</p>';
						html += '</div>';
						$('#chat_area').append(html);
						$('#chat_box').scrollTop($('#chat_box')[0].scrollHeight);
						$('#chat_msg_area').val('');
					}
				});
			} else {
				alert('Chat is empty, Please Type Something in Chat box.');
			}
		});
	});
</script>
</body>

</html>