<?php
$maintenanceMode = false; // Is the site under maintenance, if so set this to true and all pages will show a maintenance screen
$backupKey = "password"; // You can backup the database without logging in if you have access to the key below.  Change it to a secure string

//configure database info

$adminemail = "spam@THIS.com";
$laddermailsender = "test@dot.com"; // this will be the senders email when the ladder sends a mail to someone... 
 $databaseserver = "localhost"; //usually localhost
 $databasename = "yourinfo"; //the name of your database
 $databaseuser = "yourinfo"; //the name of the database-user
 $databasepass = "yourinfo"; // the password to your database
 $directory ="yourinfo" ; //the location of your ladder directory (no trailing slash)
 $path_file_replay = "replays/";	// directory where the replay files are uploaded on the server. Notice that there should be a trailing slash at the end.
$historydatabasename = "yourinfo"; // the name of your database that will be used for keeping snapshots of how the ladder looked on a day by day basis. Notice: Most webhosts only offer you _one_ database. This would all _work_ with just one database and you could specify the name of the same db as you did in databasename, but it's really smoother to the eye to don't mix ladder history tables with current ladder tables and use 2 separate databases. If you turn off the snapshot function (KEEP_LADDER_HISTORY = 0) you can enter whatever db name here as it won't be used at all.
define("CRONCHECK_PATH","cronchecks/"); // dir for where the cron check files are stored. It should be writable.

//configure the tables in the database ...don't change these names unless you know what the tables in your db matches the names and types.

$playerstable = "webl_players"; //the name of the table that contains information about the players
 $gamestable = "webl_games"; //the name of the table that stores the played games
 $newstable = "webl_news"; // the name of the table that stores the news
  $admintable = "webl_admin"; //name of the table that stores the admin login information
  $waitingtable = "webl_waiting"; //name of the table that stores the players waiting for a game...
 $standingscachetable = "webl_standings_cache"; // important cache, improves and makes up for mysql-sickness.
 $cronlogtable = "webl_cron_log"; // name of table that stores the info about when a fake cron job was (supposedly) ran.
  $statstable = "webl_stats"; //table that has stats logged about how many players there have been each date etc.
  $mailhost = "my.smtp.server";

//config security
$salt = "yourinfo"; // WARNING: If you have a running ladder with registered users DONT ever change the salt! Nobody will be able to login then, ever, if you lose the salt. Change this once before people start signing up with new accounts.

//config stuff that has to do with the registration process...
define("REG_MIN_NICKLENGTH", 3); //Minimum number of characters allowed in a registrants nickname
define("REG_MAX_NICKLENGTH", 20); //Maximum number of characters allowed in a registrants nickname
define("REG_MAILVERIFICATION", 0); //Set to 0 or 1, where 0 is off and 1 on. If enabled (1) the player will get a e-mail when registering, with a link he must click in order to activate his account. Unverified accounts can't report games or logg in at all. If set to 0 no mail will be sent and the player can start using his acocunt directly since he will be "auto-verified" instead. Currently, and maybe depending on your host and who you send to, 10 - 30% of the mails sent are killed by the spam-filters, so it might be an idea to have this disabled if many complain, else they won't be able to use their accoutn unless you manually activate them through fiddling with their Confirmation-entry in the the players database.

define("KEEP_LADDER_HISTORY",1); // If 1 it's enabled and will archieve the ladder standings of each day into a date stamped table into the db you configured in $historydatabasename. Set to 0 for disabled, it's not something that's needed for the ladder to operate, but gives great insight to how the ladder has looked liked in the past.

define("NONPUBLIC_REPLAY_COMMENTS", 0); //set to 1 to enable, 0 to disable. If enabled only logged in members can view other members game comment

$reportdays = 7; // The number of days after a report that you can contest/withdraw the game


// Magic commentator -------------------------------

define("INDEX_MAGIC_COMMENTATOR", "QWERTYL"); // Set to " " (single space) to disable magic comments. Please don't include the space if you want to use it.  If disabled then the following associated settings below in this section don't matter. Else set to any combination of following flags to enable the option associated to the speciic flag(s) you choose. Order of flags doesn't matter. Flags available (specifcy them without the quotations mark): "Q" shows when p. takes the 1:st ranking. "W" shows when p. takes 2:nd rank. "E" ~ 3:d place. "R" player entered Top 5 (but is not rank 1 to 3!). T" to display when a player has eneterd the top 10. "Y" the same for top 20. "L" comments any player that reaches a new hundredth (configurable below) in his rating, like for instance when you were a 1500 player but just became a 1600 player.

