SELECT	 	concat('$', COLUMN_NAME, ' = ', "$this->input->post('", COLUMN_NAME, "');") as variable,
				concat("'", COLUMN_NAME, "' => $", COLUMN_NAME) as array
FROM 			`INFORMATION_SCHEMA`.`COLUMNS` 
WHERE 		`TABLE_SCHEMA`='db_kendaraan' 
    			AND `TABLE_NAME`='t_spk';
    			
    			