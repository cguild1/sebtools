<?php
include_once("../includes/config.php");
include_once($docpath."assets/functions/functions.prompts.php");


$page_title = "Prompts";
include ($docpath."includes/header.php");
// Fetch crawled pages
$stmt = $dbh->query("SELECT * FROM prompts ORDER BY id DESC");
$prompts = $stmt->fetchAll();
?>
<div class="container my-4">
	<h2>Admin Panel - AI Prompts</h2>
	<!-- Table -->
	<table id="sortableTable" class="table table-striped table-bordered w-100">
		<thead>
			<tr>
				<td>ID</th>
				<th>Model</th>
				<th>Type</th>
				<th>Prompt</th>
				<th>Role</th>
				<th>File</th>
				<th>Temp.</th>
				<th>Max Tokens</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($prompts as $prompt): 
		?>
			<tr>
				<td><?php echo $prompt['id']; ?></td>
				<td>
					<?php echo $prompt['ai_model']; ?>
				</td>
				<td><?php echo htmlspecialchars($prompt['prompt_type']); ?></td>
				<td><?php echo $prompt['prompt']; ?></td>
				<td><?php echo $prompt['prompt_role_content']; ?></td>
				<td><?php echo $prompt['prompt_file']; ?></td>
				<td><?php echo $prompt['temperature']; ?></td>
				<td><?php echo $prompt['max_tokens']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?php include ($docpath."includes/footer.php");?>
<?php include ($docpath."includes/footer-close.php");?>
<?php
/*AI Settings (See function.VehicleFitmentDetails.php)
		$prompt_type = "engine-brand";
		$prompts = fetchAIPrompt($dbp, $prompt_type);

		foreach ($prompts as $prompt) {
			// Array-based str_replace() for multiple replacements
			//$search = ["[[fullsemaname]]", "[[year]]", "[[make]]", "[[model]]"];
			//$replace = [$fullsemaname, $year, $make, $model];
			$search = ["[[fullsemaname]]"];
			$replace = [$fullsemaname];

			$modifiedPrompt = str_replace($search, $replace, $prompt['prompt']);
			$prompt_role_contentmod = str_replace($search, $replace, $prompt['prompt_role_content']);

			$ai_model = $prompt['ai_model'];
			$prompt = $modifiedPrompt;// GPT Prompt for AI-generated data
			$prompt_role_content = $prompt_role_contentmod;//GPT Role/Persona (what am i an expert in)
		}*/
?>