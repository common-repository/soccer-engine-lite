=== Soccer Engine - Soccer Plugin for WordPress ===
Contributors: DAEXT
Tags: soccer, football, league, fixtures, sports
Donate link: https://daext.com
Requires at least: 5.0
Tested up to: 6.6.2
Requires PHP: 5.5
Stable tag: 1.13
License: GPLv3

Soccer Engine is a plugin that lets bloggers and clubs add results, fixtures, match commentaries, transfers, and a wide range of stats to articles.

== Description ==

Soccer Engine is a specialized soccer plugin for WordPress that gives sports bloggers and club websites administrators the ability to complement their articles with results, fixtures, match commentaries, transfer market data, and a great variety of other statistics.

When installed, this massive project adds to WordPress 40 new administrative menus, 27 new editor blocks, and 62 customization options. Our goal is to provide all WordPress users with a comprehensive and expandable solution for any soccer-related website.

### Pro version

We distribute the [Pro version](https://daext.com/soccer-engine/) of this plugin that includes the following additional features:

* **Additional Blocks** like the Match Timeline, Ranking Transitions Chart, Market Value Transitions Chart, Referee Statistics by Competition, Referee Statistics by Team.
* **Events Wizard** to generate multiple events in a single operation. With this feature, you can easily assign results to multiple matches without manually adding single events.
* **REST API** to optionally manage the Soccer Engine data with external applications, create new additional plugin features, automatically create match events, and more.
* **Import** and **Export** menus to create a backup of the plugin data or move the plugin data between different WordPress installations.
* **Additional advanced options** to set custom menu capabilities, customize the pagination system, and more.

### Publish a great variety of soccer statistics

This plugin gives you the ability to publish a great variety of soccer statistics on your website. These statistics are sometimes directly retrieved from records added by the website editors with the administrative menus. Other times, the plugin generates statistics based on simple or complex calculations. Examples of statistics directly retrieved from the inputted data are the first name of a player, the last name of a player, and its height. In contrast, examples of statistics calculated by the plugin are the standings tables of the competitions or statistics that report the player performance.

In terms of elements generated in the front-end, the plugin uses regular HTML tables for the most part. However, the plugin can also generate more complex layouts when needed. To illustrate, in the case of match commentaries or to visually represent the formations, the plugin uses custom layouts augmented with images, SVG illustrations, and more.

Below you can find a list of the blocks added to WordPress by the plugin in alphabetic order. Please note that users of the [Classic Editor](https://wordpress.org/plugins/classic-editor/), or users with alternative visual editors can use shortcodes with parameters as a fallback for the editor blocks. For more information on the use of the shortcodes provided by Soccer Engine, visit the [shortcodes section](https://daext.com/doc/soccer-engine-lite/#shortcodes) of the plugin manual.

#### Agency contracts
This block displays a table that lists the contractual agreement between players and their agencies or sports agents.

#### Competition round
Use this element to display a table with information about the matches associated with a competition.

#### Competition standings table
With this block, you can generate a standings table that compares the teams of a round-robin competition by ranking them based on multiple criteria.

Note that we worked to make the tournament system very flexible. For example, you can set the criteria used to rank the teams or determine the points assigned to the team's victories, draw, and loss.

#### Injuries
This block allows you to display a table with information about the injuries.

The plugin gives you the ability to list the individual injuries associated with the players and add additional information like the injury type (E.g., concussion, knee inflammation, meniscal tear, etc.), the date range on which the player was injured, and more.

#### Market value transitions
This block displays a table with information about the market value of players at a specific moment in time.

#### Match commentary
This block gives you the ability to describe the events of a match. Specifically, this element generates a list of events that include the minute of the event, an icon that represents the type of event, an image of the player, and your custom description of the event.

#### Match lineup
Use this block to display a team's lineup in a specific match. If the game includes events, event icons are used to provide details on these events.

#### Match score
This block summarizes essential data about a match in a simple and easy-to-understand layout. Specifically, the following information is displayed: The name of the teams, the team logos, the match result, the date and hour of the match, where the game has been played, the attendance, and the referee.

#### Match staff
Use this feature to list the staff members that participated in a specific match. For example, a typical list of staff members includes the manager, the assistant manager, and a few other members like the athletic coach, the team coordinator, etc.

#### Match substitutions
This element allows you to list the substitute players available for a team in a specific match.

#### Match visual lineup
This block generates a layout composed of an isometric field with the players in the starting lineup and a table that lists substitutes and staff members.

Note that the player displayed in the isometric field are positioned based on the specific formation defined in the back-end. In addition, below each player are also shown icons used to represent the event associated with the players.

#### Matches
This block displays a table that lists one match per row with information like the date of the game, the hour of the game, the home team, the away team, the match result, and more.

Note that this list is generated based on custom criteria defined with the block options. You can, for example, only display the matches played by a specific team, the games played in a specified date interval, and more.

#### Player awards
Use the player awards to register and display the awards received by the players. A prominent example of this feature is to list the Ballon D'Or winners. Note that you can define your custom awards in the back-end and, consequently, list awards assigned by local competitions, etc.

#### Player summary
This element generates information retrieved from the players and from the transfers market data. It's a layout commonly used in "Player Profile" pages or more in general to complement pages or paragraphs dedicated to specific players.

#### Players
This layout generates a table that lists one player per row. The table columns, which you can customize with the block options, can display information like the age of the player, the citizenship, the player height, the market value, the current club of the player, the club that owns the player, and more.

#### Ranking transitions
With this block, you can display a table that lists the ranking value of the teams in a specific ranking system. An example of ranking system is the [UEFA club coefficients](https://www.uefa.com/nationalassociations/uefarankings/).

Based on your specific needs, you can create your custom ranking systems or report the data of existing ranking systems.

#### Referee summary
This block displays a referee's image, additional information retrieved from referee data, and calculated information based on the referee's performance on existing matches.

In terms of computed statistics, the plugin can list the number of appearances, the overall number of yellow cards and red cards assigned by the referee, and more.

#### Squad lineup / Squad staff / Squad substitutions
These three blocks list the players and staff members associated with a squad.

Note that in this plugin, the squads are reusable collections of players, staff members, formations, and jersey sets usually used to speed up the configuration of new matches.

#### Staff
This block displays a list of staff members with information like the staff member's age, their citizenship, and their role. Examples of staff members are managers, assistant managers, athletic coaches, goalkeeping coaches, board members.

#### Staff awards
Use this block to generate a list of awards assigned to staff members. Staff awards are honors, like "Best manager of the year", usually given by associations to the staff members of a soccer team.

#### Staff summary
This block displays an image of the staff member with relevant information like his age, citizenship, and role. In addition, the plugin also displays computed information like the staff member favorite formation, the points per match, the average number of goals scored by the staff member teams, the number of matches in which the staff member has been involved, and the number of matches won, drawn, and lost.

#### Team contracts
You should use this feature to display contracts between players and teams. Essential information associated with the team contracts are the contract's start date, the contract's end date, and the salary.

Team contracts are always associated with a contract type, which is used to better define and categorize the team contract. Examples of contract types are purchase, loan, loan with option, etc. It's worth noting that the plugin gives you the ability to define your custom contract types from a dedicated menu.

#### Transfers
This is an essential element for transfer market blogs that want to list the transfer market movement.

Thanks to the block filters, you can display, for example, only the transfer market movement that took place in a specific period, the transfer market movement associated with a particular team, the transfer market movement with high fees, and more.

In the front-end, the table generated with this block includes information such as the player name, the player citizenship, the teams involved in the transfer, the date of the transfer, the market value of the player, the fee paid to complete the transfer, and more.

#### Trophies
Use this block to display the trophies won by a team with information like the type of trophy or the data on which the trophy has been assigned.

Use this feature, for example, to list the UEFA Champions League winners or to list the winners of local soccer competitions.

#### Unavailable players
Use this element to list the unavailable players. This list includes the name of the player, the reason for the unavailability, the date range on which the player is unavailable, and optionally other player information.

### Notable features of this soccer plugin

#### Vector graphics
The plugin uses dynamic and customizable SVGs to represent icons and other graphical elements like the soccer fields, the clocks used to display the minute of an event, etc.

#### Customizable style
A total of 40 style options allows you to customize the colors and the typography of the elements generated by the plugin. So you can easily create your own unique and consistent style.

#### The events system
Events are the single units used to generate the match statistics. Examples of events are goals, yellow cards, red cards, and substitutions.

By entering events, you will be able to display match commentaries, generate event tooltips with details of the events, and more. In addition, the events data allows the plugin to generate computed statistics.

#### Customizable competitions
The plugin allows you to create competitions of type [Round-robin](https://en.wikipedia.org/wiki/Round-robin_tournament) and [Elimination](https://en.wikipedia.org/wiki/Single-elimination_tournament) with a custom number of participating teams.

These two types of competition are the foundations for any soccer tournament. For example, you can easily create the English Premier League by making a Round-robin tournament with 20 teams or set up the knockout stage of the Champions League by using an Elimination tournament with 16 teams.

#### Credits
This plugin makes use of the following resources:

* [Chosen](https://github.com/harvesthq/chosen) licensed under the [MIT License](http://www.opensource.org/licenses/mit-license.php)
* Flags icons by [GoSquared](https://www.gosquared.com/) licensed under the [MIT License](http://www.opensource.org/licenses/mit-license.php)
* The ball icon used in the back-end menus is part of [Font Awesome](https://github.com/FortAwesome/Font-Awesome) and is licensed under the [SIL license](https://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL).

For each library you can find the actual copy of the license inside the folder used to store the library files.

== Installation ==
= Installation (Single Site) =

With this procedure you will be able to install the Soccer Engine plugin on your WordPress website:

1. Visit the **Plugins -> Add New** menu
2. Click on the **Upload Plugin** button and select the zip file you just downloaded
3. Click on **Install Now**
4. Click on **Activate Plugin**

= Installation (Multisite) =

This plugin supports both a **Network Activation** (the plugin will be activated on all the sites of your WordPress Network) and a **Single Site Activation** in a **WordPress Network** environment (your plugin will be activated on a single site of the network).

With this procedure you will be able to perform a **Network Activation**:

1. Visit the **Plugins -> Add New** menu
2. Click on the **Upload Plugin** button and select the zip file you just downloaded
3. Click on **Install Now**
4. Click on **Network Activate**

With this procedure you will be able to perform a **Single Site Activation** in a **WordPress Network** environment:

1. Visit the specific site of the **WordPress Network** where you want to install the plugin
2. Visit the **Plugins** menu
3. Click on the **Activate** button (just below the name of the plugin)

== Changelog ==

= 1.13 =

*May 6, 2024*

* Nonce validation added to the plugin back-end menus.
* Fixed error in the text domain passed to the translation functions.
* Improved variable escaping.

= 1.12 =

*April 8, 2024*

* Fixed a bug (started with WordPress version 6.5) that prevented the creation of the plugin database tables and the initialization of the plugin options during the plugin activation.

= 1.11 =

*December 29, 2023*

* Fixed PHP warnings.
* General refactoring. The phpcs "WordPress" ruleset has been partially applied to the plugin code.
* Plugin name changed to "Soccer Engine - Soccer Plugin for WordPress".

= 1.10 =

*March 21, 2023*

* The "Events Wizard" menu has been added.
* Changelog added.
* A link to the Pro Version has been added to the Plugins menu.
* Improved block style in the block editor.

= 1.09 =

*April 24, 2022*

* Fixing other wrong text domain occurrences in the translation functions.

= 1.08 =

*April 23, 2022*

* The correct text domain is now used with the translation functions.
* Removed the "Lite" word from the plugin name.

= 1.07 =

*February 22, 2022*

* Initial release.

== Screenshots ==
1. Matches menu
2. Events menu
3. Options menu in the "Colors" tab
4. Options menu in the "Advanced" tab
5. Some of the plugin blocks in the post editor
6. Soccer field with the players in the starting lineup
7. Match commentary
8. The profile page of a player
9. Staff members listed in a paginated table
10. Transfer market movements listed in a paginated table
11. The rounds of a competitions
12. The league table of a competition