$MagicComRandTopXMsgs = array("roared into the", "just entered the", "is now a part of the", "has become a member of the", "flew into the", "is to be found in the", "is now situated in the", "lives among the"); //Custom texts for the top X messages that the commentator uses. Add or change as you please, but don't  break the syntax of "message", "another one",

$MagicComRandTop1stMsgs = array("is now king of the hill and ranked number 1!", "has rightfully claimed the ultimate spot and is ranked number 1!", "is now at the top of the mountain as number 1!", "is the master of the universe at position 1!", "says there can only be one at rank number 1!", "dominates the charts as number 1!", "has become imperator of the legions - second to nobody as number 1!", "looks down from the newly taken throne as the number 1!"); //Custom texts for the taking of the 1:st place message

$MagicComRandTop2Msgs = array("is the number one contender at", "comes closer to the final step by taking", "is right behind the leader at", "points at the sky and is now", "has but one obstacle to become the champion and takes", "smells the fear on the top as he grabs", "easily takes the", "says this is a temporary thing and claims the", "will show no mercy to acquire the number one spot and is not satisfied with just taking"); //Custom texts for the taking of the 2:nd and 3:d place message

$MagicComRandTop5Msgs = array("says there's only a few left to beat and enters the", "has fought plenty to become one of the", "soars into the", "trampled everyone and got into the"); //Custom texts for the taking of the 4:th and 5:th place message

$MagicComGotEloSettings = array("FirstRating"=> "1600", "AddThis" => "100","LastRating" => "4000","Comments" => "5"); // This configures when the magic commentator will say something about players getting within a new range of Elo. FirstRating is the lowest rating _range_ that a player may acquire to get a comment about being a part of it. AddThis is the points that define where the next range will be set for a check by taking FirstRating + AddThis. LastRating is the upper limit for getting a comment. Example: FirstRating 1500, AddThis 100 and LastRating 4000 would comment any player that got 1600, 1700, 1800, etc etc points up to he got 4000, Recomended to keep default settings for normal Elo ratings."Comments" sets the number of magic comments we want to show at the index. The quote will be met if such games/players exist in the db and may not show directly on new ladders. Set Comments to 0 to disable magic commens the clean way.

$MagicComRandEloMsgs = array("has ascended to the heady heights of ", "is now over","just got into the range of","broke the border to","managed to scrape together more than"); //Custom texts for getting to the next hundredth (configurable below)


// Anti Match Spam Config ----------------------------

// Measures against match spam (players gaining advantage by merely being more active than others)
define("ANTI_MATCHSPAM_METHOD", 1); // 0 for none [default], 1 for cap on X matches / Y days, 2 for fixed k penalty factor after cap, 3 for dynamic factor
define("ANTI_MATCHSPAM_NUMGAMES", 14); // Amount of games (victories) a player can report within period x, where x is an amount of days. e.g. 14
define("ANTI_MATCHSPAM_DAYS", 7); // The player can play <= y games within x days. If he exceeds that number he can't report the game. e.g. 7 for one week
define("ANTI_MATCHSPAM_FACTOR", 0.5); // On METHOD 2 or 3, this 0 < value < 1 determines the point reduction above NUMGAMES (less value = more punishment) Recommendation: 0.5


// Elo Cap Config -----------------------------------------

// Measures against always playing the weakest opponent you can find to get easy points. Since original Elo is pretty permissive and rewarding, giving a 1800 player points for beating a 1700 player, one might want to encourage people to play against others that are about their same skill level or higher.

define("ENABLE_MAX_DIFFERENCE_SYSTEM", 0); //   Set to 0 for off and not using any kind of limitiation. That will allow Elo to work 100% as originally intended, which is great in any enviornemnt where the players don't pick their opposition _all by them self_.  Set to 1 to use the HardCap system enabled with only the bottom cap function enabled - that would simply mean that a player would get HARDCAP_BOTTOM_RATING_DIFFERENCE_POINTS points for winning over another that has x much lower or y much higher rating than him, where x and y can be configured below. Set to 2 to use the Harcap with both bottom and top cap functions enabled. That would result in the same as previous, but also with rules for how you would be rewarded when you beat players that have higher rating than you, set in HARDCAP_TOP_RATING_DIFFERENCE_POINTS. Set to 3 to use both top & bottom cap, and also see to it that the winner and loser gets/lose HARDCAP_SYS3_POINTS  points whenever they are passed the cap. As a result, a game between players that are out of each others ranges won't affect their elo if HARDCAP_SYS3_POINTS is set to 0, but the game will still be registered as played and accounted for, affecting the statistics of toal games played, wins/losses etc.

