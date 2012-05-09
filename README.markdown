#README - Summon Stats

---

This tool was developed by Matthew Reidsma in HTML, PHP, and Javascript to learn hw users of Grand Valley State University's Summon Discovery Service use the results they get from searches. We hope you find it useful.

Serials Solutions Summon doesn't give you stats on how users click on results, which is more useful than what they search for. This script adds that feature.

## INSTALLATION

Summon Stats has four files:

summon\_clicks.js: the javascript called by Summon.
click\_write.js: The PHP script that writes the data to the spreadsheet.
summon\_clicks.csv: the spreadsheet file where the data will be saved. This is easier to install than a database.
index.php: the page for viewing your summon statistics.

### Customizing the files

Open index.php in your favorite text editor and change the path in line twelve to where you will put the summon\_clicks.csv file. For instance, if you'll upload the file to http://mywebsite.com/files/summon_clicks.csv, you'll change line 12 to:

	if (!$DataFile = fopen("http://mywebsite.com/files/summon_clicks.csv", "r")) {echo "Failure: cannot open file"; die;};

Upload the index.php to your website where you want to view the statistics.

Now open summon_clicks.js in your text editor. On line 2, you'll need to customize the link that Summon will show in the top bar. The text is currently set to "Ask a Librarian", so you can just change the link to point to your ask a librarian page.

Now, on line 51, you need to add the path to the click\_write.php file. If you will put the file at http://mywebsite.com/files/, then you'd want line 51 to look like this:

	url: "http://mywebsite.com/files/click_write.php",
	
Make sure that trailing comma is still there!

Now, upload all the files to the server where you said they would be. All that is left is to get the script in Summon.

### Adding the script to Summon

Serials Solutions doesn't really want you to add scripts to Summon, but it can be done. Log into the Client Center and go to "Summon > Administration Console." Look for the section called "Custom Link". It should look like this:

<img src="http://www.daveyp.com/blog/wp-content/uploads/2012/01/300x50xsummon2-300x50.png.pagespeed.ic.Qc0I-Hwaan.png" alt="Custom Summon Link" />

For the URL value, put "#" (no quotes). For the text value, add the following line (but update the path to match where you uploaded summon_clicks.js):

	<script src="PATH/TO/summon_clicks.js" type="text/javascript"></script>

That's it. Save the changes and give yourself a high five. Now wait a while and then view index.php to see how people are using your site!

More questions? Feel free to contact Matthew Reidsma on Twitter at @mreidsma or via email at reidsmam@gvsu.edu.

DEMO

You can view a live version of this tool at http://gvsulib.com/labs/summon_usage.

COPYRIGHT

This tool is copyright 2012 Matthew Reidsma. 

This tool is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This tool is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this tool. If not, see <http://www.gnu.org/licenses/>.