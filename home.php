<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
</head>
<body>
    
    <div class="nav">
        <div class="text">
            <p>Welcome</p>
            <h2 id="name">UserName</h2>
        </div>

        <div class="circle open-mddll"></div>
    </div>

    <main>
        <div class="balance-card">
            <h1>Your Balance</h1>
            <div class="baln">
                <p id="balance">*****</p>

                <div class="circ" onclick="hidd()"></div>
            </div>
        </div>
    </main>

    <section>
        <div class="button open-modal" id="send">
            <div class="lilcir">
                <i data-feather="arrow-up-right"></i>
            </div>
            <h3 class="tex">Send <br> Funds</h3>
        </div>
        <div class="button open-modal" id="receive">
            <div class="lilcir">
                <i data-feather="arrow-down-left"></i>
            </div>
            <h3 class="tex">Receive <br> Funds</h3>
        </div>
    </section>




    <!-- Modals, Tabs, etc -->

    <div class="modal shw" id="sendd">
        <div class="modalcontent">
            <div class="topp">
                <h1>Send Funds</h1>
                <div class="modcir close-modal">
                    <i data-feather="x"></i>
                </div>
            </div>

            <div class="tab">
                <div class="cntt actve" onclick="openTabs(event, 'Account')"><p>Naira Account</p></div>
                <div class="cntt" onclick="openTabs(event, 'Tag')"><p>BeggTag</p></div>
            </div>

            <div class="tabcntt actv" id="Account">
                <form class="frm mod" id="acc" method="POST">
                    <input type="number" name="AccNum" id="AccNum" placeholder="Input Account Number">
                    <input type="text" name="SendAmnt" class="amount1" id="amount" placeholder="Input Amount" oninput="comma(this)">
                    <br>
                    <button type="submit">Send</button>
                    <div class="ttp"></div>
                </form>

                <div class="shows"></div>
            </div>
            <div class="tabcntt" id="Tag">
                <form class="frm mod" id="tagg" method="POST">
                    <input type="text" name="Tag" id="tag" placeholder="Input Begg Tag">
                    <input type="text" name="Amount" class="amount2" id="amnt"placeholder="Input Amount" oninput="comma(this)">
                    <br>
                    <button type="submit">Send</button>
                    <div class="ttt"></div>
                </form>
            </div>
           
        </div>
    </div>

    <div class="modal shw" id="rec">
        <div class="modalcontent">
            <div class="topp">
                <h1>Receive Funds</h1>
                <div class="modcir close-modal">
                    <i data-feather="x"></i>
                </div>
            </div>

            <div class="details">
                <div class="dets">
                    <h3>Bank</h3>
                    <p id="bank"></p>
                </div>
                <div class="dets">
                    <h3>Account Number</h3>
                    <p id="Num"></p>
                </div>
                <div class="dets">
                    <h3>Account Name</h3>
                    <p id="name2"></p>
                </div>
            </div>

            <div class="clipboard">
                <input type="text" name="" id="chip" value="">
                <button onclick="copy()">Copy Tag</button>
            </div>
        </div>
    </div>

    <section class="set">
        <h2>Your Beneficiaries</h2>
        <div class="benn">

        </div>
        <div class="modaall">
            <div class="contentt">    

            <div class="frrm">


            </div>
            </div>
        </div>
    </section>    

    <div class="mddall">
        <div class="topp">
            <div class="close close-mddll"></div>
            <h2 id="title">User Profile</h2>
        </div>
        <div class="profile">
        </div>
    </div>


<script>

    var bal;
      function jjj(){    
    fetch("userDetails.php").then(function(response){
        return response.json()
        }).then(function(data){
            $("#name").html(data[0]+' '+data[1]);
            $("#name2").html(data[0]+' '+data[1]);
            $("#Num").html(data[2]);
            $("#bank").html(data[3]);
            var tt=data[4];
            $("#chip").val(data[5]);
            bal=parseFloat(tt);
    });

}
jjj();

setInterval(jjj, 1000);



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
        $("#acc").on('submit', function(c){
            c.preventDefault();
            var amountInput1 = document.querySelector('.amount1');
            var cleanValue1 = removeComma(amountInput1);

            $.ajax({
                url: 'nairaSend.php',
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

        $("#tagg").on('submit', function(c){
            c.preventDefault();
            var amountInput2 = document.querySelector('.amount2');
            var cleanValue2 = removeComma(amountInput2);

            $.ajax({
                url: 'tagSend.php',
                type: 'post',
                data: new FormData(this),
                contentType: false,
                processData:false,
                cache: false,
                beforeSend: function(){},
                success: function(dd){
                    $(".ttt").html(dd);
                },
                error: function(){
                    alert(0)
                }
            });

        });

    });

    $(document).ready(function () {
        setInterval(() => {
        $(".benn").load("benn.php"); 
    }, 1000);
    })

    $(document).ready(function () {
        $(".profile").load("profile.php");
    })
    

    function copy() {
        var copyText = document.getElementById("chip");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        navigator.clipboard.writeText(copyText.value);
        alert("Tag copied");
    }     


    var hid = 0;
    var txt = document.getElementById("balance");
    
    
    function hidd() {
        
        hid++ ;
        if (hid == 2) {
            hid = 0 ;
        }

        if (hid == 1) {
            txt.innerHTML = bal.toLocaleString(); // hid is at 1;
        } else
        {
            txt.innerHTML = "*****"; // hid is at 0
        }
        
    }

    

    const modals = document.querySelectorAll('.modal');
    const closeButtons = document.querySelectorAll('.close-modal'); // More specific class name
    const openButtons = document.querySelectorAll('.open-modal');

    function openModal(modal) {
    modal.classList.add('show'); // Using a more descriptive class name
    }

    function closeModal(modal) {
    modal.classList.remove('show');
    }

    function closeAllModals() {
    modals.forEach(closeModal);
    }

    closeButtons.forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.modal'); // Get closest modal element
        if (modal) {
        closeModal(modal);
        }
    });
    });

    openButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
        openModal(modals[index]);
    });
    });


    function openTab(evt, status) {
    var i, tabcnt, cnt;

    tabcontent = document.getElementsByClassName("tabcnt");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";   
        }

    cnt = document.getElementsByClassName("cnt");
        for (i = 0; i < cnt.length; i++) {
            cnt[i].className = cnt[i].className.replace("actve", "");
        }

    document.getElementById(status).style.display = "block";

    evt.currentTarget.classList.add("actve");
    }

    function openTabs(evt, status) {
    var i, tabcnt, cnt;

    tabcontent = document.getElementsByClassName("tabcntt");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";   
        }

    cnt = document.getElementsByClassName("cntt");
        for (i = 0; i < cnt.length; i++) {
            cnt[i].className = cnt[i].className.replace("actve", "");
        }

    document.getElementById(status).style.display = "block";

    evt.currentTarget.classList.add("actve");
    }


    var moddallz = document.getElementsByClassName("mddall");
    var openModdall = document.getElementsByClassName("open-mddll");
    var closeModdall = document.getElementsByClassName("close-mddll");


    openModdall[0].addEventListener("click", function () {
        moddallz[0].style.display = "flex";
    })

    closeModdall[0].addEventListener("click", function () {
        moddallz[0].style.display = "none";
    })
    

    

</script>
    
</body>
</html>