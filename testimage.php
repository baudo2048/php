<?php
header("Content-type: image/gif");

$data = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7";
echo base64_decode($data);
?>