/* ---------------
	JULY 2022 
------------------ */

// [READ] --> https://developer.mozilla.org/en-US/docs/Web/API
// [READ] --> https://twitter.com/Insharamin
// [READ] --> 
// [READ] --> 
// [READ] --> 
// [READ] --> 
// [READ] --> 
// [READ] --> 
// [READ] --> 
// [READ] --> 

/* [4-July-2022] [JS]

	[TOPIC] MutationObserver
	-------------------------

	1) E:\LEARNING PROGRAMMING 5 (html, CSS, php)\DailyLearning\JS\MutationObserver
	2) https://www.youtube.com/watch?v=Mi4EF9K87aM&t=426s&ab_channel=WebDevSimplified
	3) https://developer.mozilla.org/en-US/docs/Web/API/MutationObserver
	4) https://developer.mozilla.org/en-US/docs/Web/API/MutationObserver/observe <-- Parameters

	[code]

	const mutationObserver = new MutationObserver( entries => {
		// console.log(entries);
		$('#thim-course-archive > div').each(function(){
			let url = $(this).find('.course-title a').attr('href');
			if(!url.includes('/courses/')) {
				$(this).remove();
			}
		});
	} );

	const courses = document.querySelector('#lp-archive-courses');

	mutationObserver.observe(courses, {childList: true});

	mutationObserver.disconnect();


	[TOPIC] ResizeObserver
	-----------------------

	1) https://developer.mozilla.org/en-US/docs/Web/API/ResizeObserver
	2) https://www.youtube.com/watch?v=M2c37drnnOA&ab_channel=WebDevSimplified
	3) E:\LEARNING PROGRAMMING 5 (html, CSS, php)\DailyLearning\JS\ResizeObserver


	[TOPIC] Intersection Observer API
	----------------------------------

	1) https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API
	2) https://www.youtube.com/watch?v=2IbRtjez6ag&ab_channel=WebDevSimplified
	3) E:\LEARNING PROGRAMMING 5 (html, CSS, php)\DailyLearning\JS\IntersectionObserver

*/


/* ---------------
	DECEMBER 2022 
------------------ */

// [READ] --> https://wptips.dev/custom-rest-api/
// [READ] --> 

