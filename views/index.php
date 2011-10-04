
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>Blog</h2>
	
<?php
foreach ($records as $record) : ?>
<?php $record = (array)$record;?>
			<tr>
			<h3><?php echo $record['blog_name']; ?></h3>
			<?php echo $record['blog_content']; ?>
			
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
