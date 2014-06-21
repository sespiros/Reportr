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
			SELECT * FROM web_reports INNER JOIN web_report_details ON web_reports.id = web_report_details.report_id WHERE status='Open' ORDER BY time_submitted";
		$all = $pdo->prepare($sql);
		if($all->execute())
			$count = count($all->fetchAll());
	}

	$sql1 = "
		SELECT * FROM web_reports INNER JOIN web_report_details ON web_reports.id = web_report_details.report_id WHERE status='Open' ORDER BY time_submitted LIMIT ". $max*($page-1) . "," . $max;
	$stmt = $pdo->prepare($sql1);
?>

<h3>Ανοιχτές Αναφορές</h3>
<div id="totalopen" class="hidden"><?php echo ceil($count/$max); ?></div>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Αριθμός αναφοράς</th>
			<th>Τίτλος</th>
			<th>Ώρα υποβολής</th>
			<th>Ενέργειες</th>
		</tr>
	</thead>
	<tbody>

<?php
    if ($stmt->execute()) {
		$index = 0;
        while ($row = $stmt->fetch()) {
            $imgStmt = $pdo->prepare("SELECT path FROM web_report_images WHERE report_id=:rid");
            $imgStmt->bindParam(':rid', $row['id']);
            if ($imgStmt->execute()) {
                $images = $imgStmt->fetchAll();
			}
?>
		<tr>
			<td><?php echo $row["id"]; ?></td>
			<td><?php echo $row["title"]; ?></td>
			<td><?php echo $row["time_submitted"]; ?></td>
			<td><a data-toggle="modal" data-target="#<?php echo $index; ?>" href="#">Προβολή</a></td>
		</tr>
		<!-- Modal -->
		<div class="modal fade" id="<?php echo $index; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $row["id"]; ?>label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $row["title"]; ?></h4>
			</div>
			<div class="modal-body">
<!-- to content tou modal einai opws einai sto my reports otan allakseis auto tha allaksw kai auto 
opote to afinw xima gia tin ora, BASIC FUNCTIONALITY ITHELES PARTO -->
				<div class="small-map-data hidden">
					<span data-lat="<?php echo $row['latitude']; ?>"></span>
					<span data-long="<?php echo $row['longitude']; ?>"></span>
				</div>
				<div class="small-map-view" id="map<?php echo $index; ?>"></div>
				<br>
				<p>
				<?php echo $row['description']; ?>
				<span class="label label-info">Ανοιχτή</span>
				</p>
				<div class="image-grid clearfix">
					<?php 
					$imgId = 0;
					foreach($images as $reportImage) { 
					$imgId++;
					?>
					<a href="<?php echo $reportImage['path']; ?>" data-lightbox="image-<?php echo $imgId; ?>"><img src="<?php echo $reportImage['path'];?>" alt=""></a>
					<?php } ?>
				</div>
				<br>
				<form id="f<?php echo $index; ?>" method="post" action="dashboard.php" role="form">
					<input type="hidden" name="report_id" value="<?php echo $row['id']; ?>">
					<div class="form-group">
						<textarea rows="3" class="form-control" name="comment" placeholder="Πρόσθήκη σχολίου"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-danger form-control" name="markClosed">Κλείσιμο αναφοράς</button>
					</div>
				</form>
			</div>
			</div> <!-- close modal-content -->
		</div> <!-- close modal-dialog -->
		</div> <!-- close modal -->
<?php
			$index++;
        }
    }
?>
    </tbody>
</table>
