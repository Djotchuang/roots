</div>
<script>
	CKEDITOR.replace('editor1');
</script>
<script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
<script>
	$('.newsfeed').hide();
	$(".loader").show();

	setTimeout(function() {
		$(".loader").hide();
		$('.newsfeed').show();
	}, 600);



	$(document).ready(function() {

		var chatInterval;
		var indexChatInterval;

		$('.delete-not').on('click', function() {
			var notId = $(this).data('id');
			$.ajax({
				url: '<?= base_url() ?>messages/delete_notification/' + notId,
				type: 'post',
				success: function(data) {
					window.location.reload(true);
				},
				error: function() {
					console.log('error');
				}
			});
		});

		$('.show-chat-box').on('click', function() {
			$('#page-content').show();
			var id = $(this).data('id');
			var name = $(this).data('name');
			$('.chat-box-title').html('Chatting with ' + name);
			chatInterval = setInterval(function() {
				$.ajax({
					url: '<?= base_url() ?>/messages/get_messages/' + id,
					type: 'post',
					success: function(response) {
						$('#msg-content').html(response);
						console.log('success');
					},
					error: function() {
						console.log('error');
					}
				});
			}, 2000);
		});

		$('.close-Btn').on('click', function() {
			clearInterval(chatInterval);
		});

		$('#chat-sub').on('click', function() {
			var recieverId = $('.show-chat-box').data('id');
			var avatar = $('#reciever-avatar').val();
			var message = $('#chat_area').val();
			if (message != '') {
				$.ajax({
					url: '<?= base_url(); ?>messages/send_message',
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
						output += '<p>' + message + '</p>';
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

	function loading() {
		var output = '<div align="center"><br /><br /><br />';
		output += '<img src="<?= base_url(); ?>assets/images/loading.gif" /> Please wait...</div>';
		return output;
	}

	$('#page-content').hide();
	$('.user-trigger').on('click', function() {

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
			url: '<?= base_url() ?>users/ajax_fetch_user/' + id,
			type: 'post',
			success: function(response) {
				$('.chat-data-items').append(response);
				checkMultipleAvatar('.chat-data-items .d-flex');
			},
			error: function() {
				console.log('error');
			}
		});

		var tid = $('#chat-card').data('id');
		indexChatInterval = setInterval(function() {
			$.ajax({
				url: '<?= base_url() ?>/messages/get_messages/' + id,
				type: 'post',
				success: function(response) {
					$('#chat-content-' + tid).html(response);
					checkMultipleAvatar('.media-chat');
					console.log('success');
				},
				error: function() {
					console.log('error');
				}
			});
		}, 2000);
	});

	$('.closeBtn').on('click', function() {
		clearInterval(indexChatInterval);
	});

	function getLikes() {
		$('.check').each(function() {
			var id = $(this).find($('.index-comment')).data('id');
			$.ajax({
				url: '<?= base_url() ?>posts/get_likes/' + id,
				type: 'post',
				success: function(response) {
					$('#upvotes-' + id).text(response);
					console.log(response)
				},
				error: function() {
					console.log('error');
				}
			});
		});
	}
	getLikes();

	function getDisikes() {
		$('.check').each(function() {
			var id = $(this).find($('.index-comment')).data('id');
			$.ajax({
				url: '<?= base_url() ?>posts/get_dislikes/' + id,
				type: 'post',
				success: function(response) {
					$('#downvotes-' + id).text(response);
				},
				error: function() {
					console.log('error');
				}
			});
		});
	}
	getDisikes();

	function getCommentCount() {
		$('.check').each(function() {
			var id = $(this).find($('.index-comment')).data('id');
			$.ajax({
				url: '<?= base_url() ?>comments/get_comments_count/' + id,
				type: 'post',
				success: function(response) {
					$('.index-comment').each(function() {
						$(this).find($('#count-' + id)).html(response);
					});
				},
				error: function() {
					console.log('error');
				}
			});
		});
	}
	getCommentCount();

	// Show ellipsis on comment-info hover
	function showCommentOptions() {
		$('.comment-info').each(function() {
			let icon = $(this).find("ion-icon");
			icon.hide();

			let editBtn = $(this).find(".editBtn");
			let commentBody = $(this).find(".commentBody");
			let editComment = $(this).find(".editComment");
			let cancelBtn = $(this).find(".cancelBtn");
			let commentInfo = $(this).find(".comment-info");

			let replyBtn = $(this).find(".replyBtn");
			let replyComment = $(this).find(".replyComment");

			editComment.hide();
			replyComment.hide();
			cancelBtn.hide();

			$(this).hover(function() {
				icon.show();

				var iteration = $(this).data('iteration') || 1

				switch (iteration) {
					case 1:
						icon.show();
						$(editBtn).click(function() {
							commentBody.hide();
							editComment.show();
							editComment.addClass('added-margin');
						});

						$(cancelBtn).click(function() {
							editComment.removeClass('added-margin');
							editComment.hide();
							replyComment.removeClass('added-margin');
							replyComment.hide();
							commentBody.show();
						});

						$(replyBtn).click(function() {
							commentBody.hide();
							replyComment.show();
							replyComment.addClass('added-margin');
						});


						break;

					case 2:
						icon.hide();
						break;
				}

				iteration++;

				if (iteration > 2) iteration = 1
				$(this).data('iteration', iteration)
			});
		});
	}

	showCommentOptions();

	// Handle Edit, Reply btns on view comments



	$('.index-comment').on('click', function() {
		var id = $(this).data('id');
		$.ajax({
			url: '<?= base_url() ?>comments/get_comments',
			type: 'post',
			data: {
				id: id
			},
			beforeSend: function() {
				$('#comments-' + id).html(loading());
			},
			success: function(response) {
				$('#comments-' + id).html(response);
				checkMultipleAvatar('.comment-info');

			},
			error: function() {
				console.log('error');
			}
		});
	});

	// Disable button and enable when user input is not null
	function enableDisableBtn(Btn, inputBox) {
		$(Btn).attr('disabled', true);

		$(inputBox).keyup(function() {
			if ($(inputBox).val()) {
				$(Btn).attr('disabled', false);
			} else {
				$(Btn).attr('disabled', true);
			}
		});
	}

	enableDisableBtn("#input-form-btn", "#input-form");
	enableDisableBtn("#search-bar-btn", "#postSearch");
	enableDisableBtn(".index-comment-postbtn", ".index-comment-body");


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
		$('.chats-title h6 strong').text(nchats);
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
					$('.chats-title h6 strong').text(nchats);
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
	}

	showSpecificChat();

	// Handle Posts without Image
	function post() {
		$('.post').each(function() {
			let postImage = $(this).find('.post-thumbnail');
			let imageDiv = $(this).find('.col-md-5');
			let postContent = $(this).find('.post-content');

			if (postImage.attr('src') == '<?php echo site_url(); ?>assets/images/posts/') {
				imageDiv.remove();
				postContent.removeClass("col-md-7").addClass("col-md-12");
			}
		});

		$('.post-data').each(function() {
			let postImage = $(this).find('.post-thumbnail');

			if (postImage.attr('src') == '<?php echo site_url(); ?>uploads/') {
				postImage.remove();
			}
		});
	}

	function view() {
		let postImage = $('.post-thumbnail');

		if (postImage.attr('src') == '<?php echo site_url(); ?>assets/images/posts/') {
			postImage.remove();
		}
	}

	post();
	view();

	// Handles likes
	$('.like').on('click', function() {
		var postId = $(this).data('pid');
		var userId = $(this).data('id');
		$(this).attr('disabled', true);
		$.ajax({
			url: '<?= base_url() ?>posts/likes',
			type: 'post',
			data: {
				postId: postId,
				userId: userId
			},
			success: function(response) {
				$('#upvotes-' + postId).text(response);
			},
			error: function() {
				console.log('error');
			}
		});
	});

	$('.dislike').on('click', function() {
		var postId = $(this).data('pid');
		var userId = $(this).data('id');
		$(this).attr('disabled', true);
		$.ajax({
			url: '<?= base_url() ?>posts/dislikes',
			type: 'post',
			data: {
				postId: postId,
				userId: userId
			},
			success: function(response) {
				$('#downvotes-' + postId).text(response);
				console.log(likes);
			},
			error: function() {
				console.log('error');
			}
		});
	});


	// function time_ago(time) {

	// 	switch (typeof time) {
	// 		case 'number':
	// 			break;
	// 		case 'string':
	// 			time = +new Date(time);
	// 			break;
	// 		case 'object':
	// 			if (time.constructor === Date) time = time.getTime();
	// 			break;
	// 		default:
	// 			time = +new Date();
	// 	}

	// 	let time_formats = [
	// 		[60, 'seconds', 1], // 60
	// 		[120, '1 minute ago', '1 minute from now'], // 60*2
	// 		[3600, 'minutes', 60], // 60*60, 60
	// 		[7200, '1 hour ago', '1 hour from now'], // 60*60*2
	// 		[86400, 'hours', 3600], // 60*60*24, 60*60
	// 		[172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
	// 		[604800, 'days', 86400], // 60*60*24*7, 60*60*24
	// 		[1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
	// 		[2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
	// 		[4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
	// 		[29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
	// 		[58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
	// 		[2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
	// 		[5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
	// 		[58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
	// 	];
	// 	let seconds = (+new Date() - time) / 1000,
	// 		token = 'ago',
	// 		list_choice = 1;

	// 	if (seconds == 0) {
	// 		return 'Just now'
	// 	}
	// 	if (seconds < 0) {
	// 		seconds = Math.abs(seconds);
	// 		token = 'from now';
	// 		list_choice = 2;
	// 	}
	// 	let i = 0,
	// 		format;
	// 	while (format = time_formats[i++])
	// 		if (seconds < format[0]) {
	// 			if (typeof format[2] == 'string')
	// 				return format[list_choice];
	// 			else
	// 				return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
	// 		}
	// 	return time;
	// }

	$('.pin-post').on('click', function() {
		var postId = $(this).data('pid');
		var postTitle = $(this).data('title');
		var postSlug = $(this).data('slug');
		$.ajax({
			url: '<?= base_url() ?>posts/get_pin_post/' + postId,
			type: 'post',
			data: {
				postTitle: postTitle,
				postSlug: postSlug
			},
			dataType: 'json',
			success: function(response) {
				$output = '<div class="post-info">';
				$output += '<a href="' + response.slug + '">';
				$output += '<h6 class="post-title">' + response.title + '</h6>';
				$output += '</a></div>';
				$output += '<div class="pin-meta meta-data d-flex justify-content-between">'
				// $output += ' <button class="mr-1 unpin-post" data-id="' + id + '">unpin</button>';
				// $output += '<p class="ml-auto">' + time_ago(new Date($.now())) + '</p>';
				$output += '</div><hr class="separator">';
				// location.reload();
				$('#pin_post').prepend($output);
				$('#pin-' + postId).attr('disabled', true);
				console.log(response);
			},
			error: function() {
				console.log('error');
			}
		});
	});

	$('.unpin-post').on('click', function() {
		var id = $(this).data('id');
		$.ajax({
			url: '<?= base_url() ?>posts/delete_pin_post/' + id,
			type: 'post',
			success: function(data) {
				window.location.reload(true);
			}
		});
	});

	// Check Avatars
	function checkAvatar($parentDiv) {
		var avatar_image = $($parentDiv).find('.avatar-image');
		var attrib = avatar_image.attr('src');
		if (attrib == '') {
			avatar_image.attr('src', '<?= base_url() ?>assets/images/avatar/noimage.jpg');
		}
	}

	function checkMultipleAvatar($parentDiv) {

		$($parentDiv).each(function() {
			var avatar_image = $(this).find('.avatar-image');
			var attrib = avatar_image.attr('src');
			if (attrib == '') {
				avatar_image.attr('src', '<?= base_url() ?>assets/images/avatar/noimage.jpg');
			}
		});

	}

	var id = $('.index-comment').data('id');

	checkAvatar('.view-content .meta-data');
	checkMultipleAvatar('.profile');
	checkMultipleAvatar('.meta-data');
	checkMultipleAvatar('.nearby-meta-data');
	checkMultipleAvatar('.comment-info');
	checkMultipleAvatar('.chat-data-items .d-flex');
	checkAvatar('.post-div1');
	checkAvatar('.publisher');


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
				url: '<?= base_url(); ?>messages/send_message',
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
					output += '<p>' + message + '</p>';
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