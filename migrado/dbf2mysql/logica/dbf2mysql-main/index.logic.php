<?php
// command for importing shape geo files into mysql, database must exists
//ogr2ogr --config SHAPE_ENCODING "ISO-8859-1" -f "MySQL" MYSQL:"database_name_here,host=server_host_here,user=database_user_here,password=user_password_here,port=3306" -nln "new_table_name" shape_file.shp -update -overwrite -lco ENGINE=MyISAM
?>


