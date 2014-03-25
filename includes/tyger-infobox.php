<div id="sliding-content" style="display: block;">
    <div id="content-wrap">
    <!--
        <h3>MER INFORMATION</h3>
	-->
		<table class="infotable">
		<?php
		if (get_post_meta ($post->ID, 'txt_fritext', true)) { 
			echo '<tr><td> ' . get_post_meta ($post->ID, 'txt_fritext', true) . '</td></tr>';
		} 

		if (get_post_meta ($post->ID, 'wpboot_artikel', true)) { 
			echo '<tr><td class="text-muted">Artikel</td><td> ' . get_post_meta ($post->ID, 'wpboot_artikel', true) . '</td></tr>';
		} 
		
		if (get_post_meta ($post->ID, 'wpboot_anvandning', true)) {
			echo '<tr><td class="text-muted">Användningsområde</td><td> ' . get_post_meta ($post->ID, 'wpboot_anvandning', true) . '</td></tr>';
		} 
		
		if (get_post_meta ($post->ID, 'wpboot_martindale', true)) {
			echo '<tr><td class="text-muted">Martindale</td><td> ' . get_post_meta ($post->ID, 'wpboot_martindale', true) . '</td></tr>';
		}

		if (get_post_meta ($post->ID, 'wpboot_komposition', true)) {
			echo '<tr><td class="text-muted">Komposition</td><td> ' . get_post_meta ($post->ID, 'wpboot_komposition', true) . '</td></tr>';
		}

		if (get_post_meta ($post->ID, 'wpboot_farger', true)) {
			echo '<tr><td class="text-muted">Antal färger</td><td> ' . get_post_meta ($post->ID, 'wpboot_farger', true) . '</td></tr>';
		}
		
		if (get_post_meta ($post->ID, 'wpboot_bredd', true)) {
			echo '<tr><td class="text-muted">Bredd</td><td> ' . get_post_meta ($post->ID, 'wpboot_bredd', true) . '</td></tr>';
		}
		
		if (get_post_meta ($post->ID, 'wpboot_vikt', true)) {
			echo '<tr><td class="text-muted">Vikt</td><td> ' . get_post_meta ($post->ID, 'wpboot_vikt', true) . '</td></tr>';
		}

		if (get_post_meta ($post->ID, 'wpboot_rapport', true)) {
			echo '<tr><td class="text-muted">Rapport</td><td> ' . get_post_meta ($post->ID, 'wpboot_rapport', true) . '</td></tr>';
		}
		
		if (get_post_meta ($post->ID, 'wpboot_krympning', true)) {
			echo '<tr><td class="text-muted">Krympning efter tvätt</td><td> ' . get_post_meta ($post->ID, 'wpboot_krympning', true) . '</td></tr>';
		}
		
		if (get_post_meta ($post->ID, 'wpboot_infargning', true)) {
			echo '<tr><td class="text-muted">Infärgning</td><td> ' . get_post_meta ($post->ID, 'wpboot_infargning', true) . '</td></tr>';
		}
		
		if (get_post_meta ($post->ID, 'wpboot_flamsakert', true)) {
			echo '<tr><td class="text-muted">Flamsäkert</td><td> ' . get_post_meta ($post->ID, 'wpboot_flamsakert', true) . '</td></tr>';
		}
		
		if (get_post_meta ($post->ID, 'wpboot_ljusakthet', true)) {
			echo '<tr><td class="text-muted">Ljusäkthet</td><td> ' . get_post_meta ($post->ID, 'wpboot_ljusakthet', true) . '</td></tr>';
		} 

		if (get_post_meta ($post->ID, 'wpboot_farghardighet', true)) {
			echo '<tr><td class="text-muted">Färghärdighet</td><td> ' . get_post_meta ($post->ID, 'wpboot_farghardighet', true) . '</td></tr>';
		} 

		if (get_post_meta ($post->ID, 'wpboot_ikon', true)) {
			echo '<tr><td class="text-muted">Tvättråd</td><td> ';
			$ikoner = get_post_meta($post->ID, 'wpboot_ikon', false); 
			foreach($ikoner as $ikon) {
				echo '<span class="but-ikoner but-'.$ikon.'">'.$ikon.'</span>';
			}
			echo '</td></tr>';
		}
		?>
		</table>
    </div>
</div>
<div id="sliding-footer">
    <div id="sliding-footer-left"><a href="#" onclick="return false;" id="sliding-trigger">Mer information &#9660;</a></div>
</div>
