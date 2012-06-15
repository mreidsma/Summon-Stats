
$("#topbar").find(".link").prepend('<a href="PATH/TO/LINK">Ask a Librarian</a>');

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

// Page navigation fix for pages without navigation by Michael Oehrlich of Thüringer Universitäts- und Landesbibliothek Jena

if($("#pageNavigation").length){
              page = $("#pageNavigation").find("li:not(:has(a))").text();
       }else{
              page = '1';
       }

$("a.documentLink").each(function(){
	var contentType = $(this).parent().parent().parent().parent().parent().attr("Type");
	contentType = encodeURI(contentType);
	$(this).attr("id","docLink," + i + "," + contentType).addClass("gvsuTest");
	i=i+1;
});

// Following code by @benelwell to fix duplicate link bug with summary links

$('div.document').each(function(){
        $(this).attr("pos",j);
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
	datastring = datastring + ts + "," + clicked + "," + page;
	datastring = "data=" + datastring;
	$.ajax({
		dataType: "jsonp",
		url: "PATH/TO/click_write.php",
		data: datastring
	});
	datastring = "";
	clicked = "";
});

// Following code via @benelwell
// Add this bit of code to bind the click action to all the summary links, including late books:
// It also solves the problem with multiple links per item getting different numbers (e.g. if we have book and ebook) and it gets the right content type for each separate link.
$('div.document').delegate('.summary a', 'click', function() {
            var clickedPos = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr("pos");
            var contentType = $(this).parent().parent().parent().find("div.content-type").find("div.text:first").text();
            contentType = encodeURI(contentType);
            clicked = "summaryLink," + clickedPos + "," + contentType;
            ts = Math.round((new Date()).getTime() / 1000);
            datastring = datastring + ts + "," + clicked + "," + page;
            datastring = "data=" + datastring;
            $.ajax({
                dataType: "jsonp",
                url: "PATH/TO/click_write.php",
                data: datastring
            });
            datastring = "";
            clicked = "";
});

});