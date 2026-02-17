<?
    // Agrego el path de la librería para que el 'require' sepa de donde tomar los modulos de la libreria
    set_include_path(get_include_path() . ':' . '/var/www/html/alumnos/php-barcode-generator');
    require_once 'BarcodeGeneratorPNG.php';

    use JFilla\Barcode\BarcodeGeneratorPNG;
    
    // function debug_to_console($data) 
    // {
    //     $output = $data;
    //     if (is_array($output)) {
    //         $output = implode(',', $output);
    //     }
    
    //     echo "<script>console.log('Debbug: " . $output . "' );</script>";
    // };

    function generarCodigoBarraFunc($codigo) {
        
        // Make Barcode object of Code128 encoding.
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($codigo, $generator::TYPE_CODE_128); 
        // $barcode = (new Picqer\Barcode\Types\TypeCode128())->getBarcode($codigo);
        
        // echo "<div style=\"width: 400px; height: 75px\">" . $barcode . "</div>";
        // echo '<img src="data:image/png;base64,' . base64_encode($barcode) . '">';
        file_put_contents("./codigos/barcode-".$codigo.".jpg", $barcode);



        // Output the barcode as HTML in the browser with a HTML Renderer
        // $renderer = new Picqer\Barcode\Renderers\HtmlRenderer();
        
        // $renderer->setForegroundColor([255, 0, 0]); // Give a color red for the bars, default is black. Give it as 3 times 0-255 values for red, green and blue. 
        // $renderer->setBackgroundColor([0, 0, 255]); // Give a color blue for the background, default is transparent. Give it as 3 times 0-255 values for red, green and blue. 
    
        // $renderer->render($barcode, 450.20, 75); // Width and height support floats
        
    }
?>
