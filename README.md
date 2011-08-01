Music Web Remote
================

Connect speakers to your server and play Internet radio through a PHP interface. **Please note that I've abandoned this project and [started working on version 2, which is written in Node.JS and PHP](https://github.com/Znarkus/Alarm-clock).**

![Music Web Remote](http://labs2.mimmin.com/music-web-remote/screen.png)

Copyright 2011, Markus Hedlund, Mimmin AB, www.mimmin.com. Licensed under the MIT License. Redistributions of files must retain the above copyright notice.



Features
--------

* Radio
* Volume controller
* PHP 5.3 optimized, well structured and extensible code
* The UI should work on both mobile and desktop
* CLI
* Create a powerful alarm clock with cron and the CLI



Requirements
------------

* Linux
* PHP 5.3
* [mplayer](http://www.mplayerhq.hu)



Installation
------------

First clone this app to your www directory somewhere. A subdirectory is okay.

    git clone git://github.com/Znarkus/Music-Web-Remote.git

Your web server needs to be able to play music.

    usermod -a -G audio www-data
    service apache2 restart

That works for me on Ubuntu. Now you should be able to launch your browser and start playing music.


### [Optional] Alarm clock with cron

The file `command.php` has a command-line interface. Try it!

But to be able to stop the playback from the UI, we need to launch it as the user your web server is running as.

    sudo -u www-data php -f /path/to/command.php play sweden p1

That works for me on Ubuntu. Add this to `root`'s crontab, and you got yourself an alarm clock.



Contribute / Contact
--------------------

Do you want to help? Awesome! I'll gladly take all the help I can get, especially more radio stations. You can contact me at markus@mimmin.com.