		<?php
		$feed_url = "http://picasaweb.google.com/data/feed/base/user/".get_option('colabs_username_picasa')."?alt=rss&kind=photo&hl=id&imgmax=1600&max-results=".get_option('colabs_piccount_picasa')."&start-index=1";
		$latest_pics = colabs_pinterest_get_rss_feed( $user, $limit, $feed_url );
		foreach ( $latest_pics as $item ){
				$rss_description = $item->get_description();
				preg_match('/src="([^"]*)"/', $rss_description, $image); $src = $image[1]; unset($image);				
				$title = $item->get_title();
				$date = $item->get_date('j F Y | g:i a');
				echo '<li class="gallery-item">
						<a href="'.$src.'" title="'.$title.'" rel="lightbox">
							'.colabs_image('width=280&link=img&return=true&src='.$src).'
						</a>
							<div class="time">
								<p class="entry-time">
									<i class="icon-time"></i> 
									<span>'.$date.'</span> 
								</p>
							</div>
					  </li>';
		}
		?>    