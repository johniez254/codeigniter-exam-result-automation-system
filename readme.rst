#############################
codeigniter-exam-result-automation-system
#############################
A University Exam Result Automation project in php using codeigniter framework. 

*****************************************************
By `Johnson Matoke <https://github.com/johniez254>`_
*****************************************************

###################
What is CodeIgniter
###################

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

###################
Project Features
###################

	- User identification and authentication
	- Separate Users' (**ADMIN, LECTURER, STUDENT**) privilegdes
	- perform various crud functionalities
	- Generate student's result reports
	- Added graphical presentation of data
	- Plus more awesome features to be explored and to find by yourself.	
	
		- **Admin functionalities**
			+ Manage System settings
			+ add/edit/delete users (lecturer and students).
			+ Add/edit/delete School, Departments, Courses, Units, semester, and grade information.
			+ Assign lecturer units.
	
		- **Lecturer functionalities**
			+ Add/modify student's attendance based on units taught.
			+ Add/modify student's results based on units taught.
	
		- **Student functionalities**
			+ View results based on semeter/year.

###################
Installing the Exam Result Automation (ERA)
###################
 
One is required to follow the instruction/or procedures as shown in the installation above for Adobe Dreamweaver and Xampp Server. The installation of the above enables the system to have PHP and MySQL installed in the directory; C:\Xampp directory and all other program files.

#######################
Running the ERA Project
#######################

i)	Create a local folder named "**era**" in htdocs directory found in Xampp Server. 	This is the default publishing folder i.e. C:\Xampp\htdocs for all systems installed using Xampp Server 3.2.2.

ii)	Extract/clone/copy-paste the system files above to your newly locally-created **era** folder, ensure it contains the following project sub-folders and files:

	.. list-table:: **xampp/htdocs/era/**
	   :widths: 25 75
	   :header-rows: 1

	   * - Folder/File
	     - Description

	   * - ``application/``
	     - contains all the system code

	   * - ``components/``
	     - contains bootstrap css and javascripsts files, custom system Javascript files e.t.c

	   * - ``install/``
	     - IMS installation folder

	   * - ``system/``
	     - contains core Codeigniter files

	   * - ``uploads/``
	     - contains all system images, documents, pdf e.t.c

	   * - ``.htaccess``
	     - codeigniter configuration file

	   * - ``.gitignore``
	     - ignored files

	   * - ``.LICENCE``
	     - The MIT standard licence
					

iii) Go to the Xampp application, start Xampp. On Xampp control panel, start Apache and MySQL services by clicking the buttons.

iv)	To set up the database environment, go to your htdocs folder (named era), select the folder with the project and drag it to your browser then change the link URL to <http://localhost/era/>. This will be 		able to redirect to the ERA installation wizard. Just follow the prompts of installation providing the hostname, username, database name, and password.


###############################
Super Admin Default Credentials
###############################

username: **admin**

password: **admin**


*******************
Release Information
*******************

This repo contains in-development code for future releases. To download the
latest stable release please visit the `CodeIgniter Downloads
<https://codeigniter.com/download>`_ page.

**************************
Changelog and New Features
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.
It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.


*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community IRC <https://webchat.freenode.net/?channels=%23codeigniter>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
