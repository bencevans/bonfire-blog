<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA . blog .'/'. blog .'/create'); ?>">
		<?php echo lang('blog_create_new_button'); ?>
	</a>

	<h3><?php echo lang('blog_create_new'); ?></h3>

	<p><?php echo lang('blog_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>Blog</h2>
	<table>
		<thead>
		
			
		<th>Name</th>
		<th>Slug</th>
		<th>Content</th>
		
			<th><?php echo lang('blog_actions'); ?></th>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;?>
			<tr>
			<?php foreach($record as $field => $value) : ?>
				
				<?php if ($field != 'id') : ?>
					<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('blog_true') : lang('blog_false')) : $value; ?></td>
				<?php endif; ?>
				
			<?php endforeach; ?>

				<td>
					<?php echo anchor(SITE_AREA .'/blog/blog/edit/'. $record[$primary_key_field], lang('blog_edit'), '') ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>