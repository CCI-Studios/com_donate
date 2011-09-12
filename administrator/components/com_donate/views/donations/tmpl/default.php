<? defined('KOOWA') or die; ?>
<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />

<form action="<?= @route() ?>" method="get" class="-koowa-grid">
	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%"><?= @helper('grid.checkall'); ?></th>
				
				<th><?= @helper('grid.sort', array('column' => 'last_name', 'title' => 'Name')) ?></th>
				
				<th width="75"><?= @helper('grid.sort', array('column' => 'volunteer')) ?></th>
				<th width="1%"><?= @helper('grid.sort', array('column' => 'status')) ?></th>
				<th width="1%"><?= @helper('grid.sort', array('column' => 'id')) ?></th>
			</tr>
		</thead>
		
		<tfoot>
			<tr>
				<td colspan="99">
					<?= @helper('paginator.pagination', array('total' => $total)) ?>
				</td>
			</tr>
		</tfoot>
		
		<tbody>
			<? foreach($donations as $donation): ?>
			<tr>
				<td><?= @helper('grid.checkbox', array('row' => $donation)) ?></td>
				
				<td><a href="<?= @route('view=donation&id='. $donation->id) ?>">
					<?= $donation->last_name .', '. $donation->first_name ?>
				</a></td>
				
				<td align="center"><?= $donation->volunteer ?></td>
				<td align="center"><?= $donation->status ?></td>
				<td align="center"><?= $donation->id ?></td>
			</tr>
			<? endforeach; ?>
		</tbody>
	</table>
	
</form>