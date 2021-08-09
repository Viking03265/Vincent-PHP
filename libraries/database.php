<?php

class DataBase {

    protected $connection;
	protected $query;
    protected $show_errors = TRUE;
    protected $query_closed = TRUE;
	public $query_count = 0;


    public function __construct($hostname, $username, $password, $database) { 
        
        $this->connection = new mysqli($hostname, $username, $password, $database);

        if ($this->connection->connect_error) {
            $this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
        }
    }


    public function query($query) {

        if (!$this->query_closed) {
            $this->query->close();
        }

		if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
				$types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
					if (is_array($args[$k])) {
						foreach ($args[$k] as $j => &$a) {
							$types .= $this->_gettype($args[$k][$j]);
							$args_ref[] = &$a;
						}
					} else {
	                	$types .= $this->_gettype($args[$k]);
	                    $args_ref[] = &$arg;
					}
                }
				array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }

            $this->query->execute();
           	if ($this->query->errno) {
				$this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
           	}

            $this->query_closed = FALSE;
			$this->query_count++;

        } else {
            $this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);
        }

		return $this;
    }


    public function error($error) {
        exit($error);
    }

    /**
     * 
     */
    public function saveChoices($choices) {

        $query = "INSERT INTO table_name (column1, column2, column3, column4) VALUES (value1, value2, value3, ...)";

        $query = str_replace('table_name', 'choices', $query);
        $query = str_replace('column1', 'option1', $query);
        $query = str_replace('column2', 'option2', $query);
        $query = str_replace('column3', 'option3', $query);
        $query = str_replace('column4', 'choice', $query);

        $query = str_replace('value1', $choices->option1, $query);
        $query = str_replace('value2', $choices->option2, $query);
        $query = str_replace('value3', $choices->option3, $query);
        $query = str_replace('value4', $choices->choice, $query);

        exit($query);

        return $this->query($query);
    }
}
