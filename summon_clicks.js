
$("#topbar").find(".link").prepend('<a href="http://gvsu.edu/ask">Ask a Librarian</a>');

$(document).ready(function() {

// Assign unique IDs to each link in place
var i=1;
var j=1;
var ts = 0;
var clicked = "";
var datastring = "";
var page = $("#pageNavigation").find("li:not(:has(a))").text();

$("a.documentLink").each(function(){
	$(this).attr("id","docLink" + i).addClass("gvsuTest");
	i=i+1;
});
$("div.summary").find("a").each(function(){
	$(this).attr("id","summaryLink" + j).addClass("gvsuTest");
	j=j+1;
});
$("a.gvsuTest").click(function() {
	clicked = $(this).attr("id");
	ts = Math.round((new Date()).getTime() / 1000);
	datastring = datastring + ts + "," + clicked + "," + page;
	datastring = "data=" + datastring;
	$.ajax({
		dataType: "string",
		type: "POST",
		url: "http://gvsulib.com/temp/click_write.php",
		data: datastring
	});
	datastring = "";
	clicked = "";
});
});