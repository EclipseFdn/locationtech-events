<?php

/**
 * @file class.events.php
 *
 * Contributors:
 *    Christopher Guindon (Eclipse Foundation)- initial API and implementation
 */

// If name of the file requested is the same as the current file, the script will exit directly.
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {
	exit();
}

class Events {

  private $xml = "";

  private $javascript = "";

  private $event = array();

  private $next = array();

  private $otherevent = "";

  public function __construct() {
    $this->xml = simplexml_load_file("events.xml");
    $this->buildEvents();
  }

  /**
   * Fetch an array of all the Events
   * @return array:
   */
  public function getEvents() {
    return $this->event;
  }

  /**
   * Fetch the Javascript for Leaflet
   * http://leafletjs.com/
   *
   * @return string
   */
  public function getJavascript() {
    $this->createJavascript();
    return $this->javascript;
  }

  /**
   * Fetch the next upcoming event
   *
   * @return array:
   */
  public function getNextEvent() {
    return $this->next;
  }

  /**
   * Fetch the html for the events in the sidebar
   * @return string
   */
  public function getFutureEvents() {
    $this->createOtherEvents("future");
    return $this->otherevent;
  }

  public function getPastEvents() {
    $this->createOtherEvents("past");
    return $this->otherevent;
  }

  /**
   * Lookup event XML and builds the event information array
   */
  private function buildEvents(){
    foreach ($this->xml as $e) {
      $id = preg_replace("/[^a-z]+/", "", strtolower($e->city));
      $event[] = array(
          'iconSize' => $this->xml_attribute($e->marker, 'iconSize'),
          'popupAnchor' => $this->xml_attribute($e->marker, 'popupAnchor'),
          'iconAnchor' => $this->xml_attribute($e->marker, 'iconAnchor'),
          'city' => $e->city,
          'date' => strtotime($e->date),
          'date_formatted' => date('D, F jS, Y H:i', strtotime($e->date)),
          'url' => ($e->registration != "") ? $e->registration : '#',
          'registration' => ($e->registration != "") ? '<a href="' . $e->registration . '" class="btn btn-primary">Register</a>' : '',
          'body' => $e->body,
          'latitude' => $e->latitude,
          'longitude' => $e->longitude,
          'id' => $id,
          'image' => $e->image,
      );
    }
    $event = $this->array_sort($event, 'date');

    // Get the next event.
    foreach ($event as $key => $n) {
      if ($n['date'] >= time()) {
        $this->next = $n;
        break;
      }
    }
    // show the first event if the tour is over.
    if (empty($this->next)) {
    	$this->next = $event[0];
    }

    $this->event = $event;
  }

  /**
   * Create the Javascript for Leaflet
   */
  private function createJavascript() {
    foreach ($this->event as $c) {
      $id = $c['id'];
      $body = "<h3>" . $c['city']. "</h3>";
      $body .= "<p>";
      $body .= "<strong>Date:</strong> " . $c['date_formatted'];
      $body .= "</p>";
      $body .= "<p>" . addslashes($c['body']) . "</p>";
      if (!empty($c['registration'])) {
        $body .= $c['registration'];
      }

      $coordinate = $c['latitude'] . ', ' . $c['longitude'];
      $cityName = $c['city'];

      // Create a dynamic label for each city
      $this->javascript .= "var " . $id  . " = L.marker([" . $coordinate . "]).bindLabel('$cityName', { noHide: true }).addTo(map);" . PHP_EOL;
      $this->javascript .=  $id  . '.bindPopup(\''. $body .'\');' . PHP_EOL;
    }
  }

  /**
   * Create the html for the events in the sidebar
   */
  private function createOtherEvents($pastOrFuture) {
    $x = 0;
    foreach ($this->event as $e) {
      // Display in this list if it's a future event
      if ($e['city'] != $this->next['city']) {
        if ($pastOrFuture=="future" && $e['date'] >= time()) {
          // TODO: turn this into a function
          print ("<p>DEBUG: future</p>");
          $x++;
          $this->otherevent .= '<div class="col-md-12">';
          $this->otherevent .= '<h4>' . $e['city'] . '</h4>';
          $this->otherevent .= '<p><strong>Date: </strong>' . $e['date_formatted'] . '</p>';
          $this->otherevent .= '<p>' . $e['body'] . '</p>';
          $this->otherevent .= '<p>' . $e['registration'] . '</p>';
          $this->otherevent .= '<hr/></div>';
          if($x == 3){
            $x = 0;
            $this->otherevent .= '<div class="clearfix"></div>';
          }
        } // end of future
        elseif($pastOrFuture=="past" && $e['date'] < time()) {
          // TODO: turn this into a function
          print ("<p>DEBUG: past</p>");
          $x++;
          $this->otherevent .= '<div class="col-md-12">';
          $this->otherevent .= '<h4>' . $e['city'] . '</h4>';
          $this->otherevent .= '<p><strong>Date: </strong>' . $e['date_formatted'] . '</p>';
          $this->otherevent .= '<p>' . $e['body'] . '</p>';
          $this->otherevent .= '<p>' . $e['registration'] . '</p>';
          $this->otherevent .= '<hr/></div>';
          if($x == 3){
            $x = 0;
            $this->otherevent .= '<div class="clearfix"></div>';
          }
        } // end of past
        else {
          // TODO: turn this into a function
          print ("<p>DEBUG: default</p>");
          $x++;
          $this->otherevent .= '<div class="col-md-12">';
          $this->otherevent .= '<h4>' . $e['city'] . '</h4>';
          $this->otherevent .= '<p><strong>Date: </strong>' . $e['date_formatted'] . '</p>';
          $this->otherevent .= '<p>' . $e['body'] . '</p>';
          $this->otherevent .= '<p>' . $e['registration'] . '</p>';
          $this->otherevent .= '<hr/></div>';
          if($x == 3){
            $x = 0;
            $this->otherevent .= '<div class="clearfix"></div>';
          }
        } // end of default
      } // end of city check
    } //end of foreach
  } //end of createOtherEvents

  /**
   * Fetch an xml attribute
   *
   * @param object $object
   * @param string $attribute
   *
   * @return string
   */
  private function xml_attribute($object, $attribute) {
    if(isset($object[$attribute]))
      return (string) $object[$attribute];
  }

  /**
   * Callback for sorting an array with a specific key
   *
   * @param array $a
   * @param string $subkey
   *
   * @return array
   */
  private function array_sort($a, $subkey) {
    foreach ($a as $k => $v) {
      $b[$k] = strtolower($v[$subkey]);
    }
    asort($b);
    foreach ($b as $key=>$val) {
      $c[] = $a[$key];
    }
    return $c;
  }
}
