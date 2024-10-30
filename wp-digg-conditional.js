//  This function sends an Ajax request to check-digg-stats.php and eventually
//    updates the page based on the results.

//  Permalink is the link to the article.  Post_id is the WP Post ID - used for
//    identifying the proper div container.  Root is the blog's root URL - used for
//    identifying the target script.

function checkDigg(permalink, post_id, root) {
	var url = root +  '/wp-content/plugins/conditional-digg-this-badge/check-digg-stats.php?permalink=' + escape(permalink);
	
	//  Create a new Ajax request
	new Ajax.Request(url, {
	method: 'get',
	onFailure: function (request) {
		//  You can add some error-alerting here.
		//  This means the request failed for some reason.
	},
	onSuccess: function (request) {
		//  responseText should hold the URL to the Digg story.
		//  It's blank if the story isn't popular enough to get a badge.
		if (request.responseText != '') {
			//  Set parameters for the Digg iframe.
			var diggUrl = 'http://digg.com/tools/diggthis.php?u=' + escape(request.responseText);
			var frameBorder = 0;
			var frameHeight = 80;
			var frameWidth = 52;
			var scrolling = 'no';
			
			//  This Div was created to hold the button
			var diggDiv = document.getElementById('wpDiggBadge-' + post_id);
			
			//  You can edit these attributes for the CSS.
			diggDiv.style.cssFloat = 'left';
			diggDiv.style.styleFloat = 'left';
			diggDiv.style.padding = '0.5em';
			
			//  This deletes the original <script> that called this function
			diggDiv.removeChild(diggDiv.firstChild);
			
			//  Create the Digg This Button
			var diggButton = document.createElement('iframe');
			diggButton.setAttribute('src', diggUrl);
			diggButton.setAttribute('frameborder', frameBorder);
			diggButton.setAttribute('height', frameHeight);
			diggButton.setAttribute('width', frameWidth);
			diggButton.setAttribute('scrolling', scrolling);
			diggDiv.appendChild(diggButton);
		} else {
			//  The article isn't popular, so we'll just delete the
			//    div container and its contents.
		/*	var diggDiv = document.getElementById('wpDiggBadge-' + post_id);
			diggDiv.removeChild(diggDiv.firstChild);
			
			diggDiv.parentNode.removeChild(diggDiv);	*/
			// alert('Page did not meet your high standards for Digging.');
		}
	}
	})
}