
function addPostOnSuccess(post){
	var source   = $("#post-template").html();
	var template = Handlebars.compile(source);
	var html = template({post: post});
	
	$('.novinka').first().before(html);
}

function onDeletePost(id){
	$('#post' + id).remove();
}

function onDeactivatePost(id){
	$('#post' + id + ' .deactivate-post-button').addClass('hidden');
	$('#post' + id + ' .activate-post-button').removeClass('hidden');
}

function onActivatePost(id){
	$('#post' + id + ' .deactivate-post-button').removeClass('hidden');
	$('#post' + id + ' .activate-post-button').addClass('hidden');
}


tinymce.init({ selector:'textarea' });