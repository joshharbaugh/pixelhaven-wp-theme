<?php //include('includes/OAuthSimple.php');

class Netflix_Details
{
      public $catalog_titles = array();
      
      public $apiKey = 'vx6vbgt4yv9hekyc6hcqqyrg';
      public $sharedSecret = '2PjY87dksZ';
      public $arguments;
                                           
      public $path = "http://api-public.netflix.com/catalog/titles";
      public $oauth;

      public function __construct($term)
      {
    		try {
               $this->oauth = new OAuthSimple();
               $this->arguments = Array(term=>$term,
                                    expand=>'formats,synopsis',
                                    max_results=> '1',
                                    output=>'xml'
                                    );
               $signed = $this->oauth->sign(Array(path=>$this->path,
                                              parameters=>$this->arguments,
                                              signatures=> Array('consumer_key'=>$this->apiKey,
                                                                 'shared_secret'=>$this->sharedSecret
                                                                )
                                              ));
               $curl = curl_init();
               curl_setopt($curl,CURLOPT_URL,$signed['signed_url']);
               curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
               $xml = curl_exec($curl);

               $result = new SimpleXMLElement($xml);
			   if (!$result) { return; }
               else {
                    foreach($result->catalog_title as $title)
                    {
                         $item = new stdClass();
                         $item->title = (string) $title->title->attributes()->short;
                         $item->image_small = (string) $title->box_art->attributes()->small;
                         $item->image_medium = (string) $title->box_art->attributes()->medium;
                         $item->image_large = (string) $title->box_art->attributes()->large;
                         $item->synopsis = (string) $title->link->synopsis;

                         array_push($this->catalog_titles, $item);
                    }
                    unset($curl, $xml, $result, $item);
               }
    		} catch (Exception $e) { echo 'Exception: ' . $e; exit; }
      }
      public function getMovie() { return $this->catalog_titles; }
}

?>
