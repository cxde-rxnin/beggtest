

<div id="index"> 
    <div class="card activ" id="Dashboard">
    </div>

    <div class="card" id="GiveAway">

        <div class="navv">
            <div class="tab" id="act">
                <div class="cnte" onclick="openTabb(event, 'Dabb1')" style="border-bottom: 4px solid #c3e647"><p>Giveaway</p></div>
                <div class="cnte" onclick="openTabb(event, 'Dabb2')"><p>My Giveaways</p></div>
            </div>
        </div>
            <div class="tabcnte" id="Dabb1" style="display: block;">
                <div class="content" id="red">
                </div>
                <div class="deeet modall">
                    <div class="cac">
                        <div class="close modal-close"></div>
                        <h2>Giveaway Details</h2>
                    </div>
                    <div class="dtail">

                    </div>
                </div>

            </div>

        <div class="tabcnte" id="Dabb2" style="display: none;">

            <div class="content"id="blue">
            </div>
            <div class="deeet modll">
                    <div class="cac">
                        <div class="close modll-close"></div>
                        <h2>Giveaway Details</h2>
                    </div>
                    <div class="dtaill">

                    </div>
                </div>
            <button class="bttn open-modal up" id="Gve">Start Giveaway</button>

            <div class="modal shw" id="Gvwy">
            <div class="modalcontent">
                <div class="topp">
                    <div class="t3xt">
                        <h1 style="padding-left: 1rem;" id="caption">Start Giveaway</h1>
                        <p style="padding-left: 1rem;">Odogwu. Show your people love. 🤲</p>
                    </div>
                    <div class="modcir close-modal" style="margin-top: 1rem;"></div>
                </div>
                <form class="frm" method="post" id="GA">
                    <input type="text" name="Name" id="Name" placeholder="Input Giveaway Name">
                    <input type="text" name="limit" id="Elimit" class="amnt1" placeholder="Input Entry Limit" oninput="comma(this)">
                    <input type="text" name="Wlimit" id="Wlimit" class="amnt2" placeholder="Input Winner Limit" oninput="comma(this)">
                    <input type="text" name="Amount" id="Amount" class="amnt3" placeholder="Input Giveaway Amount" oninput="comma(this)">
                    <span class="name">
                        <input type="date" name="Sdate" class="names" id="" placeholder="Start Date">
                        <input type="date" name="Edate" class="names" id="" placeholder="End Date">
                    </span>
                    <textarea name="req" id="tarea" placeholder="Giveaway Requirements"></textarea>

                    <button type="submit">Begin Giveaway</button>
                </form>
            </div>
        </div>


        <div class="ttp"></div>
        
    </div>

    </div>

    <div class="card" id="CrowdFund">

    <div class="navv">
            <div class="tab" id="act">
                <div class="cntte" onclick="openTabx(event, 'Chop1')" style="border-bottom: 4px solid #c3e647"><p>CrowdFund</p></div>
                <div class="cntte" onclick="openTabx(event, 'Chop2')"><p>My CrowdFunds</p></div>
            </div>
        </div>
        <div class="tabcntte" id="Chop1" style="display: block;">

            <div class="content" id="redd">


            </div>
            <div class="deeet modl">
                <div class="cac">
                    <div class="close modl-close"></div>
                    <h2>CrowdFund Details</h2>
                </div>
                <div class="dtll">
                </div>
            </div>

        </div>

        <div class="tabcntte" id="Chop2" style="display: none;">

            <div class="content"id="bluee">

            </div>
            <div class="deeet moddll">
                <div class="cac">
                    <div class="close moddll-close"></div>
                    <h2>CrowdFund Details</h2>
                </div>
                <div class="dttll">
                </div>
            </div>
            <button class="bttn open-modal" id="Gve">Create CrowdFund</button>
        
        </div>

            <div class="modal shw" id="Gvwy">
            <div class="modalcontent">
                <div class="topp">
                    <div class="t3xt">
                        <h1 style="padding-left: 1rem;" id="caption">Create CrowdFund</h1>
                        <p style="padding-left: 1rem;">Begg them with your full chest 💪</p>
                    </div>
                    <div class="modcir close-modal" style="margin-top: 1rem;"></div>
                </div>
                <form class="frm" method="post" id="CF">
                    <input type="text" name="Name" id="Name" placeholder="Input Crowdfund Name">
                    <input type="text" name="Amount" id="Amount" class="amnt4" placeholder="Input Crowdfund Amount" oninput="comma(this)">
                    <span class="name">
                        <input type="date" name="Sdate" class="names" id="Sdate" placeholder="Start Date">
                        <input type="date" name="Edate" class="names" id="Edate" placeholder="End Date">
                    </span>
                    <textarea name="req" id="tarea" placeholder="Crowdfund Requests"></textarea>

                    <button type="submit">Begin Crowdfund</button>
                </form>
            </div>
        


        <div class="ttp"></div>
        
    </div>


    </div>

    <div class="card" id="Transaction">
    <div class="navv">
        <h2>Transactions</h2>
    </div>
    <div class="content" id="transact">
    </div>
    </div>

    <nav>
        <div class="box active" onclick="hide(0)"></div>
        <div class="box" onclick="hide(1)"></div>
        <div class="box" onclick="hide(2)"></div>
        <div class="box" onclick="hide(3)"></div>
    </nav>
