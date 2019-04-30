<html>
	<head>
		<title>General Search</title>
	</head>
	<body>
		<a href = "index.html">HomePage</a> | <a href = "specificSearch.php">Stock Search</a><br><br>
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				putenv("ORACLE_SID=teaching");
				if($Connection = oci_connect("w4s22", "stevenagefc")) {
					$value = $_POST['tables'];
					$sql = "SELECT * FROM " . $value;
					$Statement = oci_parse($Connection, $sql); //parse oracle query
					oci_execute($Statement); //execute oracle query
					$numcols = oci_num_fields($Statement);
					print "<table width=300 border=1><tr>";
					for ($i = 1; $i <= $numcols; $i++) {
						$colname = oci_field_name($Statement, $i);
						print "<td>$colname</td>";
					}
					print "</tr>";
					while (oci_fetch($Statement)) {
						print "<tr>";
						for ($i = 1; $i <= $numcols; $i++) {
							$col = oci_result($Statement, $i);
							print "<td>$col</td>";
						}
						print "<tr>";
					}
					print "<table>";
					oci_close($Connection);
				} else {
					var_dump(oci_error($Connection));
				}
			} else {
				?>
				<form name = 'general' method = 'post' action = ''>
					<select name = 'tables'>
						<option value = 'BRANCH'> Branches </option>
						<option value = 'ROOM'> Rooms </option>
						<option value = 'EMPLOYEE'> Employees </option>
						<option value = 'CUSTOMER'> Customers </option>
						<option value = 'BOOKING'> Bookings </option>
						<option value = 'PRODUCT'> Products </option>
						<option value = 'PRODORDER'> Product Orders </option>
						<option value = 'SUPPLIER'> Suppliers </option>
						<option value = 'BRANCHSTOCK'> Branch Stock </option>
					</select>
					<input type = 'submit' name = 'generalSearch' value = 'Search'>
				</form>
				<?php
			}
		?>
	</body>
</html>