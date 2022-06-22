$(document).ready(function () {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var data;
        var id;
        var colors = [];

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        function generateChatlist(name, id) {
            var color = getRandomColor();
            var html = `<div class="chat">
                    <i class="fa fa-user fa-3x" style="color: ${color}"></i>
                    <h2>${name}</h2>
                    <button class="chatlistButton" data-id="${id}">Select</button>
                </div>`;
            $("#chatlist").append(html);
        }

        function generateColorList() {
            for (i in person) {
                var color = getRandomColor();
                colors.push(color);
            }
        }

        function generateColorHtml() {
            $("#chatlist").append(`<div class="datewrapper">
                    <label>Start: <input type="text" id="pickerStart"/></label>
                    <label>End: <input type="text" id="pickerEnd"/></label>
                </div>`);

            for (i in person) {
                var html = `<div class="person">
                        <h2>${person[i].name}:</h2>
                        <button class="colorButton" style="background-color: ${colors[i]}" value="${colors[i]}">&nbsp;</button>
                    </div>`;
                $("#chatlist").append(html);
            }
        }

        function updateColors() {
            $(".colorButton").each(function (i, obj) {
                var newColor = $(this).attr("value");
                colors[i] = newColor;
            })
        }

        function cleanUpForColor() {
            $(".chatlistButton").each(function (i, obj) {
                if ($(this).attr("data-id") != id) {
                    $(this).parent().fadeOut(300);
                } else {
                    $(this).html("Continue");
                    $(this).attr("id", "chatlistButtonSelected");
                    $(this).removeClass("chatlistButton");
                    $(this).parent().children(":first-child").attr("style", "color: black");
                }
            });
            $("#chatTitle").html("Select colors and timeframe:");

            generateColorList();
            generateColorHtml();

            $("#pickerStart").datepicker();
            $("#pickerEnd").datepicker();
            $("#pickerEnd").datepicker("setDate", "today");
            var today = $("#pickerEnd").datepicker("getDate");
            $("#pickerStart").datepicker("setDate", new Date(today.getFullYear() - 1, today.getMonth(), today.getDate()));

            $('.colorButton').colorPicker({
                forceAlpha: false
            }).each(function (idx, elm) {
                if (!elm.value) {
                    $(elm).data('colorMode', 'HEX');
                }
            });

            $("#chatlistButtonSelected").on("click", function () {
                $(this).off("click");
                updateColors();
                dateStart = new Date($("#pickerStart").datepicker("getDate"));
                dateEnd = new Date($("#pickerEnd").datepicker("getDate"));

                $("#chatTitle").html("Analyzing data...");

                $("#chatlist").children().css({
                    "display": "none"
                });

                $("#chatlist").css({
                    "display": "grid",
                    "align-items": "center",
                    "justify-items": "center",
                    "text-align": "center",
                    "overflow": "hidden"
                });

                $("#chatlist").append(`<div style="margin:64px; text-align: center"><div class="loader"></div><p>Depending on the number of messages, the number of participants and the timeframe selectetd, this might take a while.</p></div>`);

                setTimeout(function () {
                    analyze(data, id);
                    evaluate(colors);
                    $("#container").css({
                        "display": "block"
                    });
                    $("#chatselect").css({
                        opacity: 0,
                        transition: 'opacity 0.5s'
                    }).delay(100).slideUp(800);
                    display();
                }, 500);


            });

        }

        function handleFileSelect(evt) {
            var file = evt.target.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                /*try {
                    
                } catch (ex) {
                    alert("Something went wrong.");
                }*/
                var prep = e.target.result;
                var prep = e.target.result;
                //data = JSON.parse(JSON.stringify(prep));
                data = jQuery.parseJSON(prep);

                if (!("chats" in data) | data.chats == "undefined") {
                    data = {
                        "chats": {
                            "list": [data]
                        }
                    }
                }
                $("#chatselect").css({
                    "display": "grid"
                });
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#chatselect").offset().top
                }, 1200);
                $("#tryit").fadeOut();

                i = 0;
                while (i < data.chats.list.length) {
                    if (typeof data.chats.list[i].name != "undefined" && data.chats.list[i].name != null) {
                        generateChatlist(data.chats.list[i].name, i);
                    }
                    i++;
                }
                $(".chatlistButton").on("click", function () {
                    $(this).off("click");
                    id = $(this).attr("data-id");
                    findSenders(data, id);
                    cleanUpForColor();
                });

                /*$("#saveButton").on("click", function () {
                        var dataExport = [person, group, displayLegend, barWidth, colors, dataTimeTotal, dataTimeTotalMessages, mostFrequentDay, timeframeHtml, personHtml, totalsHtml, dataBasic, dataTrends, dataTrendMessages, dataTrendWords, dataTrendWpM, dataDictionary, heartString, dataDay, dataWeek];
                        dataExport = JSON.stringify(dataExport);

                        $.ajax({
                            type: "POST",
                            url: "saveResult.php",
                            data: dataExport
                        });

                })*/
            }

            reader.readAsText(file);
        }
        document.getElementById('file').addEventListener('change', handleFileSelect, false);

    } else {
        alert('The File APIs are not fully supported in this browser.');
    }
});
