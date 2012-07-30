
$(document).ready(function() {
	
	// Edit this variable to the directory where you store write.php
	
	var path = "http://myserver.com/clicks/";
	
	// Assign unique IDs to each link in place
	var i = 1;
	var j = 1;
	var t = 1;
	var x = 1;
	
	// Create other variables needed by script
	var clicked = "";
	var contentType = "";
	var ts = 0; // Timestamp
	var searchClicks = 1; // # of clicks/search

	// Page navigation fix for pages without navigation by Michael Oehrlich of Thüringer Universitäts- und Landesbibliothek Jena

	if($("#pageNavigation").length){
	     page = $("#pageNavigation").find("li:not(:has(a))").text();
	} else {
	     page = '1';
	}
	
	$("a.documentLink").each(function(){
		$(this).attr("data-click", i + "/docLink/" + page + "/").addClass("gvsuTest");
		i=i+1;
	});
	
	$("div.summary").find("a").each(function(){
		$(this).attr("data-click", j + "/summaryLink/" + page + "/").addClass("gvsuTest");
		j=j+1;
	});
	
	$(".thumbnail").find("a").each(function(){
		$(this).attr("data-click", t + "/imgLink/" + page + "/").addClass("gvsuTest");
		t=t+1;
	});
	
	$(".previewDocumentTitle").find("a").each(function(){
		$(this).attr("data-click", x + "/previewLink/" + page + "/").addClass("gvsuTest");
		x=x+1;
	});
	
	// Now set a click handler to capture that data when an item is clicked
	
$("a.gvsuTest").click(function() {
	
	clicked = $(this).attr("data-click");
	
	// Thanks for Matt Matchell (@shuckle) for the tip on .closest()
	contentType = escape($(this).closest('div.document').attr("type"));
	
	ts = Math.round((new Date()).getTime() / 1000); // Timestamp
	
	var url =  path + ts + "/" + clicked + contentType + "/" + searchClicks;
	
	$("body").append('<iframe src="' + url + '" height="0" width="0" style="visibility:hidden;"></iframe>');
	
	// Add one to number of clicks for this search
	searchClicks = searchClicks + 1;

});
});