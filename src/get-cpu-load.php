<?php
  # This code performs a simple vmstat and grabs the current CPU idle time
  $idleCpu = exec('vmstat 1 2 | awk \'{ for (i=1; i<=NF; i++) if ($i=="id") { getline; getline; print $i }}\'');
 #The URL root is the AWS meta data service URL where metadata
  # requests regarding the running instance can be made
  $urlRoot="http://169.254.169.254/latest/meta-data/";

  # Print out the idle time, subtracted from 100 to get the current CPU utilization
  echo "<br />";
  echo "<p>InstanceId : <i>" . file_get_contents($urlRoot . 'instance-id') . " </i> : Current CPU Load: <b>";
  echo 100-$idleCpu;
  echo "%</b></p>";

?>