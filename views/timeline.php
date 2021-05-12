<div class="container mainContainer">
<div class="row">
    <div class="col-sm-8">
        <h2>Tweets For You</h2>

        <?php displayTweets('isFollowing'); ?>

    </div>
    <div class="col-sm-4">

        <?php displaySearch(); ?>

        <hr>

        <?php displayTweetBox(); ?>

    </div>
  </div>
</div>
