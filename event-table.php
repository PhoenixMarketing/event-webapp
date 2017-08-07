<?php
session_start();

try {

	$objDb = new PDO('mysql:host=localhost;dbname=books', 'root', '');
	$objDb->exec('SET CHARACTER SET utf8');

	if (!isset($_SESSION['sort'])) {
		$_SESSION['sort']['by'] = 'title';
		$_SESSION['sort']['ad'] = 'ASC';
	}

	$by = $_SESSION['sort']['by'];
	$ad = $_SESSION['sort']['ad'];

	$sql = "SELECT *
	FROM `books`
	ORDER BY `{$by}` {$ad}";

	$statement = $objDb->query($sql);
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

	echo 'There was a problem with the database';

}

?>
<!DOCTYPE HTML>
<html lang="en">

<div id="wrapper">

	<table  cellpadding="0" cellspacing="0" border="0" class="tbl_repeat">
		<thead>
			<tr>
				<th><span class="sort<?php echo $by == 'title' ? ' '.strtolower($ad) : null; ?>" id="title">Title</span></th>
				<th><span class="sort<?php echo $by == 'author' ? ' '.strtolower($ad) : null; ?>" id="author">Author</span></th>
				<th><span class="sort<?php echo $by == 'category' ? ' '.strtolower($ad) : null; ?>" id="category">Category</span></th>
			</tr>
		</thead>
		<?php if (!empty($result)) { ?>
			<tbody>
				<?php foreach($result as $row) { ?>
					<tr>
						<td><?php echo $row['title']; ?></td>
						<td><?php echo $row['author']; ?></td>
						<td><?php echo $row['category']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
				<?php } ?>
			</table>

		</div>

		<script src="js/core.js" type="text/javascript"></script>

		</html>
