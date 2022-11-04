# nft-script
A PHP script that generate a CHIP-0007 compatible json, calculate the SHA-256 of the json file and append it to the CSV file 
## Installation
[PHP](https://php.net) 7.3+
To download the script 
```bash
git clone https://github.com/juddee/nft-script.git
```
## Features
* Generate CHIP-007 compatible json file from CSV file
* Calculate the SHA-256 hash of the CSV file
* Append the hash value to the CSV file

## Quick Usage
Start your server and point your browser to script in the (htdocs)
```bash
  //instantiate script class and pass the path to the csv file you want to work with
  $script = new Script('path_to_the_csv_file');
  
  
  //create json file by passing the name to save the json file as the the folder to save it to
  $script->create_json_file('data/testing_bevel.json');
  
  
   //calculate the SHA-256 hash of the json file and append it the csv file
  $script->append_hash_to_csv();
  
  
```
