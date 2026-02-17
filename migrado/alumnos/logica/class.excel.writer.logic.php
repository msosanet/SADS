<?php

	##################################################################################
	##                                                                              ##
	##    DESARROLLADO POR: Edwin Fredy Mamani Calderon                             ##
	##    EMAIL: mcedwin@gmail.com                                                  ##
	##    URL: http://www.mcedwin.com                                               ##
	##    URL APP: http://www.mcedwin.com/excel/                                    ##
	##    URL ARTICULO: http://tecnato.com/generar-reportes-en-excel-con-php/       ##
	##    DESARROLLADO GRACIAS A: http://www.gruposistemas.com/                     ##
	##                                                                              ##
	##################################################################################
	
	class ExcelWriter{
			
		var $content = '';
		var $err = '';
		var $xs = 0;
		var $cls = '';
		var $col = 0;
		var $maxcol = 0;
		var $cols = array();
		
		function ExcelWriter(){
		
		}
		
		function GetXLS($download=true){
			header ("Expires: Mon, 15 Dec 2003 05:00:00 GMT");
			header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
			header ("Cache-Control: no-cache, must-revalidate");
			header ("Pragma: no-cache");
			if($download){
				header ("Content-type: application/x-msexcel");
				header ("Content-Disposition: attachment; filename=\"" . basename('file.xls') . "\"" );
				header ("Content-Description: PHP/INTERBASE Generated Data" );
			}
			echo $this->GetHeader();
			echo $this->content;
			echo $this->GetFooter();
		}
		
		function Close(){
			$this->$content='';
			$this->$err='';
			$this->$newRow=false;
			$this->$xs = 0;
			$this->$cls = '';
			$this->$col = 0;
			$this->$maxcol = 0;
			$this->$cols = array();
		}
						
		function GetHeader()
		{
			$header = '