define("HARDCAP_BOTTOM_RATING_DIFFERENCE", 300); // Only used if ENABLE_MAX_DIFFERENCE_SYSTEM is 1. If you win over a player that has this much lower rating than you then you would get HARDCAP_BOTTOM_RATING_DIFFERENCE_POINTS  points for that game instead of what Elo would normally reaward you. 

define("HARDCAP_BOTTOM_RATING_DIFFERENCE_POINTS", 1); // Only used if ENABLE_MAX_DIFFERENCE_SYSTEM is 1 or 2 

define("HARDCAP_TOP_RATING_DIFFERENCE", 100); // Primary Limit. Only used if ENABLE_MAX_DIFFERENCE_SYSTEM is 2. If you win over a player that has this much higher rating than you then you would get HARDCAP_TOP_RATING_DIFFERENCE_POINTS  points for that game instead of what Elo would normally reaward you. 

define("HARDCAP_TOP_RATING_DIFFERENCE_POINTS", 1); // Only used if ENABLE_MAX_DIFFERENCE_SYSTEM is 2

define("HARDCAP_SYS3_RATING_DIFFERENCE", 300); // Primary Limit. Only used if ENABLE_MAX_DIFFERENCE_SYSTEM is 3

define("HARDCAP_SYS3_POINTS", 1); // Only used if ENABLE_MAX_DIFFERENCE_SYSTEM is 3. Amount of points that a winner gets and a loser loses whenever one of the player is outside of the cap range set in HARDCAP_SYS3_RATING_DIFFERENCE. 

define("HARDCAP_SECONDARY_LIMIT", 500); //  Secondary Limit: Only used if ENABLE_MAX_DIFFERENCE_SYSTEM is not set to 0. All cap systems use this. Example: System 3 is used and the primary Limit for system 3 is set to 100. That means that whenever the players have a difference of 100 or greater in rating, they win/lose the points specified in HARDCAP_SYS3_POINTS. But, the players difference in rating is actually 223, in which case we could use this setting to award them some other points instead, if this is set to a value above 100 and below 223. The secondary cap limit combined with the frist can fine adjust  points that are given/take and in what range when its combined with the primary limit. Example II: We use system 3 and we want to give/take 1 point from players when there is a 200 point difference between them, and, we want to give/take from them 0 points when there is a 400 point difference. The primary limit (in this case HARDCAP_SYS3_RATING_DIFFERENCE) should be set to 200 and HARDCAP_SYS3_POINTS should be set to 1. The secondary (this value, "HARDCAP_SECONDARY_LIMIT ) should be set to 400 and the HARDCAP_SECONDARY_LIMIT_POINTS  to 0... that would give the result we wished for. Notice: If you don't want to use the secondary limit just set it and the secondary limit points to the identical settings to whatever you use as primary.

define("HARDCAP_SECONDARY_LIMIT_POINTS", 0); // Points awarded to (and taken from if cap sys 3 is used) players if the hardca_secondary_limit has been passed. 



// Group ladder config ------------------------------------------------------------

define("GADDER_ELO_RANGE", 50); // The range in points of a rating that a player needs to be within the group leader in order to be rated as within the same group on the gadder. It works the following way: The 1:st group is based on the number one ranked player on the ladder. All who are within GADDER_ELO_RANGE of his rating are ranked as belonging to his group (the first one). As soon as a player is < GADDER_ELO_RANGE he will be placed in the next group. Summarised: Let the value reflect the point system and K-values in use and experiment with it to see if the Gadder is meaningfull. If it's not and groups too many together, then either your ladder is new with few games/players or you have set a too huge value here. Else, if the Gadder has very many groups, you have probably set the value too low: Keep in mind it's supposed to group players which it thinks are nearby or equal skillwise, saying that they're pretty much the same rank. E.g. a good default value when using standard Elo system with usual K and entry of 1500 would be somewhere between 45 - 65. This value however depends only on all the other settings made and is only valid with such parameters. Also notice that the gadder works the very same way as the ladder, with the obvious exception for the grouping and displaying of rank. Whoever is displayed in the normal ladder would appear somewhere in the gadder.

define("GADDER_FLAGS", 0); // Should we show flags in the gadder? 1 for yes, 0 for no. Personally I find it chaotic having it enabled.

// Config XP system --------------------------------------------------------------

