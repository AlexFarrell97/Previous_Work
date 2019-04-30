<html>
	<head>
		<title>Booking Search</title>
	</head>
	<body>
		<a href = "index.html">HomePage</a> | <a href = "generalSearch.php">General Search</a><br><br>
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				putenv("ORACLE_SID=teaching");
				if($Connection = oci_connect("w4s22", "stevenagefc")) {
					$value = $_POST['branches'];
					$sql = "SELECT BRANCHSTOCK.branchID, PRODUCT.productName, PRODUCT.theme, SUPPLIER.supplierName, BRANCHSTOCK.stockLevel FROM BRANCHSTOCK INNER JOIN PRODUCT ON BRANCHSTOCK.productID=PRODUCT.productID INNER JOIN SUPPLIER ON BRANCHSTOCK.supplierID=SUPPLIER.supplierID WHERE BRANCHSTOCK.branchID = '" . $value . "'";
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
				<form name = 'booking' method = 'post' action = ''>
					<select name = 'branches'>
						<option value = 'br1'> Branch 1 </option>
						<option value = 'br2'> Branch 2 </option>
						<option value = 'br3'> Branch 3 </option>
						<option value = 'br4'> Branch 4 </option>
						<option value = 'br5'> Branch 5 </option>
					</select>
					<input type = 'submit' name = 'bookingSearch' value = 'Search'>
					<br>
				</form>
				<?php
			}
		?>
	</body>
</html>