<?php

    date_default_timezone_set('Asia/Kolkata');   // for time_since function

    session_start(); //for login

    $link = mysqli_connect("localhost", "root", "", "twitter");

    if(mysqli_connect_errno()) {
        print_r(mysqli_connect_error());
        exit();
    }

    if(isset($_GET['function']) && $_GET['function'] == "logout") {
        session_unset(); //logut by ending session variables
        header("Location: http://localhost/twitter_clone/"); //redirect to home page after logout 
        exit();
    }

    //status message like "12 seconds ago" or "5 minutes ago" etc
    function time_since($time) {
        $periods = array("s", "min", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60","60","24","7","4.35","12","10");
        $now = time();
        $difference     = $now - $time;

        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if($difference != 1) {
            $periods[$j].= "s";
        }
        return "$difference $periods[$j]";
    }

    function displayTweets($type) {
        global $link;

        if($type == "public") { // all tweets are fetched(from views/home file)
            $whereClause = "";
        } else if($type == 'isFollowing' && isset($_SESSION['id'])){ // Tweets in timeline of people that user follows
            $query = "SELECT * FROM isFollowing WHERE follower = ". mysqli_real_escape_string($link, $_SESSION['id']);
            $result = mysqli_query($link, $query);

            $whereClause = "";

            while($row = mysqli_fetch_assoc($result)) {
                if($whereClause == "") $whereClause = "WHERE";
                else $whereClause .= " OR";
                $whereClause .= " userid = ".$row['isFollowing'];
            }
        }

        $query = "SELECT * FROM tweets ". $whereClause ." ORDER BY `datetime` DESC LIMIT 10";

        // if(isset($link)) {
        $result = mysqli_query($link, $query);
        
        if(!$result || mysqli_num_rows($result) == 0) {
            echo "There are no tweets to display";
        } else {
            while($row = mysqli_fetch_assoc($result)) {
                $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
                $userQueryResult = mysqli_query($link, $userQuery);
                $user = mysqli_fetch_assoc($userQueryResult);

                echo "<div class='tweet'><p>".$user['email']." <span class='time'>".time_since(strtotime($row['datetime']))." ago</span>:
                </p>";

                echo "<p>".$row['tweet']."<p>";

                echo "<p><a class='toggleFollow' data-userid='".$row['userid']."'>";

                $isFollowingQuery =  "SELECT * FROM isFollowing WHERE follower = ". mysqli_real_escape_string($link, $_SESSION['id']) . " AND isFollowing= ". mysqli_real_escape_string($link, $row['userid']) . " LIMIT 1";
                $isFollowingResult = mysqli_query($link, $isFollowingQuery);
                if(mysqli_num_rows($isFollowingResult) > 0) { 
                    echo "Unfollow";
                } else {
                    echo "Follow";
                }

                echo "</a></p></div>";
            }
        }
    }

    function displaySearch() {
        echo '<div class="row row-cols-lg-auto g-3 align-items-center mb-3">
        <div class="col-12">
          <div class="input-group">
            <div class="input-group-text"><i class="fa fa-search"></i></div>
            <input type="text" class="form-control" id="search" placeholder="Search">
          </div>
        </div>
      
        <div class="col-12">
          <button class="btn btn-primary">Search Tweets</button>
        </div>
      </div>';
    }

    function displayTweetBox() {
        if(isset($_SESSION['id']) && $_SESSION['id'] > 0) {
            echo '<div class="row mb-3">
            <div class="mb-3">
                <textarea class="form-control" id="tweetContent"></textarea>
                </div>
                <div class="mb-3">
              <button id = "postTweetButton" class="btn btn-primary">Post Tweets</button>
            </div>
            </div>
          ';
        }
    }
?>

