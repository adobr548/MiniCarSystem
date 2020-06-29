<table>
    <!--atvaizduojamas masinu sarasas su nurodytom reiksmem-->
	<tr>
        <th>Cars number</th>
        <th>Year made</th>
        <th>Model</th>
        <th>Current user</th>
        <th>Current user segment</th>	
        <th>Current status</th>		
    </tr>
    
    <?php
    
    foreach($currentHolders as $index => $currentHolder){
        echo
            "<tr>"
            . "<td>{$currentHolder->masinosNr}</td>"
            . "<td>{$currentHolder->metai}</td>"
            . "<td>{$currentHolder->modelis}</td>"
            . "<td>{$currentHolder->dabartinisValdytojas}</td>"
            . "<td>{$currentHolder->segmentoPav}</td>"
            //. "<td>{$statuses[$index]->bukle}</td>"
            . "</tr>\n";
        
        foreach($lastHolders as $lastHolder){
            if($currentHolder->dbrCarId == $lastHolder->senoCarId ){
        echo
        "<tr>"
        . "<td>{$currentHolder->masinosNr}</td>"
        . "<td>{$currentHolder->metai}</td>"
        . "<td>{$currentHolder->modelis}</td>"
        . "<td><b>Previous user: </b>{$lastHolder->ankstesnisValdytojas}</td>"
        . "<td><b>Previous user segment: </b>{$lastHolder->sensegmentoPav}</td>"
        . "</tr>\n";
            }
        } 
    }

     ?>

</table>
 