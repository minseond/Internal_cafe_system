<?php
  $db = mysqli_connect("localhost:3306","root","sieun119!","company_internal_cafe");

  if(!$db)
  {
    echo "DB접속실패";
  }

  function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}

?>