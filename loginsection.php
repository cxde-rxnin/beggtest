

<div class="Container hide" id="login">
    
    <h1 class="txt">Welcome Back</h1>
        <p class="txt">Please Login to continue</p>
    
        <form class="frm log" method="POST">
    
            <div class="inp">
                <input type="email" name="email" id="email" placeholder="Please Input Email">
                <input type="password" name="pass" id="email" placeholder="Please Input Password">
            </div>
            <button type="submit">Login</button>
    
        </form>
        
        <p class="dwn">Don't have an account? <span class="change" onclick="hide(1)">Sign Up</span></p>
    
    </div>
    
    <div class="Container hide2" id="signup">
        <h1 class="txt">Hello There</h1>
        <p class="txt">Please Sign Up to continue</p>
    
        <form class="frm sign" method="POST">
    
            <div class="inp">
                <input type="email" name="email" id="email" placeholder="Please Input Email">
                <span class="name">
                    <input type="text" name="fname" class="names" placeholder="Input First Name">
                    <input type="text" name="lname" class="names" placeholder="Input Last Name">
                </span>
                <input type="text" name="tag" id="tag" placeholder="Input Unique tag">
                <input type="password" name="pass" id="pass" placeholder="Input password">
                <input type="password" name="pass2" id="pass2" placeholder="Confirm password">
            </div>
            <button type="submit">Sign Up</button>
    
        </form>
    
        <p class="dwn">Already have an account? <span class="change" onclick="hide(0)">Login</span></p>
    
    
    </div>
    
    <script>
        var change = document.getElementsByClassName('change');
        var con = document.getElementsByClassName('Container');

        function hide(x) {
            for (let y = 0; y < 2; y++) {
                con[y].classList.remove("hide");
                con[y].classList.add("hide2");

                // alert("hidden")
            }
                con[x].classList.add("hide");
                con[x].classList.remove("hide2");
        }



        $(document).ready(function () {
        $(".sign").on('submit', function(c){
            c.preventDefault();

            $.ajax({
                url: 'signup.php',
                type: 'post',
                data: new FormData(this),
                contentType: false,
                processData:false,
                cache: false,
                beforeSend: function(){},
                success: function(dd){
                    $(".shows").html(dd);
                },
                error: function(){
                    alert(0)
                }
            });

            });
        });

        $(document).ready(function () {
        $(".log").on('submit', function(c){
            c.preventDefault();

            $.ajax({
                url: 'login.php',
                type: 'post',
                data: new FormData(this),
                contentType: false,
                processData:false,
                cache: false,
                beforeSend: function(){},
                success: function(dd){
                    $(".show").html(dd);
                },
                error: function(){
                    alert(0)
                }
            });

            });
        });


    </script>


<div class="shows"></div>
<div class="show"></div>