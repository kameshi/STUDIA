<?php
    include("createDB.php");
    class BlockIP
    {
        public function block($ip)
        {
            $address = $ip;
            $query = mysql_query("SELECT address FROM `ip` WHERE address = '" . $ip . "'");
            if (mysql_fetch_row($query) > 0) {
                header("Location: block.html");
            }
        }
    }
?>