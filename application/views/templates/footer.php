<!-- <div class="modal" id="chat_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php foreach ($profiles as $profile): ?>
				<div class="modal-header">
					<h4 class="modal-title" id="dynamic-title"> Chatting with <?=$profile['username'];?></h4>
				</div>
			<?php endforeach;?>
			<div class="modal-body">
				<!-- Chat Box-->


</div>
<script>
	CKEDITOR.replace('editor1');
</script>
<script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
<script>

</script>
<script>
	$(document).ready(function() {
		var chatInterval;
		var indexChatInterval;

		$('.delete-not').on('click', function ()
		{
			var notId = $(this).data('id');
			$.ajax({
				url: '<?=base_url()?>messages/delete_notification/' + notId,
				type: 'post',
				success: function (data)
				{
					window.location.reload(true);
				},
				error: function ()
				{
					console.log('error');
				}
			});
		});
		$('.show-chat-box').on('click', function ()
		{
				$('#page-content').show();
				var id = $(this).data('id');
				var name = $(this).data('name');
				$('.chat-box-title').html('Chatting with ' + name);
				chatInterval = setInterval(function ()
			    {
				$.ajax({
					url: '<?=base_url()?>/messages/get_messages/' + id,
					type: 'post',
					success: function (response)
					{
						$('#msg-content').html(response);
						console.log('success');
					},
					error: function () {
						console.log('error');
					}
				});
			}, 2000);
		});
		$('.close-Btn').on('click', function ()
			{
			    clearInterval(chatInterval);
			});
		$('#chat-sub').on('click', function ()
		{
		        var recieverId = $('.show-chat-box').data('id');
				var avatar = $('#reciever-avatar').val();
				var message = $('#chat_area').val();
				if (message != '') {
					$.ajax({
						url: '<?=base_url();?>messages/send_message',
						method: 'POST',
						data: {
							'message': message,
							'recieverId': recieverId
						},
						beforeSend: function() {
							$('#chat-submit').attr('disabled', 'disabled');
						},
						error: function() {
							console.log(recieverId + message)
						},
						success: function(data) {
							console.log('sucess');
							$('#chat-subm').attr('disabled', false);
								var output = '<div class="media media-chat media-chat-reverse">';
								output += '<div class="media-body">';
								output += '<p>'+ message + '</p>';
								output += '<p class="meta">' + new Date($.now()) + '</p>';
								output += '</div>';
								output += '</div>';
							$('#msg-content').append(output);
							$('#chat_area').val('');
						}
					});
				} else {
					alert('Chat is empty, Please Type Something in Chat box.');
				}
			});
		});

		function loading () {
			var output = '<div align="center"><br /><br /><br />';
			output += '<img src="<?=base_url();?>assets/images/loading.gif" /> Please wait...</div>';
			return output;
		}
		$('#page-content').hide();
			$('.user-trigger').on('click', function()
			{

				var id = $(this).data('id');
				console.log(id);
				var avatar = $(this).data('avatar');
				var name = $(this).data('name');
				var data = '<input type="hidden" id="reciever-id" value="' + id + '">';
				var image = '<input type="hidden" id="reciever-avatar" value="' + avatar + '">';
				$('.card-header .chat-box-title').html(name);
				$('#chat-id').html(data);
				$('#chat-avatar').html(image);
				$('#page-content').show();
				$.ajax({
					url: '<?=base_url()?>users/ajax_fetch_user/' + id,
					type: 'post',
					success: function (response) {
						$('.chat-data-items').append(response);
					},
					error: function () {
						console.log('error');
					}
				});
				var tid = $('#chat-card').data('id');
				indexChatInterval = setInterval(function ()
			    {
				$.ajax({
					url: '<?=base_url()?>/messages/get_messages/' + id,
					type: 'post',
					success: function (response)
					{
						$('#chat-content-' + tid).html(response);
						console.log('success');
					},
					error: function () {
						console.log('error');
					}
				});
			}, 2000);
			});
			$('.closeBtn').on('click', function ()
			{
			    clearInterval(indexChatInterval);
			});

		function getLikes () {
			$('.check').each(function() {
			var id = $(this).find($('.index-comment')).data('id');
			$.ajax({
				url: '<?=base_url()?>posts/get_likes/' + id,
				type: 'post',
				success: function (response)
				{
					$('#upvotes-' + id).text(response);
					console.log(response)
				},
				error: function ()
				{
					console.log('error');
				}
			});
		  });
		}
		getLikes();
		function getDisikes () {
			$('.check').each(function() {
			var id = $(this).find($('.index-comment')).data('id');
			$.ajax({
				url: '<?=base_url()?>posts/get_dislikes/' + id,
				type: 'post',
				success: function (response)
				{
					$('#downvotes-' + id).text(response);
				},
				error: function ()
				{
					console.log('error');
				}
			});
		  });
		}
		getDisikes();

		function getCommentCount () {
			$('.check').each(function() {
			var id = $(this).find($('.index-comment')).data('id');
			$.ajax({
				url: '<?=base_url()?>comments/get_comments_count/' + id,
				type: 'post',
				success: function (response) {
				  $('.index-comment').each(function(){
					$(this).find($('#count-' + id)).html(response);
			      });
				},
				error: function(){
		          console.log('error');
		        }
			});
		});
		}
		getCommentCount();
		$('.index-comment').on('click', function () {
			var id = $(this).data('id');
            $.ajax({
	        	url: '<?=base_url()?>comments/get_comments',
	        	type: 'post',
				data: {id:id},
				beforeSend: function () {
					$('#comments-' + id).html(loading());
				},
	         	success: function(response) {
					 $('#comments-' +id).html(response);
					 checkMultipleAvatar('.comment-info');
	         	},
	          	error: function(){
		          console.log('error');
		        }
	             });
		});
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
		function showComments() {
			$('.post-content').each(function() {
				let index_comment_details = $(this).find(".index-comment-details");
				index_comment_details.hide();

				let index_comment = $(this).find(".index-comment");

				index_comment.click(function() {

					var iteration = $(this).data('iteration') || 1

					switch (iteration) {
						case 1:
							index_comment_details.show();
							index_comment_details.scrollTop($(index_comment_details).height());
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
		}

		showComments();

		// Show chats on click
		function showChats() {
			let nchats = 'Chats';
			$('.chats-title h6 strong').text('Your ' + nchats );
			$('.chats-title p').hide();
			$('.chat-data').hide();

			$('.chats-title').click(function() {
				var iteration = $(this).data('iteration') || 1

				switch (iteration) {
					case 1:
						$('.chats-title h6 strong').text('Chats');
						$('.chats-title p').show();
						$('.chat-data').show();
						$('.chat-data').css('{padding: 0}');
						$('.chats-title').css('{margin-bottom: 0.5rem}');
						break;

					case 2:
						$('.chats-title h6 strong').text('Your ' + nchats);
						$('.chats-title p').hide();
						$('.chat-data').hide();
						break;
				}

				iteration++;

				if (iteration > 2) iteration = 1
				$(this).data('iteration', iteration)
			});
		}

		showChats();

		// Show chats on click
		function showChatBox() {
			$('.chat-data-items').click(function() {
				$('#page-content').show();
			});
		}

		showChatBox();

		// Show specific chat on click
		function showSpecificChat() {
			// Close button to close chat session
			$('.closeBtn').click(function() {
				$('#page-content').hide();
			});

			$('.card-header').click(function() {
				var iteration = $(this).data('iteration') || 1
				var id = $('#chat-card').data('id');


				switch (iteration) {
					case 1:
						$('#chat-content-' + id).hide();
						$('#write').hide();
						$('.card-header').css("padding", "0.35rem 1rem");
						$('.card').css({
							'border-top-left-radius': '8px',
							'border-top-right-radius': '8px',
							'width': '15rem'
						});
						break;

					case 2:
						$('#chat-content-' + id).show();
						$('#write').show();
						$('.card').css({
							'width': 'auto'
						});
						break;
				}

				iteration++;

				if (iteration > 2) iteration = 1
				$(this).data('iteration', iteration)
			});
		}

		showSpecificChat();

		// Handle Posts without Image
		function post() {
			$('.post').each(function() {
				let postImage = $(this).find('.post-thumbnail');
				let imageDiv = $(this).find('.col-md-5');
				let postContent = $(this).find('.post-content');

				if(postImage.attr('src') == '<?php echo site_url(); ?>assets/images/posts/') {
					console.log(postImage.attr('src'));
					imageDiv.remove();
					postContent.removeClass("col-md-7").addClass("col-md-12" );
				}
			});

			$('.post-data').each(function() {
				let postImage = $(this).find('.post-thumbnail');

				if(postImage.attr('src') == '<?php echo site_url(); ?>uploads/') {
					console.log(postImage.attr('src'));
					postImage.remove();
				}
			});
		}

		function view() {
			let postImage = $('.post-thumbnail');

			if(postImage.attr('src') == '<?php echo site_url(); ?>assets/images/posts/') {
				postImage.remove();
			}
		}

		post();
		view();

		// Handles likes
		$('.like').on('click', function ()
		{
			var postId = $(this).data('pid');
			var userId = $(this).data('id');
			$(this).attr('disabled', true);
			$.ajax({
				url: '<?=base_url()?>posts/likes',
				type: 'post',
				data: {postId:postId, userId:userId},
				success: function (response)
				{
					$('#upvotes-' + postId).text(response);
				},
				error: function ()
				{
					console.log('error');
				}
			});
		});
		$('.dislike').on('click', function ()
		{
			var postId = $(this).data('pid');
			var userId = $(this).data('id');
			$(this).attr('disabled', true);
			$.ajax({
				url: '<?=base_url()?>posts/dislikes',
				type: 'post',
				data: {postId:postId, userId:userId},
				success: function (response)
				{
					$('#downvotes-' + postId).text(response);
					console.log(likes);
				},
				error: function ()
				{
					console.log('error');
				}
			});
		});
		$('.pin-post').on('click', function ()
		{
			var postId = $(this).data('pid');
			var postTitle = $(this).data('title');
			var postSlug = $(this).data('slug');
			$.ajax({
				url: '<?=base_url()?>posts/get_pin_post/' + postId,
				type: 'post',
				data: {
					postTitle:postTitle, postSlug:postSlug
				},
				dataType: 'json',
				success: function (response)
				{
					$output = '<div class="post-info">';
					$output += '<a href="' + response.slug + '">';
					$output += '<h6 class="post-title">' + response.title + '</h6>';
					$output += '</a></div>';
					$output += '<div class="meta-data d-flex justify-content-between">'
					$output += ' <button class="ml-auto unpin-post" data-id="' + id + '">unpin</button>';
					$output += '<p class="ml-auto">' + new Date($.now()) + '&nbsp </p>';
					$output += '</div><hr class="separator">';
					$('#pin_post').prepend($output);
					console.log(response);
				},
				error: function ()
				{
					console.log('error');
				}
			});
		});
		$('.unpin-post').on('click', function ()
		{
			var id = $(this).data('id');
			$.ajax({
				url: '<?=base_url()?>posts/delete_pin_post/' + id,
				type: 'post',
				success:function (data)
				{
					window.location.reload(true);
				}
			});
		});
		// Check Avatars

		function checkAvatar($parentDiv) {
			var avatar_image = $($parentDiv).find('.avatar-image')
			var attrib = avatar_image.attr('src');
			if (attrib == '') {
				avatar_image.attr('src', '<?=base_url()?>assets/images/avatar/noimage.jpg');
			}
		}

		function checkMultipleAvatar($parentDiv) {

			$($parentDiv).each(function() {
				var avatar_image = $(this).find('.avatar-image')
				var attrib = avatar_image.attr('src');
				if (attrib == '') {
					avatar_image.attr('src', '<?=base_url()?>assets/images/avatar/noimage.jpg');
				}
			});

		}
		var id = $('.index-comment').data('id');


		checkAvatar('.view-content .meta-data');
		checkMultipleAvatar('.profile');
		checkMultipleAvatar('.meta-data');
		checkMultipleAvatar('.nearby-meta-data');
		checkMultipleAvatar('.comment-info');
		checkAvatar('.chat-data-info');

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
					url: '<?=base_url()?>users/upload',
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
						window.location.reload(true);
					}
				});
			});
		});

	$('#input-form').on('click', function() {
		$('#search-submit').attr('disabled', false);
	});

	$('#chat-submit').on('click', function() {
		var id = $('#chat-card').data('id');
		var recieverId = $('#reciever-id').val();
		var avatar = $('#reciever-avatar').val();
		var message = $('#chat_msg_area').val();
		console.log(recieverId);
		if (message != '') {
			$.ajax({
				url: '<?=base_url();?>messages/send_message',
				method: 'POST',
				data: {
					'message': message,
					'recieverId': recieverId
				},
				beforeSend: function() {
					$('#chat-submit').attr('disabled', 'disabled');
				},
				error: function() {
					console.log(recieverId + message)
				},
				success: function(data) {
					console.log('sucess');
					$('#chat-submit').attr('disabled', false);
					var output = '<div class="media media-chat media-chat-reverse">';
						output += '<div class="media-body">';
						output += '<p>'+ message + '</p>';
						output += '<p class="meta">' + new Date($.now()) + '</p>';
						output += '</div>';
						output += '</div>';
					$('#chat-content-' + id).append(output);
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