</div>

<script>
    var card = document.getElementsByClassName('card');
    var btn = document.getElementsByClassName("box");

    function hide(x) {
        for(y=0;y<4;y++){
            card[y].style.display="none";
            btn[y].classList.remove("active");

           
        }
        card[x].style.display="block";
        btn[x].classList.add("active");        
    }

    $(document).ready(function () {
        
        $("#Dashboard").load("home.php");
       // $("CrowdFund").load("Crowding.php");

       setInterval(() => {
            $("#red").load("Gactivity.php");
        }, 2000);

        setInterval(() => {
            $("#blue").load("Activity.php");
        }, 2000);

        setInterval(() => {
            $("#redd").load("Cactivity.php");
        }, 2000);

        setInterval(() => {
            $("#bluee").load("Activity2.php");
        }, 2000);

        setInterval(() => {
            $("#transact").load("transaction.php");
        }, 2000);


    })

    const modal = document.querySelectorAll('.modal');
    const closeButton = document.querySelectorAll('.close-modal');
    const openButton = document.querySelectorAll('.open-modal');

    function openModal(modal) {
    modal.classList.add('show');
    }

    function closeModal(modal) {
    modal.classList.remove('show');
    }

    function closeAllModals() {
    modal.forEach(closeModal);
    }

    closeButton.forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.modal');
        if (modal) {
        closeModal(modal);
        }
    });
    });

    openButton.forEach((button, index) => {
    button.addEventListener('click', () => {
        openModal(modal[index]);
    });
    });

    function comma(input) {
    var value = input.value.replace(/,/g, '');
    var ui = parseFloat(value);
    if (!isNaN(ui)) {
        var formattedValue = ui.toLocaleString();
        input.value = formattedValue;
    } else {
        input.value = '';
    }
}

    function removeComma(input) {
    var value = input.value;
    var cleanValue = value.replace(/,/g, '');
    input.value = cleanValue;
    return cleanValue;
}


    $(document).ready(function () {
        $("#GA").on('submit', function(c){
            c.preventDefault();
            var amountInput1 = document.querySelector('.amnt1');
            var cleanValue1 = removeComma(amountInput1);

            var amountInput1 = document.querySelector('.amnt2');
            var cleanValue1 = removeComma(amountInput1);

            var amountInput1 = document.querySelector('.amnt3');
            var cleanValue1 = removeComma(amountInput1);

            $.ajax({
                url: 'giveaway.php',
                type: 'post',
                data: new FormData(this),
                contentType: false,
                processData:false,
                cache: false,
                beforeSend: function(){},
                success: function(dd){
                    $(".ttp").html(dd);
                },
                error: function(){
                    alert(0)
                }
            });

        });
    });

    $(document).ready(function () {
        $("#CF").on('submit', function(c){
            c.preventDefault();
            
            var amountInput2 = document.querySelector('.amnt4');
            var cleanValue2 = removeComma(amountInput2);

            $.ajax({
                url: 'crowdfund.php',
                type: 'post',
                data: new FormData(this),
                contentType: false,
                processData:false,
                cache: false,
                beforeSend: function(){},
                success: function(dd){
                    $(".ttp").html(dd);
                },
                error: function(){
                    alert(0)
                }
            });

        });
    });

    
    

</script>