<?php
function setError($errorCode) {
	$stdOut = fopen('php://stdout', 'w');
	fwrite($stdOut, "SET VARIABLE userLogin 0\n");
	fwrite($stdOut, "SET VARIABLE errorCode $errorCode\n");
}
