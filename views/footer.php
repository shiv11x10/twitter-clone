<footer class="footer mt-auto py-3 bg-light">
<div class="container">
    <span class="text-muted">&copy; My Website 2016</span>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalTitle">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert" id="loginAlert" style="display:none">
        </div>
        <form>
            <input type="hidden" name="loginActive" id="loginActive" value="1">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="abc@xyz.com">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="*****">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <a id="toggleLogin">Sign up</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="loginSignupButton btn btn-primary">Login</button>
      </div>
    </div>
  </div>
</div>

<script>
    $("#toggleLogin").click(() => {
        if($("#loginActive").val() == "1") {
            $("#loginActive").val("0");
            $("#loginModalTitle").html("Sign Up");
            $(".loginSignupButton").html("Sign Up");
            $("#toggleLogin").html("Login");
            $("#loginAlert").hide();
        }
        else {
            $("#loginActive").val("1");
            $("#loginModalTitle").html("Login");
            $(".loginSignupButton").html("Login");
            $("#toggleLogin").html("Sign Up");
            $("#loginAlert").hide();
        }
    })


    $(".loginSignupButton").click(() => {
        $.ajax({
            type: "POST",
            url: "actions.php?action=loginSignup",
            data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
            success: function(result) { //the echo statement in actions.php will be result callback
                if(result == 1) {
                  window.location.assign("http://localhost/twitter_clone/");
                } else {
                  $("#loginAlert").html(result).show();
                }
            }
        })
    })
</script>

  </body>
</html>