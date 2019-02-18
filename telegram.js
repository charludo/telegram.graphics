/*
   _____ _                         
  / ____| |                        
 | |    | | __ _ ___ ___  ___  ___ 
 | |    | |/ _` / __/ __|/ _ \/ __|
 | |____| | (_| \__ \__ \  __/\__ \
  \_____|_|\__,_|___/___/\___||___/
*/

class Message {
    constructor(time) {
        this.time = time;
    }
}

class Word {
    constructor(word) {
        this.word = word;
        this.frequency = 1;
    }
}

class Day {
    constructor(date, messageCount, wordCount) {
        this.date = date;
        this.messageCount = messageCount;
        this.wordCount = wordCount;
    }
}

class Person {
    constructor(name, firstDate) {
        this.name = name;
        this.messageCount = 0;
        this.wordCount = 0;
        this.characterCount = 0;
        this.dictionary = [];
        this.week = [0, 0, 0, 0, 0, 0, 0];
        this.hour = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        this.timeline = [new Day(Date.UTC(firstDate.getFullYear(), firstDate.getMonth(), firstDate.getDate()), 0, 0)];
    }

    appendDictionary(message) {
        message = message.replace(/\\n/g, " ");
        message = message.replace(/[&;$%@"<>()]/g, " ");
        message = message.replace(/[\\\.\,\!\?\:-]/g, '');
        message = message.replace(/❤️/g, " \u2764\ufe0f ");
        message = message.replace(/💘/g, " \u2764\ufe0f ");
        message = message.replace(/💝/g, " \u2764\ufe0f ");
        message = message.replace(/💖/g, " \u2764\ufe0f ");
        message = message.replace(/💗/g, " \u2764\ufe0f ");
        message = message.replace(/💓/g, " \u2764\ufe0f ");
        message = message.replace(/💞/g, " \u2764\ufe0f ");
        message = message.replace(/💕/g, " \u2764\ufe0f ");
        message = message.replace(/💟/g, " \u2764\ufe0f ");
        message = message.replace(/❣/g, " \u2764\ufe0f ");
        message = message.replace(/💔/g, " \u2764\ufe0f ");
        message = message.replace(/❤/g, " \u2764\ufe0f ");
        message = message.replace(/💛/g, " \u2764\ufe0f ");
        message = message.replace(/💚/g, " \u2764\ufe0f ");
        message = message.replace(/💙/g, " \u2764\ufe0f ");
        message = message.replace(/🖤/g, " \u2764\ufe0f ");
        message = message.replace(/💜/g, " \u2764\ufe0f ");
        message = message.replace(/💙/g, " \u2764\ufe0f ");
        message = message.replace(/\s\s+/g, ' ');
        message = message.toLocaleLowerCase().split(/\s+/).filter(Boolean);

        for (var k = 0; k < message.length; k++) {
            var j = 0;
            while (j < this.dictionary.length && this.dictionary[j].word != message[k]) {
                j++;
            }
            if (j >= this.dictionary.length) {
                var entry = new Word(message[k]);
                this.dictionary.push(entry);
            } else {
                this.dictionary[j].frequency++;
            }
        }
    }

    incDay(date) {
        var result = new Date(date);
        result.setDate(result.getDate() + 1);
        return result;
    }

    appendTimeline(d, wordCount) {
        var last = this.timeline[this.timeline.length - 1];
        var date = Date.UTC(d.getFullYear(), d.getMonth(), d.getDate());
        while (date.valueOf() > last.date.valueOf()) {
            this.timeline.push(new Day(this.incDay(last.date), 0, 0));
            last = this.timeline[this.timeline.length - 1];
        }
        last.messageCount++;
        last.wordCount += wordCount;
    }

}






/*
  ______                _   _                 
 |  ____|              | | (_)                
 | |__ _   _ _ __   ___| |_ _  ___  _ __  ___ 
 |  __| | | | '_ \ / __| __| |/ _ \| '_ \/ __|
 | |  | |_| | | | | (__| |_| | (_) | | | \__ \
 |_|   \__,_|_| |_|\___|\__|_|\___/|_| |_|___/
 */



/******************************************
    Function originally used for 
    generating total activity data,
    but results now used for other
    stuff too:
    - most Frequent Day (Total Stats)
    - Trend data generation
******************************************/
function generateDataTimeTotal() {
    var columns = [];
    var wordColumns = [];
    var dates = [];
    for (i in person) {
        var data = [];
        var words = [];
        var pDates = [];
        for (j in person[i].timeline) {
            data.push(person[i].timeline[j].messageCount);
            words.push(person[i].timeline[j].wordCount);
            pDates.push(person[i].timeline[j].date);
        }

        var combinedDates = dates.concat(pDates);
        var sortedCombined = combinedDates.sort(function (a, b) {
            return a.valueOf() - b.valueOf();
        });

        dates = [];
        for (var j = 0; j < sortedCombined.length - 1; j++) {
            if (sortedCombined[j + 1].valueOf() != sortedCombined[j].valueOf()) {
                dates.push(sortedCombined[j]);
            }
        }

        var endPoint = dates.indexOf(pDates[0]);
        var k = 0;
        while (k < endPoint) {
            data.unshift(null);
            words.unshift(null);
            k++;
        }
        while (data.length < dates.length) {
            data.push(0);
            words.push(0);
        }


        data.unshift(person[i].name);
        words.unshift(person[i].name);
        columns.push(data);
        wordColumns.push(words);

    }
    for (i in wordColumns) {
        columns.push(wordColumns[i]);
    }
    dates.unshift("dates");
    columns.unshift(dates);
    return columns;
}


/******************************************
    Find most frequent day and number
    of messages sent that day; relies
    on generateDataTimeTotal()
******************************************/
function mostFrequentDayF() {
    var totals = [].concat(dataTimeTotalMessages[1]);
    totals.shift(0);
    var i = 2;
    while (i < dataTimeTotalMessages.length) {
        for (var j = 1; j < dataTimeTotalMessages[i].length; j++) {
            totals[j - 1] += dataTimeTotalMessages[i][j];
        }
        i++;
    }
    var highestFrequency = Math.max.apply(null, totals);
    var highestFrequencyIndex = totals.indexOf(highestFrequency);
    var date = new Date(dataTimeTotal[0][highestFrequencyIndex + 1]);
    var dateString = (date.getMonth() + 1 > 9 ? "" : "0") + (date.getMonth() + 1) + "/" + (date.getDate() > 9 ? "" : "0") + date.getDate() + "/" + date.getFullYear();

    return [dateString, highestFrequency];
}

/******************************************
    Find the median time between 
    messages sent
******************************************/
function getMedianTimeString() {
    var gaps = [];
    for (i = 1; i < messages.length; i++) {
        var now = messages[i].time;
        var prev = messages[i - 1].time;
        gaps.push(Math.abs((now.getTime() - prev.getTime()) / 1000));
    }
    gaps.sort(function (a, b) {
        return a - b;
    });
    var median = gaps[Math.floor(gaps.length / 2)];
    return (Math.floor(median / 60) + "m " + (median % 60) + "s");
}

/******************************************
    Generate the subtitle containing
    start and end dates
******************************************/
function generateTimeframeHtml() {
    var start = (dateStart.getMonth() + 1 > 9 ? "" : "0") + (dateStart.getMonth() + 1) + "/" + (dateStart.getDate() > 9 ? "" : "0") + dateStart.getDate() + "/" + dateStart.getFullYear();
    var end = (dateEnd.getMonth() + 1 > 9 ? "" : "0") + (dateEnd.getMonth() + 1) + "/" + (dateEnd.getDate() > 9 ? "" : "0") + dateEnd.getDate() + "/" + dateEnd.getFullYear();
    return `<h2>${start} to ${end}</h2>`;
}


/******************************************
    Generate HTML for individual
    person's stats
******************************************/
function generatePersonHtml([color, name, totalMessages, totalWords, wordsPerMessage, charactersPerWord]) {
    return `<div class="participant">
            <div class="pTitle">
                <div class="pColor" style="background-color: ${color}"></div>
                <div class="pName">${name}</div>
            </div>
            <div class="pStats">
                <p class="pTotalMessages">Messages: <span>${totalMessages}</span></p>
                <p class="pTotalWords">Words: <span>${totalWords}</span></p>
                <p class="pWordsPerMessage">Words per message: <span>${wordsPerMessage}</span></p>
                <p class="pCharactersPerWord">Average wordlength: <span>${charactersPerWord}</span></p>
            </div>
        </div>`;
}


/******************************************
    Returns array of data for each person,
    calls generatePersonHtml()
******************************************/
function generateDataPerson() {
    var pStats = [];
    for (i in person) {
        pStats.push(generatePersonHtml([colors[i], person[i].name, person[i].messageCount, person[i].wordCount, (person[i].wordCount / person[i].messageCount).toFixed(2), (person[i].characterCount / person[i].wordCount).toFixed(2)]));
    }
    return pStats;
}


/******************************************
    Generates Totals and Averages
    stats and HTML section
******************************************/
function generateTotalsHtml() {
    var mfDayD = mostFrequentDay[0];
    var mfDayF = mostFrequentDay[1];
    var messagesPerDay = Math.round(messageCount / (dataTimeTotalMessages[0].length - 1));
    var medianWait = getMedianTimeString();
    var messageLengthAverage = (characterCount / messageCount).toFixed(2);

    return `<div id="totalsA">
            <div class="pTitle">
                <div class="pColor" style="background-color: #666"></div>
                <div class="pName">Totals:</div>
            </div>
            <p id="tTotalMessages">Messages: <span>${messageCount}</span></p>
            <p id="tTotalWords">Words: <span>${wordCount}</span></p>
            <p id="tTotalCharacters">Characters: <span>${characterCount}</span></p>
        </div>

        <div id="totalsB">
            <div class="pTitle">
                <div class="pColor" style="background-color: #666"></div>
                <div class="pName">Averages:</div>
            </div>
            <p id="tMostActiveDay">Most avtive day: <span>${mfDayD}</span> (${mfDayF})</p>
            <p id="tAverageMessagesPerDay">Messages per day: <span>${messagesPerDay}</span></p>
            <p id="tAverageMedianWait">Median time between messages: <span>${medianWait}</span></p>
            <p id="tAverageMessageLength">Message length: <span>${messageLengthAverage}</span> Characters</p>
        </div>`;
}


/******************************************
    Returns array with each persons
    name inside. Used to group datasets
    by c3.js
******************************************/
function groupAll() {
    var group = [];
    for (i in person) {
        group.push(person[i].name);
    }
    return group;
}


/******************************************
    Decide whether or not do display 
    legends
******************************************/
function decideDisplayLegend() {
    if (person.length > 4) {
        return {
            show: false
        };
    } else {
        return {
            show: true
        };
    }
}

function decideBarWidth() {
    var months;
    months = (dateEnd.getFullYear() - dateStart.getFullYear()) * 12;
    months -= dateStart.getMonth() + 1;
    months += dateEnd.getMonth();
    return months > 6 ? 1 : {
        ratio: 1
    };
}

/******************************************
    Generates Basic stats and returns
    all of them in one array
******************************************/
function generateDataBasic() {
    var messages = [];
    var words = [];
    var wpm = [];
    var cpw = [];
    for (i in person) {
        messages.push([person[i].name, person[i].messageCount]);
        words.push([person[i].name, person[i].wordCount]);
        wpm.push([person[i].name, person[i].wordCount / person[i].messageCount]);
        cpw.push([person[i].name, person[i].characterCount / person[i].wordCount]);
    }
    return [messages, words, wpm, cpw];
}


/******************************************
    Generates data for the Trends-
    section. Returns everything in 
    one array.
    Relies on generateDataTimeTotal()
******************************************/
function generateDataTrends() {
    var dates = [];
    var messages = [];
    var words = [];
    var wpm = [];

    for (i = 0; i < person.length; i++) {
        messages.push([person[i].name]);
        words.push([person[i].name]);
        wpm.push([person[i].name]);
    }

    for (i = 0; i < dataTimeTotal[0].length; i++) {
        if (i % 7 == 0) {
            dates.push(Date.parse(dataTimeTotal[0][i]));
            for (k = 1; k < person.length + 1; k++) {
                var msgCount = 0;
                var wordCount = 0;
                for (j = 0; j < 7; j++) {
                    try {
                        msgCount += dataTimeTotalMessages[k][i + j];
                        wordCount += dataTimeTotal[k + (dataTimeTotalMessages.length - 1)][i + j];
                    } finally {}
                }
                messages[k - 1].push(Math.round(msgCount / 7));
                words[k - 1].push(Math.round(wordCount / 7));
                wpm[k - 1].push((msgCount > 0 ? (wordCount / msgCount).toFixed(2) : 0));
                msgCount = 0;
                wordCount = 0;
            }
        }
    }
    dates.unshift("dates");

    return [dates, messages, words, wpm];
}


/******************************************
    Combines all persons dictionaries,
    finds the most commonly used words
    and returns the frequency of those
    words from each individual dictionary
******************************************/
function generateDataDictionary() {
    var lmlData = [];
    for (i = 0; i < person.length; i++) {
        lmlData.push([person[i].name]);
        for (var k = 0; k < person[i].dictionary.length; k++) {
            if (person[i].dictionary[k].word.length > 3 || person[i].dictionary[k].word == "❤️") {
                var j = 0;
                while (j < dictionary.length && dictionary[j].word != person[i].dictionary[k].word) {
                    j++;
                }
                if (j >= dictionary.length) {
                    var entry = new Word(person[i].dictionary[k].word);
                    entry.frequency = person[i].dictionary[k].frequency;
                    dictionary.push(entry);
                } else {
                    dictionary[j].frequency += person[i].dictionary[k].frequency;
                }
            }
        }
    }
    lmlData.push(["Total"]);
    dictionary.sort(function (a, b) {
        return b.frequency - a.frequency
    });


    var lmlLabel = [];
    for (i = 0; i < 10; i++) {
        var word = dictionary[i].word;
        lmlLabel.push(word);
        for (j in person) {
            var k = 0;
            while (k < person[j].dictionary.length && person[j].dictionary[k].word != word) {
                k++;
            }
            if (k >= person[j].dictionary.length) {
                lmlData[j].push(0);
            } else {
                lmlData[j].push(person[j].dictionary[k].frequency);
            }
        }
        lmlData[lmlData.length - 1].push(dictionary[i].frequency);
    }

    var lmlGroup = []
    if (person.length > 3) {
        lmlGroup = groupAll();
    }

    return [lmlData, lmlLabel, lmlGroup];
}


/******************************************
    Counts the overall amount of hearts.

    I'm not proud of this whole thing.
    Something about the use of the actual
    emojis in code feels hacky 🙄
******************************************/
function countHearts() {
    var k = 0;
    while (k < dictionary.length && dictionary[k].word != "❤️") {
        k++;
    }
    if (k < dictionary.length) {
        return '<div id="heart">❤️</div><p>' + dictionary[k].frequency + '</p>';
    } else {
        return "";
    }

}

/******************************************
    Accepts Hex and Alpha, returns rgba
******************************************/
function hexToRGB(hex, alpha) {
    var r = parseInt(hex.slice(1, 3), 16),
        g = parseInt(hex.slice(3, 5), 16),
        b = parseInt(hex.slice(5, 7), 16);

    if (alpha) {
        return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
    } else {
        return "rgb(" + r + ", " + g + ", " + b + ")";
    }
}

/******************************************
    Returns hour[] from each person.
******************************************/
function generateDataDay() {
    var result = [];
    for (i in person) {
        result.push([person[i].name].concat(person[i].hour));
    }
    return result;
}

/******************************************
    Returns week[] from each person.
******************************************/
function generateDataWeek() {
    var datasets = [];
    for (i in person) {
        datasets.push({
            label: person[i].name,
            data: person[i].week,
            backgroundColor: hexToRGB(colors[i], 0.4),
            borderColor: hexToRGB(colors[i])
        });
    }
    return datasets;
}





/*
   _____      _ _           _     _____        _        
  / ____|    | | |         | |   |  __ \      | |       
 | |     ___ | | | ___  ___| |_  | |  | | __ _| |_ __ _ 
 | |    / _ \| | |/ _ \/ __| __| | |  | |/ _` | __/ _` |
 | |___| (_) | | |  __/ (__| |_  | |__| | (_| | || (_| |
  \_____\___/|_|_|\___|\___|\__| |_____/ \__,_|\__\__,_|
*/


/******************************************
    Read the JSON file
******************************************/
/*var messageString = new XMLHttpRequest();
messageString.open("GET", "aresult.json", false);
messageString.send(null);
var messageListJson = JSON.parse(messageString.responseText);*/

// ID of Chat to be analyzed
//var chatID = 0;

// Start and End date of timeframe to be analyzed
var dateStart;
var dateEnd;

// Person: List of all active senders in chat,
// most data is Stored here
// Dictionary: For later use, will contain combined
// dictionaries from all senders
var person = [];
var dictionary = [];
var messages = [];

// Most basic overall stats, counted up while
// parsinf each message
var messageCount = 0;
var wordCount = 0;
var characterCount = 0;


function findSenders(messageListJson, chatID) {
    for (i in messageListJson.chats.list[chatID].messages) {
        var datetime = messageListJson.chats.list[chatID].messages[i].date;
        var time = new Date(datetime);

        var from = messageListJson.chats.list[chatID].messages[i].from;
        if (typeof from != "undefined") {
            var p = 0;
            while (p < person.length && person[p].name != from) {
                p++;
            }
            if (p >= person.length) {
                person[p] = new Person(from, time);
            }
        }
    }
}

function analyze(messageListJson, chatID) {
    /******************************************
        Parse the file

        - throw out messages with (undefined)
            sender (why do those exist??)
        - if there's formatting in the text,
            get the formatted text, add it
            to the message string and discard
            the formatting-object
        - collect relevant data, store it in
            respective person-object

        AT NO POINT IS THE ACTUAL CONTENT OF
        THE MESSAGE ANALYZED, LOOKED AT, 
        STORED OR OTHERWISE FUCKED AROUND WITH!
    ******************************************/
    person = [];
    for (i in messageListJson.chats.list[chatID].messages) {
        var time, text, words, characters, from;

        /******************************************
            TIME
        ******************************************/
        var datetime = messageListJson.chats.list[chatID].messages[i].date;
        time = new Date(datetime);
        messages.push(new Message(time));

        /******************************************
            FROM
                (discard undefined sender)
                (discard out of timeframe)
        ******************************************/
        from = messageListJson.chats.list[chatID].messages[i].from;
        if (typeof from != "undefined" && dateStart.getTime() <= time.getTime() && time.getTime() <= dateEnd.getTime()) {
            var p = 0;
            while (p < person.length && person[p].name != from) {
                p++;
            }
            if (p >= person.length) {
                person[p] = new Person(from, time);
            }

            /******************************************
                TEXT
            ******************************************/
            //Convert formatting-objects to string, but only their content...
            if (typeof messageListJson.chats.list[chatID].messages[i].text[1] != "undefined" && typeof messageListJson.chats.list[chatID].messages[i].text[1].text != "undefined") {
                text = messageListJson.chats.list[chatID].messages[i].text[0];
                for (j = 1; j < messageListJson.chats.list[chatID].messages[i].text.length; j++) {
                    if (typeof messageListJson.chats.list[chatID].messages[i].text[j].text != "undefined") {
                        text += messageListJson.chats.list[chatID].messages[i].text[j].text;
                    } else {
                        text += messageListJson.chats.list[chatID].messages[i].text[j]
                    }
                }
            } else {
                text = messageListJson.chats.list[chatID].messages[i].text;
            }
            text += "";


            /******************************************
                WORDS, CHARACTERS
            ******************************************/
            words = text.split(" ").length;
            characters = text.length;

            /******************************************
                Store relevant information with the
                message sender
            ******************************************/
            person[p].messageCount++;
            person[p].wordCount += words;
            person[p].characterCount += characters;
            person[p].week[(time.getDay() + 6) % 7]++;
            person[p].hour[time.getHours()]++;
            person[p].appendDictionary(text);
            person[p].appendTimeline(time, words);

            /******************************************
                Update overall stats
            ******************************************/
            messageCount++;
            wordCount += words;
            characterCount += characters;
        }
    }
}


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




/*                     _                 _____        _        
     /\               | |               |  __ \      | |       
    /  \   _ __   __ _| |_   _ _______  | |  | | __ _| |_ __ _ 
   / /\ \ | '_ \ / _` | | | | |_  / _ \ | |  | |/ _` | __/ _` |
  / ____ \| | | | (_| | | |_| |/ /  __/ | |__| | (_| | || (_| |
 /_/    \_\_| |_|\__,_|_|\__, /___\___| |_____/ \__,_|\__\__,_|
                          __/ |                                
                         |___/                                 
*/
function evaluate(colorlist) {
    // Array with all senders names, used to group datasets in c3.js
    group = groupAll();
    displayLegend = decideDisplayLegend();
    barWidth = decideBarWidth();
    // Array with colors to be used
    colors = colorlist;

    // Timeline of dates/messages/words/characters send by each indivisual sender
    // Used by a number of charts (see comments in function)
    dataTimeTotal = generateDataTimeTotal();
    // Only dates and message-data
    dataTimeTotalMessages = dataTimeTotal.slice(0, ((dataTimeTotal.length - 1) / 2 + 1));

    // Data for base stats about each sender/totals/averages
    mostFrequentDay = mostFrequentDayF();
    timeframeHtml = generateTimeframeHtml();
    personHtml = generateDataPerson();
    totalsHtml = generateTotalsHtml();

    //Data for Basic-Section
    dataBasic = generateDataBasic();

    // Data for Trend-Section
    dataTrends = generateDataTrends();
    dataTrendMessages = [dataTrends[0]];
    dataTrendWords = [dataTrends[0]];
    dataTrendWpM = [dataTrends[0]];
    for (i in person) {
        dataTrendMessages.push(dataTrends[1][i]);
        dataTrendWords.push(dataTrends[2][i]);
        dataTrendWpM.push(dataTrends[3][i]);
    }

    // Data for Language-Section
    dataDictionary = generateDataDictionary();
    heartString = countHearts();

    // Data for Time-Section
    dataDay = generateDataDay();
    dataWeek = generateDataWeek();
    // dataTimeTotal also belongs here, but is used further above
}






/*_____  _           _                _____ _                _       
 |  __ \(_)         | |              / ____| |              | |      
 | |  | |_ ___ _ __ | | __ _ _   _  | |    | |__   __ _ _ __| |_ ___ 
 | |  | | / __| '_ \| |/ _` | | | | | |    | '_ \ / _` | '__| __/ __|
 | |__| | \__ \ |_) | | (_| | |_| | | |____| | | | (_| | |  | |_\__ \
 |_____/|_|___/ .__/|_|\__,_|\__, |  \_____|_| |_|\__,_|_|   \__|___/
              | |             __/ |                                  
              |_|            |___/                                   
*/

function display() {
    /******************************************
        Persons/Totsals/Averages Section
    ******************************************/
    $("#title").append(timeframeHtml);

    for (i in personHtml) {
        $("#participants").append(personHtml[i]);
    }

    $("#totals").append(totalsHtml);


    /******************************************
        Basic Section
    ******************************************/
    var basicMessages = c3.generate({
        bindto: "#basicMessages",
        data: {
            columns: dataBasic[0],
            type: "donut"
        },
        donut: {
            title: "Messages",
            label: {
                format: function (value) {
                    return value;
                }
            }
        },
        legend: {
            show: false
        },
        color: {
            pattern: colors
        }
    });

    var basicWords = c3.generate({
        bindto: "#basicWords",
        data: {
            columns: dataBasic[1],
            type: "donut"
        },
        donut: {
            title: "Words",
            label: {
                format: function (value) {
                    return value;
                }
            }
        },
        legend: {
            show: false
        },
        color: {
            pattern: colors
        }
    });

    var basicWpM = c3.generate({
        bindto: "#basicWpM",
        data: {
            columns: dataBasic[2],
            type: "donut"
        },
        donut: {
            title: "Words/Message",
            label: {
                format: function (value) {
                    return value.toFixed(2);
                }
            }
        },
        legend: {
            show: false
        },
        color: {
            pattern: colors
        }
    });

    var basicCpW = c3.generate({
        bindto: "#basicCpW",
        data: {
            columns: dataBasic[3],
            type: "donut"
        },
        donut: {
            title: "Wordlength",
            label: {
                format: function (value) {
                    return value.toFixed(2);
                }
            }
        },
        legend: {
            show: false
        },
        color: {
            pattern: colors
        }
    });



    /******************************************
        Trend Section
    ******************************************/
    var trendMessages = c3.generate({
        bindto: "#trendMessages",
        size: {
            height: 250
        },
        data: {
            x: "dates",
            columns: dataTrendMessages,
            type: "line"
        },
        legend: {
            show: false
        },
        point: {
            show: false
        },
        axis: {
            x: {
                type: "timeseries",
                tick: {
                    format: "%m/%Y",
                    rotate: -90,
                    culling: true
                }
            },
            y: {
                min: 0
            }
        },
        color: {
            pattern: colors
        }
    });

    var trendWords = c3.generate({
        bindto: "#trendWords",
        size: {
            height: 250
        },
        data: {
            x: "dates",
            columns: dataTrendWords,
            type: "line"
        },
        legend: {
            show: false
        },
        point: {
            show: false
        },
        axis: {
            x: {
                type: "timeseries",
                tick: {
                    format: "%m/%Y",
                    rotate: -90,
                    culling: true
                }
            },
            y: {
                min: 0
            }
        },
        color: {
            pattern: colors
        }
    });

    var trendWpM = c3.generate({
        bindto: "#trendWpM",
        size: {
            height: 250
        },
        data: {
            x: "dates",
            columns: dataTrendWpM,
            type: "line"
        },
        legend: {
            show: false
        },
        point: {
            show: false
        },
        axis: {
            x: {
                type: "timeseries",
                tick: {
                    format: "%m/%Y",
                    rotate: -90,
                    culling: true
                }
            },
            y: {
                min: 0
            }
        },
        color: {
            pattern: colors
        }
    });



    /******************************************
        Language Section
    ******************************************/
    var languageTop10 = c3.generate({
        bindto: "#languageTop10",
        data: {
            columns: dataDictionary[0],
            type: "bar",
            types: {
                Total: "spline"
            },
            colors: {
                Total: "#999999"
            },
            groups: [dataDictionary[2]]
        },
        axis: {
            rotated: true,
            x: {
                type: 'category',
                categories: dataDictionary[1]
            }
        },
        color: {
            pattern: colors
        },
        legend: displayLegend
    });

    $("#languageHearts").append(heartString);



    /******************************************
        Time Section
    ******************************************/
    var timeDay = c3.generate({
        bindto: "#timeDay",
        data: {
            columns: dataDay,
            type: "bar",
            groups: [group]
        },
        bar: {
            width: {
                ratio: 0.8
            }
        },
        color: {
            pattern: colors
        },
        legend: displayLegend
    });


    // Only Chart not done with c3.js, but with chart.js.
    // Pain in the ass.
    //
    // I AM NOT TOUCHING THIS!!
    //
    window.timeWeek = new Chart($("#timeWeek"), {
        type: 'radar',
        data: {
            labels: ["Mon", "Tues", "Wed", "Thurs", "Fri", "Sat", "Sun"],
            datasets: dataWeek
        },
        options: {
            bezierCurve: true,
            responsive: false,
            scale: {
                ticks: {
                    display: false
                }
            },
            legendCallback: function (chart) {
                var legendHtml = [];
                legendHtml.push('<table>');
                legendHtml.push('<tr class="timeWeekLegend">');
                for (var i = 0; i < chart.data.datasets.length; i++) {
                    legendHtml.push('<td><div class="timeWeekLegendColor" style="background-color:' + chart.data.datasets[i].borderColor + '"></div></td>');
                    if (chart.data.datasets[i].label) {
                        legendHtml.push('<td class="timeWeekLegendText" onclick="updateDataset(this, event, ' + '\'' + chart.legend.legendItems[i].datasetIndex + '\'' + ')">' + chart.data.datasets[i].label + '</td>');
                    }
                }
                legendHtml.push('</tr>');
                legendHtml.push('</table>');
                return legendHtml.join("");
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: true
            }
        }
    });

    // Show/hide chart by click legend
    updateDataset = function (id, e, datasetIndex) {
        $(id).prev().toggleClass("legendVisible");
        $(id).toggleClass("legendVisible");
        var index = datasetIndex;
        var ci = e.view.timeWeek;
        var meta = ci.getDatasetMeta(index);

        // See controller.isDatasetVisible comment
        meta.hidden = meta.hidden === null ? !ci.data.datasets[index].hidden : null;

        // We hid a dataset ... rerender the chart
        ci.update();
    };

    // Yep, a seperate legend is needed.
    // Nope, don't try to use the built in one from chart.js if you want a consistent look.
    $('#chartjsLegend').html(timeWeek.generateLegend());
    if (!displayLegend.show) {
        $('#chartjsLegend').attr("style", "display: none");
    }




    var timeTotal = c3.generate({
        bindto: "#timeTotal",
        data: {
            x: "dates",
            columns: dataTimeTotalMessages,
            type: "bar",
            groups: [group]
        },
        bar: {
            width: barWidth
        },
        padding: {
            left: 50,
            right: 50
        },
        axis: {
            x: {
                type: "timeseries",
                tick: {
                    format: "%m/%d/%Y",
                    rotate: -45,
                    culling: true
                }
            },
            y: {
                min: 0,
                padding: {
                    bottom: 0
                }
            }
        },
        color: {
            pattern: colors
        },
        legend: displayLegend
    });
}
