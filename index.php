<html>

<head>
    <link rel="icon" type="image/png" href="favicon.png">
    <title>Telegram Chat Analyzer</title>
    <meta name="keywords" content="telegram, analyzer, charts, analyse, statistics, evaluate, chat, telegramalyzer" />
    <meta name="description" content="Analyze your Telegram Chats (even group chats!) and receive fancy charts & statistics!" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.6.8/c3.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.13/featherlight.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.7.0/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.6.8/c3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.13/featherlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinyColorPicker/1.1.1/colors.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinyColorPicker/1.1.1/jqColorPicker.min.js"></script>
</head>

<body>
    <div id="landingpage">
        <div id="welcome">
            <i class="fa fa-paper-plane fa-4x"></i>
            <h1>Telegram Chat Analyzer</h1>
            <label class="fileContainer">
                <button id="tryit">Try it out!</button>
                <input type="file" id="file" name="file" />
            </label>
            <div id="welcomelinks">
                <a href="#" data-featherlight="#howto">How To Use?</a>
                <a href="#" data-featherlight="#privacy">We value your privacy.</a>
            </div>

            <a target="_blank" href="https://twitter.com/intent/tweet?text=Check%20out%20this%20cool%20tool%3A%20https%3A%2F%2Ftelegram.graphics%2F"><i class="fab fa-twitter fa-2x"></i></a>
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ftelegram.graphics%2F"><i class="fab fa-facebook-f fa-2x"></i></a>

            <div id="howto">
                <figure>
                    <img src="howto/0.JPG">
                    <figcaption><span>Step 0: </span>Make sure your version of Telegram Desktop is up to date. <span>Data exports are ONLY supported by Telegram Desktop at the present time.</span></figcaption>
                </figure>
                <figure>
                    <img src="howto/1.JPG">
                    <figcaption><span>Step 1: </span>Go to settings.</figcaption>
                </figure>
                <figure>
                    <img src="howto/2.JPG">
                    <figcaption><span>Step 2: </span>Click on "Advanced".</figcaption>
                </figure>
                <figure>
                    <img src="howto/3.JPG">
                    <figcaption><span>Step 3: </span>Under "Data and Storage", find "Export Telegram data".</figcaption>
                </figure>
                <figure>
                    <img src="howto/4.JPG">
                    <figcaption><span>Step 4: </span>Uncheck "Acount information" and "Contacts list". These are not neccessary.</figcaption>
                </figure>
                <figure>
                    <img src="howto/5.JPG">
                    <figcaption><span>Step 5: </span>Select the types of chats you want to export. If you select "Private Groups", make sure to uncheck "Only my messages".<br><span>Notice: Group chats can be analyzed by this tool, however groups produce so much data that the libraries used for displaying charts chickly get to their limit.</span><br>We recommend selecting a very narrow timeframe in the Analyzer-settings.</figcaption>
                </figure>
                <figure>
                    <img src="howto/6.JPG">
                    <figcaption><span>Step 6: </span>Deselect all types of media under "Media export settings".</figcaption>
                </figure>
                <figure>
                    <img src="howto/8.JPG">
                    <figcaption><span>Step 7: Make sure to select "Machine-readable JSON" as format. </span>This tool will not work with Human-readable HTML. Select your preferred Download path.</figcaption>
                </figure>
                <figure>
                    <img src="howto/9.JPG">
                    <figcaption><span>Step 8: </span>Telegram will now export your data. This may take a while.</figcaption>
                </figure>
                <figure>
                    <img src="howto/10.JPG">
                    <figcaption><span>Step 9: </span>You should end up with a folder "chats" and a "result.json" file. We only need the JSON-file.</figcaption>
                </figure>
                <figure>
                    <img src="howto/11.JPG">
                    <figcaption><span>Step 10: </span>Now come back to this website and click on "Try it out!"</figcaption>
                </figure>
                <figure>
                    <img src="howto/12.JPG">
                    <figcaption><span>Step 11: </span>Select the "result.json" file and enjoy!</figcaption>
                </figure>
            </div>

            <div id="privacy">
                <h2>We value your privacy.</h2>
                <p>We do not store your data.
                    <br><br>
                    We don't even send your data to our server: the entire program that analyzes and evaluates the JSON-file containing your messages runs client side, in your browser.
                    <br><br>
                    At no point is the actual content of a message analyzed; all the program cares for is "How many words does the message contain?", "How many characters does it contain?", "When was it sent?", and "How often does each word appear in your entire chat?".
                    <br><br>
                    Again, this information is not stored, just used to display some fancy charts and statistics.
                    <br>
                    If you close your browser, or even just reload the page, everything's gone.
                    <br><br>
                    <strong>Your data stays with you.</strong>
                    <br><br>
                    <strong>We value your privacy.</strong>
                </p>
            </div>
        </div>
        <div id="footer">
            <i class="fa fa-chart-bar fa-2x"></i>

            <p>This project would not have been possible without:
                <a href="https://c3js.org" target="_blank">c3.js</a> |
                <a href="https://chartjs.org" target="_blank">chart.js</a> |
                <a href="https://noelboss.github.io/featherlight/" target="_blank">featherlight.js</a> |
                <a href="https://github.com/PitPik/tinyColorPicker" target="_blank">tinyColorPicker</a>
            </p>

            <p>© 2018 by telegram.graphics</p>
            <p>The Telegram logo and trademark belong to their respective owners. We are not affiliated with <a href="https://telegram.org" target="_blank">Telegram</a>.</p>
            <a href="#" data-featherlight="#legal">Legal Notice</a>
            <div id="legal">
                <h1>Legal Disclosure</h1>
                Information in accordance with Section 5 TMG
                <h2>Contact Information</h2>
                E-Mail: <a href="mailto:chat@telegram.graphics">chat@telegram.graphics</a><br>Internet address: <a href="https://telegram.graphics">telegram.graphics</a><br><br>
                <h2>Disclaimer</h2>
                Accountability for content<br>
                The contents of our pages have been created with the utmost care. However, we cannot guarantee the contents'
                accuracy, completeness or topicality. According to statutory provisions, we are furthermore responsible for
                our own content on these web pages. In this matter, please note that we are not obliged to monitor
                the transmitted or saved information of third parties, or investigate circumstances pointing to illegal activity.
                Our obligations to remove or block the use of information under generally applicable laws remain unaffected by this as per
                §§ 8 to 10 of the Telemedia Act (TMG).

                <br><br>Accountability for links<br>
                Responsibility for the content of
                external links (to web pages of third parties) lies solely with the operators of the linked pages. No violations were
                evident to us at the time of linking. Should any legal infringement become known to us, we will remove the respective
                link immediately.<br><br>Copyright<br> Our web pages and their contents are subject to German copyright law. Unless
                expressly permitted by law, every form of utilizing, reproducing or processing
                works subject to copyright protection on our web pages requires the prior consent of the respective owner of the rights.
                Individual reproductions of a work are only allowed for private use.
                The materials from these pages are copyrighted and any unauthorized use may violate copyright laws.

                <br><br>
                <i>Source: </i><a href="http://www.translate-24h.de" target="_blank">translate-24h.de</a> <br><br>

                <h1>Privacy Policy</h1>

                <p>We are very delighted that you have shown interest in our enterprise. Data protection is of a particularly high priority for the management of the Telegram Chat Analyzer. The use of the Internet pages of the Telegram Chat Analyzer is possible without any indication of personal data; however, if a data subject wants to use special enterprise services via our website, processing of personal data could become necessary. If the processing of personal data is necessary and there is no statutory basis for such processing, we generally obtain consent from the data subject.</p>

                <p>The processing of personal data, such as the name, address, e-mail address, or telephone number of a data subject shall always be in line with the General Data Protection Regulation (GDPR), and in accordance with the country-specific data protection regulations applicable to the Telegram Chat Analyzer. By means of this data protection declaration, our enterprise would like to inform the general public of the nature, scope, and purpose of the personal data we collect, use and process. Furthermore, data subjects are informed, by means of this data protection declaration, of the rights to which they are entitled.</p>

                <p>As the controller, the Telegram Chat Analyzer has implemented numerous technical and organizational measures to ensure the most complete protection of personal data processed through this website. However, Internet-based data transmissions may in principle have security gaps, so absolute protection may not be guaranteed. For this reason, every data subject is free to transfer personal data to us via alternative means, e.g. by telephone. </p>

                <h4>1. Definitions</h4>
                <p>The data protection declaration of the Telegram Chat Analyzer is based on the terms used by the European legislator for the adoption of the General Data Protection Regulation (GDPR). Our data protection declaration should be legible and understandable for the general public, as well as our customers and business partners. To ensure this, we would like to first explain the terminology used.</p>

                <p>In this data protection declaration, we use, inter alia, the following terms:</p>

                <ul style="list-style: none">
                    <li>
                        <h4>a) Personal data</h4>
                        <p>Personal data means any information relating to an identified or identifiable natural person (“data subject”). An identifiable natural person is one who can be identified, directly or indirectly, in particular by reference to an identifier such as a name, an identification number, location data, an online identifier or to one or more factors specific to the physical, physiological, genetic, mental, economic, cultural or social identity of that natural person.</p>
                    </li>
                    <li>
                        <h4>b) Data subject</h4>
                        <p>Data subject is any identified or identifiable natural person, whose personal data is processed by the controller responsible for the processing.</p>
                    </li>
                    <li>
                        <h4>c) Processing</h4>
                        <p>Processing is any operation or set of operations which is performed on personal data or on sets of personal data, whether or not by automated means, such as collection, recording, organisation, structuring, storage, adaptation or alteration, retrieval, consultation, use, disclosure by transmission, dissemination or otherwise making available, alignment or combination, restriction, erasure or destruction. </p>
                    </li>
                    <li>
                        <h4>d) Restriction of processing</h4>
                        <p>Restriction of processing is the marking of stored personal data with the aim of limiting their processing in the future. </p>
                    </li>
                    <li>
                        <h4>e) Profiling</h4>
                        <p>Profiling means any form of automated processing of personal data consisting of the use of personal data to evaluate certain personal aspects relating to a natural person, in particular to analyse or predict aspects concerning that natural person's performance at work, economic situation, health, personal preferences, interests, reliability, behaviour, location or movements. </p>
                    </li>
                    <li>
                        <h4>f) Pseudonymisation</h4>
                        <p>Pseudonymisation is the processing of personal data in such a manner that the personal data can no longer be attributed to a specific data subject without the use of additional information, provided that such additional information is kept separately and is subject to technical and organisational measures to ensure that the personal data are not attributed to an identified or identifiable natural person. </p>
                    </li>
                    <li>
                        <h4>g) Controller or controller responsible for the processing</h4>
                        <p>Controller or controller responsible for the processing is the natural or legal person, public authority, agency or other body which, alone or jointly with others, determines the purposes and means of the processing of personal data; where the purposes and means of such processing are determined by Union or Member State law, the controller or the specific criteria for its nomination may be provided for by Union or Member State law. </p>
                    </li>
                    <li>
                        <h4>h) Processor</h4>
                        <p>Processor is a natural or legal person, public authority, agency or other body which processes personal data on behalf of the controller. </p>
                    </li>
                    <li>
                        <h4>i) Recipient</h4>
                        <p>Recipient is a natural or legal person, public authority, agency or another body, to which the personal data are disclosed, whether a third party or not. However, public authorities which may receive personal data in the framework of a particular inquiry in accordance with Union or Member State law shall not be regarded as recipients; the processing of those data by those public authorities shall be in compliance with the applicable data protection rules according to the purposes of the processing. </p>
                    </li>
                    <li>
                        <h4>j) Third party</h4>
                        <p>Third party is a natural or legal person, public authority, agency or body other than the data subject, controller, processor and persons who, under the direct authority of the controller or processor, are authorised to process personal data.</p>
                    </li>
                    <li>
                        <h4>k) Consent</h4>
                        <p>Consent of the data subject is any freely given, specific, informed and unambiguous indication of the data subject's wishes by which he or she, by a statement or by a clear affirmative action, signifies agreement to the processing of personal data relating to him or her. </p>
                    </li>
                </ul>

                <h4>2. Name and Address of the controller</h4>
                <p>Contact to the controller for the purposes of the General Data Protection Regulation (GDPR), other data protection laws applicable in Member states of the European Union and other provisions related to data protection is possible via the means of:

                </p>

                <p>Email: chat@telegram.graphics</p>

                <h4>3. Collection of general data and information</h4>
                <p>The website of the Telegram Chat Analyzer collects a series of general data and information when a data subject or automated system calls up the website. This general data and information are stored in the server log files. Collected may be (1) the browser types and versions used, (2) the operating system used by the accessing system, (3) the website from which an accessing system reaches our website (so-called referrers), (4) the sub-websites, (5) the date and time of access to the Internet site, (6) an Internet protocol address (IP address), (7) the Internet service provider of the accessing system, and (8) any other similar data and information that may be used in the event of attacks on our information technology systems.</p>

                <p>When using these general data and information, the Telegram Chat Analyzer does not draw any conclusions about the data subject. Rather, this information is needed to (1) deliver the content of our website correctly, (2) optimize the content of our website as well as its advertisement, (3) ensure the long-term viability of our information technology systems and website technology, and (4) provide law enforcement authorities with the information necessary for criminal prosecution in case of a cyber-attack. Therefore, the Telegram Chat Analyzer analyzes anonymously collected data and information statistically, with the aim of increasing the data protection and data security of our enterprise, and to ensure an optimal level of protection for the personal data we process. The anonymous data of the server log files are stored separately from all personal data provided by a data subject.</p>

                <h4>4. Routine erasure and blocking of personal data</h4>
                <p>The data controller shall process and store the personal data of the data subject only for the period necessary to achieve the purpose of storage, or as far as this is granted by the European legislator or other legislators in laws or regulations to which the controller is subject to.</p>

                <p>If the storage purpose is not applicable, or if a storage period prescribed by the European legislator or another competent legislator expires, the personal data are routinely blocked or erased in accordance with legal requirements.</p>

                <h4>5. Rights of the data subject</h4>
                <ul style="list-style: none;">
                    <li>
                        <h4>a) Right of confirmation</h4>
                        <p>Each data subject shall have the right granted by the European legislator to obtain from the controller the confirmation as to whether or not personal data concerning him or her are being processed. If a data subject wishes to avail himself of this right of confirmation, he or she may, at any time, contact any employee of the controller.</p>
                    </li>
                    <li>
                        <h4>b) Right of access</h4>
                        <p>Each data subject shall have the right granted by the European legislator to obtain from the controller free information about his or her personal data stored at any time and a copy of this information. Furthermore, the European directives and regulations grant the data subject access to the following information:</p>

                        <ul style="list-style: none;">
                            <li>the purposes of the processing;</li>
                            <li>the categories of personal data concerned;</li>
                            <li>the recipients or categories of recipients to whom the personal data have been or will be disclosed, in particular recipients in third countries or international organisations;</li>
                            <li>where possible, the envisaged period for which the personal data will be stored, or, if not possible, the criteria used to determine that period;</li>
                            <li>the existence of the right to request from the controller rectification or erasure of personal data, or restriction of processing of personal data concerning the data subject, or to object to such processing;</li>
                            <li>the existence of the right to lodge a complaint with a supervisory authority;</li>
                            <li>where the personal data are not collected from the data subject, any available information as to their source;</li>
                            <li>the existence of automated decision-making, including profiling, referred to in Article 22(1) and (4) of the GDPR and, at least in those cases, meaningful information about the logic involved, as well as the significance and envisaged consequences of such processing for the data subject.</li>

                        </ul>
                        <p>Furthermore, the data subject shall have a right to obtain information as to whether personal data are transferred to a third country or to an international organisation. Where this is the case, the data subject shall have the right to be informed of the appropriate safeguards relating to the transfer.</p>

                        <p>If a data subject wishes to avail himself of this right of access, he or she may, at any time, contact any employee of the controller.</p>
                    </li>
                    <li>
                        <h4>c) Right to rectification </h4>
                        <p>Each data subject shall have the right granted by the European legislator to obtain from the controller without undue delay the rectification of inaccurate personal data concerning him or her. Taking into account the purposes of the processing, the data subject shall have the right to have incomplete personal data completed, including by means of providing a supplementary statement.</p>

                        <p>If a data subject wishes to exercise this right to rectification, he or she may, at any time, contact any employee of the controller.</p>
                    </li>
                    <li>
                        <h4>d) Right to erasure (Right to be forgotten) </h4>
                        <p>Each data subject shall have the right granted by the European legislator to obtain from the controller the erasure of personal data concerning him or her without undue delay, and the controller shall have the obligation to erase personal data without undue delay where one of the following grounds applies, as long as the processing is not necessary: </p>

                        <ul style="list-style: none;">
                            <li>The personal data are no longer necessary in relation to the purposes for which they were collected or otherwise processed.</li>
                            <li>The data subject withdraws consent to which the processing is based according to point (a) of Article 6(1) of the GDPR, or point (a) of Article 9(2) of the GDPR, and where there is no other legal ground for the processing.</li>
                            <li>The data subject objects to the processing pursuant to Article 21(1) of the GDPR and there are no overriding legitimate grounds for the processing, or the data subject objects to the processing pursuant to Article 21(2) of the GDPR. </li>
                            <li>The personal data have been unlawfully processed.</li>
                            <li>The personal data must be erased for compliance with a legal obligation in Union or Member State law to which the controller is subject.</li>
                            <li>The personal data have been collected in relation to the offer of information society services referred to in Article 8(1) of the GDPR.</li>

                        </ul>
                        <p>If one of the aforementioned reasons applies, and a data subject wishes to request the erasure of personal data stored by the Telegram Chat Analyzer, he or she may, at any time, contact any employee of the controller. An employee of Telegram Chat Analyzer shall promptly ensure that the erasure request is complied with immediately.</p>

                        <p>Where the controller has made personal data public and is obliged pursuant to Article 17(1) to erase the personal data, the controller, taking account of available technology and the cost of implementation, shall take reasonable steps, including technical measures, to inform other controllers processing the personal data that the data subject has requested erasure by such controllers of any links to, or copy or replication of, those personal data, as far as processing is not required. An employees of the Telegram Chat Analyzer will arrange the necessary measures in individual cases.</p>
                    </li>
                    <li>
                        <h4>e) Right of restriction of processing</h4>
                        <p>Each data subject shall have the right granted by the European legislator to obtain from the controller restriction of processing where one of the following applies:</p>

                        <ul style="list-style: none;">
                            <li>The accuracy of the personal data is contested by the data subject, for a period enabling the controller to verify the accuracy of the personal data. </li>
                            <li>The processing is unlawful and the data subject opposes the erasure of the personal data and requests instead the restriction of their use instead.</li>
                            <li>The controller no longer needs the personal data for the purposes of the processing, but they are required by the data subject for the establishment, exercise or defence of legal claims.</li>
                            <li>The data subject has objected to processing pursuant to Article 21(1) of the GDPR pending the verification whether the legitimate grounds of the controller override those of the data subject.</li>

                        </ul>
                        <p>If one of the aforementioned conditions is met, and a data subject wishes to request the restriction of the processing of personal data stored by the Telegram Chat Analyzer, he or she may at any time contact any employee of the controller. The employee of the Telegram Chat Analyzer will arrange the restriction of the processing. </p>
                    </li>
                    <li>
                        <h4>f) Right to data portability</h4>
                        <p>Each data subject shall have the right granted by the European legislator, to receive the personal data concerning him or her, which was provided to a controller, in a structured, commonly used and machine-readable format. He or she shall have the right to transmit those data to another controller without hindrance from the controller to which the personal data have been provided, as long as the processing is based on consent pursuant to point (a) of Article 6(1) of the GDPR or point (a) of Article 9(2) of the GDPR, or on a contract pursuant to point (b) of Article 6(1) of the GDPR, and the processing is carried out by automated means, as long as the processing is not necessary for the performance of a task carried out in the public interest or in the exercise of official authority vested in the controller.</p>

                        <p>Furthermore, in exercising his or her right to data portability pursuant to Article 20(1) of the GDPR, the data subject shall have the right to have personal data transmitted directly from one controller to another, where technically feasible and when doing so does not adversely affect the rights and freedoms of others.</p>

                        <p>In order to assert the right to data portability, the data subject may at any time contact any employee of the Telegram Chat Analyzer.</p>

                    </li>
                    <li>
                        <h4>g) Right to object</h4>
                        <p>Each data subject shall have the right granted by the European legislator to object, on grounds relating to his or her particular situation, at any time, to processing of personal data concerning him or her, which is based on point (e) or (f) of Article 6(1) of the GDPR. This also applies to profiling based on these provisions.</p>

                        <p>The Telegram Chat Analyzer shall no longer process the personal data in the event of the objection, unless we can demonstrate compelling legitimate grounds for the processing which override the interests, rights and freedoms of the data subject, or for the establishment, exercise or defence of legal claims.</p>

                        <p>If the Telegram Chat Analyzer processes personal data for direct marketing purposes, the data subject shall have the right to object at any time to processing of personal data concerning him or her for such marketing. This applies to profiling to the extent that it is related to such direct marketing. If the data subject objects to the Telegram Chat Analyzer to the processing for direct marketing purposes, the Telegram Chat Analyzer will no longer process the personal data for these purposes.</p>

                        <p>In addition, the data subject has the right, on grounds relating to his or her particular situation, to object to processing of personal data concerning him or her by the Telegram Chat Analyzer for scientific or historical research purposes, or for statistical purposes pursuant to Article 89(1) of the GDPR, unless the processing is necessary for the performance of a task carried out for reasons of public interest.</p>

                        <p>In order to exercise the right to object, the data subject may contact any employee of the Telegram Chat Analyzer. In addition, the data subject is free in the context of the use of information society services, and notwithstanding Directive 2002/58/EC, to use his or her right to object by automated means using technical specifications.</p>
                    </li>
                    <li>
                        <h4>h) Automated individual decision-making, including profiling</h4>
                        <p>Each data subject shall have the right granted by the European legislator not to be subject to a decision based solely on automated processing, including profiling, which produces legal effects concerning him or her, or similarly significantly affects him or her, as long as the decision (1) is not is necessary for entering into, or the performance of, a contract between the data subject and a data controller, or (2) is not authorised by Union or Member State law to which the controller is subject and which also lays down suitable measures to safeguard the data subject's rights and freedoms and legitimate interests, or (3) is not based on the data subject's explicit consent.</p>

                        <p>If the decision (1) is necessary for entering into, or the performance of, a contract between the data subject and a data controller, or (2) it is based on the data subject's explicit consent, the Telegram Chat Analyzer shall implement suitable measures to safeguard the data subject's rights and freedoms and legitimate interests, at least the right to obtain human intervention on the part of the controller, to express his or her point of view and contest the decision.</p>

                        <p>If the data subject wishes to exercise the rights concerning automated individual decision-making, he or she may, at any time, contact any employee of the Telegram Chat Analyzer.</p>

                    </li>
                    <li>
                        <h4>i) Right to withdraw data protection consent </h4>
                        <p>Each data subject shall have the right granted by the European legislator to withdraw his or her consent to processing of his or her personal data at any time. </p>

                        <p>If the data subject wishes to exercise the right to withdraw the consent, he or she may, at any time, contact any employee of the Telegram Chat Analyzer.</p>

                    </li>
                </ul>
                <h4>6. Data protection provisions about the application and use of Facebook</h4>
                <p>On this website, the controller has integrated components of the enterprise Facebook. Facebook is a social network.</p>

                <p>A social network is a place for social meetings on the Internet, an online community, which usually allows users to communicate with each other and interact in a virtual space. A social network may serve as a platform for the exchange of opinions and experiences, or enable the Internet community to provide personal or business-related information. Facebook allows social network users to include the creation of private profiles, upload photos, and network through friend requests.</p>

                <p>The operating company of Facebook is Facebook, Inc., 1 Hacker Way, Menlo Park, CA 94025, United States. If a person lives outside of the United States or Canada, the controller is the Facebook Ireland Ltd., 4 Grand Canal Square, Grand Canal Harbour, Dublin 2, Ireland.</p>

                <p>With each call-up to one of the individual pages of this Internet website, which is operated by the controller and into which a Facebook component (Facebook plug-ins) was integrated, the web browser on the information technology system of the data subject is automatically prompted to download display of the corresponding Facebook component from Facebook through the Facebook component. An overview of all the Facebook Plug-ins may be accessed under https://developers.facebook.com/docs/plugins/. During the course of this technical procedure, Facebook is made aware of what specific sub-site of our website was visited by the data subject.</p>

                <p>If the data subject is logged in at the same time on Facebook, Facebook detects with every call-up to our website by the data subject—and for the entire duration of their stay on our Internet site—which specific sub-site of our Internet page was visited by the data subject. This information is collected through the Facebook component and associated with the respective Facebook account of the data subject. If the data subject clicks on one of the Facebook buttons integrated into our website, e.g. the "Like" button, or if the data subject submits a comment, then Facebook matches this information with the personal Facebook user account of the data subject and stores the personal data.</p>

                <p>Facebook always receives, through the Facebook component, information about a visit to our website by the data subject, whenever the data subject is logged in at the same time on Facebook during the time of the call-up to our website. This occurs regardless of whether the data subject clicks on the Facebook component or not. If such a transmission of information to Facebook is not desirable for the data subject, then he or she may prevent this by logging off from their Facebook account before a call-up to our website is made.</p>

                <p>The data protection guideline published by Facebook, which is available at https://facebook.com/about/privacy/, provides information about the collection, processing and use of personal data by Facebook. In addition, it is explained there what setting options Facebook offers to protect the privacy of the data subject. In addition, different configuration options are made available to allow the elimination of data transmission to Facebook. These applications may be used by the data subject to eliminate a data transmission to Facebook.</p>

                <h4>7. Data protection provisions about the application and use of Twitter</h4>
                <p>On this website, the controller has integrated components of Twitter. Twitter is a multilingual, publicly-accessible microblogging service on which users may publish and spread so-called ‘tweets,’ e.g. short messages, which are limited to 280 characters. These short messages are available for everyone, including those who are not logged on to Twitter. The tweets are also displayed to so-called followers of the respective user. Followers are other Twitter users who follow a user's tweets. Furthermore, Twitter allows you to address a wide audience via hashtags, links or retweets.</p>

                <p>The operating company of Twitter is Twitter, Inc., 1355 Market Street, Suite 900, San Francisco, CA 94103, UNITED STATES.</p>

                <p>With each call-up to one of the individual pages of this Internet site, which is operated by the controller and on which a Twitter component (Twitter button) was integrated, the Internet browser on the information technology system of the data subject is automatically prompted to download a display of the corresponding Twitter component of Twitter. Further information about the Twitter buttons is available under https://about.twitter.com/de/resources/buttons. During the course of this technical procedure, Twitter gains knowledge of what specific sub-page of our website was visited by the data subject. The purpose of the integration of the Twitter component is a retransmission of the contents of this website to allow our users to introduce this web page to the digital world and increase our visitor numbers.</p>

                <p>If the data subject is logged in at the same time on Twitter, Twitter detects with every call-up to our website by the data subject and for the entire duration of their stay on our Internet site which specific sub-page of our Internet page was visited by the data subject. This information is collected through the Twitter component and associated with the respective Twitter account of the data subject. If the data subject clicks on one of the Twitter buttons integrated on our website, then Twitter assigns this information to the personal Twitter user account of the data subject and stores the personal data.</p>

                <p>Twitter receives information via the Twitter component that the data subject has visited our website, provided that the data subject is logged in on Twitter at the time of the call-up to our website. This occurs regardless of whether the person clicks on the Twitter component or not. If such a transmission of information to Twitter is not desirable for the data subject, then he or she may prevent this by logging off from their Twitter account before a call-up to our website is made.</p>

                <p>The applicable data protection provisions of Twitter may be accessed under https://twitter.com/privacy?lang=en.</p>

                <h4>8. Legal basis for the processing </h4>
                <p>Art. 6(1) lit. a GDPR serves as the legal basis for processing operations for which we obtain consent for a specific processing purpose. If the processing of personal data is necessary for the performance of a contract to which the data subject is party, as is the case, for example, when processing operations are necessary for the supply of goods or to provide any other service, the processing is based on Article 6(1) lit. b GDPR. The same applies to such processing operations which are necessary for carrying out pre-contractual measures, for example in the case of inquiries concerning our products or services. Is our company subject to a legal obligation by which processing of personal data is required, such as for the fulfillment of tax obligations, the processing is based on Art. 6(1) lit. c GDPR.
                    In rare cases, the processing of personal data may be necessary to protect the vital interests of the data subject or of another natural person. This would be the case, for example, if a visitor were injured in our company and his name, age, health insurance data or other vital information would have to be passed on to a doctor, hospital or other third party. Then the processing would be based on Art. 6(1) lit. d GDPR.
                    Finally, processing operations could be based on Article 6(1) lit. f GDPR. This legal basis is used for processing operations which are not covered by any of the abovementioned legal grounds, if processing is necessary for the purposes of the legitimate interests pursued by our company or by a third party, except where such interests are overridden by the interests or fundamental rights and freedoms of the data subject which require protection of personal data. Such processing operations are particularly permissible because they have been specifically mentioned by the European legislator. He considered that a legitimate interest could be assumed if the data subject is a client of the controller (Recital 47 Sentence 2 GDPR).
                </p>

                <h4>9. The legitimate interests pursued by the controller or by a third party</h4>
                <p>Where the processing of personal data is based on Article 6(1) lit. f GDPR our legitimate interest is to carry out our business in favor of the well-being of all our employees and the shareholders.</p>

                <h4>10. Period for which the personal data will be stored</h4>
                <p>The criteria used to determine the period of storage of personal data is the respective statutory retention period. After expiration of that period, the corresponding data is routinely deleted, as long as it is no longer necessary for the fulfillment of the contract or the initiation of a contract.</p>

                <h4>11. Provision of personal data as statutory or contractual requirement; Requirement necessary to enter into a contract; Obligation of the data subject to provide the personal data; possible consequences of failure to provide such data </h4>
                <p>We clarify that the provision of personal data is partly required by law (e.g. tax regulations) or can also result from contractual provisions (e.g. information on the contractual partner).

                    Sometimes it may be necessary to conclude a contract that the data subject provides us with personal data, which must subsequently be processed by us. The data subject is, for example, obliged to provide us with personal data when our company signs a contract with him or her. The non-provision of the personal data would have the consequence that the contract with the data subject could not be concluded.

                    Before personal data is provided by the data subject, the data subject must contact any employee. The employee clarifies to the data subject whether the provision of the personal data is required by law or contract or is necessary for the conclusion of the contract, whether there is an obligation to provide the personal data and the consequences of non-provision of the personal data.
                </p>

                <h4>12. Existence of automated decision-making</h4>
                <p>As a responsible company, we do not use automatic decision-making or profiling.</p>

                <p>This Privacy Policy has been generated by the Privacy Policy Generator of the <a href="https://dg-datenschutz.de/services/external-data-protection-officer/?lang=en">DGD - Your External DPO</a> that was developed in cooperation with <a href="https://www.wbs-law.de/eng/">German Lawyers</a> from WILDE BEUGER SOLMECKE, Cologne.
                </p>



            </div>
        </div>
    </div>

    <div id="chatselect">
        <div id="chatwrapper">
            <h2 id="chatTitle">Select a chat:</h2>
            <div id="chatlist"></div>
        </div>
    </div>



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
            <div class="pName">Most common words<span> (4 or more characters)</span></div>
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
        <!--<button id="saveButton">Save result for 14 days</button>
        <p id="saveText">None of your data will be stored, only the results you see displayed on this site.</p>-->
    </div>
    <script src="telegram.js"></script>
    <script src="fileselect.js"></script>
</body>

</html>