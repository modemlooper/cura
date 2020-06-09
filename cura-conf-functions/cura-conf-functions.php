<?php
/*
Plugin Name:  Cura Conference Functions
Plugin URI:   https://alphaweb.com/
Description:  Custom functions for displaying videos from DropBox
Version:      1.0
Author:       AlphaWeb
Author URI:   https://alphaweb.com/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Domain Path:  /languages
*/


function cura_conf_videos( $atts ){
	global $dropbox;
	$slug = basename(get_permalink());
	$video = $_GET['video'];				
	//echo $video . " " .$slug;
	if( 'sanford' == $slug ){
		$videos['Conference Day 1, Thursday, April 26']['/Repository/Videos/Sunburst/Thursday Day Before Lunch/After Break/8. Genetic Testing and Wellness'] = 'Genetic Testing and Wellness';
		$videos['Conference Day 1, Thursday, April 26']['/Repository/Videos/Sunburst/Thursday Day After Lunch/After Break/15. Advancements in Treating Rare Diseases'] = 'Advancements in Treating Rare Diseases';
		
		$videos['Conference Day 2, Friday, April 27']['/Repository/Videos/Sunburst/Friday Day Before Lunch/Before Break/4. The Pharmacy of the Future – Cells Not Pills'] = 'The Pharmacy of the Future – Cells Not Pills';

		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day Before Lunch/Before Break/3. The Next Decade for Leading Health Care Systems'] = 'The Next Decade for Leading Health Care Systems';
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day Before Lunch/After Break/6. Prizes to Accelerate Innovation and Discovery'] = 'Prizes to Accelerate Innovation and Discovery';
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day After Lunch/Before Break/10. Public Private Partnerships to Accelerate Discoveries'] = 'Public Private Partnerships to Accelerate Discoveries';

		$videos['Interviews']['/Repository/A+P/Interviews/Sanford Health'] = 'Sanford Health';
	
	}elseif( 'bosarge' == $slug ){
		$videos['Conference Day 2, Friday, April 27']['/Repository/Videos/Sunburst/Friday Day Before Lunch/Before Break/9. Novel Strategies for Biological Drug Development'] = 'Novel Strategies for Biological Drug Development';
		$videos['Conference Day 2, Friday, April 27']['/Repository/Videos/Sunburst/Friday Day Before Lunch/Before Break/10. The Stem Cell Odyssey'] = 'The Stem Cell Odyssey';
		$videos['Conference Day 2, Friday, April 27']['/Repository/Videos/Sunburst/Friday Day Before Lunch/After Break/11. Preparing for a Future in Cell Therapy – Regulations, Registries and Scalability'] = 'Preparing for a Future in Cell Therapy';
		
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day After Lunch/Before Break/8. Investing in Health'] = 'Investing in Health';
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day After Lunch/After Break/15. 2018 Pontifical Heroes'] = '2018 Pontifical Heroes';
		
		$videos['Interviews']['/Repository/A+P/Interviews/Bosarge Family Foundation'] = 'Bosarge Family Foundation';
		
	}elseif( 'celularity' == $slug ){
		$videos['Conference Day 2, Friday, April 27']['/Repository/Videos/Sunburst/Friday Day Before Lunch/Before Break/8. Clinical Experience Using Cell Therapy Derived From Placental Cells'] = 'Clinical Experience Using Cell Therapy Derived From Placental Cells';
		$videos['Conference Day 2, Friday, April 27']['/Repository/Videos/Sunburst/Friday Day After Lunch/After Break/22. 2018 Pontifical Key Innovation Award'] = '2018 Pontifical Key Innovation Award';
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day After Lunch/After Break/12. Families Fighting Cancer'] = 'Families Fighting Cancer';
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day After Lunch/After Break/15. 2018 Pontifical Heroes'] = '2018 Pontifical Heroes';
		
		$videos['Interviews']['/Repository/A+P/Interviews/Celularity'] = 'Celularity';
		
	}elseif( 'hackensack' == $slug ){
		$videos['Conference Day 2, Friday, April 27']['/Repository/Videos/Sunburst/Friday Day After Lunch/Before Break/18. Precision Analytics and Big Data Impacting Cancer Care'] = 'Precision Analytics and Big Data Impacting Cancer Care';

		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day Before Lunch/Before Break/3. The Next Decade for Leading Health Care Systems'] = 'The Next Decade for Leading Health Care Systems';
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day Before Lunch/Before Break/4. Population Health Intelligence'] = 'Population Health Intelligence';
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day After Lunch/Before Break/7. Teaching the Next Generation of Health Care Providers'] = 'Teaching the Next Generation of Health Care Providers';
		
		$videos['Interviews']['/Repository/A+P/Interviews/Hackensack Meridian Health'] = 'Hackensack Meridian Health';
	
	}elseif( 'helmsley' == $slug ){
		$videos['Conference Day 1, Thursday, April 26']['/Repository/Videos/Sunburst/Thursday Day Before Lunch/Before Break/4. Global Approaches to a World Without Disease'] = 'Global Approaches to a World Without Disease';
		$videos['Conference Day 1, Thursday, April 26']['/Repository/Videos/Sunburst/Thursday Day After Lunch/Before Break/12. What Is Patient Centricity'] = 'What Is Patient Centricity';
		$videos['Conference Day 1, Thursday, April 26']['/Repository/Videos/Sunburst/Thursday Day After Lunch/Before Break/13. How Patients and Their Families Can Impact Type 1 Diabetes'] = 'How Patients and Their Families Can Impact Type 1 Diabetes';
		
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day After Lunch/After Break/15. 2018 Pontifical Heroes'] = '2018 Pontifical Heroes';
		
		$videos['Interviews']['/Repository/A+P/Interviews/Helmsley Charitable Trust'] = 'Helmsley Charitable Trust';
	
		$videos['Cura Videos']['/Repository/A+P/Cura Videos/T1D'] = 'Type 1 Diabetes Video with the Panzirer Family';
		
	}elseif( 'xprize' == $slug ){
		
		$videos['Conference Day 1, Thursday, April 26']['/Repository/Videos/Sunburst/Thursday Day Before Lunch/Before Break/3. Health Care Innovation During Exponential Times'] = 'Health Care Innovation During Exponential Times';
		
		
		$videos['Conference Day 2, Friday, April 27']['/Repository/Videos/Sunburst/Friday Day Before Lunch/After Break/12. Longevity and the Morality of Extreme Life Extension'] = 'Longevity and the Morality of Extreme Life Extension';

		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day Before Lunch/After Break/6. Prizes to Accelerate Innovation and Discovery'] = 'Prizes to Accelerate Innovation and Discovery';

		$videos['Interviews']['/Repository/A+P/Interviews/XPRIZE'] = 'XPRIZE';
		
	
	}elseif( 'katy-perry' == $slug ){
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day Before Lunch/After Break/5. Impacting Children’s Health Through Meditation Globally'] = 'Impacting Children’s Health Through Meditation Globally';

		$videos['Interviews']['/Repository/A+P/Interviews/Katy Perry'] = 'Katy Perry and Bob Roth';
	
	}elseif( 'tony-robbins' == $slug ){
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day After Lunch/After Break/14. Choosing Hope'] = 'Choosing Hope';
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day After Lunch/After Break/15. 2018 Pontifical Heroes'] = '2018 Pontifical Heroes';

		$videos['Interviews']['/Repository/A+P/Interviews/Tony Robbins/'] = 'Tony Robbins';
	
	}elseif( 'suskinds' == $slug ){
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day After Lunch/After Break/15. 2018 Pontifical Heroes'] = '2018 Pontifical Heroes';

		$videos['Other']['/Repository/A+P/Interviews/Owen Suskind/Villa Miani'] = 'Owen and Ron Suskind at Villa Miani on April 26, 2018';

		$videos['Other']['/Repository/A+P/Interviews/Owen Suskind/Papal Audience'] = 'Owen Suskind at the Papal Audience on April 28, 2018';
		
	}elseif( 'peter-gabriel' == $slug ){
		$videos['Conference Day 2, Friday, April 27']['/Repository/Videos/Sunburst/Friday Day After Lunch/Before Break/17. The Potential Impact of a Digitally Streamed Health Platform'] = 'The Potential Impact of a Digitally Streamed Health Platform';
		$videos['Conference Day 3, Saturday, April 28']['/Repository/Videos/Sunburst/Saturday Day After Lunch/After Break/15. 2018 Pontifical Heroes'] = '2018 Pontifical Heroes';

		$videos['Interviews']['/Repository/A+P/Interviews/Peter Gabriel/Peter Gabriel'] = 'Peter Gabriel';

	}else{
		return;
	}
	// Build video links and video player
	$return = '<h2 id="view-videos">Videos</h2>';
	foreach ($videos as $key => $value) {
		$return .= '<b>'.$key.'</b><br>';
			foreach ($videos[$key] as $folder => $title) {
				//$query = add_query_arg( array( 'video' => $title );
				if(!$default_video)
					$default_video = $folder;
				$query = add_query_arg('video', $title, get_permalink());
				$return .= '&nbsp&nbsp&nbsp<a href="'.$query.'">' . $title . '</a><br>';
				if( isset( $video ) && $video == $title ) {
					$dropbox = $folder;
				}
			}
	}
	// load video on other shortcode with global $dropbox
	if( !$dropbox )
		$dropbox = $default_video;

	return $return;
	
}
add_shortcode( 'cura-videos', 'cura_conf_videos' );

function cura_conf_video( $atts ){
	global $dropbox;
	//echo $dropbox.'dddd';
	if(!$dropbox){
		$a = shortcode_atts( array(
		    'dropbox' => '',
		), $atts );
		$dropbox = $a['dropbox'];
	}
	if($dropbox){
		$dropbox = str_replace('%20',' ',$dropbox);
		$autoplay = ' autoplay="1"';
		$dropbox = '[outofthebox dir="'.$dropbox.'" mode="video" viewrole="all" downloadrole="all" mediaextensions="mp4" linktomedia="1"'.$autoplay.']'; 
		return do_shortcode($dropbox);
	}
}
add_shortcode( 'cura-video', 'cura_conf_video' );