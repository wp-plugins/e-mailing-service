=== Plugin Name ===
Contributors: jooky
Donate link: http://www.e-mailing-service.net/
Tags: send newsletter, newsletter, emailing, e-mailing, e-mails, e-mail, newsletter, smtp, server smtp, email, mail, smtp server, phpmailer, Rundschreiben, envío por correo electrónico, correo postal, correo electrónico, correo electrónico, boletín de noticias, smtp, servidor SMTP, el correo electrónico, el correo electrónico, direct mailing, email, email marketing, list build, mass mail, subscription, contact, widget newsletter, plugin newsletter, template newsletter
Requires at least: 3.0.1
Tested up to: 4.2.2
Stable tag: 9.5
License: GPLv3
License URI: http://www.e-mailing-service.net/license.txt

Full plugin management and sending newsletter.The plugin also sending links your new articles and new pages to your subscribers.

== Description ==
Send newsletters (emails) with wordpress and SMTP
Mass mailing and template import.
 
Functionality of the plugin :

Languages : fr_FR, en_US, it_IT, pt_PT, de_DE, es_ES, fr_CA, fr_CH, fr_BE, en_AU, en_CA, en_GB 

Managing contacts (emails)

 - Creating mailing lists Unlimited

 - Unlimited numbers of recipients

 - Creating mailing lists with parameterizable fields

 - Import recipients (email)

 - Change recipients (email)

 - Unsubscribe automatic subscribers (email)

 - Export recipients (email) txt, csv or excel file

 - Changing subscriber lists

 - Removing subscriber lists
 
 - Export statistic (open, clic, hard bounces) csv or excel file
 
Template for newsletter

 - Import template newsletters zip and automatic installation

 - See template of newsletters in an iframe on the editor

 - Button to copy a template automatically in the newsletter editor

 - Editing and deleting templates newsletters
 
Newsletter

 - Creation from models previewing newsletters

 - Variables (shortcode) Automatic possible on your list, so lets add fields like name and first name automatically in your newsletter.

 - Rewriting links (rewritting) Automatic (on activation of the Free API)

 - Editing and deleting newsletters
 
UNSUBSCRIBE link and link of the newsletter online

 - Removing subscriber lists

 - Link for viewing the newsletter online
 
Articles and pages

 - Editing and deleting newsletters

 - Integrated model for new links, but changed
 
Send newsletter

 - Programming the possible date of shipment

 - Additional tracking can

 - Script for multi-server sending email (on activation of the API commercial)

 - Ability to pause or stop the campaign

 - Followed by the online campaign

SMTP setting

 - Works with all SMTP (gmail) servers

 - Automatic configuration with our SMTP servers
 
Management NPAI

 - Optional management bounces can automatically remove invalid email (on activation of the API commercial)

 - View a glance antispam messages or other (on activation of the API commercial)
 
Management blacklist

 - Optional management blacklists monitors your or your SMTP server and in case you are on a list you provide the link to unsubscribe (on activation of the API commercial)

 - SpamScore (note notoriety your mailing) important for hotmail updated every 4 hours. (on activation of the API commercial)
 
Statistic

 - Statistics sending, email waiting

 - Statistics openings, clicks, unsubscribes by ISP (on activation of the Free API)

 - Statistics openings, clicks, unsubscribes, by country (on activation of the Free API)

 - Statistics openings, clicks Unsubscribe by sending (on activation of the Free API)

 - Statistics openings, clicks, unsubscribes, by tracking (on activation of the Free API)

 - Statistics openings, clicks, unsubscribes, per server (on activation of the Free API)

 - Graphic widget on the dashboard for clicks, smtp, status (on activation of the Free API)

 - SMTP statistics if you have an SMTP server with us (on activation of the API commercial)
 
Widget

 - Subscribe to your recipient list parametrable
 
Alerts

 - management of configurable alerts

 - Sending alert newsletter

 - Alert newsletter finished

 - registration alert

 - SMTP alert status (on activation of the Free API)

 - blacklist alert (on activation of the Free API)

 - daily Report (on activation of the Free API)
 
Faq and support

 - Access to the FAQ and support integrated plugin (on activation of the Free API)

 - http://www.e-mailing-service.net
 
Contact form

 - Add contact form shortcode

 - List message in database
 
Free API

You are not forced to activate the free API to send emails and manage your recipients.

But to get more detailed statistics without using memory and mysql resource of your wordpress, it will activate the free API.

For this we will be informed of the url and the ip of your website. But we have no access to your confidential data and not access your email list.

To enable the API, you need to click to go to options and services, choose a nickname and put your email and activation is immediate.

You can also delete the account of the Free API


= Import template video. =

http://youtu.be/8SbD1YGmAig

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `e-mailing-service` to the `/wp-content/plugins/e-mailing-service` directory
2. Activate the plugin through the 'E-mailing service' menu in WordPress
3. chmod 0777 /wp-content/upload/

== Frequently Asked Questions ==

= It will work with all SMTP server ? =

yes

= Following is what I require to have an SMTP server to use the plugin ? =

No, the plugin also works without smtp server, and we can provide a smtp server

== Screenshots ==

