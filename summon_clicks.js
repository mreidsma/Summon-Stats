
$("#topbar").find(".link").prepend('<a href="http://gvsu.edu/ask">Ask a Librarian</a>');

$(document).ready(function() {
	
// Assign unique IDs to each link in place
var i=1;
var j=1;
var t=1;
var x=1;
var ts = 0;
var clicked = "";
var clickType = "";
var datastring = "";
var page = $("#pageNavigation").find("li:not(:has(a))").text();
var searchKey = "s.q";
var searchQuery = window.location.search;

$("a.documentLink").each(function(){
	var contentType = $(this).parent().parent().parent().parent().parent().attr("Type");
	contentType = encodeURI(contentType);
	$(this).attr("id","docLink," + i + "," + contentType).addClass("gvsuTest");
	i=i+1;
});
$("div.summary").find("a").each(function(){
	var contentType = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr("Type");
	contentType = encodeURI(contentType);
	$(this).attr("id","summaryLink," + j + "," + contentType).addClass("gvsuTest");
	j=j+1;
});
$(".thumbnail").find("a").each(function(){
	var contentType = $(this).parent().parent().parent().parent().parent().parent().parent().attr("Type");
	contentType = encodeURI(contentType);
	$(this).attr("id","imgLink," + t + "," + contentType).addClass("gvsuTest");
	t=t+1;
});
$(".previewDocumentTitle").find("a").each(function(){
	var contentType = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr("Type");
	contentType = encodeURI(contentType);
	$(this).attr("id","previewLink," + x + "," + contentType).addClass("gvsuTest");
	x=x+1;
});
$("a.gvsuTest").click(function() {
	clicked = $(this).attr("id");
	ts = Math.round((new Date()).getTime() / 1000);
	datastring = datastring + ts + "," + clicked + "," + page + "," + searchQuery;
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