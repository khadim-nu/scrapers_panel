<?php

class MY_Model extends CI_Model {

    public $table_name = '';
    public $primary_key = 'id';
     public $today_datetime = "";
    public $current_time_stamp = "";

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Karachi');
//         date_default_timezone_set('Asia/Dubai');
        $dt = new DateTime();
        if (isset($_POST['today_date_time']) && !empty($_POST['today_date_time'])) {
            $this->today_datetime = $_POST['today_date_time'];
        } else {
            $this->today_datetime = $dt->format('Y-m-d H:i:s');
        }
        $this->current_time_stamp = $dt->format('YmdHis');
        
        $this->load->helper(array('form', 'url', 'date', 'array', 'text'));
        $this->load->library('upload');
    }

    public function get_all($limit = FALSE, $start = 0, $order_by = false, $where_column_name = NULL, $where_column_value = NULL, $where_second_column_name = NULL, $where_second_column_value = NULL, $is_in_query = False, $select = FALSE) {
        $query = $this->db;
        if ($select) {
            $query = $query->select($select);
        }
        if ($limit)
            $this->db->limit($limit, $start);
        if ($where_column_name && $where_column_value) {
            if ($is_in_query) {
                $query = $query->where_in($where_column_name, $where_column_value);
            } else {
                $query = $query->where($where_column_name, $where_column_value);
            }
            if ($where_second_column_name) {
                $query = $query->where($where_second_column_name, $where_second_column_value);
            }
        }
        if ($order_by) {
            $this->db->order_by($order_by);
        }

        return $query->get($this->table_name)->result_array();
    }

    public function get_all_custom_where($where, $select = FALSE) {
        $query = $this->db;
        if ($select) {
            $query = $query->select($select);
        }
        $query = $query->where($where);
        return $query->get($this->table_name)->result_array();
    }

    public function extract_from_array($array, $column) {
        $ids = array();
        foreach ($array as $value) {
            array_push($ids, $value[$column]);
        }
        return $ids;
    }

    public function get_single($column, $column_value, $in_query = FALSE) {
        if ($in_query) {
            $this->db->where_in(array($column => $column_value));
            $query = $this->db->get($this->table_name);
        } else {
            $query = $this->db->get_where($this->table_name, array($column => $column_value));
        }

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    /*
     * @param id: which will match with primary defined at the initiation of model
     * return array 
     */

    public function get_record_by_id($id) {

        $this->db->where($this->primary_key, $id);
        if (is_player()) {
            $this->db->where('status', 1);
        } else if (is_developer()) {
            $this->db->where('developerID', $this->session->userdata('user_data')->id);
        }
        return $this->db->get($this->table_name)->result_array();
    }

    /*
     *  @param data: assosciate array
     *  @param id: to update record if NULL it will insert opt
     *  @return :affected rows or id in case of insert performed
     */

    public function save($data, $id = FALSE, $column_name = FALSE) {
        if ($id) {
            $column = $this->primary_key;
            if ($column_name)
                $column = $column_name;

            $this->db->set($data)->where($column, $id)->update($this->table_name);
            $id = $this->db->affected_rows();
        } else {
            // This is an insert
            $this->db->set($data)->insert($this->table_name);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    /*
     * 
     * methods for Admin, Player,  Developer Controoler
     * 
     */



    /*
     * 
     * 
     * @param id: of record
     * 
     * @return : affected number of rows
     */

    public function remove_record($id) {
        $this->db->where($this->primary_key, $id);
        $this->db->delete($this->table_name);
        return $this->db->affected_rows();
    }

    public function remove_record_where($where_condition, $where_value) {
        $this->db->where($where_condition, $where_value);
        $this->db->delete($this->table_name);
        return $this->db->affected_rows();
    }

    /*
     * 
     * 
     * @param id: 
     * 
     * @return : Count of all the records
     */

    public function record_statistics($where_column_name = NULL, $where_column_value = NULL, $gameID = NULL) {
        $this->db->select(' MONTH(created_at) as month, COUNT(*) as value ');
        if ($where_column_name != NULL) {
            $this->db->where($where_column_name . ' = ' . $where_column_value . ' AND YEAR(created_at) = YEAR(CURDATE())');
        } else {
            $this->db->where(' YEAR(created_at) = YEAR(CURDATE())');
        }
        if ($gameID != NULL) {
            $this->db->where('gameID', $gameID);
        }
        $this->db->group_by('MONTH(created_at)');
        $this->db->order_by('month', 'ASC');
        $query = $this->db->get($this->table_name);
        //$this->output->enable_PROFILER(TRUE);
        if ($query->num_rows() > 0) {
            $query = $query->result_array();
            return $query;
        } else {
            return FALSE;
        }
    }

    public function db_result_to_string($query) {
        $str = '';
        foreach ($query as $value) {
            $str.=(implode("=", $value)) . ',';
        }
        return $str;
    }

    public function record_count($where_column_name = NULL, $where_column_value = NULL) {
        if ($where_column_name == NULL) {
            return $this->db->count_all($this->table_name);
        } else {
            if (is_integer($where_column_value)) {
                $this->db->where($where_column_name, $where_column_value);
            } else {
                $this->db->like($where_column_name, $where_column_value);
            }
            $this->db->from($this->table_name);
            return $this->db->count_all_results();
        }
    }

    /*
     *
     *  
     * @param where: where clause
     * @param data: key value pair of data to be updated
     * 
     * @return : Count of all the records
     */

    public function updateByCondition($where, $data) {
        $this->db->where($where);
        $this->db->update($this->table_name, $data);

        return $this->db->affected_rows();
    }

    /*
     * 
     * 
     * @param where: where clause
     * 
     * @return : Count of all the records
     */

    public function findByCondition($where, $order_by = false, $group_by = false, $select = '*', $like = null) {
        $this->db->select($select)
                ->from($this->table_name)
                ->where($where);
        if ($like) {
            $this->db->like($like['column'], $like['value'], 'both');
        }
        if ($group_by) {
            $this->db->group_by($group_by);
        }
        if ($order_by) {
            $this->db->order_by($order_by);
        }
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
        return false;
    }

    public function record_search_count($where_column_name = NULL, $where_column_value = NULL) {

        $this->db->like($where_column_name, $where_column_value);
        $query = $this->db->get($this->table_name);
        return $query->num_rows();
    }

    /*
     * 
     * 
     * @param limit: Limit of rows per page
     * @param start: Position index of rows to start
     * 
     * @return : Count of all the records
     */

    public function fetch_limit($limit, $start, $where_column_name = NULL, $where_column_value = NULL, $order_by = false) {
        $this->db->limit($limit, $start);
        if ($where_column_name && $where_column_value) {
            $this->db->where($where_column_name, $where_column_value);
        }
        if ($order_by) {
            $this->db->order_by($order_by);
        }
        $query = $this->db->get($this->table_name);


        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    /*
     * 
     * 
     * @param limit: Limit of rows per page
     * @param start: Position index of rows to start
     * @param ambiguous_alias_select: Select the columns from the join query, and mention table alias for any common column between tables
     * @param table1: First table for join
     * @param table2: Second table for join
     * @param join_condition: Join condition between the two tables
     * @param where_column_name: column name to be put in where clause
     * @param where_column_value: value to be compared in that column
     * @param direction: direction of the join, i.e. left or right
     *   
     * @return : All the records
     */

    public function fetch_join_limit($limit, $start, $ambiguous_alias_select, $table1, $table2, $join_condition, $where_column_name = NULL, $where_column_value = NULL, $direction = '', $where_second_column_name = NULL, $where_second_column_value = NULL, $is_in_query = FALSE, $order_by = false) {
        $this->db->select($ambiguous_alias_select);
        $this->db->from($table1);
        $this->db->join($table2, $join_condition, $direction);
        if ($limit)
            $this->db->limit($limit, $start);
        if ($where_column_name && $where_column_value) {
            if ($is_in_query)
                $this->db->where_in($where_column_name, $where_column_value);
            else
                $this->db->where($where_column_name, $where_column_value);
            if ($where_second_column_name && $where_second_column_value) {
                $this->db->where($where_second_column_name, $where_second_column_value);
            }
        }
        if ($order_by) {
            $this->db->order_by($order_by);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    /*
     * 
     * 
     * @param limit: Limit of rows per page
     * @param start: Position index of rows to start
     * @param ambiguous_alias_select: Select the columns from the join query, and mention table alias for any common column between tables
     * @param table1: First table for join
     * @param table2: Second table for join
     * @param join_condition: Join condition between the two tables
     * @param table3: Third table for join
     * @param join_condition2: Join condition for the third table, either with table1 with 2, or 2 with 3, etc.
     * @param where: where clause condition
     * @param direction: direction of the join, i.e. left or right
     * @param direction2: direction of the second join, i.e. left or right
     * @param group_by: group records by a column and take their join
     * 
     * @return : All the records
     */

    public function fetch_join_triple_limit($limit, $start, $ambiguous_alias_select, $table1, $table2, $join_condition, $table3, $join_condition2, $where = null, $direction = '', $direction2 = '', $group_by = false) {
        $this->db->select($ambiguous_alias_select);
        $this->db->from($table1);
        $this->db->join($table2, $join_condition, $direction);
        $this->db->join($table3, $join_condition2, $direction2);
        $this->db->limit($limit, $start);

        if ($where) {
            $this->db->where($where);
        }
        if ($group_by) {
            $this->db->group_by($group_by);
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    /*
     * 
     * 
     * @param limit: Limit of rows per page
     * @param start: Position index of rows to start
     * @param ambiguous_alias_select: Select the columns from the join query, and mention table alias for any common column between tables
     * @param table1: First table for join
     * @param table2: Second table for join ------
     * @param join_condition: Join condition between the two tables -- 
     * @param table3: Third table for join -- 
     * @param join_condition2: Join condition for the third table, either with table1 with 2, or 2 with 3, etc. ---
     * @param where_column_name: column name to be put in where clause
     * @param where_column_value: value to be compared in that column
     * @param direction: direction of the join, i.e. left or right --
     * @param direction2: direction of the second join, i.e. left or right --
     * @param group_by: group records by a column and take their join
     * 
     * @return : All the records
     */

    public function fetch_join_multiple_limit($limit = NULL, $start = NULL, $ambiguous_alias_select, $table1, $join_array, $where = NULL, $group_by = false, $order_by = false) {
        $this->db->select($ambiguous_alias_select);
        $this->db->from($table1);
        if (is_array($join_array)) {
            foreach ($join_array as $join) {
                $this->db->join($join['table'], $join['condition'], $join['direction']);
            }
        }

        if ($where) {
            $this->db->where($where);
        }
        if ($group_by) {
            $this->db->group_by($group_by);
        }
        if ($order_by) {
            $this->db->order_by($order_by);
        }
        if ($limit != NULL && $start != NULL) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function upload_it($config, $file) {
        $this->upload->initialize($config);
        $this->upload->set_allowed_types($config['allowed_types']);
        if (!$this->upload->do_upload($file)) {
            $data = array('msg' => $this->upload->display_errors());
        } else {
            $data = array('msg' => "");
            $data['upload_data'] = $this->upload->data();
        }
        return $data;
    }

    public function upload_image($fileName) {
        ////////////////// uplading image/////////////////////////
        $this->load->library('upload');
        $dt = new DateTime();
        $dt = $dt->format('YmdHis');

        $config['upload_path'] = UPLOAD_PATH;
        $config['allowed_types'] = UPLOAD_IMAGE_TYPES;
        $config['max_size'] = UPLOAD_IMAGE_SIZE;
        // print_r($_FILES);die;
        if (!isset($_FILES[$fileName])) {
            $this->session->set_flashdata('message', ERROR_MESSAGE . ": file size is greater than " . UPLOAD_IMAGE_SIZE / 1024 . ' MB');
            return false;
        }
        $filenamex = end(explode(".", $_FILES[$fileName]['name']));
        $encripted_name = str_replace('.' . $filenamex, "", $_FILES[$fileName]['name']) . $dt . '.' . $filenamex;

        $config['file_name'] = $encripted_name; //$this->Game_model->encript_file_name($_FILES['profileImage']['name'], $dt);
        $profileImageData = $this->upload_it($config, $fileName);
        if (!isset($profileImageData['upload_data'])) {
            $this->session->set_flashdata('message', ERROR_MESSAGE . ": " . $profileImageData['msg']);
            return false;
        }
        return $profileImageData;
        /////////////////////////////////////
    }

    public function is_already_registered($email) {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    function date_validation($str) {
        $stamp = strtotime($str);
        if (!is_numeric($stamp)) {
            return FALSE;
        }
        $month = date('m', $stamp);
        $day = date('d', $stamp);
        $year = date('Y', $stamp);
        if (checkdate($month, $day, $year)) {
            return $year . '-' . $month . '-' . $day;
        }
        return FALSE;
    }

}
