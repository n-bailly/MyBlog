<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
/**
 * A exécuter quelque soit la page
 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('assets');
		$this->titre = 'Mon super site';
		$this->css = asset_css('blog');
	}
	
/**
 * Page par défaut
 */
	public function index()
	{
		$this->display_all();
	}
	
	private function format($str){
		$this->load->helper('smiley');
		$this->load->helper('typography');
		return str_replace("\n", "",
			auto_typography(
				parse_smileys(
						$str, asset_url('smileys/')
				)
			)
		);
	}
	
	
	public function display_all()
	{
		$data = array();
		$this->load->model('Post_model');
		$posts = $this->Post_model->list_posts();
		foreach ($posts as $i => $post) {
			$title = $post->title;
			$content = $this->format($post->content);
			$date = $post->date_added;
			$data["posts"][$i] = array(
				"title" => $title,
				"content" => $content,
				"date" => $date,
			);
		}

		
		$this->load->view('banner',array('title' => 'coucou', 'css' => $this->css));
		$this->load->view('list',$data);
	}
	
	public function display_post($id=1)
	{
		
			$this->load->library('form_validation');
 
		$this->form_validation->set_error_delimiters('<span>', '</span>');			
			
		$this->form_validation->set_rules(
				'name',
				'"Nom d\'utilisateur"',
				'required'
		);

		$this->form_validation->set_rules(
				'mail',
				'"e-mail"',
				'required'
		);

		if ($this->form_validation->run()) {
			echo "bravo";
		}
		
		else
		{
			$data = array();
			$this->load->model('Post_model');
			$this->load->helper('typography');
			$this->load->helper('smiley');
			$post = $this->Post_model->get_post($id);
				$title = $post->title;
				$content = $post->content;
				$date = $post->date_added;
				$data["post"] = array(
					"title" => $title,
					"content" => $this->format($content),
					"date" => $date,
				);
			$this->load->view('banner',array('title' => 'coucou', 'css' => $this->css));
			$this->load->view('post',$data);
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */