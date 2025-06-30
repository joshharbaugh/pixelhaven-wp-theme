<?php
//error_reporting(E_ERROR);
class Book_Details
{
		public $books = array();
		public $book_id = "";
		public $apiurl = "https://www.goodreads.com/book/show/%s.xml?format=xml&key=Xqc2v5q6lkyyDxAeTC7mOA";

		public function __construct($book_id)
		{
			try {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, sprintf($this->apiurl, $book_id));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$xml = curl_exec($ch);
				curl_close($ch);

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
			} catch (Exception $e) { echo $e->getMessage(); exit; }
		}

		public function getDetails() { return $this->books; }
}

?>
