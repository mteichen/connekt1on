<?php
   /*
   Plugin Name: Job List Reader Plugin
   Description: a very basic HTML table output WP custom plugin WP 5.x COMPATIBLE
   Version: 1.1
   Author: Sameer Khan
   File: job_list_reader.php
   SQL Import File: ptk_jobs_list.sql
   Folder to create: my-adapter-plug-reader
   Short code: [jobs-list-reader-shortcode]
   License: GPL2
   */
   
  add_shortcode( 'jobs-list-reader-shortcode', 'job_list_reader_plugin' );

function job_list_reader_plugin( $attributes ) 
{
	
	global $wpdb;

	$output = "";
	
	//Prepend the adapter_plug_tbl table name with the current table prefix
	
	$tableName =   $wpdb->prefix . "jobs_list"; 
	
	//Query the  adapter_plug_tbl table and get all the rows in the $result object
	
	$result = $wpdb->get_results( "SELECT * FROM $tableName"); 

	$output .=  "<table>";

	$output .=  "<tr>";
    $output .=  '<th colspan="7"> JOBS LIST TABLE </th>';
    $output .=  "</tr>";

	$output .=  "<tr>";
	$output .=   "<th>" . "Company Name"   .  "</th>" 
		. "<th>" . "Skill 1"      	 .  "</th>" 
		. "<th>" . "Skill 2" .  "</th>" 
		. "<th>" . "Skill 3"    	 .  "</th>"
		. "<th>" . "Skill 4"    	 .  "</th>"
        . "<th>" . "Skill 5"    	 .  "</th>"
        . "<th>" . "Job Title"   	 .  "</th>";
		
	$output .=  "</tr>";

	//Iterate through the $results object. Each $row is a row of the table
	// row is also an object
	
	foreach($result as $row)  {

        /*
   		#Create a temp variable to hold the size display value
   		#
   		$size_display =  "unknown";
   		
  		#Use a SWITCH statement to set the size display value
   		#
   		switch ($row->size) {
    		case 1:
    		case 2:
    		case 3:
      			$size_display =  "SMALL";
        		break;
    		case 4:
    		case 5:
    		case 6:
    		case 7:
    		    $size_display =  "MEDUIUM";
        		break;
     		case 8:
    		case 9:
    		case 10:
      			$size_display =  "LARGE";
        		break;
        	default:
       			$size_display = "Unknown size value";
		}
   		
   		#Format the database table price data a 2 decimal place float with leading "$"
   		#
        $number =  $row->cost;
        $cost_display = "$ " . number_format($number, 2, '.', '');
 
   		#Format the color dislay value as an HTML font color statement
   		# First use the strtolower function to get the color value to all lowercase
   		#
  		$color_display = $row->color;
  		$color_display = strtolower( $color_display );

  		$color_display_html = "<font color=\"$color_display\">$color_display</font>";
        */
  
        $output .=  "<tr>";
   
   		$output .=   "<td>" . strval($row->Company_Name)     . "</td>"
   		    . "<td>" . strval($row->Skill_1)          . "</td>"
   		    . "<td>" . strval($row->Skill_2)   . "</td>"
   		    . "<td>" . strval($row->Skill_3)         . "</td>"
       		. "<td>" . strval($row->Skill_4)        . "</td>"
            . "<td>" . strval($row->Skill_5)        . "</td>"
       		. "<td>" . strval($row->Job_Title)  . "</td>";
        
  		 $output .=  "</tr>";
 
   }

  $output .=  "</table>";
  
  return $output;
	
}
?>