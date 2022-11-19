<?php


function mas_body($atts=null) {
    return "
	<script>
		// Account settings
	document.addEventListener(\"DOMContentLoaded\", () => {
		let mapi = new MastodonApi({
			container_id: 'mt-timeline',
			container_body_id: 'mt-body',
			instance_uri: 'https://nrw.social',
			user_id: '109245751255389357',
			profile_name: '@radwegehamm',
			toots_limit: 6,
			btn_see_more: 'Mehr auf Mastodon'
		});
	});
   </script>

   <style>
   @media only screen and (max-width: 400px) {
   	  .mt-toot {padding: 5rem 0 2rem 0;}
   }
   </style>

	<div class=\"dummy-container\">
		<div id=\"mt-timeline\" class=\"mt-timeline\">
			<div id=\"mt-body\" class=\"mt-body\">
				<div class=\"loading-spinner\"></div>
			</div>
		</div>
	</div>   
    ";
}