// Before starting to tweak these settings please notice that the XP system is designed to measure not the skills of a player, as the Elo does, but how much a player has participated and played at the ladder. Keeping that in mind should make the Xp system work better. While tweaking the numbers you should re-load the FAQ. In it there are dynamicaly generated lists that use these settings and show you the results. Great way to find your perfect settings.

define("XP_SYS_ENABLED", 1); // 1 for enabled, 0 for disabled. If it's enabled please customize the rest of the XP systems settings if you want to. Suggested ones should work very fine though for games where it takes a long time to play more than 1000 - 2000 times. NOTICE: The numbers below that are uses to config the XP system __relate and depend heavily on each other__. If you get a working XP system or not only depends on how you have configured them and how many games an average player is expected to play in total while being on the ladder. Making it to hard to get XP makes people ignore xp and the system unfun. Making it too easy to obtain XP makes it too changing and uninteresting. Find the balance for your specific game and player needs. The way XP works is easy: a) It takes the  number of wins and multiplies  them with a certain point. b) It takes the number of losses and multiplies them with a certain point. c) It adds the result, and gets the players XP. d) It then checks to see what lvl that xp correlates to. On top of that, players within certain levelintervalls (i.e. level 1 to level 4) get a level realted title, i.e. "Warlord". All this is of course customizable.

define("XP_SYS_LVL_1", 10); // This is the amount of XP required to reach lvl 1. 

define("XP_FOR_WIN", 1.5); // This is the amount of XP rewarded to a player for each WIN he gets.

define("XP_FOR_LOSS", 1); // This is the amount of XP rewarded to a player for each LOSS he gets. It's recomended that you keep this lower than the win-equivalent or that you set it to 0. It's up to you to evaluate if it's probable that a player gains some kind of experience even when losing. Arguably, in most games, a player does so in some ways. Since the XP system is not designed to measure SKILLS but designed to measure how much a player HAS PLAYED, it would be wise to have this setting > 0. 

define("XP_SYS_LVL_FACTOR", 1.5); // This is a modifier that regulates how rapid the gap/requirement inbetween different levels is when it comes to how much xp is needed to reach them. Example: It can take 10 xp to reach lvl 1, but 30 xp to reach lvl 2, or 60 xp to reach lvl 3. The differnece in this example has been 10 - 20 - 30, meaning that it becomes harder and harder to reach every new level. Please read the FAQ for formula and more details. The higher the value, the larger the demand will be inbetween levels.

define("XP_SYS_TITLE_RANGE", 4); //  This number regulates the how many levels a player has to advance to gain his __first__ level based title. Keep in mind that there are only 15 titles avialable. (Yeah, we're keeping it to 15 only else titles would become meaningless since theyd be untrackable and/or fill the same function as levels)

define("XP_SYS_TITLE_RANGE_MULTIPLIER", 1.025); // This is the multiplier for how many levels a player has to gain to obtain a title _after_ the first has been obtained. Works like this: If it takes 5 levels to get your first title, then it would take 6 _additional levels_ to gain the second title if the modifier is 1.2  (5 * 1.2 = 6), which would happen when you reach level 11. Then it takes additional 13 levels to obtain the third title (11 * 1.2), which would happen when you reach level 24. This is probably a bad setting if it takes forever to reach just another level, and this setting should of course be used in a way so that titles chang every now and then, but not too fast. Again, check your results in the FAQ file - theres a list of all titles and when a player would obtain them, else you have to do the math yourself.

$XpTitle = array(1 => "Peasant", 2 => "Recruit", 3 => "Soldier", 4 => "Veteran", 5 => "Captain", 6 => "General", 7 => "Hero", 8 => "Legend", 9 => "Titan", 10 => "Third Angel", 11 => "Second Angel", 12 => "First Angel", 13 => "Demi God", 14 => "Minor God", 15 => "God"); // These are the 15 titles that a player can acquire and that are a summary of his lvl / xp. Only edit the text that's within the " "-signs! If you copy the syntax it's easy to add a 16:th title and so on, but it's not recomended that you do since they'll lose their function in the end.


//config etc ------------------------------------------------------