1. assets/screenshot-1.png
2. assets/screenshot-2.png
3. assets/screenshot-3.png
4. assets/screenshot-7.png
5. assets/screenshot-9.png
6. assets/screenshot-9.png
7. assets/screenshot-4.png
8. assets/screenshot-5.png
9. assets/screenshot-6.png

== Changelog ==

= 9.5 =
* Add JS enqueue
= 9.4 =
* Patch security - delete prettyPhoto.css
= 9.3 =
* Patch security - delete prettyPhoto.js
= 9.2 =
* New version for user service
= 9.0 =
* Add file for send post
= 8.9 =
* Patch send post and statistics send post
= 8.8 =
* Export statistics
= 8.7 =
* Accelerate sending
= 8.5 =
* Big change in the statstiques, many more details, the sending scripts and much faster access user for sale
= 8.4 =
* improvement crontab and possibility crontab server
= 8.3 =
* fix blacklist update
= 8.2 =
* fix bounce ressource
= 8.1 =
* patch license
= 8.0 =
* export bounces and opt-in
= 7.9 =
* fix bounces details
= 7.8 =
* fix double send  in the mod debug
= 7.7 =
* patch upload image , if exist_file
= 7.5 =
* debug upload , test smtp server, send newsletter
= 7.4 =
* Patch import email
= 7.3 =
* Patch statistic
= 7.2 =
* Add update bounces manual
= 7.1 =
* Add update statistics
= 7.0 =
* Importantly, update the plugin, this fixes missing files
= 6.9 =
* fix svn languages, img, add
= 6.7 =
* fix template
= 6.1 =
* multiple contact list division
* fix add contact list
* upload picture
* fix crontab
= 5.9 =
* fix file crontab
= 5.7 =
* fix session
= 5.5 =
* fix bug license
= 5.3 =
* fix bug mysql list
= 5.1 =
* update wordpress
= 3.3 =
* add mod text or html, optimization gmail.com, orange.fr, yahoo.com
= 3.2 =
* exchange xml library for compatibility with all hostings
= 3.0 =
* fix cron automatic post
= 2.9 =
* fix mysql
= 2.8 =
* bugs unsubscribes
= 2.7 =
* add statistiques opt-in, email key for security, video tutorial
= 2.5 =
* bugs languages
= 1.9 =
* optimisation update bounces 
= 1.8 =
* bugs languages
= 1.7 =
* news template with shorcode
= 1.6 =
* template with shorcode,
visualization with shortcode
Compatible unsubscribe link gmail
= 1.5 =
* readme.txt
= 1.4 =
* readme.txt
= 1.3 =
* delete double dir
= 1.2 =
* readme encodage.
= 1.1 =
* readme encodage.
= 1.0 =
* first version.


== Upgrade Notice ==

= 9.5 =
* Add JS enqueue
= 9.4 =
* Patch security - delete prettyPhoto.css
= 9.3 =
* Patch security - delete prettyPhoto.js
= 9.0 =
* Add file for send post
= 8.9 =
* Patch send post and statistics send post
= 8.8 =
* Export statistics
= 8.7 =
* Accelerate sending
= 8.5 =
* Big change in the statstiques, many more details, the sending scripts and much faster access user for sale
= 8.4 =
* improvement crontab and possibility crontab server
= 8.3 =
* fix blacklist update
= 8.2 =
* fix bounce ressource
= 8.1 =
* patch license
= 8.0 =
* export bounces and opt-in
= 7.9 =
* fix bounces details
= 7.8 =
* fix double send  in the mod debug
= 7.7 =
* patch upload image , if exist_file
= 7.5 =
* debug upload , test smtp server, send newsletter
= 7.4 =
* Patch import email
= 7.3 =
* Patch statistic
= 7.2 =
* Add update bounces manual
= 7.1 =
* Add update statistics
= 7.0 =
* Importantly, update the plugin, this fixes missing files
= 6.9 =
* fix svn languages, img, add
= 6.7 =
* fix template
= 6.1 =
* multi contact list division
* fix add contact list
* upload picture
* fix crontab
= 5.9 =
* fix file crontab
= 5.7 =
* fix session
= 5.5 =
* fix bug license
= 5.3 =
* fix bug mysql list
= 5.1 =
* update wordpress
= 3.3 =
* add mod text or html, optimization gmail.com, orange.fr, yahoo.com
= 3.2 =
* exchange xml library for compatibility with all hostings
= 3.0 =
* fix cron automatic post
= 2.9 =
* fix mysql
= 2.8 =
* bugs unsubscribes
= 2.7 =
* add statistiques opt-in, email key for security, video tutorial
= 2.5 =
* bugs languages
= 1.9 =
* optimisation update bounces 
= 1.8 =
* bugs languages
= 1.7 =
* news template with shorcode
= 1.6 =
* template with shorcode,
visualization with shortcode
Compatible unsubscribe link gmail
= 1.5 =
* readme.txt
= 1.4 =
* readme.txt
= 1.3 =
* delete double dir
= 1.2 =
* readme encodage.
= 1.1 =
* readme encodage.
= 1.0 =
* first version.

== Arbitrary section ==






