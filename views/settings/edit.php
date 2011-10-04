
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($blog) ) {
	$blog = (array)$blog;
}
$id = isset($blog['id']) ? "/".$blog['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<div>
        <?php echo form_label('Name', 'blog_name'); ?> <span class="required">*</span>
        <input id="blog_name" type="text" name="blog_name" maxlength="200" value="<?php echo set_value('blog_name', isset($blog['blog_name']) ? $blog['blog_name'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Slug', 'blog_slug'); ?> <span class="required">*</span>
        <input id="blog_slug" type="text" name="blog_slug" maxlength="200" value="<?php echo set_value('blog_slug', isset($blog['blog_slug']) ? $blog['blog_slug'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Content', 'blog_content'); ?>
	<?php echo form_textarea( array( 'name' => 'blog_content', 'id' => 'blog_content', 'rows' => '5', 'cols' => '80', 'value' => set_value('blog_content', isset($blog['blog_content']) ? $blog['blog_content'] : '') ) )?>
</div>


	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Edit Blog" /> or <?php echo anchor(SITE_AREA .'/settings/blog', lang('blog_cancel')); ?>
	</div>
	<?php echo form_close(); ?>

	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/settings/blog/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('blog_delete_confirm'); ?>')"><?php echo lang('blog_delete_record'); ?></a>
		
		<h3><?php echo lang('blog_delete_record'); ?></h3>
		
		<p><?php echo lang('blog_edit_text'); ?></p>
	</div>
