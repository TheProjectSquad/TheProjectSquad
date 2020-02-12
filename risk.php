
LANGE JOHNNY

YES

NO

YES
KURK IS kurk
} else {
    $dicered = 3;
    $diceblue = 2;
    $match = 2;
};
//Set maximum for match (based on lowest amount of dice)
if ($dicered <= $diceblue) {
    $maxmatch = $dicered;
} else {
    $maxmatch = $diceblue;
};
//Calculate total count of dice to be created
$dicetotal = $dicered + $diceblue;
?>

idffidsfhdsffhds
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Risk Dice</title>
    <!-- Do style stuf -->
    <style>
        table tr td {
            border: none;
            border-collapse: collapse;
        }kurk
        td {
            width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            color: #fff;
            font-size: 44px;
        }
        .red {
            background-color: #f00;
        }
        .blue {
            background-color: #00f;
        }
    </style>
</head>
<body>
    <h1>Risk Dice</h1>
        <!-- Use a form for user input -->
        <form name="phpform" id="myForm" method="post">
            <input type="hidden" name="post" value="true">
            <!-- Show list for red dice -->
            <span style="color: #f00;">Red Dice:</span>
            <select name="r_dice" onchange="document.getElementById('myForm').submit();">
            <?php
                for ($i=1;$i<=$max_dice;$i++) {
                    if ( $i == $dicered ) { ?>
                        <option value="<?php echo $i ?>" selected="selected"><?php echo $i ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php
                    };
                };
            ?>
            </select>
            <!-- Show list for blue dice -->
            <span style="color: #00f;">Blue Dice:</span>
            <select name="b_dice" onchange="document.getElementById('myForm').submit();">
            <?php
                for ($i=1;$i<=$max_dice;$i++) {
                    if ( $i == $diceblue ) { ?>
                        <option value="<?php echo $i ?>" selected="selected"><?php echo $i ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php
                    };
                };
            ?>
            </select>
            <!-- Show list for match -->
            <span>Match:</span>
            <select name="match" onchange="document.getElementById('myForm').submit();">
            <?php
                for ($i=1;$i<=$maxmatch;$i++) {
                    if ( $i == $match ) { ?>
                        <option value="<?php echo $i ?>" selected="selected"><?php echo $i ?></option>
                    <?php } else { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php
                    };
                };
            ?>
            </select>
        </form>
        <p>
        <!-- button to roll again (javascript)-->
        <button id="MyButton" onclick="rndnr()">Roll the dice</button>
        <p><?php
            //Create the dice
            for ($dicecount = 0 ; $dicecount < $dicetotal ; $dicecount++) {
                if ($dicecount < $dicered) {
                    $useclass = 'red';
                } else {
                    $useclass = 'blue';
                }
            ?>
        <div style="border: 5px solid <?php if ($dicecount < $dicered) {echo '#f00';} else {echo '#00f';}; ?>;border-radius: 5px;width:60px;float: left;">
            <!-- Table with 3 rows and colums shown as a dice -->
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td id="d_<?php echo $dicecount ?>_0" class="<?php echo $useclass; ?>">&nbsp;</td>
                    <td id="d_<?php echo $dicecount ?>_1" class="<?php echo $useclass; ?>">&nbsp;</td>
                    <td id="d_<?php echo $dicecount ?>_2" class="<?php echo $useclass; ?>">&nbsp;</td>
                </tr>
                <tr>
                    <td id="d_<?php echo $dicecount ?>_3" class="<?php echo $useclass; ?>">&nbsp;</td>
                    <td id="d_<?php echo $dicecount ?>_4" class="<?php echo $useclass; ?>">&nbsp;</td>
                    <td id="d_<?php echo $dicecount ?>_5" class="<?php echo $useclass; ?>">&nbsp;</td>
                </tr>
                <tr>
                    <td id="d_<?php echo $dicecount ?>_6" class="<?php echo $useclass; ?>">&nbsp;</td>
                    <td id="d_<?php echo $dicecount ?>_7" class="<?php echo $useclass; ?>">&nbsp;</td>
                    <td id="d_<?php echo $dicecount ?>_8" class="<?php echo $useclass; ?>">&nbsp;</td>
                </tr>
            </table>
        </div>
        <div style="float: left;">&nbsp;</div>
        <?php
            };
        ?>
        <!-- Show result of dice on page -->
        <div style="float: left;">
            Rood levert <span id="min_r">rood</span> leger(s) in.<br>
            Blauw levert <span id="min_b">blauw</span> leger(s) in.
        </div>
</body>
<script>
    //build the dice ( 1 to 6)
    var dice = [[4],[0,8],[0,4,8],[0,2,6,8],[0,2,4,6,8],[0,2,3,5,6,8]];
    //js function to re-roll the dice
    function rndnr() {
        //empty arrays
        var dicevalue_r = [];
        var dicevalue_b = [];
        //reset values to 0 for armies to delete
        var b_min = 0;
        var r_min = 0;
        //set dice numbers in js
        var dicetotal = <?php echo $dicetotal ?>;
        var dicered = <?php echo $dicered ?>;
        var match = <?php echo $match ?>;
        //create random number for each dice
        for (k = 0 ; k < dicetotal ; k++){
            var rndnr = Math.floor(Math.random() * 6) + 1;
            //add value to correct array
            if ( k < dicered) {
                dicevalue_r.push(rndnr);
            } else {
                dicevalue_b.push(rndnr);
            };
            //show at correct dice the value
            var dice_on = dice[rndnr-1];
            for (i = 0 ; i < 9 ; i++) {
                document.getElementById('d_'+k+'_'+i).innerHTML = "&nbsp;";
            };
            for (var j = 0 ; j < dice_on.length ; j++) {
                document.getElementById('d_'+k+'_'+dice_on[j]).innerHTML = "&bull;";
            };
        };
        //sort the arrays with dice value descending (ascending then reverse)
        dicevalue_r.sort();
        dicevalue_r.reverse();
        dicevalue_b.sort();
        dicevalue_b.reverse();
        //match the dice and determine who looses
        for (i=0;i<match;i++) {
            if (dicevalue_r[i] > dicevalue_b[i]) {
                b_min++;
            } else {
                r_min++;
            };
        };
        //print result on page
        document.getElementById('min_r').innerHTML = r_min;
        document.getElementById('min_b').innerHTML = b_min;
        //log every result in console
        console.log(r_min+'-'+b_min);
    };
    //run js dice function on page load
    rndnr();
</script>
</html>
