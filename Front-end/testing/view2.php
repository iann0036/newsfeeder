<?php
	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT'])); 
	require_once ROOT.'/classes/DatabaseConnection.php';
	require_once ROOT.'/classes/AccountsManager.php';
	require_once ROOT.'/classes/GUIMaker.php';
	require_once ROOT.'/classes/User.php';
	
	if (!User::validUser())
		trigger_error("Not logged in");
	
	/* This script is not published */
	
	$db = new DatabaseConnection();

	$gui = new GUIMaker();
	$sheets = new Sheets();
	$sheet = $sheets->getElementById($_GET['sheetid']);
	
	$gui->header();
	$gui->user_details();
	$gui->navigation(3);
?>
	<div id="content" class="xfluid">
		
		<div class="portlet x12" style="min-height: 300px;">
			
			<div class="portlet-header">
				<h4><?php echo $sheet['name']; ?></h4>
			</div>
			
			<div class="portlet-content">
				<table cellpadding="0" cellspacing="0" border="0" class="display">

					<thead>

						<tr>

							<th></th>

							<th>Source</th>

							<th>Title</th>

							<th>Description</th>

							<th>Time</th>

						</tr>

					</thead>

					<tbody>

						<tr class="odd gradeX">

							<td class="center"><input type="checkbox" /></td>

							<td><b>ABC News</b></td>

							<td><b>Search underway for boy washed down river</b></td>

							<td>A search is underway for a boy last seen floating in a river at Wagga Wagga in southern New South Wales.</td>

							<td><b>12:00AM</b></td>

						</tr>

						<tr class="odd gradeC">

							<td class="center"><input type="checkbox" /></td>

							<td><b>ABC News</b></td>

							<td><b>Search underway for boy washed down river</b></td>

							<td>A search is underway for a boy last seen floating in a river at Wagga Wagga in southern New South Wales.</td>

							<td><b>12:00AM</b></td>

						</tr>

						<tr class="read gradeA">

							<td class="center"><input type="checkbox" /></td>

							<td>ABC News</td>

							<td>Search underway for boy washed down river</td>

							<td>A search is underway for a boy last seen floating in a river at Wagga Wagga in southern New South Wales.</td>

							<td>12:00AM</td>

						</tr>

						<tr class="read gradeA">

							<td class="center"><input type="checkbox" /></td>

							<td>ABC News</td>

							<td>Search underway for boy washed down river</td>

							<td>A search is underway for a boy last seen floating in a river at Wagga Wagga in southern New South Wales.</td>

							<td>12:00AM</td>

						</tr>

						</tbody>

					</table>
				</div>
			</div>	
		</div>
<?php
	$gui->footer();
?>