<?php
	/*
	File name: /classes/DatabaseConnection.php
	Author: Ian Mckay <im607@uowmail.edu.au>
	Purpose: A database controller with methods for each SQL related query
	Last Modified: 10:44 PM 12/01/2012
	*/

	if (!defined('ROOT'))
		define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';

	/**
	 * A database controller with methods for each SQL related query
	 * 
	 * <code>
	 * $db = new DatabaseConnection();
	 * 
	 * $db->where('id',1);
	 * $rows = $db->get('table');
	 * </code>
	 * 
	 * <code>
	 * $db = new DatabaseConnection();
	 * 
	 * $data = array(
	 *     'field1' => 'value1',
	 *     'field2' => 'value2'
	 * );
	 * 
	 * $db->insert('table',$data);
	 * </code>
	 * 
	 * @author Ian Mckay <im607@uowmail.edu.au>
	 */
	class DatabaseConnection {
		/**
		 * Connection to the database
		 * @var mysqli
		 */
		private $mysqli = null;
		/**
		 * Currently stored SQL string
		 * @var string
		 */
		private $query;
		/**
		 * Array of parameters to match in the WHERE part of the SQL of the format $where[key] => value
		 */
		private $where = array();
		/**
		 * Array of tables to join in the SQL of the format $where[table] => 'leftattribute=rightattribute'
		 */
		private $join = array();
		/**
		 * Specifies the ORDER BY part of the SQL for correct syntax
		 */
		private $orderBy = array();
		
		/**
		 * Initializes DatabaseConnection class, connects to the database
		 */
		public function __construct() {
			// connect to database
			$this->mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_DATABASE);
			if (mysqli_connect_errno())
				trigger_error('Database Connection Error');
		}
		
		/**
		 * Returns the Database Connection (LEGACY METHOD, remove when no longer needed)
		 * @return mysqli returns the database connection
		 */
		public function getConnector() {
		    return $this->mysqli;
		}
		
		/**
		 * Builds the end of the SQL query with the data entered
		 * @param int $numRows optional maximum number of returned rows
		 * @param mixed $tableData optional data to be accessed, created or modified
		 * @return stmt returns the mysqli statement
		 */
		private function buildQuery($numRows = NULL, $tableData = false, $alternatecriteria = false) { // TODO: Note to self, revise this method
			$hasTableData = null;
			$paramTypeList = null;
			
			if (gettype($tableData)==='array')
				$hasTableData = true;
			
			// Did the user call the "join" method?
			while (!empty($this->join)) {
				$keys = array_keys($this->join);
				$table = $keys[0];
				$on = $this->join[$table];
				$this->query.=' INNER JOIN '.$table.' ON '.$on;
				array_splice($this->join,0,1);
			}

			// Did the user call the "where" method?
			$where_list = array();
			$flag = true;
			while (!empty($this->where)) {
				$keys = array_keys($this->where);
				$where_prop = $keys[0];
				$where_value = $this->where[$where_prop];
				$where_list[] = $where_value;

				// if update data was passed, filter through
				// and create the SQL query, accordingly.
				if ($hasTableData) {
					$i = 1;
					$pos = strpos($this->query, 'UPDATE');
					if ($pos!==false) {
						foreach ($tableData as $prop => $value) {
							// determines what data type the item is, for binding purposes.
							$paramTypeList.=$this->getType($value);

							// prepares the reset of the SQL query.
							if ($i==count($tableData))
								$this->query.=$prop.' = ?';
							else
								$this->query.=$prop.' = ?, ';
							$i++;
						}
					}
				}
				// implement the where criteria
				$paramTypeList.=$this->getType($where_value);
				if ($flag) {
				    $this->query.=' WHERE `'.$where_prop.'` = ?';
				    $flag = false;
				} else {
				    if ($alternatecriteria)
					$this->query.=' OR `'.$where_prop.'` = ?';
				    else
					$this->query.=' AND `'.$where_prop.'` = ?';
				}
				
				array_splice($this->where,0,1);
			}

			// Determine if is INSERT query
			if ($hasTableData) {
				$pos = strpos($this->query, 'INSERT');

				if ($pos !== false) {
					//is insert statement
					$keys = array_keys($tableData);
					$values = array_values($tableData);
					$num = count($keys);

					// wrap values in quotes
					foreach ($values as $key => $val) {
						$values[$key] = "'{$val}'";
						$paramTypeList.=$this->getType($val);
					}
					
					$this->query.=' (`'.implode($keys, '`, `').'`)';
					$this->query.=' VALUES (';
					while ($num !== 0) {
						if ($num !== 1)
							$this->query.='?, ';
						else
							$this->query.='?)';
						$num--;
					}
				}
			}

			// Did the user set an order
			if (count($this->orderBy)>0) {
				//die(var_dump($this->orderBy));
				$this->query.=" ORDER BY ".$this->orderBy[0];
				if ($this->orderBy[1])
				    $this->query.=" DESC";
				else
				    $this->query.=" ASC";
			}
			
			// Did the user set a limit
			if (isset($numRows))
				$this->query.=" LIMIT ".(int)$numRows;

			// Prepare query
			$stmt = $this->prepareQuery();

			// Bind parameters
			$args = array();
			$args[] = $paramTypeList;
			if ($hasTableData) {
				foreach ($tableData as $prop => $val)
					$args[] = &$tableData[$prop];
			}
			if (!empty($where_list)) { // if there is where criteria
				for ($i=0; $i<count($where_list); $i++) // this CANNOT be a foreach, it will lose scope
				    $args[] = &$where_list[$i];
			}
			
			if ($hasTableData || !empty($where_list))
				call_user_func_array(array($stmt, 'bind_param'), $args);
			
			return $stmt;
		}
		
		/**
		 * Asks the database to compile the query
		 * @return stmt returns the mysqli statement
		 */
		private function prepareQuery() { //echo "SQL Query: ".$this->query."<br>"; // DEBUG
			if (!$stmt = $this->mysqli->prepare($this->query))
				trigger_error('Query Preparation Error. Query: '.$this->query);
			
			return $stmt;
		}
		
		/**
		 * Method to bind data with their appropriate data types
		 * @param stmt $stmt the built mysqli statement
		 * @return mixed returns the key for the results of the query
		 */
		private function dynamicBind($stmt) {
			$parameters = array();
			$results = array();
			$meta = $stmt->result_metadata();

			while ($field = $meta->fetch_field()) {
				$parameters[] = &$row[$field->name];
			}

			call_user_func_array(array($stmt, 'bind_result'), $parameters);

			while ($stmt->fetch()) {
				$x = array();
				foreach ($row as $key => $val) {
					$x[$key] = $val;
				}
				$results[] = $x;
			}
			
			return $results;
		}
		
		/**
		 * Automatically determine an objects type
		 * @param type $item the object
		 * @return string|null returns the type charater if found, else null
		 */
		private function getType($item) {
			switch (gettype($item)) {
				case 'string':
					return 's';
					break;
				case 'integer':
					return 'i';
					break;
				case 'blob':
					return 'b';
					break;
				case 'double':
					return 'd';
					break;
				default:
					trigger_error('Database Type Error');
					return null;
			}
		}
		
		/**
		 * Builds parameter list
		 * @param mixed $params the parameters
		 * @return string returns the parameter list
		 */
		private function params($params) {
		    $return = "";
		    
		    for ($i=0; $i<count($params)-1; $i++)
			$return.=$params[$i].'`,`';
		    $return.=$params[count($params)-1];
		    
		    return $return;
		}
		
		/**
		 * Perform the query and return the results
		 * @param string $query the SQL query
		 * @return mixed returns the results of the query
		 */
		public function doQuery($query) {
			$this->query = filter_var($query, FILTER_SANITIZE_STRING);

			$stmt = $this->prepareQuery();
			$stmt->execute();
			$results = $this->dynamicBind($stmt);
			
			return $results;
		}
		
		/**
		 * Make a SELECT database query
		 * @param string $table the table to select the data from
		 * @param int $maxRows optional maximum number of rows to return
		 * @param mixed $params parameters to select
		 * @return mixed returns the results of the query
		 */
		public function get($table, $maxRows = NULL, $params = NULL, $alternatecriteria = false) {
			if ($params==NULL)
			    $this->query = 'SELECT * FROM `'.$table.'`';
			else
			    $this->query = 'SELECT `'.$this->params($params).'` FROM `'.$table.'`';
			$stmt = $this->buildQuery($maxRows,false,$alternatecriteria);
			$stmt->execute();
			$results = $this->dynamicBind($stmt);
			
			return $results;
		}
		
		/**
		 * Insert rows into the database
		 * @param string $table the table to insert data into
		 * @param mixed $data the data to insert
		 * @return boolean returns true if rows were inserted, else false
		 */
		public function insert($table, $data) {
			$this->query = 'INSERT INTO `'.$table.'`';
			$stmt = $this->buildQuery(NULL, $data);
			$stmt->execute();
			
			if ($stmt->affected_rows>0)
			    return $this->mysqli->insert_id;
			return false;
		}
		
		/**
		 * Make an UPDATE database query
		 * @param string $table the table to update data
		 * @param mixed $data the new data
		 * @return boolean returns true if rows were updated, else false
		 */
		public function update($table, $data) {
			$this->query = 'UPDATE `'.$table.'` SET ';

			$stmt = $this->buildQuery(NULL, $data);
			$stmt->execute();

			if ($stmt->affected_rows)
				return true;
			return false;
		}
		
		/**
		 * Delete rows from the database
		 * @param string $table the name of the table to delete data from
		 * @return boolean returns true if rows were deleted, else false
		 */
		public function delete($table) {
			$this->query = 'DELETE FROM `'.$table.'`';

			$stmt = $this->buildQuery();
			$stmt->execute();

			if ($stmt->affected_rows)
				return true;
			return false;
		}
		
		/**
		 * Adds a WHERE condition to a database query
		 * @param string $key the key of the where condition
		 * @param string $value the asserting value of the where condition
		 */
		public function where($key, $value) {
			$this->where[$key] = $value;
		}
		
		/**
		 * Adds a ORDER BY condition to a database query
		 * @param string $variable the variable to be ordered by
		 * @param boolean $desc if true, the order will be descending
		 */
		public function orderBy($variable, $desc) {
			$this->orderBy = array($variable,$desc);
		}
		
		/**
		 * Adds a JOIN to a database query
		 * @param string $table the secondary table to join
		 * @param string $left the field of the primary table to join on
		 * @param string $right the fieeld of the secondary table to join on
		 */
		public function join($table, $left, $right) {
			$this->join[$table] = '`'.$left.'`=`'.$right.'`';
		}
		
		/**
		 * Closes the database connection 
		 */
		public function __destruct() {
			$this->mysqli->close();
		}
	}
?>
