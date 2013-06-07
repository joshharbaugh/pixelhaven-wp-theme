<?php
error_reporting(E_ERROR);
class Book_Details
{
		public $books = array();
		public $book_id = "";
		public $apiurl = "http://www.goodreads.com/book/show/%s.xml?format=xml&key=UyXZBSp0pkVZUU9JDJJRZA";
		
		public function __construct($book_id)
		{
			try {
				$feed = curl_init(sprintf($this->apiurl, $book_id));
				curl_setopt($feed, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($feed, CURLOPT_HEADER, 0);
				$xml = curl_exec($feed);
				curl_close($feed);
				
				try {
					$result = new SimpleXMLElement($xml);
					if (!$result) { return; }
					else {
							foreach($result->book as $detail)
							{
									$book = new stdClass();
									$book->id = (string) $detail->id;
									$book->title = (string) $detail->title;
									$book->author = (string) $detail->authors->author->name;
									$book->author_url = (string) $detail->authors->author->link;
									$book->link = (string) $detail->link;
									$book->image = (string) $detail->image_url;
									$book->book_description = (string) $detail->description;
									$book->book_link_name = (string) $detail->book_links->book_link->name;
									
									array_push($this->books, $book);
							}
							unset($feed, $xml, $result, $book);
					}
				} catch ( Exception $e ) {
						echo "<!--".$e->getMessage()."-->";
				}
			} catch (Exception $e) { exit; }
		}
		
		public function getDetails() { return $this->books; }
}

?>