$cfg_ladder_timezone = "UTC"; // Sets what timezone the ladder will use. PLease see http://se2.php.net/manual/en/timezones.php for all options. If you have a ladder with participants from more than 1 timezone it is however best to leave it at default UTC.  If you get wrong time then you have set this to the wrong value OR the webservers time is wrongly set somewhere.
$titlebar = "Wesnoth Ladder - Competitive Gaming Ladder";
$numindexnewbs = 3; // number of newcomers to show in index sidebar..
$numindexresults = 10; //num of latest played games results to show in index sidebar
$numindexhiscore = 10; //number of people listed in the hiscore in the index sidebar
$numindexnews = 10; // news items displayed at index bottom...
$newsitems = 3; //news items to show full text of...this needs to be fixed - index shows 3 even if it says 5 in here.. lol
$numindexdeled = 5; // how many deleted games are shown at index.
define("MIN_GAMES_REPORT_POPUP", 30); // Players who have reported (won) less than this many games will get to see a pop up asking them if they are sure they want to report.
define("COUNT_GAMES_OF_LATEST_DAYS", 1); // amount of days we're gonne count the most recent played games in to display in index sidebar
define("MIN_COUNT_GAMES_OF_LATEST_DAYS", 1); // minimum amount of games that need to have been played within the x most recent days to show the amount of games the x most recent days
define("AVERAGE_GAME_LENGTH", 40); // amount of minutes the average game is expected to last. This is used for calcuating work-hours spent on gaming in the sidebar.
define("MAX_REPLAYSIZE", 200000); // max fileseize of replay file user can upload, set in bytes. 200000 = 200 kb. This will have to be adjusted to fit different games and maybe according to you hosting limits. 
$replayfileextension = "gz"; //file extension of the replay files.
define("INDEX_COMMENT_HILITE", 1); // 0 or 1. If enabled (1) then the latest game with a comment & replay will be displayed before the news posts.
$displayDateFormat = '%Y-%m-%d %h:%i'; // The format style used here is the one from mysql DATE_FORMAT - http://dev.mysql.com/doc/refman/6.0/en/date-and-time-functions.html#function_date-format
define("FOOTER_MAIL", "your info at here dot whatever"); //email adr shown in footer
define("SPAM_REPORT_TIME_PROTECTION", 1); // Number of minutes a user has to wait inbetween reporting a victory. 
define("SPAM_REPORT_TIME_PROTECTION_UNLOCKED", 9999); // When a user has _reported_ at least these many games he won't adhere under the spam report protection rule. Instead he'll be able to report results within any time intervall. Set this number very high to shut off this feature. Set it to 50 or 100 or so to give the veterans the freedom.
define("ALLOW_REPLAY_UPLOAD", 0); // 1 for enabled, 0 for disabled. 
define("SHOW_ELO_EXPECTED",0);  // 1 for enabled, 0 for disabled. If enabled and a user is logged in and viewing another users profile that user can see how much Elo points he would win / lose agains that user if they were to play a game right then. Recomended: Disabled - else players start paying too much attention on avoiding certain games.

define("RANKED_ABOVE_PERSONAL_LADDER",15);  // This many players will be displayed above the player when he views his personal ladder.
define("RANKED_BELOW_PERSONAL_LADDER",5);  // This many players will be displayed below the player when he views his personal ladder. Recomended: Keep this lower than the above value - you don't want people to play less skilled opponents.

// Player Purging --------------------------------------

define("PURGE_GHOST_PLAYERS",0); // 1 for on, 0 for off. If enabled players that have registered and played 0 games after PURGE_GHOST_MINUTES minuts have passed will be  _removed_ from the players table. (This is a _total removal_ from the table, which is way more definitive than the casual Deletion of a player where their profiles etc stay intact) Recomended: 0 ,unless your ladder has thousands of players.

define("PURGE_GHOST_MINUTES",20160);  // After a player has registered he has this many minutes to be a part of a report of a played game- If there are 0 games where he's reported to have played as winner or loser and this time has passed his account will be _removed_. Recommended: 20160, which equals 14 days..

// Don't change the values below unless you have some basic understanding of how Elo works, the settings that are there already are okey for most people.  
// WARNING: If you have played games and you change any of the below values, you MUST rerank the entire ladder.  As the values below will change the rankings of players.

$passivedays = 30; // number of days a player has to play a game before he's put in passive rating mode
define("GAMES_FOR_ACTIVE",1); // Number of minimum games that have to be played within the x latest days for a player to be considered as active. If the number of games go below this number within the given timeframe the player is considered passive. Example: We want the players to play at least 2 games within the 7 latest days, then we'd set: $passivedays = 7 and GAMES_FOR_ACTIVE to 2. Example: If it's enough to play just 1 game a month to be considered as active then set it to: $passivedays = 30 and GAMES_FOR_ACTIVE to 1.
$ladderminelo = 1300; // all players that have this or higher elo rating will be listed in the ladder... the rest are not _visible_ in it.
$gamestorank = 10; // number of games a player must have played in order to get a ranking (not the same as getting an elo rating!)
$playersshown = 200; //Number of players to show per php query on stats

