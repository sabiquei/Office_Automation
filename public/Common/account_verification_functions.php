<?php
	function list_accounts($row) {
		print "<a style=\"text-decoration: none\" href=\"../common/verify_status.php?user_id=".$row['user_id']."&verified=".$row['verified']."\">
	            <div class=\"w3-container w3-hover-light-gray w3-border-bottom test\" width=\"100%\" style =\"color : green;\" >"
	            .get_department_name($row["course"]).
	            " , ".$row["semester"]."
	            <br>".$row["name"]."
	            <br>Created On : ".$row["date_created"]."
	            </div>
	          </a>";
	        }
	}


























?>