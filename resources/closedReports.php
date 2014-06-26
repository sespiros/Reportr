<?php
	require_once('../config/config.php');
	try {
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}

	// 1. Fetch reports
	$max = 20;
	$count = 0;
	if (isset($_POST['page']))
		$page = $_POST['page'];
	else{
		$page = 1;
		$sql = "
			SELECT * FROM web_reports INNER JOIN web_report_details ON web_reports.id = web_report_details.report_id WHERE status='Closed' ORDER BY time_closed";
		$all = $pdo->prepare($sql);
		if($all->execute())
			$count = count($all->fetchAll());
	}

	$sql1 = "
		SELECT * FROM web_reports INNER JOIN web_report_details ON web_reports.id = web_report_details.report_id WHERE status='Closed' ORDER BY time_closed LIMIT ". $max*($page-1) . "," . $max;
	$stmt = $pdo->prepare($sql1);
?>

<h3>Αναφορές Αρχείου</h3>
<div id="totalclosed" class="hidden"><?php echo ceil($count/$max); ?></div>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Αριθμός αναφοράς</th>
			<th>Τίτλος</th>
			<th>Ημερομηνία επίλυσης</th>
			<th>Admin</th>
		</tr>
	</thead>
	<tbody>

<?php
    if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
            // find admin who closed report
            $adminStmt = $pdo->prepare("SELECT user_name FROM web_users WHERE user_id=" . $row["closer_id"]);
            if ($adminStmt->execute()) {
                $adminRow = $adminStmt->fetch(PDO::FETCH_ASSOC);
                $admin = $adminRow["user_name"];
            }
?>
		<tr>
			<td><?php echo $row["id"]; ?></td>
			<td><?php echo $row["title"]; ?></td>
			<td><?php echo $row["time_closed"]; ?></td>
                        <td><?php echo $admin; ?></td>
		</tr>
<?php
		}
    }
?>
    </tbody>
</table>
