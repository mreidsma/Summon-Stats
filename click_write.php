<?
$data = trim($_POST['data']);

if (!$DataFile = fopen("summon_clicks.csv", "a")) {echo "Failure: cannot open file"; die;};
if (!fwrite($DataFile, $data)) {echo "Failure: cannot write to file"; die;};
fclose($DataFile);
echo "file write successful";

?>