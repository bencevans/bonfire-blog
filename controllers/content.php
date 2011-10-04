<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Blog.Content.View');
		$this->load->model('blog_model', null, true);
		$this->lang->load('blog');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		$data = array();
		$data['records'] = $this->blog_model->find_all();

		Assets::add_js($this->load->view('content/js', null, true), 'inline');
		
		Template::set('data', $data);
		Template::set('toolbar_title', "Manage Blog");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a Blog object.
	*/
	public function create() 
	{
		$this->auth->restrict('Blog.Content.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_blog())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('blog_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'blog');
					
				Template::set_message(lang("blog_create_success"), 'success');
				Template::redirect(SITE_AREA .'/content/blog');
			}
			else 
			{
				Template::set_message(lang('blog_create_failure') . $this->blog_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('blog_create_new_button'));
		Template::set('toolbar_title', lang('blog_create') . ' Blog');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of Blog data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Blog.Content.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('blog_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/blog');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_blog('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('blog_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'blog');
					
				Template::set_message(lang('blog_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('blog_edit_failure') . $this->blog_model->error, 'error');
			}
		}
		
		Template::set('blog', $this->blog_model->find($id));
	
		Template::set('toolbar_title', lang('blog_edit_heading'));
		Template::set('toolbar_title', lang('blog_edit') . ' Blog');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of Blog data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Blog.Content.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->blog_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('blog_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'blog');
					
				Template::set_message(lang('blog_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('blog_delete_failure') . $this->blog_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/content/blog');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_blog()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_blog($type='insert', $id=0) 
	{	
					
$this->form_validation->set_rules('blog_name','Name','required|trim|max_length[200]');			
$this->form_validation->set_rules('blog_slug','Slug','required|unique[bf_blog.blog_slug.id.'.$id.']|trim|max_length[200]');			
$this->form_validation->set_rules('blog_content','Content','');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		if ($type == 'insert')
		{
			$id = $this->blog_model->insert($_POST);
			
			if (is_numeric($id))
			{
				$return = $id;
			} else
			{
				$return = FALSE;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->blog_model->update($id, $_POST);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}