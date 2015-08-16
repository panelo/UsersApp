<?php
function __autoload($class) {
	include_once($class.".php");
}
$switch = new database;
extract($switch->getId((int) $_POST["id"]));
?>

<dl class="dl-horizontal">
  <dt>First Name</dt>
  <dd><?=$firstname;?></dd>
  <dt>Last Name</dt>
  <dd><?=$lastname;?></dd>
  <dt>Age</dt>
  <dd><?=$age;?></dd>
  <dt>Email</dt>
  <dd><?=$email;?></dd>
  <dt>Role</dt>
  <dd><?=$role;?></dd>
  <dt>Department</dt>
  <dd><?=$department;?></dd>
  <dt>Home Address</dt>
  <dd><?=$address_line_1;?> <?=$address_line_2;?> <?=$suburb;?> <?=$state;?> <?=$postcode;?> <?=$country;?></dd>
</dl>