<?php echo $this->Session->flash('auth'); ?>

<!-- Table only for tabular data -->
<table class="table">
	<thead>
		<tr>
			<th><?php echo __('Last logins'); ?></th>
			<th><?php echo __('Timestamp'); ?></th>
		<tr>
	</thead>
	<tbody>
		<?php foreach ($user['Login'] as $login) : ?>
			<tr>
				<td><?php echo $this->Time->timeAgoInWords($login['created']); ?></td>
				<td><?php echo $login['created']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>