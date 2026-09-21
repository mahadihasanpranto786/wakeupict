<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_blog extends CI_Model
{

	public function set_data($table, $data)
	{
		$this->db->trans_start();
		$this->db->insert($table, $data);
		$returnValue = $this->db->insert_id();
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$error = $this->db->error();
			print_r($error);
		} else {
			return $returnValue;
		}
	}
	public function get_data_multi_conditional($table, $data)
	{
		$this->db->where($data);
		$query = $this->db->get($table);
		return $query;
	}
	public function update_data($table, $index, $identifier, $data)
	{
		$this->db->where($index, $identifier);
		$this->db->update($table, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_single_desc_information($table, $id, $data)
	{
		$this->db->order_by($id, "desc");
		$this->db->where($data);
		$query = $this->db->get($table);
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}
	function delete_data($table, $index, $data)
	{
		$this->db->where($index, $data);
		$this->db->delete($table);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function count_data($table, $index, $data)
	{
		$this->db->where($index, $data);
		$this->db->get($table);
		if ($this->db->affected_rows() > 0) {
			return $this->db->affected_rows();
		} else {
			return 0;
		}
	}
	public function get_single_row_information($table, $data)
	{
		$this->db->where($data);
		$query = $this->db->get($table);
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}





	public function getBlogCatByJoinBySearch($col, $title, $limit, $offset)
	{
		$this->db->select('*');
		$this->db->join('b_blog', 'b_blog.b_id = b_blog_category.blog_id');
		$this->db->where('b_b_cat_status', 1);
		$this->db->where('b_status', 1);
		$this->db->like($col, "$title", "both");
		$this->db->limit($limit, $offset);
		$query = $this->db->get('b_blog_category');
		if ($this->db->affected_rows() > 0) {
			return $query;
		} else {
			return FALSE;
		}
	}
	public function getBlogCatByJoinBySearch_count($col, $title, $limit, $offset)
	{
		$this->db->select('*');
		$this->db->join('b_blog', 'b_blog.b_id = b_blog_category.blog_id');
		$this->db->where('b_b_cat_status', 1);
		$this->db->where('b_status', 1);
		$this->db->like($col, "$title", "both");
		$this->db->limit($limit, $offset);
		$query = $this->db->get('b_blog_category');
		if ($this->db->affected_rows() > 0) {
			return $this->db->affected_rows();
		} else {
			return 0;
		}
	}
	public function get_data_multi_asc_conditional($table, $data, $id)
	{
		$this->db->order_by($id, "ASC");
		$this->db->where($data);
		$query = $this->db->get($table);
		return $query;
	}

	public function getBlogCatByJoinById($id)
	{
		$this->db->join('b_blog', 'b_blog.b_id = b_blog_category.blog_id');
		$this->db->where('b_b_cat_status', 1);
		$this->db->where('cat_id', $id);
		$this->db->where('b_status', 1);
		$query = $this->db->get('b_blog_category');
		if ($this->db->affected_rows() > 0) {
			return $query;
		} else {
			return FALSE;
		}
	}
	public function getBlogTagByJoinById($id)
	{
		$this->db->join('b_blog', 'b_blog.b_id = b_blog_tag.tag_id');
		$this->db->where('b_status', 1);
		$this->db->where('tag_id', $id);
		$this->db->where('b_b_tag_status', 1);
		$query = $this->db->get('b_blog_tag');
		if ($this->db->affected_rows() > 0) {
			return $query;
		} else {
			return FALSE;
		}
	}
	public function table_join_multi_condition($titleTableName, $titlePrimaryKey, $idTableName, $idPrimaryKey, $data)
	{
		$this->db->join($titleTableName, $titleTableName . "." . $titlePrimaryKey . '=' . $idTableName . "." . $idPrimaryKey);
		$this->db->where($data);
		$query = $this->db->get($idTableName);
		if ($this->db->affected_rows() > 0) {
			return $query;
		} else {
			return FALSE;
		}
	}
	public function count_data_multi_conditional_join_like($titleTableName, $titlePrimaryKey, $idTableName, $idPrimaryKey, $data)
	{
		$this->db->join($titleTableName, $titleTableName . "." . $titlePrimaryKey . '=' . $idTableName . "." . $idPrimaryKey);
		$this->db->where($data);
		$this->db->get($idTableName);
		if ($this->db->affected_rows() > 0) {
			return $this->db->affected_rows();
		} else {
			return 0;
		}
	}
	public function multipleJoinTable_like_limit($titleTableName, $titlePrimaryKey, $idTableName, $idPrimaryKey, $data, $limit, $offset)
	{

		$this->db->join($titleTableName, $titleTableName . "." . $titlePrimaryKey . '=' . $idTableName . "." . $idPrimaryKey);
		$this->db->where($data);
		$this->db->limit($limit, $offset);
		$this->db->order_by("blog_id", "DESC");
		$query = $this->db->get($idTableName);
		if ($this->db->affected_rows() > 0) {
			return $query;
		} else {
			return FALSE;
		}
	}
}
