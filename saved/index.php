<html>

<head>
    <link rel="icon" type="image/png" href="favicon.png">
    <title>Saved Reult | Telegram Chat Analyzer</title>
    <meta name="keywords" content="telegram, analyzer, charts, analyse, statistics, evaluate, chat, telegramalyzer" />
    <meta name="description" content="Analyze your Telegram Chats (even group chats!) and receive fancy charts & statistics!" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.6.8/c3.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.7.0/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.6.8/c3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
</head>

<?php 
        $id = (int) $_GET["chat"];
    ?>

<script>
    var data = <?php include "getData.php" ?>;
    var group;
    var displayLegend;
    var barWidth;
    var colors;
    var dataTimeTotal;
    var dataTimeTotalMessages;
    var mostFrequentDay;
    var timeframeHtml;
    var personHtml;
    var totalsHtml;
    var dataBasic;
    var dataTrends;
    var dataTrendMessages;
    var dataTrendWords;
    var dataTrendWpM;
    var dataDictionary;
    var heartString;
    var dataDay;
    var dataWeek;

</script>

<body>
    <div id="container">
        <div id="title">
            <h1>Chat Statistics</h1>
        </div>

        <div id="participants"></div>

        <div id="totals">
        </div>

        <div class="pTitle">
            <div class="pColor" style="background-color: #666"></div>
            <div class="pName">Basic Information</div>
        </div>
        <div id="basicGroup">
            <div id="basicMessages"></div>
            <div id="basicWords"></div>
            <div id="basicWpM"></div>
            <div id="basicCpW"></div>
        </div>

        <div id="trendGroup">
            <div class="pTitle" id="trendMessagesTitle">
                <div class="pColor" style="background-color: #666"></div>
                <div class="pName">Messages<span> / Day (Trend)</span></div>
            </div>
            <div id="trendMessages"></div>

            <div class="pTitle" id="trendWordsTitle">
                <div class="pColor" style="background-color: #666"></div>
                <div class="pName">Words<span> / Day (Trend)</span></div>
            </div>
            <div id="trendWords"></div>

            <div class="pTitle" id="trendWpMTitle">
                <div class="pColor" style="background-color: #666"></div>
                <div class="pName">Words/Message<span> (Trend)</span></div>
            </div>
            <div id="trendWpM"></div>
        </div>

        <div class="pTitle">
            <div class="pColor" style="background-color: #666"></div>
            <div class="pName">Most common words</div>
        </div>
        <div id="languageGroup">
            <div id="languageTop10"></div>
            <div id="languageHearts"></div>
        </div>

        <div id="timeGroup">
            <div id="timeDayTitle" class="pTitle">
                <div class="pColor" style="background-color: #666"></div>
                <div class="pName">Hourly distribution</div>
            </div>
            <div id="timeDay"></div>
            <div id="timeWeekTitle" class="pTitle">
                <div class="pColor" style="background-color: #666"></div>
                <div class="pName">Weekly distribution</div>
            </div>
            <canvas id="timeWeek" width="300" height="300"></canvas>
            <div id="chartjsLegend" class="chartjsLegend"></div>
            <div id="timeTotalTitle" class="pTitle">
                <div class="pColor" style="background-color: #666"></div>
                <div class="pName">Total activity</div>
            </div>
            <div id="timeTotal"></div>
        </div>
        <a href="/">Back to Home</a>
    </div>
    <script src="../telegram.js"></script>
</body>

</html>
