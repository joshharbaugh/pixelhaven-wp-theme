<?php

class LFM_RecentlyPlayed
{
	public $songs = array();
	public $user = "";
	public $apiurl = "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=%s&api_key=%s&limit=5";
	public function __construct($user, $key) {
		try {
			$feed = curl_init(sprintf($this->apiurl, $user, $key));
			curl_setopt($feed, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($feed, CURLOPT_HEADER, 0);
			$xml = curl_exec($feed);
			curl_close($feed);

			$result = new SimpleXMLElement($xml);
			if (!$result) { return; }
			else {
				$this->user = $result->recenttracks->attributes()->user;
				foreach($result->recenttracks->track as $track) {
					$song = new stdClass();
					$song->artist = (string) $track->artist;
					$song->image = (string) $track->image;
					$song->name = (string) $track->name;
					$song->album = (string) $track->album;
					$song->url = (string) $track->url;
					array_push($this->songs, $song);
				}
				unset($feed, $xml, $result, $song);
			}
		} catch (Exception $e) { exit; }		
	}
	public function getSongs() { return $this->songs; }
}

?>