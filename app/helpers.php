<?php

function checkImage($id=0,$file='',$zc=0,$ql=100){
	if(filter_var($file, FILTER_VALIDATE_URL) === FALSE){
		$q = DB::table('imagethumb')->where('id','=',$id);
		if ($q->count() > 0) {
			$res = $q->first();
			if(is_file(storage_path('app/'.$file))){
	            $src = 'storage/app/'.$file;
	        }else{
	        	if(is_file(public_path($res->default_image))){
	        		$src = 'public/' . $res->default_image;
	        	}
	        }
	        $src = env('APP_URL')."/image-thumb.php?w=" . $res->width . "&h=" . $res->height . "&zc=" . $zc . "&q=" . $ql . "&src=" . $src;
		}
	}else{
		$src= $file;
	}
	
	return $src;
}

function removeNamespaceFromXML( $xml )
{
    // Because I know all of the the namespaces that will possibly appear in 
    // in the XML string I can just hard code them and check for 
    // them to remove them
    $toRemove = ['rap', 'turss', 'crim', 'cred', 'j', 'rap-code', 'evic'];
    // This is part of a regex I will use to remove the namespace declaration from string
    $nameSpaceDefRegEx = '(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?';

    // Cycle through each namespace and remove it from the XML string
   foreach( $toRemove as $remove ) {
        // First remove the namespace from the opening of the tag
        $xml = str_replace('<' . $remove . ':', '<', $xml);
        // Now remove the namespace from the closing of the tag
        $xml = str_replace('</' . $remove . ':', '</', $xml);
        // This XML uses the name space with CommentText, so remove that too
        $xml = str_replace($remove . ':commentText', 'commentText', $xml);
        // Complete the pattern for RegEx to remove this namespace declaration
        $pattern = "/xmlns:{$remove}{$nameSpaceDefRegEx}/";
        // Remove the actual namespace declaration using the Pattern
        $xml = preg_replace($pattern, '', $xml, 1);
    }

    // Return sanitized and cleaned up XML with no namespaces
    return $xml;
}

function XMLToArray($xml)
{
    // One function to both clean the XML string and return an array
    return json_decode(json_encode(simplexml_load_string(removeNamespaceFromXML($xml))), true);
}