// Define a Kvalue array, must be in descending points order.  rating => kvalue
$kArray = array(2100 => 16, 1800 => 24, 0 => 32);
define("ELO_DIVIDE_FACTOR",400); // This number regulates the win expectancy and is a part of the Elo formula. Leave it on 400 in full information games with 0 randomness like chess. Make it 800 or so in games with some more randomness in them. The more randomness, the higher the number should be, but, the higher the number and the more randomness, the more useless the Elo system gets.
define("BASE_RATING", 1500);    // this is what a new player gets
define("MAX_DIFFERENCE", 1000); //1200 is so high this never gets used


// Provisional System ---------------------------------

define("PROVISIONAL_SYSTEM",0); // 0 for not using any provisional system. If set to system 1 it would protect any players rating when he would lose against a provisional player. The "old" player would only lose the normal amount of points divided with PROVISIONAL_PROTECTION if he lost against the provisional player. Set to 2 to use another provisional system where _both_ players get their wins/losses of points divided by PROVISIONAL_PROTECTION when at least one of them is a provisional player.
define("PROVISIONAL",10); //The number of x games a player is provisional. 
define("PROVISIONAL_PROTECTION",4); //The amount the points that are moved is divided with when a provisional system is in use.

$kArrayProvisional = array(2100 => 32, 1800 => 48, 0 => 64); // Define a Kvalue array for provisional players only, must be in descending points order.  rating => kvalue


// Admin Re-rank settings: These only matter if admin re-ranks the ladder and should be set before that is done. ----------------------------------

define("RERANK_PER_BATCH",3); // Number of games from the games table that will be re-ranked in one batch. After that another batch is reranked, with the games next after them, and so on, until the whole database has been re-ranked. This division is necessary to avoid PHP timeouts. If your server times out when reranking the ladder then lower this value until it doesn't. Only trial and error can show you what values you should use for your server. Recomended that you start with lower settings, like 20  (or 2-3 if you have rerank_creates-history enabled) and work your way upwards if needed. And no worries: If re-rank fails somehow due to time out or interrupt you can always re-do it anytime later on, from scratch: Nothing is touched in the games table, so the raw material we work with always remains there, we'll always know who won and lost and when the game was played etc, only thing lost will be the previous poinst/numbers associated with the rule set you specified in the config, but that can always be replicated by specifying idnetical ruleset/setup in the config file.

define("RERANK_BATCH_DELAY",0); // Time in seconds until next batch is trying to be launched automatically by your browser, Tweak this to fit the performance of the server, along with rerank_per_batch, so that the site doesn't time out in the middle of re-rank! Never go above 30 sec here unless you know what you are doing and have properly setup the php & server, which you aren't able to on normal web hosts. If broswer fails to auto-reload the next batch you can still do it manually by pressing a url by hand.

define("RERANK_CREATES_RANK_HISTORY",0); // 1 for enabled,0 for disabled. If enabled teh re-rank will, in addition to correct Elo points rewarded/taken in that game, also calculate what _rank_ the winner and loser had when they played and what rank they got after the game as well. This is a tedious process and re-ranking the ladder will take several minutes longer in a huge ladder if this is enabled. The ladder does not _require_ this to be enabled for it to funcyion properly. Only thing that would happen if it was disabled is that any games that are already played before you rerank it wont have data about how the players moved up or down in the rank due to the game, so all rank history in the game_table wouldnät be there. The info is however not ever lost - if you choose to not re-rank the ladder with it today you can still rerank it with it later on and still get the very same info. Notice: The only use of the rank history is for the players eyes and of curiosity, combined with the autocomment bot on the index, so nothing happens if you have this shut off to save time. If you have it enabled please set a modest setting for batch:_delay and per_batch in the above.

define("RERANK_AUTOBATCH",1); // 1 for enabled, 0 for disabled. If enabled the rerankprocess will try to make your browser run the next batch automagically. Confirmed to work in Firefox 3.0.13 on Linux. If disabled you have to press a link once for every batch that is about to be reranked.


// Variableis that used to be stored in the database.  They have been unified in this one configuration file.
$hotcoldnum = 5;
$approve = 'no';
$approvegames = 'no';
$system = 'elorating';
$pointswin = 2;
$pointsloss = -1;




?>