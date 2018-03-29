<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tags_model extends CI_Model
{

    public function getAllTags()
    {
        $result = '';
        $query  = $this->db->query("SELECT * from tag_categories");
        $result = $query->result_array();

        foreach ($result as $result_single) {
            $tags[$result_single['tag_category_id']] = $result_single;
            $query_sub                               = $this->db->query("SELECT * from tag_sub_categories WHERE tag_parent_id = '" . $result_single['tag_category_id'] . "'");
            $result_sub                              = $query_sub->result_array();

            foreach ($result_sub as $result_sub_single) {

                $tags[$result_single['tag_category_id']]['sub_category'][$result_sub_single['tag_sub_category_id']] = $result_sub_single;

                $query_tags  = $this->db->query("SELECT * from tags WHERE tag_parent_id = '" . $result_sub_single['tag_sub_category_id'] . "'");
                $result_tags = $query_tags->result_array();

                foreach ($result_tags as $result_tags_single) {
                    $tags[$result_single['tag_category_id']]['sub_category'][$result_sub_single['tag_sub_category_id']]['tags'][$result_tags_single['tag_id']] = $result_tags_single;
                }
            }

        }

        return $tags;
    }

    public function getSubCatParentCat()
    {

        $query = $this->db->query("SELECT * from tag_sub_categories");
        $sub   = $query->result_array();

        foreach ($sub as $sub_single) {
            $full_sub[$sub_single['tag_sub_category_id']] = $sub_single['tag_parent_id'];
        }

        return $full_sub;

    }

    public function getTagsCategory()
    {

        $query  = $this->db->query("SELECT * from tag_categories");
        $result = $query->result_array();

        return $result;

    }

    public function getTagsSubCategory()
    {

        $query  = $this->db->query("SELECT * from tag_categories");
        $result = $query->result_array();

        foreach ($result as $result_single) {

            $query = $this->db->query("SELECT * from tag_sub_categories WHERE tag_parent_id = " . $result_single['tag_category_id']);
            $sub   = $query->result_array();

            $sub_cats[$result_single['tag_category_id']] = $sub;

        }

        return $sub_cats;

    }

    public function getContactTags($tags)
    {

        $return_tags = array();

        $tags          = explode(",", $tags);
        $tags_full     = array();
        $pre_tag_array = array();
        foreach ($tags as $tags_single) {
            if (empty($tags_single)) {continue;}
            $query_tag  = $this->db->query("SELECT * from tags WHERE tag_id = '" . $tags_single . "'");
            $result_tag = $query_tag->result_array();

            if (!empty($result_tag[0])) {
                $pre_tag_array[$result_tag[0]['tag_parent_id']][] = $result_tag[0];
            }

        }

        foreach ($pre_tag_array as $key => $pre_tag_array_single) {
            $query_parent                                     = $this->db->query("SELECT * from tag_sub_categories WHERE tag_sub_category_id = '" . $key . "'");
            $parent_tag                                       = $query_parent->result_array();
            $tags_full[$parent_tag[0]['tag_parent_id']][$key] = $parent_tag[0];

            foreach ($pre_tag_array_single as $pre_tag_array_single_loop) {
                $tags_full[$parent_tag[0]['tag_parent_id']][$key]['tags'][] = $pre_tag_array_single_loop;

            }

        }

        foreach ($tags_full as $key => $tags_full_single) {
            $query_parent_tag = $this->db->query("SELECT * from tag_categories WHERE tag_category_id = '" . $key . "'");
            $parent_tag_tag   = $query_parent_tag->result_array();

            $return_tags[$key] = $parent_tag_tag[0];
            foreach ($tags_full_single as $key_2 => $tags_full_single_single) {
                $return_tags[$key]['sub_category'] = $tags_full_single;
            }

        }

        return ($return_tags);

    }

    public function deleteTagFromContacts($tags)
    {

        $contacts_with_tag  = $this->db->query("SELECT * FROM `contacts` WHERE `tags` LIKE '%," . $tags . ",%'");
        $contacts_with_tags = $contacts_with_tag->result_array();

        foreach ($contacts_with_tags as $contacts_with_tags_single) {

            $query = $this->db->query("UPDATE contacts
       SET
       tags = '" . str_replace(',' . $tags . ',', ',', $contacts_with_tags_single['tags']) . "' WHERE id = " . $contacts_with_tags_single['id']);
        }

        $contacts_with_tag  = $this->db->query("SELECT * FROM `contacts` WHERE `tags` LIKE '" . $tags . ",%'");
        $contacts_with_tags = $contacts_with_tag->result_array();

        foreach ($contacts_with_tags as $contacts_with_tags_single) {

            $query = $this->db->query("UPDATE contacts
       SET
       tags = '" . str_replace('' . $tags . ',', '', $contacts_with_tags_single['tags']) . "' WHERE id = " . $contacts_with_tags_single['id']);
        }

    }

    public function deleteTag($tag)
    {

        $query = $this->db->query("DELETE FROM tags
       WHERE tag_id = " . $tag);

    }

}
