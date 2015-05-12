# Introduction #

This class had made it very simple to make API calls to Bandsintown to receive concert data about artists and related artists.

## Details ##

BIT PHP Library provides the user to make 3 calls to the Bandsintown API engine:
  1. <a href='http://www.bandsintown.com/api/requests#artists-get'>Artist Search</a>
  1. <a href='http://www.bandsintown.com/api/requests#artists-events'>Get Artists Events</a>
  1. <a href='http://www.bandsintown.com/api/requests#events-search'>Event Search (by Location or Artist)</a>
  1. <a href='http://www.bandsintown.com/api/requests#events-recommended'>Event Recommended Search (by Artist)</a>

## Steps ##

Let's take an example of a simple artist event search using the BIT PHP Library.

Step 1. Include the BIT.php in your source
```
    include ("BIT.php");
```

Step 2. Create an instance and Set your API key for the Instance. Please note that Bandsintown doesn't have an API Signup process - so you can use any string value for your API key.
```
    $myBIT = new BIT();
    $myBIT->setAPI("APIKEYHERE");
```

Step 3. Perform the single artist events search API
```
    try
    {
       // set the Artist that you want to search. Make sure you leave it plain text - do not do any URL encoding. The class file will take care of that for you.
	$artists = "Angels and Airwaves";
		
	// perform the get Artist function
	$results = $myBIT->getEventsForSingleArtist($artists);
		
	// loop through the response
	foreach($results as $events)
	{
	   $dateofevent = date("m/d/y H:i", strtotime($events->datetime));
	   $venue_city = $events->venue->city;
	   $venue_region = $events->venue->region;
	   $venue_name = $events->venue->name;
	
           // display the results of the entry		
	   echo $venue_name . " (" . $venue_city . "," . $venue_name . ") on " . $dateofevent . "<br>";
        }
    }
    catch(Exception $e)
    {
        // If you have an error from the request - it will be displayed here.
	echo $e->getMessage();
    }

```

bit-php-library returns an json decoded array of elements that you can parse through using a foreach loop.

Please refer to to <a href='http://www.bandsintown.com/api/responses'>Bandsintown's API Documentation</a> for the list of json responses.

It's that simple! Please refer to the examples.php for more on how you can you perform other calls with this library.


---


DISCLAIMER: This code is open source. That means, in plain English, that I cannot guarantee the effectiveness of the code and that it is production ready. The Product is provided AS-IS and no warranties are in effect. If you encounter any issues - please use the bug tracker and I'll be quick to reply.

Thanks for using BIT PHP Library!