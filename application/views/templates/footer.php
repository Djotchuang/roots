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
<script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
<script>
	$(document).ready(function() {

		// Disable search button and enable on keydown
		$(".search-button").attr('disabled', true);

		$(".search-input").keypress(function() {
			$(".search-button").attr('disabled', false);
		});

		// Hide comment and show when comment-heading is clicked
		$("#comment-div").hide();

		$('.comment-heading').click(function() {

			var iteration = $(this).data('iteration') || 1

			switch (iteration) {
				case 1:
					$("#comment-div").show()
					break;

				case 2:
					$("#comment-div").hide()
					break;
			}

			iteration++;

			if (iteration > 2) iteration = 1
			$(this).data('iteration', iteration)
		});

		// Hide comment and show when comment div is clicked on index page
		$('.post-content').each(function() {
			let index_comment_details = $(this).find(".index-comment-details");
			index_comment_details.hide();

			let index_comment = $(this).find(".index-comment");

			index_comment.click(function() {

				var iteration = $(this).data('iteration') || 1

				switch (iteration) {
					case 1:
						index_comment_details.show();
						index_comment_details.scrollTop($('.index-comment-details')[0].scrollHeight);
						break;

					case 2:
						index_comment_details.hide();
						break;
				}

				iteration++;

				if (iteration > 2) iteration = 1
				$(this).data('iteration', iteration)
			});
		});

		// Handles likes
		function likes() {
			let nlikes = 1;
			likeText = " Like"

			$('.post-content').each(function() {
				let like = $(this).find('.like');
				let like_text_p = like.find('p');
				let nclicks = 0;

				if (nlikes > 1) likeText = " Likes";
				like_text_p.text(nlikes + likeText);

				like.click(function() {
					nclicks++;

					if (nclicks % 2 == 0) nlikes--;
					else if (nclicks % 2 == 1) nlikes++;

					like_text_p.text(nlikes + likeText);
					like.css({
						'color': '#18bc9c'
					});
				});
			});
		}

		likes();


		checkMultipleAvatar('.post-content');
		checkMultipleAvatar('.nearby-sidebar');
		checkAvatar('.sidebar1');

		function checkAvatar($parentDiv) {
			var avatar_image = $($parentDiv).find('.avatar-image')
			var attrib = avatar_image.attr('src');
			console.log(attrib);
			if (attrib == '') {
				avatar_image.attr('src', '<?= base_url() ?>assets/images/avatar/noimage.jpg');
			}
			console.log(attrib);
		}

		function checkMultipleAvatar($parentDiv) {

			$($parentDiv).each(function() {
				var avatar_image = $(this).find('.avatar-image')
				var attrib = avatar_image.attr('src');
				console.log(attrib);
				if (attrib == '') {
					avatar_image.attr('src', '<?= base_url() ?>assets/images/avatar/noimage.jpg');
				}
				// console.log(attrib);
			});
		}

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
	});

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
</script>
</body>

</html>