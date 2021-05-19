<?php
	use Cherry\Core;

	/**
	 * <b>FILE : </b>DBManager.php<br>
     * <b>COPYRIGHT : </b>©2021 | Aurora Softwares<br>
     * <b>VERSION : </b>1.0
	 */
	class DBManager
	{
		private $sv;
		private $un;
		private $db;
		private $pw;

		/**
		 * Instantiates the class DBManager.
		 * @return DBManager
		 */
		function __construct($server, $databaseName, $username, $password)
		{
			$this -> sv = $server;
			$this -> un = $username;
			$this -> db = $databaseName;
			$this -> pw = $password;
		}

		/**
		 * Gets the database name specified withing the constructor.
		 * @return string
		 */
		function getDBName()
		{
			return($this -> db);
		}

		/**
		 * Connects the current file to the database server.
		 */
		function serverConnected()
		{
			return(mysqli_connect($this -> sv, $this -> un, $this -> pw));
		}

		/**
		 * Connects the current file to the specified database.
		 */
		function databaseConnected()
		{
			return(new mysqli($this -> sv, $this -> un, $this -> pw, $this -> db));
		}

		/**
		 * Checks the existence of database in the server.
		 * @return bool
		 */
		function isDBExists()
		{
			if(DBManager::serverConnected())
			{
				if(mysqli_select_db(DBManager::serverConnected(), $this -> db))
				{
					return(true);
				}
				else
				{
					return(false);
				}
			}
		}

		/**
		 * Creates the database, if not exists.
		 * @return bool
		 */
		function createDatabase()
		{
			if(DBManager::isDBExists() === false)
			{
				$sql = 'CREATE DATABASE '.$this -> db;
				if(mysqli_query(DBManager::serverConnected(), $sql))
				{
					return(true);
				}
				else
				{
					return(false);
				}
			}
			else
			{
				return(false);
			}
		}

		/**
		 * Deletes the entire database.
		 * @return bool
		 */
		function deleteDatabase()
		{
		    if(DBManager::isDBExists())
		    {
		        $sql = 'DROP DATABASE '.$this -> db;
		        if(mysqli_query(DBManager::serverConnected(), $sql))
		        {
		            return(true);
		        }
		        else
		        {
		            return(false);
		        }
		    }
		    else
		    {
		        return(false);
		    }
		}

		/**
		 * Checks the existence of specified table within the database.
		 * @return bool
		 */
		function isTableExists($tableName)
		{
			if(DBManager::isDBExists())
			{
				if(mysqli_query(DBManager::databaseConnected(), "SELECT * FROM ".$tableName))
				{
					return(true);
				}
				else
				{
					return(false);
				}
			}
			else
			{
				return(false);
			}
		}

		/**
		 * Creates an empty table within the database.
		 * @return bool
		 */
		function createEmptyTable($tableName, array &$tableColumnNames)
		{
			if(DBManager::isDBExists())
			{
				if(DBManager::isTableExists($tableName)===false)
				{
					$query = "CREATE TABLE IF NOT EXISTS ".$tableName."(".Core::getArrayAsString($tableColumnNames, ', ').")";
					if(mysqli_query(DBManager::databaseConnected(), $query))
					{
						return(true);
					}
					else
					{
						return(false);
					}
				}
				else
				{
					return(false);
				}
			}
			else
			{
				return(false);
			}
		}

		/**
		 * Deletes a table from the database.
		 * @return bool
		 */
		function deleteTable($tableName)
		{
		    if(DBManager::isDBExists())
		    {
				if(DBManager::isTableExists($tableName))
				{
					$sql = 'DROP TABLE '.$tableName;
					if(mysqli_query(DBManager::serverConnected(), $sql))
					{
						return(true);
					}
					else
					{
						return(false);
					}
				}
				else
				{
					return(false);
				}
		    }
		    else
		    {
		        return(false);
		    }
		}

		/**
		 * Inserts the contents of a table row.
		 * @return bool
		 */
		function insertTableRowData($tableName, array &$tableColumnNames, array &$dataValues)
		{
			$valStr = Core::getArrayAsString($dataValues, '_#@?*$#_#$*?@#_');

			if(Core::stringContains($valStr, "'") === false)
			{
				$valStr = "'".Core::findAndReplaceString($valStr, "_#@?*$#_#$*?@#_", "', '")."'";
			}
			else
			{
				$valStr = Core::findAndReplaceString($valStr, "_#@?*$#_#$*?@#_", ", ");
			}

			if(DBManager::isDBExists())
			{
				if(DBManager::isTableExists($tableName))
				{
					$query = "INSERT INTO ".$tableName."(".Core::getArrayAsString($tableColumnNames, ', ').") VALUE(".$valStr.")";
					if(mysqli_query(DBManager::databaseConnected(), $query))
					{
						return(true);
					}
					else
					{
						return(false);
					}
				}
				else
				{
					return(false);
				}
			}
			else
			{
				return(false);
			}
		}

		/**
		 * Updates the contents of a table row with new data.
		 * @return bool
		 */
		function updateTableRowData($tableName, array &$tableColumnNames, array &$dataValues, $rowIndex, $rowIndexValue)
		{
			$flds = null;
			for($i=0; $i<count($tableColumnNames); $i++)
			{
				$flds .= $tableColumnNames[$i]."='".$dataValues[$i]."', ";
			}

			if(Core::stringContains($rowIndexValue, "'") === false)
			{
				$rowIndexValue = "'".$rowIndexValue."'";
			}

			if(DBManager::isDBExists())
			{
				if(DBManager::isTableExists($tableName))
				{
					$flds2 = $flds."_#@?*$#_#$*?@#_";
					$query = "UPDATE ".$tableName." SET ".Core::findAndReplaceString($flds2, ', _#@?*$#_#$*?@#_', '')." WHERE ".$rowIndex."=".$rowIndexValue;

					if(DBManager::databaseConnected()->query($query) === true)
					{
						return(true);
					}
					else
					{
						return(false);
					}
				}
				else
				{
					return(false);
				}
			}
			else
			{
				return(false);
			}
		}

		/**
		 * Checks the existence of a particular row in a table.
		 * @return bool
		 */
		function isTableRowExists($tableName, $rowIndex, $rowIndexValue)
		{
			if(Core::stringContains($rowIndexValue, "'") === false)
			{
				$rowIndexValue = "'".$rowIndexValue."'";
			}

			if(DBManager::isDBExists())
			{
				if(DBManager::isTableExists($tableName))
				{
					$query = "SELECT * FROM ".$tableName." WHERE ".$rowIndex."=".$rowIndexValue;
					if(mysqli_query(DBManager::databaseConnected(), $query))
					{
						if(mysqli_num_rows(mysqli_query(DBManager::databaseConnected(), $query)) > 0)
						{
							return(true);
						}
						else
						{
							return(false);
						}
					}
					else
					{
						return(false);
					}
				}
				else
				{
					return(false);
				}
			}
		}

		/**
		 * Deletes a row from the table.
		 * @return bool
		 */
		function deleteTableRow($tableName, $rowIndex, $rowIndexValue)
		{
			if(Core::stringContains($rowIndexValue, "'") === false)
			{
				$rowIndexValue = "'".$rowIndexValue."'";
			}

			if(DBManager::isDBExists())
			{
				if(DBManager::isTableExists($tableName))
				{
					$sql = mysqli_query(DBManager::databaseConnected(), "DELETE FROM ".$tableName." WHERE ".$rowIndex."=".$rowIndexValue);
					if($sql)
					{
						return(true);
					}
					else
					{
						return(false);
					}
				}
				else
				{
					return(false);
				}
			}
			else
			{
				return(false);
			}
		}

		/**
		* Gets the specific data from a specific row.
		* @return string
		*/
		function getTableRowData($tableName, $tableColumnName, $rowIndex, $rowIndexValue)
		{
			if(Core::stringContains($rowIndexValue, "'") === false)
			{
				$rowIndexValue = "'".$rowIndexValue."'";
			}

			if(DBManager::isDBExists())
			{
				if(DBManager::isTableExists($tableName))
				{
					$query = "SELECT * FROM ".$tableName." WHERE ".$rowIndex."=".$rowIndexValue;
					$res = mysqli_query(DBManager::databaseConnected(), $query);
					$row = mysqli_fetch_assoc($res);
					return($row[$tableColumnName]);
				}
				else
				{
					return(null);
				}
			}
		}

		/**
		 * Gets an array of data for a specific column from the entire table.
		 * @return array
		 */
		function getTableDataArray($tableName, $tableColumnName)
		{
			$dtArr = array();
			if(DBManager::isDBExists())
			{
				if(DBManager::isTableExists($tableName))
				{
					$query = "SELECT * FROM ".$tableName;
					$res = mysqli_query(DBManager::databaseConnected(), $query);
					while($row = mysqli_fetch_assoc($res))
					{
						Core::addArrayElement($dtArr, $row[$tableColumnName]);
					}
					return($dtArr);
				}
				else
				{
					return(null);
				}
			}
		}

		/**
		 * Gets the number of rows in the entire table.
		 * @return int
		 */
		function getTableRowCount($tableName, $index)
		{
			return(count(DBManager::getTableDataArray($tableName, $index)));
		}

		/**
		 * Gets an array of data for a specific key of a specific column from the entire table.
		 * @return array
		 */
		function getTableColumnDataArray($tableName, $tableColumnName, $rowIndex, $rowIndexValue)
		{
			if(Core::stringContains($rowIndexValue, "'") === false)
			{
				$rowIndexValue = "'".$rowIndexValue."'";
			}
			$dtArr2 = array();
			if(DBManager::isDBExists())
			{
				if(DBManager::isTableExists($tableName))
				{
					$query = "SELECT * FROM ".$tableName." WHERE ".$rowIndex."=".$rowIndexValue;
					$res = mysqli_query(DBManager::databaseConnected(), $query);
					while($row = mysqli_fetch_assoc($res))
					{
						Core::addArrayElement($dtArr2, $row[$tableColumnName]);
					}
					return($dtArr2);
				}
				else
				{
					return(null);
				}
			}
		}
	}
?>
