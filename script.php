<?php



class Script{
    public $csv_file;

    function __construct($csv_file) {
        $this->csv_file = $csv_file;
      }

    // php function to convert csv to json format
    function csvToJson($fname) 
    {
        // get & open csv file
        if (!($fp = fopen($fname, 'r'))) {
            die("Can't open file...");
        }
        
        //reading csv headers
        $key = fgetcsv($fp,"1024",",");
        
        // parse csv rows into array
        $jsonFormat = array();
            while ($row = fgetcsv($fp,"1024",",")) {
            $jsonFormat[] = array_combine($key, $row);
        }
        
        // close file handle
        fclose($fp);
        
        // encode array to json
        return json_encode($jsonFormat);
    }

    // create json file
    function create_json_file($jsonFile)
    {
        $myfile = fopen($jsonFile, "w") or die("Unable to open file!");
        // get csv json 
        $txt = $this->csvToJson($this->csv_file);
        fwrite($myfile, $txt);
        fclose($myfile);
        echo "Your json file has been created at ".$jsonFile;
    }

    function get_hash($csvFile)
    {
        return hash('sha256', $csvFile);
    }

    function append_hash_to_csv()
    {
        $newCsvData = array();
        if (($handle = fopen($this->csv_file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $result =$this->get_hash($this->csv_file);
                $file_name= explode('.',$this->csv_file)[0];
                $data[] = $file_name.".".$result.".csv";
                $newCsvData[] = $data;
            }
            fclose($handle);
        }
    
        $handle = fopen($this->csv_file, 'w');
    
        foreach ($newCsvData as $line) {
        fputcsv($handle, $line);
        }
    
        fclose($handle);
    
        // 
        echo "Hash added successfully ..";
    }

}


?>