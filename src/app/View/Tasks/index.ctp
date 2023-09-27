<?php echo $this->HTML->link('新規タスク', '/Tasks/create'); ?>
<h3><?php echo count($tasks_data); ?>件のタスクが未完了です。</h3>
<table>
	<tr>
		<th>ID</th>
		<th>名前</th>
		<th>期限日</th>
		<th>作成日</th>
		<th>操作</th>
	</tr>
<?php foreach ($tasks_data as $row): ?>
	<tr>
		<td><?php echo $this->Html->link(
			$row['Task']['id'],
			'/Tasks/view/' . $row['Task']['id']
		); ?></td>
		<td>
			<?php echo h($row['Task']['name']); ?>
			<br/>
			<ul>
				<?php foreach ($row['Note'] as $note): ?>
					<li><?php echo h($note['body']); ?></li>
				<?php endforeach; ?>
			</ul>
		</td>
		<td><?php echo h($row['Task']['due_date']); ?></td>
		<td><?php echo h($row['Task']['created']); ?></td>
		<td><?php echo $this->Html->link(
			'このタスクを完了する',
			'/Tasks/done/' . $row['Task']['id']
		); ?></td>
	</tr>
<?php endforeach; ?>
</table>
