<?php


function mas_body($atts) {

	$instance_uri = (!empty($atts['instance_uri'])) ? $atts['instance_uri'] : "";
	$user_id = (!empty($atts['user_id'])) ? $atts['user_id'] : "";
	$profile_name = (!empty($atts['profile_name'])) ? $atts['profile_name'] : "";
	$toots_limit = (!empty($atts['toots_limit'])) ? $atts['toots_limit'] : "";

    return "
	<script>
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

	<div class=\"dummy-container\">
		<div id=\"mt-timeline\" class=\"mt-timeline\">
			<div id=\"mt-body\" class=\"mt-body\">
				<div class=\"loading-spinner\"></div>
			</div>
		</div>
	</div>   
    ";
}