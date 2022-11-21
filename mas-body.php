<?php


function mas_body($atts) {

	$instance_uri = (!empty($atts['instance_uri'])) ? $atts['instance_uri'] : "";
	$user_id = (!empty($atts['user_id'])) ? $atts['user_id'] : "";
	$profile_name = (!empty($atts['profile_name'])) ? $atts['profile_name'] : "";
	$toots_limit = (!empty($atts['toots_limit'])) ? $atts['toots_limit'] : "";

    return "
	<div id='style'></div>
	<div class=\"dummy-container\">
		<div id=\"mt-timeline\" class=\"mt-timeline\">
			<div id=\"mt-body\" class=\"mt-body\">
				<div class=\"loading-spinner\"></div>
			</div>
		</div>
	</div> 

	<script>
	var clientWidth = document.getElementById('mt-body').clientWidth;
	console.log(clientWidth);
	if (clientWidth<400) {
		var div = document.getElementById('style');
		div.innerHTML += '<style>.mt-toot {padding:5rem 0 2rem 0}</style>';
	}
	// Account settings
	document.addEventListener(\"DOMContentLoaded\", () => {
		let mapi = new MastodonApi({
			container_id: 'mt-timeline',
			container_body_id: 'mt-body',
			instance_uri: '".$instance_uri."',
			user_id: '".$user_id."',
			profile_name: '".$profile_name."',
			toots_limit: ".$toots_limit.",
			btn_see_more: 'Mehr auf Mastodon'
		});
	});
</script>  
    ";
}