/* [8-Dec-2022] [WORDPRESS]

	[TOPIC] How to Make Custom REST API [WP] 
	-------------------------

	// => Creating a Wrapper Class in functions.php file.

	// If the endpoints are related, I recommend putting them in a class. 
	// Not only it’s tidier it also relieves you from worrying about duplicate method names. 
	// Here’s what it looks like when grouping the 3 endpoints above:

	[CODE:PHP]

	if( !class_exists( 'MyAPI' ) ) {

	class MyAPI {
	  function __construct() {
	    add_action( 'rest_api_init', [$this, 'init'] );
	  }

	  function init() {
	    register_rest_route( 'my/v1', '/projects', [
	      'methods' => 'GET',
	      'callback' => [$this, 'get_projects'],
	    ] );

	    register_rest_route( 'my/v1', '/project/(?P<id>\d+)', [
	      'methods' => 'GET',
	      'callback' => [$this, 'get_project'],
	    ] );

	    register_rest_route( 'my/v1', '/projects_search', [
	      'methods' => 'POST',
	      'callback' => [$this, 'post_projects_search']
	    ] );
	  }

	  // Get recent projects
	  function get_projects( $params ) {
	    $projects =  get_posts( [
	      'post_type' => 'project',
	      'posts_per_page' => 10
	    ] );

	    foreach( $projects as &$p ) {
	      $p->thumbnail = get_the_post_thumbnail_url( $p->ID );
	    }

	    return $projects;
	  }

	  // Get single project
	  function get_project( $params ) {
	    $project = get_post( $params['id'] );
	    $project->thumbnail = get_the_post_thumbnail_url( $project->ID );
	    return $project;
	  }

	  // Search projects
	  function post_projects_search( $request ) {
	    // Get sent data and set default value
	    $params = wp_parse_args( $request->get_params(), [
	      'title' => '',
	      'category' => null
	    ] );

	    $args = [
	      'post_type' => 'project',
	      's' => $params['title'],
	    ];

	    if( $params['category'] ) {
	      $args['tax_query'] = [[
	        'taxonomy' => 'project_category',
	        'field' => 'id',
	        'terms' => $params['category']
	      ]];
	    }

	    return get_posts( $args );
	  }
	}

	new MyAPI();
	}

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// [READ] --> https://stackoverflow.com/questions/2727167/how-do-you-get-a-list-of-the-names-of-all-files-present-in-a-directory-in-node-j
// [READ] --> https://www.geeksforgeeks.org/node-js-fs-rename-method/

/* [11-Dec-2022] [WORDPRESS]

	[TOPIC] How to RENAME FILES IN WINDOWS USING NODE.JS 
	-----------------------------------------------------

	/* You can use the fs.readdir or fs.readdirSync methods. fs is included in Node.js core, so there's no need to install anything. */

	/* 

	// [code] using "fs.readdir"

	const testFolder = './tests/';
	const fs = require('fs');

	fs.readdir(testFolder, (err, files) => {
	  
	  files.forEach(file => {
	    console.log(file);
	  });

	});


	OR [code] using "fs.readdirSync"

	const testFolder = './tests/';
	const fs = require('fs');

	fs.readdirSync(testFolder).forEach(file => {
	  console.log(file);
	});


	// The difference between the two methods, is that the first one is asynchronous, so you have to provide a callback function that will be executed when the read process ends.

	// The second is synchronous, it will return the file name array, but it will stop any further execution of your code until the read process ends.


	[EXAMPLE] // USED HERE -> E:\LEARNING PROGRAMMING 5 (html, CSS, php)\PHP\Learn PHP The Right Way (Program With Gio)\node

	const testFolder = "../";
	const fs = require("fs");

	fs.readdirSync(testFolder).forEach((file) => {
	  let oldName = file;
	  let newName = oldName.replace("y2mate.com - ", "");

	  let oldPath = testFolder + oldName;
	  let newPath = testFolder + newName;

	  fs.rename(oldPath, newPath, () => {
	    console.log("\nFile Renamed!\n");
	  });

	  // console.log(newName);
	});


	// Files: index.js, package.json
	// Command: npm ./index.js <- to execute the code


++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// [READ] --> https://pqina.nl/blog/fix-html-video-autoplay-not-working/

/* [3-June-2023] [WORDPRESS]

	[TOPIC] Embed Amazon S3 Video | CDN Videos
	-----------------------------------------------------

	<video autoplay muted playsinline preload="auto" loop>
	    <source src="https://realisticrealtors-bkt.s3.ap-south-1.amazonaws.com/Main_banner_final-1.mp4" type="video/mp4">
	    <!-- Provide alternative video formats here if needed -->
	    <!-- <source src="video.webm" type="video/webm"> -->
	    <!-- <source src="video.ogv" type="video/ogg"> -->
	    <!-- <source src="video.mov" type="video/quicktime"> -->
	    <!-- <source src="video.avi" type="video/x-msvideo"> -->
	    <!-- Fallback text -->
	    Sorry, your browser doesn't support embedded videos.
	</video>

	[NOTES]

		Specify the preload attribute: By adding the preload attribute to the <video> element, you can indicate to the browser that it should preload the video, improving the loading time. You can set it to "auto" to allow the browser to determine the best strategy for preloading, or "metadata" to only load the video metadata.

		Add a fallback text: It's a good practice to include a fallback text that will be displayed if the video cannot be played. This text will provide a description or alternative content for users who may have trouble viewing the video.

		Provide alternative video formats: To ensure compatibility with different browsers, you can include multiple <source> elements with different video formats. This allows the browser to select the most suitable format based on its capabilities.

	[/NOTES]


++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// https://matthewturland.com/slides/phpoop-tutorial/#/slide-title
// https://youtu.be/oAaNHGK1kNk?si=Jbqfv80B6myKlctA