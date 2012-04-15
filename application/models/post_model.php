<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Post_model extends CI_Model
{
	protected $table = 'posts';

	/**
         * adds a post
	 *
	 *@param string $author     Author of the post
	 *@param string $title      Title of the post
	 *@param string $content    Content of the post
         *@param array  $tags       List of tags
	 *@return bool              Result of the query
         * 
	 */
	public function add_post($author, $title, $content, $tags)
	{
		return $this->db->set('author',	$author)
			        ->set('title', 	$title)
				->set('content',$content)
				->set('date_added', 'NOW()', false)
				->set('date_changed', 'NOW()', false)
				->insert($this->table);
	}
	
	/**
	 *	Édite une news déjà existante.
	 *	
	 *	@param integer $id	L'id de la news à modifier
	 *	@param string  $titre 	Le titre de la news
	 *	@param string  $contenu Le contenu de la news
	 *	@return bool		Le résultat de la requête
	 */
	public function editer_news($id, $titre = null, $contenu = null)
	{
		//	Il n'y a rien à éditer
		if($titre == null AND $contenu == null)
		{
			return false;
		}
		
		//	Ces données seront échappées
		if($titre != null)
		{
			$this->db->set('titre', $titre);
		}
		if($contenu != null)
		{
			$this->db->set('contenu', $contenu);
		}
		
		return $this->db->set('date_modif', 'NOW()', false)
				->where('id', (int) $id)
				->update($this->table);
	}
	
	/**
	 *	Supprime une news.
	 *	
	 *	@param integer $id	L'id de la news à modifier
	 *	@return bool		Le résultat de la requête
	 */
	public function supprimer_news($id)
	{
		return $this->db->where('id', (int) $id)
				->delete($this->table);
	}
	
	/**
	 *	Retourne le nombre de news.
	 *	
	 *	@param array $where	Tableau associatif permettant de définir des conditions
	 *	@return integer		Le nombre de news satisfaisant la condition
	 */
	public function count($where = array())
	{
		return (int) $this->db->where($where)
				      ->count_all_results($this->table);
	}
	
	/**
	 *	Retourne une liste de $nb dernière news.
	 *	
	 *	@param integer $nb	Le nombre de news
	 *	@param integer $debut	Nombre de news à sauter
	 *	@return objet		La liste de news
	 */
	public function list_posts($nb = 10, $debut = 0)
	{
		return $this->db->select('*')
				->from($this->table)
				->limit($nb, $debut)
				->order_by('id', 'desc')
				->get()
				->result();
	}
	
	public function get_post($id)
	{
		return $this->db->select('*')
				->from($this->table)
				->where("id", $id)
				->get()
				->row();
	}
}